<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $treatments = Treatment::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->unique('name')
            ->take(8);

        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('home', compact('treatments', 'testimonials'));
    }
}



