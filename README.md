# Shoplynx - Modern E-Commerce Platform

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

A fully functional, modern e-commerce platform built with Laravel 12. Shoplynx features a clean, professional UI with a complete admin panel for product management, user authentication, shopping cart functionality, order processing, and transaction tracking.

## Features

### User Features
- **Modern Landing Page** - Professional introduction with company overview
- **User Authentication** - Secure registration and login system with role-based access
- **Product Browsing** - View all products with detailed information, search functionality, and beautiful card layouts
- **Stock Management** - Real-time stock quantity display and out-of-stock indicators
- **Shopping Cart** - Add, update, and remove items with cart notification badge
- **Checkout System** - Complete order placement with secure customer details and multiple payment methods
- **Order Management** - Track order history with status updates (Pending → Shipped → Completed)
- **Order Cancellation** - Cancel pending orders with automatic stock restoration
- **Transaction History** - View detailed transaction records with color-coded status indicators
- **User Profile Settings** - Update account information (name, email, password, profile image)
- **Responsive Design** - Clean, modern UI with card shadows and smooth animations

### Admin Features
- **Admin Dashboard** - Statistics overview (Total Products, Orders, Customers)
- **Product Management** - Full CRUD operations for products with stock quantity tracking
- **Image Upload** - Upload and manage product images
- **Order Management** - View all orders and manually update order statuses (Pending, Shipped, Completed, Cancelled)
- **Customer Management** - View registered customers and their information
- **Transaction Tracking** - Automatic transaction description updates based on order status
- **Secure Access** - Protected admin routes with middleware

### Security
- Role-based access control (User/Admin)
- Password hashing with bcrypt
- CSRF protection
- Middleware authentication
- Session management
- Prevent back-history after logout
- Server-side validation for checkout data

### Transaction System
- **Automated Transaction Creation** - Transactions automatically created on order placement
- **Status Tracking** - Transaction descriptions update based on order status:
  - Pending: "Payment for Order #X"
  - Shipped: "Payment for Order #X - Shipped" (green)
  - Completed: "Payment for Order #X - Completed" (green)
  - Cancelled: "Payment for Order #X - Cancelled" (red)
- **Transaction Filtering** - Filter by type, status, and date range
- **Statistics Dashboard** - View total spent and total transactions

## Key Improvements

### Product Display
- **Stock Quantity Display** - Real-time stock levels shown on product cards
- **Out of Stock Indicators** - Visual badges and disabled "Add to Cart" buttons
- **Search Functionality** - Search products by name or description
- **Fixed Image Sizing** - All product images display at consistent 280px height
- **Card Shadows** - Elegant box shadows on product cards (0 2px 8px)
- **Hover Effects** - Enhanced shadows on hover (0 4px 16px)
- **Border Radius** - Rounded corners (8px) for modern look
- **Professional Layout** - Grid system with proper spacing

### Order Management
- **Manual Status Control** - Admins manually update order statuses (no automatic timers)
- **Stock Restoration** - Automatic stock restoration when orders are cancelled
- **Transaction Sync** - Transaction descriptions automatically update with order status changes
- **Clean UI** - Simplified order view without countdown timers

### User Experience
- **Cart Badge** - Real-time notification showing number of items in cart
- **Account Settings** - Users can update their profile, change password, and upload profile images
- **Phone Validation** - Philippine standard 11-digit phone number validation
- **Minimal Navigation** - Clean landing page with only "Get Started" button for guests
- **Pagination** - Bootstrap 5 pagination with proper styling
- **Secure Checkout** - Customer name and email sourced from authenticated user profile

## Installation

### Prerequisites

Before you begin, ensure you have the following installed:
- **PHP** >= 8.2
- **Composer** (PHP dependency manager)
- **MySQL** >= 8.0 or **MariaDB**
- **XAMPP** / **WAMP** / **MAMP** (or any local server environment)
- **Git** (for cloning the repository)

### Step-by-Step Installation

#### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/shoplynx.git
cd shoplynx
```

#### 2. Install Dependencies

```bash
composer install
```

#### 3. Environment Configuration

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

Edit the `.env` file and configure your database settings:

```env
APP_NAME=Shoplynx
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shoplynx
DB_USERNAME=root
DB_PASSWORD=
```

**Note:** For XAMPP users, the default MySQL password is usually empty. Adjust `DB_USERNAME` and `DB_PASSWORD` according to your setup.

#### 4. Generate Application Key

```bash
php artisan key:generate
```

#### 5. Create Database

Create a new MySQL database named `shoplynx`:

**Using phpMyAdmin:**
1. Open `http://localhost/phpmyadmin`
2. Click "New" in the left sidebar
3. Enter database name: `shoplynx`
4. Click "Create"

