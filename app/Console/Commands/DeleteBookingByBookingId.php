<?php

namespace App\Console\Commands;

use App\Services\HotelApiService;
use Illuminate\Console\Command;

class DeleteBookingByBookingId extends Command
{
    protected $signature = 'booking:delete {bookingId : The booking ID to delete (e.g. BK-0007)} {--force : Skip confirmation}';
    protected $description = 'Remove a booking from the system by its booking ID (via backend API)';

    public function handle(HotelApiService $api): int
    {
        $bookingId = $this->argument('bookingId');
        if (empty($bookingId)) {
            $this->error('Booking ID is required.');
            return self::FAILURE;
        }

        $booking = $api->getBookingByBookingId($bookingId);
        if (!$booking) {
            $this->error("Booking not found: {$bookingId}");
            return self::FAILURE;
        }

        $id = $booking['id'] ?? null;
        if ($id === null) {
            $this->error('Booking record has no internal id.');
            return self::FAILURE;
        }

        if (!$this->option('force') && !$this->confirm("Delete booking {$bookingId} (internal id: {$id})? This cannot be undone.")) {
            $this->info('Cancelled.');
            return self::SUCCESS;
        }

        try {
            $api->deleteBooking((int) $id);
            $this->info("Booking {$bookingId} has been removed from the system.");
            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Delete failed: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
