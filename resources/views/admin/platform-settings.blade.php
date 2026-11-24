<x-layouts.admin activeNav="platform-settings" title="Platform Settings & Global Defaults — Super Admin NusaPark">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Configuration Synchronized</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start justify-between gap-3 shadow-xs" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center shrink-0 text-rose-600 font-bold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-rose-900">Configuration Error</p>
                <p class="text-xs sm:text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1 rounded-lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="mb-5 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 shadow-xs" role="alert">
        <div class="flex items-center gap-2 font-bold text-xs uppercase tracking-wider text-amber-800 mb-1">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
            <span>Validation Constraints Encountered</span>
        </div>
        <ul class="list-disc list-inside text-xs space-y-0.5 text-amber-800">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- ================= PAGE HEADER & BREADCRUMBS ================= -->
    <div class="space-y-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
            <div class="flex items-center gap-1.5 text-slate-500">
                <a href="/admin/dashboard" class="font-medium text-slate-400 hover:text-slate-600">Super Admin</a>
                <span>/</span>
                <span class="font-medium text-slate-400">Platform Governance</span>
                <span>/</span>
                <span class="font-semibold text-slate-700">Platform Settings</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-900 text-slate-200 border border-slate-700 font-medium text-[11px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span>Cluster Sync: Consistent</span>
                </span>
                <span class="text-slate-400 text-[11px] hidden md:inline">•</span>
                <span class="text-slate-500 text-[11px]">
                    Settings Authority: <strong class="text-slate-700 font-mono">{{ $lastUpdated }}</strong>
                </span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Platform Settings
                    </h1>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md">
                        Page 53
                    </span>
                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-md flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Audited Configuration Store</span>
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Manage global NusaPark configuration and platform defaults.
                </p>
            </div>

            <!-- Actions Row -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <!-- Refresh Button -->
                <a href="{{ route('admin.platform-settings', ['tab' => $activeTab]) }}" 
                   title="Refresh active settings"
                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <polyline points="1 20 1 14 7 14"></polyline>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                    <span>Refresh</span>
                </a>

                <!-- Factory Reset Button (Opens Safe Confirmation Modal) -->
                <button type="button" 
                        onclick="openFactoryResetModal()" 
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-xl text-xs font-semibold transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                        <polyline points="3 3 3 8 8 8"></polyline>
                    </svg>
                    <span>Restore Factory Defaults</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ================= HORIZONTAL CATEGORY TABS ================= -->
    <div class="flex items-center gap-1.5 overflow-x-auto pb-2 mb-6 scrollbar-thin">
        @php
            $tabIcons = [
                'general' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>',
                'localization' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>',
                'operational' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>',
                'notifications' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>',
                'security' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>',
                'retention' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>',
                'maintenance' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>',
                'environment' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>',
            ];
        @endphp

        @foreach($tabs as $tabKey => $tabLabel)
        <a href="{{ route('admin.platform-settings', ['tab' => $tabKey]) }}" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold whitespace-nowrap transition-all {{ $activeTab === $tabKey ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-900 border border-slate-200/80' }}">
            {!! $tabIcons[$tabKey] ?? '' !!}
            <span>{{ $tabLabel }}</span>
        </a>
        @endforeach
    </div>

    <!-- ================= TAB CONTENT PANELS ================= -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        
        <!-- Tab 1: General Platform Info -->
        @if($activeTab === 'general')
        <form method="POST" action="{{ route('admin.platform-settings.update') }}" class="p-5 sm:p-7 space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="section" value="general">

            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight">General Platform Identity & Branding</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Authoritative platform naming, legal entity metadata, and public support channels.</p>
                </div>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold">
                    Persistent Config
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Platform Brand Name</label>
                    <input type="text" name="platform_name" value="{{ old('platform_name', $settings['general']['platform_name'] ?? '') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                    <p class="text-[11px] text-slate-400 mt-1">Displayed on motorist mobile apps, vendor portals, and invoice headers.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">National Tagline</label>
                    <input type="text" name="brand_tagline" value="{{ old('brand_tagline', $settings['general']['brand_tagline'] ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                    <p class="text-[11px] text-slate-400 mt-1">Sub-heading rendered on platform login and public portal footers.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Legal Operating Entity</label>
                    <input type="text" name="operator_legal_entity" value="{{ old('operator_legal_entity', $settings['general']['operator_legal_entity'] ?? '') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                    <p class="text-[11px] text-slate-400 mt-1">Formal corporate enterprise name for legal partner contracts.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Operator NIB (Nomor Induk Berusaha)</label>
                    <input type="text" name="nib" value="{{ old('nib', $settings['general']['nib'] ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Operator NPWP</label>
                    <input type="text" name="npwp" value="{{ old('npwp', $settings['general']['npwp'] ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Public Support Portal URL</label>
                    <input type="url" name="public_portal_url" value="{{ old('public_portal_url', $settings['general']['public_portal_url'] ?? '') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                </div>

                <div class="md:col-span-2">
                    <label class="block font-semibold text-slate-700 mb-1">Corporate Headquarters Address</label>
                    <input type="text" name="headquarters_address" value="{{ old('headquarters_address', $settings['general']['headquarters_address'] ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Public Support Telephone</label>
                    <input type="text" name="support_hotline" value="{{ old('support_hotline', $settings['general']['support_hotline'] ?? '') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Emergency SRE Hotline (Tier-3)</label>
                    <input type="text" name="emergency_sre_phone" value="{{ old('emergency_sre_phone', $settings['general']['emergency_sre_phone'] ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Primary Support Email</label>
                    <input type="email" name="support_email" value="{{ old('support_email', $settings['general']['support_email'] ?? '') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Security Incident Reporting Email</label>
                    <input type="email" name="security_email" value="{{ old('security_email', $settings['general']['security_email'] ?? '') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">All updates to general platform info are audited.</span>
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
                    Save General Settings
                </button>
            </div>
        </form>
        @endif

        <!-- Tab 2: Localization & Regional Defaults -->
        @if($activeTab === 'localization')
        <form method="POST" action="{{ route('admin.platform-settings.update') }}" class="p-5 sm:p-7 space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="section" value="localization">

            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight">Localization & Regional Indonesian Defaults</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Timezone, currency formatting, and geospatial map anchor coordinates.</p>
                </div>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold">
                    Persistent Config
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Default Platform Language</label>
                    <select name="default_language" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="id" {{ ($settings['localization']['default_language'] ?? 'id') === 'id' ? 'selected' : '' }}>Bahasa Indonesia (Primary)</option>
                        <option value="en" {{ ($settings['localization']['default_language'] ?? 'id') === 'en' ? 'selected' : '' }}>English (International)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Standard Regional Timezone</label>
                    <select name="default_timezone" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                        <option value="Asia/Jakarta" {{ ($settings['localization']['default_timezone'] ?? '') === 'Asia/Jakarta' ? 'selected' : '' }}>Asia/Jakarta (WIB - UTC+7)</option>
                        <option value="Asia/Makassar" {{ ($settings['localization']['default_timezone'] ?? '') === 'Asia/Makassar' ? 'selected' : '' }}>Asia/Makassar (WITA - UTC+8)</option>
                        <option value="Asia/Jayapura" {{ ($settings['localization']['default_timezone'] ?? '') === 'Asia/Jayapura' ? 'selected' : '' }}>Asia/Jayapura (WIT - UTC+9)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Currency Code</label>
                    <input type="text" name="currency_code" value="{{ old('currency_code', $settings['localization']['currency_code'] ?? 'IDR') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Currency Display Symbol</label>
                    <input type="text" name="currency_symbol" value="{{ old('currency_symbol', $settings['localization']['currency_symbol'] ?? 'Rp') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-bold">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Date Display Format</label>
                    <input type="text" name="date_format" value="{{ old('date_format', $settings['localization']['date_format'] ?? 'd M Y') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">PHP format string (e.g. 'd M Y' -> 24 Oct 2026)</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Time Display Format</label>
                    <input type="text" name="time_format" value="{{ old('time_format', $settings['localization']['time_format'] ?? 'H:i') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">24-hour time notation (e.g. 'H:i' -> 23:15)</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Number Decimal Separator</label>
                    <input type="text" name="number_decimal_separator" value="{{ old('number_decimal_separator', $settings['localization']['number_decimal_separator'] ?? ',') }}" required maxlength="1" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 text-center font-bold">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Number Thousand Separator</label>
                    <input type="text" name="number_thousand_separator" value="{{ old('number_thousand_separator', $settings['localization']['number_thousand_separator'] ?? '.') }}" required maxlength="1" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 text-center font-bold">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Default Map Anchor Latitude</label>
                    <input type="number" step="0.000001" name="map_default_lat" value="{{ old('map_default_lat', $settings['localization']['map_default_lat'] ?? -6.1754) }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Default: -6.1754 (Monas, DKI Jakarta)</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Default Map Anchor Longitude</label>
                    <input type="number" step="0.000001" name="map_default_lng" value="{{ old('map_default_lng', $settings['localization']['map_default_lng'] ?? 106.8272) }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Default: 106.8272 (Monas, DKI Jakarta)</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Default Map Initial Zoom Level</label>
                    <input type="number" name="map_default_zoom" value="{{ old('map_default_zoom', $settings['localization']['map_default_zoom'] ?? 12) }}" required min="4" max="18" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">Localization settings affect display across driver, vendor, and admin portals.</span>
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
                    Save Localization Settings
                </button>
            </div>
        </form>
        @endif

        <!-- Tab 3: Operational Defaults -->
        @if($activeTab === 'operational')
        <form method="POST" action="{{ route('admin.platform-settings.update') }}" class="p-5 sm:p-7 space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="section" value="operational">

            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight">Operational Defaults & Gate Timing Thresholds</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Hardware barrier delays, ANPR confidence minimums, and parking session grace rules.</p>
                </div>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold">
                    Persistent Config
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Default Entry Grace Period (Minutes)</label>
                    <input type="number" name="default_grace_period_mins" value="{{ old('default_grace_period_mins', $settings['operational']['default_grace_period_mins'] ?? 10) }}" required min="0" max="60" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Duration motorist can exit without incurring tariff charges (Drop-off window).</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Overstay Security Alert Threshold (Hours)</label>
                    <input type="number" name="overstay_alert_threshold_hours" value="{{ old('overstay_alert_threshold_hours', $settings['operational']['overstay_alert_threshold_hours'] ?? 24) }}" required min="1" max="168" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Triggers high-priority operational alert when vehicle remains parked exceeding this limit.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">ANPR Camera Minimum Confidence (%)</label>
                    <input type="number" name="anpr_min_confidence_pct" value="{{ old('anpr_min_confidence_pct', $settings['operational']['anpr_min_confidence_pct'] ?? 85) }}" required min="50" max="100" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Below this OCR threshold, edge controller requests manual cashier validation.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Barrier Auto-Close Actuator Delay (Seconds)</label>
                    <input type="number" name="barrier_auto_close_delay_secs" value="{{ old('barrier_auto_close_delay_secs', $settings['operational']['barrier_auto_close_delay_secs'] ?? 5) }}" required min="1" max="30" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Physical barrier hold-open safety time after loop detector confirms vehicle passage.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">IoT Telemetry Heartbeat Poll Interval (Seconds)</label>
                    <input type="number" name="telemetry_heartbeat_interval_secs" value="{{ old('telemetry_heartbeat_interval_secs', $settings['operational']['telemetry_heartbeat_interval_secs'] ?? 30) }}" required min="5" max="120" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Frequency edge hubs send ping keep-alives before marking device offline.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Live Facility Capacity Warning Threshold (%)</label>
                    <input type="number" name="capacity_warning_threshold_pct" value="{{ old('capacity_warning_threshold_pct', $settings['operational']['capacity_warning_threshold_pct'] ?? 90) }}" required min="50" max="100" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Triggers amber warning on national spatial map when facility approaches full capacity.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Maximum Advance Booking Window (Days)</label>
                    <input type="number" name="max_booking_advance_days" value="{{ old('max_booking_advance_days', $settings['operational']['max_booking_advance_days'] ?? 7) }}" required min="1" max="30" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                </div>

                <div class="space-y-3 pt-2">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="allow_manual_gate_override_remote" value="1" {{ !empty($settings['operational']['allow_manual_gate_override_remote']) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                        <span class="font-semibold text-slate-800">Allow Remote Barrier Actuation by Super Admins</span>
                    </label>

                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="two_stage_exit_validation" value="1" {{ !empty($settings['operational']['two_stage_exit_validation']) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                        <span class="font-semibold text-slate-800">Enforce Two-Stage Validation at Exit (ANPR + QR Voucher)</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">Timing adjustments are dispatched to edge gateway daemons on next heartbeat.</span>
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
                    Save Operational Defaults
                </button>
            </div>
        </form>
        @endif

        <!-- Tab 4: Notification Defaults -->
        @if($activeTab === 'notifications')
        <form method="POST" action="{{ route('admin.platform-settings.update') }}" class="p-5 sm:p-7 space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="section" value="notifications">

            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight">Notification Defaults & Multi-Channel Dispatch</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Platform alert routing, SRE emergency banners, and operational digests.</p>
                </div>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold">
                    Persistent Config
                </span>
            </div>

            <div class="space-y-4 text-xs">
                <!-- Global Toggle -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/90 flex items-center justify-between">
                    <div>
                        <div class="font-bold text-slate-900 text-xs">Global Notification Engine</div>
                        <p class="text-[11px] text-slate-500 mt-0.5">Master kill-switch for automated outbound notifications across all channels.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="global_notifications_enabled" value="1" {{ !empty($settings['notifications']['global_notifications_enabled']) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                </div>

                <!-- Channels Checklist -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-2">Enabled Platform Outbound Channels</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="p-3 rounded-xl border border-slate-200 flex items-center gap-3 cursor-pointer hover:bg-slate-50">
                            <input type="checkbox" name="dispatch_channel_email" value="1" {{ !empty($settings['notifications']['dispatch_channel_email']) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                            <div>
                                <span class="font-bold text-slate-800">Email Gateway (SMTP / SES)</span>
                                <p class="text-[11px] text-slate-400">Transaction receipts and incident escalations</p>
                            </div>
                        </label>

                        <label class="p-3 rounded-xl border border-slate-200 flex items-center gap-3 cursor-pointer hover:bg-slate-50">
                            <input type="checkbox" name="dispatch_channel_inapp" value="1" {{ !empty($settings['notifications']['dispatch_channel_inapp']) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                            <div>
                                <span class="font-bold text-slate-800">In-App Notification Feed</span>
                                <p class="text-[11px] text-slate-400">Real-time alerts inside web admin and vendor dashboards</p>
                            </div>
                        </label>

                        <label class="p-3 rounded-xl border border-slate-200 flex items-center gap-3 cursor-pointer hover:bg-slate-50">
                            <input type="checkbox" name="dispatch_channel_whatsapp" value="1" {{ !empty($settings['notifications']['dispatch_channel_whatsapp']) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                            <div>
                                <span class="font-bold text-slate-800">WhatsApp / SMS Gateway</span>
                                <p class="text-[11px] text-slate-400">Emergency hardware offline and Sev-1 incident alerts</p>
                            </div>
                        </label>

                        <label class="p-3 rounded-xl border border-slate-200 flex items-center gap-3 cursor-pointer hover:bg-slate-50">
                            <input type="checkbox" name="dispatch_channel_push" value="1" {{ !empty($settings['notifications']['dispatch_channel_push']) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                            <div>
                                <span class="font-bold text-slate-800">Mobile Push Notifications</span>
                                <p class="text-[11px] text-slate-400">FCM push messages to motorist driver application</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Emergency Broadcast Banner -->
                <div class="p-4 rounded-xl border border-amber-200 bg-amber-50/50 space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="font-bold text-slate-900">National Emergency Broadcast Banner</span>
                            <p class="text-[11px] text-slate-500">Displays global announcement banner across all driver and vendor apps.</p>
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer font-bold text-xs text-amber-800">
                            <input type="checkbox" name="sre_emergency_broadcast_active" value="1" {{ !empty($settings['notifications']['sre_emergency_broadcast_active']) ? 'checked' : '' }} class="rounded text-amber-600 focus:ring-amber-500 border-amber-300 w-4 h-4">
                            <span>Broadcast Active</span>
                        </label>
                    </div>

                    <textarea name="sre_emergency_broadcast_msg" rows="2" class="w-full px-3 py-2 rounded-xl border border-amber-200 bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 text-slate-800 text-xs" placeholder="Enter emergency status advisory message...">{{ old('sre_emergency_broadcast_msg', $settings['notifications']['sre_emergency_broadcast_msg'] ?? '') }}</textarea>
                </div>

                <!-- SRE Digest -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Daily SRE Executive Digest Distribution List</label>
                    <input type="text" name="digest_recipients" value="{{ old('digest_recipients', $settings['notifications']['digest_recipients'] ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Comma-separated email addresses receiving morning operational summaries at 07:00 WIB.</p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">Emergency broadcasts take effect immediately upon saving.</span>
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
                    Save Notification Settings
                </button>
            </div>
        </form>
        @endif

        <!-- Tab 5: Security & Session Policies -->
        @if($activeTab === 'security')
        <form method="POST" action="{{ route('admin.platform-settings.update') }}" class="p-5 sm:p-7 space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="section" value="security">

            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight">Security Baseline & Session Access Policies</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Super Admin authentication controls, IP CIDR restriction, and lockout rules.</p>
                </div>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold">
                    Persistent Config
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Super Admin Session Idle Timeout (Minutes)</label>
                    <input type="number" name="session_idle_timeout_mins" value="{{ old('session_idle_timeout_mins', $settings['security']['session_idle_timeout_mins'] ?? 60) }}" required min="5" max="480" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Inactivity duration before requiring administrative re-authentication.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Max Failed Login Attempts Before Lockout</label>
                    <input type="number" name="max_login_attempts" value="{{ old('max_login_attempts', $settings['security']['max_login_attempts'] ?? 5) }}" required min="3" max="20" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Consecutive failed password attempts before temporary IP/account rate-limit.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Temporary Lockout Duration (Minutes)</label>
                    <input type="number" name="lockout_duration_mins" value="{{ old('lockout_duration_mins', $settings['security']['lockout_duration_mins'] ?? 30) }}" required min="5" max="1440" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Administrative Password Expiration (Days)</label>
                    <input type="number" name="password_expiry_days" value="{{ old('password_expiry_days', $settings['security']['password_expiry_days'] ?? 90) }}" required min="0" max="365" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Set to 0 to disable automated password rotation prompts.</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Super Admin IP Restriction Enforcement Mode</label>
                    <select name="ip_restriction_mode" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800">
                        <option value="audit_only" {{ ($settings['security']['ip_restriction_mode'] ?? '') === 'audit_only' ? 'selected' : '' }}>Audit Only (Flag unknown IPs in audit ledger)</option>
                        <option value="enforced_whitelist" {{ ($settings['security']['ip_restriction_mode'] ?? '') === 'enforced_whitelist' ? 'selected' : '' }}>Enforced Whitelist (Strict block for non-whitelisted CIDR)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Administrative IP CIDR Whitelist</label>
                    <input type="text" name="admin_ip_whitelist" value="{{ old('admin_ip_whitelist', $settings['security']['admin_ip_whitelist'] ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-800 font-mono">
                    <p class="text-[11px] text-slate-400 mt-1">Comma-separated IPv4 CIDR blocks (e.g. '103.28.114.0/24, 127.0.0.1')</p>
                </div>

                <div class="md:col-span-2 space-y-2 pt-2 border-t border-slate-100">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="enforce_mfa_superadmins" value="1" {{ !empty($settings['security']['enforce_mfa_superadmins']) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                        <span class="font-semibold text-slate-800">Mandate Hardware Multi-Factor Authentication (TOTP / YubiKey) for Super Admins</span>
                    </label>

                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="hsts_enabled" value="1" {{ !empty($settings['security']['hsts_enabled']) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                        <span class="font-semibold text-slate-800">Enable Strict Transport Security (HSTS) with Preload</span>
                    </label>

                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="csp_header_enforced" value="1" {{ !empty($settings['security']['csp_header_enforced']) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300 w-4 h-4">
                        <span class="font-semibold text-slate-800">Enforce Content Security Policy (CSP) Headers</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">Security adjustments take effect on subsequent session refreshes.</span>
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
                    Save Security Policy
                </button>
            </div>
        </form>
        @endif

        <!-- Tab 6: Data Retention & Legal Compliance -->
        @if($activeTab === 'retention')
        <div class="p-5 sm:p-7 space-y-6 text-xs">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight">Data Retention & Statutory Housekeeping</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Authoritative retention schedules aligned with Bank Indonesia and ISO 27001 regulatory mandates.</p>
                </div>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-slate-100 text-slate-700 border border-slate-200 font-semibold">
                    Statutory Policy
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Audit Ledger Retention Card -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-900 text-xs">Administrative Audit Trail</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                            365 Days
                        </span>
                    </div>
                    <p class="text-[11px] text-slate-600 leading-relaxed">
                        Append-only security log recording all operator logins, API key rotations, barrier overrides, and billing modifications.
                    </p>
                    <div class="text-[10px] text-slate-400 font-mono pt-1 border-t border-slate-200/60">
                        Mandatory Minimum: 365 Days (Bank Indonesia PBI 23/6/PBI/2021)
                    </div>
                </div>

                <!-- IoT Telemetry Retention Card -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-900 text-xs">IoT Sensor Raw Heartbeats</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-200 text-slate-700">
                            90 Days
                        </span>
                    </div>
                    <p class="text-[11px] text-slate-600 leading-relaxed">
                        High-frequency ping latencies and ultrasonic bay presence logs. Summarized hourly after 30 days.
                    </p>
                    <div class="text-[10px] text-slate-400 font-mono pt-1 border-t border-slate-200/60">
                        Storage Optimization: Aggregated into monthly time-series
                    </div>
                </div>

                <!-- SRE Alert History Card -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-900 text-xs">Operational Alerts & Triage</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-200 text-slate-700">
                            180 Days
                        </span>
                    </div>
                    <p class="text-[11px] text-slate-600 leading-relaxed">
                        Historical alert triggers, threshold violations, and on-call SRE acknowledgment logs.
                    </p>
                    <div class="text-[10px] text-slate-400 font-mono pt-1 border-t border-slate-200/60">
                        Retention Standard: 6 Months operational triage window
                    </div>
                </div>

                <!-- Incidents Archival Card -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-900 text-xs">Resolved Incident Post-Mortems</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                            730 Days (2 Years)
                        </span>
                    </div>
                    <p class="text-[11px] text-slate-600 leading-relaxed">
                        Sev-1 through Sev-4 incident declarations, root-cause analyses, and mitigation post-mortems.
                    </p>
                    <div class="text-[10px] text-slate-400 font-mono pt-1 border-t border-slate-200/60">
                        ISO/IEC 27001:2022 Statutory SLA Evidence Archive
                    </div>
                </div>
            </div>

            <!-- Statutory Compliance Seal -->
            <div class="p-4 rounded-xl bg-slate-900 text-white space-y-2">
                <div class="flex items-center gap-2 text-emerald-400 font-bold text-xs uppercase tracking-wider">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <span>Regulatory Framework Compliance</span>
                </div>
                <p class="text-slate-300 text-xs leading-relaxed">
                    Data retention thresholds for financial transactions and administrative security logs are hard-coded to satisfy <strong>Bank Indonesia PBI 23/6/PBI/2021</strong> and <strong>ISO/IEC 27001:2022</strong> statutory audits. Retention periods cannot be reduced below national regulatory baselines by any platform administrator.
                </p>
            </div>
        </div>
        @endif

        <!-- Tab 7: Maintenance Mode & Feature Flags -->
        @if($activeTab === 'maintenance')
        <form method="POST" action="{{ route('admin.platform-settings.update') }}" class="p-5 sm:p-7 space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="section" value="maintenance">

            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight">Platform Maintenance & Operational Feature Flags</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Emergency cluster modes, driver onboarding gates, and edge sensor rate-limiting.</p>
                </div>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold">
                    Persistent Config
                </span>
            </div>

            <div class="space-y-4 text-xs">
                <!-- Emergency Maintenance Mode Banner -->
                <div class="p-4 rounded-xl border border-rose-200 bg-rose-50/50 space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="font-bold text-rose-900 text-sm">Emergency Platform Maintenance Mode</span>
                            <p class="text-[11px] text-rose-700 mt-0.5">Places the central platform into maintenance mode. Physical gates remain in local offline cache mode.</p>
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer font-bold text-xs text-rose-900">
                            <input type="checkbox" name="emergency_maintenance_mode" value="1" {{ !empty($settings['maintenance']['emergency_maintenance_mode']) ? 'checked' : '' }} class="rounded text-rose-600 focus:ring-rose-500 border-rose-300 w-4 h-4">
                            <span>Activate Maintenance</span>
                        </label>
                    </div>

                    <div>
                        <label class="block font-semibold text-rose-900 mb-1">Public Maintenance Notice Message</label>
                        <textarea name="maintenance_notice_message" rows="2" class="w-full px-3 py-2 rounded-xl border border-rose-200 bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 text-slate-800 text-xs">{{ old('maintenance_notice_message', $settings['maintenance']['maintenance_notice_message'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Feature Flags List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-slate-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-slate-900">Public Driver Registration</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="driver_registration_enabled" value="1" {{ !empty($settings['maintenance']['driver_registration_enabled']) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Allows new motorists to create self-service accounts via the NusaPark mobile app.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-slate-900">Automated Instant QRIS Payouts</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="beta_instant_qris_payouts" value="1" {{ !empty($settings['maintenance']['beta_instant_qris_payouts']) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Disburses merchant QRIS settlements in real-time batches via Bank Indonesia BI-FAST network.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-200 space-y-2 sm:col-span-2">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-slate-900">Edge Telemetry Throttling Protection</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="edge_telemetry_rate_limiting" value="1" {{ !empty($settings['maintenance']['edge_telemetry_rate_limiting']) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Throttles high-frequency sensor ping spikes during peak festival and sporting venue egress events to protect database write IOPS.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">Maintenance mode status is logged to the national audit trail.</span>
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-colors shadow-xs">
                    Save Maintenance & Flags
                </button>
            </div>
        </form>
        @endif

        <!-- Tab 8: Runtime & Environment Metadata (Read-Only) -->
        @if($activeTab === 'environment')
        <div class="p-5 sm:p-7 space-y-6 text-xs">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight">Active Runtime & Infrastructure Environment</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Read-only deployment stack metadata. Deployment modifications require standard CI/CD deployment pipelines.</p>
                </div>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-slate-100 text-slate-700 border border-slate-200 font-semibold">
                    Read-Only Runtime
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">PHP Runtime Engine</span>
                    <span class="font-mono font-bold text-slate-900 text-xs mt-1 block">PHP {{ $envInfo['php_version'] }}</span>
                </div>

                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Laravel Framework</span>
                    <span class="font-mono font-bold text-slate-900 text-xs mt-1 block">v{{ $envInfo['laravel_version'] }}</span>
                </div>

                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Application Environment</span>
                    <span class="font-mono font-bold text-indigo-600 text-xs mt-1 block uppercase">{{ $envInfo['app_env'] }}</span>
                </div>

                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Application Debug Mode</span>
                    <span class="font-mono font-bold text-slate-900 text-xs mt-1 block">{{ $envInfo['app_debug'] }}</span>
                </div>

                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Cache Subsystem Driver</span>
                    <span class="font-mono font-bold text-slate-900 text-xs mt-1 block uppercase">{{ $envInfo['cache_driver'] }}</span>
                </div>

                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Queue Job Dispatcher</span>
                    <span class="font-mono font-bold text-slate-900 text-xs mt-1 block uppercase">{{ $envInfo['queue_connection'] }}</span>
                </div>

                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Primary Database Driver</span>
                    <span class="font-mono font-bold text-slate-900 text-xs mt-1 block uppercase">{{ $envInfo['database_default'] }}</span>
                </div>

                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Server Operating System</span>
                    <span class="font-mono font-bold text-slate-900 text-xs mt-1 block">{{ $envInfo['server_os'] }}</span>
                </div>

                <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Current Server Time</span>
                    <span class="font-mono font-bold text-slate-900 text-xs mt-1 block">{{ $envInfo['server_time'] }}</span>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-slate-100 text-slate-600 text-xs leading-relaxed">
                <strong>Deployment Note:</strong> Environment parameters (e.g. database host credentials, Redis authentication, and third-party API secret tokens) are managed securely through encrypted infrastructure secrets and deployment configuration files. For security, environment secrets are never displayed or updated through this administrative web interface.
            </div>
        </div>
        @endif

    </div>

    <!-- ================= MODAL: RESTORE FACTORY DEFAULTS ================= -->
    <div id="factoryResetModalBackdrop" 
         onclick="closeFactoryResetModal()" 
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 hidden transition-opacity opacity-0"></div>

    <div id="factoryResetModal" 
         class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl z-50 hidden transition-all p-6 text-xs">
        
        <div class="flex items-center gap-3 text-rose-600 mb-3">
            <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-900">Restore Factory Baseline Defaults</h3>
                <p class="text-xs text-slate-500">Reverts all platform settings across all modules.</p>
            </div>
        </div>

        <p class="text-slate-600 leading-relaxed mb-4">
            Are you sure you want to revert all platform configuration options (grace periods, gate timing thresholds, notification channels, and branding defaults) back to initial factory baselines? 
            This action will be permanently recorded in the administrative audit trail.
        </p>

        <form method="POST" action="{{ route('admin.platform-settings.reset') }}">
            @csrf

            <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeFactoryResetModal()" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl font-semibold">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-bold shadow-xs">
                    Confirm Factory Reset
                </button>
            </div>
        </form>
    </div>

    <!-- Scripts for Factory Reset Modal -->
    <script>
        function openFactoryResetModal() {
            const backdrop = document.getElementById('factoryResetModalBackdrop');
            const modal = document.getElementById('factoryResetModal');

            backdrop.classList.remove('hidden');
            modal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
            }, 10);
        }

        function closeFactoryResetModal() {
            const backdrop = document.getElementById('factoryResetModalBackdrop');
            const modal = document.getElementById('factoryResetModal');

            backdrop.classList.add('opacity-0');
            setTimeout(() => {
                backdrop.classList.add('hidden');
                modal.classList.add('hidden');
            }, 200);
        }

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFactoryResetModal();
            }
        });
    </script>
</x-layouts.admin>
