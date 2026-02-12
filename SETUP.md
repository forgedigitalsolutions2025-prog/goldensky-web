# Setup Guide - Golden Sky Hotel & Wellness Web Application

## Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 8.0+
- Node.js and NPM (optional, for asset compilation)

## Installation Steps

### 1. Install Dependencies

```bash
cd "Web application"
composer install
```

### 2. Environment Configuration

Copy the example environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 3. Configure Database

Edit `.env` file and update database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotel_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**Note:** This application uses the same database as the other hotel management applications. Make sure the database already exists with the schema from the backend project.

### 4. Run Migrations

Create the necessary tables for the web application:

```bash
php artisan migrate
```

**Important:** The `rooms`, `bookings`, `guests`, and `menu_items` tables should already exist from the main database schema. The migrations will only create:
- `users` table (for web application users)
- `password_reset_tokens` table
- `sessions` table

### 5. Configure Mail Settings

For email verification to work, configure mail settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your_email@example.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@goldenskyhotel.com
MAIL_FROM_NAME="Golden Sky Hotel & Wellness"
```

### 6. Set Permissions (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 7. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Security Features Implemented

✅ **CSRF Protection**: All forms are protected with CSRF tokens
✅ **Input Validation**: Comprehensive validation on all user inputs
✅ **Password Hashing**: Bcrypt password hashing (default Laravel)
✅ **Admin Middleware**: Role-based access control for admin routes
✅ **SQL Injection Protection**: All queries use Eloquent ORM
✅ **Double Booking Prevention**: Database transactions with row-level locking
✅ **File Upload Sanitization**: Helper class for secure file uploads
✅ **Email Verification**: Required for user authentication

## Features

- **View Rooms**: Browse available hotel rooms
- **Online Booking**: Book rooms with double-booking prevention
- **Menu Viewing**: View restaurant menu (without prices)
- **User Authentication**: Register and login with email verification
- **Responsive Design**: Mobile-friendly Tailwind CSS design

## Default Routes

- `/` - Home page
- `/rooms` - View rooms
- `/rooms/{id}` - Room details
- `/bookings/create` - Create booking
- `/bookings/success/{bookingId}` - Booking confirmation
- `/menu` - View menu
- `/login` - Login
- `/register` - Register
- `/email/verify` - Email verification

## Troubleshooting

### Database Connection Issues

If you encounter database connection errors:
1. Verify database credentials in `.env`
2. Ensure MySQL server is running
3. Check that the database `hotel_db` exists
4. Verify user has proper permissions

### Email Verification Not Working

1. Check mail configuration in `.env`
2. Test mail settings using `php artisan tinker`:
   ```php
   Mail::raw('Test', function($msg) { $msg->to('test@example.com')->subject('Test'); });
   ```

### Icon Not Showing

Ensure `icon.png` is in the `public` directory:
```bash
ls -la public/icon.png
```

## Production Deployment

For production deployment:

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Run `php artisan config:cache` and `php artisan route:cache`
3. Set up proper web server (Apache/Nginx) configuration
4. Configure SSL certificate
5. Set up proper file permissions
6. Configure queue workers if using queues
7. Set up scheduled tasks with cron

## Support

For issues or questions, refer to the main project documentation.



















































































