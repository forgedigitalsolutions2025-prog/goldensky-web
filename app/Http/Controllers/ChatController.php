<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Services\HotelApiService;
use Carbon\Carbon;

class ChatController extends Controller
{
    /**
     * API base URL - should match backend API
     */
    private $apiBaseUrl;

    /**
     * Maximum conversation history to keep in context
     */
    private $maxHistoryLength = 10;

    /**
     * Hotel API Service
     */
    private $apiService;

    public function __construct(HotelApiService $apiService)
    {
        $this->apiBaseUrl = env('API_BASE_URL', 'https://whale-app-wcsre.ondigitalocean.app');
        $this->apiService = $apiService;
    }

    /**
     * Handle chat message from the chatbot
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'session_id' => 'nullable|string|max:100',
            'conversation_history' => 'nullable|array',
        ]);

        $userMessage = $request->input('message');
        $sessionId = $request->input('session_id', $this->generateSessionId());
        $conversationHistory = $request->input('conversation_history', []);

        // Rate limiting: max 20 messages per minute per session
        $rateLimitKey = "chat_rate_limit:{$sessionId}";
        $rateLimit = Cache::get($rateLimitKey, 0);
        if ($rateLimit >= 20) {
            return response()->json([
                'response' => "I'm receiving too many messages. Please wait a moment before sending another message.",
                'timestamp' => now()->toDateTimeString(),
                'session_id' => $sessionId,
                'error' => 'rate_limit_exceeded'
            ], 429);
        }
        Cache::put($rateLimitKey, $rateLimit + 1, 60); // 1 minute window

        try {
            // Log conversation for analytics
            $this->logConversation($sessionId, $userMessage);

            // Extract intent and entities from user message
            $intent = $this->extractIntent($userMessage);
            $entities = $this->extractEntities($userMessage);
        
            // Get AI response with context
            $aiResponse = $this->getAIResponse($userMessage, $intent, $entities, $conversationHistory);

            // Save conversation to database
            $this->saveConversation($sessionId, $userMessage, $aiResponse);
        
        return response()->json([
            'response' => $aiResponse,
                'timestamp' => now()->toDateTimeString(),
                'session_id' => $sessionId,
                'intent' => $intent,
            ]);
        } catch (\Exception $e) {
            Log::error('Chat error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_message' => $userMessage
            ]);

            return response()->json([
                'response' => "I apologize, but I'm experiencing technical difficulties. Please try again in a moment, or contact us directly for assistance.",
                'timestamp' => now()->toDateTimeString(),
                'session_id' => $sessionId,
                'error' => 'internal_error'
            ], 500);
        }
    }

    /**
     * Get AI response based on user message with enhanced capabilities
     */
    private function getAIResponse(string $message, string $intent, array $entities, array $history = []): string
    {
        $message = strtolower(trim($message));

        // Handle specific intents with real-time data
        switch ($intent) {
            case 'check_availability':
                return $this->handleAvailabilityCheck($entities);
            
            case 'room_info':
                return $this->handleRoomInfo($entities);
            
            case 'pricing':
                return $this->handlePricing($entities);
            
            case 'menu_info':
                return $this->handleMenuInfo($entities);
            
            case 'booking_help':
                return $this->handleBookingHelp($entities);
            
            case 'contact':
                return $this->handleContactInfo();
            
            default:
                // Try AI service first, fallback to knowledge base
                return $this->getAIResponseWithService($message, $intent, $entities, $history);
        }
    }

