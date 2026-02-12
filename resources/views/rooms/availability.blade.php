<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check availability - Golden Sky Hotel & Wellness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { 'gold': '#FFD700', 'gold-dark': '#B8860B' } } } }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center sm:h-16 py-4 sm:py-0 gap-3 sm:gap-0">
                <div class="flex flex-wrap items-center gap-3 sm:gap-6">
                    <a href="{{ route('home') }}" class="text-gray-800 font-semibold hover:text-gold-dark text-sm sm:text-base">Golden Sky Hotel & Wellness</a>
                    <a href="{{ route('rooms.index') }}" class="text-gray-600 hover:text-gold-dark text-sm sm:text-base">Rooms</a>
                    <a href="{{ route('rooms.availability') }}" class="text-gold-dark font-medium text-sm sm:text-base">Check availability</a>
                </div>
                <a href="{{ route('admin.login') }}" class="text-gold-dark hover:text-gold font-medium text-sm sm:text-base">Staff login</a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Check availability</h1>

        <form method="get" action="{{ route('rooms.availability') }}" class="bg-white rounded-lg shadow border border-gray-200 p-4 sm:p-6 mb-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                <input type="date" name="check_in" value="{{ $checkIn ?? '' }}" min="{{ date('Y-m-d') }}" class="w-full rounded border-gray-300 shadow-sm px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                <input type="date" name="check_out" value="{{ $checkOut ?? '' }}" class="w-full rounded border-gray-300 shadow-sm px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Room type</label>
                <input type="text" name="room_type" value="{{ $roomType ?? '' }}" placeholder="Optional" class="w-full rounded border-gray-300 shadow-sm px-3 py-2">
            </div>
            <button type="submit" class="px-4 py-2 bg-gold-dark text-white rounded-lg hover:bg-gold hover:text-gray-900 font-medium w-full sm:w-auto">Search</button>
        </form>

        @if(isset($totalAvailable))
            <p class="text-gray-700 mb-4">{{ $totalAvailable }} room(s) available for your dates.</p>
            @if(empty($availableRooms))
                <p class="text-gray-600">No rooms match your criteria. Try different dates or room type.</p>
            @else
                <div class="space-y-4">
                    @foreach($availableRooms as $ar)
                        @php $ar = (object) $ar; @endphp
                        <div class="bg-white rounded-lg shadow border border-gray-200 p-4 flex flex-col sm:flex-row sm:flex-wrap sm:justify-between sm:items-center gap-3 sm:gap-4">
                            <div class="min-w-0">
                                <span class="font-semibold text-gray-900">{{ $ar->roomType ?? 'Room' }}</span>
                                <span class="text-gray-600 ml-2">#{{ $ar->roomNumber ?? '-' }}</span>
                                @if(!empty($ar->maxOccupancy))
                                    <span class="text-sm text-gray-500 ml-2">· Up to {{ $ar->maxOccupancy }} guests</span>
                                @endif
                            </div>
                            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                                @if(!empty($ar->pricePerNight))
                                    <span class="text-gold-dark font-semibold text-sm sm:text-base">LKR {{ number_format($ar->pricePerNight, 0) }} / night</span>
                                @endif
                                <a href="{{ route('bookings.create') }}?check_in={{ $checkIn ?? '' }}&check_out={{ $checkOut ?? '' }}&room_number={{ $ar->roomNumber ?? '' }}&room_type={{ urlencode($ar->roomType ?? '') }}" class="inline-block px-4 py-2 bg-gold-dark text-white rounded-lg hover:bg-gold hover:text-gray-900 text-sm font-medium text-center">Book</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </main>

    <footer class="border-t border-gray-200 mt-12">
        <div class="max-w-6xl mx-auto px-4 py-6 text-center text-gray-500 text-sm">&copy; {{ date('Y') }} Golden Sky Hotel & Wellness</div>
    </footer>
</body>
</html>
