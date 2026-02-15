@extends('layouts.admin')

@section('title', 'Restaurant')

@section('content')
    <div class="mb-6 sm:mb-8">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Restaurant</h1>
        <p class="text-slate-500 text-sm sm:text-base mt-1">Bills and Kitchen Order Tickets (KOTs) from the restaurant app</p>
    </div>

    {{-- Bills --}}
    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Bills (Invoices)</h3>
        <p class="text-slate-500 text-sm mb-4">Completed orders with invoices</p>
        @if(empty($bills))
            <p class="text-slate-500">No bills found. Bills are generated when restaurant orders are invoiced.</p>
        @else
            <div class="overflow-x-auto table-responsive -mx-2 sm:mx-0">
                <table class="min-w-[520px] divide-y divide-slate-200 w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Invoice #</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Order ID</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Table / Room</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Date</th>
                            <th class="px-4 sm:px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($bills as $bill)
                            @php
                                $invNo = $bill['invoiceNumber'] ?? $bill['invoice_number'] ?? '-';
                                $orderId = $bill['orderId'] ?? $bill['order_id'] ?? '-';
                                $tableOrRoom = $bill['tableNumber'] ?? $bill['table_number'] ?? $bill['roomNumber'] ?? $bill['room_number'] ?? '-';
                                $dateRaw = $bill['orderDate'] ?? $bill['order_date'] ?? $bill['createdAt'] ?? $bill['created_at'] ?? null;
                                $date = $dateRaw ? \Carbon\Carbon::parse($dateRaw)->format('M d, Y H:i') : '-';
                                $total = $bill['total'] ?? 0;
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 sm:px-6 py-3 text-sm font-medium text-slate-900 whitespace-nowrap">{{ $invNo }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm whitespace-nowrap">
                                    <a href="{{ route('admin.restaurant.order.show', ['orderId' => $orderId]) }}" class="text-gold-dark hover:text-gold-dark/80 font-medium underline decoration-gold-dark/50 hover:decoration-gold-dark transition">{{ $orderId }}</a>
                                </td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $tableOrRoom }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $date }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-right font-medium text-slate-900">LKR {{ number_format((float)$total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- KOTs (Kitchen Order Tickets) --}}
    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Kitchen Order Tickets (KOTs)</h3>
        <p class="text-slate-500 text-sm mb-4">All restaurant orders sent to the kitchen</p>
        @if(empty($kots))
            <p class="text-slate-500">No KOTs found. KOTs are created when orders are placed in the restaurant app.</p>
        @else
            <div class="overflow-x-auto table-responsive -mx-2 sm:mx-0">
                <table class="min-w-[520px] divide-y divide-slate-200 w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Order ID</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Table / Room</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Type</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Date</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                            <th class="px-4 sm:px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($kots as $kot)
                            @php
                                $orderId = $kot['orderId'] ?? $kot['order_id'] ?? '-';
                                $tableOrRoom = $kot['tableNumber'] ?? $kot['table_number'] ?? $kot['roomNumber'] ?? $kot['room_number'] ?? '-';
                                $orderType = $kot['orderType'] ?? $kot['order_type'] ?? '-';
                                $dateRaw = $kot['orderDate'] ?? $kot['order_date'] ?? $kot['createdAt'] ?? $kot['created_at'] ?? null;
                                $date = $dateRaw ? \Carbon\Carbon::parse($dateRaw)->format('M d, Y H:i') : '-';
                                $status = $kot['status'] ?? '-';
                                $total = $kot['total'] ?? 0;
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 sm:px-6 py-3 text-sm whitespace-nowrap">
                                    <a href="{{ route('admin.restaurant.order.show', ['orderId' => $orderId]) }}" class="text-gold-dark hover:text-gold-dark/80 font-medium underline decoration-gold-dark/50 hover:decoration-gold-dark transition">{{ $orderId }}</a>
                                </td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $tableOrRoom }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $orderType }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-700 whitespace-nowrap">{{ $date }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ in_array($status, ['COMPLETED', 'PAID']) ? 'bg-emerald-100 text-emerald-800' : (in_array($status, ['CANCELLED', 'VOIDED']) ? 'bg-red-100 text-red-800' : 'bg-slate-100 text-slate-700') }}">{{ $status }}</span>
                                </td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-right font-medium text-slate-900">LKR {{ number_format((float)$total, 2) }}</td>
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
