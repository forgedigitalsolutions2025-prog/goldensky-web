@extends('layouts.admin')

@section('title', 'Revenue')
@push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')
    <div class="mb-6 sm:mb-8">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Revenue</h1>
        <p class="text-slate-500 text-sm sm:text-base mt-1">Revenue details and breakdown for the selected period</p>
    </div>

    <form method="GET" action="{{ route('admin.revenue') }}" class="mb-6 space-y-4">
        <div class="flex flex-wrap items-center gap-3">
            <label class="text-slate-700 font-medium text-sm">Period:</label>
            <select name="period" id="revenue-period-select" class="w-full sm:w-auto sm:max-w-[180px] border-slate-300 rounded-lg focus:ring-2 focus:ring-gold-dark/30 focus:border-gold-dark text-sm py-2.5 px-4 bg-white shadow-sm">
                <option value="day" {{ $period == 'day' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ $period == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ $period == 'month' ? 'selected' : '' }}>This Month</option>
                <option value="year" {{ $period == 'year' ? 'selected' : '' }}>This Year</option>
                <option value="custom" {{ $period == 'custom' ? 'selected' : '' }}>Custom range</option>
            </select>
        </div>
        <div id="revenue-date-range-inputs" class="flex flex-wrap items-center gap-3 {{ $period == 'custom' ? '' : 'hidden' }}">
            <label class="text-slate-700 font-medium text-sm">From:</label>
            <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="border-slate-300 rounded-lg focus:ring-2 focus:ring-gold-dark/30 focus:border-gold-dark text-sm py-2.5 px-4 bg-white shadow-sm">
            <label class="text-slate-700 font-medium text-sm">To:</label>
            <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="border-slate-300 rounded-lg focus:ring-2 focus:ring-gold-dark/30 focus:border-gold-dark text-sm py-2.5 px-4 bg-white shadow-sm">
            <button type="submit" class="px-4 py-2.5 bg-gold-dark text-white rounded-lg hover:bg-gold-dark/90 font-medium text-sm transition">Apply</button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var sel = document.getElementById('revenue-period-select');
                var range = document.getElementById('revenue-date-range-inputs');
                if (sel && range) {
                    sel.addEventListener('change', function() {
                        if (this.value === 'custom') range.classList.remove('hidden');
                        else { range.classList.add('hidden'); window.location = '{{ route('admin.revenue') }}?period=' + encodeURIComponent(this.value); }
                    });
                }
            });
        </script>
    </form>

    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-6 sm:mb-8">
        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Total Revenue</p>
        <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 mt-2">LKR {{ number_format($totalRevenue, 2) }}</p>
        <p class="text-sm text-slate-500 mt-1">{{ $startDate->format('M d, Y') }} – {{ $endDate->format('M d, Y') }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6 sm:mb-8">
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Room Revenue</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">LKR {{ number_format($revenueBreakdown['room'] ?? 0, 2) }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Restaurant Revenue</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">LKR {{ number_format($revenueBreakdown['restaurant'] ?? 0, 2) }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Additional Revenue</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">LKR {{ number_format($revenueBreakdown['additional'] ?? 0, 2) }}</p>
        </div>
    </div>

    @if(count($chartData) > 0)
    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-6 sm:mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Revenue Trend</h3>
        <div class="min-w-[280px] h-[200px] sm:h-[260px]">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-2">Payment Transactions</h3>
        <p class="text-sm text-slate-500 mb-4">Individual payments that make up the total revenue</p>
        @if(count($paymentTransactions ?? []) > 0)
        <div class="overflow-x-auto table-responsive -mx-2 sm:mx-0">
            <table class="min-w-[600px] divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Date</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Payment ID</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase hidden md:table-cell">Booking ID</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Type</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase hidden lg:table-cell">Method</th>
                        <th class="px-4 sm:px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($paymentTransactions as $tx)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700">{{ $tx['date']->format('M d, Y H:i') }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm font-medium text-slate-900">{{ $tx['paymentId'] }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 hidden md:table-cell">{{ $tx['bookingId'] ?: '—' }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm"><span class="inline-flex px-2 py-0.5 rounded-lg bg-slate-100 text-xs font-medium text-slate-700">{{ $tx['paymentType'] }}</span></td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 hidden lg:table-cell">{{ $tx['paymentMethod'] ?: '—' }}</td>
                            <td class="px-4 sm:px-6 py-3 text-sm text-right font-semibold text-slate-900">LKR {{ number_format($tx['amount'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-slate-500">No payment transactions for this period.</p>
        @endif
    </div>

    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-slate-700 hover:text-slate-900 font-medium text-sm transition-colors">
        Back to Dashboard
    </a>
@endsection

@push('scripts')
@if(count($chartData) > 0)
<script>
    const ctx = document.getElementById('revenueChart');
    const revenueData = @json($chartData);
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
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endif
@endpush
