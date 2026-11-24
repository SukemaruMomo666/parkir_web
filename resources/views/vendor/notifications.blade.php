<x-layouts.vendor activeNav="notifications" title="Vendor Notifications & Operational Alerts - NusaPark Enterprise">

    <!-- ================= FLASH NOTIFICATIONS ================= -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs animate-fade-in" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Operation Confirmed</p>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100 cursor-pointer" aria-label="Dismiss alert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-start justify-between gap-3 shadow-xs animate-fade-in" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center shrink-0 text-red-600">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-red-900">Alert Error</p>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-800 p-1 rounded-lg hover:bg-red-100 cursor-pointer" aria-label="Dismiss alert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    <!-- ================= PAGE HEADER & PRIMARY ACTIONS ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        
        <!-- Header Info & Metadata -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Operational Monitoring • Page 35</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)] animate-pulse"></span>
                        Live Alert Dispatch
                    </span>
                    <span class="text-xs text-slate-400 hidden md:inline">• Tenant: {{ $tenant['brand_name'] }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    Notifications
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Real-time operational alerts, barrier events, ANPR verification notices, and facility exceptions.
                </p>
            </div>
        </div>

        <!-- Header Actions -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Refresh Action -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-xs" 
                    title="Refresh Live Notifications Feed"
                    aria-label="Refresh Live Notifications Feed">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
            </button>

            <!-- Mark All As Read Action -->
            <form action="{{ route('vendor.notifications.readAll') }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        @if($metrics['unread'] === 0) disabled @endif
                        class="px-4 py-2.5 rounded-xl border {{ $metrics['unread'] > 0 ? 'border-[var(--primary)] bg-[var(--primary)] text-white hover:opacity-90 shadow-xs cursor-pointer' : 'border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed' }} text-xs sm:text-sm font-bold transition-all flex items-center gap-2"
                        title="{{ $metrics['unread'] > 0 ? 'Mark all unread notifications as read' : 'All notifications already marked as read' }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Mark all as read</span>
                    @if($metrics['unread'] > 0)
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] font-extrabold bg-white text-[var(--primary)] leading-tight">
                        {{ $metrics['unread'] }}
                    </span>
                    @endif
                </button>
            </form>
        </div>
    </div>

    <!-- ================= METRICS & OPERATIONAL KPI SUMMARY ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        
        <!-- 1. Unread Alerts -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500">Unread Updates</span>
                <div class="w-8 h-8 rounded-lg {{ $metrics['unread'] > 0 ? 'bg-red-50 text-red-600' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </div>
            </div>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $metrics['unread'] }}</span>
                <span class="text-xs font-medium text-slate-400">of {{ $metrics['total'] }} total</span>
            </div>
            <div class="mt-1 flex items-center gap-1.5 text-[11px] font-semibold {{ $metrics['unread'] > 0 ? 'text-red-600' : 'text-emerald-600' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $metrics['unread'] > 0 ? 'bg-red-500 animate-pulse' : 'bg-emerald-500' }}"></span>
                {{ $metrics['unread'] > 0 ? 'Requires operator review' : 'All updates cleared' }}
            </div>
        </div>

        <!-- 2. Critical Incidents -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500">Critical Alerts</span>
                <div class="w-8 h-8 rounded-lg {{ $metrics['critical'] > 0 ? 'bg-rose-50 text-rose-600' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
            </div>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $metrics['critical'] }}</span>
                <span class="text-xs font-medium text-slate-400">high severity</span>
            </div>
            <div class="mt-1 flex items-center gap-1.5 text-[11px] font-semibold {{ $metrics['critical'] > 0 ? 'text-rose-600' : 'text-slate-500' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $metrics['critical'] > 0 ? 'bg-rose-500' : 'bg-slate-400' }}"></span>
                {{ $metrics['critical'] > 0 ? 'Overstay & sensor violations' : 'No critical incidents' }}
            </div>
        </div>

        <!-- 3. Warnings & Calibration -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500">Warning Notices</span>
                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
            </div>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $metrics['warning'] }}</span>
                <span class="text-xs font-medium text-slate-400">active checks</span>
            </div>
            <div class="mt-1 flex items-center gap-1.5 text-[11px] font-semibold text-amber-700">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                ANPR, capacity & IoT telemetry
            </div>
        </div>

        <!-- 4. Resolved / Historical -->
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500">Resolved Alerts</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
            </div>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-2xl font-black text-slate-900">{{ $metrics['resolved'] }}</span>
                <span class="text-xs font-medium text-slate-400">of {{ $metrics['total'] }} items</span>
            </div>
            <div class="mt-1 flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Cleared in audit history
            </div>
        </div>

    </div>

    <!-- ================= QUICK CATEGORY PILLS BAR ================= -->
    <div class="p-3 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex items-center gap-2 overflow-x-auto text-xs font-bold scrollbar-none">
        <span class="text-slate-400 uppercase tracking-wider text-[10px] shrink-0 pl-1">Category:</span>
        @foreach($categories as $catKey => $catLabel)
        @php
            $isActive = ($filters['category'] ?? 'all') === $catKey;
            $catCount = $catKey === 'all' ? $metrics['total'] : ($metrics['by_category'][$catKey] ?? 0);
        @endphp
        <a href="{{ request()->fullUrlWithQuery(['category' => $catKey, 'page' => 1]) }}" 
           class="px-3 py-1.5 rounded-xl whitespace-nowrap transition-all flex items-center gap-1.5 {{ $isActive ? 'bg-[var(--primary)] text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            <span>{{ $catLabel }}</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] font-black {{ $isActive ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-700' }}">
                {{ $catCount }}
            </span>
        </a>
        @endforeach
    </div>

    <!-- ================= SEARCH, FILTER & BULK CONTROLS ================= -->
    <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-3">
        
        <form method="GET" action="{{ route('vendor.notifications') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-center">
            
            <!-- Search Keyword -->
            <div class="lg:col-span-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                <input type="text" 
                       name="q" 
                       value="{{ $filters['q'] }}" 
                       placeholder="Search alerts, devices, references..." 
                       class="w-full pl-9 pr-8 py-2 bg-slate-50 border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                @if(!empty($filters['q']))
                <a href="{{ request()->fullUrlWithQuery(['q' => '']) }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600" title="Clear query">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </a>
                @endif
            </div>

            <!-- Read Status Filter -->
            <div class="lg:col-span-2">
                <select name="status" 
                        onchange="this.form.submit()" 
                        class="w-full py-2 px-3 bg-slate-50 border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-medium focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                    <option value="all" {{ ($filters['status'] ?? 'all') === 'all' ? 'selected' : '' }}>All Statuses ({{ $metrics['total'] }})</option>
                    <option value="unread" {{ ($filters['status'] ?? '') === 'unread' ? 'selected' : '' }}>Unread ({{ $metrics['unread'] }})</option>
                    <option value="read" {{ ($filters['status'] ?? '') === 'read' ? 'selected' : '' }}>Read ({{ $metrics['read'] }})</option>
                </select>
            </div>

            <!-- Severity Filter -->
            <div class="lg:col-span-2">
                <select name="severity" 
                        onchange="this.form.submit()" 
                        class="w-full py-2 px-3 bg-slate-50 border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-medium focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                    @foreach($severities as $sevKey => $sevLabel)
                    <option value="{{ $sevKey }}" {{ ($filters['severity'] ?? 'all') === $sevKey ? 'selected' : '' }}>
                        {{ $sevLabel }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Facility Filter -->
            <div class="lg:col-span-3">
                <select name="facility" 
                        onchange="this.form.submit()" 
                        class="w-full py-2 px-3 bg-slate-50 border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-medium focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                    <option value="all" {{ ($filters['facility'] ?? 'all') === 'all' ? 'selected' : '' }}>All Facilities (3)</option>
                    @foreach($facilities as $fac)
                    <option value="{{ $fac['id'] }}" {{ ($filters['facility'] ?? '') === $fac['id'] ? 'selected' : '' }}>
                        {{ $fac['name'] }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit / Reset Action -->
            <div class="lg:col-span-1 flex items-center gap-1.5">
                <button type="submit" 
                        class="w-full py-2 px-3 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-xs font-bold transition-colors cursor-pointer text-center">
                    Filter
                </button>
                @if($hasActiveFilters)
                <a href="{{ route('vendor.notifications') }}" 
                   class="p-2 rounded-xl border border-slate-200 text-slate-500 hover:text-red-600 hover:bg-slate-50 transition-colors" 
                   title="Reset All Filters">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </a>
                @endif
            </div>

            <!-- Retain category query if set -->
            @if(!empty($filters['category']) && $filters['category'] !== 'all')
            <input type="hidden" name="category" value="{{ $filters['category'] }}">
            @endif

        </form>

        <!-- ================= BULK ACTIONS FLOATING TOOLBAR ================= -->
        <div id="bulk-toolbar" class="hidden p-3 rounded-xl bg-slate-900 text-white flex flex-wrap items-center justify-between gap-3 animate-fade-in shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-6 h-6 rounded-md bg-blue-500 text-white flex items-center justify-center font-bold text-xs">
                    <span id="selected-count">0</span>
                </div>
                <span class="text-xs font-medium">notifications selected</span>
            </div>
            <div class="flex items-center gap-2">
                <form id="bulk-read-form" action="{{ route('vendor.notifications.bulkRead') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="ids_json" id="bulk-ids-input" value="[]">
                    <button type="button" 
                            onclick="submitBulkRead()" 
                            class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Mark Selected as Read</span>
                    </button>
                </form>
                <button type="button" 
                        onclick="clearSelection()" 
                        class="px-2.5 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-medium transition-colors cursor-pointer">
                    Cancel
                </button>
            </div>
        </div>

    </div>

    <!-- ================= NOTIFICATIONS FEED LIST ================= -->
    <div class="space-y-3">
        
        <!-- Table Toolbar Controls (Select All & Meta) -->
        <div class="px-2 flex items-center justify-between text-xs text-slate-500">
            <label class="flex items-center gap-2 font-medium cursor-pointer select-none">
                <input type="checkbox" 
                       id="select-all-notifications" 
                       onchange="toggleSelectAll(this)" 
                       class="w-4 h-4 rounded border-slate-300 text-[var(--primary)] focus:ring-[var(--accent)] cursor-pointer">
                <span>Select all on page</span>
            </label>
            <div class="font-medium">
                Showing <strong class="text-slate-800">{{ $pagination['from'] }}-{{ $pagination['to'] }}</strong> of <strong class="text-slate-800">{{ $pagination['total'] }}</strong>
            </div>
        </div>

        @forelse($notifications as $notif)
        @php
            $isUnread = !$notif['is_read'];
            
            // Severity pill styles
            $sevBg = match($notif['severity']) {
                'critical' => 'bg-rose-50 text-rose-700 border-rose-200',
                'warning' => 'bg-amber-50 text-amber-800 border-amber-200',
                'info' => 'bg-blue-50 text-blue-700 border-blue-200',
                'resolved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                default => 'bg-slate-100 text-slate-700 border-slate-200',
            };

            $sevDot = match($notif['severity']) {
                'critical' => 'bg-rose-600',
                'warning' => 'bg-amber-500',
                'info' => 'bg-blue-500',
                'resolved' => 'bg-emerald-500',
                default => 'bg-slate-400',
            };

            // Category Icons & Badges
            $catLabel = $categories[$notif['category']] ?? strtoupper($notif['category']);
        @endphp

        <!-- Notification Card Item -->
        <div class="p-4 sm:p-5 rounded-2xl border transition-all duration-150 {{ $isUnread ? 'bg-white border-blue-200 shadow-xs ring-1 ring-blue-100/80' : 'bg-[var(--surface)] border-[var(--border)] hover:border-slate-300' }} flex flex-col sm:flex-row sm:items-start gap-4"
             id="card-{{ $notif['id'] }}">
            
            <!-- Checkbox & Category Icon -->
            <div class="flex items-center sm:items-start gap-3 shrink-0">
                <input type="checkbox" 
                       name="selected_notifications[]" 
                       value="{{ $notif['id'] }}" 
                       onchange="updateBulkSelection()" 
                       class="notif-checkbox w-4 h-4 rounded border-slate-300 text-[var(--primary)] focus:ring-[var(--accent)] cursor-pointer mt-0.5">
                
                <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-xs shrink-0 {{ $isUnread ? 'bg-blue-50 text-[var(--accent)] border border-blue-100' : 'bg-slate-100 text-slate-500' }}">
                    @if($notif['category'] === 'gate')
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 22V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16"></path><path d="M4 14h16"></path><path d="M12 4v10"></path></svg>
                    @elseif($notif['category'] === 'anpr')
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                    @elseif($notif['category'] === 'iot')
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"></path><path d="M1.42 9a16 16 0 0 1 21.16 0"></path><path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path><line x1="12" y1="20" x2="12.01" y2="20"></line></svg>
                    @elseif($notif['category'] === 'capacity')
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    @elseif($notif['category'] === 'session')
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    @elseif($notif['category'] === 'billing')
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line></svg>
                    @else
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    @endif
                </div>
            </div>

            <!-- Content Body -->
            <div class="flex-1 min-w-0 space-y-2">
                
                <!-- Badges Header -->
                <div class="flex flex-wrap items-center gap-2">
                    <!-- Severity Pill -->
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider border {{ $sevBg }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $sevDot }} {{ $notif['severity'] === 'critical' ? 'animate-ping' : '' }}"></span>
                        {{ $notif['severity_label'] }}
                    </span>

                    <!-- Category Pill -->
                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600 border border-slate-200">
                        {{ $catLabel }}
                    </span>

                    <!-- Unread Pill -->
                    @if($isUnread)
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                        New Alert
                    </span>
                    @endif

                    <!-- Relative Time -->
                    <span class="text-xs text-slate-400 ml-auto flex items-center gap-1">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span>{{ $notif['formatted_time'] }}</span>
                    </span>
                </div>

                <!-- Title & Message -->
                <div>
                    <h2 class="text-sm sm:text-base font-extrabold text-slate-900 leading-snug">
                        {{ $notif['title'] }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                        {{ $notif['message'] }}
                    </p>
                </div>

                <!-- Associated Technical Metadata Chips -->
                <div class="pt-1 flex flex-wrap items-center gap-2 sm:gap-3 text-xs text-slate-500">
                    @if(!empty($notif['facility_name']))
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-slate-50 border border-slate-200 text-slate-700 font-medium">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span>{{ $notif['facility_name'] }}</span>
                    </span>
                    @endif

                    @if(!empty($notif['device_name']))
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-slate-50 border border-slate-200 text-slate-700 font-mono text-[11px]">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line></svg>
                        <span>{{ $notif['device_name'] }}</span>
                    </span>
                    @endif

                    @if(!empty($notif['event_reference']))
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-blue-50/50 border border-blue-100 text-[var(--accent)] font-mono text-[11px] font-semibold">
                        Ref: {{ $notif['event_reference'] }}
                    </span>
                    @endif

                    <span class="text-[11px] text-slate-400 font-mono hidden md:inline">
                        ID: {{ $notif['id'] }}
                    </span>
                </div>

                <!-- Footer Quick Actions & Deep Link -->
                <div class="pt-2 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                    
                    <!-- Contextual Deep Link -->
                    @if(!empty($notif['action_url']))
                    <a href="{{ $notif['action_url'] }}" 
                       class="inline-flex items-center gap-1.5 text-xs font-bold text-[var(--accent)] hover:text-blue-700 group transition-colors">
                        <span>{{ $notif['action_label'] ?? 'Inspect Related Workflow' }}</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="transition-transform group-hover:translate-x-0.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    @else
                    <span class="text-xs text-slate-400">System Notification (No manual action required)</span>
                    @endif

                    <!-- Notification Record Controls -->
                    <div class="flex items-center gap-1.5 ml-auto">
                        <!-- Inspect Details Modal Button -->
                        <button type="button" 
                                onclick='openNotificationModal(@json($notif))' 
                                class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold transition-colors cursor-pointer"
                                title="View technical alert metadata">
                            Details
                        </button>

                        <!-- Mark Single as Read Button -->
                        @if($isUnread)
                        <form action="{{ route('vendor.notifications.read', $notif['id']) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-blue-50 text-slate-600 hover:text-[var(--accent)] transition-colors cursor-pointer" 
                                    title="Mark as read"
                                    aria-label="Mark notification as read">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </button>
                        </form>
                        @endif

                        <!-- Dismiss / Delete Button -->
                        <form action="{{ route('vendor.notifications.destroy', $notif['id']) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Dismiss this notification from your inbox?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-red-50 text-slate-400 hover:text-red-600 transition-colors cursor-pointer" 
                                    title="Dismiss notification"
                                    aria-label="Dismiss notification">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>
        @empty
        <!-- Empty State -->
        <div class="p-12 rounded-2xl bg-[var(--surface)] border border-[var(--border)] text-center space-y-3">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-[var(--accent)] mx-auto flex items-center justify-center">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </div>
            <h3 class="text-base font-bold text-slate-900">
                @if($hasActiveFilters)
                No notifications match your filter criteria
                @else
                No notifications in your inbox
                @endif
            </h3>
            <p class="text-xs text-slate-500 max-w-sm mx-auto">
                @if($hasActiveFilters)
                Try clearing your search query or selecting a different category or severity level.
                @else
                All operational events, barrier activities, and camera recognitions across your authorized facilities are running smoothly.
                @endif
            </p>
            @if($hasActiveFilters)
            <div class="pt-2">
                <a href="{{ route('vendor.notifications') }}" 
                   class="px-4 py-2 rounded-xl bg-slate-900 text-white text-xs font-bold hover:bg-slate-800 transition-colors inline-block cursor-pointer">
                    Clear Active Filters
                </a>
            </div>
            @endif
        </div>
        @endforelse

        <!-- ================= PAGINATION ================= -->
        @if($pagination['total'] > 0)
        <div class="p-4 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs">
            <div class="text-slate-500 font-medium">
                Page <strong class="text-slate-900">{{ $pagination['current_page'] }}</strong> of <strong class="text-slate-900">{{ $pagination['last_page'] }}</strong>
                ({{ $pagination['total'] }} notifications recorded)
            </div>

            <div class="flex items-center gap-1.5 self-center sm:self-auto">
                <!-- Previous Button -->
                @if($pagination['current_page'] > 1)
                <a href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] - 1]) }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors flex items-center gap-1 cursor-pointer">
                    &larr; Prev
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 font-semibold cursor-not-allowed">
                    &larr; Prev
                </span>
                @endif

                <!-- Page Number Pills -->
                @for($p = 1; $p <= $pagination['last_page']; $p++)
                <a href="{{ request()->fullUrlWithQuery(['page' => $p]) }}" 
                   class="w-8 h-8 rounded-lg flex items-center justify-center font-bold transition-colors cursor-pointer {{ $p == $pagination['current_page'] ? 'bg-[var(--primary)] text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    {{ $p }}
                </a>
                @endfor

                <!-- Next Button -->
                @if($pagination['current_page'] < $pagination['last_page'])
                <a href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] + 1]) }}" 
                   class="px-3 py-1.5 rounded-lg border border-[var(--border)] bg-white hover:bg-slate-50 text-slate-700 font-semibold transition-colors flex items-center gap-1 cursor-pointer">
                    Next &rarr;
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 font-semibold cursor-not-allowed">
                    Next &rarr;
                </span>
                @endif
            </div>
        </div>
        @endif

    </div>

    <!-- ================= NOTIFICATION DETAILS MODAL ================= -->
    <div id="modal-notification-detail" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeNotificationModal()"></div>
        
        <!-- Modal Card -->
        <div class="relative w-full max-w-xl bg-white rounded-2xl shadow-2xl border border-slate-200 p-6 space-y-5 animate-fade-in z-10">
            
            <!-- Modal Header -->
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-4">
                <div class="flex items-center gap-3">
                    <div id="modal-notif-icon-wrap" class="w-10 h-10 rounded-xl bg-blue-50 text-[var(--accent)] flex items-center justify-center shrink-0">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span id="modal-notif-sev-badge" class="px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase border">WARNING</span>
                            <span id="modal-notif-cat-badge" class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase bg-slate-100 text-slate-700 border border-slate-200">CATEGORY</span>
                        </div>
                        <h3 id="modal-notif-title" class="text-base font-extrabold text-slate-900 mt-1 leading-snug">
                            Alert Title
                        </h3>
                    </div>
                </div>

                <button type="button" 
                        onclick="closeNotificationModal()" 
                        class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 cursor-pointer" 
                        aria-label="Close dialog">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <!-- Message Narrative -->
            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs sm:text-sm text-slate-700 leading-relaxed" id="modal-notif-message">
                Notification message description.
            </div>

            <!-- Technical Metadata Grid -->
            <div class="grid grid-cols-2 gap-3 text-xs">
                <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-200/80">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Notification ID</span>
                    <span id="modal-notif-id" class="font-mono font-bold text-slate-800">VNOTIF-000</span>
                </div>
                <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-200/80">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Created Timestamp</span>
                    <span id="modal-notif-created" class="text-slate-800 font-medium">-</span>
                </div>
                <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-200/80">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Facility Name</span>
                    <span id="modal-notif-facility" class="font-semibold text-slate-800">-</span>
                </div>
                <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-200/80">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Device / Channel</span>
                    <span id="modal-notif-device" class="font-mono font-semibold text-slate-800">-</span>
                </div>
                <div class="p-2.5 rounded-xl bg-slate-50/80 border border-slate-200/80 col-span-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">System Event Reference</span>
                    <span id="modal-notif-reference" class="font-mono font-bold text-[var(--accent)]">-</span>
                </div>
            </div>

            <!-- Modal Action Footer -->
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-3">
                <button type="button" 
                        onclick="closeNotificationModal()" 
                        class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold cursor-pointer">
                    Dismiss View
                </button>

                <div class="flex items-center gap-2">
                    <form id="modal-mark-read-form" method="POST" action="" class="inline">
                        @csrf
                        <button type="submit" 
                                id="modal-mark-read-btn" 
                                class="px-3.5 py-2 rounded-xl border border-blue-200 bg-blue-50 text-[var(--accent)] hover:bg-blue-100 text-xs font-bold transition-colors cursor-pointer">
                            Mark as Read
                        </button>
                    </form>

                    <a id="modal-action-btn" 
                       href="#" 
                       class="px-4 py-2 rounded-xl bg-[var(--primary)] text-white hover:opacity-90 text-xs font-bold transition-all shadow-xs flex items-center gap-1.5 cursor-pointer">
                        <span id="modal-action-btn-text">Inspect Workflow</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

