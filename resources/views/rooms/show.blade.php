@extends('layouts.app')

@section('title', 'Room Details - Golden Sky Hotel & Wellness')

@section('content')
<div class="bg-gray-50">
    <!-- Back Button -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <a href="{{ route('rooms.index') }}" class="inline-flex items-center space-x-2 text-gold-dark hover:text-gold font-semibold text-lg group">
            <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Back to All Rooms</span>
        </a>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">        
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Main Room Image -->
            <div class="h-96 overflow-hidden">
                @php
                    $roomImages = [
                        'Standard' => ['main' => '2dc02e3a-c784-4f6a-8d59-344896bd3dad.JPG', 'gallery' => ['60382298-6594-4b0b-adec-bbca73086c5d.JPG', '6079c5dc-a882-4b75-8523-4951dd6e87c3.JPG', '62cbb1c4-dabc-433d-b570-e8c9b6c20b55.JPG']],
                        'Deluxe' => ['main' => '4da8a997-5601-402c-b778-3c6fad4bb393.JPG', 'gallery' => ['64d24a67-29d4-4106-a47a-8592f09dab5b.JPG', '6fd9adaf-af07-47e8-99d6-f7e07a490dd7.JPG', '770bc666-39a7-444c-b029-18bc1a37b2bb.JPG']],
                        'Suite' => ['main' => '541e5305-cd2e-4b01-8fb6-64645a20a696.JPG', 'gallery' => ['92e98e7a-f30f-4a96-a823-3691b8ee8b99.JPG', '98e23087-c71c-42be-8a6a-4d9f2feb5024.JPG', '9d892b0e-e053-4803-80f6-d9ca89752927.JPG']],
                        'Executive' => ['main' => '5a2413b7-94e9-4829-ad4e-a991d8ceb8cc.JPG', 'gallery' => ['9dc42126-ee26-4ee7-8ee1-ebbfd816638b.JPG', 'a57c9513-e877-4a35-962c-be37a082bc60.JPG', 'e7cbc354-3288-40d1-a64c-68e8a460fa6b.JPG']],
                    ];
                    $mainImage = $roomImages[$room->room_type]['main'] ?? '04af6130-85c5-4a18-891d-4842c56f6183.JPG';
                    $galleryImages = $roomImages[$room->room_type]['gallery'] ?? [];
                @endphp
                <img src="{{ asset('images/hotel/' . $mainImage) }}" 
                     alt="{{ $room->room_type }} Room" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Image Gallery -->
            @if(!empty($galleryImages))
            <div class="grid grid-cols-3 gap-2 p-4 bg-gray-50">
                @foreach($galleryImages as $galleryImage)
                <div class="h-24 overflow-hidden rounded-lg">
                    <img src="{{ asset('images/hotel/' . $galleryImage) }}" 
                         alt="{{ $room->room_type }} Room View" 
                         class="w-full h-full object-cover hover:scale-110 transition duration-300 cursor-pointer">
                </div>
                @endforeach
            </div>
            @endif

            <div class="p-4 sm:p-6 md:p-8">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3 mb-4">
                    <div class="min-w-0">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gold-dark mb-2">{{ $room->room_type }}</h1>
                        <p class="text-gray-600 text-sm sm:text-base">Room Number: {{ $room->room_number }}</p>
                    </div>
                    <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded self-start">{{ $room->status }}</span>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="font-semibold text-gold-dark mb-2">Room Details</h3>
                        <ul class="space-y-2 text-gray-700">
                            <li>Max Occupancy: {{ $room->max_occupancy }} guests</li>
                            <li>Room Type: {{ $room->room_type }}</li>
                            <li>Status: {{ $room->status }}</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gold-dark mb-2">Pricing</h3>
                        <p class="text-2xl font-bold text-gold-dark">LKR {{ number_format($room->price_per_night, 2) }}</p>
                        <p class="text-gray-600">per night</p>
                    </div>
                </div>

                <div class="border-t pt-6">
                    @auth
                        <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" 
                           class="w-full bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl text-center flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span>Book This Room Now</span>
                        </a>
                    @else
                        <div class="text-center mb-4">
                            <p class="text-gray-600 mb-4">Please login or register to book this room</p>
                            <div class="flex gap-4">
                                <a href="{{ route('login', ['redirect' => route('bookings.create', ['room_id' => $room->id])]) }}" 
                                   class="flex-1 bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg text-center flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Login to Book</span>
                                </a>
                                <a href="{{ route('register', ['redirect' => route('bookings.create', ['room_id' => $room->id])]) }}" 
                                   class="flex-1 bg-gray-700 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-lg transition duration-300 text-center">
                                    Register
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






