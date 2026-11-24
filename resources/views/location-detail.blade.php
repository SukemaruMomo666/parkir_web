<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mall XYZ - NusaPark</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/locations.css') }}"> <!-- For related location cards -->
    <link rel="stylesheet" href="{{ asset('css/location-detail.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="detail-page-body">

    <!-- NAVBAR (Reused) -->
    <x-navbar active="locations" />

    <!-- BREADCRUMB -->
    <div class="container">
        <div class="breadcrumb">
            <a href="/">Home</a>
            <span class="breadcrumb-separator">/</span>
            <a href="/locations">Locations</a>
            <span class="breadcrumb-separator">/</span>
            <span class="current">Mall XYZ</span>
        </div>
    </div>

    <!-- LOCATION HERO -->
    <header class="detail-hero-section">
        <div class="container">
            <div class="hero-grid">
                
                <!-- Left: Image Gallery -->
                <div class="hero-gallery">
                    <div class="main-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1621929747188-0b4dc28498d2?auto=format&fit=crop&q=80&w=1200" alt="Mall XYZ Exterior" class="main-image" id="mainGalleryImg">
                    </div>
                    <div class="gallery-thumbs">
                        <div class="gallery-thumb active" onclick="swapImage(this, 'https://images.unsplash.com/photo-1621929747188-0b4dc28498d2?auto=format&fit=crop&q=80&w=1200')">
                            <img src="https://images.unsplash.com/photo-1621929747188-0b4dc28498d2?auto=format&fit=crop&q=80&w=200" alt="Thumb 1">
                        </div>
                        <div class="gallery-thumb" onclick="swapImage(this, 'https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=1200')">
                            <img src="https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=200" alt="Thumb 2">
                        </div>
                        <div class="gallery-thumb" onclick="swapImage(this, 'https://images.unsplash.com/photo-1506521781263-d8422e82f27a?auto=format&fit=crop&q=80&w=1200')">
                            <img src="https://images.unsplash.com/photo-1506521781263-d8422e82f27a?auto=format&fit=crop&q=80&w=200" alt="Thumb 3">
                        </div>
                    </div>
                </div>

                <!-- Right: Information -->
                <div class="hero-info">
                    <div class="status-badge open">Open Now • 06:00–23:00</div>
                    
                    <h1>Mall XYZ</h1>
                    
                    <div class="hero-meta">
                        <span>Jakarta Selatan</span>
                        <div class="hero-rating">
                            4.8 <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                        <span>324 reviews</span>
                        <span>2.4 km away</span>
                    </div>
                    
                    <div class="hero-address">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                        <div>
                            Jl. Example No. 123<br>
                            Kebayoran Baru, Jakarta Selatan 12190
                            <div style="margin-top: 8px;">
                                <a href="#" style="color: var(--accent); font-size: 0.875rem; margin-right: 12px; font-weight:500;">Copy Address</a>
                                <a href="#" style="color: var(--accent); font-size: 0.875rem; font-weight:500;">Get Directions</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="hero-actions">
                        <button class="btn btn-primary" onclick="alert('Auth Flow: Sign in to start your parking session.')">Start Parking</button>
                        <button class="btn btn-secondary" onclick="alert('Opening Maps app for navigation...')">Navigate</button>
                        <button class="btn btn-secondary" style="flex: 0.5" onclick="alert('Opening reservation flow...')">Reserve</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- CONTENT LAYOUT -->
    <div class="container">
        <div class="content-layout">
            
            <!-- LEFT MAIN CONTENT -->
            <div class="content-main">
                
                <!-- AVAILABILITY MODULE -->
                <section class="availability-module">
                    <div class="availability-header">
                        <h2 class="section-title" style="margin-bottom: 0;">Live Availability</h2>
                        <div class="live-trust-badge">
                            <span style="width:8px;height:8px;border-radius:50%;background:var(--success);"></span>
                            Updated just now
                        </div>
                    </div>
                    
                    <div class="availability-numbers">
                        <div class="avail-stat primary">
                            <span class="label">Available Slots</span>
                            <span class="value">327</span>
                        </div>
                        <div class="avail-stat">
                            <span class="label">Total Capacity</span>
                            <span class="value">1,250</span>
                        </div>
                        <div class="avail-stat">
                            <span class="label">Occupied</span>
                            <span class="value">911</span>
                        </div>
                        <div class="avail-stat">
                            <span class="label">Reserved</span>
                            <span class="value">12</span>
                        </div>
                    </div>
                </section>

                <!-- PARKING OPTIONS -->
                <section>
                    <h2 class="section-title">Parking Options</h2>
                    <div class="options-grid">
                        <div class="option-card">
                            <div class="opt-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg>
                            </div>
                            <div class="opt-title">Car</div>
                            <div class="opt-status success">High Availability</div>
                            <div class="opt-price">From Rp5.000 / hr</div>
                        </div>
                        
                        <div class="option-card">
                            <div class="opt-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="17" cy="16" r="3"/><circle cx="7" cy="16" r="3"/><path d="M10 5L15 11 17 11"/><path d="M7 16H3V12L5 8h3"/></svg>
                            </div>
                            <div class="opt-title">Motorcycle</div>
                            <div class="opt-status success">Available</div>
                            <div class="opt-price">From Rp2.000 / hr</div>
                        </div>
                        
                        <div class="option-card">
                            <div class="opt-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="opt-title">EV Charging</div>
                            <div class="opt-status success">4 Stations</div>
                            <div class="opt-price">Rp10.000 / hr</div>
                        </div>
                        
                        <div class="option-card">
                            <div class="opt-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="3"/><path d="M12 22V8"/><path d="M5 11l7-3 7 3"/></svg>
                            </div>
                            <div class="opt-title">VIP</div>
                            <div class="opt-status" style="background:var(--warning-bg);color:#92400E;">Limited</div>
                            <div class="opt-price">Rp15.000 / hr</div>
                        </div>
                    </div>
                </section>

                <!-- PARKING MAP -->
                <section>
                    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 24px;">
                        <div>
                            <h2 class="section-title" style="margin-bottom:4px;">Parking Map</h2>
                            <p style="color:var(--text-muted);font-size:0.875rem;">See available spaces before you arrive.</p>
                        </div>
                    </div>
                    
                    <div class="map-preview-module">
                        <div class="map-preview-header">
                            <div class="floor-selector">
                                <button class="floor-btn">B2</button>
                                <button class="floor-btn active">B1</button>
                                <button class="floor-btn">L1</button>
                                <button class="floor-btn">L2</button>
                            </div>
                            <button class="btn btn-secondary" style="padding: 6px 16px; font-size:0.875rem;">Open Map Full</button>
                        </div>
                        <div class="map-visual-area">
                            <!-- Mock Slots -->
                            <div class="mock-slot available" style="top: 20px; left: 20%;" onclick="alert('Slot A-001 selected.')">A-001</div>
                            <div class="mock-slot occupied" style="top: 20px; left: 40%;">A-002</div>
                            <div class="mock-slot available" style="top: 20px; left: 60%;" onclick="alert('Slot A-003 selected.')">A-003</div>
                            <div class="mock-slot occupied" style="top: 20px; left: 80%;">A-004</div>
                            
                            <div class="mock-slot occupied" style="bottom: 20px; left: 30%;">B-001</div>
                            <div class="mock-slot available" style="bottom: 20px; left: 50%;">B-002</div>
                            <div class="mock-slot available" style="bottom: 20px; left: 70%;">B-003</div>
                            
                            <!-- Driveway indicator -->
                            <div style="position:absolute; width:100%; height:40px; border-top: 2px dashed #94A3B8; border-bottom: 2px dashed #94A3B8; display:flex; align-items:center; justify-content:center; color:#94A3B8; font-size:0.75rem; letter-spacing:0.1em; font-weight:600;">DRIVEWAY</div>
                        </div>
                    </div>
                </section>
                
            </div>

            <!-- RIGHT SIDEBAR (Pricing, Facilities, Info) -->
            <div class="content-sidebar">
                
                <!-- PRICING -->
                <section class="pricing-card">
                    <h3 style="font-size:1.25rem; font-weight:600; color:var(--primary); margin-bottom: 16px;">Parking Rates</h3>
                    <div style="margin-bottom: 24px;">
                        <h4 style="font-size:0.875rem; font-weight:600; margin-bottom:8px; color:var(--text-main);">Car</h4>
                        <div class="pricing-row"><span class="pricing-label">0–1 hour</span><span class="pricing-val">Rp5.000</span></div>
                        <div class="pricing-row"><span class="pricing-label">1–2 hours</span><span class="pricing-val">Rp9.000</span></div>
                        <div class="pricing-row"><span class="pricing-label">Next hour</span><span class="pricing-val">+ Rp4.000</span></div>
                        <div class="pricing-row"><span class="pricing-label">Daily max</span><span class="pricing-val">Rp40.000</span></div>
                    </div>
                    <div>
                        <h4 style="font-size:0.875rem; font-weight:600; margin-bottom:8px; color:var(--text-main);">Motorcycle</h4>
                        <div class="pricing-row"><span class="pricing-label">0–1 hour</span><span class="pricing-val">Rp2.000</span></div>
                        <div class="pricing-row"><span class="pricing-label">Next hour</span><span class="pricing-val">+ Rp2.000</span></div>
                    </div>
                    
                    <p style="font-size:0.75rem; color:var(--text-muted); margin-top:16px;">Rates may vary by parking category, day, event, or operating policy.</p>
                    
                    <div style="margin-top:24px;">
                        <h4 style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em; color:var(--text-muted);">Payment Methods</h4>
                        <div class="payment-methods">
                            <span class="pay-method">QRIS</span>
                            <span class="pay-method">E-Wallet</span>
                            <span class="pay-method">NFC Card</span>
                            <span class="pay-method">App</span>
                        </div>
                    </div>
                </section>

                <!-- FACILITIES -->
                <section>
                    <h3 style="font-size:1.25rem; font-weight:600; color:var(--primary); margin-bottom: 16px;">Facilities</h3>
                    <div class="facilities-grid">
                        <div class="fac-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg>
                            <span>EV Charging</span>
                        </div>
                        <div class="fac-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span>24/7 Access</span>
                        </div>
                        <div class="fac-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                            <span>CCTV Monitoring</span>
                        </div>
                        <div class="fac-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                            <span>Disabled Parking</span>
                        </div>
                    </div>
                </section>

                <!-- ENTRANCE INFO -->
                <section>
                    <h3 style="font-size:1.25rem; font-weight:600; color:var(--primary); margin-bottom: 16px;">How to Enter</h3>
                    <div class="info-grid">
                        <div class="info-row">
                            <span class="label">Main Entrance</span>
                            <span class="val">Jl. Sudirman, Gate A (North)</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Access Technology</span>
                            <span class="val">ANPR (Camera) & Auto-barrier</span>
                        </div>
                    </div>
                    
                    <div class="steps-list" style="margin-top: 16px;">
                        <div class="step-item">
                            <div class="step-num">1</div>
                            <div class="step-text">Drive to the entrance gate.</div>
                        </div>
                        <div class="step-item">
                            <div class="step-num">2</div>
                            <div class="step-text">ANPR camera reads your plate automatically.</div>
                        </div>
                        <div class="step-item">
                            <div class="step-num">3</div>
                            <div class="step-text">Barrier opens, proceed to park.</div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <!-- RELATED LOCATIONS -->
    <section class="related-section">
        <div class="container">
            <h2 class="section-title">Other parking nearby</h2>
            <div class="locations-grid">
                
                <!-- Reuse Location Card from Page 03 -->
                <div class="loc-card" onclick="window.scrollTo(0,0)">
                    <div class="loc-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=600" alt="Subang Square" class="loc-image">
                    </div>
                    <div class="loc-content">
                        <div class="loc-header">
                            <div>
                                <h3 class="loc-title">Office Tower B</h3>
                                <div class="loc-subtitle">0.8 km away</div>
                            </div>
                        </div>
                        <div class="loc-availability">
                            <div class="avail-indicator warning">Limited</div>
                            <span class="avail-text">24 slots available</span>
                        </div>
                        <div class="loc-details-grid" style="margin-bottom:0;">
                            <div class="loc-detail">
                                <span>Starting Price</span>
                                <span>Rp4.000 / hr</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="loc-card" onclick="window.scrollTo(0,0)">
                    <div class="loc-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1506521781263-d8422e82f27a?auto=format&fit=crop&q=80&w=600" alt="ABC" class="loc-image">
                    </div>
                    <div class="loc-content">
                        <div class="loc-header">
                            <div>
                                <h3 class="loc-title">Parking Building ABC</h3>
                                <div class="loc-subtitle">1.2 km away</div>
                            </div>
                        </div>
                        <div class="loc-availability">
                            <div class="avail-indicator success">Available</div>
                            <span class="avail-text">156 slots available</span>
                        </div>
                        <div class="loc-details-grid" style="margin-bottom:0;">
                            <div class="loc-detail">
                                <span>Starting Price</span>
                                <span>Rp6.000 / hr</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER (Reused) -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="/" class="logo" style="color: white;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/>
                            <circle cx="7" cy="17" r="2"/>
                            <path d="M9 17h6"/>
                            <circle cx="17" cy="17" r="2"/>
                        </svg>
                        NusaPark
                    </a>
                    <p>Smart Parking for a Smarter Indonesia. Revolutionizing urban mobility through enterprise-grade technology.</p>
                </div>
                <div class="footer-col">
                    <h4>Product</h4>
                    <ul>
                        <li><a href="/search">Find Parking</a></li>
                        <li><a href="/locations">Locations</a></li>
                        <li><a href="/#pricing">Pricing</a></li>
                        <li><a href="#">App Download</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 NusaPark. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- MOBILE STICKY ACTION BAR -->
    <div class="mobile-sticky-action-bar">
        <div class="mobile-sticky-actions">
            <button class="btn btn-primary" onclick="alert('Auth Flow...')">Start Parking</button>
            <button class="btn btn-secondary" onclick="alert('Opening Maps...')">Navigate</button>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        // Image Gallery Swap
        function swapImage(thumbElem, srcUrl) {
            // Remove active class from all thumbs
            document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
            // Add active class to clicked
            thumbElem.classList.add('active');
            // Swap main image
            document.getElementById('mainGalleryImg').src = srcUrl;
        }

        // Floor selector mock
        document.querySelectorAll('.floor-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.floor-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
