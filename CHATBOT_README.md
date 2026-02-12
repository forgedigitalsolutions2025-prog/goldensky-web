# AI Chatbot Feature - Golden Sky Hotel & Wellness

## Overview

The web application includes an advanced AI-powered chatbot that helps visitors with questions about the hotel, rooms, amenities, restaurant, and booking procedures. The chatbot now features real-time data integration, conversation context, and intelligent intent recognition.

## Features

### Core Features
- **Floating Chat Widget**: Appears on all pages in the bottom-right corner
- **Real-time Chat**: Instant responses to user queries
- **Conversation Context**: Maintains conversation history for better understanding
- **Intent Recognition**: Automatically detects user intent (availability, pricing, booking, etc.)
- **Entity Extraction**: Extracts dates, guest counts, and room types from messages
- **Real-time Data Integration**: Checks actual room availability, pricing, and menu items
- **Typing Indicators**: Visual feedback when the bot is "typing"
- **Unread Message Counter**: Shows notification badge when chat is closed
- **Responsive Design**: Works on desktop and mobile devices
- **Gold Theme**: Matches the hotel's branding

### Advanced Features
- **AI Service Integration**: Supports OpenAI GPT models with automatic fallback
- **Rate Limiting**: Prevents abuse (20 messages per minute per session)
- **Error Handling & Retries**: Automatic retry logic with graceful error messages
- **Conversation Persistence**: Saves conversations to database and localStorage
- **Session Management**: Tracks conversations across page reloads
- **Smart Fallback**: Falls back to knowledge base if AI service is unavailable

## How It Works

### Intent Recognition

The chatbot automatically recognizes user intents:

- **check_availability**: Checks room availability for specific dates
- **room_info**: Provides information about room types
- **pricing**: Answers pricing questions
- **menu_info**: Provides restaurant and menu information
- **booking_help**: Assists with booking procedures
- **contact**: Provides contact information
- **general**: General questions (uses AI service or knowledge base)

### Entity Extraction

The chatbot extracts useful information from messages:

- **Dates**: Recognizes various date formats (YYYY-MM-DD, DD/MM/YYYY, "tomorrow", etc.)
- **Guest Count**: Extracts number of guests
- **Room Types**: Identifies room types (Standard, Deluxe, Suite, Executive)

### Real-time Data Integration

The chatbot integrates with:

1. **Room Availability**: Checks actual room availability from the database
2. **Pricing**: Retrieves real-time pricing information
3. **Menu Items**: Fetches available menu items from the backend API
4. **Booking Status**: Can check booking availability for specific dates

### AI Service Integration

The chatbot supports OpenAI integration:

1. **Primary**: Uses OpenAI GPT models for natural language understanding
2. **Fallback**: Falls back to knowledge base if OpenAI is unavailable
3. **Context-Aware**: Maintains conversation context for better responses

## Files Structure

1. **Controller**: `app/Http/Controllers/ChatController.php`
   - Handles chat requests
   - Intent recognition and entity extraction
   - Real-time data integration
   - AI service integration with fallback
   - Rate limiting and error handling

2. **Route**: `routes/web.php`
   - Added `/api/chat` POST route

3. **Component**: `resources/views/components/chatbot.blade.php`
   - Chatbot UI widget
   - Alpine.js for interactivity
   - Conversation history management
   - Error handling and retry logic

4. **Migration**: `database/migrations/2024_01_01_000004_create_chat_conversations_table.php`
   - Stores conversation history for analytics

5. **Layout**: `resources/views/layouts/app.blade.php`
   - Added chatbot component to main layout

## Usage

The chatbot is automatically available on all pages. Users can:

1. Click the chat button in the bottom-right corner
2. Type their question
3. Receive instant, context-aware responses
4. Continue the conversation with full context
5. Clear conversation history if needed

## Configuration

### Environment Variables

Add these to your `.env` file:

```env
# Backend API URL
API_BASE_URL=https://whale-app-wcsre.ondigitalocean.app

# OpenAI Configuration (Optional)
OPENAI_API_KEY=your_openai_api_key_here
OPENAI_MODEL=gpt-3.5-turbo
```

