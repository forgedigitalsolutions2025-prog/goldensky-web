<?php

namespace App\Notifications;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingCancellation extends Notification
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
        
        return (new MailMessage)
            ->subject('Booking Cancellation - Golden Sky Hotel & Wellness | Booking #' . $this->booking->booking_id)
            ->view('emails.booking-cancellation', [
                'guest' => $notifiable,
                'booking' => $this->booking,
                'room' => $this->room,
                'checkInFormatted' => $checkIn->format('d F Y'),
                'checkOutFormatted' => $checkOut->format('d F Y'),
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
            'status' => 'CANCELLED',
        ];
    }
}














































































