<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::where('user_id', Auth::id())
            ->with('order');

        // Filter by transaction type
        if ($request->has('type') && $request->type != 'all') {
            $query->where('transaction_type', $request->type);
        }

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->latest()->paginate(15);

        // Calculate statistics
        $stats = [
            'total_spent' => Transaction::where('user_id', Auth::id())
                ->where('transaction_type', 'payment')
                ->where('status', 'completed')
                ->sum('amount'),
            'total_refunded' => Transaction::where('user_id', Auth::id())
                ->where('transaction_type', 'refund')
                ->where('status', 'completed')
                ->sum('amount'),
            'pending_amount' => Transaction::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->sum('amount'),
            'total_transactions' => Transaction::where('user_id', Auth::id())->count(),
        ];

        return view('transactions.index', compact('transactions', 'stats'));
    }
}
