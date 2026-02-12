<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'treatment_id' => 'nullable|exists:treatments,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'message' => 'nullable|string|max:2000',
            'is_couple_package' => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['discount_applied'] = 20.00;
        $data['status'] = 'pending';

        Booking::create($data);

        return back()->with('success', 'Your booking request has been submitted successfully! We will confirm your appointment soon.');
    }
}





