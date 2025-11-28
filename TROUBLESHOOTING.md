# Troubleshooting Guide - Shoplynx

This guide provides solutions to common issues you might encounter while setting up or running Shoplynx.

## Table of Contents
1. [Database Issues](#database-issues)
2. [Installation Issues](#installation-issues)
3. [Image Upload Issues](#image-upload-issues)
4. [UI/Display Issues](#uidisplay-issues)
5. [Permission Issues](#permission-issues)
6. [Server Issues](#server-issues)

---

## Database Issues

### Issue: MySQL PDO Driver Not Found

**Error Message**: `could not find driver` or `PDOException`

**Cause**: PHP's MySQL extension is not enabled.

#### Solution 1: Enable MySQL Extension (RECOMMENDED)

**For XAMPP:**
1. Open XAMPP Control Panel
2. Click "Config" button next to "Apache"
3. Select "PHP (php.ini)"
4. Find these lines (around line 900-950):
   ```ini
   ;extension=pdo_mysql
   ;extension=mysqli
   ```
5. Remove the semicolon (;) to uncomment:
   ```ini
   extension=pdo_mysql
   extension=mysqli
   ```
6. Save the file
7. Stop and Start Apache in XAMPP
8. Restart your terminal/command prompt

**Verify:**
```bash
php -m | findstr pdo
```
You should see: `pdo_mysql`

#### Solution 2: Use SQLite (Temporary)

If you can't modify php.ini, use SQLite for testing:

1. Update `.env`:
   ```env
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
   # Windows
   type nul > database/database.sqlite
   
   # Linux/Mac
   touch database/database.sqlite
   ```

3. Run migrations:
   ```bash
   php artisan migrate:fresh --seed
   ```

### Issue: Access Denied for User

**Error Message**: `Access denied for user 'root'@'localhost'`

**Solution:**
1. Check your MySQL credentials in `.env`
2. Verify MySQL is running in XAMPP
3. Try default XAMPP credentials:
   ```env
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. If you set a password, update `DB_PASSWORD` accordingly

### Issue: Database Does Not Exist

**Error Message**: `Unknown database 'shoplynx'`

**Solution:**
1. Create the database manually:
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Click "New" in the left sidebar
   - Enter database name: `shoplynx`
   - Click "Create"

2. Or use MySQL CLI:
   ```sql
   CREATE DATABASE shoplynx;
   ```

---

## Installation Issues

### Issue: Composer Install Fails

**Error Message**: Various composer errors

**Solutions:**

1. **Update Composer:**
   ```bash
   composer self-update
   ```

2. **Clear Composer Cache:**
   ```bash
   composer clear-cache
   composer install
   ```

3. **Increase Memory Limit:**
   ```bash
   php -d memory_limit=-1 composer install
   ```

### Issue: Application Key Not Set

**Error Message**: `No application encryption key has been specified`

**Solution:**
```bash
php artisan key:generate
```

### Issue: Class Not Found

**Error Message**: `Class 'App\...' not found`

**Solution:**
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

---

## Image Upload Issues

### Issue: Images Not Displaying

**Cause**: Storage link not created

**Solution:**
```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public`.

### Issue: Image Upload Fails

**Possible Causes and Solutions:**

1. **File Size Too Large:**
   - Check `php.ini` settings:
     ```ini
     upload_max_filesize = 10M
     post_max_size = 10M
     ```
   - Restart Apache after changes

2. **Storage Directory Not Writable:**
   ```bash
   # Windows (run as Administrator)
   icacls storage /grant Users:F /T
   
   # Linux/Mac
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

3. **Invalid File Type:**
   - Ensure you're uploading: JPEG, PNG, JPG, or GIF
   - Check file extension

---

## UI/Display Issues

### Issue: Pagination Arrows Too Large

**Cause**: Missing Bootstrap 5 pagination configuration

**Solution:**
This has been fixed in version 1.5.0. If you still see this issue:

1. Verify `app/Providers/AppServiceProvider.php` contains:
   ```php
   use Illuminate\Pagination\Paginator;
   
   public function boot(): void
   {
       Paginator::useBootstrapFive();
   }
   ```

2. Clear cache:
   ```bash
   php artisan config:clear
   php artisan view:clear
   ```

### Issue: CSS Not Loading

**Solutions:**

1. **Clear Browser Cache:**
   - Press `Ctrl + Shift + R` (Windows/Linux)
   - Press `Cmd + Shift + R` (Mac)

2. **Clear Laravel Cache:**
   ```bash
   php artisan view:clear
   php artisan cache:clear
   ```

3. **Check File Path:**
   - Verify `public/css/style.css` exists
   - Check browser console for 404 errors

### Issue: Product Images Not Sized Correctly

**Solution:**
- Images should be 280px height (automatic)
- If issues persist, check `public/css/style.css` for `.product-image` styles

---

## Permission Issues

### Issue: Permission Denied (Linux/Mac)

**Error Message**: `Permission denied` when accessing storage or cache

**Solution:**
```bash
# Set correct permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set correct ownership (replace 'www-data' with your web server user)
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
```

### Issue: Cannot Write to Log File

**Solution:**
```bash
# Windows (run as Administrator)
icacls storage\logs /grant Users:F /T

# Linux/Mac
chmod -R 775 storage/logs
```

---

## Server Issues

### Issue: Port 8000 Already in Use

**Error Message**: `Address already in use`

**Solutions:**

1. **Use Different Port:**
   ```bash
   php artisan serve --port=8080
   ```

2. **Find and Kill Process Using Port 8000:**
   ```bash
   # Windows
   netstat -ano | findstr :8000
   taskkill /PID <PID> /F
   
   # Linux/Mac
   lsof -ti:8000 | xargs kill -9
   ```

### Issue: 404 Not Found on Routes

**Solutions:**

1. **Clear Route Cache:**
   ```bash
   php artisan route:clear
   php artisan route:cache
   ```

2. **Check .htaccess (if using Apache):**
   - Ensure `.htaccess` exists in `public/` directory
   - Verify mod_rewrite is enabled

### Issue: CSRF Token Mismatch

**Error Message**: `419 | Page Expired`

**Solutions:**

1. **Clear Cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. **Check Session Configuration:**
   - Verify `SESSION_DRIVER` in `.env` (default: `database`)
   - If using database sessions, run:
     ```bash
     php artisan session:table
     php artisan migrate
     ```

---

## After Fixing Issues

Always run these commands to clear all caches:

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

---

## Still Having Issues?

If you're still experiencing problems:

1. **Check Laravel Logs:**
   - Location: `storage/logs/laravel.log`
   - Look for recent error messages

2. **Enable Debug Mode:**
   - Set `APP_DEBUG=true` in `.env`
   - **Important**: Set back to `false` in production!

3. **Check PHP Version:**
   ```bash
   php -v
   ```
   - Ensure PHP >= 8.2

4. **Verify All Extensions:**
   ```bash
   php -m
   ```
   - Required: pdo_mysql, mysqli, mbstring, xml, curl

5. **Fresh Installation:**
   If all else fails, try a fresh installation:
   ```bash
   php artisan migrate:fresh --seed
   ```
   **Warning**: This will delete all data!

---

## Common Development Tips

### Resetting the Application

To completely reset the application:

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Reset database
php artisan migrate:fresh --seed

# Recreate storage link
php artisan storage:link

# Restart server
php artisan serve
```

### Checking System Requirements

```bash
# PHP version
php -v

# Installed extensions
php -m

# Composer version
composer --version

# MySQL version
mysql --version
```

---

**Need More Help?**

- Check the [README.md](README.md) for installation instructions
- Review the [CHANGELOG.md](CHANGELOG.md) for recent changes
- Consult the [Laravel Documentation](https://laravel.com/docs)

---

Last Updated: November 28, 2025
