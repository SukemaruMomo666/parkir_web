<x-layouts.app activeNav="history">
    <div class="w-full space-y-6">

        <!-- HEADER AREA WITH INTEGRATED PARKING GARAGE GRAPHIC -->
        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6 pb-2">
            
            <!-- Left Title & Subtitle -->
            <div class="max-w-xl relative z-10">
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        History
                    </h1>
                </div>

                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mt-1">
                    Review your past parking sessions, reservations, and verified payment records.
                </p>
            </div>

            <!-- Right Architectural Multi-Story Garage Graphic -->
            <div class="hidden md:block absolute -top-4 right-0 h-28 w-auto pointer-events-none select-none opacity-95">
                <img src="{{ asset('images/history-parking-header.png') }}" alt="Parking Garage" class="h-full w-auto object-contain" />
            </div>

        </div>

        <!-- 4 SUMMARY METRIC CARDS -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Card 1: Total Activities -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-50 text-blue-600">All time</span>
                </div>
                <div class="mt-3">
                    <span class="text-xs font-bold text-slate-500 block mb-0.5">Total Activities</span>
                    <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        {{ $metrics['total_sessions'] + $metrics['total_reservations'] }}
                    </span>
                </div>
            </div>

            <!-- Card 2: Parking Sessions -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 font-black text-xs">
                        P
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-50 text-blue-600">On-site</span>
                </div>
                <div class="mt-3">
                    <span class="text-xs font-bold text-slate-500 block mb-0.5">Parking Sessions</span>
                    <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        {{ $metrics['total_sessions'] }}
                    </span>
                </div>
            </div>

            <!-- Card 3: Reservations -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-50 text-blue-600">Advance</span>
                </div>
                <div class="mt-3">
                    <span class="text-xs font-bold text-slate-500 block mb-0.5">Reservations</span>
                    <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        {{ $metrics['total_reservations'] }}
                    </span>
                </div>
            </div>

            <!-- Card 4: Confirmed Spent -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-600">✓ Paid & Verified</span>
                </div>
                <div class="mt-3">
                    <span class="text-xs font-bold text-slate-500 block mb-0.5">Confirmed Spent</span>
                    <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        {{ $metrics['formatted_spent'] }}
                    </span>
                </div>
            </div>

        </div>

        <!-- FILTER FORM BAR (SINGLE ROW WITH APPLY BUTTON) -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs">
            <form action="/history" method="GET" class="flex flex-wrap lg:flex-nowrap items-end gap-3.5">
                
                <!-- Search Input -->
                <div class="flex-1 min-w-[240px]">
                    <div class="relative">
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search by facility name, vehicle plate, or reference..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </div>
                </div>

                <!-- Record Type Select -->
                <div class="w-full sm:w-auto sm:min-w-[130px]">
                    <label class="block text-[10px] font-bold text-slate-600 uppercase tracking-wider mb-1">Record Type</label>
                    <select name="type" class="w-full py-2.5 px-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <option value="all" {{ ($filters['type'] ?? 'all') === 'all' ? 'selected' : '' }}>All Types</option>
                        <option value="session" {{ ($filters['type'] ?? '') === 'session' ? 'selected' : '' }}>Session</option>
                        <option value="reservation" {{ ($filters['type'] ?? '') === 'reservation' ? 'selected' : '' }}>Reservation</option>
                    </select>
                </div>

                <!-- Payment Status Select -->
                <div class="w-full sm:w-auto sm:min-w-[130px]">
                    <label class="block text-[10px] font-bold text-slate-600 uppercase tracking-wider mb-1">Payment Status</label>
                    <select name="status" class="w-full py-2.5 px-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <option value="all" {{ ($filters['status'] ?? 'all') === 'all' ? 'selected' : '' }}>All Statuses</option>
                        <option value="paid" {{ ($filters['status'] ?? '') === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ ($filters['status'] ?? '') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="refunded" {{ ($filters['status'] ?? '') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>

                <!-- Activity Date Input -->
                <div class="w-full sm:w-auto sm:min-w-[140px]">
                    <label class="block text-[10px] font-bold text-slate-600 uppercase tracking-wider mb-1">Activity Date</label>
                    <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="w-full py-2 px-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer" />
                </div>

                <!-- Sort Order Select -->
                <div class="w-full sm:w-auto sm:min-w-[130px]">
                    <label class="block text-[10px] font-bold text-slate-600 uppercase tracking-wider mb-1">Sort Order</label>
                    <select name="sort" class="w-full py-2.5 px-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <option value="newest" {{ ($filters['sort'] ?? 'newest') === 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ ($filters['sort'] ?? '') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>

                <!-- Apply Button -->
                <div class="shrink-0 w-full sm:w-auto">
                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-sm transition-all h-[38px]">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                        <span>Apply</span>
                    </button>
                </div>

            </form>
        </div>

        <!-- HISTORY RECORDS TABLE CARD -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden p-6">
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                            <th class="pb-4 font-bold">Facility & Location</th>
                            <th class="pb-4 font-bold">Date & Time</th>
                            <th class="pb-4 font-bold">Vehicle</th>
                            <th class="pb-4 font-bold">Type & Reference</th>
                            <th class="pb-4 font-bold">Amount & Method</th>
                            <th class="pb-4 font-bold">Status</th>
                            <th class="pb-4 font-bold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($records as $rec)
                            @php
                                $thumb = 'images/mall-xyz.jpg';
                                if (str_contains(strtolower($rec['facility_name']), 'grand')) {
                                    $thumb = 'images/building-abc.jpg';
                                } elseif (str_contains(strtolower($rec['facility_name']), 'senayan') || str_contains(strtolower($rec['facility_name']), 'subang')) {
                                    $thumb = 'images/subang-square.jpg';
                                }
                            @endphp
                            <tr class="hover:bg-slate-50/70 transition-colors group">
                                
                                <!-- 1. Facility & Location -->
                                <td class="py-4 pr-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset($thumb) }}" alt="{{ $rec['facility_name'] }}" class="w-12 h-10 rounded-xl object-cover shadow-xs shrink-0" />
                                        <div>
                                            <div class="font-bold text-slate-900 text-xs sm:text-sm group-hover:text-blue-600 transition-colors">{{ $rec['facility_name'] }}</div>
                                            <div class="text-[11px] text-slate-500 flex items-center gap-1 mt-0.5">
                                                <span>📍 {{ $rec['facility_city'] ?? 'Jakarta' }}</span>
                                                @if(!empty($rec['facility_zone']))
                                                    <span>• {{ $rec['facility_zone'] }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- 2. Date & Time -->
                                <td class="py-4 pr-4 whitespace-nowrap">
                                    <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        <span>{{ $rec['entry_time'] }}</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 flex items-center gap-1 mt-0.5">
                                        <svg class="w-3 h-3 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <span>Duration: {{ $rec['duration'] ?? '2h' }}</span>
                                    </div>
                                </td>

                                <!-- 3. Vehicle -->
                                <td class="py-4 pr-4 whitespace-nowrap">
                                    <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                                        <span class="font-mono">{{ $rec['vehicle_plate'] }}</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $rec['vehicle_name'] }}</div>
                                </td>

                                <!-- 4. Type & Reference -->
                                <td class="py-4 pr-4 whitespace-nowrap">
                                    @if($rec['type'] === 'session')
                                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600 mb-0.5">
                                            Session
                                        </span>
                                    @else
                                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-600 mb-0.5">
                                            Reservation
                                        </span>
                                    @endif
                                    <div class="text-[11px] text-slate-500 font-mono">· {{ $rec['reference'] }}</div>
                                </td>

                                <!-- 5. Amount & Method -->
                                <td class="py-4 pr-4 whitespace-nowrap">
                                    <div class="font-extrabold text-slate-900 text-xs sm:text-sm">{{ $rec['formatted_amount'] }}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $rec['payment_method'] ?? 'QRIS Instant Pay' }}</div>
                                </td>

                                <!-- 6. Status -->
                                <td class="py-4 pr-4 whitespace-nowrap">
                                    @if(strtolower($rec['status']) === 'active' || strtolower($rec['payment_status']) === 'unpaid')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-[10px] font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span>Active Unpaid</span>
                                        </span>
                                    @elseif(strtolower($rec['status']) === 'refunded' || strtolower($rec['payment_status']) === 'refunded')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                                            <span>Refunded</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                            <span>Paid</span>
                                        </span>
                                    @endif
                                </td>

                                <!-- 7. Action -->
                                <td class="py-4 text-right whitespace-nowrap">
                                    @if(strtolower($rec['status']) === 'active' || strtolower($rec['payment_status']) === 'unpaid')
                                        <a href="/payment?type=session" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-sm transition-all">
                                            <span>Pay Now</span>
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                        </a>
                                    @else
                                        <button type="button" onclick="showReceiptModal('{{ $rec['reference'] }}', '{{ $rec['facility_name'] }}', '{{ $rec['formatted_amount'] }}', '{{ $rec['entry_time'] }}', '{{ $rec['vehicle_plate'] }}', '{{ $rec['payment_method'] ?? 'QRIS Instant Pay' }}')" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border border-slate-200 hover:border-blue-400 hover:bg-blue-50 text-blue-600 font-semibold text-xs transition-all shadow-2xs">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                            <span>Receipt</span>
                                        </button>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                    </div>
                                    <div class="text-sm font-bold text-slate-700">No parking records found</div>
                                    <p class="text-xs text-slate-400 mt-1">Try clearing your filters or search keywords.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TABLE FOOTER & PAGINATION (MATCHING MOCKUP) -->
            <div class="pt-6 mt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-slate-500 font-medium">
                    Showing page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }} ({{ $pagination['total'] }} records)
                </div>

                <div class="flex items-center gap-2">
                    <!-- Prev -->
                    <a href="/history?page={{ max(1, $pagination['current_page'] - 1) }}" class="px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-500 hover:bg-slate-50 transition-colors {{ $pagination['current_page'] <= 1 ? 'pointer-events-none opacity-50' : '' }}">
                        &lt; Prev
                    </a>

                    <!-- Page 1 -->
                    <a href="/history?page=1" class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all {{ $pagination['current_page'] == 1 ? 'bg-slate-900 text-white shadow-sm' : 'border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                        1
                    </a>

                    <!-- Page 2 -->
                    @if($pagination['last_page'] >= 2)
                        <a href="/history?page=2" class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all {{ $pagination['current_page'] == 2 ? 'bg-slate-900 text-white shadow-sm' : 'border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                            2
                        </a>
                    @endif

                    <!-- Next -->
                    <a href="/history?page={{ min($pagination['last_page'], $pagination['current_page'] + 1) }}" class="px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors {{ $pagination['current_page'] >= $pagination['last_page'] ? 'pointer-events-none opacity-50' : '' }}">
                        Next &gt;
                    </a>
                </div>
            </div>

        </div>

    </div>

    <!-- VERIFIED RECEIPT MODAL DIALOG -->
    <div id="receiptModal" class="hidden fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-slate-200 animate-in fade-in zoom-in-95 duration-200">
            
            <!-- Receipt Header -->
            <div class="text-center pb-4 border-b border-dashed border-slate-200">
                <div class="w-10 h-10 mx-auto rounded-2xl bg-blue-600 text-white flex items-center justify-center font-black text-xl mb-2 shadow-sm">
                    P
                </div>
                <h3 class="text-base font-extrabold text-slate-900" id="modalVenue">Mall XYZ Jakarta</h3>
                <p class="text-[11px] text-slate-500">Official Parking Receipt</p>
            </div>

            <!-- Receipt Details List -->
            <div class="py-4 space-y-2.5 text-xs">
                <div class="flex justify-between text-slate-500">
                    <span>Reference</span>
                    <span class="font-mono font-bold text-slate-900" id="modalRef">-</span>
                </div>
                <div class="flex justify-between text-slate-500">
                    <span>Vehicle Plate</span>
                    <span class="font-mono font-bold text-slate-900" id="modalPlate">-</span>
                </div>
                <div class="flex justify-between text-slate-500">
                    <span>Timestamp</span>
                    <span class="font-semibold text-slate-900" id="modalTime">-</span>
                </div>
                <div class="flex justify-between text-slate-500">
                    <span>Payment Method</span>
                    <span class="font-semibold text-slate-900" id="modalMethod">-</span>
                </div>
                <div class="pt-3 border-t border-dashed border-slate-200 flex justify-between items-center text-sm">
                    <span class="font-bold text-slate-900">Total Paid</span>
                    <span class="text-base font-black text-blue-600" id="modalAmount">-</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-3 flex gap-2.5">
                <button type="button" onclick="window.print()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-xs font-semibold hover:bg-slate-50 transition-colors">
                    Print
                </button>
                <button type="button" onclick="closeReceiptModal()" class="flex-1 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-sm">
                    Close
                </button>
            </div>

        </div>
    </div>

    <!-- SCRIPT FOR RECEIPT MODAL -->
    <script>
        function showReceiptModal(ref, venue, amount, time, plate, method) {
            document.getElementById('modalRef').textContent = ref;
            document.getElementById('modalVenue').textContent = venue;
            document.getElementById('modalAmount').textContent = amount;
            document.getElementById('modalTime').textContent = time;
            document.getElementById('modalPlate').textContent = plate;
            document.getElementById('modalMethod').textContent = method;
            document.getElementById('receiptModal').classList.remove('hidden');
        }

        function closeReceiptModal() {
            document.getElementById('receiptModal').classList.add('hidden');
        }
    </script>
</x-layouts.app>
