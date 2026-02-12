# Admin Panel Access Guide

## Overview
A hidden admin panel is available for viewing business analytics and reports.

## How to Access

### Method 1: Hidden Access (Easter Egg)
1. Scroll to the bottom of any page on the website
2. **Double-click the © symbol** in the footer
3. You'll be redirected to the admin login page

### Method 2: Direct URL
Navigate to: `http://127.0.0.1:8000/admin/login`

## Admin Credentials

**Password:** `admin@goldensky2024`

> **Security Note:** Change this password in production!

## Changing the Admin Password

Edit the file: `app/Http/Controllers/AdminController.php`

Find this line:
```php
private const ADMIN_PASSWORD = 'admin@goldensky2024';
```

Change it to your desired password:
```php
private const ADMIN_PASSWORD = 'your-secure-password-here';
```

## Features

The admin dashboard provides:

### Key Metrics
- **Total Revenue** - Room booking revenue for selected period
- **Total Bookings** - Number of bookings made
- **Occupancy Rate** - Percentage of rooms occupied
- **Available Rooms** - Current room availability

### Status Overview
- Active Check-Ins (guests currently in hotel)
- Pending Bookings (future reservations)
- Completed Bookings (past stays)
- Total Guests (registered in period)

### Revenue Analytics
- **Revenue Trend Chart** - Visual representation of revenue over time
- Line chart showing daily/weekly/monthly revenue

### Recent Bookings Table
Shows last 10 bookings with:
- Booking ID and guest name
- Room number and type
- Check-in date and duration
- Status (color-coded)
- Booking source (WEBSITE, WALK_IN, etc.)

### Period Selection
View analytics for:
- **Today** - Current day statistics
- **This Week** - Last 7 days
- **This Month** - Current month
- **This Year** - Year-to-date

## Security

- **Password protected** - Requires admin password to access
- **Session-based** - Authentication stored in session
- **Hidden access** - Not linked from main navigation
- **Logout** - Secure logout available in dashboard

## For Production

1. **Change the password** to something strong and unique
2. Consider adding **IP restrictions** for extra security
3. Add **activity logging** for admin access
4. Consider **2FA** for additional security

## Integration

The admin panel pulls data from:
- `bookings` table - For bookings and revenue
- `rooms` table - For occupancy and availability
- `guests` table - For guest statistics

Data is shared with:
- Reception POS
- Manager Dashboard
- Restaurant POS

All applications use the same MySQL database, so data is always synchronized.

## Troubleshooting

**Can't access admin panel:**
- Make sure you're double-clicking the © symbol (not single-click)
- Try the direct URL: `/admin/login`

**Incorrect password error:**
- Verify the password in `AdminController.php`
- Check for typos or extra spaces

**No data showing:**
- Ensure the backend API is running
- Check that bookings exist in the database
- Verify MySQL connection

## Support

For issues with the admin panel, contact your system administrator.














































































