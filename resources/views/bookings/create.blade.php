@extends('layouts.app')

@section('title', 'Book a Room - Golden Sky Hotel & Wellness')

@section('content')
<!-- Page Header -->
<div class="relative h-48 sm:h-56 md:h-64 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('images/hotel/04af6130-85c5-4a18-891d-4842c56f6183.JPG') }}');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-2 md:mb-3 drop-shadow-lg">Complete Your Booking</h1>
            <p class="text-base sm:text-lg md:text-xl opacity-90">Just a few steps away from your perfect stay</p>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Room Summary Card -->
        @if($room)
            <div class="bg-gradient-to-r from-gold-dark to-gold rounded-2xl shadow-2xl p-6 sm:p-8 mb-8 -mt-16 sm:-mt-20 relative z-10">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-white">
                    <div class="min-w-0">
                        <h2 class="text-2xl sm:text-3xl font-bold mb-2">{{ $room->room_type }}</h2>
                        <p class="text-white/90 text-sm sm:text-base">Room {{ $room->room_number }} • Max {{ $room->max_occupancy }} Guests</p>
                    </div>
                    <div class="text-left sm:text-right flex-shrink-0">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold" id="price-display">LKR {{ number_format($room->price_per_night, 0) }}</div>
                        <p class="text-white/80 text-sm" id="package-display">per night</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-4 sm:p-6 md:p-10">
            @auth
                <div class="bg-gradient-to-r from-gold/10 to-gold-light/20 border-l-4 border-gold rounded-xl p-5 mb-8 flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-gold to-gold-dark rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Logged in as</p>
                        <p class="text-base font-bold text-gray-900">{{ auth()->user()->name }}</p>
                    </div>
                </div>
            @endauth
            
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <!-- Guest Information Section -->
                <div class="mb-10">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-gold to-gold-dark rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Guest Information</h2>
                    </div>
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">First Name *</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $guest->first_name ?? '') }}" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('first_name') border-red-500 @enderror">
                        @error('first_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Last Name *</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $guest->last_name ?? '') }}" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('last_name') border-red-500 @enderror">
                        @error('last_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $guest->email ?? $user->email ?? '') }}" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Phone *</label>
                        <input type="text" name="phone" value="{{ old('phone', $guest->phone ?? '') }}" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Nationality</label>
                        <input type="text" name="nationality" value="{{ old('nationality', $guest->nationality ?? '') }}"
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Passport Number</label>
                        <input type="text" name="passport_number" value="{{ old('passport_number', $guest->passport_number ?? '') }}"
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Address</label>
                    <textarea name="address" rows="3"
                              class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark">{{ old('address', $guest->address ?? '') }}</textarea>
                </div>

                <!-- Booking Details Section -->
                <div class="mb-10 mt-12">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-gold to-gold-dark rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Booking Details</h2>
                    </div>
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Room Number *</label>
                        <select name="room_number" id="room_number" required
                                class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('room_number') border-red-500 @enderror">
                            <option value="">Select a room</option>
                            @php
                                // Get all rooms and filter by availability for the selected dates
                                $allRooms = \App\Models\Room::orderBy('room_number')->get();
                                $availableRooms = collect();
                                
                                if ($checkIn && $checkOut) {
                                    // Filter rooms by date availability
                                    foreach ($allRooms as $r) {
                                        if ($r->isAvailableForDates($checkIn, $checkOut)) {
                                            $availableRooms->push($r);
                                        }
                                    }
                                } else {
                                    // If no dates selected, show all rooms
                                    $availableRooms = $allRooms;
                                }
                                
                                // If no rooms available after filtering, show all rooms anyway
                                if ($availableRooms->isEmpty()) {
                                    $availableRooms = $allRooms;
                                }
                            @endphp
                            @foreach($availableRooms as $r)
                                <option value="{{ $r->room_number }}" 
                                        data-room-only="{{ $r->price_room_only ?? $r->price_per_night }}"
                                        data-bed-breakfast="{{ $r->price_bed_breakfast ?? $r->price_per_night }}"
                                        data-half-board="{{ $r->price_half_board ?? $r->price_per_night }}"
                                        data-full-board="{{ $r->price_full_board ?? $r->price_per_night }}"
                                        {{ (old('room_number') == $r->room_number || ($room && $room->room_number == $r->room_number)) ? 'selected' : '' }}>
                                    {{ $r->room_number }} - {{ $r->room_type }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Package Type *</label>
                        <select name="package_type" id="package_type" required
                                class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('package_type') border-red-500 @enderror">
                            <option value="ROOM_ONLY" {{ old('package_type', 'ROOM_ONLY') == 'ROOM_ONLY' ? 'selected' : '' }}>Room Only</option>
                            <option value="BED_AND_BREAKFAST" {{ old('package_type') == 'BED_AND_BREAKFAST' ? 'selected' : '' }}>Bed & Breakfast</option>
                            <option value="HALF_BOARD" {{ old('package_type') == 'HALF_BOARD' ? 'selected' : '' }}>Half Board</option>
                            <option value="FULL_BOARD" {{ old('package_type') == 'FULL_BOARD' ? 'selected' : '' }}>Full Board</option>
                        </select>
                        @error('package_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Number of Adults *</label>
                        <input type="number" name="number_of_adults" value="{{ old('number_of_adults', 1) }}" min="1" max="{{ $room ? $room->max_occupancy : 4 }}" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('number_of_adults') border-red-500 @enderror">
                        @if($room)
                            <p class="text-xs text-gray-500 mt-1">Max occupancy for this room: {{ $room->max_occupancy }} guests</p>
                        @endif
                        @error('number_of_adults')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <!-- Empty div to maintain grid layout -->
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Check In *</label>
                        <input type="date" id="booking_check_in_date" name="check_in_time" value="{{ old('check_in_time', $checkIn) }}" 
                               min="{{ date('Y-m-d') }}" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('check_in_time') border-red-500 @enderror">
                        @error('check_in_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Check Out *</label>
                        <input type="date" id="booking_check_out_date" name="check_out_time" value="{{ old('check_out_time', $checkOut) }}" 
                               min="{{ $checkIn ? date('Y-m-d', strtotime($checkIn . ' +1 day')) : date('Y-m-d', strtotime('+1 day')) }}" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('check_out_time') border-red-500 @enderror">
                        @error('check_out_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Number of Children</label>
                    <input type="number" name="number_of_children" value="{{ old('number_of_children', 0) }}" min="0" max="{{ $room ? $room->max_occupancy - 1 : 3 }}"
                           class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark">
                    @if($room)
                        <p class="text-xs text-gray-500 mt-1">Total guests (adults + children) must not exceed {{ $room->max_occupancy }}</p>
                    @endif
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Special Requests / Notes</label>
                    <textarea name="notes" rows="4"
                              class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark"
                              placeholder="Any special requests or preferences...">{{ old('notes') }}</textarea>
                </div>
                </div>

                <!-- Trust Indicator -->
                <div class="mt-8 mb-6 bg-gradient-to-r from-gold-light/20 to-gold/20 rounded-xl p-6 border-2 border-gold/30">
                    <div class="flex items-center justify-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <div class="flex items-center space-x-1">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5 text-gold" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <div>
                                <div class="text-lg font-bold text-gray-900">{{ config('reviews.overall_rating', 4.9) }} rating</div>
                                <div class="text-sm text-gray-600">{{ config('reviews.total_reviews', 45) }} verified reviews</div>
                            </div>
                        </div>
                        <div class="h-12 w-px bg-gray-300"></div>
                        <div class="flex items-center space-x-2 text-gray-700">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="text-sm font-semibold">Secure Booking</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4 mt-10 pt-8 border-t border-gray-200">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl flex items-center justify-center space-x-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Confirm Booking</span>
                    </button>
                    <a href="{{ route('rooms.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-8 rounded-xl transition-all duration-300 text-center flex items-center justify-center space-x-2 border-2 border-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Back to Rooms</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = document.getElementById('booking_check_in_date');
        const checkOutInput = document.getElementById('booking_check_out_date');
        
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

    // Package type and room selection price update
    const roomSelect = document.getElementById('room_number');
    const packageSelect = document.getElementById('package_type');
    const priceDisplay = document.getElementById('price-display');
    const packageDisplay = document.getElementById('package-display');

    // Store room data if pre-selected
    @if($room)
    const preselectedRoom = {
        roomNumber: '{{ $room->room_number }}',
        roomOnly: {{ $room->price_room_only ?? $room->price_per_night ?? 0 }},
        bedBreakfast: {{ $room->price_bed_breakfast ?? $room->price_per_night ?? 0 }},
        halfBoard: {{ $room->price_half_board ?? $room->price_per_night ?? 0 }},
        fullBoard: {{ $room->price_full_board ?? $room->price_per_night ?? 0 }}
    };
    @else
    const preselectedRoom = null;
    @endif

    function updatePrice() {
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
        const selectedPackage = packageSelect.value;

        if (!selectedRoom || !selectedRoom.value) {
            return;
        }

        let pricePerNight = 0;
        let packageName = '';

        // Use preselected room data if available and room matches
        if (preselectedRoom && selectedRoom.value === preselectedRoom.roomNumber) {
            switch(selectedPackage) {
                case 'ROOM_ONLY':
                    pricePerNight = preselectedRoom.roomOnly;
                    packageName = 'Room Only';
                    break;
                case 'BED_AND_BREAKFAST':
                    pricePerNight = preselectedRoom.bedBreakfast;
                    packageName = 'Bed & Breakfast';
                    break;
                case 'HALF_BOARD':
                    pricePerNight = preselectedRoom.halfBoard;
                    packageName = 'Half Board';
                    break;
                case 'FULL_BOARD':
                    pricePerNight = preselectedRoom.fullBoard;
                    packageName = 'Full Board';
                    break;
            }
        } else {
            // Use data attributes from select option
            switch(selectedPackage) {
                case 'ROOM_ONLY':
                    pricePerNight = parseFloat(selectedRoom.dataset.roomOnly || 0);
                    packageName = 'Room Only';
                    break;
                case 'BED_AND_BREAKFAST':
                    pricePerNight = parseFloat(selectedRoom.dataset.bedBreakfast || 0);
                    packageName = 'Bed & Breakfast';
                    break;
                case 'HALF_BOARD':
                    pricePerNight = parseFloat(selectedRoom.dataset.halfBoard || 0);
                    packageName = 'Half Board';
                    break;
                case 'FULL_BOARD':
                    pricePerNight = parseFloat(selectedRoom.dataset.fullBoard || 0);
                    packageName = 'Full Board';
                    break;
            }
        }

        // Calculate number of nights from check-in and check-out dates
        const checkInDate = document.getElementById('booking_check_in_date');
        const checkOutDate = document.getElementById('booking_check_out_date');
        let nights = 0;
        let totalPrice = pricePerNight;

        if (checkInDate && checkOutDate && checkInDate.value && checkOutDate.value) {
            const checkIn = new Date(checkInDate.value);
            const checkOut = new Date(checkOutDate.value);
            
            if (checkOut > checkIn) {
                const timeDiff = checkOut.getTime() - checkIn.getTime();
                nights = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                nights = Math.max(1, nights); // At least 1 night
                totalPrice = pricePerNight * nights;
            }
        }

        if (pricePerNight > 0) {
            if (nights > 0) {
                priceDisplay.textContent = 'LKR ' + totalPrice.toLocaleString('en-US', {maximumFractionDigits: 0});
                packageDisplay.textContent = packageName + ' • ' + nights + ' night' + (nights > 1 ? 's' : '') + ' (LKR ' + pricePerNight.toLocaleString('en-US', {maximumFractionDigits: 0}) + ' per night)';
            } else {
                priceDisplay.textContent = 'LKR ' + pricePerNight.toLocaleString('en-US', {maximumFractionDigits: 0});
                packageDisplay.textContent = packageName + ' • per night';
            }
        }
    }

    roomSelect.addEventListener('change', updatePrice);
    packageSelect.addEventListener('change', updatePrice);
    
    // Add event listeners for date changes to update price
    const checkInDateInput = document.getElementById('booking_check_in_date');
    const checkOutDateInput = document.getElementById('booking_check_out_date');
    
    if (checkInDateInput) {
        checkInDateInput.addEventListener('change', updatePrice);
    }
    if (checkOutDateInput) {
        checkOutDateInput.addEventListener('change', updatePrice);
    }

    // Initialize price on page load
    if ((roomSelect.value && packageSelect.value) || preselectedRoom) {
        updatePrice();
    }
</script>
@endpush
@endsection






