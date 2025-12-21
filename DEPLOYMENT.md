# 🚀 TeamBoard Deployment Guide

This guide covers deploying TeamBoard to production environments.

---

## Table of Contents

- [Pre-Deployment Checklist](#pre-deployment-checklist)
- [Server Requirements](#server-requirements)
- [Deployment Options](#deployment-options)
- [Manual Deployment](#manual-deployment)
- [Automated Deployment](#automated-deployment)
- [Post-Deployment](#post-deployment)
- [Maintenance](#maintenance)

---

## Pre-Deployment Checklist

Before deploying to production:

- [ ] All tests pass (`php artisan test`)
- [ ] Code reviewed and approved
- [ ] Database backup created
- [ ] Environment variables configured
- [ ] SSL certificate obtained
- [ ] Domain configured
- [ ] Email service configured
- [ ] Backup strategy in place

---

## Server Requirements

### Minimum Specifications

- **CPU**: 2 cores
- **RAM**: 2GB minimum, 4GB recommended
- **Storage**: 20GB SSD
- **OS**: Ubuntu 20.04+ or CentOS 8+

### Software Requirements

- PHP 8.2+ with extensions:
  - BCMath
  - Ctype
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PDO
  - Tokenizer
  - XML
- MySQL 8.0+
- Nginx or Apache
- Node.js 18+
- Composer 2.x

---

## Deployment Options

### Option 1: Traditional VPS (DigitalOcean, Linode, AWS EC2)
### Option 2: Managed Laravel Hosting (Laravel Forge, Ploi)
### Option 3: Platform as a Service (Heroku, Railway)

---

## Manual Deployment

### Step 1: Server Setup (Ubuntu 22.04)

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.2 and extensions
sudo apt install -y php8.2-fpm php8.2-cli php8.2-mysql php8.2-mbstring \
  php8.2-xml php8.2-curl php8.2-zip php8.2-gd php8.2-bcmath

# Install MySQL
sudo apt install -y mysql-server

# Install Nginx
sudo apt install -y nginx

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
```

### Step 2: Create MySQL Database

```bash
sudo mysql -u root -p
```

```sql
CREATE DATABASE teamboard CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'teamboard'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON teamboard.* TO 'teamboard'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Step 3: Clone and Configure Application

```bash
# Clone repository
cd /var/www
sudo git clone https://github.com/yourusername/TeamBoard.git
cd TeamBoard

# Set permissions
sudo chown -R www-data:www-data /var/www/TeamBoard
sudo chmod -R 755 /var/www/TeamBoard
sudo chmod -R 775 /var/www/TeamBoard/storage
sudo chmod -R 775 /var/www/TeamBoard/bootstrap/cache

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install --production
npm run build

# Configure environment
cp .env.example .env
nano .env
```

### Step 4: Configure Environment (.env)

```env
APP_NAME=TeamBoard
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://teamboard.yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=teamboard
DB_USERNAME=teamboard
DB_PASSWORD=strong_password_here

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@teamboard.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Step 5: Run Migrations and Optimize

```bash
# Generate application key
php artisan key:generate

# Create storage link
php artisan storage:link

# Run migrations
php artisan migrate --force

# Seed initial data (optional)
php artisan db:seed --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 6: Configure Nginx

Create `/etc/nginx/sites-available/teamboard`:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name teamboard.yourdomain.com;
    root /var/www/TeamBoard/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable the site:

```bash
sudo ln -s /etc/nginx/sites-available/teamboard /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### Step 7: Setup SSL with Let's Encrypt

```bash
# Install Certbot
sudo apt install -y certbot python3-certbot-nginx

# Obtain SSL certificate
sudo certbot --nginx -d teamboard.yourdomain.com

# Auto-renewal test
sudo certbot renew --dry-run
```

---

## Automated Deployment

### Using Laravel Forge

1. Connect your server to Forge
2. Create new site
3. Configure repository
4. Set environment variables
5. Enable Quick Deploy
6. Configure deployment script:

```bash
cd /home/forge/teamboard.yourdomain.com

git pull origin main

composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

npm install --production
npm run build

php artisan queue:restart
php artisan cache:clear
```

### Using GitHub Actions

Create `.github/workflows/deploy.yml`:

```yaml
name: Deploy to Production

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v2
    
    - name: Deploy to Server
      uses: appleboy/ssh-action@master
      with:
        host: ${{ secrets.HOST }}
        username: ${{ secrets.USERNAME }}
        key: ${{ secrets.SSH_KEY }}
        script: |
          cd /var/www/TeamBoard
          git pull origin main
          composer install --no-dev --optimize-autoloader
          php artisan migrate --force
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
          npm install --production
          npm run build
```

---

## Post-Deployment

### Verification Checklist

- [ ] Application accessible via domain
- [ ] SSL certificate working
- [ ] Database connections working
- [ ] File uploads working
- [ ] Email notifications working
- [ ] All pages load correctly
- [ ] Authentication working
- [ ] Search functionality working

### Setup Monitoring

```bash
# Install supervisor for queue workers
sudo apt install -y supervisor

# Create supervisor config
sudo nano /etc/supervisor/conf.d/teamboard.conf
```

```ini
[program:teamboard-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/TeamBoard/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/TeamBoard/storage/logs/worker.log
```

```bash
# Start supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start teamboard-worker:*
```

### Setup Scheduled Tasks

```bash
# Edit crontab
sudo crontab -e
```

Add:
```
* * * * * cd /var/www/TeamBoard && php artisan schedule:run >> /dev/null 2>&1
```

### Setup Backups

Create backup script `/usr/local/bin/backup-teamboard.sh`:

```bash
#!/bin/bash

# Configuration
BACKUP_DIR="/backups/teamboard"
DB_NAME="teamboard"
DB_USER="teamboard"
DB_PASS="your_password"
DATE=$(date +%Y%m%d_%H%M%S)

# Create backup directory
mkdir -p $BACKUP_DIR

# Backup database
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_$DATE.sql

# Backup files
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/TeamBoard/storage

# Delete backups older than 30 days
find $BACKUP_DIR -type f -mtime +30 -delete

echo "Backup completed: $DATE"
```

Make executable and schedule:
```bash
sudo chmod +x /usr/local/bin/backup-teamboard.sh
sudo crontab -e
```

Add:
```
0 2 * * * /usr/local/bin/backup-teamboard.sh
```

---

## Maintenance

### Updating Application

```bash
cd /var/www/TeamBoard

# Enable maintenance mode
php artisan down

# Pull latest changes
git pull origin main

# Update dependencies
composer install --no-dev --optimize-autoloader
npm install --production
npm run build

# Run migrations
php artisan migrate --force

# Clear and rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Disable maintenance mode
php artisan up
```

### Monitoring Performance

```bash
# Check application logs
tail -f /var/www/TeamBoard/storage/logs/laravel.log

# Check Nginx logs
tail -f /var/log/nginx/error.log
tail -f /var/log/nginx/access.log

# Check PHP-FPM logs
tail -f /var/log/php8.2-fpm.log

# Monitor resources
htop
```

### Troubleshooting

#### 500 Internal Server Error
```bash
# Check logs
tail -n 50 /var/www/TeamBoard/storage/logs/laravel.log

# Verify permissions
sudo chown -R www-data:www-data /var/www/TeamBoard
sudo chmod -R 755 /var/www/TeamBoard
sudo chmod -R 775 /var/www/TeamBoard/storage
```

#### Database Connection Issues
```bash
# Test MySQL connection
mysql -u teamboard -p teamboard

# Check MySQL status
sudo systemctl status mysql
```

#### Performance Issues
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Security Hardening

### Firewall Configuration

```bash
# Install UFW
sudo apt install -y ufw

# Configure firewall
sudo ufw default deny incoming
sudo ufw default allow outgoing
sudo ufw allow ssh
sudo ufw allow 'Nginx Full'
sudo ufw enable
```

### Fail2ban Setup

```bash
# Install Fail2ban
sudo apt install -y fail2ban

# Configure
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```

### Regular Updates

```bash
# Create update script
sudo nano /usr/local/bin/update-system.sh
```

```bash
#!/bin/bash
apt update
apt upgrade -y
apt autoremove -y
```

Schedule weekly updates:
```bash
sudo crontab -e
```

Add:
```
0 3 * * 0 /usr/local/bin/update-system.sh
```

---

## Support

For deployment issues:
- Check logs in `storage/logs/`
- Review server logs
- Consult [Laravel Deployment Documentation](https://laravel.com/docs/deployment)
- Open an issue on GitHub

---

**Happy Deploying! 🚀**
