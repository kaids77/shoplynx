# Quick Fix Instructions

## Issue: MySQL PDO Driver Not Found

The error "could not find driver" means PHP's MySQL extension is not enabled.

## Solution 1: Enable MySQL Extension (RECOMMENDED)

### For XAMPP:
1. Open XAMPP Control Panel
2. Click "Config" button next to "Apache"
3. Select "PHP (php.ini)"
4. Find these lines (around line 900-950):
   ```
   ;extension=pdo_mysql
   ;extension=mysqli
   ```
5. Remove the semicolon (;) to uncomment:
   ```
   extension=pdo_mysql
   extension=mysqli
   ```
6. Save the file
7. Stop and Start Apache in XAMPP
8. Restart your terminal/command prompt

### Verify:
```bash
php -m | findstr pdo
```
You should see: pdo_mysql

## Solution 2: Use SQLite (Temporary)

If you can't modify php.ini, use SQLite for testing:

1. Update `.env`:
   ```
   DB_CONNECTION=sqlite
   # Comment out these lines:
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=shoplynx
   # DB_USERNAME=root
   # DB_PASSWORD=
   ```

2. Create database file:
   ```bash
   touch database/database.sqlite
   ```
   Or on Windows:
   ```bash
   type nul > database/database.sqlite
   ```

3. Run migrations:
   ```bash
   php artisan migrate:fresh --seed
   ```

## After Fixing:

Run these commands to clear cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

Then restart the server:
```bash
php artisan serve
```
