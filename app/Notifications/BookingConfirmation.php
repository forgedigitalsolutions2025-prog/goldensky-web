<?php

namespace App\Notifications;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmation extends Notification
{
    use Queueable;

    protected $booking;
    protected $room;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking, Room $room)
    {
        $this->booking = $booking;
        $this->room = $room;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $checkIn = \Carbon\Carbon::parse($this->booking->check_in_time);
        $checkOut = \Carbon\Carbon::parse($this->booking->check_out_time);
        
        $totalAmount = $this->room->price_per_night * $this->booking->number_of_nights;
        
        return (new MailMessage)
            ->subject('Reservation Confirmed - Golden Sky Hotel & Wellness | Booking #' . $this->booking->booking_id)
            ->view('emails.booking-confirmation', [
                'guest' => $notifiable,
                'booking' => $this->booking,
                'room' => $this->room,
                'checkInFormatted' => $checkIn->format('d F Y'),
                'checkOutFormatted' => $checkOut->format('d F Y'),
                'checkInTime' => $checkIn->format('h:i A'),
                'checkOutTime' => $checkOut->format('h:i A'),
                'totalAmount' => $totalAmount,
            ]);
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'booking_id' => $this->booking->booking_id,
            'room_number' => $this->booking->room_number,
            'check_in' => $this->booking->check_in_time,
            'check_out' => $this->booking->check_out_time,
        ];
    }
}

