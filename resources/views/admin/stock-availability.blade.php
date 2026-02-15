@extends('layouts.admin')

@section('title', 'Stock Availability')

@section('content')
    <div class="mb-6 sm:mb-8">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Stock Availability</h1>
        <p class="text-slate-500 text-sm sm:text-base mt-1">Restaurant inventory – current stock levels from the restaurant app</p>
    </div>

    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Inventory Items</h3>
        @if(empty($inventoryItems))
            <p class="text-slate-500">No inventory items found. Inventory is managed in the Restaurant app.</p>
        @else
            <div class="overflow-x-auto table-responsive -mx-2 sm:mx-0">
                <table class="min-w-[520px] divide-y divide-slate-200 w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Item ID</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Item Name</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Category</th>
                            <th class="px-4 sm:px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Quantity</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Unit</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider hidden md:table-cell">Description</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($inventoryItems as $item)
                            @php
                                $itemId = $item['itemId'] ?? $item['item_id'] ?? '-';
                                $itemName = $item['itemName'] ?? $item['item_name'] ?? '-';
                                $category = $item['category'] ?? '-';
                                $quantity = $item['quantity'] ?? 0;
                                $unit = $item['unit'] ?? '-';
                                $description = $item['description'] ?? '';
                                $isZero = (float)$quantity == 0;
                            @endphp
                            <tr class="{{ $isZero ? 'bg-red-50 hover:bg-red-100/80' : 'hover:bg-slate-50/80' }} transition-colors">
                                <td class="px-4 sm:px-6 py-3 text-sm font-medium text-slate-900 whitespace-nowrap">{{ $itemId }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-700">{{ $itemName }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $category }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-right font-medium {{ $isZero ? 'text-red-600' : 'text-slate-900' }}">{{ number_format((float)$quantity, 2) }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $unit }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-600 hidden md:table-cell max-w-[200px] truncate" title="{{ $description }}">{{ Str::limit($description, 40) ?: '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-slate-700 hover:text-slate-900 font-medium text-sm transition-colors">
        Back to Dashboard
    </a>
@endsection
