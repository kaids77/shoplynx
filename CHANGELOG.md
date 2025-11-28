# Changelog

All notable changes to the Shoplynx E-Commerce Platform will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.5.0] - 2025-11-28

### Added
- **Admin Order Management System**
  - Admin panel for viewing all orders
  - Manual order status updates (Pending, Shipped, Completed, Cancelled)
  - Automatic transaction description updates when order status changes
  - Stock restoration when orders are cancelled by admin
  - Orders link in admin navigation menu

### Changed
- **Removed Automated Order Status System**
  - Removed automatic timer-based status transitions
  - Removed countdown timers from user order view
  - Simplified order cancellation to status-based only (no time restrictions)
  - Removed `UpdateOrderStatuses` command scheduler

### Fixed
- **Pagination Display Issues**
  - Configured Bootstrap 5 pagination in `AppServiceProvider`
  - Fixed oversized SVG arrows in pagination
  - Added custom pagination CSS for consistent styling
  - Pagination now displays properly across all pages

- **Transaction History UI**
  - Removed duplicate success notifications
  - Removed transaction type and status badges
  - Added color-coded descriptions (green for Completed, red for Cancelled)
  - Cleaner, more focused transaction display

- **Transaction Status Updates**
  - Fixed transaction description not updating when order status changed to Pending
  - Transaction descriptions now correctly reflect all order status changes

## [1.4.0] - 2025-11-27

### Added
- **Product Search Functionality**
  - Search bar in navigation
  - Search by product name or description
  - Display search results count
  - "No products found" message for empty results

### Changed
- Product listing now supports search queries
- Updated `ProductController` to handle search filtering

## [1.3.0] - 2025-11-26

### Added
- **Stock Management System**
  - Stock quantity field for products
  - Real-time stock display on product cards
  - Out-of-stock badges and indicators
  - Disabled "Add to Cart" button for out-of-stock items
  - Stock quantity validation in admin panel
  - Stock restoration on order cancellation

- **Transaction System**
  - Transaction model and database table
  - Automatic transaction creation on order placement
  - Transaction history page with filtering
  - Filter by transaction type, status, and date range
  - Transaction statistics (Total Spent, Total Transactions)
  - Removed Pending Amount and Total Refunded stats

- **Order Cancellation**
  - Users can cancel pending orders
  - Automatic stock restoration when orders are cancelled
  - Transaction description updates to "Cancelled"
  - Time-based cancellation window (2 minutes = 2 days simulation)

### Changed
- **Checkout Security Enhancement**
  - Customer name and email now read-only at checkout
  - Data sourced from authenticated user profile
  - Server-side validation prevents data tampering

- **Home Page Design**
  - Reverted to original product card layout
  - Image displayed above product details
  - Improved visual hierarchy

### Fixed
- Product creation and editing forms restored with all fields
- Cart view displays stock quantity for each item
- Checkout form properly displays user information

## [1.2.0] - 2025-11-25

### Added
- **User Profile Management**
  - Profile settings page
  - Update name and email
  - Change password functionality
  - Upload and update profile image
  - Form validation for all profile updates

- **Customer Management (Admin)**
  - View all registered customers
  - Display customer details (name, email, phone, address)
  - Customer count in admin dashboard

### Changed
- Enhanced user navigation with Settings link
- Improved admin dashboard statistics

## [1.1.0] - 2025-11-24

### Added
- **Order Management System**
  - Order history page for users
  - Track order status (Pending, Completed)
  - View order details (items, total, customer info)
  - Order creation on checkout
  - Order items relationship

- **Admin Dashboard Enhancements**
  - Recent orders display (last 10 orders)
  - Order statistics
  - Customer information in order view

### Changed
- Improved checkout flow with order creation
- Enhanced cart functionality

## [1.0.0] - 2025-11-23

### Added
- **Initial Release**
- User authentication (registration and login)
- Role-based access control (User/Admin)
- Product browsing and display
- Shopping cart functionality
- Checkout system with multiple payment methods
- Admin dashboard with statistics
- Product management (CRUD operations)
- Image upload for products
- Responsive design with modern UI
- Security features (CSRF, password hashing, middleware)
- Prevent back-history after logout

### Features
- Landing page with company overview
- Product cards with shadows and hover effects
- Cart badge showing item count
- Admin product management
- User profile display
- Session management
- Clean, minimalist black & white theme

---

## Version History Summary

- **v1.5.0** - Admin order management, removed automation, fixed pagination
- **v1.4.0** - Product search functionality
- **v1.3.0** - Stock management, transactions, order cancellation
- **v1.2.0** - User profiles, customer management
- **v1.1.0** - Order system, admin dashboard enhancements
- **v1.0.0** - Initial release with core e-commerce features

---

**Note**: This changelog tracks changes specific to the Shoplynx application. For Laravel framework changes, see the official Laravel changelog.
