# Shadhara Wellness Website

A complete Laravel-based website for Shadhara Wellness - an Ayurvedic spa and wellness center in Kandy, Sri Lanka.

## Features

- **Home Page** with hero slider, services showcase, testimonials, and appointment booking
- **About Us** page with company information and statistics
- **Treatments** page displaying all Ayurvedic treatments
- **Pricing** page with treatment prices and special offers
- **Contact** page with contact form and booking system
- **Newsletter** subscription functionality
- **Booking System** with 20% discount feature
- **Responsive Design** for all devices
- **Modern UI** matching the original website design

## Requirements

- PHP >= 8.1
- Composer
- MySQL >= 5.7 or MariaDB >= 10.3
- Node.js and NPM (for asset compilation)
- Web server (Apache/Nginx) or PHP built-in server

## Installation

### 1. Clone or Download the Project

```bash
cd "d:\sharadha wellness"
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
copy .env.example .env
```

Or on Linux/Mac:
```bash
cp .env.example .env
```

Edit the `.env` file and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shadhara_wellness
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Create Database

Create a MySQL database named `shadhara_wellness` (or your preferred name).

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Seed Database

```bash
php artisan db:seed
```

This will populate the database with:
- 8 Ayurvedic treatments
- 3 sample testimonials

### 9. Create Storage Link

```bash
php artisan storage:link
```

### 10. Build Assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

### 11. Start Development Server

```bash
php artisan serve
```

The website will be available at `http://localhost:8000`

## Image Setup

You need to add images to the following directories:

1. **Logo**: `public/images/logo.png`
2. **Hero Images**: 
   - `public/images/hero_bg_1_21.jpg`
   - `public/images/hero_bg_1_12.jpg`
3. **Treatment Images**: `public/images/treatments/`
   - `service_1_1.jpg` (Body Massage)
   - `service_4_1.jpg` (Steam Bath)
   - `service_4_2.jpg` (Facial Treatment)
   - `service_1_3.jpg` (Head Massage)
   - `service_3_3.jpg` (Shirodhara)
   - `service_1_7.jpg` (Herbal Bath)
4. **Testimonial Images**: `public/images/testimonials/`
   - `testi_1_2.jpg`
   - `testi_1_3.jpg`
5. **About Page**: `public/images/girl.jpg`

You can download images from the original website: https://shadharawellness.com/

## Project Structure

```
sharadha wellness/
├── app/
│   ├── Http/
│   │   └── Controllers/     # All controllers
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── public/
│   ├── images/              # Images directory
│   └── index.php            # Entry point
├── resources/
│   ├── css/
│   │   └── app.css          # Main stylesheet
│   ├── js/
│   │   └── app.js           # Main JavaScript
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php # Main layout
│       ├── home.blade.php    # Home page
│       ├── about.blade.php   # About page
│       ├── treatments.blade.php
│       ├── pricing.blade.php
│       └── contact.blade.php
└── routes/
    └── web.php              # Web routes
```

## Database Tables

- `treatments` - Ayurvedic treatment information
- `bookings` - Customer booking requests
- `contacts` - Contact form submissions
- `newsletters` - Newsletter subscribers
- `testimonials` - Customer testimonials

## Features Overview

### Booking System
- Customers can book appointments with 20% discount
- Support for couple packages
- Treatment selection
- Date and time selection
- Form validation

### Newsletter
- Email subscription
- Prevents duplicate subscriptions
- Success/error messages

### Contact Form
- Name, email, phone, subject, message fields
- Form validation
- Success notifications

## Customization

### Adding New Treatments

1. Add treatment to database via seeder or admin panel
2. Upload treatment image to `public/images/treatments/`
3. Treatment will automatically appear on treatments and pricing pages

### Modifying Colors

Edit CSS variables in `resources/css/app.css`:

```css
:root {
    --primary-color: #FFD700;
    --secondary-color: #FDB931;
    --dark-gold: #B8860B;
}
```

## Production Deployment

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Run `php artisan view:cache`
6. Build assets: `npm run build`
7. Configure web server to point to `public/` directory

## Support

For issues or questions, please contact:
- Email: reservations@goldenskyhotelandwellness.com
- Phone: +94 71 483 1035

## License

This project is proprietary software for Shadhara Wellness.

## Credits

- Web Solution By Avex Digital Solutions
- Original Design: https://shadharawellness.com/





