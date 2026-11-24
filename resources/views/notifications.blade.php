<x-layouts.app activeNav="notifications">
    <div class="w-full space-y-6">

        <!-- ================= PAGE HEADER WITH GRAPHIC ================= -->
        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6 pb-2">
            
            <!-- Left Title & Subtitle -->
            <div class="max-w-xl relative z-10">
                <!-- Tags / Breadcrumb -->
                <div class="flex items-center gap-2 mb-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        Driver Inbox
                    </span>
                    <span class="text-xs font-semibold text-slate-500">Real-time Activity</span>
                </div>

                <div class="flex items-center gap-3 mt-1">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Notifications
                    </h1>
                    @if($metrics['unread'] > 0)
                        <span id="unread-count-pill" class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold bg-blue-600 text-white shadow-2xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                            {{ $metrics['unread'] }} Unread
                        </span>
                    @else
                        <span id="unread-count-pill" class="inline-flex items-center gap-1 px-3 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            All Caught Up
                        </span>
                    @endif
                </div>

                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mt-1">
                    Stay updated on active parking sessions, slot reservations, smart barrier scans, and verified payments.
                </p>
            </div>

            <!-- Right Graphic & Mark All as Read Button -->
            <div class="flex items-center gap-4 relative z-10">
                <!-- Phone & Barrier Illustration -->
                <div class="hidden md:block absolute -top-8 right-44 h-24 w-auto pointer-events-none select-none opacity-95">
                    <img src="{{ asset('images/notifications-header-phone.png') }}" alt="Notifications Alert" class="h-full w-auto object-contain" />
                </div>

                <form method="POST" action="/notifications/read-all" id="mark-all-read-form">
                    @csrf
                    <button type="submit" 
                            id="btn-mark-all-read"
                            class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 text-xs sm:text-sm font-bold flex items-center gap-1.5 shadow-2xs hover:shadow-xs transition-all cursor-pointer">
                        <svg class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Mark all as read</span>
                    </button>
                </form>
            </div>

        </div>

        <!-- ================= FLASH FEEDBACK ================= -->
        @if(session('notification_success'))
            <div id="alert-notif-success" class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200/90 rounded-2xl text-emerald-800 text-xs sm:text-sm shadow-xs transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <span>{{ session('notification_success') }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-notif-success').remove()" class="text-emerald-600 hover:text-emerald-800 p-1">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
        @endif

        <!-- ================= 4 SUMMARY METRIC CARDS ================= -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Card 1: Total Updates -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 block">Total Updates</span>
                    <span class="text-2xl font-black text-slate-900 tracking-tight leading-tight block">{{ $metrics['total'] }}</span>
                    <span class="text-[11px] text-slate-400 font-medium">All records</span>
                </div>
            </div>

            <!-- Card 2: Unread Alerts -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 block">Unread Alerts</span>
                    <span class="text-2xl font-black text-slate-900 tracking-tight leading-tight block" id="card-unread-stat">{{ $metrics['unread'] }}</span>
                    <span class="text-[11px] text-slate-400 font-medium">Requires review</span>
                </div>
            </div>

            <!-- Card 3: Parking Sessions -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 font-black text-base">
                    P
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 block">Parking Sessions</span>
                    <span class="text-2xl font-black text-slate-900 tracking-tight leading-tight block">{{ $metrics['sessions'] ?? $metrics['by_category']['session'] }}</span>
                    <span class="text-[11px] text-slate-400 font-medium">Gates & on-site</span>
                </div>
            </div>

            <!-- Card 4: Bookings & Receipts -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 block">Bookings & Receipts</span>
                    <span class="text-2xl font-black text-slate-900 tracking-tight leading-tight block">{{ $metrics['bookings_receipts'] ?? ($metrics['by_category']['reservation'] + $metrics['by_category']['payment']) }}</span>
                    <span class="text-[11px] text-slate-400 font-medium">Verified</span>
                </div>
            </div>

        </div>

        <!-- ================= SEARCH & FILTER BAR CARD ================= -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs">
            <form method="GET" action="/notifications" id="filter-form" class="flex flex-wrap lg:flex-nowrap items-center justify-between gap-3">
                
                <!-- Left: Status Filter Tabs -->
                <div class="flex items-center gap-2 w-full sm:w-auto" id="status-tabs">
                    <button type="button" 
                            onclick="filterStatus('all')" 
                            id="tab-all"
                            class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm transition-all cursor-pointer">
                        All ({{ $metrics['total'] }})
                    </button>
                    <button type="button" 
                            onclick="filterStatus('unread')" 
                            id="tab-unread"
                            class="px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-all cursor-pointer">
                        Unread ({{ $metrics['unread'] }})
                    </button>
                    <button type="button" 
                            onclick="filterStatus('read')" 
                            id="tab-read"
                            class="px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-all cursor-pointer">
                        Read ({{ $metrics['read'] }})
                    </button>
                </div>

                <!-- Right: Category Dropdown & Live Search Box -->
                <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 w-full sm:w-auto flex-1 lg:justify-end">
                    
                    <!-- Category Select Dropdown -->
                    <div class="relative w-full sm:w-auto min-w-[150px]">
                        <select name="category" 
                                id="category-select"
                                onchange="filterCategoryLive()"
                                class="w-full appearance-none px-4 py-2 pr-8 bg-slate-50/50 hover:bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all cursor-pointer">
                            <option value="all">All Updates</option>
                            <option value="session">Parking Sessions</option>
                            <option value="reservation">Reservations</option>
                            <option value="payment">Payments & Receipts</option>
                        </select>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>

                    <!-- Search Box -->
                    <div class="relative w-full sm:w-80">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                        <input type="text" 
                               id="notif-search" 
                               oninput="filterNotificationsLive()" 
                               placeholder="Search title, facility, vehicle, or reference..." 
                               class="w-full pl-9 pr-4 py-2 bg-slate-50/50 focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-2xs transition-all">
                    </div>

                </div>

            </form>
        </div>

        <!-- ================= NOTIFICATIONS LIST ================= -->
        <div class="space-y-3.5" id="notification-items-container">
            @forelse($notifications as $item)
                @php
                    $isUnread = !$item['is_read'];
                    $category = $item['category'];

                    // Determine Icon and styles
                    $iconBg = 'bg-blue-50 text-blue-600';
                    if ($category === 'reservation') {
                        $iconBg = 'bg-purple-50 text-purple-600';
                    } elseif ($category === 'payment' || str_contains(strtolower($item['title']), 'refund')) {
                        $iconBg = 'bg-emerald-50 text-emerald-600';
                    }
                @endphp

                <div id="notif-card-{{ $item['id'] }}" 
                     class="notification-item bg-white rounded-2xl sm:rounded-3xl p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 transition-all duration-150 relative overflow-hidden {{ $isUnread ? 'border-2 border-blue-500 shadow-xs' : 'border border-slate-200/90 shadow-2xs hover:shadow-xs' }}"
                     data-status="{{ $isUnread ? 'unread' : 'read' }}"
                     data-category="{{ $category }}"
                     data-text="{{ strtolower($item['title'] . ' ' . $item['message'] . ' ' . ($item['facility'] ?? '') . ' ' . ($item['reference'] ?? '') . ' ' . ($item['vehicle_plate'] ?? '')) }}">

                    <!-- Left Accent Bar for Unread -->
                    @if($isUnread)
                        <div class="absolute top-0 bottom-0 left-0 w-1.5 bg-blue-600"></div>
                    @endif

                    <!-- Left: Indicator, Icon & Details -->
                    <div class="flex items-start gap-4 flex-1 min-w-0 {{ $isUnread ? 'pl-2' : '' }}">
                        
                        <!-- Unread Dot Indicator -->
                        <div class="pt-2 shrink-0">
                            @if($isUnread)
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-600 block shadow-xs"></span>
                            @else
                                <span class="w-2.5 h-2.5 rounded-full bg-transparent block"></span>
                            @endif
                        </div>

                        <!-- Category Icon -->
                        <div class="w-10 h-10 rounded-xl {{ $iconBg }} flex items-center justify-center shrink-0">
                            @if($category === 'session' && str_contains(strtolower($item['title']), 'completed'))
                                <span class="font-black text-sm">P</span>
                            @elseif($category === 'session')
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="10" width="18" height="8" rx="2"></rect>
                                    <path d="M5 10L7 5h10l2 5"></path>
                                    <circle cx="7" cy="18" r="1.5"></circle>
                                    <circle cx="17" cy="18" r="1.5"></circle>
                                </svg>
                            @elseif($category === 'reservation')
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            @elseif(str_contains(strtolower($item['title']), 'refund'))
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                                    <path d="M3 3v5h5"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                            @endif
                        </div>

                        <!-- Notification Body Text -->
                        <div class="flex-1 min-w-0">
                            <!-- Title & Badges -->
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 tracking-tight">
                                    {{ $item['title'] }}
                                </h4>

                                @if($isUnread)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                                        New
                                    </span>
                                @endif

                                @if($category === 'session')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600">
                                        Parking Session
                                    </span>
                                @elseif($category === 'reservation')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-700">
                                        Reservation
                                    </span>
                                @elseif(str_contains(strtolower($item['title']), 'refund'))
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700">
                                        Refund
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700">
                                        Payment
                                    </span>
                                @endif
                            </div>

                            <!-- Message Content -->
                            <p class="text-xs text-slate-500 leading-relaxed">
                                {{ $item['message'] }}
                            </p>

                            <!-- Meta Chips Row -->
                            <div class="flex flex-wrap items-center gap-3 pt-2 text-[11px] text-slate-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                    </svg>
                                    <span>{{ $item['created_at_formatted'] }} ({{ $item['relative_time'] }})</span>
                                </span>

                                @if(!empty($item['facility']))
                                    <span class="flex items-center gap-1">
                                        <span>📍 {{ $item['facility'] }}</span>
                                    </span>
                                @endif

                                @if(!empty($item['vehicle_plate']))
                                    <span class="inline-flex items-center gap-1 bg-slate-100 px-2 py-0.5 rounded font-mono font-bold text-[10px] text-slate-700">
                                        🚗 {{ $item['vehicle_plate'] }}
                                    </span>
                                @endif

                                @if(!empty($item['reference']))
                                    <span class="font-mono text-[11px] text-slate-400">
                                        Ref: {{ $item['reference'] }}
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Action Button & Menu -->
                    <div class="flex md:flex-col items-center md:items-end justify-between md:justify-center gap-2 shrink-0 pt-2 md:pt-0 border-t md:border-t-0 border-slate-100">
                        
                        <!-- Main Action Button -->
                        @if(!empty($item['action_url']))
                            <a href="{{ $item['action_url'] }}" 
                               class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-xs transition-all whitespace-nowrap">
                                <span>{{ $item['action_label'] }}</span>
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        @endif

                        <div class="flex items-center gap-2">
                            <!-- Mark Read Button (if unread) -->
                            @if($isUnread)
                                <form method="POST" action="/notifications/{{ $item['id'] }}/read" class="mark-single-read-form inline">
                                    @csrf
                                    <button type="submit" 
                                            title="Mark as read"
                                            class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors cursor-pointer">
                                        <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span>Mark as read</span>
                                    </button>
                                </form>
                            @endif

                            <!-- Delete Option Menu Button -->
                            <form method="POST" action="/notifications/{{ $item['id'] }}" onsubmit="return confirm('Delete this notification?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        title="Delete notification"
                                        class="p-1 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            @empty
                <!-- Empty State -->
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-200">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Your Inbox is Empty</h3>
                    <p class="text-xs text-slate-400 mt-1 mb-4">You have reviewed all recent parking notifications and activity updates.</p>
                    <a href="/dashboard" class="inline-flex px-4 py-2 rounded-xl bg-blue-600 text-white font-bold text-xs shadow-sm">
                        Return to Dashboard
                    </a>
                </div>
            @endforelse
        </div>

    </div>

    <!-- ================= CLIENT-SIDE FILTERING JAVASCRIPT ================= -->
    @push('scripts')
    <script>
        let currentStatus = 'all';

        function filterStatus(status) {
            currentStatus = status;

            // Update Tab styles
            const tabs = ['all', 'unread', 'read'];
            tabs.forEach(t => {
                const el = document.getElementById('tab-' + t);
                if (el) {
                    if (t === status) {
                        el.className = 'px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm transition-all cursor-pointer';
                    } else {
                        el.className = 'px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-all cursor-pointer';
                    }
                }
            });

            applyNotificationFilters();
        }

        function filterCategoryLive() {
            applyNotificationFilters();
        }

        function filterNotificationsLive() {
            applyNotificationFilters();
        }

        function applyNotificationFilters() {
            const category = document.getElementById('category-select')?.value || 'all';
            const query = (document.getElementById('notif-search')?.value || '').toLowerCase().trim();
            const cards = document.querySelectorAll('.notification-item');

            cards.forEach(card => {
                const itemStatus = card.getAttribute('data-status');
                const itemCategory = card.getAttribute('data-category');
                const itemText = card.getAttribute('data-text') || '';

                const matchesStatus = (currentStatus === 'all') || (itemStatus === currentStatus);
                const matchesCategory = (category === 'all') || (itemCategory === category);
                const matchesQuery = !query || itemText.includes(query);

                if (matchesStatus && matchesCategory && matchesQuery) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
    @endpush

</x-layouts.app>
