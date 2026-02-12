# Golden Sky Hotel & Wellness - Web Application

A Laravel-based web application for Golden Sky Hotel & Wellness, featuring online room booking, menu viewing, and user authentication.

## Features

- **View Rooms**: Browse available hotel rooms with detailed information
- **Online Booking**: Book rooms directly through the website with double-booking prevention
- **Menu Viewing**: View restaurant menu items (without prices)
- **User Authentication**: Secure registration and login with email verification
- **Security Features**:
  - CSRF protection
  - Input validation on all forms
  - Bcrypt password hashing
  - Admin middleware for protected routes
  - SQL injection protection through Eloquent ORM
  - Double booking prevention
  - Sanitized file uploads
  - Email verification

## Technology Stack

- **Laravel 10**: PHP framework
- **Tailwind CSS**: Utility-first CSS framework
- **MySQL**: Database (shared with other hotel applications)
- **Bcrypt**: Password hashing

## Installation

1. **Install Dependencies**:
   ```bash
   composer install
   ```

2. **Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configure Database**:
   Update `.env` with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=hotel_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

5. **Configure Mail** (for email verification):
   Update `.env` with your mail settings:
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.example.com
   MAIL_PORT=587
   MAIL_USERNAME=your_email@example.com
   MAIL_PASSWORD=your_password
   MAIL_FROM_ADDRESS=noreply@goldenskyhotel.com
   MAIL_FROM_NAME="Golden Sky Hotel & Wellness"
   ```

6. **Start Development Server**:
   ```bash
   php artisan serve
   ```

## Database

This application uses the same MySQL database as the other hotel management applications. The database schema is defined in the backend project's `schema.sql` file.

## Security Features

### CSRF Protection
All forms are protected with CSRF tokens automatically by Laravel.

### Input Validation
All user inputs are validated using Laravel's validation rules:
- Required fields
- Email format validation
- Date validation
- Number ranges
- String length limits

### Password Hashing
Passwords are automatically hashed using Bcrypt (default Laravel hashing).

### Admin Middleware
Protected routes use the `admin` middleware to ensure only admin users can access them.

### SQL Injection Protection
All database queries use Eloquent ORM, which automatically protects against SQL injection.

### Double Booking Prevention
The booking system uses database transactions and row-level locking to prevent double bookings:
- Checks for overlapping bookings before creating a new one
- Uses `lockForUpdate()` to prevent race conditions
- Validates room availability in real-time

### File Upload Sanitization
File uploads are sanitized using the `FileUploadHelper` class:
- Validates file size
- Validates MIME types
- Sanitizes filenames
- Stores files securely

### Email Verification
Users must verify their email address before accessing authenticated features.

## Routes

- `/` - Home page
- `/rooms` - View available rooms
- `/rooms/{id}` - Room details
- `/bookings/create` - Create a booking
- `/bookings/success/{bookingId}` - Booking confirmation
- `/menu` - View menu
- `/login` - Login page
- `/register` - Registration page
- `/email/verify` - Email verification

## Theme

The application uses a gold and white color scheme:
- Primary Gold: `#FFD700`
- Dark Gold: `#B8860B`
- Light Gold: `#FDB931`
- White background with gold accents

## Logo

The application logo is located at `public/icon.png`.

## License

Proprietary - Golden Sky Hotel & Wellness



















































































