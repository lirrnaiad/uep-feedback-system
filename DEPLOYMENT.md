# Deployment Guide - DigitalOcean

## Complete Deployment Guide (From Scratch)

### Step 1: Prepare Your Project

First, make sure your project is ready:

```bash
cd /home/lirrnaiad/Documents/VSCode/uep-feedback-system

# Build production assets
npm run build

# Make sure .env is configured
# Check that ADMIN_PASSWORD is set to something secure
```

### Step 2: Push to GitHub (if not done yet)

```bash
# Initialize git if needed
git init
git add .
git commit -m "UEP Feedback System - Production Ready"
git branch -M main

# Create a new repo on GitHub, then:
git remote add origin https://github.com/YOUR_USERNAME/uep-feedback-system.git
git push -u origin main
```

### Step 3: Export Your Local Database (OPTIONAL)

If you want to keep your current 2000 test entries:

```bash
# Export database
mysqldump -u uep_user -p uep_feedback > database_backup.sql

# Upload this file to a temporary location (GitHub Gist, Dropbox, etc.)
```

**OR skip this and just re-seed on production** (easier!)

### Step 4: Create DigitalOcean App

1. **Login to DigitalOcean** (https://cloud.digitalocean.com)
2. Click **"Create"** → **"Apps"**
3. Click **"Create App"**
4. Choose **"GitHub"** as source
5. Authorize DigitalOcean to access your GitHub
6. Select your repository: `uep-feedback-system`
7. Select branch: `main`
8. Click **"Next"**

### Step 5: Configure Your App

**Environment Variables:**
Click "Edit" next to your app component, then add these:

```
APP_NAME=UEP_Feedback_System
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:PuuAq/KFhNYu6YDw/wZaRBhtGA2x8Tn7Cs6h3hroGr0=
APP_URL=${APP_URL}

ADMIN_PASSWORD=YourSecurePasswordHere

LOG_CHANNEL=stack
LOG_LEVEL=error

SESSION_DRIVER=database
SESSION_LIFETIME=120

DB_CONNECTION=mysql
DB_HOST=${db.HOSTNAME}
DB_PORT=${db.PORT}
DB_DATABASE=${db.DATABASE}
DB_USERNAME=${db.USERNAME}
DB_PASSWORD=${db.PASSWORD}
```

**Build Command:**
```bash
npm install && npm run build && composer install --optimize-autoloader --no-dev
```

**Run Command:**
```bash
heroku-php-apache2 public/
```

Click **"Next"**

### Step 6: Add MySQL Database

1. Click **"Add Resource"** → **"Database"**
2. Select **"MySQL"**
3. Choose **"Basic"** plan ($7/month - free with student credits!)
4. Name it: `uep-feedback-db`
5. Select same region as your app (Singapore is closest to PH)
6. Click **"Add Database"**

The database will be automatically linked to your app via `${db.*}` variables.

Click **"Next"**, then **"Create Resources"**

### Step 7: Wait for Deployment

Your app will start building (takes 3-5 minutes). Watch the build logs.

### Step 8: Run Database Setup

Once deployed, click on your app, then go to **"Console"** tab:

**Option A: Re-seed data (Recommended)**
```bash
php artisan migrate --force
php artisan db:seed --class=QuestionSeeder
php artisan db:seed --class=FeedbackTestDataSeeder
```

**Option B: Import your local database**
```bash
# First run migrations
php artisan migrate --force

# Then import your backup (if you uploaded it somewhere)
mysql -h ${db.HOSTNAME} -u ${db.USERNAME} -p${db.PASSWORD} ${db.DATABASE} < /path/to/database_backup.sql
```

### Step 9: Test Your App

Your app URL will be something like: `https://uep-feedback-system-xxxxx.ondigitalocean.app`

Test these URLs:
- `/feedback` - Public form
- `/admin/login` - Admin panel (use your ADMIN_PASSWORD)

### Step 10: Final Touches

**Update Production Settings:**
1. Go to Settings → Environment Variables
2. Make sure `APP_DEBUG=false`
3. Set a strong `ADMIN_PASSWORD`
4. Update `APP_URL` to your actual app URL

**Enable Auto-Deploy:**
Settings → Auto-Deploy → Enable (so it updates when you push to GitHub)

## Quick Setup (Recommended for Students)

### 1. Push Code to GitHub

```bash
git init
git add .
git commit -m "UEP Feedback System - ready for deployment"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/uep-feedback-system.git
git push -u origin main
```

### 2. Create DigitalOcean App

1. Login to DigitalOcean
2. Go to Apps section
3. Click "Create App"
4. Connect your GitHub repository
5. Select `uep-feedback-system`
6. Choose Singapore region (closest to PH)

### 3. Configure Environment

Add these in the Environment Variables section:

```
APP_NAME=UEP Feedback System
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:PuuAq/KFhNYu6YDw/wZaRBhtGA2x8Tn7Cs6h3hroGr0=
ADMIN_PASSWORD=change_this_password

DB_CONNECTION=mysql
DB_HOST=${db.HOSTNAME}
DB_PORT=${db.PORT}
DB_DATABASE=${db.DATABASE}
DB_USERNAME=${db.USERNAME}
DB_PASSWORD=${db.PASSWORD}
```

### 4. Add MySQL Database

- Click "Add Database"
- Select MySQL
- Choose Basic plan
- Name it `uep-feedback-db`

### 5. Run Migrations

After deployment, open the Console tab and run:

```bash
php artisan migrate --force
php artisan db:seed --class=QuestionSeeder
php artisan db:seed --class=FeedbackTestDataSeeder
```

### 6. Access Your App

Your app will be at: `https://your-app-name.ondigitalocean.app`

- Public form: `/feedback`
- Admin panel: `/admin/login`

## Alternative: Manual VPS Deployment

If you prefer full control with a Droplet:

### Server Setup

```bash
# After creating Ubuntu droplet and SSH in
apt update && apt upgrade -y

# Install LAMP stack
apt install -y php8.3-fpm php8.3-mysql php8.3-mbstring php8.3-xml \
    php8.3-curl php8.3-zip nginx mysql-server git curl unzip nodejs npm

# Install Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

### Database Setup

```bash
mysql -u root -p

CREATE DATABASE uep_feedback;
CREATE USER 'uep_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT ALL ON uep_feedback.* TO 'uep_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Deploy Code

```bash
cd /var/www
git clone YOUR_REPO_URL uep-feedback-system
cd uep-feedback-system

composer install --no-dev --optimize-autoloader
npm install && npm run build

cp .env.example .env
nano .env  # Update DB credentials

php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=QuestionSeeder
php artisan optimize
```

### Nginx Config

Create `/etc/nginx/sites-available/uep-feedback`:

```nginx
server {
    listen 80;
    server_name YOUR_IP_OR_DOMAIN;
    root /var/www/uep-feedback-system/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

Enable and restart:
```bash
ln -s /etc/nginx/sites-available/uep-feedback /etc/nginx/sites-enabled/
nginx -t
systemctl restart nginx
```

## For Submission

Create a document with:
- Your deployed URL
- Admin password
- Database: "Seeded with 2000 test entries"
- GitHub repository link
- Screenshots of the working system

Good luck with your submission!