@push('scripts')
<script>
    /**
     * Bulk Selection Management
     */
    function toggleSelectAll(masterCheckbox) {
        const checkboxes = document.querySelectorAll('.notif-checkbox');
        checkboxes.forEach(cb => cb.checked = masterCheckbox.checked);
        updateBulkSelection();
    }

    function updateBulkSelection() {
        const checkedBoxes = document.querySelectorAll('.notif-checkbox:checked');
        const count = checkedBoxes.length;
        const toolbar = document.getElementById('bulk-toolbar');
        const countDisplay = document.getElementById('selected-count');
        const idsInput = document.getElementById('bulk-ids-input');

        if (count > 0) {
            toolbar.classList.remove('hidden');
            countDisplay.innerText = count;
            
            const ids = Array.from(checkedBoxes).map(cb => cb.value);
            idsInput.value = JSON.stringify(ids);
        } else {
            toolbar.classList.add('hidden');
            idsInput.value = '[]';
            const masterCheckbox = document.getElementById('select-all-notifications');
            if (masterCheckbox) masterCheckbox.checked = false;
        }
    }

    function clearSelection() {
        const checkboxes = document.querySelectorAll('.notif-checkbox');
        checkboxes.forEach(cb => cb.checked = false);
        const master = document.getElementById('select-all-notifications');
        if (master) master.checked = false;
        updateBulkSelection();
    }

    function submitBulkRead() {
        const checkedBoxes = document.querySelectorAll('.notif-checkbox:checked');
        if (checkedBoxes.length === 0) return;

        const ids = Array.from(checkedBoxes).map(cb => cb.value);
        
        // Create dynamic inputs on the form for Laravel array validation
        const form = document.getElementById('bulk-read-form');
        // Clear previous hidden inputs except csrf
        form.querySelectorAll('input[name="ids[]"]').forEach(el => el.remove());
        
        ids.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = id;
            form.appendChild(input);
        });

        form.submit();
    }

    /**
     * Technical Details Modal
     */
    function openNotificationModal(notif) {
        document.getElementById('modal-notif-title').innerText = notif.title;
        document.getElementById('modal-notif-message').innerText = notif.message;
        document.getElementById('modal-notif-id').innerText = notif.id;
        document.getElementById('modal-notif-created').innerText = notif.created_at + ' (' + notif.formatted_time + ')';
        document.getElementById('modal-notif-facility').innerText = notif.facility_name || 'All Facilities (Platform Level)';
        document.getElementById('modal-notif-device').innerText = notif.device_name || 'N/A';
        document.getElementById('modal-notif-reference').innerText = notif.event_reference || 'N/A';

        // Severity badge
        const sevBadge = document.getElementById('modal-notif-sev-badge');
        sevBadge.innerText = (notif.severity_label || notif.severity).toUpperCase();
        if (notif.severity === 'critical') {
            sevBadge.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase border bg-rose-50 text-rose-700 border-rose-200';
        } else if (notif.severity === 'warning') {
            sevBadge.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase border bg-amber-50 text-amber-800 border-amber-200';
        } else if (notif.severity === 'resolved') {
            sevBadge.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase border bg-emerald-50 text-emerald-700 border-emerald-200';
        } else {
            sevBadge.className = 'px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase border bg-blue-50 text-blue-700 border-blue-200';
        }

        // Category badge
        const catBadge = document.getElementById('modal-notif-cat-badge');
        catBadge.innerText = (notif.category_label || notif.category).toUpperCase();

        // Mark as read form
        const readForm = document.getElementById('modal-mark-read-form');
        const readBtn = document.getElementById('modal-mark-read-btn');
        if (notif.is_read) {
            readBtn.classList.add('hidden');
        } else {
            readBtn.classList.remove('hidden');
            readForm.action = '/vendor/notifications/' + notif.id + '/read';
        }

        // Action button deep link
        const actionBtn = document.getElementById('modal-action-btn');
        const actionBtnText = document.getElementById('modal-action-btn-text');
        if (notif.action_url) {
            actionBtn.href = notif.action_url;
            actionBtnText.innerText = notif.action_label || 'Inspect Related Workflow';
            actionBtn.classList.remove('hidden');
        } else {
            actionBtn.classList.add('hidden');
        }

        document.getElementById('modal-notification-detail').classList.remove('hidden');
    }

    function closeNotificationModal() {
        document.getElementById('modal-notification-detail').classList.add('hidden');
    }

    // Escape key modal dismiss
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeNotificationModal();
        }
    });
</script>
@endpush

</x-layouts.vendor>
