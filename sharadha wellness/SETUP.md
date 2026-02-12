# Quick Setup Guide

## Step-by-Step Installation

### 1. Install Composer Dependencies
```bash
composer install
```

### 2. Install NPM Dependencies
```bash
npm install
```

### 3. Configure Environment
```bash
# Windows
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

Edit `.env` file and set your database credentials:
```
DB_DATABASE=shadhara_wellness
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Create Database
Create a MySQL database:
```sql
CREATE DATABASE shadhara_wellness;
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Seed Database
```bash
php artisan db:seed
```

### 8. Create Storage Link
```bash
php artisan storage:link
```

### 9. Build Assets
```bash
npm run dev
```

Or for production:
```bash
npm run build
```

### 10. Start Server
```bash
php artisan serve
```

Visit: http://localhost:8000

## Image Setup

Create these directories and add images:

```
public/
└── images/
    ├── logo.png
    ├── hero_bg_1_21.jpg
    ├── hero_bg_1_12.jpg
    ├── girl.jpg
    ├── treatments/
    │   ├── service_1_1.jpg
    │   ├── service_4_1.jpg
    │   ├── service_4_2.jpg
    │   ├── service_1_3.jpg
    │   ├── service_3_3.jpg
    │   └── service_1_7.jpg
    └── testimonials/
        ├── testi_1_2.jpg
        └── testi_1_3.jpg
```

You can download images from: https://shadharawellness.com/

## Troubleshooting

### Permission Issues (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Database Connection Error
- Check MySQL service is running
- Verify database credentials in `.env`
- Ensure database exists





