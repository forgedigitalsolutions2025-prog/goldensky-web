@extends('layouts.app')

@section('title', 'Booking Confirmed - Golden Sky Hotel & Wellness')

@section('content')
<!-- Professional Confirmation Page -->
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Success Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">Booking Confirmed</h1>
            <p class="text-lg text-gray-600">Thank you for choosing Golden Sky Hotel & Wellness</p>
        </div>

        <!-- Booking Details Card -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden mb-8">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-gold-dark to-gold px-8 py-5 border-b border-gold-dark/20">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <h2 class="text-xl font-bold text-white">Booking Details</h2>
                </div>
            </div>
            
            <!-- Card Content -->
            <div class="p-8">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Booking Reference -->
                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Booking Reference</p>
                        <p class="text-lg font-semibold text-gray-900 font-mono">{{ $booking->booking_id }}</p>
                    </div>
                    
                    <!-- Guest Name -->
                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Guest Name</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $guest->first_name }} {{ $guest->last_name }}</p>
                    </div>
                    
                    <!-- Room -->
                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Room</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $room->room_type }} - Room {{ $booking->room_number }}</p>
                    </div>
                    
                    <!-- Status -->
                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Status</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            CONFIRMED
                        </span>
                    </div>
                    
                    <!-- Check-in -->
                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Check-in</p>
                        <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->check_in_time, 'UTC')->setTimezone(config('app.timezone'))->format('F d, Y') }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::parse($booking->check_in_time, 'UTC')->setTimezone(config('app.timezone'))->format('g:i A') }}</p>
                    </div>
                    
                    <!-- Check-out -->
                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Check-out</p>
                        <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->check_out_time, 'UTC')->setTimezone(config('app.timezone'))->format('F d, Y') }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::parse($booking->check_out_time, 'UTC')->setTimezone(config('app.timezone'))->format('g:i A') }}</p>
                    </div>
                    
                    <!-- Duration -->
                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Duration</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $booking->number_of_nights }} Night{{ $booking->number_of_nights > 1 ? 's' : '' }}</p>
                    </div>
                    
                    <!-- Guests -->
                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Guests</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $booking->number_of_adults }} Adult{{ $booking->number_of_adults > 1 ? 's' : '' }}
                            @if($booking->number_of_children > 0)
                                <span class="text-gray-600">, {{ $booking->number_of_children }} Child{{ $booking->number_of_children > 1 ? 'ren' : '' }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Notice -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6 mb-8">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-blue-900 mb-2">Important Information</h3>
                    <div class="text-sm text-blue-800 space-y-2">
                        <p>Your booking has been successfully confirmed. A confirmation email with all details has been sent to <strong>{{ $guest->email }}</strong>.</p>
                        <p>Please keep your booking reference <strong class="font-mono">{{ $booking->booking_id }}</strong> for your records. You may need this reference for check-in or any inquiries.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-semibold rounded-lg text-white bg-gradient-to-r from-gold-dark to-gold hover:from-gold hover:to-gold-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold transition-all duration-200 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Back to Home
            </a>
            <a href="{{ route('rooms.index') }}" class="inline-flex items-center justify-center px-8 py-3 border-2 border-gray-300 text-base font-semibold rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-gold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                View More Rooms
            </a>
        </div>

        <!-- Email Confirmation -->
        <div class="text-center mt-10 pt-8 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                <svg class="w-4 h-4 inline-block mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Confirmation email sent to <strong class="text-gray-900">{{ $guest->email }}</strong>
            </p>
        </div>
    </div>
</div>
@endsection
