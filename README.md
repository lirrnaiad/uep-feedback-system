# UEP Feedback System

A feedback collection system for University of Eastern Philippines developed as a school project.

## What it does

This web app lets clients submit feedback about university services. It has a public form where anyone can submit feedback, and an admin panel where staff can view and analyze all the feedback data.

## Features

- Multi-step feedback form
- Admin dashboard with charts
- Filter and search feedback entries
- Export data to CSV
- Analytics and reports

## How to setup

### 1. Install stuff
```bash
composer install
npm install
```

### 2. Setup database
Create a database in MySQL/MariaDB:
```bash
sudo mariadb
CREATE DATABASE uep_feedback;
EXIT;
```

Create database user:
```sql
CREATE USER 'uep_user'@'localhost' IDENTIFIED BY 'uep_password_123';
GRANT ALL PRIVILEGES ON uep_feedback.* TO 'uep_user'@'localhost';
FLUSH PRIVILEGES;
```

### 3. Configure .env
Update your `.env` file:
```
DB_CONNECTION=mysql
DB_DATABASE=uep_feedback
DB_USERNAME=uep_user
DB_PASSWORD=uep_password_123

ADMIN_PASSWORD=admin123
```

### 4. Run migrations
```bash
php artisan migrate
php artisan db:seed --class=QuestionSeeder
```

### 5. Start the app
Open two terminals:
```bash
npm run dev          # Terminal 1 - frontend
php artisan serve    # Terminal 2 - backend
```

## How to use

**Public Form:** http://localhost:8000/feedback
- Fill out the 3-step form
- Submit feedback

**Admin Panel:** http://localhost:8000/admin/login
- Password: admin123 (change in .env)
- View dashboard
- Check analytics
- Filter entries
- Export to CSV

## Tech Stack

- Laravel 11
- Tailwind CSS
- MySQL/MariaDB
- Chart.js
- Alpine.js

## Requirements

- PHP 8.1 or higher
- MySQL/MariaDB
- Composer
- Node.js & npm

## Notes

- Change the admin password before deploying!
- Make sure both npm and php artisan are running
- Charts need internet connection for Chart.js CDN

## Team

- Pinca, Paolo Leandro L.
- Fabia, Sean Ivan M.
- Ordonia, Marl June S.
- Balat, Khristher John B.
- Quitorio, Adielyn P.

## License

Made for academic purposes.
