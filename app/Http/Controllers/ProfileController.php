<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Notifications\BookingCancellation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show user profile
     */
    public function show()
    {
        $user = auth()->user();
        
        // Get corresponding guest record
        $guest = Guest::where('email', $user->email)->first();
        
        // Get user's bookings
        $bookings = Booking::join('guests', 'bookings.guest_id', '=', 'guests.guest_id')
            ->where('guests.email', $user->email)
            ->select('bookings.*')
            ->orderBy('bookings.booked_date', 'desc')
            ->get();

        return view('profile.show', compact('user', 'guest', 'bookings'));
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:web_users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'nationality' => ['nullable', 'string', 'max:50'],
            'passport_number' => ['nullable', 'string', 'max:50'],
        ]);

        // Get the old email before updating
        $oldEmail = $user->email;
        
        // Update user account
        $fullName = $request->first_name . ' ' . $request->last_name;
        $user->update([
            'name' => $fullName,
            'email' => $request->email,
        ]);

        // Update guest record if exists (only for users who have made bookings)
        // Guest record is created when user makes their first booking
        $guest = Guest::where('email', $oldEmail)->first();
        
        if ($guest) {
            // Update existing guest (user has made bookings before)
            $guest->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'nationality' => $request->nationality,
                'passport_number' => $request->passport_number,
            ]);
        }
        // If no guest record exists, it will be created when they make their first booking

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Current password is incorrect'])
                ->withInput();
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile')
            ->with('success', 'Password updated successfully!');
    }

    /**
     * Cancel a booking
     */
    public function cancelBooking($bookingId)
    {
        $user = auth()->user();
        
        // Get the booking
        $booking = Booking::where('booking_id', $bookingId)->firstOrFail();
        
        // Get guest to verify ownership
        $guest = Guest::where('email', $user->email)->first();
        
        if (!$guest || $booking->guest_id !== $guest->guest_id) {
            return redirect()->route('profile')
                ->with('error', 'You can only cancel your own bookings.');
        }
        
        // Check if booking can be cancelled (not already cancelled or checked out)
        if ($booking->status === 'CANCELLED') {
            return redirect()->route('profile')
                ->with('warning', 'This booking is already cancelled.');
        }
        
        if ($booking->status === 'CHECKED_OUT') {
            return redirect()->route('profile')
                ->with('error', 'Cannot cancel a completed booking.');
        }
        
        // Cancel the booking
        $booking->update(['status' => 'CANCELLED']);
        
        // Update room status to AVAILABLE
        $room = Room::where('room_number', $booking->room_number)->first();
        if ($room) {
            $room->update(['status' => 'AVAILABLE']);
        }
        
        // Send cancellation email
        try {
            $guest->notify(new BookingCancellation($booking, $room));
            Log::info('Cancellation email sent', [
                'booking_id' => $booking->booking_id,
                'guest_email' => $guest->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send cancellation email', [
                'booking_id' => $booking->booking_id,
                'guest_email' => $guest->email,
                'error' => $e->getMessage(),
            ]);
            // Don't fail the cancellation if email fails
        }
        
        return redirect()->route('profile')
            ->with('success', 'Booking cancelled successfully! A confirmation email has been sent.');
    }
}