    /**
     * Extract intent from user message
     */
    private function extractIntent(string $message): string
    {
        $message = strtolower(trim($message));
        
        // Availability checking
        if (preg_match('/\b(available|availability|booked|free|vacant|check.*room|room.*available)\b/i', $message)) {
            return 'check_availability';
        }
        
        // Room information
        if (preg_match('/\b(room|rooms|accommodation|suite|deluxe|standard|executive|room.*type|type.*room)\b/i', $message)) {
            return 'room_info';
        }
        
        // Pricing
        if (preg_match('/\b(price|cost|rate|rates|pricing|how much|fee|charge|per night|per day)\b/i', $message)) {
            return 'pricing';
        }
        
        // Menu/Restaurant
        if (preg_match('/\b(menu|food|restaurant|dining|eat|meal|dish|cuisine|breakfast|lunch|dinner)\b/i', $message)) {
            return 'menu_info';
        }
        
        // Booking
        if (preg_match('/\b(book|booking|reserve|reservation|make.*booking|create.*booking)\b/i', $message)) {
            return 'booking_help';
        }
        
        // Contact
        if (preg_match('/\b(contact|phone|email|address|location|where|call|reach|get.*touch)\b/i', $message)) {
            return 'contact';
        }
        
        return 'general';
    }

    /**
     * Extract entities (dates, numbers, room types) from message
     */
    private function extractEntities(string $message): array
    {
        $entities = [
            'check_in' => null,
            'check_out' => null,
            'guests' => null,
            'room_type' => null,
            'dates' => [],
        ];

        // Extract dates (various formats)
        $datePatterns = [
            '/(\d{4}[-.\/]\d{1,2}[-.\/]\d{1,2})/',
            '/(\d{1,2}[-.\/]\d{1,2}[-.\/]\d{4})/',
            '/(\d{1,2}\s+(jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)[a-z]*\s+\d{4})/i',
            '/(tomorrow|today|next week|next month)/i',
        ];

        foreach ($datePatterns as $pattern) {
            if (preg_match_all($pattern, $message, $matches)) {
                foreach ($matches[1] as $dateStr) {
                    try {
                        $date = Carbon::parse($dateStr);
                        $entities['dates'][] = $date->format('Y-m-d');
                    } catch (\Exception $e) {
                        // Invalid date, skip
                    }
                }
            }
        }

        // Set check-in and check-out if we have dates
        if (count($entities['dates']) >= 2) {
            $entities['check_in'] = $entities['dates'][0];
            $entities['check_out'] = $entities['dates'][1];
        } elseif (count($entities['dates']) === 1) {
            $entities['check_in'] = $entities['dates'][0];
        }

        // Extract number of guests
        if (preg_match('/\b(\d+)\s*(guest|guests|people|person|adult|adults)\b/i', $message, $matches)) {
            $entities['guests'] = (int)$matches[1];
        }

        // Extract room type
        $roomTypes = ['standard', 'deluxe', 'suite', 'executive'];
        foreach ($roomTypes as $type) {
            if (strpos($message, $type) !== false) {
                $entities['room_type'] = ucfirst($type);
                break;
            }
        }

        return $entities;
    }

