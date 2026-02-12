<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->unique('name');
            
        return view('about', compact('doctors'));
    }
}


