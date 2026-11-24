<x-layouts.app activeNav="profile">
    <div class="w-full space-y-6 md:space-y-8">

        <!-- ================= PAGE HEADER & TITLE ================= -->
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pt-1 sm:pt-2">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-[var(--accent)] border border-blue-200/60">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        {{ $profile['role'] ?? 'Driver Account' }}
                    </span>
                    <span class="text-xs text-[var(--text-muted)]">Personal Settings</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-[var(--text)] mt-1.5">My Profile</h1>
                <p class="text-[var(--text-muted)] text-sm md:text-base mt-1">
                    Manage your personal details, credentials, vehicle access, and notification preferences.
                </p>
            </div>

            <!-- Quick Navigation Anchor Links -->
            <div class="flex items-center gap-2 self-start sm:self-auto shrink-0">
                <a href="/vehicles" 
                   class="inline-flex items-center gap-1.5 bg-[var(--surface)] hover:bg-[var(--background)] text-[var(--text)] border border-[var(--border)] px-3.5 py-2 rounded-xl text-xs font-semibold transition-all shadow-xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                        <circle cx="7" cy="15" r="2"></circle>
                        <circle cx="17" cy="15" r="2"></circle>
                    </svg>
                    <span>My Vehicles ({{ $vehicleCount }})</span>
                </a>
                <a href="/history" 
                   class="inline-flex items-center gap-1.5 bg-[var(--surface)] hover:bg-[var(--background)] text-[var(--text)] border border-[var(--border)] px-3.5 py-2 rounded-xl text-xs font-semibold transition-all shadow-xs">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    <span>History</span>
                </a>
            </div>
        </header>

        <!-- ================= NOTIFICATION ALERTS ================= -->
        @if(session('profile_success') || $profileSuccess)
            <div id="alert-profile-success" class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200/80 rounded-xl text-emerald-800 text-sm shadow-sm transition-all animate-fadeIn">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <span>{{ session('profile_success') ?? $profileSuccess }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-profile-success').remove()" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100/50 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('password_success') || $passwordSuccess)
            <div id="alert-pwd-success" class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200/80 rounded-xl text-emerald-800 text-sm shadow-sm transition-all animate-fadeIn">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <span>{{ session('password_success') ?? $passwordSuccess }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-pwd-success').remove()" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100/50 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('preferences_success') || $preferencesSuccess)
            <div id="alert-pref-success" class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200/80 rounded-xl text-emerald-800 text-sm shadow-sm transition-all animate-fadeIn">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <span>{{ session('preferences_success') ?? $preferencesSuccess }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-pref-success').remove()" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100/50 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('profile_error') || $profileError)
            <div id="alert-profile-error" class="flex items-center justify-between p-4 bg-red-50 border border-red-200/80 rounded-xl text-red-800 text-sm shadow-sm transition-all animate-fadeIn">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <span>{{ session('profile_error') ?? $profileError }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-profile-error').remove()" class="text-red-600 hover:text-red-800 p-1 rounded-lg hover:bg-red-100/50 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        <!-- ================= PROFILE OVERVIEW CARD ================= -->
        <div class="dashboard-card p-6 md:p-8 bg-gradient-to-r from-white via-slate-50/50 to-blue-50/30 border border-[var(--border)] relative overflow-hidden">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                
                <!-- Avatar & Identity -->
                <div class="flex items-center gap-4 md:gap-5">
                    <div class="w-20 h-20 md:w-22 md:h-22 rounded-2xl bg-gradient-to-tr from-[var(--primary)] to-[var(--primary-light)] text-white flex items-center justify-center font-bold text-2xl md:text-3xl shadow-lg shadow-slate-900/15 shrink-0 ring-4 ring-white border border-slate-200">
                        {{ $profile['avatar_initials'] ?? 'A' }}
                    </div>

                    <div class="space-y-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="text-xl md:text-2xl font-bold tracking-tight text-[var(--text)]">
                                {{ $profile['name'] }}
                            </h2>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                {{ $profile['role'] ?? 'Verified Driver' }}
                            </span>
                            @if(!empty($profile['has_google_linked']))
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/></svg>
                                    Google Connected
                                </span>
                            @endif
                        </div>

                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs md:text-sm text-[var(--text-muted)]">
                            <span class="flex items-center gap-1">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                {{ $profile['email'] }}
                            </span>
                            <span class="text-slate-300">•</span>
                            <span class="flex items-center gap-1">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                {{ !empty($profile['phone']) ? $profile['phone'] : 'No phone number' }}
                            </span>
                        </div>

                        <div class="pt-1 flex flex-wrap items-center gap-2 text-[11px] text-slate-500">
                            <span class="font-mono bg-white px-2 py-0.5 rounded border border-slate-200">
                                ID: {{ $profile['driver_id'] }}
                            </span>
                            <span>•</span>
                            <span>Member since {{ $profile['member_since'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Quick Stats -->
                <div class="grid grid-cols-2 gap-3 w-full sm:w-auto shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-[var(--border)]">
                    <div class="p-3 bg-white rounded-xl border border-[var(--border)] shadow-xs text-center min-w-[110px]">
                        <span class="text-[11px] font-bold text-[var(--text-muted)] uppercase tracking-wider block">Vehicles</span>
                        <span class="text-xl font-bold text-[var(--text)] mt-0.5 block">{{ $vehicleCount }}</span>
                    </div>

                    <div class="p-3 bg-white rounded-xl border border-[var(--border)] shadow-xs text-center min-w-[110px]">
                        <span class="text-[11px] font-bold text-[var(--text-muted)] uppercase tracking-wider block">Default Gate</span>
                        <span class="text-xs font-mono font-bold text-[var(--accent)] mt-1.5 block truncate">
                            {{ $defaultVehicle ? $defaultVehicle['plate'] : 'None' }}
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= MAIN TWO-COLUMN SETTINGS GRID ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 items-start">
            
            <!-- LEFT COLUMN (2 COLS on LG): Personal Info & Security -->
            <div class="lg:col-span-2 space-y-6 md:space-y-8">
                
                <!-- 1. PERSONAL INFORMATION FORM -->
                <section id="personal-info" class="dashboard-card p-6 md:p-7">
                    <div class="pb-4 border-b border-[var(--border)] mb-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-[var(--text)]">Personal Information</h3>
                            <span class="text-xs font-medium text-[var(--text-muted)]">Verified Account</span>
                        </div>
                        <p class="text-xs text-[var(--text-muted)] mt-0.5">
                            Update your name, contact email, and phone number for smart gate entry & notifications.
                        </p>
                    </div>

                    <form method="POST" action="/profile" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Full Name -->
                        <div>
                            <label for="input-name" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1.5">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="input-name" 
                                   name="name" 
                                   value="{{ old('name', $profile['name']) }}" 
                                   required 
                                   class="w-full px-4 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm font-semibold text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                            @error('name')
                                <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email & Phone Row -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Email -->
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label for="input-email" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)]">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    @if($profile['email_verified'])
                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            Verified
                                        </span>
                                    @endif
                                </div>
                                <input type="email" 
                                       id="input-email" 
                                       name="email" 
                                       value="{{ old('email', $profile['email']) }}" 
                                       required 
                                       class="w-full px-4 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm font-semibold text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                                <p class="text-[11px] text-[var(--text-muted)] mt-1">Receipts & billing confirmations will be delivered here.</p>
                                @error('email')
                                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label for="input-phone" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)]">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    @if(!empty($profile['phone']) && !empty($profile['phone_verified']))
                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            Verified
                                        </span>
                                    @endif
                                </div>
                                <input type="text" 
                                       id="input-phone" 
                                       name="phone" 
                                       value="{{ old('phone', $profile['phone']) }}" 
                                       required 
                                       placeholder="+62 812-3456-7890" 
                                       class="w-full px-4 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm font-semibold text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                                <p class="text-[11px] text-[var(--text-muted)] mt-1">Used for gate emergency contact & SMS verification.</p>
                                @error('phone')
                                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- National ID / Driver License -->
                        <div>
                            <label for="input-id-card" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1.5">
                                National ID / Driving License (NIK / SIM)
                            </label>
                            <input type="text" 
                                   id="input-id-card" 
                                   name="id_card" 
                                   value="{{ old('id_card', $profile['id_card'] ?? '') }}" 
                                   placeholder="e.g. 3171052408920003" 
                                   class="w-full px-4 py-2.5 bg-slate-50 border border-[var(--border)] rounded-xl text-sm font-mono text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                            <p class="text-[11px] text-[var(--text-muted)] mt-1">Optional. Required for multi-day barrier access & insurance claims.</p>
                            @error('id_card')
                                <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-4 flex items-center justify-end gap-3 border-t border-[var(--border)]">
                            <button type="reset" 
                                    class="px-4 py-2.5 rounded-xl text-xs md:text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                                Reset
                            </button>
                            <button type="submit" 
                                    class="px-5 py-2.5 rounded-xl text-xs md:text-sm font-semibold bg-[var(--accent)] hover:bg-[var(--accent-hover)] text-white shadow-md shadow-blue-500/20 transition-all cursor-pointer">
                                Save Profile Changes
                            </button>
                        </div>
                    </form>
                </section>

                <!-- 2. ACCOUNT SECURITY / CHANGE PASSWORD -->
                <section id="security" class="dashboard-card p-6 md:p-7">
                    <div class="pb-4 border-b border-[var(--border)] mb-5">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-[var(--text)]">Password & Security</h3>
                        </div>
                        <p class="text-xs text-[var(--text-muted)] mt-1">
                            Ensure your account uses a secure password to protect saved payment methods and ticketless barrier access.
                        </p>
                    </div>

                    <form method="POST" action="/profile/password" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1.5">
                                Current Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       id="current_password" 
                                       name="current_password" 
                                       required 
                                       placeholder="Enter your current password" 
                                       class="w-full px-4 py-2.5 pr-10 bg-slate-50 border border-[var(--border)] rounded-xl text-sm text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                                <button type="button" 
                                        onclick="togglePwVisibility('current_password', this)" 
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1"
                                        aria-label="Toggle password visibility">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password & Confirmation Row -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- New Password -->
                            <div>
                                <label for="new_password" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1.5">
                                    New Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           id="new_password" 
                                           name="new_password" 
                                           required 
                                           placeholder="Minimum 8 characters" 
                                           class="w-full px-4 py-2.5 pr-10 bg-slate-50 border border-[var(--border)] rounded-xl text-sm text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                                    <button type="button" 
                                            onclick="togglePwVisibility('new_password', this)" 
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1"
                                            aria-label="Toggle password visibility">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                </div>
                                @error('new_password')
                                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="new_password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-1.5">
                                    Confirm New Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           id="new_password_confirmation" 
                                           name="new_password_confirmation" 
                                           required 
                                           placeholder="Re-enter new password" 
                                           class="w-full px-4 py-2.5 pr-10 bg-slate-50 border border-[var(--border)] rounded-xl text-sm text-[var(--text)] focus:bg-white focus:border-[var(--accent)] focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                                    <button type="button" 
                                            onclick="togglePwVisibility('new_password_confirmation', this)" 
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1"
                                            aria-label="Toggle password visibility">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                </div>
                                @error('new_password_confirmation')
                                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 flex items-center justify-end border-t border-[var(--border)]">
                            <button type="submit" 
                                    class="px-5 py-2.5 rounded-xl text-xs md:text-sm font-semibold bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white shadow-md shadow-slate-900/10 transition-all cursor-pointer">
                                Update Password
                            </button>
                        </div>
                    </form>
                </section>

                <!-- 3. NOTIFICATION & COMMUNICATION PREFERENCES -->
                <section id="preferences" class="dashboard-card p-6 md:p-7">
                    <div class="pb-4 border-b border-[var(--border)] mb-5">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-blue-50 text-[var(--accent)] flex items-center justify-center">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-[var(--text)]">Notification Preferences</h3>
                        </div>
                        <p class="text-xs text-[var(--text-muted)] mt-1">
                            Choose how and when NusaPark alerts you about parking activity and bookings.
                        </p>
                    </div>

                    <form method="POST" action="/profile/preferences" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="space-y-3">
                            <!-- Parking Session Updates -->
                            <label class="flex items-start justify-between p-3.5 rounded-xl border border-[var(--border)] hover:bg-slate-50/60 transition-colors cursor-pointer">
                                <div class="pr-4">
                                    <span class="text-xs font-bold text-[var(--text)] block">Parking Session & Smart Gate Alerts</span>
                                    <span class="text-[11px] text-[var(--text-muted)] block mt-0.5">
                                        Immediate notification when your vehicle enters or exits an ANPR-enabled barrier gate.
                                    </span>
                                </div>
                                <input type="checkbox" 
                                       name="notify_session" 
                                       value="1" 
                                       {{ !empty($profile['preferences']['notify_session']) ? 'checked' : '' }}
                                       class="mt-1 w-4 h-4 rounded text-[var(--accent)] border-[var(--border)] focus:ring-[var(--accent)]">
                            </label>

                            <!-- Reservation Reminders -->
                            <label class="flex items-start justify-between p-3.5 rounded-xl border border-[var(--border)] hover:bg-slate-50/60 transition-colors cursor-pointer">
                                <div class="pr-4">
                                    <span class="text-xs font-bold text-[var(--text)] block">Reservation Reminders</span>
                                    <span class="text-[11px] text-[var(--text-muted)] block mt-0.5">
                                        Receive alerts 15 minutes before your scheduled parking slot begins.
                                    </span>
                                </div>
                                <input type="checkbox" 
                                       name="notify_reservation" 
                                       value="1" 
                                       {{ !empty($profile['preferences']['notify_reservation']) ? 'checked' : '' }}
                                       class="mt-1 w-4 h-4 rounded text-[var(--accent)] border-[var(--border)] focus:ring-[var(--accent)]">
                            </label>

                            <!-- Payment & Receipts -->
                            <label class="flex items-start justify-between p-3.5 rounded-xl border border-[var(--border)] hover:bg-slate-50/60 transition-colors cursor-pointer">
                                <div class="pr-4">
                                    <span class="text-xs font-bold text-[var(--text)] block">Payment Confirmations & E-Receipts</span>
                                    <span class="text-[11px] text-[var(--text-muted)] block mt-0.5">
                                        Instant receipts and payment settlement statements sent to your inbox.
                                    </span>
                                </div>
                                <input type="checkbox" 
                                       name="notify_payment" 
                                       value="1" 
                                       {{ !empty($profile['preferences']['notify_payment']) ? 'checked' : '' }}
                                       class="mt-1 w-4 h-4 rounded text-[var(--accent)] border-[var(--border)] focus:ring-[var(--accent)]">
                            </label>

                            <!-- Promotional Discounts -->
                            <label class="flex items-start justify-between p-3.5 rounded-xl border border-[var(--border)] hover:bg-slate-50/60 transition-colors cursor-pointer">
                                <div class="pr-4">
                                    <span class="text-xs font-bold text-[var(--text)] block">Partner Perks & Rate Discounts</span>
                                    <span class="text-[11px] text-[var(--text-muted)] block mt-0.5">
                                        Occasional parking coupons and special partner discounts at selected shopping malls.
                                    </span>
                                </div>
                                <input type="checkbox" 
                                       name="notify_promo" 
                                       value="1" 
                                       {{ !empty($profile['preferences']['notify_promo']) ? 'checked' : '' }}
                                       class="mt-1 w-4 h-4 rounded text-[var(--accent)] border-[var(--border)] focus:ring-[var(--accent)]">
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 flex items-center justify-end border-t border-[var(--border)]">
                            <button type="submit" 
                                    class="px-5 py-2.5 rounded-xl text-xs md:text-sm font-semibold bg-[var(--primary)] hover:bg-[var(--primary-light)] text-white shadow-md shadow-slate-900/10 transition-all cursor-pointer">
                                Save Preferences
                            </button>
                        </div>
                    </form>
                </section>

            </div>

            <!-- RIGHT COLUMN (1 COL on LG): Quick Summary & Account Actions -->
            <div class="space-y-6">
                
                <!-- PRIMARY VEHICLE CARD -->
                <div class="dashboard-card p-5">
                    <div class="flex items-center justify-between pb-3 border-b border-[var(--border)] mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-blue-50 text-[var(--accent)] flex items-center justify-center font-bold text-xs">
                                P
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">Primary Gate Vehicle</span>
                        </div>
                        <a href="/vehicles" class="text-xs font-semibold text-[var(--accent)] hover:underline">
                            Manage
                        </a>
                    </div>

                    @if($defaultVehicle)
                        <div class="bg-slate-900 border-2 border-slate-700 rounded-xl px-4 py-2.5 shadow-md text-white font-mono flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                                <span class="text-base font-black tracking-widest">{{ $defaultVehicle['plate'] }}</span>
                            </div>
                            <span class="text-[10px] text-slate-400 font-semibold">Primary</span>
                        </div>
                        <div class="text-xs space-y-1">
                            <div class="font-bold text-[var(--text)]">{{ $defaultVehicle['display_name'] ?? $defaultVehicle['type_label'] }}</div>
                            <div class="text-[var(--text-muted)]">Automatic ANPR gate scanner enabled</div>
                        </div>
                    @else
                        <div class="p-4 bg-slate-50 rounded-xl text-center text-xs text-[var(--text-muted)] mb-3">
                            No primary vehicle selected.
                        </div>
                        <a href="/vehicles" class="block text-center text-xs font-semibold text-[var(--accent)] hover:underline">
                            + Select Primary Vehicle
                        </a>
                    @endif
                </div>

                <!-- ACTIVE PARKING SHORTCUT -->
                @if($hasActiveSession && $activeSessionVehicle)
                    <div class="dashboard-card p-5 bg-emerald-50/40 border-emerald-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Active Parking Session
                            </span>
                            <span class="text-[10px] font-bold uppercase text-emerald-700">Mall XYZ</span>
                        </div>
                        <p class="text-xs text-[var(--text-muted)] mb-3">
                            Vehicle <span class="font-mono font-bold">{{ $activeSessionVehicle['plate'] }}</span> is currently parked.
                        </p>
                        <a href="/active-parking" 
                           class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-semibold shadow-sm transition-colors">
                            <span>Open Active Session</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </a>
                    </div>
                @endif

                <!-- ACCOUNT & SIGN OUT CARD -->
                <div class="dashboard-card p-5">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">Session & Security</h4>
                    <div class="space-y-2.5">
                        <a href="/logout" 
                           class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition-colors">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>Sign Out of Account</span>
                        </a>

                        <button type="button" 
                                onclick="openDeleteAccountNotice()"
                                class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-4 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-xl transition-colors cursor-pointer">
                            <span>Request Account Deletion</span>
                        </button>
                    </div>
                </div>

                <!-- HELP & SUPPORT -->
                <div class="dashboard-card p-5 bg-gradient-to-br from-slate-50 to-blue-50/20 border border-[var(--border)] text-xs text-[var(--text-muted)] space-y-2">
                    <div class="font-bold text-[var(--text)] flex items-center gap-1.5">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        <span>Need Support?</span>
                    </div>
                    <p class="leading-relaxed">
                        For questions regarding gate recognition or parking payment receipts, contact NusaPark support 24/7.
                    </p>
                    <a href="/faq" class="inline-flex items-center gap-1 font-semibold text-[var(--accent)] hover:underline pt-1">
                        Read Driver FAQ
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                </div>

            </div>

        </div>

    </div>

    <!-- ================= DELETE ACCOUNT NOTICE MODAL ================= -->
    <div id="delete-account-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="delete-account-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeDeleteAccountNotice()"></div>

        <div class="min-h-full flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 text-center border border-[var(--border)]">
                <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>

                <h3 class="text-lg font-bold text-[var(--text)]" id="delete-account-title">Account Deletion Policy</h3>
                <p class="text-xs text-[var(--text-muted)] mt-2 leading-relaxed">
                    Under Indonesian transportation and parking security regulations, accounts with active parking sessions or outstanding penalty dues cannot be deleted.
                </p>

                <div class="p-3 bg-amber-50 border border-amber-200/80 rounded-xl text-left text-[11px] text-amber-800 my-4 space-y-1">
                    <div class="font-bold text-amber-900">Before proceeding:</div>
                    <div>1. End all active parking sessions and clear exit barriers.</div>
                    <div>2. Cancel any pending advance slot reservations.</div>
                    <div>3. Download past tax receipts from your History tab.</div>
                </div>

                <div class="flex items-center justify-center gap-3">
                    <button type="button" 
                            onclick="closeDeleteAccountNotice()" 
                            class="px-5 py-2.5 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
                        Understood, Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    // Toggle password visibility
    function togglePwVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        if (!input) return;

        if (input.type === 'password') {
            input.type = 'text';
            btn.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>`;
        } else {
            input.type = 'password';
            btn.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
        }
    }

    // Modal notices
    function openDeleteAccountNotice() {
        document.getElementById('delete-account-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteAccountNotice() {
        document.getElementById('delete-account-modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // ESC to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteAccountNotice();
        }
    });
</script>
@endpush

</x-layouts.app>
