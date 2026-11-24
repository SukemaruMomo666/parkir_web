<x-layouts.app activeNav="history">
    <div class="w-full space-y-6 md:space-y-8">

        <!-- ================= PAGE HEADER & TITLE ================= -->
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pt-1 sm:pt-2">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-[var(--text)]">History</h1>
                <p class="text-[var(--text-muted)] text-sm md:text-base mt-1">
                    Review your past parking sessions, reservations, and verified payment records.
                </p>
            </div>

            @if($hasActiveFilters)
                <a href="/history" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[var(--accent)] hover:underline w-fit self-start sm:self-auto">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    <span>Clear Active Filters</span>
                </a>
            @endif
        </header>

        <!-- ================= SUMMARY METRICS CARDS ================= -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Activities -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--text-muted)]">Total Activities</span>
                    <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-[var(--text)]">{{ $metrics['total_sessions'] + $metrics['total_reservations'] }}</span>
                    <span class="text-xs text-[var(--text-muted)]">All time</span>
                </div>
            </div>

            <!-- Parking Sessions -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--text-muted)]">Parking Sessions</span>
                    <div class="w-7 h-7 rounded-lg bg-blue-50 text-[var(--accent)] flex items-center justify-center font-bold text-xs">
                        P
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-[var(--text)]">{{ $metrics['total_sessions'] }}</span>
                    <span class="text-xs text-[var(--text-muted)]">On-site</span>
                </div>
            </div>

            <!-- Reservations -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--text-muted)]">Reservations</span>
                    <div class="w-7 h-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-[var(--text)]">{{ $metrics['total_reservations'] }}</span>
                    <span class="text-xs text-[var(--text-muted)]">Advance</span>
                </div>
            </div>

            <!-- Confirmed Spent -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between bg-blue-50/20 border-blue-100">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent)]">Confirmed Spent</span>
                    <div class="w-7 h-7 rounded-lg bg-blue-100 text-[var(--accent)] flex items-center justify-center">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-[var(--primary)]">{{ $metrics['formatted_spent'] }}</span>
                    <span class="text-[11px] text-[var(--text-muted)]">Paid & Verified</span>
                </div>
            </div>
        </div>