    /**
     * Handle availability check with real-time data
     */
    private function handleAvailabilityCheck(array $entities): string
    {
        $checkIn = $entities['check_in'] ?? null;
        $checkOut = $entities['check_out'] ?? null;
        $guests = $entities['guests'] ?? null;
        $roomType = $entities['room_type'] ?? null;

        try {
            // Get all rooms from API
            $rooms = collect($this->apiService->getAllRooms());
            
            if ($rooms->isEmpty()) {
                return "I'm currently unable to check room availability. Please visit our Rooms page or contact us directly for assistance.";
            }

            // Filter by availability if dates provided
            if ($checkIn && $checkOut) {
                $availableRooms = $rooms->filter(function ($room) use ($checkIn, $checkOut, $guests, $roomType) {
                    // Check for overlapping bookings
                    $bookings = $this->apiService->getBookingsByRoom($room['roomNumber']);
                    $activeBookings = collect($bookings)->filter(function ($booking) {
                        return $booking['status'] !== 'CANCELLED';
                    });
                    
                    $hasOverlap = $activeBookings->contains(function ($booking) use ($checkIn, $checkOut) {
                        $bookingCheckIn = date('Y-m-d', strtotime($booking['checkInTime']));
                        $bookingCheckOut = date('Y-m-d', strtotime($booking['checkOutTime']));
                        return $bookingCheckOut > $checkIn && $bookingCheckIn < $checkOut;
                    });
                    
                    if ($hasOverlap) {
                        return false;
                    }
                    if ($guests && ($room['maxOccupancy'] ?? 0) < $guests) {
                        return false;
                    }
                    if ($roomType && strtolower($room['roomType'] ?? '') !== strtolower($roomType)) {
                        return false;
                    }
                    return true;
                });

                $count = $availableRooms->count();
                
                if ($count === 0) {
                    return "I'm sorry, but there are no rooms available for the dates you specified ({$checkIn} to {$checkOut}). Please try different dates or contact us for assistance.";
                }

                $roomTypes = $availableRooms->pluck('roomType')->unique()->implode(', ');
                return "Great news! I found {$count} room(s) available for your dates ({$checkIn} to {$checkOut}). Available room types: {$roomTypes}. Would you like to view these rooms and make a booking?";
            } else {
                // No dates provided, check current availability
                $availableRooms = $rooms->filter(function ($room) {
                    return isset($room['status']) && $room['status'] === 'AVAILABLE';
                });

                $count = $availableRooms->count();
                return "We currently have {$count} room(s) available. To check availability for specific dates, please provide your check-in and check-out dates, or visit our Rooms page.";
            }
        } catch (\Exception $e) {
            Log::error('Availability check error', ['error' => $e->getMessage()]);
            return "I'm having trouble checking availability right now. Please visit our Rooms page or contact us directly for the most up-to-date information.";
        }
    }

    /**
     * Handle room information requests
     */
    private function handleRoomInfo(array $entities): string
    {
        try {
            $roomType = $entities['room_type'] ?? null;
            $rooms = collect($this->apiService->getAllRooms());

            if ($rooms->isEmpty()) {
                return "I'm currently unable to retrieve room information. Please visit our Rooms page for details.";
            }

            if ($roomType) {
                $filteredRooms = $rooms->filter(function ($room) use ($roomType) {
                    return strtolower($room['roomType'] ?? '') === strtolower($roomType);
                });

                if ($filteredRooms->isEmpty()) {
                    $roomTypes = $rooms->pluck('roomType')->unique()->implode(', ');
                    return "I couldn't find any {$roomType} rooms. We offer: {$roomTypes}. Would you like information about any of these?";
                }

                $room = $filteredRooms->first();
                $price = number_format($room['pricePerNight'] ?? 0, 2);
                $roomTypeName = $room['roomType'] ?? $roomType;
                $maxOccupancy = $room['maxOccupancy'] ?? 0;
                return "Our {$roomTypeName} rooms are elegantly furnished with modern amenities. Starting from LKR {$price} per night. Maximum occupancy: {$maxOccupancy} guests. Would you like to see more details or check availability?";
            } else {
                $roomTypes = $rooms->pluck('roomType')->unique()->implode(', ');
                $prices = $rooms->pluck('pricePerNight')->filter();
                $minPrice = $prices->min() ?? 0;
                $maxPrice = $prices->max() ?? 0;
                $priceRange = "LKR " . number_format($minPrice, 2) . " - LKR " . number_format($maxPrice, 2);
                return "We offer several room types: {$roomTypes}. Prices range from {$priceRange} per night. Each room is elegantly furnished with modern amenities. Would you like information about a specific room type?";
            }
        } catch (\Exception $e) {
            Log::error('Room info error', ['error' => $e->getMessage()]);
            return "I'm having trouble retrieving room information. Please visit our Rooms page for detailed information about our accommodations.";
        }
    }

