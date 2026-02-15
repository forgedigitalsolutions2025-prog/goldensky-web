@extends('layouts.admin')

@section('title', 'Order ' . ($order['orderId'] ?? $order['order_id'] ?? ''))

@section('content')
    @php
        $orderId = $order['orderId'] ?? $order['order_id'] ?? '-';
        $orderType = $order['orderType'] ?? $order['order_type'] ?? '-';
        $status = $order['status'] ?? '-';
        $tableNumber = $order['tableNumber'] ?? $order['table_number'] ?? null;
        $roomNumber = $order['roomNumber'] ?? $order['room_number'] ?? null;
        $tableOrRoom = $tableNumber ?: $roomNumber ?: '-';
        $guestName = $order['guestName'] ?? $order['guest_name'] ?? null;
        $waiterName = $order['waiterName'] ?? $order['waiter_name'] ?? null;
        $dateRaw = $order['orderDate'] ?? $order['order_date'] ?? $order['createdAt'] ?? $order['created_at'] ?? null;
        $date = $dateRaw ? \Carbon\Carbon::parse($dateRaw)->format('M d, Y H:i') : '-';
        $subtotal = $order['subtotal'] ?? 0;
        $discount = $order['discount'] ?? 0;
        $serviceCharge = $order['serviceCharge'] ?? $order['service_charge'] ?? 0;
        $total = $order['total'] ?? 0;
        $invoiceNumber = $order['invoiceNumber'] ?? $order['invoice_number'] ?? null;
        $items = $order['items'] ?? [];
        $isStaffMeal = !empty($order['isStaffMeal'] ?? $order['is_staff_meal'] ?? false);
        $staffName = $order['staffName'] ?? $order['staff_name'] ?? null;
    @endphp

    <div class="mb-6 sm:mb-8">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Order {{ $orderId }}</h1>
        <p class="text-slate-500 text-sm sm:text-base mt-1">Restaurant order details</p>
    </div>

    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Order Information</h3>
        <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
            <div>
                <dt class="text-slate-500 font-medium">Order ID</dt>
                <dd class="font-semibold text-slate-900">{{ $orderId }}</dd>
            </div>
            <div>
                <dt class="text-slate-500 font-medium">Type</dt>
                <dd class="text-slate-900">{{ $orderType }}</dd>
            </div>
            <div>
                <dt class="text-slate-500 font-medium">Status</dt>
                <dd>
                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ in_array($status, ['COMPLETED', 'PAID']) ? 'bg-emerald-100 text-emerald-800' : (in_array($status, ['CANCELLED', 'VOIDED']) ? 'bg-red-100 text-red-800' : 'bg-slate-100 text-slate-700') }}">{{ $status }}</span>
                </dd>
            </div>
            <div>
                <dt class="text-slate-500 font-medium">{{ $roomNumber ? 'Room' : 'Table' }}</dt>
                <dd class="text-slate-900">{{ $tableOrRoom }}</dd>
            </div>
            <div>
                <dt class="text-slate-500 font-medium">Date</dt>
                <dd class="text-slate-900">{{ $date }}</dd>
            </div>
            @if($invoiceNumber)
            <div>
                <dt class="text-slate-500 font-medium">Invoice #</dt>
                <dd class="text-slate-900">{{ $invoiceNumber }}</dd>
            </div>
            @endif
            @if($guestName)
            <div>
                <dt class="text-slate-500 font-medium">Guest</dt>
                <dd class="text-slate-900">{{ $guestName }}</dd>
            </div>
            @endif
            @if($waiterName)
            <div>
                <dt class="text-slate-500 font-medium">Waiter</dt>
                <dd class="text-slate-900">{{ $waiterName }}</dd>
            </div>
            @endif
            @if($isStaffMeal && $staffName)
            <div>
                <dt class="text-slate-500 font-medium">Staff Meal</dt>
                <dd class="text-slate-900">{{ $staffName }}</dd>
            </div>
            @endif
        </dl>
    </div>

    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Order Items</h3>
        @if(empty($items))
            <p class="text-slate-500">No items in this order.</p>
        @else
            <div class="overflow-x-auto table-responsive -mx-2 sm:mx-0">
                <table class="min-w-[400px] divide-y divide-slate-200 w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Item</th>
                            <th class="px-4 sm:px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Qty</th>
                            <th class="px-4 sm:px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Unit Price</th>
                            <th class="px-4 sm:px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Total</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider hidden sm:table-cell">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($items as $item)
                            @php
                                $itemName = $item['menuItemName'] ?? $item['menu_item_name'] ?? $item['name'] ?? '-';
                                $quantity = $item['quantity'] ?? 0;
                                $unitPrice = $item['unitPrice'] ?? $item['unit_price'] ?? 0;
                                $itemTotal = $item['total'] ?? ($quantity * (float)$unitPrice);
                                $notes = $item['specialInstructions'] ?? $item['special_instructions'] ?? '';
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 sm:px-6 py-3 text-sm font-medium text-slate-900">{{ $itemName }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-right text-slate-700">{{ $quantity }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-right text-slate-700">LKR {{ number_format((float)$unitPrice, 2) }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-right font-medium text-slate-900">LKR {{ number_format((float)$itemTotal, 2) }}</td>
                                <td class="px-4 sm:px-6 py-3 text-sm text-slate-600 hidden sm:table-cell max-w-[180px] truncate" title="{{ $notes }}">{{ $notes ?: '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-200 space-y-1 text-sm text-right">
                @if((float)$discount > 0)
                    <p class="text-slate-600">Subtotal: LKR {{ number_format((float)$subtotal, 2) }}</p>
                    <p class="text-slate-600">Discount: -LKR {{ number_format((float)$discount, 2) }}</p>
                @endif
                @if((float)$serviceCharge > 0)
                    <p class="text-slate-600">Service charge: LKR {{ number_format((float)$serviceCharge, 2) }}</p>
                @endif
                <p class="font-bold text-slate-900 text-base">Total: LKR {{ number_format((float)$total, 2) }}</p>
            </div>
        @endif
    </div>

    <a href="{{ route('admin.restaurant') }}" class="inline-flex items-center text-slate-700 hover:text-slate-900 font-medium text-sm transition-colors">
        ← Back to Restaurant
    </a>
@endsection
