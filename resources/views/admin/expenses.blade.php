@extends('layouts.admin')

@section('title', 'Expenses')

@section('content')
    <div class="mb-6 sm:mb-8">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Expenses</h1>
        <p class="text-slate-500 text-sm sm:text-base mt-1">Expense totals and breakdown by type for the selected period</p>
    </div>

    <form method="GET" action="{{ route('admin.expenses') }}" class="mb-6 flex flex-wrap items-center gap-3">
        <label class="text-slate-700 font-medium text-sm">Period:</label>
        <select name="period" onchange="this.form.submit()" class="w-full sm:w-auto sm:max-w-[180px] border-slate-300 rounded-lg focus:ring-2 focus:ring-gold-dark/30 focus:border-gold-dark text-sm py-2.5 px-4 bg-white shadow-sm">
            <option value="day" {{ $period == 'day' ? 'selected' : '' }}>Today</option>
            <option value="week" {{ $period == 'week' ? 'selected' : '' }}>This Week</option>
            <option value="month" {{ $period == 'month' ? 'selected' : '' }}>This Month</option>
            <option value="year" {{ $period == 'year' ? 'selected' : '' }}>This Year</option>
        </select>
    </form>

    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-6 sm:mb-8">
        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide">Total Expenses</p>
        <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 mt-2">LKR {{ number_format($total, 2) }}</p>
        <p class="text-sm text-slate-500 mt-1">{{ $startDate->format('M d, Y') }} – {{ $endDate->format('M d, Y') }}</p>
    </div>

    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Breakdown by Type</h3>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
            @if($breakdown['grn'] > 0)
            <div class="bg-slate-50/50 rounded-lg border border-slate-100 p-3 sm:p-4">
                <p class="text-slate-600 text-xs sm:text-sm font-medium">Inventory (GRN)</p>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-1">LKR {{ number_format($breakdown['grn'], 2) }}</p>
            </div>
            @endif
            @if($breakdown['staff_meals'] > 0)
            <div class="bg-slate-50/50 rounded-lg border border-slate-100 p-3 sm:p-4">
                <p class="text-slate-600 text-xs sm:text-sm font-medium">Staff Meals</p>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-1">LKR {{ number_format($breakdown['staff_meals'], 2) }}</p>
            </div>
            @endif
            @if($breakdown['salaries'] > 0)
            <div class="bg-slate-50/50 rounded-lg border border-slate-100 p-3 sm:p-4">
                <p class="text-slate-600 text-xs sm:text-sm font-medium">Salaries</p>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-1">LKR {{ number_format($breakdown['salaries'], 2) }}</p>
            </div>
            @endif
            @if($breakdown['other'] > 0)
            <div class="bg-slate-50/50 rounded-lg border border-slate-100 p-3 sm:p-4">
                <p class="text-slate-600 text-xs sm:text-sm font-medium">Other Expenses</p>
                <p class="text-lg sm:text-xl font-bold text-slate-900 mt-1">LKR {{ number_format($breakdown['other'], 2) }}</p>
            </div>
            @endif
        </div>

        <h4 class="text-base font-semibold text-slate-700 mt-8 mb-3">Detail by Type</h4>

        @if(count($expensesByType['grn']) > 0)
        <div class="mb-6">
            <button type="button" onclick="toggleSection('grn-detail')" class="flex items-center gap-2 text-slate-700 font-semibold hover:text-gold-dark min-h-[44px] -ml-1 pl-1 rounded-lg hover:bg-slate-50 transition">
                <svg id="grn-detail-chevron" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                Inventory (GRN)
            </button>
            <div id="grn-detail" class="mt-3 overflow-x-auto table-responsive">
                <table class="min-w-[400px] divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50"><tr><th class="px-4 py-2 text-left font-medium text-gray-700">Date</th><th class="px-4 py-2 text-left font-medium text-gray-700">GRN #</th><th class="px-4 py-2 text-right font-medium text-gray-700">Amount</th><th class="px-4 py-2 text-left font-medium text-gray-700">Items</th></tr></thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($expensesByType['grn'] as $exp)
                            @php
                                $grnNum = $exp['referenceId'];
                                $grn = $grnsByNumber[$grnNum] ?? null;
                                $items = $grn['items'] ?? [];
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-gray-700">{{ $exp['date'] ? \Carbon\Carbon::parse($exp['date'])->format('M d, Y') : '-' }}</td>
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $grnNum ?: '-' }}</td>
                                <td class="px-4 py-2 text-right font-semibold">LKR {{ number_format($exp['amount'], 2) }}</td>
                                <td class="px-4 py-2">
                                    @if(count($items) > 0)
                                        <button type="button" onclick="toggleGrnItems('grn-items-{{ $loop->index }}')" class="text-gold-dark hover:underline text-xs">
                                            {{ count($items) }} items &darr;
                                        </button>
                                        <div id="grn-items-{{ $loop->index }}" class="hidden mt-2 ml-4 text-xs border-l-2 border-gray-200 pl-2">
                                            @foreach($items as $it)
                                                @php
                                                    $qty = $it['quantity'] ?? 0;
                                                    $up = $it['unitCost'] ?? $it['unit_cost'] ?? $it['unitPrice'] ?? $it['unit_price'] ?? 0;
                                                    $name = $it['itemName'] ?? $it['item_name'] ?? $it['ingredientName'] ?? $it['ingredient_name'] ?? '-';
                                                @endphp
                                                <div class="py-0.5">{{ $name }}: {{ $qty }} {{ $it['unit'] ?? '' }} × LKR {{ number_format((float)$up, 2) }}</div>
                                            @endforeach
                                        </div>
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if(count($expensesByType['staff_meals']) > 0)
        <div class="mb-6">
            <button type="button" onclick="toggleSection('staff-detail')" class="flex items-center gap-2 text-slate-700 font-semibold hover:text-gold-dark min-h-[44px] -ml-1 pl-1 rounded-lg hover:bg-slate-50 transition">
                <svg id="staff-detail-chevron" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                Staff Meals
            </button>
            <div id="staff-detail" class="mt-3 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50"><tr><th class="px-4 py-2 text-left font-medium text-gray-700">Date</th><th class="px-4 py-2 text-left font-medium text-gray-700">Ref</th><th class="px-4 py-2 text-right font-medium text-gray-700">Amount</th></tr></thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($expensesByType['staff_meals'] as $exp)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-gray-700">{{ $exp['date'] ? \Carbon\Carbon::parse($exp['date'])->format('M d, Y') : '-' }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ Str::limit($exp['description'] ?? $exp['referenceId'] ?? '-', 40) }}</td>
                                <td class="px-4 py-2 text-right font-semibold">LKR {{ number_format($exp['amount'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if(count($expensesByType['salaries']) > 0)
        <div class="mb-6">
            <button type="button" onclick="toggleSection('salary-detail')" class="flex items-center gap-2 text-slate-700 font-semibold hover:text-gold-dark min-h-[44px] -ml-1 pl-1 rounded-lg hover:bg-slate-50 transition">
                <svg id="salary-detail-chevron" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                Salaries
            </button>
            <div id="salary-detail" class="mt-3 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50"><tr><th class="px-4 py-2 text-left font-medium text-gray-700">Date</th><th class="px-4 py-2 text-left font-medium text-gray-700">Ref</th><th class="px-4 py-2 text-right font-medium text-gray-700">Amount</th></tr></thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($expensesByType['salaries'] as $exp)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-gray-700">{{ $exp['date'] ? \Carbon\Carbon::parse($exp['date'])->format('M d, Y') : '-' }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ Str::limit($exp['description'] ?? $exp['referenceId'] ?? '-', 40) }}</td>
                                <td class="px-4 py-2 text-right font-semibold">LKR {{ number_format($exp['amount'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if(count($expensesByType['other']) > 0)
        <div class="mb-6">
            <button type="button" onclick="toggleSection('other-detail')" class="flex items-center gap-2 text-slate-700 font-semibold hover:text-gold-dark min-h-[44px] -ml-1 pl-1 rounded-lg hover:bg-slate-50 transition">
                <svg id="other-detail-chevron" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                Other Expenses
            </button>
            <div id="other-detail" class="mt-3 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50"><tr><th class="px-4 py-2 text-left font-medium text-gray-700">Date</th><th class="px-4 py-2 text-left font-medium text-gray-700">Ref</th><th class="px-4 py-2 text-right font-medium text-gray-700">Amount</th></tr></thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($expensesByType['other'] as $exp)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-gray-700">{{ $exp['date'] ? \Carbon\Carbon::parse($exp['date'])->format('M d, Y') : '-' }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ Str::limit($exp['description'] ?? $exp['referenceId'] ?? '-', 40) }}</td>
                                <td class="px-4 py-2 text-right font-semibold">LKR {{ number_format($exp['amount'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if($total == 0)
        <p class="text-slate-500">No expenses recorded for this period.</p>
        @endif
    </div>

    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-slate-700 hover:text-slate-900 font-medium text-sm transition-colors">
        Back to Dashboard
    </a>
@endsection

@push('scripts')
<script>
    function toggleSection(id) {
        var el = document.getElementById(id);
        var chevron = document.getElementById(id + '-chevron');
        if (el.classList.contains('hidden')) {
            el.classList.remove('hidden');
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        } else {
            el.classList.add('hidden');
            if (chevron) chevron.style.transform = 'rotate(-90deg)';
        }
    }
    function toggleGrnItems(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
</script>
@endpush