**Using MySQL CLI:**
```sql
CREATE DATABASE shoplynx;
```

#### 6. Run Migrations

Create all necessary database tables:

```bash
php artisan migrate
```

#### 7. Seed the Database

Populate the database with sample data (admin user, customer, and products):

```bash
php artisan db:seed
```

This will create:
- **Admin Account**: `admin@shoplynx.com` / `password`
- **Customer Account**: `customer@shoplynx.com` / `password`
- **Sample Products**: Demo products with stock quantities

#### 8. Create Storage Link

Link the public storage for image uploads:

```bash
php artisan storage:link
```

#### 9. Start the Development Server

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Usage

### Accessing the Application

#### User Access
1. Navigate to `http://localhost:8000`
2. Click "Get Started" to create a new account
3. Login with your credentials
4. Browse products, search, add to cart, and checkout
5. View your orders and track their status
6. Access transaction history to see all payments
7. Access "Settings" to update your profile and upload a profile image

#### Admin Access
1. Navigate to `http://localhost:8000/login`
2. Login with admin credentials:
   - **Email**: `admin@shoplynx.com`
   - **Password**: `password`
3. You'll be redirected to the admin dashboard
4. Manage products (add, edit, delete, update stock)
5. View and manage all orders (update status manually)
6. View customer list
7. Track order statistics

### User Features

#### Account Settings (`/profile/settings`)
- **Update Profile**: Change name and email
- **Change Password**: Update your password securely
- **Upload Profile Image**: Set a custom profile picture
- **Form Validation**: Real-time validation for all inputs

#### Shopping Flow
1. **Browse Products** (`/products`) - View all available products with stock levels
2. **Search Products** - Use the search bar to find products by name or description
3. **Product Details** (`/products/{id}`) - See detailed product information
4. **Add to Cart** - Click "Add to Cart" on any in-stock product (cart badge updates automatically)
5. **View Cart** (`/cart`) - Review items, quantities, and stock availability
6. **Checkout** (`/checkout`) - Customer details auto-filled from profile, select payment method
7. **Order Confirmation** - Receive confirmation after successful order
8. **Track Orders** (`/orders`) - View order status and cancel if still pending
9. **Transaction History** (`/transactions`) - View all payment records with filtering options

#### Payment Methods
- GCash
- PayPal
- Cash on Delivery (COD)
- Bank Transfer

### Admin Features

#### Order Management (`/admin/orders`)
- View all orders with customer details
- Manually update order status:
  - **Pending** - Initial order state, can be cancelled by customer
  - **Shipped** - Order has been shipped to customer
  - **Completed** - Order successfully delivered
  - **Cancelled** - Order cancelled (stock restored automatically)
- Transaction descriptions update automatically when status changes

#### Product Management (`/admin/products`)
- Add new products with stock quantity
- Edit existing products
- Delete products
- Upload product images
- Track stock levels

## Project Structure

```
shoplynx/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php         # Admin product management
│   │   │   ├── AdminOrderController.php    # Admin order management
│   │   │   ├── AuthController.php          # Authentication
│   │   │   ├── CartController.php          # Shopping cart
│   │   │   ├── CustomerController.php      # Customer management
│   │   │   ├── HomeController.php          # Public pages
│   │   │   ├── OrderController.php         # User orders
│   │   │   ├── ProductController.php       # Product display
│   │   │   ├── ProfileController.php       # User settings
│   │   │   └── TransactionController.php   # Transaction history
│   │   └── Middleware/
│   │       ├── EnsureUserIsAdmin.php       # Admin access control
│   │       └── PreventBackHistory.php      # Prevent back after logout
│   ├── Models/
│   │   ├── User.php                        # User model
│   │   ├── Product.php                     # Product model
│   │   ├── Order.php                       # Order model
│   │   ├── OrderItem.php                   # Order items model
│   │   ├── CartItem.php                    # Cart items model
│   │   └── Transaction.php                 # Transaction model
│   └── Providers/
│       └── AppServiceProvider.php          # Bootstrap 5 pagination config
├── database/
│   ├── migrations/                         # Database migrations
│   └── seeders/
│       └── DatabaseSeeder.php              # Sample data seeder
├── public/
│   ├── css/
│   │   └── style.css                       # Custom styles with pagination
│   └── images/                             # Product images & logo
├── resources/
│   └── views/
│       ├── layouts/                        # Layout templates
│       ├── auth/                           # Login/Register pages
│       ├── products/                       # Product pages
│       ├── cart/                           # Cart & checkout
│       ├── orders/                         # Order tracking
│       ├── transactions/                   # Transaction history
│       ├── profile/                        # User settings
│       └── admin/                          # Admin panel views
│           ├── products/                   # Product management
│           ├── orders/                     # Order management
│           └── customers/                  # Customer list
└── routes/
    └── web.php                             # Application routes
```