### Running Migrations

To create the conversation history table:

```bash
php artisan migrate
```

## Customization

### Adding More Responses

Edit `getHotelKnowledgeBase()` method in `ChatController.php`:

```php
'keyword1|keyword2' => "Your response text here",
```

### Integrating OpenAI

1. Add your OpenAI API key to `.env`:
   ```
   OPENAI_API_KEY=your_api_key_here
   OPENAI_MODEL=gpt-3.5-turbo
   ```

2. The chatbot will automatically use OpenAI when available, with fallback to knowledge base.

### Customizing Intent Recognition

Edit the `extractIntent()` method in `ChatController.php` to add new intents or modify existing ones.

### Customizing Entity Extraction

Edit the `extractEntities()` method to extract additional information from user messages.

## API Endpoint

**POST** `/api/chat`

**Request:**
```json
{
    "message": "Are there rooms available from 2025-01-15 to 2025-01-20?",
    "session_id": "chat_1234567890_abc123",
    "conversation_history": [
        {
            "role": "user",
            "content": "Hello"
        },
        {
            "role": "assistant",
            "content": "Hello! How can I help you?"
        }
    ]
}
```

**Response:**
```json
{
    "response": "Great news! I found 5 room(s) available for your dates...",
    "timestamp": "2025-01-06 09:10:00",
    "session_id": "chat_1234567890_abc123",
    "intent": "check_availability"
}
```

**Error Response (Rate Limit):**
```json
{
    "response": "I'm receiving too many messages. Please wait a moment...",
    "timestamp": "2025-01-06 09:10:00",
    "session_id": "chat_1234567890_abc123",
    "error": "rate_limit_exceeded"
}
```

## Rate Limiting

- **Limit**: 20 messages per minute per session
- **Window**: 60 seconds
- **Response**: Returns 429 status with helpful message

## Error Handling

The chatbot includes comprehensive error handling:

1. **Network Errors**: Automatic retry (up to 3 attempts)
2. **API Errors**: Graceful fallback to knowledge base
3. **Rate Limiting**: Clear error messages
4. **Invalid Input**: Validation and helpful error messages

## Conversation History

### Local Storage

Conversations are stored in browser localStorage:
- **Key**: `chat_history_{session_id}`
- **Session ID**: `chat_session_id`
- **Retention**: Persists across page reloads

### Database Storage

Conversations are optionally stored in the database:
- **Table**: `chat_conversations`
- **Fields**: session_id, user_message, ai_response, intent, entities, timestamps
- **Use Case**: Analytics and conversation review

## Analytics

The chatbot logs conversations for analytics:
- User messages and AI responses
- Detected intents
- Extracted entities
- Timestamps and session IDs

## Future Enhancements

- [ ] Multi-language support
- [ ] Voice input/output
- [ ] Direct booking integration
- [ ] Sentiment analysis
- [ ] Proactive suggestions
- [ ] Integration with booking system for real-time bookings
- [ ] Admin dashboard for conversation analytics
- [ ] Custom training with hotel-specific data

## Troubleshooting

### Chatbot Not Responding

1. Check browser console for errors
2. Verify API_BASE_URL is correct in `.env`
3. Check network connectivity
4. Verify CSRF token is present

### OpenAI Not Working

1. Verify OPENAI_API_KEY is set in `.env`
2. Check API key is valid and has credits
3. Check network connectivity to OpenAI API
4. The chatbot will automatically fallback to knowledge base

### Rate Limit Issues

- Wait 60 seconds before sending more messages
- Clear browser localStorage if needed
- Contact support if persistent issues

## Security

- **CSRF Protection**: All requests include CSRF tokens
- **Rate Limiting**: Prevents abuse
- **Input Validation**: All inputs are validated and sanitized
- **Session Management**: Secure session ID generation
- **Error Messages**: Don't expose sensitive information

## Performance

- **Caching**: Conversation history cached in localStorage
- **Lazy Loading**: AI service only called when needed
- **Fallback**: Fast fallback to knowledge base
- **Optimized Queries**: Efficient database queries for room availability