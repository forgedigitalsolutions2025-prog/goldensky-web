<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpaController extends Controller
{
    /**
     * Display the spa home page
     */
    public function index()
    {
        // Use the spa's database connection or main database
        // Check if spa tables exist in the main database
        $treatments = collect([]);
        $testimonials = collect([]);

        try {
            // Try to get treatments from spa tables
            if (DB::getSchemaBuilder()->hasTable('treatments')) {
                $treatments = DB::table('treatments')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get()
                    ->unique('name')
                    ->take(8);
            }

            if (DB::getSchemaBuilder()->hasTable('testimonials')) {
                $testimonials = DB::table('testimonials')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();
            }
        } catch (\Exception $e) {
            // If tables don't exist, use empty collections
            \Log::info('Spa tables not found, using empty data: ' . $e->getMessage());
        }

        // Render the spa's home view with its own layout
        try {
            return view('spa::home', compact('treatments', 'testimonials'));
        } catch (\Exception $e) {
            \Log::error('Spa view error: ' . $e->getMessage());
            return 'Spa view error: ' . $e->getMessage();
        }
    }

    /**
     * Display the spa about page
     */
    public function about()
    {
        return view('spa::about');
    }

    /**
     * Display the spa treatments page
     */
    public function treatments()
    {
        $treatments = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('treatments')) {
                $treatments = DB::table('treatments')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
            }
        } catch (\Exception $e) {
            \Log::info('Treatments table not found');
        }

        return view('spa::treatments', compact('treatments'));
    }

    /**
     * Display the spa pricing page
     */
    public function pricing()
    {
        $treatments = [];

        try {
            if (DB::getSchemaBuilder()->hasTable('treatments')) {
                $treatments = DB::table('treatments')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
            }
        } catch (\Exception $e) {
            \Log::info('Treatments table not found');
        }

        return view('spa::pricing', compact('treatments'));
    }

    /**
     * Display the spa contact page
     */
    public function contact()
    {
        return view('spa::contact');
    }

    /**
     * Handle spa booking submission
     */
    public function storeBooking(Request $request)
    {
        // Handle booking logic
        // This would need to be implemented based on the spa's booking controller
        return redirect()->route('spa.contact')->with('success', 'Booking request submitted successfully!');
    }

    /**
     * Handle spa contact form submission
     */
    public function storeContact(Request $request)
    {
        // Handle contact form logic
        return redirect()->route('spa.contact')->with('success', 'Message sent successfully!');
    }

    /**
     * Handle newsletter subscription
     */
    public function storeNewsletter(Request $request)
    {
        // Handle newsletter subscription
        return redirect()->back()->with('success', 'Newsletter subscription successful!');
    }
}