## Technology Stack

- **Backend Framework**: Laravel 12.x
- **Frontend**: Blade Templates, Vanilla CSS
- **Database**: MySQL 8.0+
- **Authentication**: Laravel's built-in authentication
- **Styling**: Custom CSS with Bootstrap 5 pagination
- **Image Storage**: Public disk storage
- **Pagination**: Bootstrap 5

## Design Philosophy

Shoplynx follows modern web design principles:
- **Minimalist Black & White Theme** - Professional and clean aesthetic
- **Card-Based Layout** - Product cards with shadows and hover effects
- **Responsive Design** - Works on all device sizes
- **Smooth Animations** - Micro-interactions for better UX
- **Consistent Sizing** - Fixed image dimensions (280px height) for uniform appearance
- **Visual Hierarchy** - Clear separation with borders and shadows
- **Color-Coded Status** - Green for completed, red for cancelled transactions

## Database Schema

### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `role` - User role (user/admin)
- `phone` - Phone number (11 digits)
- `address` - User address
- `image_path` - Profile image path
- `timestamps`

### Products Table
- `id` - Primary key
- `name` - Product name
- `description` - Product description
- `price` - Product price (decimal)
- `stock_quantity` - Available stock
- `image_path` - Path to product image
- `timestamps`

### Orders Table
- `id` - Primary key
- `user_id` - Foreign key to users
- `customer_name` - Customer full name
- `customer_email` - Customer email
- `customer_phone` - Customer phone (11 digits)
- `status` - Order status (pending/shipped/completed/cancelled)
- `payment_method` - Payment method used
- `total_price` - Total order amount
- `shipping_address` - Delivery address
- `timestamps`

### Order Items Table
- `id` - Primary key
- `order_id` - Foreign key to orders
- `product_id` - Foreign key to products
- `quantity` - Item quantity
- `price` - Price at time of order
- `timestamps`

### Cart Items Table
- `id` - Primary key
- `user_id` - Foreign key to users
- `product_id` - Foreign key to products
- `quantity` - Item quantity
- `timestamps`

### Transactions Table
- `id` - Primary key
- `user_id` - Foreign key to users
- `order_id` - Foreign key to orders
- `reference_number` - Unique transaction reference
- `amount` - Transaction amount
- `transaction_type` - Type (payment/refund)
- `payment_method` - Payment method used
- `status` - Transaction status (completed/pending/failed)
- `description` - Transaction description (updates with order status)
- `timestamps`

## Routes

### Public Routes
- `GET /` - Landing page
- `GET /login` - Login page
- `POST /login` - Process login
- `GET /register` - Registration page
- `POST /register` - Process registration

### Authenticated User Routes
- `GET /home` - User home page
- `GET /about` - About page
- `GET /contact` - Contact page
- `GET /products` - Product listing with search
- `GET /products/{id}` - Product details
- `GET /cart` - Shopping cart
- `GET /checkout` - Checkout page
- `POST /checkout` - Process order
- `GET /orders` - Order history
- `PUT /orders/{id}/cancel` - Cancel order
- `GET /transactions` - Transaction history
- `GET /profile/settings` - User settings
- `PUT /profile` - Update profile
- `PUT /profile/password` - Change password
- `PUT /profile/image` - Update profile image

### Admin Routes (Requires Admin Role)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/products` - Product management
- `GET /admin/products/create` - Add product form
- `POST /admin/products` - Store new product
- `GET /admin/products/{id}/edit` - Edit product form
- `PUT /admin/products/{id}` - Update product
- `DELETE /admin/products/{id}` - Delete product
- `GET /admin/orders` - Order management
- `PUT /admin/orders/{id}/status` - Update order status
- `GET /admin/customers` - Customer list

## Troubleshooting

### Common Issues

#### "Access Denied" Database Error
- Verify MySQL is running in XAMPP
- Check database credentials in `.env`
- Ensure database `shoplynx` exists

#### "Class not found" Error
```bash
composer dump-autoload
```

#### Images Not Displaying
```bash
php artisan storage:link
```

#### Permission Errors (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

#### Port 8000 Already in Use
```bash
php artisan serve --port=8080
```

#### Pagination Arrows Too Large
This has been fixed by configuring Bootstrap 5 pagination in `AppServiceProvider.php`

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

## Author

Created with  for educational purposes and demonstration.

## Acknowledgments

- Laravel Framework
- Bootstrap 5 Pagination
- Modern CSS Design Patterns
- Open Source Community

---

**⭐ If you find this project helpful, please give it a star!**

Made with Laravel 12 | © 2025 Shoplynx
