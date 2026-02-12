@extends('layouts.app')

@section('title', 'My Profile - Golden Sky Hotel & Wellness')

@section('content')
<!-- Page Header -->
<div class="relative h-72 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/hotel/60382298-6594-4b0b-adec-bbca73086c5d.JPG') }}');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-gold to-gold-dark rounded-full mb-4 shadow-2xl border-4 border-white/30">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h1 class="text-5xl font-bold mb-2 drop-shadow-lg">My Profile</h1>
            <p class="text-xl opacity-90">Manage your account and view your bookings</p>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Profile Information Card -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 relative z-10">
                    <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-200">
                        <div class="w-10 h-10 bg-gradient-to-br from-gold to-gold-dark rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Profile Information</h2>
                    </div>
                    
                    @if(!$guest)
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                            <p class="text-sm text-blue-700">
                                <strong>Note:</strong> Complete your profile information below. Your details will be saved to the hotel system when you make your first booking.
                            </p>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                <input type="text" name="first_name" value="{{ old('first_name', $guest->first_name ?? explode(' ', $user->name)[0]) }}" required
                                       class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('first_name') border-red-500 @enderror">
                                @error('first_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $guest->last_name ?? (isset(explode(' ', $user->name, 2)[1]) ? explode(' ', $user->name, 2)[1] : '')) }}" required
                                       class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('last_name') border-red-500 @enderror">
                                @error('last_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number *</label>
                            <input type="text" name="phone" value="{{ old('phone', $guest->phone ?? '') }}" required
                                   class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nationality</label>
                            <input type="text" name="nationality" value="{{ old('nationality', $guest->nationality ?? '') }}"
                                   class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('nationality') border-red-500 @enderror">
                            @error('nationality')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea name="address" rows="2"
                                      class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('address') border-red-500 @enderror">{{ old('address', $guest->address ?? '') }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Passport / NIC Number</label>
                            <input type="text" name="passport_number" value="{{ old('passport_number', $guest->passport_number ?? '') }}"
                                   class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('passport_number') border-red-500 @enderror">
                            @error('passport_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Member Since</label>
                            <input type="text" value="{{ $user->created_at->format('F d, Y') }}" disabled
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-50 text-gray-600">
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Update Profile
                        </button>
                    </form>
                </div>

            </div>
            
            <!-- Right Column -->
            <div class="md:col-span-1">
                <!-- Change Password Card -->
                <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 relative z-10">
                    <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-200">
                        <div class="w-10 h-10 bg-gradient-to-br from-gold to-gold-dark rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Change Password</h2>
                    </div>
                    
                    <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="flex items-center text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                <svg class="w-4 h-4 mr-1.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                                Current Password
                            </label>
                            <input type="password" name="current_password" required
                                   class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('current_password') border-red-500 @enderror"
                                   placeholder="Enter current password">
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                <svg class="w-4 h-4 mr-1.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                New Password
                            </label>
                            <input type="password" name="password" required
                                   class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark @error('password') border-red-500 @enderror"
                                   placeholder="Enter new password">
                            @error('password')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                <svg class="w-4 h-4 mr-1.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Confirm New Password
                            </label>
                            <input type="password" name="password_confirmation" required
                                   class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark"
                                   placeholder="Re-enter new password">
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

            </div>
        </div>
        
        <!-- Booking History - Full Width -->
        <div class="mt-6">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gold-dark mb-4">My Bookings</h2>
                    
                    @if($bookings->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gold-light">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Booking ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Room</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Check-In</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Check-Out</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nights</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $booking->booking_id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $booking->room_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ \Carbon\Carbon::parse($booking->check_in_time, 'UTC')->setTimezone(config('app.timezone'))->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ \Carbon\Carbon::parse($booking->check_out_time, 'UTC')->setTimezone(config('app.timezone'))->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $booking->number_of_nights }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($booking->status == 'PENDING')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                @elseif($booking->status == 'CHECKED_IN')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        Checked In
                                                    </span>
                                                @elseif($booking->status == 'CHECKED_OUT')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Completed
                                                    </span>
                                                @elseif($booking->status == 'CANCELLED')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Cancelled
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if($booking->status == 'PENDING')
                                                    <form method="POST" action="{{ route('profile.booking.cancel', $booking->booking_id) }}" 
                                                          onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                        @csrf
                                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-xs font-semibold transition duration-300">
                                                            Cancel Booking
                                                        </button>
                                                    </form>
                                                @elseif($booking->status == 'CHECKED_IN')
                                                    <span class="text-gray-500 text-xs">Contact reception to cancel</span>
                                                @else
                                                    <span class="text-gray-400 text-xs">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="mt-4 text-xl text-gray-600">No bookings yet</p>
                            <p class="mt-2 text-gray-500">Start by browsing our available rooms</p>
                            <a href="{{ route('rooms.index') }}" class="mt-6 inline-block bg-gold hover:bg-gold-dark text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                                Browse Rooms
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