    /**
     * Handle pricing inquiries
     */
    private function handlePricing(array $entities): string
    {
        try {
            $rooms = collect($this->apiService->getAllRooms());
            
            if ($rooms->isEmpty()) {
                return "I'm currently unable to provide pricing information. Please visit our Rooms page or contact us directly.";
            }

            $roomType = $entities['room_type'] ?? null;
            
            if ($roomType) {
                $filteredRooms = $rooms->filter(function ($room) use ($roomType) {
                    return strtolower($room['roomType'] ?? '') === strtolower($roomType);
                });

                if ($filteredRooms->isEmpty()) {
                    $roomTypes = $rooms->pluck('roomType')->unique()->implode(', ');
                    return "I couldn't find pricing for {$roomType} rooms. We offer: {$roomTypes}.";
                }

                $room = $filteredRooms->first();
                $price = number_format($room['pricePerNight'] ?? 0, 2);
                $roomTypeName = $room['roomType'] ?? $roomType;
                return "Our {$roomTypeName} rooms start from LKR {$price} per night. We also offer various meal plan options (Room Only, Bed & Breakfast, Half Board, Full Board) with different pricing. Would you like to know more about a specific package?";
            } else {
                $prices = $rooms->pluck('pricePerNight')->filter();
                $minPrice = number_format($prices->min() ?? 0, 2);
                $maxPrice = number_format($prices->max() ?? 0, 2);
                return "Our room rates vary by room type and season. Standard rooms start from LKR {$minPrice} per night, with premium rooms up to LKR {$maxPrice} per night. We also offer meal plan packages. For specific rates, please visit our Rooms page or provide your preferred dates and room type.";
            }
        } catch (\Exception $e) {
            Log::error('Pricing error', ['error' => $e->getMessage()]);
            return "I'm having trouble retrieving pricing information. Please visit our Rooms page for current rates or contact us directly.";
        }
    }

    /**
     * Handle menu/restaurant inquiries
     */
    private function handleMenuInfo(array $entities): string
    {
        try {
            $menuItems = $this->apiService->getAvailableMenuItems();
            
            if (!empty($menuItems)) {
                $menuItemsCollection = collect($menuItems);
                $categories = $menuItemsCollection->pluck('category')->unique()->count();
                $totalItems = $menuItemsCollection->count();
                
                return "Our restaurant offers a diverse menu with {$totalItems} items across {$categories} categories. We serve delicious meals throughout the day (7:00 AM to 11:00 PM). You can view our full menu on the Menu page. We also offer room service for your convenience. Is there a specific dish or cuisine you're interested in?";
            } else {
                return "Our restaurant is open from 7:00 AM to 11:00 PM, serving delicious meals throughout the day. You can view our full menu on the Menu page. We also offer room service. For specific menu items, please visit our Menu page or contact us directly.";
            }
        } catch (\Exception $e) {
            Log::error('Menu info error', ['error' => $e->getMessage()]);
            return "Our restaurant serves delicious meals from 7:00 AM to 11:00 PM. Please visit our Menu page to view our full menu, or contact us for more information.";
        }
    }

    /**
     * Handle booking help
     */
    private function handleBookingHelp(array $entities): string
    {
        $checkIn = $entities['check_in'] ?? null;
        $checkOut = $entities['check_out'] ?? null;

        if ($checkIn && $checkOut) {
            return "To make a booking for {$checkIn} to {$checkOut}, please visit our Rooms page, select your preferred room, and complete the booking form. You'll need to create an account if you don't have one. I can help you check availability for these dates if you'd like!";
        } else {
            return "You can book a room directly through our website! Simply visit the Rooms page, select your preferred room, choose your check-in and check-out dates, and complete the booking. You'll need to create an account if you don't have one. For assistance, feel free to contact us or let me know your preferred dates and I can help check availability.";
        }
    }

    /**
     * Handle contact information
     */
    private function handleContactInfo(): string
    {
        return "You can reach us at:\n• Phone / WhatsApp: +94 71 483 1035\n• Email: reservations@goldenskyhotelandwellness.com\n• Address: 53/1, Hanthane Housing Scheme, Hanthane, Kandy\n\nOur front desk is available 24/7 to assist you with any inquiries. You can also click the WhatsApp button in the chat widget for instant messaging!";
    }

