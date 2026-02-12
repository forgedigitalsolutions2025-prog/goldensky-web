<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    /**
     * API base URL - should match backend API
     */
    private $apiBaseUrl;

    public function __construct()
    {
        // Get API URL from config or environment, default to cloud backend
        $this->apiBaseUrl = env('API_BASE_URL', 'https://whale-app-wcsre.ondigitalocean.app');
    }

    /**
     * Display menu items from the backend API (matching Restaurant app)
     */
    public function index()
    {
        try {
            // Fetch available menu items from the backend API
            $response = Http::timeout(5)->get($this->apiBaseUrl . '/api/v1/menu-items/available');
            
            if ($response->successful()) {
                $menuItems = collect($response->json())
                    ->map(function ($item) {
                        // Normalize category to uppercase for consistent grouping
                        $item['category'] = strtoupper($item['category']);
                        return $item;
                    })
                    ->sortBy(function ($item) {
                        return $item['category'] . '_' . $item['name'];
                    })
                    ->groupBy('category');
                
                return view('menu.index', compact('menuItems'));
            } else {
                Log::error('Failed to fetch menu items from API', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                // Fallback to empty collection
                $menuItems = collect([]);
                return view('menu.index', compact('menuItems'));
            }
        } catch (\Exception $e) {
            Log::error('Error fetching menu items from API', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Fallback to empty collection
            $menuItems = collect([]);
            return view('menu.index', compact('menuItems'));
        }
    }
}
































