@extends('layouts.app')

@section('title', 'Rooms - Golden Sky Hotel & Wellness')

@section('content')
<!-- Page Header -->
<div class="relative h-80 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/hotel/18565ed7-9a8a-4e5d-8080-a615ec89f74e.JPG') }}');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-5xl md:text-6xl font-bold mb-4">Our Rooms & Suites</h1>
            <p class="text-xl md:text-2xl opacity-90">Discover your perfect sanctuary</p>
        </div>
    </div>
</div>

<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search/Filter Section -->
        <div class="relative -mt-24 mb-16 z-10">
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border-2 border-gold/20">
                <!-- Decorative Corner Accent -->
                <div class="absolute top-0 left-0 w-24 h-24 bg-gradient-to-br from-gold/20 to-transparent rounded-tl-3xl"></div>
                <div class="absolute bottom-0 right-0 w-24 h-24 bg-gradient-to-tl from-gold/20 to-transparent rounded-br-3xl"></div>
                
                <!-- Header -->
                <div class="text-center mb-8 relative">
                    <h2 class="text-4xl font-bold bg-gradient-to-r from-gold-dark via-gold to-gold-dark bg-clip-text text-transparent mb-3">Find Your Perfect Room</h2>
                    <div class="w-32 h-1 bg-gradient-to-r from-transparent via-gold to-transparent mx-auto"></div>
                </div>
                
                <form action="{{ route('rooms.index') }}" method="GET">
                    <div class="grid md:grid-cols-4 gap-6">
                        <!-- Check-in Date -->
                        <div>
                            <label class="flex items-center text-xs font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                <svg class="w-4 h-4 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Check-in Date
                            </label>
                            <input type="date" id="check_in_date" name="check_in" value="{{ $checkIn }}" 
                                   min="{{ date('Y-m-d') }}" 
                                   class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark shadow-sm hover:shadow-md">
                        </div>
                        
                        <!-- Check-out Date -->
                        <div>
                            <label class="flex items-center text-xs font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                <svg class="w-4 h-4 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Check-out Date
                            </label>
                            <input type="date" id="check_out_date" name="check_out" value="{{ $checkOut }}" 
                                   min="{{ $checkIn ? date('Y-m-d', strtotime($checkIn . ' +1 day')) : date('Y-m-d', strtotime('+1 day')) }}" 
                                   class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark shadow-sm hover:shadow-md">
                        </div>
                        
                        <!-- Guests -->
                        <div>
                            <label class="flex items-center text-xs font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                <svg class="w-4 h-4 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Number of Guests
                            </label>
                            <select name="guests" class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark shadow-sm hover:shadow-md appearance-none cursor-pointer bg-white">
                                <option value="">Any Number</option>
                                <option value="1">1 Guest</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                                <option value="4">4+ Guests</option>
                            </select>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-end space-x-3">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span>Search</span>
                            </button>
                            <a href="{{ route('rooms.index') }}" class="flex-none bg-white hover:bg-gray-50 text-gray-700 hover:text-gold-dark font-bold p-4 rounded-xl transition-all duration-300 border-2 border-gray-300 hover:border-gold shadow-lg hover:shadow-xl transform hover:scale-105 group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform group-hover:rotate-180 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Count -->
        @if($rooms->isNotEmpty())
            <div class="mb-6 text-center">
                <p class="text-gray-600">Found <span class="font-bold text-gold-dark">{{ $rooms->count() }}</span> rooms available
                @if($checkIn && $checkOut)
                    from <span class="font-semibold">{{ \Carbon\Carbon::parse($checkIn)->format('M d, Y') }}</span> to <span class="font-semibold">{{ \Carbon\Carbon::parse($checkOut)->format('M d, Y') }}</span>
                @endif
                </p>
            </div>
        @endif

        <!-- Rooms Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                    <!-- Room Image -->
                    <div class="relative h-64 overflow-hidden">
                        @php
                            $roomImages = [
                                'Standard' => '2dc02e3a-c784-4f6a-8d59-344896bd3dad.JPG',
                                'Deluxe' => '4da8a997-5601-402c-b778-3c6fad4bb393.JPG',
                                'Suite' => '541e5305-cd2e-4b01-8fb6-64645a20a696.JPG',
                                'Executive' => '5a2413b7-94e9-4829-ad4e-a991d8ceb8cc.JPG',
                            ];
                            $roomType = $room['roomType'] ?? '';
                            $imageName = $roomImages[$roomType] ?? '04af6130-85c5-4a18-891d-4842c56f6183.JPG';
                            
                            $roomAmenities = [
                                'Standard' => ['Free Wi-Fi', 'Air Conditioning', 'TV', 'Mini Bar'],
                                'Deluxe' => ['Free Wi-Fi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'Balcony'],
                                'Suite' => ['Free Wi-Fi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'Balcony', 'Living Area'],
                                'Executive' => ['Free Wi-Fi', 'Air Conditioning', 'Smart TV', 'Mini Bar', 'Balcony', 'Living Area', 'Work Desk'],
                            ];
                            $amenities = $roomAmenities[$roomType] ?? [];
                        @endphp
                        <img src="{{ asset('images/hotel/' . $imageName) }}" 
                             alt="{{ $roomType }} Room" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    
                    <!-- Room Details -->
                    <div class="p-6">
                        <!-- Room Type & Number -->
                        <div class="mb-3">
                            <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $roomType }}</h3>
                            <p class="text-sm text-gray-500">Room {{ $room['roomNumber'] ?? '' }}</p>
                        </div>
                        
                        <!-- Room Features -->
                        <div class="flex items-center space-x-4 mb-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-1 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>{{ $room['maxOccupancy'] ?? 0 }} Guests</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-1 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span>{{ ucfirst(strtolower($roomType)) }}</span>
                            </div>
                        </div>
                        
                        <!-- Amenities -->
                        <div class="mb-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($amenities, 0, 3) as $amenity)
                                    <span class="bg-gold-light text-gold-dark text-xs px-2 py-1 rounded-full">{{ $amenity }}</span>
                                @endforeach
                                @if(count($amenities) > 3)
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">+{{ count($amenities) - 3 }} more</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Price -->
                        <div class="border-t pt-4 mb-4">
                            <div class="flex items-baseline justify-between">
                                <div>
                                    <span class="text-3xl font-bold text-gold-dark">LKR {{ number_format($room['pricePerNight'] ?? 0, 0) }}</span>
                                    <span class="text-gray-500 text-sm ml-1">/ night</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Trust Indicator -->
                        <div class="mb-4 flex items-center justify-center space-x-3 text-sm">
                            <div class="flex items-center space-x-1">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-gray-600 font-semibold">{{ config('reviews.overall_rating', 4.9) }}</span>
                            <span class="text-gray-500">({{ config('reviews.total_reviews', 45) }} reviews)</span>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            <a href="{{ route('rooms.show', $room['id'] ?? 0) }}" 
                               class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 text-center font-semibold py-3 px-4 rounded-lg transition duration-300">
                                Details
                            </a>
                            @auth
                                <a href="{{ route('bookings.create', ['room_id' => $room['id'] ?? 0, 'check_in' => $checkIn, 'check_out' => $checkOut]) }}" 
                                   class="flex-1 bg-gold hover:bg-gold-dark text-white text-center font-semibold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                                    Book Now
                                </a>
                            @else
                                <a href="{{ route('login', ['redirect' => route('bookings.create', ['room_id' => $room['id'] ?? 0, 'check_in' => $checkIn, 'check_out' => $checkOut])]) }}" 
                                   class="flex-1 bg-gold hover:bg-gold-dark text-white text-center font-semibold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                                    Book Now
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Rooms Available</h3>
                    <p class="text-gray-600 mb-6">Sorry, there are no rooms available for the selected dates.</p>
                    <a href="{{ route('rooms.index') }}" class="inline-block bg-gold hover:bg-gold-dark text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                        View All Rooms
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('check_in_date');
    const checkOutInput = document.getElementById('check_out_date');
    
    if (checkInInput && checkOutInput) {
        // Update check-out date min when check-in date changes
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            
            if (checkInDate) {
                // Set check-out min to the day after check-in
                const nextDay = new Date(checkInDate);
                nextDay.setDate(nextDay.getDate() + 1);
                
                // Format as YYYY-MM-DD
                const minDate = nextDay.toISOString().split('T')[0];
                checkOutInput.setAttribute('min', minDate);
                
                // If current check-out date is before the new min, update it
                const currentCheckOut = new Date(checkOutInput.value);
                if (checkOutInput.value && currentCheckOut <= checkInDate) {
                    checkOutInput.value = minDate;
                }
            }
        });
        
        // Validate check-out date when it changes
        checkOutInput.addEventListener('change', function() {
            const checkInDate = new Date(checkInInput.value);
            const checkOutDate = new Date(this.value);
            
            if (checkInDate && checkOutDate && checkOutDate <= checkInDate) {
                // Reset to minimum allowed date
                const nextDay = new Date(checkInDate);
                nextDay.setDate(nextDay.getDate() + 1);
                this.value = nextDay.toISOString().split('T')[0];
                
                // Show alert
                alert('Check-out date must be after check-in date. Please select a valid date.');
            }
        });
    }
});
</script>
@endsection