    /**
     * Get AI response using external service (OpenAI/Anthropic) with fallback
     */
    private function getAIResponseWithService(string $message, string $intent, array $entities, array $history = []): string
    {
        // Try OpenAI first if configured
        $openAIResponse = $this->getAIResponseWithOpenAI($message, $intent, $entities, $history);
        if ($openAIResponse !== null) {
            return $openAIResponse;
        }

        // Fallback to knowledge base
        return $this->getAIResponseFromKnowledgeBase($message);
    }

    /**
     * Integrate with OpenAI API for more advanced responses
     */
    private function getAIResponseWithOpenAI(string $message, string $intent, array $entities, array $history = []): ?string
    {
        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) {
            return null; // No API key, use fallback
        }

        try {
            // Build context from conversation history
            $systemPrompt = $this->buildSystemPrompt($intent, $entities);
            $messages = [
                ['role' => 'system', 'content' => $systemPrompt]
            ];

            // Add recent conversation history (last 5 exchanges)
            $recentHistory = array_slice($history, -10); // Last 10 messages (5 exchanges)
            foreach ($recentHistory as $hist) {
                if (isset($hist['role']) && isset($hist['content'])) {
                    $messages[] = ['role' => $hist['role'], 'content' => $hist['content']];
                }
            }

            // Add current user message
            $messages[] = ['role' => 'user', 'content' => $message];

            $response = Http::timeout(10)->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),
                'messages' => $messages,
                'max_tokens' => 300,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $content = $response->json()['choices'][0]['message']['content'] ?? null;
                if ($content) {
                    return trim($content);
                }
            }
        } catch (\Exception $e) {
            Log::error('OpenAI API Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }

        return null; // Fallback to knowledge base
    }

    /**
     * Build system prompt for AI service
     */
    private function buildSystemPrompt(string $intent, array $entities): string
    {
        $prompt = "You are a helpful AI assistant for Golden Sky Hotel & Wellness in Kandy, Sri Lanka. ";
        $prompt .= "Provide friendly, accurate, and concise information about the hotel. ";
        $prompt .= "Keep responses conversational and helpful. ";
        
        if ($intent !== 'general') {
            $prompt .= "The user is asking about: {$intent}. ";
        }
        
        if (!empty($entities)) {
            $prompt .= "Extracted information: " . json_encode($entities) . ". ";
        }
        
        $prompt .= "\n\nHotel Information:\n";
        $prompt .= "- Check-in: 2:00 PM to 11:00 PM\n";
        $prompt .= "- Check-out: Until 11:00 AM\n";
        $prompt .= "- Restaurant: 7:00 AM to 11:00 PM\n";
        $prompt .= "- Address: 53/1, Hanthane Housing Scheme, Hanthane, Kandy\n";
        $prompt .= "- Phone/WhatsApp: +94 71 483 1035\n";
        $prompt .= "- Email: reservations@goldenskyhotelandwellness.com\n";
        $prompt .= "\nIf you don't have specific information, guide users to the appropriate page or suggest contacting the hotel directly.";
        
        return $prompt;
    }

    /**
     * Get response from knowledge base (fallback)
     */
    private function getAIResponseFromKnowledgeBase(string $message): string
    {
        $message = strtolower(trim($message));
        
        // Hotel-specific knowledge base
        $responses = $this->getHotelKnowledgeBase();
        
        // Check for keywords and provide relevant responses
        foreach ($responses as $keywords => $response) {
            $keywordArray = explode('|', $keywords);
            foreach ($keywordArray as $keyword) {
                if (strpos($message, strtolower($keyword)) !== false) {
                    return $response;
                }
            }
        }
        
        // Default responses for common questions
        if (strpos($message, 'hello') !== false || strpos($message, 'hi') !== false || strpos($message, 'hey') !== false) {
            return "Hello! Welcome to Golden Sky Hotel & Wellness. How can I assist you today? I can help you with room bookings, availability checks, amenities, restaurant information, or any other questions about our hotel.";
        }
        
        if (strpos($message, 'thank') !== false) {
            return "You're very welcome! Is there anything else I can help you with?";
        }
        
        if (strpos($message, 'bye') !== false || strpos($message, 'goodbye') !== false) {
            return "Thank you for contacting Golden Sky Hotel & Wellness. Have a wonderful day! We look forward to welcoming you soon.";
        }
        
        // Default helpful response
        return "Thank you for your question! I'm here to help you with information about Golden Sky Hotel & Wellness. You can ask me about:\n\n• Room availability and types\n• Hotel amenities and services\n• Restaurant menu and dining options\n• Booking procedures\n• Check-in and check-out times\n• Pricing and special offers\n\nFeel free to ask me anything specific about our hotel, or visit our Rooms or Menu pages for more details!";
    }

    /**
     * Hotel knowledge base with common questions and answers
     */
    private function getHotelKnowledgeBase(): array
    {
        return [
            'amenities|amenity|facilities|facility|wifi|internet|pool|gym|spa' => "Our hotel offers a wide range of amenities including:\n• Free WiFi throughout the property\n• Restaurant and room service\n• Wellness and spa facilities\n• Modern room amenities\n• 24/7 front desk service\n\nFor specific amenities in your room type, please check the room details on our website.",
            
            'cancellation|cancel|refund' => "Cancellation policies may vary depending on your booking type and rate. Generally, cancellations made 24-48 hours before check-in may be eligible for a refund. Please check your booking confirmation for specific cancellation terms, or contact us for assistance.",
            
            'parking|car|vehicle' => "We offer parking facilities for our guests. Please contact us in advance if you'll be arriving by car so we can ensure a parking space is available for you.",
            
            'pet|pets|animal' => "Please contact us directly regarding our pet policy. We'll be happy to discuss options for accommodating your furry friends.",
            
            'breakfast|meal plan|inclusive' => "We offer various meal plan options: Room Only, Bed & Breakfast, Half Board, and Full Board. Please check with our front desk or during booking for details about breakfast and meal plan inclusions. Our restaurant serves breakfast from 7:00 AM.",
            
            'special|offer|promotion|discount|deal' => "We frequently have special offers and promotions! Please check our website regularly or contact us directly to learn about current deals and packages available for your stay.",
        ];
    }

    /**
     * Generate session ID for conversation tracking
     */
    private function generateSessionId(): string
    {
        return 'chat_' . uniqid() . '_' . time();
    }

    /**
     * Log conversation for analytics
     */
    private function logConversation(string $sessionId, string $userMessage): void
    {
        try {
            // Store in cache for quick access (last 100 messages per session)
            $cacheKey = "chat_history:{$sessionId}";
            $history = Cache::get($cacheKey, []);
            $history[] = [
                'role' => 'user',
                'content' => $userMessage,
                'timestamp' => now()->toDateTimeString()
            ];
            // Keep only last 100 messages
            $history = array_slice($history, -100);
            Cache::put($cacheKey, $history, 3600); // 1 hour
        } catch (\Exception $e) {
            Log::error('Failed to log conversation', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Save conversation to database (if table exists)
     */
    private function saveConversation(string $sessionId, string $userMessage, string $aiResponse): void
    {
        try {
            // Check if conversations table exists
            if (DB::getSchemaBuilder()->hasTable('chat_conversations')) {
                DB::table('chat_conversations')->insert([
                    'session_id' => $sessionId,
                    'user_message' => $userMessage,
                    'ai_response' => $aiResponse,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            // Table doesn't exist or error - silently fail (optional feature)
            Log::debug('Chat conversation not saved to database', ['error' => $e->getMessage()]);
        }
    }
}
