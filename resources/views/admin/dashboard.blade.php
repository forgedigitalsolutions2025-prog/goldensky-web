@extends('layouts.admin')

@section('title', 'Dashboard')
@push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')
    @if(!empty($backendUrlForDebug))
        <p class="mb-4 text-xs text-slate-500">Debug: Backend API = <code class="bg-slate-200 px-1.5 py-0.5 rounded text-slate-700">{{ $backendUrlForDebug }}</code> (set APP_DEBUG=false in production)</p>
    @endif

    <div class="mb-6 sm:mb-8">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Business Analytics Dashboard</h1>
        <p class="text-slate-500 text-sm sm:text-base mt-1">Overview of revenue, expenses, bookings and operations</p>
    </div>

    <!-- Period & Date Range Selector -->
    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-6 space-y-4">
        <div class="flex flex-wrap items-center gap-3">
            <label class="text-slate-700 font-medium text-sm">Period:</label>
            <select name="period" id="period-select" class="w-full sm:w-auto sm:max-w-[180px] border-slate-300 rounded-lg focus:ring-2 focus:ring-gold-dark/30 focus:border-gold-dark text-sm py-2.5 px-4 bg-white shadow-sm">
                <option value="day" {{ $period == 'day' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ $period == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ $period == 'month' ? 'selected' : '' }}>This Month</option>
                <option value="year" {{ $period == 'year' ? 'selected' : '' }}>This Year</option>
                <option value="custom" {{ $period == 'custom' ? 'selected' : '' }}>Custom range</option>
            </select>
        </div>
        <div id="date-range-inputs" class="flex flex-wrap items-center gap-3 {{ $period == 'custom' ? '' : 'hidden' }}">
            <label class="text-slate-700 font-medium text-sm">From:</label>
            <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="border-slate-300 rounded-lg focus:ring-2 focus:ring-gold-dark/30 focus:border-gold-dark text-sm py-2.5 px-4 bg-white shadow-sm">
            <label class="text-slate-700 font-medium text-sm">To:</label>
            <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="border-slate-300 rounded-lg focus:ring-2 focus:ring-gold-dark/30 focus:border-gold-dark text-sm py-2.5 px-4 bg-white shadow-sm">
            <button type="submit" class="px-4 py-2.5 bg-gold-dark text-white rounded-lg hover:bg-gold-dark/90 font-medium text-sm transition">Apply</button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var sel = document.getElementById('period-select');
                var range = document.getElementById('date-range-inputs');
                if (sel && range) {
                    sel.addEventListener('change', function() {
                        if (this.value === 'custom') {
                            range.classList.remove('hidden');
                        } else {
                            range.classList.add('hidden');
                            window.location = '{{ route('admin.dashboard') }}?period=' + encodeURIComponent(this.value);
                        }
                    });
                }
            });
        </script>
    </form>

    <!-- Quick Links -->
    <div class="flex flex-wrap gap-2 sm:gap-3 mb-8">
        <a href="{{ route('admin.revenue') }}" class="px-4 py-3 sm:py-2.5 bg-white rounded-lg border border-slate-200 hover:border-slate-300 hover:bg-slate-50/50 font-medium text-slate-700 text-sm transition min-h-[44px] flex items-center">
            Revenue
        </a>
        <a href="{{ route('admin.expenses') }}" class="px-4 py-3 sm:py-2.5 bg-white rounded-lg border border-slate-200 hover:border-slate-300 hover:bg-slate-50/50 font-medium text-slate-700 text-sm transition min-h-[44px] flex items-center">
            Expenses
        </a>
    </div>

    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-6 gap-4 sm:gap-5 mb-8">
        <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-5">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Total Revenue</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1 truncate">LKR {{ number_format($metrics['room_revenue'], 2) }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-5">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Total Expenses</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1 truncate">LKR {{ number_format($metrics['total_expenses'] ?? 0, 2) }}</p>
        </div>
        @php $netProfit = $metrics['net_profit'] ?? 0; $isProfit = $netProfit >= 0; @endphp
        <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-5">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Net Profit</p>
            <p class="text-xl sm:text-2xl font-bold mt-1 truncate {{ $isProfit ? 'text-slate-900' : 'text-red-600' }}">LKR {{ number_format($netProfit, 2) }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-5">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Total Bookings</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $metrics['total_bookings'] }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-5">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Occupancy Rate</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $metrics['occupancy_rate'] }}%</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-5">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Available Rooms</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $metrics['available_rooms'] }}/{{ $metrics['total_rooms'] }}</p>
        </div>
    </div>

    <!-- Expenses Breakdown -->
    @if(isset($metrics['expenses_breakdown']) && ($metrics['total_expenses'] ?? 0) > 0)
    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-4">Expenses Breakdown</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            @if($metrics['expenses_breakdown']['grn'] > 0)
            <div class="bg-slate-50/50 rounded-lg border border-slate-100 p-3 sm:p-4">
                <p class="text-slate-600 text-xs sm:text-sm font-medium">Inventory (GRN)</p>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-1">LKR {{ number_format($metrics['expenses_breakdown']['grn'], 2) }}</p>
            </div>
            @endif
            @if($metrics['expenses_breakdown']['staff_meals'] > 0)
            <div class="bg-slate-50/50 rounded-lg border border-slate-100 p-3 sm:p-4">
                <p class="text-slate-600 text-xs sm:text-sm font-medium">Staff Meals</p>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-1">LKR {{ number_format($metrics['expenses_breakdown']['staff_meals'], 2) }}</p>
            </div>
            @endif
            @if($metrics['expenses_breakdown']['salaries'] > 0)
            <div class="bg-slate-50/50 rounded-lg border border-slate-100 p-3 sm:p-4">
                <p class="text-slate-600 text-xs sm:text-sm font-medium">Salaries</p>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-1">LKR {{ number_format($metrics['expenses_breakdown']['salaries'], 2) }}</p>
                <p class="text-xs text-slate-500 mt-0.5">Finalized on payment date</p>
            </div>
            @endif
            @if($metrics['expenses_breakdown']['other'] > 0)
            <div class="bg-slate-50/50 rounded-lg border border-slate-100 p-3 sm:p-4">
                <p class="text-slate-600 text-xs sm:text-sm font-medium">Other Expenses</p>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-1">LKR {{ number_format($metrics['expenses_breakdown']['other'], 2) }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Status Cards Row -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-8">
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <p class="text-slate-500 text-xs sm:text-sm">Active Check-Ins</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $metrics['active_bookings'] }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <p class="text-slate-500 text-xs sm:text-sm">Pending Bookings</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $metrics['pending_bookings'] }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <p class="text-slate-500 text-xs sm:text-sm">Completed</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $metrics['completed_bookings'] }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <p class="text-slate-500 text-xs sm:text-sm">Total Guests</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $metrics['total_guests'] }}</p>
        </div>
    </div>

    <!-- Revenue Chart -->
    @if(count($charts['revenue']) > 0)
    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-4">Revenue Trend</h2>
        <div class="overflow-x-auto -mx-2 sm:mx-0">
            <div class="min-w-[280px] h-[200px] sm:h-[240px]">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    @endif

    <!-- Room List -->
    @if(isset($roomList) && count($roomList) > 0)
    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-4">Room List</h2>
        <div class="overflow-x-auto -mx-2 sm:mx-0" style="-webkit-overflow-scrolling: touch;">
            <table class="min-w-[640px] divide-y divide-slate-200 w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Room #</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Type</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Status</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Guest Name</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Check-In</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Check-Out</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach($roomList as $room)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-4 sm:px-6 py-3 text-sm font-medium text-slate-900 whitespace-nowrap">{{ $room['room_number'] }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $room['room_type'] }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">
                                @if(($room['status'] ?? '') === 'OCCUPIED' || $room['status'] === 'CHECKED_IN' || $room['guest_name'])
                                    <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Occupied</span>
                                @elseif(($room['status'] ?? '') === 'AVAILABLE')
                                    <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-100 text-emerald-800">Available</span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-slate-100 text-slate-700">{{ $room['status'] ?? '—' }}</span>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $room['guest_name'] ?? '—' }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $room['check_in'] ?? '—' }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $room['check_out'] ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Recent Bookings Table -->
    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6">
        <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-4">Recent Bookings</h2>
        <div class="overflow-x-auto table-responsive -mx-2 sm:mx-0">
            <table class="min-w-[640px] divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Booking ID</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Guest</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Room</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider hidden md:table-cell">Check-In</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nights</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider hidden lg:table-cell">Source</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach($recentBookings as $booking)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-4 sm:px-6 py-3 text-sm font-medium text-slate-900">{{ $booking['booking_id'] }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700">{{ $booking['guest_name'] }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700">{{ $booking['room_number'] }} — {{ $booking['room_type'] }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 hidden md:table-cell">{{ $booking['check_in'] }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700">{{ $booking['nights'] }}</td>
                            <td class="px-4 sm:px-6 py-3">
                                @if($booking['status'] == 'PENDING')
                                    <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-amber-100 text-amber-800">Pending</span>
                                @elseif($booking['status'] == 'CHECKED_IN')
                                    <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Checked In</span>
                                @elseif($booking['status'] == 'CHECKED_OUT')
                                    <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-100 text-emerald-800">Completed</span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800">Cancelled</span>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-600 hidden lg:table-cell"><span class="px-2 py-0.5 text-xs font-medium rounded-lg bg-slate-100">{{ $booking['source'] }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
@if(count($charts['revenue']) > 0)
<script>
    const ctx = document.getElementById('revenueChart');
    const revenueData = @json($charts['revenue']);
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: revenueData.map(d => d.date),
            datasets: [{
                label: 'Revenue (LKR)',
                data: revenueData.map(d => d.revenue),
                borderColor: '#B8860B',
                backgroundColor: 'rgba(184, 134, 11, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: true, position: 'top' },
                tooltip: { callbacks: { label: function(context) { return 'Revenue: LKR ' + context.parsed.y.toLocaleString(); } } }
            },
            scales: { y: { beginAtZero: true, ticks: { callback: function(value) { return 'LKR ' + value.toLocaleString(); } } } }
        }
    });
</script>
@endif
@endpush
