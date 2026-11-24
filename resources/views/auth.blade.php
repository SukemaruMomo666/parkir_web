<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication - NusaPark</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="auth-layout">
        
        <!-- BRAND PANEL (LEFT) -->
        <div class="auth-brand-panel">
            <a href="/" class="logo brand-logo-fixed">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/>
                    <circle cx="7" cy="17" r="2"/>
                    <path d="M9 17h6"/>
                    <circle cx="17" cy="17" r="2"/>
                </svg>
                NusaPark
            </a>
            
            <div class="brand-content">
                <h1>Park smarter.<br>Move easier.</h1>
                <p>Access your NusaPark account to manage parking sessions, vehicles, reservations, payments, and more.</p>
            </div>
            
            <div class="brand-visual">
                <div style="padding:24px; background:var(--background);">
                    <div style="font-size:0.75rem; font-weight:600; color:var(--text-muted); margin-bottom:12px; text-transform:uppercase;">Active Session</div>
                    <div style="display:flex; justify-content:space-between; align-items:center; background:var(--primary); color:white; padding:24px; border-radius:var(--radius-lg);">
                        <div>
                            <div style="font-weight:600; font-size:1.125rem; margin-bottom:4px;">NusaPark Central</div>
                            <div style="font-size:0.875rem; color:#CBD5E1;">B 1234 XYZ</div>
                        </div>
                        <div style="text-align:right;">
                            <div style="font-size:0.875rem; color:#CBD5E1; margin-bottom:4px;">Duration</div>
                            <div style="font-weight:700; font-size:1.25rem;">1h 24m</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM PANEL (RIGHT) -->
        <div class="auth-form-panel">
            
            <!-- HEADER -->
            <header class="auth-header">
                <a href="/" class="logo auth-header-mobile-logo">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/>
                        <circle cx="7" cy="17" r="2"/>
                        <path d="M9 17h6"/>
                        <circle cx="17" cy="17" r="2"/>
                    </svg>
                    NusaPark
                </a>
                
                <div class="auth-nav-action" id="navActionLogin">
                    Don't have an account? <a href="/register">Create account</a>
                </div>
                <div class="auth-nav-action" id="navActionRegister" style="display:none;">
                    Already have an account? <a href="/login">Sign in</a>
                </div>
            </header>

            <!-- CONTENT AREA -->
            <div class="auth-content">
                
                <!-- Context Message (Injected via JS if present in URL) -->
                <div id="authContextMsg" class="auth-context-msg" style="display:none;"></div>

                <!-- AUTH TABS (Masuk & Daftar) -->
                <div class="auth-tabs" id="authTabs" style="display:flex; gap:6px; margin-bottom:28px; padding:4px; background:var(--background); border-radius:var(--radius-lg); border:1px solid var(--border);">
                    <button type="button" class="auth-tab-btn" id="tabBtnLogin" onclick="switchView('login')" style="flex:1; padding:10px 16px; border:none; border-radius:var(--radius-md); font-weight:600; font-size:0.9375rem; cursor:pointer; transition:all 0.2s ease;">
                        Masuk
                    </button>
                    <button type="button" class="auth-tab-btn" id="tabBtnRegister" onclick="switchView('register')" style="flex:1; padding:10px 16px; border:none; border-radius:var(--radius-md); font-weight:600; font-size:0.9375rem; cursor:pointer; transition:all 0.2s ease;">
                        Daftar Akun
                    </button>
                </div>
                
                <!-- VIEW: LOGIN -->
                <div id="view-login" class="auth-view">
                    <h2 class="auth-title">Welcome back</h2>
                    <p class="auth-subtitle">Sign in to continue your NusaPark experience.</p>
                    
                    <div id="loginAlert" class="auth-alert"></div>

                    @if(session('error'))
                        <div class="auth-alert error" style="display:block; margin-bottom:16px;">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="auth-alert success" style="display:block; margin-bottom:16px;">{{ session('success') }}</div>
                    @endif
                    @if($errors->has('login'))
                        <div class="auth-alert error" style="display:block; margin-bottom:16px;">{{ $errors->first('login') }}</div>
                    @endif
                    
                    <form id="formLogin" class="auth-form" method="POST" action="{{ route('login.post') }}" novalidate>
                        @csrf
                        <div class="form-group" id="fg-login-id">
                            <label for="loginId">Email or phone number</label>
                            <input type="text" id="loginId" name="login" class="form-input" placeholder="Enter your email or phone number" autocomplete="username" value="{{ old('login') }}">
                            <div class="error-msg" id="err-login-id"></div>
                        </div>
                        
                        <div class="form-group" id="fg-login-pw">
                            <label for="loginPw">Password</label>
                            <div class="password-wrapper">
                                <input type="password" id="loginPw" name="password" class="form-input" placeholder="Enter your password" autocomplete="current-password">
                                <button type="button" class="password-toggle" onclick="togglePassword('loginPw')" aria-label="Show password">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>
                            <div class="error-msg" id="err-login-pw"></div>
                        </div>
                        
                        <div class="form-extras">
                            <label class="checkbox-label">
                                <input type="checkbox" id="rememberMe" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me
                            </label>
                            <a href="/forgot-password" class="forgot-link">Forgot password?</a>
                        </div>
                        
                        <button type="submit" class="btn btn-primary auth-submit-btn" id="btnLogin">
                            <span class="btn-text">Sign in</span>
                            <span class="btn-loading-state"><span class="spinner"></span> Signing in...</span>
                        </button>
                    </form>

                    <!-- Google OAuth Separator -->
                    <div class="auth-divider" style="display:flex; align-items:center; text-align:center; margin:20px 0 16px; color:var(--text-muted); font-size:0.875rem;">
                        <span style="flex:1; border-bottom:1px solid var(--border);"></span>
                        <span style="padding:0 12px; font-weight:500;">atau</span>
                        <span style="flex:1; border-bottom:1px solid var(--border);"></span>
                    </div>

                    <!-- Google Sign-In Button -->
                    <a href="{{ route('auth.google.redirect', ['intent' => 'login']) }}" class="btn-google-auth" id="btnGoogleLogin" style="display:flex; align-items:center; justify-content:center; gap:12px; width:100%; padding:12px 16px; border:1px solid var(--border); border-radius:var(--radius-md); background:var(--surface); color:var(--text-main); font-weight:600; font-size:0.9375rem; text-decoration:none; box-sizing:border-box; transition:all 0.2s ease;">
                        <svg width="18" height="18" viewBox="0 0 24 24" style="flex-shrink:0;">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                        </svg>
                        <span>Masuk dengan Google</span>
                    </a>
                </div>

                <!-- VIEW: REGISTER -->
                <div id="view-register" class="auth-view">
                    <h2 class="auth-title">Create your account</h2>
                    <p class="auth-subtitle">Get a more connected parking experience.</p>
                    
                    <div id="registerAlert" class="auth-alert"></div>

                    @if(session('error'))
                        <div class="auth-alert error" style="display:block; margin-bottom:16px;">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="auth-alert success" style="display:block; margin-bottom:16px;">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="auth-alert error" style="display:block; margin-bottom:16px;">
                            <ul style="margin:0; padding-left:18px;">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form id="formRegister" class="auth-form" method="POST" action="{{ route('register.post') }}" novalidate>
                        @csrf
                        <div class="form-group" id="fg-reg-name">
                            <label for="regName">Full Name</label>
                            <input type="text" id="regName" name="name" class="form-input" placeholder="Enter your full name" autocomplete="name" value="{{ old('name') }}">
                            <div class="error-msg" id="err-reg-name"></div>
                        </div>
                        
                        <div class="form-group" id="fg-reg-email">
                            <label for="regEmail">Email address</label>
                            <input type="email" id="regEmail" name="email" class="form-input" placeholder="name@example.com" autocomplete="email" value="{{ old('email') }}">
                            <div class="error-msg" id="err-reg-email"></div>
                        </div>

                        <div class="form-group" id="fg-reg-phone">
                            <label for="regPhone">Phone number <span style="font-weight:400; color:var(--text-muted);">(Optional)</span></label>
                            <input type="tel" id="regPhone" name="phone" class="form-input" placeholder="e.g. 081234567890" autocomplete="tel" value="{{ old('phone') }}">
                            <div class="error-msg" id="err-reg-phone"></div>
                        </div>
                        
                        <div class="form-group" id="fg-reg-pw">
                            <label for="regPw">Password</label>
                            <div class="password-wrapper">
                                <input type="password" id="regPw" name="password" class="form-input" placeholder="Create a password (min. 8 characters)" autocomplete="new-password" oninput="checkStrength()">
                                <button type="button" class="password-toggle" onclick="togglePassword('regPw')" aria-label="Show password">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>
                            <!-- Strength Indicator -->
                            <div class="pw-strength-container" id="pwStrength">
                                <div class="pw-strength-bar bar-1"></div>
                                <div class="pw-strength-bar bar-2"></div>
                                <div class="pw-strength-bar bar-3"></div>
                            </div>
                            <div class="pw-strength-text" id="pwStrengthText">Minimum 8 characters</div>
                            <div class="error-msg" id="err-reg-pw"></div>
                        </div>
                        
                        <div class="form-group" id="fg-reg-terms" style="margin-top:8px;">
                            <label class="checkbox-label" style="align-items:flex-start;">
                                <input type="checkbox" id="regTerms" name="terms" value="1" style="margin-top:2px;"> 
                                <span style="font-size:0.875rem; color:var(--text-muted); font-weight:400; line-height:1.5;">
                                    I agree to the <a href="#" style="color:var(--primary); font-weight:600;">Terms of Service</a> and <a href="#" style="color:var(--primary); font-weight:600;">Privacy Policy</a>.
                                </span>
                            </label>
                            <div class="error-msg" id="err-reg-terms" style="margin-top:4px;"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary auth-submit-btn" id="btnRegister">
                            <span class="btn-text">Create account</span>
                            <span class="btn-loading-state"><span class="spinner"></span> Creating account...</span>
                        </button>
                    </form>

                    <!-- Google OAuth Separator -->
                    <div class="auth-divider" style="display:flex; align-items:center; text-align:center; margin:20px 0 16px; color:var(--text-muted); font-size:0.875rem;">
                        <span style="flex:1; border-bottom:1px solid var(--border);"></span>
                        <span style="padding:0 12px; font-weight:500;">atau</span>
                        <span style="flex:1; border-bottom:1px solid var(--border);"></span>
                    </div>

                    <!-- Google Sign-Up Button -->
                    <a href="{{ route('auth.google.redirect', ['intent' => 'register']) }}" class="btn-google-auth" id="btnGoogleRegister" style="display:flex; align-items:center; justify-content:center; gap:12px; width:100%; padding:12px 16px; border:1px solid var(--border); border-radius:var(--radius-md); background:var(--surface); color:var(--text-main); font-weight:600; font-size:0.9375rem; text-decoration:none; box-sizing:border-box; transition:all 0.2s ease;">
                        <svg width="18" height="18" viewBox="0 0 24 24" style="flex-shrink:0;">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                        </svg>
                        <span>Daftar dengan Google</span>
                    </a>

                    <p style="font-size:0.75rem; color:var(--text-muted); text-align:center; margin-top:16px;">
                        Your account information is securely handled.
                    </p>
                </div>

                <!-- VIEW: FORGOT PASSWORD -->
                <div id="view-forgot" class="auth-view">
                    <h2 class="auth-title">Reset your password</h2>
                    <p class="auth-subtitle">Enter the email address associated with your account and we'll help you regain access.</p>
                    
                    <div id="forgotAlert" class="auth-alert"></div>
                    
                    <form id="formForgot" class="auth-form" novalidate>
                        <div class="form-group" id="fg-forgot-email">
                            <label for="forgotEmail">Email address</label>
                            <input type="email" id="forgotEmail" class="form-input" placeholder="name@example.com" autocomplete="email">
                            <div class="error-msg" id="err-forgot-email"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary auth-submit-btn" id="btnForgot">
                            <span class="btn-text">Send reset link</span>
                            <span class="btn-loading-state"><span class="spinner"></span> Sending...</span>
                        </button>
                    </form>
                    
                    <div style="text-align:center; margin-top:24px;">
                        <a href="/login" class="forgot-link">← Back to sign in</a>
                    </div>
                </div>

                <!-- VIEW: VERIFY -->
                <div id="view-verify" class="auth-view">
                    <h2 class="auth-title">Verify your account</h2>
                    <p class="auth-subtitle">Enter the 6-digit verification code we sent to your email.</p>
                    
                    <div id="verifyAlert" class="auth-alert"></div>
                    
                    <form id="formVerify" class="auth-form" novalidate>
                        <div class="verify-code-grid" id="verifyGrid">
                            <input type="text" class="form-input verify-input" maxlength="1" autocomplete="one-time-code">
                            <input type="text" class="form-input verify-input" maxlength="1">
                            <input type="text" class="form-input verify-input" maxlength="1">
                            <input type="text" class="form-input verify-input" maxlength="1">
                            <input type="text" class="form-input verify-input" maxlength="1">
                            <input type="text" class="form-input verify-input" maxlength="1">
                        </div>
                        <div class="error-msg" id="err-verify-code" style="text-align:center; margin-top:-16px; margin-bottom:16px;"></div>
                        
                        <button type="submit" class="btn btn-primary auth-submit-btn" id="btnVerify">
                            <span class="btn-text">Verify</span>
                            <span class="btn-loading-state"><span class="spinner"></span> Verifying...</span>
                        </button>
                    </form>
                    
                    <div style="text-align:center; margin-top:24px;">
                        <span style="font-size:0.875rem; color:var(--text-muted);">Didn't receive the code?</span>
                        <button type="button" style="background:none; border:none; color:var(--primary); font-weight:600; cursor:pointer;" onclick="resendCode()">Resend code</button>
                    </div>
                </div>



            </div>

            <!-- FOOTER -->
            <footer class="auth-footer">
                <p>&copy; 2026 NusaPark. 
                    <a href="#">Privacy</a> 
                    <a href="#">Terms</a> 
                    <a href="/faq">Help</a>
                </p>
            </footer>

        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        // Initial setup from Laravel blade variable
        const initialMode = "{{ $mode ?? 'login' }}";
        
        // Show context message based on URL
        const urlParams = new URLSearchParams(window.location.search);
        const context = urlParams.get('context');
        if (context) {
            const ctxMsg = document.getElementById('authContextMsg');
            ctxMsg.style.display = 'block';
            if (context === 'reservation') ctxMsg.textContent = 'Sign in to continue with your reservation.';
            else if (context === 'payment') ctxMsg.textContent = 'Sign in to continue with payment.';
            else if (context === 'active') ctxMsg.textContent = 'Sign in to view your active parking session.';
            else if (context === 'profile') ctxMsg.textContent = 'Sign in to manage your account.';
            else ctxMsg.textContent = 'Sign in to continue.';
        }

        // View management
        function switchView(mode) {
            document.querySelectorAll('.auth-view').forEach(el => el.classList.remove('active'));
            const target = document.getElementById(`view-${mode}`) || document.getElementById('view-login');
            if (target) target.classList.add('active');
            
            // Header & Tab logic
            const navLogin = document.getElementById('navActionLogin');
            const navReg = document.getElementById('navActionRegister');
            const authTabs = document.getElementById('authTabs');
            const tabBtnLogin = document.getElementById('tabBtnLogin');
            const tabBtnRegister = document.getElementById('tabBtnRegister');

            if(mode === 'register') {
                if(navLogin) navLogin.style.display = 'none';
                if(navReg) navReg.style.display = 'flex';
                if(authTabs) authTabs.style.display = 'flex';
                if(tabBtnRegister) {
                    tabBtnRegister.style.background = 'var(--surface)';
                    tabBtnRegister.style.color = 'var(--primary)';
                    tabBtnRegister.style.boxShadow = '0 1px 3px rgba(0,0,0,0.08)';
                }
                if(tabBtnLogin) {
                    tabBtnLogin.style.background = 'transparent';
                    tabBtnLogin.style.color = 'var(--text-muted)';
                    tabBtnLogin.style.boxShadow = 'none';
                }
            } else if (mode === 'login') {
                if(navLogin) navLogin.style.display = 'flex';
                if(navReg) navReg.style.display = 'none';
                if(authTabs) authTabs.style.display = 'flex';
                if(tabBtnLogin) {
                    tabBtnLogin.style.background = 'var(--surface)';
                    tabBtnLogin.style.color = 'var(--primary)';
                    tabBtnLogin.style.boxShadow = '0 1px 3px rgba(0,0,0,0.08)';
                }
                if(tabBtnRegister) {
                    tabBtnRegister.style.background = 'transparent';
                    tabBtnRegister.style.color = 'var(--text-muted)';
                    tabBtnRegister.style.boxShadow = 'none';
                }
            } else {
                if(navLogin) navLogin.style.display = 'none';
                if(navReg) navReg.style.display = 'none';
                if(authTabs) authTabs.style.display = 'none';
            }
        }
        
        switchView(initialMode);

        // Password Toggle
        function togglePassword(id) {
            const el = document.getElementById(id);
            const btn = el.nextElementSibling;
            if (el.type === 'password') {
                el.type = 'text';
                btn.setAttribute('aria-label', 'Hide password');
                btn.innerHTML = `<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;
            } else {
                el.type = 'password';
                btn.setAttribute('aria-label', 'Show password');
                btn.innerHTML = `<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
            }
        }

        // Error handling helpers
        function showError(groupId, errId, msg) {
            const group = document.getElementById(groupId);
            const err = document.getElementById(errId);
            const input = group.querySelector('.form-input');
            group.classList.add('error');
            if(input) input.classList.add('has-error');
            err.textContent = msg;
        }
        
        function clearErrors(formId) {
            const form = document.getElementById(formId);
            form.querySelectorAll('.form-group').forEach(g => g.classList.remove('error'));
            form.querySelectorAll('.form-input').forEach(i => i.classList.remove('has-error'));
        }

        function showAlert(id, msg, type) {
            const el = document.getElementById(id);
            if (!el) return;
            el.className = `auth-alert ${type}`;
            el.textContent = msg;
            el.style.display = 'block';
        }
        function hideAlert(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.style.display = 'none';
            el.textContent = '';
        }

        // Helper for CSRF token retrieval
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                || document.querySelector('input[name="_token"]')?.value
                || '';
        }

        // --- REAL DATABASE LOGIN INTEGRATION ---
        document.getElementById('formLogin').addEventListener('submit', (e) => {
            e.preventDefault();
            clearErrors('formLogin');
            hideAlert('loginAlert');
            let hasErr = false;
            
            const idVal = document.getElementById('loginId').value.trim();
            const pwVal = document.getElementById('loginPw').value;
            const rememberVal = document.getElementById('rememberMe').checked;
            
            if(!idVal) { showError('fg-login-id', 'err-login-id', 'Enter your email or phone number.'); hasErr = true; }
            if(!pwVal) { showError('fg-login-pw', 'err-login-pw', 'Enter your password.'); hasErr = true; }
            
            if(hasErr) {
                const firstErr = document.querySelector('.has-error');
                if(firstErr) firstErr.focus();
                return;
            }
            
            const btn = document.getElementById('btnLogin');
            btn.classList.add('loading');
            btn.disabled = true;
            
            fetch('{{ route("login.post") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: JSON.stringify({
                    login: idVal,
                    password: pwVal,
                    remember: rememberVal
                })
            })
            .then(async (response) => {
                const data = await response.json().catch(() => ({}));
                btn.classList.remove('loading');
                btn.disabled = false;

                if (response.ok && data.status === 'success') {
                    btn.classList.add('success');
                    showAlert('loginAlert', data.message || 'Signed in successfully. Redirecting...', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect || '/dashboard';
                    }, 350);
                } else {
                    const errorMsg = data.message || data.errors?.login?.[0] || 'The provided credentials do not match our records.';
                    showAlert('loginAlert', errorMsg, 'error');
                    document.getElementById('loginPw').value = '';
                    document.getElementById('loginPw').focus();
                }
            })
            .catch(() => {
                btn.classList.remove('loading');
                btn.disabled = false;
                showAlert('loginAlert', 'Network communication error. Please check your connection and try again.', 'error');
            });
        });

        // --- REGISTER REAL INTEGRATION ---
        function checkStrength() {
            const val = document.getElementById('regPw').value;
            const container = document.getElementById('pwStrength');
            const txt = document.getElementById('pwStrengthText');
            container.className = 'pw-strength-container'; // reset
            
            if(val.length === 0) {
                txt.textContent = 'Minimum 8 characters';
                return;
            }
            
            let strength = 0;
            if(val.length >= 8) strength++;
            if(/[A-Z]/.test(val) && /[0-9]/.test(val)) strength++;
            if(/[^A-Za-z0-9]/.test(val)) strength++;
            
            if(strength === 1) {
                container.classList.add('strength-1'); txt.textContent = 'Weak'; txt.style.color = 'var(--danger)';
            } else if(strength === 2) {
                container.classList.add('strength-2'); txt.textContent = 'Fair'; txt.style.color = 'var(--warning)';
            } else if(strength === 3) {
                container.classList.add('strength-3'); txt.textContent = 'Strong'; txt.style.color = 'var(--success)';
            }
        }

        document.getElementById('formRegister').addEventListener('submit', (e) => {
            e.preventDefault();
            clearErrors('formRegister');
            hideAlert('registerAlert');
            let hasErr = false;
            
            const name = document.getElementById('regName').value.trim();
            const email = document.getElementById('regEmail').value.trim();
            const phone = document.getElementById('regPhone')?.value.trim() || '';
            const pw = document.getElementById('regPw').value;
            const terms = document.getElementById('regTerms').checked;
            
            if(!name) { showError('fg-reg-name', 'err-reg-name', 'Masukkan nama lengkap Anda.'); hasErr = true; }
            if(!email || !email.includes('@')) { showError('fg-reg-email', 'err-reg-email', 'Masukkan alamat email yang valid.'); hasErr = true; }
            if(pw.length < 8) { showError('fg-reg-pw', 'err-reg-pw', 'Kata sandi minimal 8 karakter.'); hasErr = true; }
            if(!terms) {
                const tg = document.getElementById('fg-reg-terms');
                if (tg) tg.classList.add('error');
                const te = document.getElementById('err-reg-terms');
                if (te) {
                    te.textContent = 'Anda harus menyetujui Ketentuan Layanan untuk melanjutkan.';
                    te.style.display = 'block';
                }
                hasErr = true;
            } else {
                const tg = document.getElementById('fg-reg-terms');
                if (tg) tg.classList.remove('error');
                const te = document.getElementById('err-reg-terms');
                if (te) te.style.display = 'none';
            }
            
            if(hasErr) {
                const firstErr = document.querySelector('#formRegister .has-error') || document.querySelector('#formRegister .error');
                if(firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            
            const btn = document.getElementById('btnRegister');
            btn.classList.add('loading');
            btn.disabled = true;
            
            fetch('{{ route("register.post") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    phone: phone || null,
                    password: pw,
                    terms: terms ? 1 : 0
                })
            })
            .then(async (response) => {
                const data = await response.json().catch(() => ({}));
                btn.classList.remove('loading');
                btn.disabled = false;

                if (response.ok && data.status === 'success') {
                    btn.classList.add('success');
                    showAlert('registerAlert', data.message || 'Pendaftaran berhasil! Mengalihkan ke dashboard...', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect || '/dashboard';
                    }, 400);
                } else {
                    if (data.errors) {
                        if (data.errors.name) showError('fg-reg-name', 'err-reg-name', data.errors.name[0]);
                        if (data.errors.email) showError('fg-reg-email', 'err-reg-email', data.errors.email[0]);
                        if (data.errors.phone) showError('fg-reg-phone', 'err-reg-phone', data.errors.phone[0]);
                        if (data.errors.password) showError('fg-reg-pw', 'err-reg-pw', data.errors.password[0]);
                        if (data.errors.terms) {
                            const tg = document.getElementById('fg-reg-terms');
                            if (tg) tg.classList.add('error');
                            const te = document.getElementById('err-reg-terms');
                            if (te) { te.textContent = data.errors.terms[0]; te.style.display = 'block'; }
                        }
                    }
                    const errorMsg = data.message 
                        || data.errors?.email?.[0] 
                        || data.errors?.phone?.[0]
                        || data.errors?.password?.[0] 
                        || 'Pendaftaran tidak dapat diselesaikan. Silakan periksa data Anda.';
                    showAlert('registerAlert', errorMsg, 'error');
                }
            })
            .catch(() => {
                btn.classList.remove('loading');
                btn.disabled = false;
                showAlert('registerAlert', 'Terjadi kesalahan komunikasi jaringan. Silakan periksa koneksi Anda.', 'error');
            });
        });

        // --- FORGOT PASSWORD MOCK ---
        document.getElementById('formForgot').addEventListener('submit', (e) => {
            e.preventDefault();
            clearErrors('formForgot');
            hideAlert('forgotAlert');
            
            const email = document.getElementById('forgotEmail').value.trim();
            if(!email || !email.includes('@')) { 
                showError('fg-forgot-email', 'err-forgot-email', 'Enter a valid email address.');
                document.getElementById('forgotEmail').focus();
                return; 
            }
            
            const btn = document.getElementById('btnForgot');
            btn.classList.add('loading');
            btn.disabled = true;
            
            setTimeout(() => {
                btn.classList.remove('loading');
                btn.disabled = false;
                showAlert('forgotAlert', 'If an account matches that email, password reset instructions have been sent.', 'success');
                document.getElementById('forgotEmail').value = '';
            }, 1000);
        });

        // --- VERIFY MOCK ---
        // Auto-advance logic
        const inputs = document.querySelectorAll('.verify-input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if(e.target.value.length > 0 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
            input.addEventListener('keydown', (e) => {
                if(e.key === 'Backspace' && e.target.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasted = e.clipboardData.getData('text').slice(0, inputs.length);
                pasted.split('').forEach((char, i) => {
                    if(inputs[i]) inputs[i].value = char;
                });
                if(inputs[pasted.length - 1]) inputs[pasted.length - 1].focus();
                else inputs[inputs.length - 1].focus();
            });
        });

        document.getElementById('formVerify').addEventListener('submit', (e) => {
            e.preventDefault();
            hideAlert('verifyAlert');
            document.getElementById('err-verify-code').style.display = 'none';
            
            const code = Array.from(inputs).map(i => i.value).join('');
            if(code.length < 6) {
                document.getElementById('err-verify-code').textContent = 'Please enter the full 6-digit code.';
                document.getElementById('err-verify-code').style.display = 'block';
                return;
            }
            
            const btn = document.getElementById('btnVerify');
            btn.classList.add('loading');
            btn.disabled = true;
            
            setTimeout(() => {
                btn.classList.remove('loading');
                btn.disabled = false;
                
                if(code === '000000') {
                    showAlert('verifyAlert', 'That code isn\'t valid. Check the code and try again.', 'error');
                    inputs.forEach(i => i.value = '');
                    inputs[0].focus();
                } else {
                    showAlert('verifyAlert', 'Your account has been verified. Redirecting...', 'success');
                    setTimeout(() => window.location.href = '/', 1000);
                }
            }, 1000);
        });

        function resendCode() {
            hideAlert('verifyAlert');
            const alert = document.getElementById('verifyAlert');
            alert.className = 'auth-alert success';
            alert.textContent = 'A new code has been sent.';
            alert.style.display = 'block';
        }
    </script>
</body>
</html>
