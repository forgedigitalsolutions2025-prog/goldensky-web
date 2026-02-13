<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Requests - Owner's Portal - Golden Sky Hotel & Wellness</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <nav class="bg-gradient-to-r from-gold-dark to-gold text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 py-4 sm:py-0 sm:h-16">
                <div class="flex flex-wrap items-center gap-2 sm:gap-4 min-w-0">
                    <a href="{{ route('admin.dashboard') }}" class="text-white hover:underline text-sm sm:text-base whitespace-nowrap">← Dashboard</a>
                    <h1 class="text-lg sm:text-xl md:text-2xl font-bold truncate">Inventory Requests (Owner's Portal)</h1>
                </div>
                <div class="flex items-center">
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-3 py-2 sm:px-4 rounded-md text-sm font-medium transition whitespace-nowrap">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div id="alert-message" class="mb-4 p-4 bg-green-100 border-2 border-green-500 text-green-800 rounded-lg text-base font-medium" role="alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div id="alert-message" class="mb-4 p-4 bg-red-100 border-2 border-red-500 text-red-800 rounded-lg text-base font-medium" role="alert">{{ session('error') }}</div>
        @endif

        <p class="text-gray-600 mb-6">Requests with <strong>more than 10 items</strong> can only be approved or rejected here in the Owner's Portal. Smaller requests can be approved from the Manager app.</p>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Pending Requests</h2>
            @if(empty($pendingRequests))
                <p class="text-gray-500">No pending inventory requests.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gold-dark bg-opacity-10">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Request ID</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Requested By</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Reason</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Items</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pendingRequests as $req)
                                @php
                                    $items = $req['items'] ?? [];
                                    $itemCount = count($items);
                                    $isBig = $itemCount > 10;
                                @endphp
                                <tr class="hover:bg-gray-50" id="row-{{ $req['id'] }}">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $req['requestId'] ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ isset($req['requestDate']) ? \Carbon\Carbon::parse($req['requestDate'])->format('M d, Y H:i') : '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $req['requestedBy'] ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700 max-w-xs truncate" title="{{ $req['reason'] ?? '' }}">{{ Str::limit($req['reason'] ?? '-', 40) }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="font-semibold {{ $isBig ? 'text-amber-600' : 'text-gray-700' }}">{{ $itemCount }}</span>
                                        @if($isBig)
                                            <span class="text-xs text-amber-600">(Owner's Portal only)</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm space-x-2">
                                        <button type="button" onclick="toggleDetail({{ $req['id'] }})" class="text-gold-dark hover:underline font-medium">View details / Approve</button>
                                        <button type="button" onclick="showRejectForm({{ $req['id'] }}, '{{ addslashes($req['requestId'] ?? '') }}')" class="text-red-600 hover:underline font-medium">Reject</button>
                                    </td>
                                </tr>
                                <tr id="detail-{{ $req['id'] }}" class="hidden bg-gray-50">
                                    <td colspan="6" class="px-4 py-3">
                                        <div class="text-sm">
                                            <p class="font-semibold text-gray-700 mb-2">Items — edit approved quantity if needed, then click Approve:</p>
                                            <form action="{{ route('admin.inventory-requests.approve', $req['id']) }}" method="POST" class="mb-4" onsubmit="return confirm('Approve this request with the quantities shown below?');">
                                                @csrf
                                                <input type="hidden" name="approved_by" value="Owner (Web Portal)">
                                                <table class="min-w-full text-xs border border-gray-200 rounded overflow-hidden">
                                                    <thead class="bg-gray-100"><tr><th class="text-left py-2 px-2">Ingredient</th><th class="text-left py-2 px-2">Requested</th><th class="text-left py-2 px-2">Approved Qty</th><th class="text-left py-2 px-2">Unit</th><th class="text-left py-2 px-2">Reason</th></tr></thead>
                                                    <tbody>
                                                        @foreach($items as $idx => $it)
                                                            <tr class="border-t border-gray-200">
                                                                <td class="py-1 px-2">{{ $it['ingredientName'] ?? '-' }}</td>
                                                                <td class="py-1 px-2">{{ $it['quantity'] ?? '-' }}</td>
                                                                <td class="py-1 px-2">
                                                                    <input type="hidden" name="approved_items[{{ $idx }}][ingredient_name]" value="{{ $it['ingredientName'] ?? '' }}">
                                                                    <input type="number" name="approved_items[{{ $idx }}][approved_quantity]" value="{{ $it['quantity'] ?? 0 }}" min="0" step="any" class="w-20 border border-gray-300 rounded px-1 py-0.5 text-gray-900">
                                                                </td>
                                                                <td class="py-1 px-2">{{ $it['unit'] ?? '-' }}</td>
                                                                <td class="py-1 px-2">{{ Str::limit($it['itemReason'] ?? '-', 30) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm font-medium">Approve request</button>
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

        <div id="all-requests" class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">All Requests (reference)</h2>
            @if(empty($allRequests))
                <p class="text-gray-500">No inventory requests.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Request ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Requested By</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Items</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($allRequests as $req)
                                @php $cnt = count($req['items'] ?? []); @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $req['requestId'] ?? '-' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ isset($req['requestDate']) ? \Carbon\Carbon::parse($req['requestDate'])->format('M d, Y') : '-' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $req['requestedBy'] ?? '-' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $cnt }}</td>
                                    <td class="px-4 py-2">
                                        @if(($req['status'] ?? '') === 'PENDING')
                                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @elseif(($req['status'] ?? '') === 'APPROVED')
                                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                        @elseif(($req['status'] ?? '') === 'REJECTED')
                                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                        @else
                                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ $req['status'] ?? '-' }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Reject modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" style="display: none;">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Reject request: <span id="rejectRequestId"></span></h3>
            <form id="rejectForm" method="POST" action="">
                @csrf
                <input type="hidden" name="approved_by" value="Owner (Web Portal)">
                <label class="block text-sm font-medium text-gray-700 mt-2">Rejection reason <span class="text-red-500">*</span></label>
                <textarea name="rejection_reason" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-gold focus:border-gold"></textarea>
                <div class="mt-4 flex justify-end space-x-2">
                    <button type="button" onclick="hideRejectForm()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Reject</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleDetail(id) {
            var el = document.getElementById('detail-' + id);
            el.classList.toggle('hidden');
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
        // Scroll success/error message into view so it's not missed
        (function() {
            var alertEl = document.getElementById('alert-message');
            if (alertEl) alertEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
        })();
    </script>
</body>
</html>
