# Database Consolidation Guide

## Overview

The web application has been updated to use a **single cloud database** for all data, with all backend table writes going through the Spring Boot API.

## Architecture

### Single Cloud Database
- **Location**: DigitalOcean MySQL
- **Host**: `hoteldb1-do-user-30852188-0.j.db.ondigitalocean.com:25060`
- **Database**: `defaultdb`

### Data Access Strategy

#### Backend Tables (rooms, bookings, guests, menu_items, etc.)
- **Reads**: Direct database connection (for performance)
- **Writes**: **ALWAYS via Spring Boot API** (ensures business logic consistency)
- **Managed by**: Spring Boot backend

#### Web App Tables (web_users, sessions, password_reset_tokens, chat_conversations)
- **Reads & Writes**: Direct database connection
- **Managed by**: Laravel web application

## Configuration

### Environment Variables

Update your `.env` file to point to the cloud database:

```env
# Cloud Database Connection (for web app tables and reads)
DB_CONNECTION=mysql
DB_HOST=hoteldb1-do-user-30852188-0.j.db.ondigitalocean.com
DB_PORT=25060
DB_DATABASE=defaultdb
DB_USERNAME=doadmin
DB_PASSWORD=your_cloud_db_password

# Backend API URL (for all backend writes)
API_BASE_URL=https://whale-app-wcsre.ondigitalocean.app
```

### Database Credentials

The web application needs:
- **Read access** to backend tables (rooms, bookings, guests, etc.)
- **Full access** to web app tables (web_users, sessions, etc.)

## Migration Steps

### 1. Update Database Configuration

Update `.env` with cloud database credentials (see above).

### 2. Run Migrations

Run Laravel migrations to create web app tables in the cloud database:

```bash
php artisan migrate
```

This will create:
- `web_users` - Web application users
- `sessions` - Laravel sessions
- `password_reset_tokens` - Password reset tokens
- `chat_conversations` - Chatbot conversation history

### 3. Verify Connection

Test the database connection:

```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

### 4. Test API Connection

Verify the API service is working:

```bash
php artisan tinker
>>> $service = app(\App\Services\HotelApiService::class);
>>> $service->getAllRooms();
```

## Code Changes Summary

### Controllers Updated
- ✅ `RoomController` - Uses API service for all room data
- ✅ `BookingController` - Uses API service for all booking operations
- ✅ `ChatController` - Uses API service for room availability
- ✅ `HomeController` - Uses API service for room data
- ✅ `AdminController` - Uses API service for bookings/rooms/guests
- ✅ `MenuController` - Already using API (no changes needed)

### New Service
- ✅ `HotelApiService` - Centralized API client for all backend operations

### Models
- ⚠️ `Room`, `Booking`, `Guest` models are no longer used for backend data
- These models can be kept for reference but are not actively used
- All backend data now comes from API responses

## Important Notes

### Writes Must Go Through API

**CRITICAL**: All writes to backend tables (bookings, guests, etc.) **MUST** go through the Spring Boot API. This ensures:
- Business logic consistency
- Validation rules are applied
- Data integrity is maintained
- All applications see the same data

### Direct Database Access

Direct database access is only allowed for:
- ✅ Reading backend tables (for performance)
- ✅ Web app tables (full access)

### API Service Features

The `HotelApiService` includes:
- Automatic retry logic (up to 2 retries)
- Error handling and logging
- Caching for frequently accessed data (rooms, menu items)
- Timeout handling
- Proper error messages

## Troubleshooting

### Database Connection Issues

If you can't connect to the cloud database:
1. Verify credentials in `.env`
2. Check network connectivity
3. Verify database user has proper permissions
4. Check firewall rules

### API Connection Issues

If API calls fail:
1. Verify `API_BASE_URL` in `.env`
2. Check if backend API is running
3. Check network connectivity
4. Review error logs: `storage/logs/laravel.log`

### Data Not Syncing

If data appears inconsistent:
1. Ensure all writes go through API (check controllers)
2. Clear API cache: `php artisan cache:clear`
3. Check API logs for errors
4. Verify API is returning correct data

## Benefits

✅ **Single Source of Truth**: One database for all data
✅ **Consistency**: All writes go through API with business logic
✅ **Performance**: Direct reads for fast data access
✅ **Maintainability**: Centralized business logic in Spring Boot
✅ **Scalability**: Easy to add more applications

## Next Steps

1. Update `.env` with cloud database credentials
2. Run migrations: `php artisan migrate`
3. Test the application
4. Monitor logs for any issues
5. Remove old local database if no longer needed









