<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->unique('name');

        return view('treatments', compact('treatments'));
    }
}