@push('styles')
<style>
    .history-search-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }
    .history-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }
    .history-search-input {
        width: 100%;
        height: 42px;
        padding-left: 42px !important;
        padding-right: 36px !important;
        background-color: var(--background);
        border: 1px solid var(--border);
        border-radius: 12px;
        font-size: 0.875rem;
        color: var(--text);
        transition: all 0.2s ease;
    }
    .history-search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.12);
        background-color: var(--surface);
    }
    .history-select-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }
    .history-filter-select {
        width: 100%;
        height: 42px;
        padding-left: 14px !important;
        padding-right: 34px !important;
        background-color: var(--background);
        border: 1px solid var(--border);
        border-radius: 12px;
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--text);
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        transition: all 0.2s ease;
    }
    .history-filter-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.12);
        background-color: var(--surface);
    }
    .history-select-chevron {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .history-date-input {
        width: 100%;
        height: 42px;
        padding-left: 12px !important;
        padding-right: 12px !important;
        background-color: var(--background);
        border: 1px solid var(--border);
        border-radius: 12px;
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--text);
        transition: all 0.2s ease;
    }
    .history-date-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.12);
        background-color: var(--surface);
    }
    .history-btn-apply {
        height: 42px;
        padding: 0 18px;
        background-color: var(--primary);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    .history-btn-apply:hover {
        background-color: var(--accent);
    }
    .history-btn-reset {
        height: 42px;
        padding: 0 14px;
        background-color: var(--background);
        color: var(--text-muted);
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 12px;
        border: 1px solid var(--border);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .history-btn-reset:hover {
        color: var(--danger);
        border-color: #fca5a5;
    }
</style>
@endpush

        <!-- ================= BALANCED FILTER TOOLBAR ================= -->
        <section class="dashboard-card p-5 md:p-6 shadow-xs">
            <form method="GET" action="/history" id="filterForm" class="space-y-4">
                
                <!-- Unified Responsive Toolbar: Single Horizontal Row on Desktop, Graceful Wrap on Tablet/Mobile -->
                <div class="flex flex-col lg:flex-row items-stretch lg:items-end gap-3.5">
                    
                    <!-- Search Input: Flexible Width with Generous Room for Placeholder -->
                    <div class="flex-1 min-w-[240px]">
                        <label for="historySearch" class="block text-xs font-semibold text-[var(--text-muted)] mb-1.5">
                            Search Facility or Vehicle
                        </label>
                        <div class="history-search-wrapper">
                            <div class="history-search-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                            <input type="text" 
                                   id="historySearch" 
                                   name="search" 
                                   value="{{ $filters['search'] }}" 
                                   placeholder="Search by facility name, vehicle plate, or reference..."
                                   class="history-search-input">
                            @if(!empty($filters['search']))
                                <a href="/history?{{ http_build_query(request()->except('search', 'page')) }}" 
                                   style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); display: flex; align-items: center;"
                                   class="text-[var(--text-muted)] hover:text-[var(--text)] transition-colors"
                                   title="Clear search">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Filter Dropdowns Cluster -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 shrink-0">
                        
                        <!-- Record Type -->
                        <div class="min-w-[130px]">
                            <label for="filterType" class="block text-xs font-semibold text-[var(--text-muted)] mb-1.5">
                                Record Type
                            </label>
                            <div class="history-select-wrapper">
                                <select id="filterType" 
                                        name="type" 
                                        onchange="this.form.submit()"
                                        class="history-filter-select">
                                    <option value="all" {{ $filters['type'] === 'all' ? 'selected' : '' }}>All Types</option>
                                    <option value="session" {{ $filters['type'] === 'session' ? 'selected' : '' }}>Parking Sessions</option>
                                    <option value="reservation" {{ $filters['type'] === 'reservation' ? 'selected' : '' }}>Reservations</option>
                                </select>
                                <div class="history-select-chevron">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Status -->
                        <div class="min-w-[130px]">
                            <label for="filterStatus" class="block text-xs font-semibold text-[var(--text-muted)] mb-1.5">
                                Payment Status
                            </label>
                            <div class="history-select-wrapper">
                                <select id="filterStatus" 
                                        name="status" 
                                        onchange="this.form.submit()"
                                        class="history-filter-select">
                                    <option value="all" {{ $filters['status'] === 'all' ? 'selected' : '' }}>All Statuses</option>
                                    <option value="paid" {{ $filters['status'] === 'paid' ? 'selected' : '' }}>Paid / Completed</option>
                                    <option value="unpaid" {{ $filters['status'] === 'unpaid' ? 'selected' : '' }}>In Progress</option>
                                    <option value="cancelled" {{ $filters['status'] === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="refunded" {{ $filters['status'] === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                                <div class="history-select-chevron">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Date Filter -->
                        <div class="min-w-[130px]">
                            <label for="filterDateFrom" class="block text-xs font-semibold text-[var(--text-muted)] mb-1.5">
                                Activity Date
                            </label>
                            <input type="date" 
                                   id="filterDateFrom" 
                                   name="date_from" 
                                   value="{{ $filters['date_from'] }}"
                                   onchange="this.form.submit()"
                                   class="history-date-input">
                        </div>

                        <!-- Sort Order -->
                        <div class="min-w-[120px]">
                            <label for="filterSort" class="block text-xs font-semibold text-[var(--text-muted)] mb-1.5">
                                Sort Order
                            </label>
                            <div class="history-select-wrapper">
                                <select id="filterSort" 
                                        name="sort" 
                                        onchange="this.form.submit()"
                                        class="history-filter-select">
                                    <option value="newest" {{ $filters['sort'] === 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="oldest" {{ $filters['sort'] === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                </select>
                                <div class="history-select-chevron">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Action Controls -->
                    <div class="flex items-center gap-2 shrink-0 pt-1 lg:pt-0">
                        <button type="submit" class="history-btn-apply" title="Apply filter settings">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            <span>Apply</span>
                        </button>

                        @if($hasActiveFilters)
                            <a href="/history" class="history-btn-reset" title="Clear all active filters">
                                Reset
                            </a>
                        @endif
                    </div>

                </div>

                <!-- Active Filter Tags Display -->
                @if($hasActiveFilters)
                    <div class="flex flex-wrap items-center gap-2 pt-3 border-t border-[var(--border)] text-xs">
                        <span class="text-[var(--text-muted)] font-semibold">Active:</span>
                        
                        @if(!empty($filters['search']))
                            <span class="px-2.5 py-1 bg-slate-100 text-[var(--text)] rounded-lg font-medium flex items-center gap-1.5">
                                <span>Query: "{{ $filters['search'] }}"</span>
                                <a href="/history?{{ http_build_query(request()->except('search', 'page')) }}" class="hover:text-[var(--danger)]">&times;</a>
                            </span>
                        @endif

                        @if($filters['type'] !== 'all')
                            <span class="px-2.5 py-1 bg-blue-50 text-[var(--accent)] border border-blue-200/60 rounded-lg font-medium flex items-center gap-1.5">
                                <span>Type: {{ ucfirst($filters['type']) }}</span>
                                <a href="/history?{{ http_build_query(request()->except('type', 'page')) }}" class="hover:text-[var(--danger)]">&times;</a>
                            </span>
                        @endif

                        @if($filters['status'] !== 'all')
                            <span class="px-2.5 py-1 bg-slate-100 text-[var(--text)] rounded-lg font-medium flex items-center gap-1.5">
                                <span>Status: {{ ucfirst($filters['status']) }}</span>
                                <a href="/history?{{ http_build_query(request()->except('status', 'page')) }}" class="hover:text-[var(--danger)]">&times;</a>
                            </span>
                        @endif

                        @if(!empty($filters['date_from']))
                            <span class="px-2.5 py-1 bg-slate-100 text-[var(--text)] rounded-lg font-medium flex items-center gap-1.5">
                                <span>Date: {{ $filters['date_from'] }}</span>
                                <a href="/history?{{ http_build_query(request()->except('date_from', 'page')) }}" class="hover:text-[var(--danger)]">&times;</a>
                            </span>
                        @endif

                        @if($filters['sort'] !== 'newest')
                            <span class="px-2.5 py-1 bg-slate-100 text-[var(--text)] rounded-lg font-medium flex items-center gap-1.5">
                                <span>Sort: Oldest</span>
                                <a href="/history?{{ http_build_query(request()->except('sort', 'page')) }}" class="hover:text-[var(--danger)]">&times;</a>
                            </span>
                        @endif

                        <a href="/history" class="text-xs font-semibold text-[var(--danger)] hover:underline ml-1">Clear all</a>
                    </div>
                @endif

            </form>
        </section>

        <!-- ================= RECORDS LIST / TABLE ================= -->
        @if(count($records) === 0)
            <!-- EMPTY STATES -->
            <div class="dashboard-card p-10 md:p-16 text-center">
                @if($hasActiveFilters)
                    <!-- Filter Empty State -->
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-4">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--text)] mb-1">No matching activity records</h3>
                    <p class="text-sm text-[var(--text-muted)] mb-6 max-w-sm mx-auto">
                        No parking sessions or reservations match your current search and filter settings.
                    </p>
                    <a href="/history" class="bg-[var(--primary)] text-white text-xs font-semibold px-6 py-2.5 rounded-xl hover:bg-[var(--accent)] transition-colors shadow-sm inline-block">
                        Reset All Filters
                    </a>
                @else
                    <!-- Genuine Zero History State -->
                    <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center text-[var(--accent)] mx-auto mb-4">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--text)] mb-1">No parking history recorded yet</h3>
                    <p class="text-sm text-[var(--text-muted)] mb-6 max-w-sm mx-auto">
                        When you complete parking sessions or book reservations with NusaPark, your activity and receipts will be organized here.
                    </p>
                    <a href="/app/search" class="bg-[var(--primary)] text-white text-xs font-semibold px-6 py-2.5 rounded-xl hover:bg-[var(--accent)] transition-colors shadow-sm inline-block">
                        Find Parking Now &rarr;
                    </a>
                @endif
            </div>

        @else
            <!-- DESKTOP TABLE VIEW (with minimum width and intentional container scroll) -->
            <div class="hidden md:block dashboard-card overflow-hidden shadow-xs">
                <div class="overflow-x-auto scrollbar-thin">
                    <table class="w-full min-w-[920px] text-left text-xs md:text-sm">
                        <thead class="bg-slate-50/80 border-b border-[var(--border)] text-[var(--text-muted)] uppercase text-[10px] font-bold tracking-wider">
                            <tr>
                                <th class="py-3.5 pl-6 pr-4 w-[24%]">Facility & Spot</th>
                                <th class="py-3.5 px-4 w-[16%]">Date & Time</th>
                                <th class="py-3.5 px-4 w-[14%]">Vehicle</th>
                                <th class="py-3.5 px-4 w-[14%]">Type & Ref</th>
                                <th class="py-3.5 px-4 w-[14%]">Amount & Method</th>
                                <th class="py-3.5 px-4 w-[10%]">Status</th>
                                <th class="py-3.5 pl-4 pr-6 w-[8%] text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--border)] text-[var(--text)]">
                            @foreach($records as $rec)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    
                                    <!-- Facility & Spot -->
                                    <td class="py-4 pl-6 pr-4">
                                        <div class="font-bold text-[var(--text)] text-sm">{{ $rec['facility_name'] }}</div>
                                        <div class="text-xs text-[var(--text-muted)] flex items-center gap-1.5 mt-0.5">
                                            <span>{{ $rec['facility_city'] }}</span>
                                            <span class="text-slate-300">•</span>
                                            <span class="text-slate-600 font-medium">{{ $rec['facility_zone'] }}</span>
                                        </div>
                                    </td>

                                    <!-- Date & Time -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <div class="font-semibold text-xs text-[var(--text)]">{{ $rec['entry_time'] }}</div>
                                        <div class="text-[11px] text-[var(--text-muted)] mt-0.5">
                                            Duration: <strong class="text-slate-700 font-semibold">{{ $rec['duration'] }}</strong>
                                        </div>
                                    </td>

                                    <!-- Vehicle -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="font-mono font-bold text-xs bg-slate-100 text-[var(--text)] px-2.5 py-1 rounded-md border border-slate-200 block w-fit">
                                            {{ $rec['vehicle_plate'] }}
                                        </span>
                                        <span class="text-[11px] text-[var(--text-muted)] block mt-1">{{ $rec['vehicle_name'] }}</span>
                                    </td>

                                    <!-- Type & Reference -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        @if($rec['type'] === 'session')
                                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">Session</span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-200">Reservation</span>
                                        @endif
                                        <span class="font-mono text-[11px] text-[var(--text-muted)] block mt-1">{{ $rec['reference'] }}</span>
                                    </td>

                                    <!-- Amount & Method -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <div class="font-bold text-sm text-[var(--primary)]">{{ $rec['formatted_amount'] }}</div>
                                        <div class="text-[11px] text-[var(--text-muted)] mt-0.5">
                                            {{ $rec['payment_method'] }}
                                        </div>
                                    </td>

                                    <!-- Status Badge (Icon + Text) -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        @if($rec['payment_status'] === 'paid')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-50 text-emerald-700 text-xs font-bold rounded-full border border-green-200">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                <span>Paid</span>
                                            </span>
                                        @elseif($rec['payment_status'] === 'unpaid')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 text-amber-700 text-xs font-bold rounded-full border border-amber-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                <span>Active Unpaid</span>
                                            </span>
                                        @elseif($rec['payment_status'] === 'refunded')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded-full border border-slate-200">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                                                <span>Refunded</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-full">
                                                <span>{{ ucfirst($rec['status']) }}</span>
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Action (with generous right padding pr-6) -->
                                    <td class="py-4 pl-4 pr-6 text-right whitespace-nowrap">
                                        @if($rec['payment_status'] === 'paid' || !empty($rec['receipt_ref']))
                                            <button type="button" 
                                                    onclick="openReceiptModal('{{ $rec['reference'] }}')" 
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-50/70 text-[var(--accent)] hover:bg-blue-100 hover:text-[var(--accent-hover)] text-xs font-bold transition-all border border-blue-200/50 cursor-pointer shadow-2xs">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                    <polyline points="14 2 14 8 20 8"></polyline>
                                                </svg>
                                                <span>Receipt</span>
                                            </button>
                                        @elseif($rec['action_url'])
                                            <a href="{{ $rec['action_url'] }}" 
                                               class="inline-flex items-center gap-1.5 bg-[var(--primary)] text-white text-xs font-bold px-3.5 py-1.5 rounded-xl hover:bg-[var(--accent)] transition-colors shadow-sm">
                                                <span>{{ $rec['action_label'] }}</span>
                                                <span>&rarr;</span>
                                            </a>
                                        @else
                                            <span class="text-xs text-[var(--text-muted)]">—</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Desktop Table Pagination Bar -->
                @if($pagination['last_page'] > 1)
                    @php
                        $queryParams = request()->except('page');
                    @endphp
                    <div class="px-6 py-4 bg-slate-50/60 border-t border-[var(--border)] flex items-center justify-between gap-4 text-xs">
                        <span class="text-[var(--text-muted)]">
                            Showing page <strong class="text-[var(--text)] font-semibold">{{ $pagination['current_page'] }}</strong> of <strong class="text-[var(--text)] font-semibold">{{ $pagination['last_page'] }}</strong> ({{ $pagination['total'] }} records)
                        </span>

                        <div class="flex items-center gap-1.5">
                            <!-- Prev -->
                            @if($pagination['current_page'] > 1)
                                <a href="/history?{{ http_build_query(array_merge($queryParams, ['page' => $pagination['current_page'] - 1])) }}" 
                                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] text-xs font-semibold hover:border-[var(--primary)] hover:bg-white transition-colors">
                                    &larr; Prev
                                </a>
                            @else
                                <span class="px-3 py-1.5 rounded-lg border border-[var(--border)] text-xs font-semibold text-slate-300 cursor-not-allowed">
                                    &larr; Prev
                                </span>
                            @endif

                            <!-- Page Numbers -->
                            @for($p = 1; $p <= $pagination['last_page']; $p++)
                                <a href="/history?{{ http_build_query(array_merge($queryParams, ['page' => $p])) }}" 
                                   class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold transition-colors
                                          {{ $pagination['current_page'] == $p ? 'bg-[var(--primary)] text-white shadow-xs' : 'border border-[var(--border)] text-[var(--text)] hover:border-[var(--primary)] hover:bg-white' }}">
                                    {{ $p }}
                                </a>
                            @endfor

                            <!-- Next -->
                            @if($pagination['current_page'] < $pagination['last_page'])
                                <a href="/history?{{ http_build_query(array_merge($queryParams, ['page' => $pagination['current_page'] + 1])) }}" 
                                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] text-xs font-semibold hover:border-[var(--primary)] hover:bg-white transition-colors">
                                    Next &rarr;
                                </a>
                            @else
                                <span class="px-3 py-1.5 rounded-lg border border-[var(--border)] text-xs font-semibold text-slate-300 cursor-not-allowed">
                                    Next &rarr;
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- MOBILE CARD VIEW -->
            <div class="md:hidden space-y-3.5">
                @foreach($records as $rec)
                    <div class="dashboard-card p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                @if($rec['type'] === 'session')
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">Session</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-200">Reservation</span>
                                @endif
                                <span class="text-[11px] font-mono text-[var(--text-muted)]">{{ $rec['reference'] }}</span>
                            </div>

                            @if($rec['payment_status'] === 'paid')
                                <span class="px-2.5 py-0.5 bg-green-50 text-emerald-700 text-[10px] font-bold rounded-full border border-green-200 flex items-center gap-1">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    Paid
                                </span>
                            @elseif($rec['payment_status'] === 'unpaid')
                                <span class="px-2.5 py-0.5 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-full border border-amber-200">
                                    Active Unpaid
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 bg-slate-100 text-slate-700 text-[10px] font-bold rounded-full">
                                    {{ ucfirst($rec['payment_status']) }}
                                </span>
                            @endif
                        </div>

                        <div>
                            <h4 class="font-bold text-sm text-[var(--text)]">{{ $rec['facility_name'] }}</h4>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">{{ $rec['facility_city'] }} · {{ $rec['facility_zone'] }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-xs py-2 border-y border-[var(--border)]">
                            <div>
                                <span class="text-[10px] text-[var(--text-muted)] uppercase block">Date & Time</span>
                                <span class="font-semibold text-xs">{{ $rec['entry_time'] }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-[var(--text-muted)] uppercase block">Duration</span>
                                <span class="font-semibold text-xs">{{ $rec['duration'] }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-[var(--text-muted)] uppercase block">Vehicle</span>
                                <span class="font-mono font-bold text-xs">{{ $rec['vehicle_plate'] }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-[var(--text-muted)] uppercase block">Method</span>
                                <span class="font-semibold text-xs">{{ $rec['payment_method'] }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div>
                                <span class="text-[10px] text-[var(--text-muted)] uppercase block">Total</span>
                                <span class="text-base font-bold text-[var(--primary)]">{{ $rec['formatted_amount'] }}</span>
                            </div>

                            @if($rec['payment_status'] === 'paid' || !empty($rec['receipt_ref']))
                                <button type="button" 
                                        onclick="openReceiptModal('{{ $rec['reference'] }}')" 
                                        class="px-3.5 py-1.5 bg-blue-50 text-[var(--accent)] border border-blue-200/60 rounded-xl text-xs font-bold hover:bg-blue-100 transition-colors">
                                    View Receipt
                                </button>
                            @elseif($rec['action_url'])
                                <a href="{{ $rec['action_url'] }}" 
                                   class="bg-[var(--primary)] text-white text-xs font-bold px-4 py-2 rounded-xl hover:bg-[var(--accent)] transition-colors shadow-sm">
                                    {{ $rec['action_label'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Mobile Pagination -->
                @if($pagination['last_page'] > 1)
                    @php
                        $queryParams = request()->except('page');
                    @endphp
                    <div class="flex flex-col items-center gap-3 pt-3">
                        <span class="text-xs text-[var(--text-muted)]">
                            Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }} ({{ $pagination['total'] }} records)
                        </span>

                        <div class="flex items-center gap-2">
                            @if($pagination['current_page'] > 1)
                                <a href="/history?{{ http_build_query(array_merge($queryParams, ['page' => $pagination['current_page'] - 1])) }}" 
                                   class="px-4 py-2 rounded-xl border border-[var(--border)] text-xs font-semibold bg-white">
                                    &larr; Prev
                                </a>
                            @endif

                            @if($pagination['current_page'] < $pagination['last_page'])
                                <a href="/history?{{ http_build_query(array_merge($queryParams, ['page' => $pagination['current_page'] + 1])) }}" 
                                   class="px-4 py-2 rounded-xl border border-[var(--border)] text-xs font-semibold bg-white">
                                    Next &rarr;
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

        @endif

    </div>

    <!-- ================= OFFICIAL RECEIPT MODAL ================= -->
    <div id="receiptModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="dashboard-card max-w-lg w-full p-6 md:p-8 relative bg-white rounded-2xl shadow-2xl animate-in fade-in zoom-in-95 duration-150" onclick="event.stopPropagation()">
            
            <!-- Modal Close -->
            <button type="button" 
                    onclick="closeReceiptModal()" 
                    class="absolute top-4 right-4 p-2 text-[var(--text-muted)] hover:text-[var(--text)] transition-colors rounded-full hover:bg-slate-100 cursor-pointer"
                    aria-label="Close receipt modal">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Receipt Content Header -->
            <div class="text-center pb-6 border-b border-[var(--border)]">
                <div class="w-10 h-10 bg-[var(--primary)] text-white rounded-xl flex items-center justify-center font-bold text-lg mx-auto mb-2 shadow-sm">
                    N
                </div>
                <h3 class="text-lg font-bold text-[var(--primary)] tracking-tight">Nusa<span class="text-[var(--accent)]">Park</span> Parking Receipt</h3>
                <p class="text-xs text-[var(--text-muted)] mt-0.5">PT Nusa Parkir Digital Indonesia · NPWP: 01.234.567.8-012.000</p>
                
                <div class="mt-4 inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-emerald-700 text-xs font-bold rounded-full border border-green-200">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Verified Payment Settled</span>
                </div>
            </div>

            <!-- Receipt Metadata Grid -->
            <div class="py-5 space-y-3.5 text-xs text-[var(--text)] border-b border-[var(--border)]">
                <div class="flex justify-between">
                    <span class="text-[var(--text-muted)]">Receipt Number</span>
                    <span class="font-mono font-bold text-[var(--text)]" id="rcptRef">RCP-20261010-0421</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[var(--text-muted)]">Parking Facility</span>
                    <span class="font-bold text-right text-[var(--text)]" id="rcptFacility">Mall XYZ Jakarta</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[var(--text-muted)]">Location / Spot</span>
                    <span class="text-right text-[var(--text)]" id="rcptZone">Zone A · Spot B1-A01</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[var(--text-muted)]">Vehicle Registration</span>
                    <span class="font-mono font-bold text-[var(--text)]" id="rcptPlate">B 1234 XYZ</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[var(--text-muted)]">Entry Timestamp</span>
                    <span id="rcptEntry">10 Oct 2026, 14:00</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[var(--text-muted)]">Exit Timestamp</span>
                    <span id="rcptExit">10 Oct 2026, 16:00</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[var(--text-muted)]">Total Duration</span>
                    <span class="font-semibold text-[var(--text)]" id="rcptDuration">2h 00m</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[var(--text-muted)]">Payment Method</span>
                    <span class="font-semibold text-[var(--text)]" id="rcptMethod">QRIS Instant Pay</span>
                </div>
            </div>

            <!-- Total Settlement Row -->
            <div class="py-4 flex justify-between items-center">
                <div>
                    <span class="text-xs uppercase font-bold tracking-wider text-[var(--text-muted)] block">Amount Paid</span>
                    <span class="text-[11px] text-[var(--text-muted)]">Includes 11% PPN</span>
                </div>
                <span class="text-2xl font-bold text-[var(--primary)]" id="rcptTotal">Rp 15.000</span>
            </div>

            <!-- Footer Compliance Notice -->
            <div class="p-3 bg-slate-50 rounded-xl text-[10px] text-[var(--text-muted)] text-center mb-6">
                Certified electronic parking transaction. Keep this receipt for your records or business expense claims.
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="button" 
                        onclick="window.print()" 
                        class="flex-1 bg-[var(--primary)] text-white font-bold py-2.5 px-4 rounded-xl text-xs hover:bg-[var(--accent)] transition-colors shadow-sm flex items-center justify-center gap-1.5 cursor-pointer">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    <span>Print Receipt</span>
                </button>
                <button type="button" 
                        onclick="closeReceiptModal()" 
                        class="px-5 py-2.5 bg-[var(--background)] border border-[var(--border)] rounded-xl text-xs font-semibold text-[var(--text)] hover:border-[var(--primary)] transition-colors cursor-pointer">
                    Close
                </button>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        // Records dictionary for receipt modal lookup
        const recordsData = @json($records);

        function openReceiptModal(reference) {
            const record = recordsData.find(r => r.reference === reference);
            if (!record) return;

            document.getElementById('rcptRef').innerText = record.receipt_ref || `RCP-${record.reference}`;
            document.getElementById('rcptFacility').innerText = record.facility_name;
            document.getElementById('rcptZone').innerText = `${record.facility_city} · ${record.facility_zone}`;
            document.getElementById('rcptPlate').innerText = record.vehicle_plate;
            document.getElementById('rcptEntry').innerText = record.entry_time;
            document.getElementById('rcptExit').innerText = record.exit_time || 'Completed';
            document.getElementById('rcptDuration').innerText = record.duration;
            document.getElementById('rcptMethod').innerText = record.payment_method;
            document.getElementById('rcptTotal').innerText = record.formatted_amount;

            const modal = document.getElementById('receiptModal');
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeReceiptModal() {
            const modal = document.getElementById('receiptModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeReceiptModal();
            }
        });

        // Close when clicking modal backdrop
        document.getElementById('receiptModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReceiptModal();
            }
        });
    </script>
    @endpush
</x-layouts.app>
