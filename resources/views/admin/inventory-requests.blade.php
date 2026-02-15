@extends('layouts.admin')

@section('title', 'Inventory Requests')

@section('content')
    <div class="mb-6 sm:mb-8">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Inventory Requests</h1>
        <p class="text-slate-500 text-sm sm:text-base mt-1">Requests with <strong class="text-slate-700">more than 10 items</strong> can only be approved or rejected here. Smaller requests can be approved from the Manager app.</p>
    </div>

    <div class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Pending Requests</h3>
        @if(empty($pendingRequests))
            <p class="text-slate-500">No pending inventory requests.</p>
        @else
            <div class="overflow-x-auto table-responsive -mx-2 sm:mx-0">
                <table class="min-w-[640px] divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Request ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase hidden md:table-cell">Requested By</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Reason</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Items</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($pendingRequests as $req)
                            @php
                                $items = $req['items'] ?? [];
                                $itemCount = count($items);
                                $isBig = $itemCount > 10;
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors" id="row-{{ $req['id'] }}">
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $req['requestId'] ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ isset($req['requestDate']) ? \Carbon\Carbon::parse($req['requestDate'])->format('M d, Y H:i') : '-' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700 hidden md:table-cell">{{ $req['requestedBy'] ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700 max-w-[120px] sm:max-w-xs truncate" title="{{ $req['reason'] ?? '' }}">{{ Str::limit($req['reason'] ?? '-', 25) }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="font-semibold {{ $isBig ? 'text-amber-600' : 'text-slate-700' }}">{{ $itemCount }}</span>
                                    @if($isBig)
                                        <span class="text-xs text-amber-600 block sm:inline">(Owner only)</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex flex-col sm:flex-row sm:gap-2">
                                        <button type="button" onclick="toggleDetail({{ $req['id'] }})" class="text-gold-dark hover:text-gold-dark/80 font-medium text-left py-1 min-h-[36px]">View / Approve</button>
                                        <button type="button" onclick="showRejectForm({{ $req['id'] }}, '{{ addslashes($req['requestId'] ?? '') }}')" class="text-red-600 hover:text-red-700 font-medium text-left py-1 min-h-[36px]">Reject</button>
                                    </div>
                                </td>
                            </tr>
                            <tr id="detail-{{ $req['id'] }}" class="hidden bg-slate-50">
                                <td colspan="6" class="px-4 py-3">
                                    <div class="text-sm">
                                        <p class="font-semibold text-slate-700 mb-2">Items — edit approved quantity if needed, then click Approve:</p>
                                        <form action="{{ route('admin.inventory-requests.approve', $req['id']) }}" method="POST" class="mb-4" onsubmit="return confirm('Approve this request with the quantities shown below?');">
                                            @csrf
                                            <input type="hidden" name="approved_by" value="Owner (Web Portal)">
                                            <div class="overflow-x-auto">
                                            <table class="min-w-[400px] text-xs border border-slate-200 rounded-lg overflow-hidden">
                                                <thead class="bg-slate-100"><tr><th class="text-left py-2 px-2">Ingredient</th><th class="text-left py-2 px-2">Requested</th><th class="text-left py-2 px-2">Approved Qty</th><th class="text-left py-2 px-2">Unit</th><th class="text-left py-2 px-2">Reason</th></tr></thead>
                                                <tbody>
                                                    @foreach($items as $idx => $it)
                                                        <tr class="border-t border-gray-200">
                                                            <td class="py-1 px-2">{{ $it['ingredientName'] ?? '-' }}</td>
                                                            <td class="py-1 px-2">{{ $it['quantity'] ?? '-' }}</td>
                                                            <td class="py-1 px-2">
                                                                <input type="hidden" name="approved_items[{{ $idx }}][ingredient_name]" value="{{ $it['ingredientName'] ?? '' }}">
                                                                <input type="number" name="approved_items[{{ $idx }}][approved_quantity]" value="{{ $it['quantity'] ?? 0 }}" min="0" step="any" class="w-20 border border-slate-300 rounded-lg px-2 py-1.5 text-slate-900 text-sm focus:ring-2 focus:ring-gold-dark/30 focus:border-gold-dark">
                                                            </td>
                                                            <td class="py-1 px-2">{{ $it['unit'] ?? '-' }}</td>
                                                            <td class="py-1 px-2">{{ Str::limit($it['itemReason'] ?? '-', 30) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            </div>
                                            <button type="submit" class="mt-2 px-4 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-medium transition min-h-[44px]">Approve request</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div id="all-requests" class="bg-white rounded-lg border border-slate-200 p-4 sm:p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">All Requests (reference)</h3>
        @if(empty($allRequests))
            <p class="text-slate-500">No inventory requests.</p>
        @else
            <div class="overflow-x-auto table-responsive">
                <table class="min-w-[500px] divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Request ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase hidden sm:table-cell">Requested By</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Items</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($allRequests as $req)
                            @php $cnt = count($req['items'] ?? []); @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $req['requestId'] ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ isset($req['requestDate']) ? \Carbon\Carbon::parse($req['requestDate'])->format('M d, Y') : '-' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700 hidden sm:table-cell">{{ $req['requestedBy'] ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $cnt }}</td>
                                <td class="px-4 py-3">
                                    @if(($req['status'] ?? '') === 'PENDING')
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-amber-100 text-amber-800">Pending</span>
                                    @elseif(($req['status'] ?? '') === 'APPROVED')
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-100 text-emerald-800">Approved</span>
                                    @elseif(($req['status'] ?? '') === 'REJECTED')
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800">Rejected</span>
                                    @else
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-slate-100 text-slate-800">{{ $req['status'] ?? '-' }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Reject modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4" style="display: none;">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 sm:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-2">Reject request: <span id="rejectRequestId" class="text-slate-600"></span></h3>
            <form id="rejectForm" method="POST" action="">
                @csrf
                <input type="hidden" name="approved_by" value="Owner (Web Portal)">
                <label class="block text-sm font-medium text-slate-700 mt-4">Rejection reason <span class="text-red-500">*</span></label>
                <textarea name="rejection_reason" rows="3" required class="mt-1 block w-full border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-gold-dark/30 focus:border-gold-dark px-4 py-3 text-sm"></textarea>
                <div class="mt-6 flex flex-col-reverse sm:flex-row justify-end gap-2 sm:gap-3">
                    <button type="button" onclick="hideRejectForm()" class="px-4 py-2.5 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 font-medium min-h-[44px]">Cancel</button>
                    <button type="submit" class="px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium min-h-[44px] transition">Reject</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleDetail(id) {
        document.getElementById('detail-' + id).classList.toggle('hidden');
    }
    function showRejectForm(id, requestId) {
        document.getElementById('rejectRequestId').textContent = requestId;
        document.getElementById('rejectForm').action = '{{ url("admin/inventory-requests") }}/' + id + '/reject';
        document.getElementById('rejectModal').style.display = 'flex';
        document.getElementById('rejectModal').classList.remove('hidden');
    }
    function hideRejectForm() {
        document.getElementById('rejectModal').style.display = 'none';
        document.getElementById('rejectModal').classList.add('hidden');
    }
    (function() {
        var alertEl = document.getElementById('alert-message');
        if (alertEl) alertEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
    })();
</script>
@endpush
