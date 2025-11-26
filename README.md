# 🛍️ Shoplynx - Modern E-Commerce Platform

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

A fully functional, modern e-commerce platform built with Laravel 12. Shoplynx features a clean, professional UI with a complete admin panel for product management, user authentication, shopping cart functionality, and order processing.

## ✨ Features

### 🎨 User Features
- **Modern Landing Page** - Professional introduction with company overview
- **User Authentication** - Secure registration and login system
- **Product Browsing** - View all products with detailed information and beautiful card layouts
- **Shopping Cart** - Add, update, and remove items with cart notification badge
- **Checkout System** - Complete order placement with customer details and multiple payment methods
- **User Profile Settings** - Change account information (name, email, password)
- **Order Management** - Track order history and status
- **Responsive Design** - Clean, modern UI with card shadows and smooth animations

### 👨‍💼 Admin Features
- **Admin Dashboard** - Statistics overview (Total Products, Orders, Customers)
- **Product Management** - Full CRUD operations for products
- **Image Upload** - Upload and manage product images
- **Order Tracking** - View recent orders with customer details, products purchased, and payment methods
- **Secure Access** - Protected admin routes with middleware

### 🔐 Security
- Role-based access control (User/Admin)
- Password hashing with bcrypt
- CSRF protection
- Middleware authentication
- Session management
- Prevent back-history after logout

## 🎯 Key Improvements

### Product Display
- **Fixed Image Sizing** - All product images display at consistent 280px height
- **Card Shadows** - Elegant box shadows on product cards (0 2px 8px)
- **Hover Effects** - Enhanced shadows on hover (0 4px 16px)
- **Border Radius** - Rounded corners (8px) for modern look
- **Professional Layout** - Grid system with proper spacing

### User Experience
- **Cart Badge** - Real-time notification showing number of items in cart
- **Account Settings** - Users can update their profile and change password
- **Phone Validation** - Philippine standard 11-digit phone number validation
- **Minimal Navigation** - Clean landing page with only "Get Started" button for guests

## 🚀 Installation

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
- **Sample Products**: 4 demo products

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

## 🎯 Usage

### Accessing the Application

#### User Access
1. Navigate to `http://localhost:8000`
2. Click "Get Started" to create a new account
3. Login with your credentials
4. Browse products, add to cart, and checkout
5. Access "Settings" to update your profile

#### Admin Access
1. Navigate to `http://localhost:8000/login`
2. Login with admin credentials:
   - **Email**: `admin@shoplynx.com`
   - **Password**: `password`
3. You'll be redirected to the admin dashboard
4. Manage products, view orders, and track statistics

### User Features

#### Account Settings (`/profile/settings`)
- **Update Profile**: Change name and email
- **Change Password**: Update your password securely
- **Form Validation**: Real-time validation for all inputs

#### Shopping Flow
1. **Browse Products** (`/products`) - View all available products with beautiful card layouts
2. **Product Details** (`/products/{id}`) - See detailed product information
3. **Add to Cart** - Click "Add to Cart" on any product (cart badge updates automatically)
4. **View Cart** (`/cart`) - Review items and quantities (minimum 1 item)
5. **Checkout** (`/checkout`) - Enter customer details (name, email, 11-digit phone, address) and payment method
6. **Order Confirmation** - Receive confirmation after successful order

#### Payment Methods
- GCash
- PayPal
- Cash on Delivery (COD)
- Bank Transfer

## 📁 Project Structure

```
shoplynx/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php      # Admin panel logic
│   │   │   ├── AuthController.php       # Authentication
│   │   │   ├── CartController.php       # Shopping cart
│   │   │   ├── HomeController.php       # Public pages
│   │   │   ├── ProductController.php    # Product display
│   │   │   └── ProfileController.php    # User settings
│   │   └── Middleware/
│   │       ├── EnsureUserIsAdmin.php    # Admin access control
│   │       └── PreventBackHistory.php   # Prevent back after logout
│   └── Models/
│       ├── User.php                     # User model
│       ├── Product.php                  # Product model
│       ├── Order.php                    # Order model
│       └── OrderItem.php                # Order items model
├── database/
│   ├── migrations/                      # Database migrations
│   └── seeders/
│       └── DatabaseSeeder.php           # Sample data seeder
├── public/
│   ├── css/
│   │   └── style.css                    # Custom styles with shadows & effects
│   └── images/                          # Product images & logo
├── resources/
│   └── views/
│       ├── layouts/                     # Layout templates
│       ├── auth/                        # Login/Register pages
│       ├── products/                    # Product pages
│       ├── cart/                        # Cart & checkout
│       ├── profile/                     # User settings
│       └── admin/                       # Admin panel views
└── routes/
    └── web.php                          # Application routes
```

## 🛠️ Technology Stack

- **Backend Framework**: Laravel 12.x
- **Frontend**: Blade Templates, Vanilla CSS
- **Database**: MySQL 8.0+
- **Authentication**: Laravel's built-in authentication
- **Styling**: Custom CSS with modern design patterns
- **Image Storage**: Public disk storage

## 🎨 Design Philosophy

Shoplynx follows modern web design principles:
- **Minimalist Black & White Theme** - Professional and clean aesthetic
- **Card-Based Layout** - Product cards with shadows and hover effects
- **Responsive Design** - Works on all device sizes
- **Smooth Animations** - Micro-interactions for better UX
- **Consistent Sizing** - Fixed image dimensions (280px height) for uniform appearance
- **Visual Hierarchy** - Clear separation with borders and shadows

## 📝 Database Schema

### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `role` - User role (user/admin)
- `timestamps`

### Products Table
- `id` - Primary key
- `name` - Product name
- `description` - Product description
- `price` - Product price (decimal)
- `image_path` - Path to product image
- `timestamps`

### Orders Table
- `id` - Primary key
- `user_id` - Foreign key to users
- `customer_name` - Customer full name
- `customer_email` - Customer email
- `customer_phone` - Customer phone (11 digits)
- `status` - Order status (pending/completed)
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

## 🚦 Routes

### Public Routes
- `GET /` - Landing page
- `GET /login` - Login page
- `POST /login` - Process login
- `GET /register` - Registration page
- `POST /register` - Process registration

### Authenticated User Routes
- `GET /home` - User home page
- `GET /products` - Product listing
- `GET /products/{id}` - Product details
- `GET /cart` - Shopping cart
- `GET /checkout` - Checkout page
- `POST /checkout` - Process order
- `GET /profile/settings` - User settings
- `PUT /profile` - Update profile
- `PUT /profile/password` - Change password

### Admin Routes (Requires Admin Role)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/products` - Product management
- `GET /admin/products/create` - Add product form
- `POST /admin/products` - Store new product
- `GET /admin/products/{id}/edit` - Edit product form
- `PUT /admin/products/{id}` - Update product
- `DELETE /admin/products/{id}` - Delete product

## 🐛 Troubleshooting

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

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

## 👨‍💻 Author

Created with ❤️ for educational purposes and demonstration.

## 🙏 Acknowledgments

- Laravel Framework
- Modern CSS Design Patterns
- Open Source Community

---

**⭐ If you find this project helpful, please give it a star!**

Made with Laravel 12 | © 2025 Shoplynx
