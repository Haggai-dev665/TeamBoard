# 🚀 TeamBoard Installation Guide

## Quick Start Guide

This guide will help you set up TeamBoard on your local machine or server.

---

## Prerequisites

Before you begin, ensure you have the following installed:

### Required Software

```bash
# Check PHP version (must be 8.2 or higher)
php --version

# Check Composer
composer --version

# Check Node.js (must be 18.x or higher)
node --version

# Check NPM
npm --version

# Check MySQL
mysql --version
```

If any of these are missing, please install them first:

- **PHP 8.2+**: [Download PHP](https://www.php.net/downloads)
- **Composer**: [Download Composer](https://getcomposer.org/download/)
- **Node.js & NPM**: [Download Node.js](https://nodejs.org/)
- **MySQL 8.0+**: [Download MySQL](https://dev.mysql.com/downloads/)

---

## Installation Steps

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/TeamBoard.git
cd TeamBoard
```

### Step 2: Install Dependencies

#### PHP Dependencies
```bash
composer install
```

If you encounter memory issues:
```bash
php -d memory_limit=-1 /usr/local/bin/composer install
```

#### JavaScript Dependencies
```bash
npm install
```

### Step 3: Environment Configuration

#### Copy Environment File
```bash
cp .env.example .env
```

#### Generate Application Key
```bash
php artisan key:generate
```

#### Configure Database

Edit the `.env` file and update these values:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=teamboard
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Step 4: Create Database

#### Using MySQL Command Line
```bash
mysql -u root -p
```

Then in MySQL:
```sql
CREATE DATABASE teamboard CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

#### Using phpMyAdmin
1. Open phpMyAdmin
2. Click "New" in the left sidebar
3. Enter "teamboard" as database name
4. Select "utf8mb4_unicode_ci" as collation
5. Click "Create"

### Step 5: Run Migrations

```bash
php artisan migrate
```

This will create all necessary tables in your database.

### Step 6: Seed Database (Optional but Recommended)

```bash
php artisan db:seed
```

This creates:
- **Admin account**: admin@teamboard.com / password
- **Test users**: john@teamboard.com / password
- 20 sample employees
- 8 sample notices
- 8 sample documents

### Step 7: Create Storage Link

```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public`.

### Step 8: Build Frontend Assets

#### For Development
```bash
npm run dev
```

Keep this running in a separate terminal window.

#### For Production
```bash
npm run build
```

### Step 9: Start Development Server

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

---

## Default Login Credentials

After seeding, you can use these credentials:

### Admin Account
- **Email**: admin@teamboard.com
- **Password**: password

### User Account
- **Email**: john@teamboard.com
- **Password**: password

---

## Troubleshooting

### Issue: "Class not found" errors

**Solution**: Run composer dump-autoload
```bash
composer dump-autoload
```

### Issue: Permission denied on storage or cache directories

**Solution**: Set proper permissions
```bash
chmod -R 775 storage bootstrap/cache
```

On Linux/Mac, you might need:
```bash
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Issue: Vite manifest not found

**Solution**: Build assets
```bash
npm run build
```

### Issue: Database connection refused

**Solution**: Check if MySQL is running
```bash
# On Mac
brew services start mysql

# On Linux
sudo systemctl start mysql

# On Windows
net start MySQL
```

### Issue: Migration fails

**Solution**: Reset database
```bash
php artisan migrate:fresh --seed
```

⚠️ **Warning**: This will delete all existing data!

---

## Optimization (Production)

When deploying to production, run these commands:

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Build production assets
npm run build
```

---

## Updating the Application

To update to the latest version:

```bash
# Pull latest changes
git pull origin main

# Update dependencies
composer install
npm install

# Run migrations
php artisan migrate

# Clear and rebuild caches
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Rebuild assets
npm run build
```

---

## Uninstallation

To completely remove TeamBoard:

```bash
# Drop database
mysql -u root -p -e "DROP DATABASE teamboard;"

# Remove application files
cd ..
rm -rf TeamBoard
```

---

## Next Steps

After installation:

1. ✅ Change default passwords
2. ✅ Configure email settings in `.env`
3. ✅ Set up proper backups
4. ✅ Configure your web server (Nginx/Apache)
5. ✅ Enable HTTPS
6. ✅ Review security settings

---

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [TeamBoard GitHub Repository](https://github.com/yourusername/TeamBoard)

---

## Support

If you encounter issues:

1. Check the [Troubleshooting](#troubleshooting) section
2. Search existing [GitHub Issues](https://github.com/yourusername/TeamBoard/issues)
3. Create a new issue with detailed information

---

## License

This project is open-source software licensed under the MIT license.
