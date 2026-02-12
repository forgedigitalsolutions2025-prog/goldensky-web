<?php

namespace App\Http\Controllers;

use App\Services\HotelApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    private $apiService;

    public function __construct(HotelApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        try {
            // Get available rooms from API
            $allRooms = $this->apiService->getAllRooms();
            
            // Filter for available rooms
            $rooms = collect($allRooms)->filter(function ($room) {
                return isset($room['status']) && $room['status'] === 'AVAILABLE';
            })
            ->sortBy(function ($room) {
                return ($room['roomType'] ?? '') . '_' . ($room['roomNumber'] ?? '');
            })
            ->values();

        // Load Google reviews from config
        $reviews = config('reviews.reviews', []);
        $overallRating = config('reviews.overall_rating', 4.9);
        $totalReviews = config('reviews.total_reviews', 39);

        return view('home', compact('rooms', 'reviews', 'overallRating', 'totalReviews'));
        } catch (\Exception $e) {
            Log::error('Error fetching rooms for home page', [
                'error' => $e->getMessage()
            ]);
            
            // Fallback to empty rooms
            $rooms = collect([]);
            $reviews = config('reviews.reviews', []);
            $overallRating = config('reviews.overall_rating', 4.9);
            $totalReviews = config('reviews.total_reviews', 39);
            
            return view('home', compact('rooms', 'reviews', 'overallRating', 'totalReviews'));
        }
    }
}
