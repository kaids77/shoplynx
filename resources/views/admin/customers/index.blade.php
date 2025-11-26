@extends('layouts.admin')

@section('content')
    <div class="dashboard-container">
        <h1 class="mb-4">Customer List</h1>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered Date</th>
                        <th>Total Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>#{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->created_at->format('M d, Y') }}</td>
                            <td>{{ $customer->orders->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <p><strong>Total Customers:</strong> {{ $customers->count() }}</p>
        </div>
    </div>
@endsection