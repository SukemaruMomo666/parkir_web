<x-layouts.app activeNav="notifications">
    <div class="w-full space-y-6 md:space-y-8">

        <!-- ================= PAGE HEADER & TITLE ================= -->
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pt-1 sm:pt-2">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-[var(--accent)] border border-blue-200/60">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        Driver Inbox
                    </span>
                    <span class="text-xs text-[var(--text-muted)]">Real-time Activity</span>
                </div>
                <div class="flex items-center gap-3 mt-1.5">
                    <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-[var(--text)]">Notifications</h1>
                    @if($metrics['unread'] > 0)
                        <span id="unread-count-pill" class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-[var(--accent)] border border-blue-200">
                            <span class="w-2 h-2 rounded-full bg-[var(--accent)] animate-pulse"></span>
                            {{ $metrics['unread'] }} Unread
                        </span>
                    @else
                        <span id="unread-count-pill" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            All Caught Up
                        </span>
                    @endif
                </div>
                <p class="text-[var(--text-muted)] text-sm md:text-base mt-1">
                    Stay updated on active parking sessions, slot reservations, smart barrier scans, and verified payments.
                </p>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-2.5 self-start sm:self-auto shrink-0">
                @if($metrics['unread'] > 0)
                    <form method="POST" action="/notifications/read-all" id="mark-all-read-form">
                        @csrf
                        <button type="submit" 
                                id="btn-mark-all-read"
                                class="inline-flex items-center gap-2 bg-[var(--surface)] hover:bg-[var(--background)] text-[var(--text)] border border-[var(--border)] hover:border-[var(--accent)] px-3.5 py-2.5 rounded-xl font-semibold text-xs md:text-sm transition-all shadow-xs cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent)]">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Mark all as read</span>
                        </button>
                    </form>
                @endif

                @if($hasActiveFilters)
                    <a href="/notifications" 
                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-[var(--accent)] hover:underline px-2.5 py-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        <span>Clear Filters</span>
                    </a>
                @endif
            </div>
        </header>

        <!-- ================= FLASH FEEDBACK ================= -->
        @if(session('notification_success'))
            <div id="alert-notif-success" class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200/80 rounded-xl text-emerald-800 text-sm shadow-sm transition-all animate-fadeIn">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <span>{{ session('notification_success') }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-notif-success').remove()" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100/50 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        <!-- ================= SUMMARY METRICS ================= -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Notifications -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--text-muted)]">Total Updates</span>
                    <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-[var(--text)]">{{ $metrics['total'] }}</span>
                    <span class="text-xs text-[var(--text-muted)]">All records</span>
                </div>
            </div>

            <!-- Unread Alerts -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between {{ $metrics['unread'] > 0 ? 'border-blue-200 bg-blue-50/20' : '' }}">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent)]">Unread Alerts</span>
                    <div class="w-7 h-7 rounded-lg bg-blue-50 text-[var(--accent)] flex items-center justify-center font-bold text-xs">
                        {{ $metrics['unread'] }}
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-[var(--accent)]" id="card-unread-stat">{{ $metrics['unread'] }}</span>
                    <span class="text-xs text-[var(--text-muted)]">Requires review</span>
                </div>
            </div>

            <!-- Parking Sessions -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Parking Sessions</span>
                    <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <span class="font-bold text-xs">P</span>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-emerald-700">{{ $metrics['by_category']['session'] }}</span>
                    <span class="text-xs text-[var(--text-muted)]">Gates & on-site</span>
                </div>
            </div>

            <!-- Bookings & Payments -->
            <div class="dashboard-card p-4 md:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-purple-700">Bookings & Receipts</span>
                    <div class="w-7 h-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-purple-700">{{ $metrics['by_category']['reservation'] + $metrics['by_category']['payment'] }}</span>
                    <span class="text-xs text-[var(--text-muted)]">Verified</span>
                </div>
            </div>
        </div>

        <!-- ================= SEARCH & FILTER CONTROLS ================= -->
        <div class="dashboard-card p-4 md:p-5 space-y-4">
            <form method="GET" action="/notifications" id="filter-form" class="flex flex-col md:flex-row gap-3 md:items-center justify-between">
                
                <!-- Left: Status Filter Tabs -->
                <div class="flex items-center gap-1.5 p-1 bg-slate-100 rounded-xl w-fit shrink-0">
                    <a href="/notifications?{{ http_build_query(array_merge($filters, ['status' => 'all'])) }}"
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $filters['status'] === 'all' ? 'bg-white text-[var(--primary)] shadow-xs' : 'text-[var(--text-muted)] hover:text-[var(--primary)]' }}">
                        All ({{ $metrics['total'] }})
                    </a>
                    <a href="/notifications?{{ http_build_query(array_merge($filters, ['status' => 'unread'])) }}"
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $filters['status'] === 'unread' ? 'bg-white text-[var(--accent)] shadow-xs' : 'text-[var(--text-muted)] hover:text-[var(--primary)]' }}">
                        Unread ({{ $metrics['unread'] }})
                    </a>
                    <a href="/notifications?{{ http_build_query(array_merge($filters, ['status' => 'read'])) }}"
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $filters['status'] === 'read' ? 'bg-white text-emerald-700 shadow-xs' : 'text-[var(--text-muted)] hover:text-[var(--primary)]' }}">
                        Read ({{ $metrics['read'] }})
                    </a>
                </div>

                <!-- Right: Category Filter & Search Input -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 flex-1 md:justify-end">
                    <!-- Category Select -->
                    <div class="relative min-w-[170px]">
                        <select name="category" 
                                onchange="this.form.submit()"
                                class="w-full appearance-none px-3.5 py-2 pr-8 bg-[var(--background)] border border-[var(--border)] rounded-xl text-xs font-semibold text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-1 focus:ring-[var(--accent)] transition-all outline-none cursor-pointer">
                            @foreach($categories as $key => $label)
                                <option value="{{ $key }}" {{ $filters['category'] === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>

                    <!-- Search Box -->
                    <div class="relative flex-1 max-w-md">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                        <input type="text" 
                               name="q" 
                               value="{{ $filters['q'] }}" 
                               placeholder="Search title, facility, vehicle, or ref..." 
                               class="w-full pl-9 pr-9 py-2 bg-[var(--background)] border border-[var(--border)] rounded-xl text-xs text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-1 focus:ring-[var(--accent)] transition-all outline-none">
                        @if(!empty($filters['q']))
                            <a href="/notifications?{{ http_build_query(array_merge($filters, ['q' => ''])) }}" 
                               class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-0.5">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </a>
                        @endif
                    </div>

                    <!-- Hidden status field to maintain status tab -->
                    <input type="hidden" name="status" value="{{ $filters['status'] }}">
                </div>

            </form>
        </div>

        <!-- ================= NOTIFICATIONS LIST ================= -->
        <div class="space-y-3.5" id="notification-items-container">
            @if(count($notifications) === 0)
                <!-- Empty State -->
                <div class="dashboard-card p-10 md:p-14 text-center">
                    <div class="w-16 h-16 bg-blue-50 text-[var(--accent)] rounded-2xl flex items-center justify-center mx-auto mb-4 border border-blue-100 shadow-xs">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>

                    @if(!empty($filters['q']) || $filters['category'] !== 'all')
                        <h3 class="text-base font-bold text-[var(--text)] mb-1">No Matching Notifications</h3>
                        <p class="text-xs text-[var(--text-muted)] max-w-sm mx-auto mb-5">
                            We couldn't find any updates matching your filter or search query.
                        </p>
                        <a href="/notifications" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white rounded-xl text-xs font-semibold transition-colors">
                            Clear Active Filters
                        </a>
                    @elseif($filters['status'] === 'unread')
                        <h3 class="text-base font-bold text-[var(--text)] mb-1">No Unread Notifications</h3>
                        <p class="text-xs text-[var(--text-muted)] max-w-sm mx-auto mb-5">
                            You have reviewed all recent parking sessions, reservations, and receipts.
                        </p>
                        <a href="/notifications?status=all" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[var(--surface)] border border-[var(--border)] hover:border-[var(--primary)] text-[var(--text)] rounded-xl text-xs font-semibold transition-colors">
                            View All Notifications
                        </a>
                    @else
                        <h3 class="text-base font-bold text-[var(--text)] mb-1">Your Inbox is Empty</h3>
                        <p class="text-xs text-[var(--text-muted)] max-w-sm mx-auto mb-5">
                            Real-time parking alerts, barrier scans, and transaction receipts will appear here as you use NusaPark.
                        </p>
                        <a href="/dashboard" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white rounded-xl text-xs font-semibold transition-colors">
                            Return to Dashboard
                        </a>
                    @endif
                </div>
            @else
                @foreach($notifications as $item)
                    @php
                        $isUnread = !$item['is_read'];
                        $category = $item['category'];
                    @endphp

                    <div id="notif-card-{{ $item['id'] }}" 
                         class="dashboard-card p-4 sm:p-5 flex flex-col sm:flex-row items-start justify-between gap-4 transition-all duration-150 relative overflow-hidden
                                {{ $isUnread 
                                   ? 'border-blue-300/80 bg-gradient-to-r from-blue-50/30 via-white to-white shadow-sm ring-1 ring-blue-100' 
                                   : 'hover:border-slate-300' }}">

                        <!-- Left Accent Bar for Unread -->
                        @if($isUnread)
                            <div class="absolute top-0 bottom-0 left-0 w-1 bg-[var(--accent)]"></div>
                        @endif

                        <!-- Main Content (Icon + Details) -->
                        <div class="flex items-start gap-3.5 w-full sm:w-auto flex-1 min-w-0 pl-1 sm:pl-0">
                            
                            <!-- Icon according to Category -->
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 mt-0.5
                                {{ $category === 'session' ? 'bg-blue-100 text-[var(--accent)]' : '' }}
                                {{ $category === 'reservation' ? 'bg-purple-100 text-purple-700' : '' }}
                                {{ $category === 'payment' ? 'bg-emerald-100 text-emerald-700' : '' }}">
                                @if($category === 'session')
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                        <circle cx="7" cy="15" r="2"></circle>
                                        <circle cx="17" cy="15" r="2"></circle>
                                    </svg>
                                @elseif($category === 'reservation')
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                @elseif($category === 'payment')
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                @endif
                            </div>

                            <!-- Body Text -->
                            <div class="flex-1 min-w-0 space-y-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h4 class="text-sm font-bold {{ $isUnread ? 'text-[var(--text)]' : 'text-slate-700' }} tracking-tight">
                                        {{ $item['title'] }}
                                    </h4>

                                    @if($isUnread)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-[var(--accent)] border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)] animate-pulse"></span>
                                            New
                                        </span>
                                    @endif

                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-slate-100 text-slate-600">
                                        {{ $item['category_label'] }}
                                    </span>
                                </div>

                                <p class="text-xs text-[var(--text-muted)] leading-relaxed">
                                    {{ $item['message'] }}
                                </p>

                                <!-- Context Meta Chips -->
                                <div class="flex flex-wrap items-center gap-2 pt-1 text-[11px] text-slate-500">
                                    <span class="flex items-center gap-1 font-medium text-slate-600">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                        {{ $item['created_at_formatted'] }} ({{ $item['relative_time'] }})
                                    </span>

                                    @if(!empty($item['facility']))
                                        <span class="text-slate-300">•</span>
                                        <span class="font-medium text-slate-600">
                                            {{ $item['facility'] }}
                                        </span>
                                    @endif

                                    @if(!empty($item['vehicle_plate']))
                                        <span class="text-slate-300">•</span>
                                        <span class="font-mono font-bold bg-slate-100 px-1.5 py-0.2 rounded text-[10px] text-slate-700">
                                            {{ $item['vehicle_plate'] }}
                                        </span>
                                    @endif

                                    @if(!empty($item['reference']))
                                        <span class="text-slate-300">•</span>
                                        <span class="font-mono text-[10px] text-slate-500">
                                            Ref: {{ $item['reference'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <!-- Right Actions -->
                        <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2 w-full sm:w-auto shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-[var(--border)]">
                            
                            <!-- Destination Action Button -->
                            @if(!empty($item['action_url']))
                                <a href="{{ $item['action_url'] }}" 
                                   class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 rounded-lg bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white shadow-xs transition-colors">
                                    <span>{{ $item['action_label'] }}</span>
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </a>
                            @endif

                            <div class="flex items-center gap-1">
                                <!-- Mark Read Button (if unread) -->
                                @if($isUnread)
                                    <form method="POST" action="/notifications/{{ $item['id'] }}/read" class="mark-single-read-form">
                                        @csrf
                                        <button type="submit" 
                                                title="Mark as read"
                                                class="inline-flex items-center gap-1 text-xs font-semibold text-[var(--accent)] hover:text-[var(--accent-hover)] hover:bg-blue-50 px-2.5 py-1.5 rounded-lg transition-colors cursor-pointer">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <span>Mark read</span>
                                        </button>
                                    </form>
                                @endif

                                <!-- Delete Notification Button -->
                                <form method="POST" action="/notifications/{{ $item['id'] }}" onsubmit="return confirm('Remove this notification?')" class="delete-notif-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            title="Delete notification"
                                            class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>
                @endforeach
            @endif
        </div>

    </div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle AJAX mark single read
        document.querySelectorAll('.mark-single-read-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const url = form.getAttribute('action');
                const csrf = form.querySelector('input[name="_token"]').value;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Reload to reflect all reactive metrics & filter tab numbers accurately
                        window.location.reload();
                    }
                })
                .catch(() => {
                    form.submit(); // fallback to native submission
                });
            });
        });

        // Handle AJAX mark all as read
        const markAllForm = document.getElementById('mark-all-read-form');
        if (markAllForm) {
            markAllForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const url = markAllForm.getAttribute('action');
                const csrf = markAllForm.querySelector('input[name="_token"]').value;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch(() => {
                    markAllForm.submit();
                });
            });
        }
    });
</script>
@endpush

</x-layouts.app>
