<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Analytics - Golden Sky Hotel & Wellness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gold': '#FFD700',
                        'gold-dark': '#B8860B',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <nav class="bg-gradient-to-r from-gold-dark to-gold text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 py-4 sm:py-0 sm:h-16">
                <div class="flex items-center min-w-0">
                    <h1 class="text-lg sm:text-xl md:text-2xl font-bold truncate">Business Analytics Dashboard</h1>
                </div>
                <div class="flex flex-wrap items-center gap-2 sm:gap-4">
                    <a href="{{ route('admin.inventory-requests') }}" class="text-white hover:underline text-sm font-medium">Inventory Requests</a>
                    <span class="text-sm hidden sm:inline">Admin Panel</span>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-3 py-2 sm:px-4 rounded-md text-sm font-medium transition whitespace-nowrap">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Period Selector -->
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-wrap items-center gap-3 sm:gap-4">
                <label class="text-gray-700 font-semibold text-sm sm:text-base">Period:</label>
                <select name="period" onchange="this.form.submit()" class="border-gray-300 rounded-md focus:ring-gold focus:border-gold min-w-0 flex-1 sm:flex-initial max-w-xs">
                    <option value="day" {{ $period == 'day' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ $period == 'week' ? 'selected' : '' }}>This Week</option>
                    <option value="month" {{ $period == 'month' ? 'selected' : '' }}>This Month</option>
                    <option value="year" {{ $period == 'year' ? 'selected' : '' }}>This Year</option>
                </select>
            </form>
        </div>

        <!-- Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Revenue -->
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Total Revenue</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">LKR {{ number_format($metrics['room_revenue'], 2) }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Total Expenses -->
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Total Expenses</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">LKR {{ number_format($metrics['total_expenses'] ?? 0, 2) }}</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Net Profit -->
            @php
                $netProfit = $metrics['net_profit'] ?? 0;
                $isProfit = $netProfit >= 0;
            @endphp
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 {{ $isProfit ? 'border-green-500' : 'border-red-500' }}">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Net Profit</p>
                        <p class="text-3xl font-bold {{ $isProfit ? 'text-green-600' : 'text-red-600' }} mt-2">LKR {{ number_format($netProfit, 2) }}</p>
                    </div>
                    <div class="{{ $isProfit ? 'bg-green-100' : 'bg-red-100' }} p-3 rounded-full">
                        <svg class="w-8 h-8 {{ $isProfit ? 'text-green-600' : 'text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Bookings -->
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Total Bookings</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $metrics['total_bookings'] }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Occupancy Rate -->
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Occupancy Rate</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $metrics['occupancy_rate'] }}%</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Available Rooms -->
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Available Rooms</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $metrics['available_rooms'] }}/{{ $metrics['total_rooms'] }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Expenses Breakdown -->
        @if(isset($metrics['expenses_breakdown']) && ($metrics['total_expenses'] ?? 0) > 0)
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Expenses Breakdown</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @if($metrics['expenses_breakdown']['grn'] > 0)
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold">Inventory (GRN)</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">LKR {{ number_format($metrics['expenses_breakdown']['grn'], 2) }}</p>
                </div>
                @endif
                @if($metrics['expenses_breakdown']['staff_meals'] > 0)
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold">Staff Meals</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">LKR {{ number_format($metrics['expenses_breakdown']['staff_meals'], 2) }}</p>
                </div>
                @endif
                @if($metrics['expenses_breakdown']['salaries'] > 0)
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold">Salaries</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">LKR {{ number_format($metrics['expenses_breakdown']['salaries'], 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Finalized on payment date</p>
                </div>
                @endif
                @if($metrics['expenses_breakdown']['other'] > 0)
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-semibold">Other Expenses</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">LKR {{ number_format($metrics['expenses_breakdown']['other'], 2) }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Status Cards Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-600 text-sm">Active Check-Ins</p>
                <p class="text-2xl font-bold text-blue-600">{{ $metrics['active_bookings'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-600 text-sm">Pending Bookings</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $metrics['pending_bookings'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-600 text-sm">Completed</p>
                <p class="text-2xl font-bold text-green-600">{{ $metrics['completed_bookings'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-600 text-sm">Total Guests</p>
                <p class="text-2xl font-bold text-purple-600">{{ $metrics['total_guests'] }}</p>
            </div>
        </div>

        <!-- Revenue Chart -->
        @if(count($charts['revenue']) > 0)
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Revenue Trend</h2>
            <canvas id="revenueChart" height="80"></canvas>
        </div>
        @endif

        <!-- Recent Bookings Table -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Bookings</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gold-dark bg-opacity-10">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Booking ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Guest</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Room</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Check-In</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nights</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Source</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentBookings as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $booking['booking_id'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $booking['guest_name'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $booking['room_number'] }} - {{ $booking['room_type'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $booking['check_in'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $booking['nights'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($booking['status'] == 'PENDING')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @elseif($booking['status'] == 'CHECKED_IN')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Checked In</span>
                                    @elseif($booking['status'] == 'CHECKED_OUT')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <span class="px-2 py-1 text-xs font-medium rounded bg-gray-100">{{ $booking['source'] }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
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
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Revenue: LKR ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'LKR ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
    @endif
</body>
</html>



































