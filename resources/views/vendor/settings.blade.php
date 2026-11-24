<x-layouts.vendor activeNav="settings" title="Vendor Settings & Organization Profile - NusaPark Enterprise">

    <!-- ================= FLASH NOTIFICATIONS ================= -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start justify-between gap-3 shadow-xs animate-fade-in" role="alert">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-900">Configuration Saved</p>
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
                <p class="text-xs font-bold uppercase tracking-wider text-red-900">Settings Notice</p>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-800 p-1 rounded-lg hover:bg-red-100 cursor-pointer" aria-label="Dismiss alert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    @endif

    <!-- ================= PAGE HEADER ================= -->
    <div class="p-5 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        
        <!-- Header Info & Metadata -->
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center font-bold text-base shadow-xs shrink-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Administration • Page 36</span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[var(--accent)] border border-blue-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)] animate-pulse"></span>
                        Authorized Operator Scope
                    </span>
                    <span class="text-xs text-slate-400 hidden md:inline">• Vendor ID: {{ $settings['profile']['id'] }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text)] tracking-tight">
                    Settings
                </h1>
                <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-0.5">
                    Manage vendor organization profile, corporate contact information, and operational preferences.
                </p>
            </div>
        </div>

        <!-- Header Actions -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Refresh Action -->
            <button type="button" 
                    onclick="window.location.reload()" 
                    class="p-2.5 rounded-xl border border-[var(--border)] bg-slate-50 hover:bg-slate-100 text-slate-700 hover:text-[var(--primary)] transition-colors cursor-pointer shadow-xs" 
                    title="Refresh Live Settings State"
                    aria-label="Refresh Live Settings State">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
            </button>

            <!-- Reset to Defaults Action -->
            <form action="{{ route('vendor.settings.reset') }}" method="POST" class="inline" onsubmit="return confirm('Restore all vendor organization settings and operational parameters to factory defaults?');">
                @csrf
                <button type="submit" 
                        class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold transition-all shadow-xs cursor-pointer flex items-center gap-2"
                        title="Reset settings to platform defaults">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><polyline points="3 3 3 8 8 8"></polyline></svg>
                    <span>Reset Defaults</span>
                </button>
            </form>
        </div>
    </div>

    <!-- ================= TENANT IDENTITY SUMMARY BANNER ================= -->
    <div class="p-5 rounded-2xl bg-gradient-to-r from-slate-900 to-slate-800 text-white shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            @if(!empty($settings['profile']['logo_url']))
            <img src="{{ $settings['profile']['logo_url'] }}" 
                 alt="{{ $settings['profile']['brand_name'] }} Logo" 
                 class="w-14 h-14 rounded-2xl bg-white object-contain p-1 border border-white/20 shadow-xs shrink-0">
            @else
            <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-xl font-black text-blue-300 shrink-0">
                {{ $settings['profile']['logo_initials'] ?? 'CPS' }}
            </div>
            @endif
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-500/20 text-blue-300 border border-blue-400/30">
                        {{ $settings['profile']['partner_tier'] }}
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        Contract {{ $settings['profile']['contract_status'] }}
                    </span>
                    <span class="text-xs text-slate-400">Code: <strong class="text-white font-mono">{{ $settings['profile']['id'] }}</strong></span>
                </div>
                <h2 class="text-lg sm:text-xl font-black mt-1">
                    {{ $settings['profile']['company_name'] }}
                </h2>
                <p class="text-xs text-slate-300 mt-0.5">
                    Trade Name: <strong class="text-white">{{ $settings['profile']['brand_name'] }}</strong> • Tax NPWP: <span class="font-mono text-slate-300">{{ $settings['profile']['npwp'] }}</span>
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2 self-start md:self-auto shrink-0 text-xs">
            <div class="p-3 rounded-xl bg-white/5 border border-white/10 text-right">
                <span class="text-[10px] text-slate-400 block uppercase font-bold tracking-wider">Contract Expiry</span>
                <strong class="text-white font-mono text-xs">{{ $settings['profile']['contract_expiry'] }}</strong>
            </div>
        </div>
    </div>

    <!-- ================= SETTINGS TABS NAVIGATION ================= -->
    <div class="flex border-b border-[var(--border)] overflow-x-auto scrollbar-none gap-2 text-xs sm:text-sm font-bold">
        
        <!-- Tab 1: Organization Profile -->
        <a href="{{ route('vendor.settings', ['tab' => 'profile']) }}" 
           class="py-3 px-4 border-b-2 whitespace-nowrap transition-all flex items-center gap-2 {{ $activeTab === 'profile' ? 'border-[var(--primary)] text-[var(--primary)] bg-slate-50/50' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span>Organization Profile</span>
        </a>

        <!-- Tab 2: Corporate Contact -->
        <a href="{{ route('vendor.settings', ['tab' => 'contact']) }}" 
           class="py-3 px-4 border-b-2 whitespace-nowrap transition-all flex items-center gap-2 {{ $activeTab === 'contact' ? 'border-[var(--primary)] text-[var(--primary)] bg-slate-50/50' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            <span>Contact Information</span>
        </a>

        <!-- Tab 3: Operational Preferences -->
        <a href="{{ route('vendor.settings', ['tab' => 'operational']) }}" 
           class="py-3 px-4 border-b-2 whitespace-nowrap transition-all flex items-center gap-2 {{ $activeTab === 'operational' ? 'border-[var(--primary)] text-[var(--primary)] bg-slate-50/50' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
            <span>Operational & Telemetry</span>
        </a>

        <!-- Tab 4: Notification Preferences -->
        <a href="{{ route('vendor.settings', ['tab' => 'notifications']) }}" 
           class="py-3 px-4 border-b-2 whitespace-nowrap transition-all flex items-center gap-2 {{ $activeTab === 'notifications' ? 'border-[var(--primary)] text-[var(--primary)] bg-slate-50/50' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            <span>Notification Delivery</span>
        </a>

        <!-- Tab 5: Account & Security -->
        <a href="{{ route('vendor.settings', ['tab' => 'security']) }}" 
           class="py-3 px-4 border-b-2 whitespace-nowrap transition-all flex items-center gap-2 {{ $activeTab === 'security' ? 'border-[var(--primary)] text-[var(--primary)] bg-slate-50/50' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            <span>Security & API</span>
        </a>

    </div>

    <!-- ================= TAB CONTENT PANELS ================= -->
    <div class="space-y-6">

        <!-- ================= TAB 1: ORGANIZATION PROFILE ================= -->
        @if($activeTab === 'profile')
        <div class="p-6 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-6">
            
            <div>
                <h3 class="text-base font-bold text-slate-900">Organization Profile</h3>
                <p class="text-xs text-slate-500 mt-0.5">
                    Official business registration details and vendor identity across the NusaPark platform.
                </p>
            </div>

            <form action="{{ route('vendor.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <input type="hidden" name="section" value="profile">

                <!-- Read-Only Verifications Grid -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Organization Code</span>
                        <strong class="font-mono text-slate-800 text-sm">{{ $settings['profile']['id'] }}</strong>
                        <span class="text-[10px] text-slate-500 block mt-0.5">System assigned identifier</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Business Reg. (NIB)</span>
                        <strong class="font-mono text-slate-800 text-sm">{{ $settings['profile']['nib'] }}</strong>
                        <span class="text-[10px] text-emerald-600 font-semibold block mt-0.5">&check; OSS Verified</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Tax Identifier (NPWP)</span>
                        <strong class="font-mono text-slate-800 text-sm">{{ $settings['profile']['npwp'] }}</strong>
                        <span class="text-[10px] text-emerald-600 font-semibold block mt-0.5">&check; DJP Verified</span>
                    </div>
                </div>

                <!-- Brand Avatar & Logo Upload -->
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        @if(!empty($settings['profile']['logo_url']))
                        <img src="{{ $settings['profile']['logo_url'] }}" 
                             alt="{{ $settings['profile']['brand_name'] }} Logo" 
                             class="w-16 h-16 rounded-xl object-contain bg-white border border-slate-200 p-1 shadow-xs">
                        @else
                        <div class="w-16 h-16 rounded-xl bg-[var(--primary)] text-white flex items-center justify-center text-xl font-black shadow-xs shrink-0">
                            {{ $settings['profile']['logo_initials'] ?? 'CPS' }}
                        </div>
                        @endif
                        <div>
                            <strong class="text-xs sm:text-sm font-bold text-slate-900 block">Organization Brand Mark / Logo</strong>
                            <span class="text-xs text-slate-500 block mt-0.5">Recommended format: Square SVG, PNG, or JPG (max 2 MB).</span>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Fallback monogram: <code class="font-mono font-bold text-slate-700">{{ $settings['profile']['logo_initials'] ?? 'CPS' }}</code></span>
                        </div>
                    </div>

                    <div class="shrink-0">
                        <label class="px-3.5 py-2 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-xs cursor-pointer inline-flex items-center gap-1.5">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                            <span>Upload New Logo</span>
                            <input type="file" name="logo" accept="image/png,image/jpeg,image/svg+xml" class="hidden" onchange="this.form.submit()">
                        </label>
                        @error('logo')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Editable Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- Company Legal Name -->
                    <div class="space-y-1.5">
                        <label for="company_name" class="block text-xs font-bold text-slate-700">
                            Legal Company Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="company_name" 
                               name="company_name" 
                               value="{{ old('company_name', $settings['profile']['company_name']) }}" 
                               required
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        @error('company_name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Trade / Brand Name -->
                    <div class="space-y-1.5">
                        <label for="brand_name" class="block text-xs font-bold text-slate-700">
                            Brand / Trade Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="brand_name" 
                               name="brand_name" 
                               value="{{ old('brand_name', $settings['profile']['brand_name']) }}" 
                               required
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        @error('brand_name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category (Read-Only) -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700">Business Category</label>
                        <input type="text" 
                               value="{{ $settings['profile']['category'] }}" 
                               disabled 
                               class="w-full px-3.5 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-600 cursor-not-allowed">
                        <span class="text-[10px] text-slate-400">Classified by NusaPark Enterprise Onboarding</span>
                    </div>

                    <!-- Partner Contract Number (Read-Only) -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700">Master Agreement Reference</label>
                        <input type="text" 
                               value="{{ $settings['profile']['contract_number'] }}" 
                               disabled 
                               class="w-full px-3.5 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-xs sm:text-sm font-mono text-slate-600 cursor-not-allowed">
                        <span class="text-[10px] text-slate-400">Active until {{ $settings['profile']['contract_expiry'] }}</span>
                    </div>

                    <!-- Organization Description -->
                    <div class="md:col-span-2 space-y-1.5">
                        <label for="description" class="block text-xs font-bold text-slate-700">
                            Organization Description & Operational Scope
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3" 
                                  class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">{{ old('description', $settings['profile']['description']) }}</textarea>
                        @error('description')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Action Footer -->
                <div class="pt-4 border-t border-[var(--border)] flex items-center justify-end gap-3">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[var(--primary)] text-white hover:opacity-90 font-bold text-xs sm:text-sm transition-all shadow-xs cursor-pointer flex items-center gap-2">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Save Profile Changes</span>
                    </button>
                </div>

            </form>

        </div>
        @endif

        <!-- ================= TAB 2: CORPORATE CONTACT ================= -->
        @if($activeTab === 'contact')
        <div class="p-6 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-6">
            
            <div>
                <h3 class="text-base font-bold text-slate-900">Corporate Contact Information</h3>
                <p class="text-xs text-slate-500 mt-0.5">
                    Official address, support hotline, billing contact, and emergency notification channels.
                </p>
            </div>

            <form action="{{ route('vendor.settings.update') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="section" value="contact">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- Official Address -->
                    <div class="md:col-span-2 space-y-1.5">
                        <label for="address" class="block text-xs font-bold text-slate-700">
                            Registered Office Address <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="address" 
                               name="address" 
                               value="{{ old('address', $settings['contact']['address']) }}" 
                               required
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        @error('address')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City & Province -->
                    <div class="space-y-1.5">
                        <label for="city" class="block text-xs font-bold text-slate-700">
                            City / District <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="city" 
                               name="city" 
                               value="{{ old('city', $settings['contact']['city']) }}" 
                               required
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        @error('city')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Postal Code -->
                    <div class="space-y-1.5">
                        <label for="postal_code" class="block text-xs font-bold text-slate-700">
                            Postal Code <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="postal_code" 
                               name="postal_code" 
                               value="{{ old('postal_code', $settings['contact']['postal_code']) }}" 
                               required
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-mono focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        @error('postal_code')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Corporate Email -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-slate-700">
                            Official Corporate Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $settings['contact']['email']) }}" 
                               required
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Invoicing / Billing Email -->
                    <div class="space-y-1.5">
                        <label for="billing_email" class="block text-xs font-bold text-slate-700">
                            Billing & Tax Invoicing Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="billing_email" 
                               name="billing_email" 
                               value="{{ old('billing_email', $settings['contact']['billing_email']) }}" 
                               required
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        <span class="text-[10px] text-slate-400">Monthly tax invoices and payment receipts are delivered here</span>
                        @error('billing_email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Operations Phone -->
                    <div class="space-y-1.5">
                        <label for="phone" class="block text-xs font-bold text-slate-700">
                            Operations Support Phone <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $settings['contact']['phone']) }}" 
                               required
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-mono focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        @error('phone')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Emergency Hotline -->
                    <div class="space-y-1.5">
                        <label for="emergency_hotline" class="block text-xs font-bold text-slate-700">
                            Emergency Incident Escalation Hotline <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="emergency_hotline" 
                               name="emergency_hotline" 
                               value="{{ old('emergency_hotline', $settings['contact']['emergency_hotline']) }}" 
                               required
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-mono focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        <span class="text-[10px] text-slate-400">24/7 on-call dispatcher for critical gate and security events</span>
                        @error('emergency_hotline')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Website URL -->
                    <div class="md:col-span-2 space-y-1.5">
                        <label for="website" class="block text-xs font-bold text-slate-700">
                            Corporate Website URL
                        </label>
                        <input type="text" 
                               id="website" 
                               name="website" 
                               value="{{ old('website', $settings['contact']['website']) }}" 
                               placeholder="https://parkircipta.co.id"
                               class="w-full px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-mono focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                        @error('website')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Action Footer -->
                <div class="pt-4 border-t border-[var(--border)] flex items-center justify-end gap-3">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[var(--primary)] text-white hover:opacity-90 font-bold text-xs sm:text-sm transition-all shadow-xs cursor-pointer flex items-center gap-2">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Save Contact Information</span>
                    </button>
                </div>

            </form>

        </div>
        @endif

        <!-- ================= TAB 3: OPERATIONAL PREFERENCES ================= -->
        @if($activeTab === 'operational')
        <div class="p-6 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-6">
            
            <div>
                <h3 class="text-base font-bold text-slate-900">Operational Preferences & Telemetry Defaults</h3>
                <p class="text-xs text-slate-500 mt-0.5">
                    Configure automated barrier gate behavior, ANPR recognition confidence thresholds, capacity warnings, and localization.
                </p>
            </div>

            <form action="{{ route('vendor.settings.update') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="section" value="operational">

                <!-- 1. Telemetry & Hardware Thresholds -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Hardware & Edge Gate Automation</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Default Facility -->
                        <div class="space-y-1.5">
                            <label for="default_facility_id" class="block text-xs font-bold text-slate-700">
                                Default Operating Facility <span class="text-red-500">*</span>
                            </label>
                            <select id="default_facility_id" 
                                    name="default_facility_id" 
                                    class="w-full py-2.5 px-3.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                                @foreach($facilities as $fac)
                                <option value="{{ $fac['id'] }}" {{ old('default_facility_id', $settings['operational']['default_facility_id']) === $fac['id'] ? 'selected' : '' }}>
                                    {{ $fac['name'] }} ({{ $fac['city'] }})
                                </option>
                                @endforeach
                            </select>
                            <span class="text-[10px] text-slate-400">Default preselected location for gate monitoring and session logs</span>
                        </div>

                        <!-- ANPR Confidence Threshold -->
                        <div class="space-y-1.5">
                            <label for="anpr_confidence_threshold" class="block text-xs font-bold text-slate-700">
                                ANPR Verification Confidence Threshold (%) <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="number" 
                                       id="anpr_confidence_threshold" 
                                       name="anpr_confidence_threshold" 
                                       min="50" 
                                       max="99" 
                                       value="{{ old('anpr_confidence_threshold', $settings['operational']['anpr_confidence_threshold']) }}" 
                                       required
                                       class="w-28 px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-mono font-bold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                                <span class="text-xs text-slate-500">Captures below this score require operator review (Default: 80%)</span>
                            </div>
                            @error('anpr_confidence_threshold')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Barrier Auto-Close Delay -->
                        <div class="space-y-1.5">
                            <label for="barrier_auto_close_delay" class="block text-xs font-bold text-slate-700">
                                Barrier Gate Auto-Close Delay (Seconds) <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="number" 
                                       id="barrier_auto_close_delay" 
                                       name="barrier_auto_close_delay" 
                                       min="3" 
                                       max="30" 
                                       value="{{ old('barrier_auto_close_delay', $settings['operational']['barrier_auto_close_delay']) }}" 
                                       required
                                       class="w-28 px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-mono font-bold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                                <span class="text-xs text-slate-500">Arm lowered after vehicle leaves vehicle detector loop</span>
                            </div>
                            @error('barrier_auto_close_delay')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Overstay Alert Hours -->
                        <div class="space-y-1.5">
                            <label for="overstay_alert_hours" class="block text-xs font-bold text-slate-700">
                                Overstay Exception Alert Threshold (Hours) <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="number" 
                                       id="overstay_alert_hours" 
                                       name="overstay_alert_hours" 
                                       min="6" 
                                       max="168" 
                                       value="{{ old('overstay_alert_hours', $settings['operational']['overstay_alert_hours']) }}" 
                                       required
                                       class="w-28 px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-mono font-bold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                                <span class="text-xs text-slate-500">Continuous parking duration triggering critical exception alerts</span>
                            </div>
                            @error('overstay_alert_hours')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Capacity Warning Threshold -->
                        <div class="space-y-1.5 md:col-span-2">
                            <label for="capacity_warning_threshold" class="block text-xs font-bold text-slate-700">
                                Peak Occupancy Alert Threshold (%) <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="number" 
                                       id="capacity_warning_threshold" 
                                       name="capacity_warning_threshold" 
                                       min="50" 
                                       max="98" 
                                       value="{{ old('capacity_warning_threshold', $settings['operational']['capacity_warning_threshold']) }}" 
                                       required
                                       class="w-28 px-3.5 py-2.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-mono font-bold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                                <span class="text-xs text-slate-500">Activates dynamic parking sign diversions when zone exceeds this level (Default: 90%)</span>
                            </div>
                            @error('capacity_warning_threshold')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- 2. Operational Safety Toggles -->
                <div class="pt-4 border-t border-[var(--border)]">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Safety & Override Policies</h4>
                    
                    <div class="space-y-3">
                        <label class="flex items-start gap-3 p-3.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100/80 cursor-pointer transition-colors">
                            <input type="checkbox" 
                                   name="allow_manual_gate_override" 
                                   value="1" 
                                   {{ !empty($settings['operational']['allow_manual_gate_override']) ? 'checked' : '' }} 
                                   class="w-4 h-4 rounded border-slate-300 text-[var(--primary)] focus:ring-[var(--accent)] mt-0.5">
                            <div>
                                <strong class="text-xs sm:text-sm font-bold text-slate-800 block">Allow Field Supervisor Manual Gate Key Override</strong>
                                <span class="text-xs text-slate-500 block">Enables logging emergency physical override key events to Page 25 and Page 35 without sounding platform alarm.</span>
                            </div>
                        </label>

                        <label class="flex items-start gap-3 p-3.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100/80 cursor-pointer transition-colors">
                            <input type="checkbox" 
                                   name="require_anpr_two_stage" 
                                   value="1" 
                                   {{ !empty($settings['operational']['require_anpr_two_stage']) ? 'checked' : '' }} 
                                   class="w-4 h-4 rounded border-slate-300 text-[var(--primary)] focus:ring-[var(--accent)] mt-0.5">
                            <div>
                                <strong class="text-xs sm:text-sm font-bold text-slate-800 block">Enforce Dual-Angle ANPR Verification (Front & Rear Cameras)</strong>
                                <span class="text-xs text-slate-500 block">Requires both entrance cameras to agree on plate string before automatically triggering boom open.</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- 3. Regional & Localization -->
                <div class="pt-4 border-t border-[var(--border)]">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Regional Localization & Formats</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        
                        <!-- Timezone -->
                        <div class="space-y-1.5">
                            <label for="timezone" class="block text-xs font-bold text-slate-700">Operational Timezone</label>
                            <select id="timezone" 
                                    name="timezone" 
                                    class="w-full py-2.5 px-3.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                                <option value="Asia/Jakarta" {{ old('timezone', $settings['localization']['timezone']) === 'Asia/Jakarta' ? 'selected' : '' }}>Asia/Jakarta (WIB, UTC+7)</option>
                                <option value="Asia/Makassar" {{ old('timezone', $settings['localization']['timezone']) === 'Asia/Makassar' ? 'selected' : '' }}>Asia/Makassar (WITA, UTC+8)</option>
                                <option value="Asia/Jayapura" {{ old('timezone', $settings['localization']['timezone']) === 'Asia/Jayapura' ? 'selected' : '' }}>Asia/Jayapura (WIT, UTC+9)</option>
                            </select>
                            <span class="text-[10px] text-slate-400">Timestamps on gates and transactions reflect this zone</span>
                        </div>

                        <!-- Language -->
                        <div class="space-y-1.5">
                            <label for="locale" class="block text-xs font-bold text-slate-700">Platform Language</label>
                            <select id="locale" 
                                    name="locale" 
                                    class="w-full py-2.5 px-3.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                                <option value="id_ID" {{ old('locale', $settings['localization']['locale']) === 'id_ID' ? 'selected' : '' }}>Bahasa Indonesia (ID)</option>
                                <option value="en_US" {{ old('locale', $settings['localization']['locale']) === 'en_US' ? 'selected' : '' }}>English (US/UK)</option>
                            </select>
                        </div>

                        <!-- Date Format -->
                        <div class="space-y-1.5">
                            <label for="date_format" class="block text-xs font-bold text-slate-700">Date Display Format</label>
                            <select id="date_format" 
                                    name="date_format" 
                                    class="w-full py-2.5 px-3.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-mono font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                                <option value="DD/MM/YYYY" {{ old('date_format', $settings['localization']['date_format']) === 'DD/MM/YYYY' ? 'selected' : '' }}>DD/MM/YYYY (Standard ID)</option>
                                <option value="YYYY-MM-DD" {{ old('date_format', $settings['localization']['date_format']) === 'YYYY-MM-DD' ? 'selected' : '' }}>YYYY-MM-DD (ISO 8601)</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Action Footer -->
                <div class="pt-4 border-t border-[var(--border)] flex items-center justify-end gap-3">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[var(--primary)] text-white hover:opacity-90 font-bold text-xs sm:text-sm transition-all shadow-xs cursor-pointer flex items-center gap-2">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Save Operational Preferences</span>
                    </button>
                </div>

            </form>

        </div>
        @endif

        <!-- ================= TAB 4: NOTIFICATION PREFERENCES ================= -->
        @if($activeTab === 'notifications')
        <div class="p-6 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-6">
            
            <div>
                <h3 class="text-base font-bold text-slate-900">Notification Delivery Preferences</h3>
                <p class="text-xs text-slate-500 mt-0.5">
                    Configure dispatch channels for hardware alerts, daily executive summaries, billing notices, and platform updates.
                </p>
            </div>

            <form action="{{ route('vendor.settings.update') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="section" value="notifications">

                <div class="space-y-3">
                    
                    <!-- 1. Critical Operational Alerts -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-extrabold uppercase bg-rose-50 text-rose-700 border border-rose-200">Critical</span>
                                <strong class="text-xs sm:text-sm font-bold text-slate-800">Hardware & Barrier Incident Alerts</strong>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">
                                Barrier obstruction interlocks, ANPR camera disconnects, and overstay violations (>24h).
                            </p>
                        </div>
                        <div class="flex items-center gap-4 shrink-0 text-xs">
                            <label class="flex items-center gap-1.5 font-medium cursor-pointer">
                                <input type="checkbox" name="email_critical_alerts" value="1" {{ !empty($settings['notifications']['email_critical_alerts']) ? 'checked' : '' }} class="w-4 h-4 rounded text-[var(--primary)] focus:ring-[var(--accent)]">
                                <span>Email</span>
                            </label>
                            <label class="flex items-center gap-1.5 font-medium cursor-pointer">
                                <input type="checkbox" name="sms_emergency_dispatch" value="1" {{ !empty($settings['notifications']['sms_emergency_dispatch']) ? 'checked' : '' }} class="w-4 h-4 rounded text-[var(--primary)] focus:ring-[var(--accent)]">
                                <span>SMS / WhatsApp</span>
                            </label>
                            <span class="px-2 py-1 rounded bg-slate-200 text-slate-600 text-[10px] font-bold">In-App (Locked)</span>
                        </div>
                    </div>

                    <!-- 2. Daily Operations Digest -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                        <div>
                            <strong class="text-xs sm:text-sm font-bold text-slate-800 block">Daily Operations & Financial Summary Digest</strong>
                            <p class="text-xs text-slate-500 mt-1">
                                Automated nightly overview of total sessions recorded, occupancy peaks, and settled parking revenue.
                            </p>
                        </div>
                        <div class="flex items-center gap-4 shrink-0 text-xs">
                            <label class="flex items-center gap-1.5 font-medium cursor-pointer">
                                <input type="checkbox" name="email_daily_digest" value="1" {{ !empty($settings['notifications']['email_daily_digest']) ? 'checked' : '' }} class="w-4 h-4 rounded text-[var(--primary)] focus:ring-[var(--accent)]">
                                <span>Email Digest</span>
                            </label>
                        </div>
                    </div>

                    <!-- 3. Billing & Tax Invoices -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                        <div>
                            <strong class="text-xs sm:text-sm font-bold text-slate-800 block">Subscription Invoices & Payment Reminders</strong>
                            <p class="text-xs text-slate-500 mt-1">
                                Delivery of monthly SaaS subscription tax invoice documents (PPN 11%) and payment settlement notifications.
                            </p>
                        </div>
                        <div class="flex items-center gap-4 shrink-0 text-xs">
                            <label class="flex items-center gap-1.5 font-medium cursor-pointer">
                                <input type="checkbox" name="email_billing_invoices" value="1" {{ !empty($settings['notifications']['email_billing_invoices']) ? 'checked' : '' }} class="w-4 h-4 rounded text-[var(--primary)] focus:ring-[var(--accent)]">
                                <span>Email Invoices</span>
                            </label>
                            <span class="px-2 py-1 rounded bg-slate-200 text-slate-600 text-[10px] font-bold">In-App (Locked)</span>
                        </div>
                    </div>

                    <!-- 4. Mobile Driver & Push Dispatches -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 flex items-start justify-between gap-4">
                        <div>
                            <strong class="text-xs sm:text-sm font-bold text-slate-800 block">Mobile Operator Push Notifications</strong>
                            <p class="text-xs text-slate-500 mt-1">
                                Real-time push alerts to mobile devices of on-duty supervisors and security guards.
                            </p>
                        </div>
                        <div class="flex items-center gap-4 shrink-0 text-xs">
                            <label class="flex items-center gap-1.5 font-medium cursor-pointer">
                                <input type="checkbox" name="push_mobile_alerts" value="1" {{ !empty($settings['notifications']['push_mobile_alerts']) ? 'checked' : '' }} class="w-4 h-4 rounded text-[var(--primary)] focus:ring-[var(--accent)]">
                                <span>Mobile Push</span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Action Footer -->
                <div class="pt-4 border-t border-[var(--border)] flex items-center justify-end gap-3">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[var(--primary)] text-white hover:opacity-90 font-bold text-xs sm:text-sm transition-all shadow-xs cursor-pointer flex items-center gap-2">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Save Notification Preferences</span>
                    </button>
                </div>

            </form>

        </div>
        @endif

        <!-- ================= TAB 5: ACCOUNT & SECURITY ================= -->
        @if($activeTab === 'security')
        <div class="p-6 rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-xs space-y-6">
            
            <div>
                <h3 class="text-base font-bold text-slate-900">Account Access & Edge Security Configuration</h3>
                <p class="text-xs text-slate-500 mt-0.5">
                    Authorized operator session limits, multi-factor authentication, and IoT Edge Gateway API connectivity.
                </p>
            </div>

            <form action="{{ route('vendor.settings.update') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="section" value="security">

                <!-- 1. Operator Account Identity -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Logged In Operator</span>
                        <strong class="text-slate-900 text-sm block">{{ $settings['security']['operator_name'] }}</strong>
                        <span class="text-[10px] text-slate-500">{{ $settings['security']['operator_role'] }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Operator Login Email</span>
                        <strong class="text-slate-900 text-sm block">{{ $settings['security']['operator_email'] }}</strong>
                        <span class="text-[10px] text-emerald-600 font-semibold">&check; 2FA Authenticated</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Last Security Audit</span>
                        <strong class="text-slate-900 text-sm block font-mono">{{ $settings['security']['last_security_audit'] }}</strong>
                        <span class="text-[10px] text-slate-500">ISO/IEC 27001 Compliant</span>
                    </div>
                </div>

                <!-- 2. Security Configuration -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- Session Inactivity Timeout -->
                    <div class="space-y-1.5">
                        <label for="session_timeout_hours" class="block text-xs font-bold text-slate-700">
                            Session Inactivity Timeout (Hours) <span class="text-red-500">*</span>
                        </label>
                        <select id="session_timeout_hours" 
                                name="session_timeout_hours" 
                                class="w-full py-2.5 px-3.5 bg-white border border-[var(--border)] rounded-xl text-xs sm:text-sm text-[var(--text)] font-semibold focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition-all">
                            <option value="4" {{ (int)old('session_timeout_hours', $settings['security']['session_timeout_hours']) === 4 ? 'selected' : '' }}>4 Hours (High Security)</option>
                            <option value="8" {{ (int)old('session_timeout_hours', $settings['security']['session_timeout_hours']) === 8 ? 'selected' : '' }}>8 Hours (Standard Shift)</option>
                            <option value="12" {{ (int)old('session_timeout_hours', $settings['security']['session_timeout_hours']) === 12 ? 'selected' : '' }}>12 Hours (Extended Shift)</option>
                            <option value="24" {{ (int)old('session_timeout_hours', $settings['security']['session_timeout_hours']) === 24 ? 'selected' : '' }}>24 Hours (Dedicated NOC Console)</option>
                        </select>
                        <span class="text-[10px] text-slate-400">Operators are automatically logged out after this duration of inactivity</span>
                    </div>

                    <!-- Two-Factor Authentication -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700">Two-Factor Authentication (2FA)</label>
                        <div class="p-3 rounded-xl border border-emerald-200 bg-emerald-50/60 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span class="text-xs font-bold text-emerald-900">Enforced for Enterprise Tier</span>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-700 uppercase bg-emerald-100 px-2 py-0.5 rounded">Active</span>
                        </div>
                        <input type="hidden" name="two_factor_enabled" value="1">
                        <span class="text-[10px] text-slate-400">Requires authenticator app token on every new device login</span>
                    </div>

                </div>

                <!-- 3. Hardware Edge API Gateway Credentials -->
                <div class="pt-4 border-t border-[var(--border)]">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Hardware Telemetry & Edge Controllers API Key</h4>
                    <p class="text-xs text-slate-500 mb-4">
                        Used by on-site Raspberry Pi / Industrial Edge Gateways to transmit ANPR events and loop telemetry to the cloud.
                    </p>

                    <div class="p-4 rounded-xl bg-slate-900 text-white space-y-3">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase font-mono tracking-wider block">Production Gateway Secret</span>
                                <code class="text-sm font-mono font-bold text-blue-300">{{ $settings['security']['api_key_masked'] }}</code>
                            </div>
                            <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 text-[10px] font-bold border border-emerald-400/30 self-start sm:self-auto">
                                {{ $settings['security']['api_status'] }}
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-400">
                            Key rotation requires on-site gateway firmware update. Contact NusaPark Enterprise NOC support for credential regenerations.
                        </p>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="pt-4 border-t border-[var(--border)] flex items-center justify-end gap-3">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[var(--primary)] text-white hover:opacity-90 font-bold text-xs sm:text-sm transition-all shadow-xs cursor-pointer flex items-center gap-2">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Save Security Policies</span>
                    </button>
                </div>

            </form>

        </div>
        @endif

    </div>

</x-layouts.vendor>
