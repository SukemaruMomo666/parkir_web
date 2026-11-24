<?php
// NusaPark - Smart Parking for a Smarter Indonesia
// Designed following UI/UX Pro Max guidelines.
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NusaPark - Smart Parking for a Smarter Indonesia</title>
    <meta name="description" content="Find available parking, enter without tickets, park with confidence, and pay digitally through one connected platform across Indonesia.">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-main">

    <!-- NAVBAR -->
    <x-navbar active="home" />

    <!-- HERO -->
    <section class="hero bg-surface" id="hero">
        <div class="hero-bg"></div>
        <div class="container hero-grid">
            <div class="hero-content">
                <h1 class="text-primary text-5xl font-bold leading-tight tracking-tight">Smart Parking for a Smarter Indonesia.</h1>
                <p class="text-text-muted text-lg mt-6 mb-8">Find available parking, understand pricing, and park with a more connected experience.</p>
                <div class="hero-actions flex gap-4">
                    <a href="/search" class="btn btn-primary bg-primary text-white hover:bg-primary-light">Find Parking</a>
                    <a href="/locations" class="btn btn-secondary border border-border text-primary hover:bg-background">Explore Locations</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hv-header">
                    <span style="font-weight:600; font-size:14px; display:flex; align-items:center; gap:8px;">
                        <span class="indicator ind-success"></span> Mall XYZ - 327 Available
                    </span>
                </div>
                <div class="hv-content">
                    <div class="hv-car"></div>
                    <div class="hv-barrier" id="hero-barrier"></div>
                    <div class="hv-camera">
                        <svg viewBox="0 0 24 24" style="width:16px; margin:2px auto; display:block; color:white;" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                            <circle cx="12" cy="13" r="4"></circle>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TRUST STRIP -->
    <section class="trust-strip">
        <div class="container trust-grid">
            <div class="trust-item">
                <div class="trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="trust-text">
                    <h4>Real-Time Availability</h4>
                    <p>Live slot updates</p>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7v4a1 1 0 0 0 1 1h3"/><path d="M7 7v10"/><path d="M10 9l3-2 3 2"/><path d="M13 7v10"/><path d="M17 7v4a1 1 0 0 0 1 1h3"/><path d="M21 7v10"/></svg>
                </div>
                <div class="trust-text">
                    <h4>Ticketless Entry</h4>
                    <p>ANPR camera scanning</p>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                </div>
                <div class="trust-text">
                    <h4>Digital Payment</h4>
                    <p>Cashless & seamless</p>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/></svg>
                </div>
                <div class="trust-text">
                    <h4>Smart Parking Map</h4>
                    <p>Navigate directly to slot</p>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="section section-bg" id="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2>A Seamless Journey</h2>
                <p>Experience the most intuitive parking process from discovery to exit.</p>
            </div>
            <div class="journey-timeline">
                <div class="step">
                    <div class="step-num">01</div>
                    <h4>Find Parking</h4>
                </div>
                <div class="step">
                    <div class="step-num">02</div>
                    <h4>Arrive</h4>
                </div>
                <div class="step">
                    <div class="step-num">03</div>
                    <h4>Park</h4>
                </div>
                <div class="step">
                    <div class="step-num">04</div>
                    <h4>Pay</h4>
                </div>
                <div class="step">
                    <div class="step-num">05</div>
                    <h4>Exit</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- REAL-TIME AVAILABILITY -->
    <section class="section">
        <div class="container">
            <div class="availability-card">
                <div class="av-info">
                    <h3>Mall XYZ</h3>
                    <p>Jakarta Selatan • 1,250 Total Slots</p>
                    <a href="#" class="btn btn-secondary" style="border:none; color:var(--primary);">View Parking &rarr;</a>
                </div>
                <div class="av-stats">
                    <div class="stat-box">
                        <span class="stat-value" style="color: var(--success);">327</span>
                        <span class="stat-label"><span class="indicator ind-success"></span> Available</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-value" style="color: #94A3B8;">923</span>
                        <span class="stat-label"><span class="indicator ind-danger"></span> Occupied</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-value" style="color: var(--warning);">12</span>
                        <span class="stat-label"><span class="indicator ind-warning"></span> Reserved</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SMART PARKING MAP -->
    <section class="section section-bg">
        <div class="container map-preview">
            <div>
                <h2>Navigate With Confidence</h2>
                <p style="margin-bottom: 24px;">Don't waste time driving in circles. Our smart parking map directs you exactly to where the available slots are located.</p>
                <a href="#" class="btn btn-primary">Explore Parking Map</a>
            </div>
            <div class="map-visual">
                <div class="map-level-tabs">
                    <div class="map-tab active">B1</div>
                    <div class="map-tab">B2</div>
                    <div class="map-tab">L1</div>
                    <div class="map-tab">L2</div>
                </div>
                <div class="parking-slots">
                    <div class="slot available">A01</div>
                    <div class="slot occupied">A02</div>
                    <div class="slot available">A03</div>
                    <div class="slot reserved">A04</div>
                    <div class="slot occupied">A05</div>
                    <div class="slot available">A06</div>
                    <div class="slot available">A07</div>
                    <div class="slot occupied">A08</div>
                    <div class="slot occupied">A09</div>
                    <div class="slot available">A10</div>
                </div>
                <div class="map-legend">
                    <div class="legend-item"><span class="indicator ind-success"></span> Available</div>
                    <div class="legend-item"><span class="indicator ind-danger"></span> Occupied</div>
                    <div class="legend-item"><span class="indicator ind-warning"></span> Reserved</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURE SECTION -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2>Designed for Modern Mobility</h2>
                <p>Everything you need for a frictionless parking experience, powered by enterprise-grade technology.</p>
            </div>
            <div class="features-container">
                <div class="feature-card">
                    <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7V4h16v3M4 17v3h16v-3M9 7v10M15 7v10"/></svg></div>
                    <h4>Ticketless Parking</h4>
                    <p class="text-small">Enter and exit without rolling down your window. Say goodbye to lost tickets and long queues.</p>
                </div>
                <div class="feature-card">
                    <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></div>
                    <h4>ANPR Recognition</h4>
                    <p class="text-small">Enterprise-grade AI cameras recognize your license plate instantly for seamless barrier access.</p>
                </div>
                <div class="feature-card">
                    <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                    <h4>Real-Time Availability</h4>
                    <p class="text-small">Check exactly how many parking spots are open before you even arrive at your destination.</p>
                </div>
                <div class="feature-card">
                    <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg></div>
                    <h4>Digital Payment</h4>
                    <p class="text-small">Pay automatically through the app using QRIS, e-Wallets, or linked credit cards securely.</p>
                </div>
                <div class="feature-card">
                    <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/></svg></div>
                    <h4>Smart Parking Map</h4>
                    <p class="text-small">View a detailed layout of the parking facility to locate your spot or your car easily.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- DRIVER BENEFITS -->
    <section class="section section-bg">
        <div class="container benefits-grid">
            <div class="benefits-visual"></div>
            <div>
                <h2>Why Drivers Choose NusaPark</h2>
                <p>We've eliminated every pain point of traditional parking, giving you more time for what matters.</p>
                <div class="benefits-list">
                    <div class="benefit-item">
                        <div class="benefit-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <div>
                            <h5>Easy parking discovery</h5>
                            <p class="text-small">Find parking options near your destination in seconds.</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <div>
                            <h5>Real-time availability</h5>
                            <p class="text-small">Never arrive at a full parking lot again.</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <div>
                            <h5>Ticketless experience</h5>
                            <p class="text-small">Roll in and out smoothly with AI-powered plate recognition.</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <div>
                            <h5>Digital payment</h5>
                            <p class="text-small">Cashless, fast, and transparent billing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NATIONAL SCALE -->
    <section class="national-scale">
        <svg class="map-graphic" viewBox="0 0 800 400" fill="currentColor">
            <!-- Simplified abstract dots map pattern to represent Indonesia -->
            <circle cx="200" cy="200" r="4"/><circle cx="220" cy="210" r="4"/><circle cx="240" cy="230" r="4"/>
            <circle cx="300" cy="250" r="4"/><circle cx="320" cy="260" r="4"/><circle cx="340" cy="255" r="4"/>
            <circle cx="400" cy="280" r="4"/><circle cx="420" cy="270" r="4"/><circle cx="450" cy="290" r="4"/>
            <circle cx="500" cy="250" r="4"/><circle cx="520" cy="240" r="4"/><circle cx="550" cy="220" r="4"/>
            <circle cx="600" cy="180" r="4"/><circle cx="620" cy="190" r="4"/><circle cx="650" cy="170" r="4"/>
            <circle cx="700" cy="200" r="4"/><circle cx="720" cy="210" r="4"/><circle cx="750" cy="230" r="4"/>
        </svg>
        <div class="container">
            <h2 style="font-size: 3rem; margin-bottom: 24px;">One Parking Platform.<br>Connected Across Indonesia.</h2>
            <p style="font-size: 1.25rem; max-width: 600px; margin: 0 auto;">NusaPark is transforming urban mobility nationwide. Join the network of smart cities today.</p>
        </div>
    </section>

    <!-- STATISTICS -->
    <section class="section">
        <div class="container stats-grid">
            <div class="stat-item">
                <h3>4,821</h3>
                <p>Locations</p>
            </div>
            <div class="stat-item">
                <h3>3.4M+</h3>
                <p>Parking Slots</p>
            </div>
            <div class="stat-item">
                <h3>8.9M+</h3>
                <p>Vehicles Today</p>
            </div>
            <div class="stat-item">
                <h3>12M+</h3>
                <p>Transactions</p>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section section-bg" id="faq">
        <div class="container">
            <div class="section-header">
                <h2>Common Questions</h2>
                <p>Everything you need to know about parking with NusaPark.</p>
            </div>
            <div class="faq-container">
                <details class="faq-item">
                    <summary class="faq-summary">How does ticketless parking work?</summary>
                    <div class="faq-content">Our advanced ANPR (Automatic Number Plate Recognition) cameras scan your license plate as you approach the barrier. If your vehicle is registered or you have the app active, the barrier opens automatically within milliseconds.</div>
                </details>
                <details class="faq-item">
                    <summary class="faq-summary">Is my payment information secure?</summary>
                    <div class="faq-content">Yes. We use bank-level encryption and do not store your raw credit card data. All transactions are processed through certified national payment gateways.</div>
                </details>
                <details class="faq-item">
                    <summary class="faq-summary">How accurate is the real-time availability?</summary>
                    <div class="faq-content">Our data is updated every 3 seconds directly from the parking facility's smart sensors and exit/entry cameras, ensuring 99.9% accuracy on slot availability.</div>
                </details>
                <details class="faq-item">
                    <summary class="faq-summary">Can I reserve a parking spot in advance?</summary>
                    <div class="faq-content">Yes, at participating locations. You can reserve a spot up to 24 hours in advance through the NusaPark app for a premium fee.</div>
                </details>
                <details class="faq-item">
                    <summary class="faq-summary">What happens if the ANPR camera can't read my plate?</summary>
                    <div class="faq-content">If your plate is dirty or unreadable, you can generate a QR code from the app and scan it at the terminal to open the barrier seamlessly.</div>
                </details>
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <a href="/faq" class="btn btn-secondary">View All FAQs</a>
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="final-cta">
        <div class="container">
            <h2>Make every parking journey simpler.</h2>
            <div class="cta-group">
                <a href="/search" class="btn btn-primary">Find Parking</a>
                <a href="/locations" class="btn btn-secondary">Explore Locations</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer />

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Simple animation for the hero barrier
        setTimeout(() => {
            const barrier = document.getElementById('hero-barrier');
            if(barrier) {
                barrier.style.transform = 'rotate(90deg)';
                
                // Reset and repeat for looping effect
                setInterval(() => {
                    barrier.style.transform = 'rotate(0deg)';
                    setTimeout(() => {
                        barrier.style.transform = 'rotate(90deg)';
                    }, 2000);
                }, 5000);
            }
        }, 1000);

        // Map tab interaction
        const mapTabs = document.querySelectorAll('.map-tab');
        mapTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                mapTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                // Normally this would filter or update the map content
            });
        });
        
        // Accordion functionality is handled natively by HTML <details>
    </script>
</body>
</html>
