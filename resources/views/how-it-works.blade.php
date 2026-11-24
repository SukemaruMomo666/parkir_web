<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How It Works - NusaPark</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/how-it-works.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hiw-page-body">

    <!-- NAVBAR (Reused) -->
    <x-navbar active="how-it-works" />

    <!-- HERO -->
    <section class="hiw-hero">
        <div class="container">
            <div class="hiw-hero-grid">
                <div class="hiw-hero-content">
                    <h1>Parking, made simple.</h1>
                    <p>From finding a parking spot to leaving the facility, NusaPark connects every step into one smarter parking experience.</p>
                    <div class="hiw-hero-actions">
                        <a href="/search" class="btn btn-primary">Find Parking</a>
                        <a href="/locations" class="btn btn-secondary">Explore Locations</a>
                    </div>
                </div>
                <div class="hiw-hero-visual">
                    <div class="journey-preview-nodes">
                        <div class="journey-preview-line"></div>
                        <div class="journey-preview-node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
                        <div class="journey-preview-node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg></div>
                        <div class="journey-preview-node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                        <div class="journey-preview-node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- OVERVIEW -->
    <section class="journey-overview">
        <div class="container">
            <h2>Your parking journey in six simple steps.</h2>
            <div class="overview-grid">
                <div class="overview-card" onclick="scrollToStep('step-01')">
                    <div class="overview-card-num">01</div>
                    <h3>Find</h3>
                    <p>Search for nearby parking locations and check real-time availability before you depart.</p>
                </div>
                <div class="overview-card" onclick="scrollToStep('step-02')">
                    <div class="overview-card-num">02</div>
                    <h3>Arrive</h3>
                    <p>Follow navigation directly to your selected parking location's exact entrance.</p>
                </div>
                <div class="overview-card" onclick="scrollToStep('step-03')">
                    <div class="overview-card-num">03</div>
                    <h3>Enter</h3>
                    <p>Vehicle recognition and entry systems identify your vehicle instantly.</p>
                </div>
                <div class="overview-card" onclick="scrollToStep('step-04')">
                    <div class="overview-card-num">04</div>
                    <h3>Park</h3>
                    <p>Find an available parking space easily and park your vehicle securely.</p>
                </div>
                <div class="overview-card" onclick="scrollToStep('step-05')">
                    <div class="overview-card-num">05</div>
                    <h3>Pay</h3>
                    <p>Complete your parking payment using one of many available cashless methods.</p>
                </div>
                <div class="overview-card" onclick="scrollToStep('step-06')">
                    <div class="overview-card-num">06</div>
                    <h3>Exit</h3>
                    <p>Status is verified automatically and the barrier opens for a seamless exit.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- DETAILED STEPS -->
    
    <!-- STEP 01 -->
    <section class="step-section" id="step-01">
        <div class="container">
            <div class="step-grid">
                <div class="step-text">
                    <h2>1. Find a parking location</h2>
                    <p>Don't waste time circling blocks. You can search for parking based on your destination, checking availability and price before you even leave.</p>
                    <ul>
                        <li><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Search by location or destination name</li>
                        <li><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> View real-time slot availability</li>
                        <li><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Check transparent pricing upfront</li>
                    </ul>
                    <a href="/search" class="btn btn-secondary">Search Parking</a>
                </div>
                <div class="step-visual">
                    <div class="ui-mock">
                        <div class="ui-mock-header">NusaPark App Preview</div>
                        <div class="ui-mock-body">
                            <div class="mock-search-bar">Search destination...</div>
                            <div style="display:flex; flex-direction:column; gap:12px;">
                                <div class="mock-loc-card">
                                    <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                                        <div>
                                            <div class="mock-loc-title">Mall XYZ Parking</div>
                                            <div style="font-size:0.75rem; color:var(--text-muted);">0.8 km away</div>
                                        </div>
                                        <div class="mock-loc-badge">324 Available</div>
                                    </div>
                                    <div style="font-size:0.75rem; color:var(--primary); font-weight:600;">Rp 5.000 / hr</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STEP 02 -->
    <section class="step-section" id="step-02">
        <div class="container">
            <div class="step-grid reverse">
                <div class="step-text">
                    <h2>2. Arrive at the parking location</h2>
                    <p>Transition smoothly from digital discovery to physical parking. Check the entrance information before you arrive.</p>
                    <ul>
                        <li><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Get exact entrance coordinates</li>
                        <li><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Verify open/closed operating status</li>
                    </ul>
                </div>
                <div class="step-visual">
                    <div class="ui-mock" style="background:#F8FAFC;">
                        <img src="https://images.unsplash.com/photo-1590674899484-d5640e854abe?auto=format&fit=crop&q=80&w=600" alt="Arrival Map Mock" style="width:100%; height:160px; object-fit:cover; border-bottom:1px solid var(--border);">
                        <div class="ui-mock-body">
                            <div style="font-size:0.75rem; font-weight:600; color:var(--success); margin-bottom:4px; text-transform:uppercase;">Open Now</div>
                            <div style="font-weight:600; color:var(--primary); margin-bottom:12px;">Main Entrance (Gate A)</div>
                            <button class="btn btn-primary" style="width:100%; padding:8px; font-size:0.875rem;">Navigate Here</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STEP 03 -->
    <section class="step-section" id="step-03">
        <div class="container">
            <div class="step-grid">
                <div class="step-text">
                    <h2>3. Enter without unnecessary friction</h2>
                    <p>As you approach, vehicle recognition and entry systems detect your vehicle, processing your entry and opening the barrier securely.</p>
                    <ul>
                        <li><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Automated License Plate Recognition (ANPR)</li>
                        <li><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Instant entry processing</li>
                    </ul>
                </div>
                <div class="step-visual">
                    <div class="mock-gate">
                        <div style="font-size:0.875rem; font-weight:600; color:var(--text-muted); margin-bottom:16px; text-transform:uppercase;">Vehicle Detected</div>
                        <div class="mock-plate">B 1234 XYZ</div>
                        <div class="mock-gate-status">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Entry Confirmed
                        </div>
                        <div class="mock-barrier"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STEP 04 -->
    <section class="step-section" id="step-04">
        <div class="container">
            <div class="step-grid reverse">
                <div class="step-text">
                    <h2>4. Find your parking space</h2>
                    <p>Once inside, digital mapping helps you locate available parking spaces, including specialized slots like EV charging or Accessible parking.</p>
                    <a href="/parking-map" class="btn btn-secondary">View Parking Map</a>
                </div>
                <div class="step-visual">
                    <div class="ui-mock">
                        <div class="ui-mock-body">
                            <div style="display:flex; justify-content:space-between; margin-bottom:16px;">
                                <div style="font-weight:600; color:var(--primary);">Floor B1 — Zone A</div>
                                <div style="font-size:0.75rem; font-weight:600; color:var(--success);">18 Available</div>
                            </div>
                            <div style="display:flex; gap:8px;">
                                <div style="flex:1; height:60px; border:2px solid var(--border); border-radius:4px; display:flex; align-items:center; justify-content:center; color:var(--text-muted); font-size:0.75rem;">A-23 (Occ)</div>
                                <div style="flex:1; height:60px; border:2px solid var(--success); background:#F0FDF4; border-radius:4px; display:flex; align-items:center; justify-content:center; color:var(--success); font-weight:700;">A-24</div>
                                <div style="flex:1; height:60px; border:2px solid var(--border); border-radius:4px; display:flex; align-items:center; justify-content:center; color:var(--text-muted); font-size:0.75rem;">A-25 (Occ)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SESSION INTERJECTION -->
    <section style="padding: 64px 0; background: var(--background);">
        <div class="container" style="display:flex; flex-direction:column; align-items:center; text-align:center;">
            <h3 style="font-size:1.5rem; color:var(--primary); margin-bottom:16px;">Your parking session stays connected.</h3>
            <p style="font-size:1rem; color:var(--text-muted); max-width:600px; margin-bottom:32px;">Once your vehicle enters, the parking session is securely associated with your vehicle event and used to determine the exact parking charge.</p>
            
            <div class="mock-session-card" style="width:100%; max-width:400px; text-align:left;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div style="font-weight:600; font-size:1.125rem;">Parking Session</div>
                    <div class="session-status">Active</div>
                </div>
                <div class="session-row"><span>Location</span><span>NusaPark Sample Location</span></div>
                <div class="session-row"><span>Vehicle</span><span>B 1234 XYZ</span></div>
                <div class="session-row"><span>Entry Time</span><span>10:32 AM</span></div>
                <div class="session-row"><span>Duration</span><span>1h 24m</span></div>
            </div>
        </div>
    </section>

    <!-- STEP 05 -->
    <section class="step-section" id="step-05">
        <div class="container">
            <div class="step-grid">
                <div class="step-text">
                    <h2>5. Pay your parking fee</h2>
                    <p>Complete payment effortlessly using available cashless methods. Available payment methods depend on the specific parking location.</p>
                    <a href="/pricing" class="btn btn-secondary">View Pricing</a>
                </div>
                <div class="step-visual">
                    <div class="ui-mock" style="text-align:center; padding:32px 16px;">
                        <div style="font-size:0.875rem; color:var(--text-muted); margin-bottom:8px;">Parking Fee</div>
                        <div style="font-size:2.5rem; font-weight:700; color:var(--primary); margin-bottom:24px;">Rp 12.000</div>
                        <div style="display:inline-flex; align-items:center; gap:8px; background:var(--success-bg); color:#065F46; padding:8px 16px; border-radius:100px; font-weight:600; font-size:0.875rem;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Payment Successful
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STEP 06 -->
    <section class="step-section" id="step-06">
        <div class="container">
            <div class="step-grid reverse">
                <div class="step-text">
                    <h2>6. Exit when you're ready</h2>
                    <p>Your payment and session status is verified instantly at the exit. The barrier opens, concluding your seamless parking experience.</p>
                </div>
                <div class="step-visual">
                    <div style="display:flex; flex-direction:column; gap:16px;">
                        <div style="display:flex; align-items:center; gap:12px; font-weight:600; color:var(--success);">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Session verified
                        </div>
                        <div style="display:flex; align-items:center; gap:12px; font-weight:600; color:var(--success);">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Payment confirmed
                        </div>
                        <div style="display:flex; align-items:center; gap:12px; font-weight:600; color:var(--success);">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Exit authorized
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONNECTED TIMELINE VISUAL -->
    <section class="timeline-section">
        <div class="container">
            <h2>One connected parking experience.</h2>
            <div class="full-journey-timeline">
                <div class="full-journey-line"></div>
                <div class="full-journey-progress"></div>
                
                <div class="fj-node" onclick="scrollToStep('step-01')">
                    <div class="fj-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
                    <span class="fj-label">Search</span>
                </div>
                <div class="fj-node" onclick="scrollToStep('step-02')">
                    <div class="fj-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg></div>
                    <span class="fj-label">Arrive</span>
                </div>
                <div class="fj-node" onclick="scrollToStep('step-03')">
                    <div class="fj-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg></div>
                    <span class="fj-label">Enter</span>
                </div>
                <div class="fj-node" onclick="scrollToStep('step-04')">
                    <div class="fj-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M5 10L7 5h10l2 5"/><circle cx="7" cy="18" r="1.5"/><circle cx="17" cy="18" r="1.5"/></svg></div>
                    <span class="fj-label">Park</span>
                </div>
                <div class="fj-node" onclick="scrollToStep('step-05')">
                    <div class="fj-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><rect x="7" y="7" width="3" height="3"/><rect x="14" y="7" width="3" height="3"/><rect x="7" y="14" width="3" height="3"/><rect x="14" y="14" width="3" height="3"/></svg></div>
                    <span class="fj-label">Pay</span>
                </div>
                <div class="fj-node" onclick="scrollToStep('step-06')">
                    <div class="fj-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg></div>
                    <span class="fj-label">Exit</span>
                </div>
            </div>
        </div>
    </section>

    <!-- TECHNOLOGY & CONNECTIVITY -->
    <section class="tech-section">
        <div class="container">
            <div class="tech-header">
                <h2>Smart technology working in the background.</h2>
            </div>
            <div class="tech-grid">
                <div class="tech-card">
                    <h4><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="12" cy="12" r="3"/></svg> Vehicle Recognition</h4>
                    <p>Advanced systems help identify vehicles accurately at entry and exit points to ensure seamless flow.</p>
                </div>
                <div class="tech-card">
                    <h4><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Parking Session</h4>
                    <p>Intelligently tracks your active parking session duration to accurately compute applicable tariffs.</p>
                </div>
                <div class="tech-card">
                    <h4><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg> Payment Connect</h4>
                    <p>Connects the parking session with local payment gateways for rapid authorization.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="connectivity-section">
        <div class="container">
            <div class="conn-card">
                <div class="conn-visual">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg>
                </div>
                <div class="conn-text">
                    <h3>Designed for real-world parking environments.</h3>
                    <p>Where supported, local processing can help keep critical on-site operations responsive during temporary connectivity disruptions, ensuring you can still enter and exit the facility.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TROUBLESHOOTING -->
    <section class="troubleshooting">
        <div class="container">
            <h2>Need help?</h2>
            <div class="trouble-grid">
                <div class="trouble-card">
                    <h4><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> Vehicle not detected</h4>
                    <p>Follow the on-site instructions or contact parking support using the intercom button at the gate.</p>
                </div>
                <div class="trouble-card">
                    <h4><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> Gate does not open</h4>
                    <p>Wait a moment for the system response, or follow the facility's manual backup procedures.</p>
                </div>
                <div class="trouble-card">
                    <h4><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> Payment issue</h4>
                    <p>Check your app/wallet payment status. If it fails, try a different available payment method.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- GUIDANCE -->
    <section class="driver-guidance">
        <div class="container">
            <h2>A few things to remember.</h2>
            <div class="guidance-list">
                <div class="guidance-item">Follow on-site traffic signs</div>
                <div class="guidance-item">Park only in designated spaces</div>
                <div class="guidance-item">Use EV/VIP spaces according to rules</div>
                <div class="guidance-item">Check displayed parking info</div>
                <div class="guidance-item">Keep payment info accessible</div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="hiw-faq" id="faq">
        <div class="container">
            <h2>Frequently asked questions</h2>
            <div class="accordion">
                <div class="accordion-item open">
                    <button class="accordion-header" onclick="toggleFaq(this)">
                        How does NusaPark identify my vehicle?
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-content">
                        Depending on the facility's equipment, we use ANPR (Automatic Number Plate Recognition) cameras or card tap systems to securely detect and log your vehicle upon entry.
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleFaq(this)">
                        Do I need to reserve a parking space?
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-content">
                        No, reservation is not required for standard parking. You can just drive in. However, certain VIP or EV slots may support reservation features depending on the location.
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleFaq(this)">
                        What happens if my payment fails?
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-content">
                        You can simply attempt the payment again, or choose an alternative payment method provided at the exit gate or within the app.
                    </div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 24px;">
                <a href="#" style="color: var(--primary); font-weight: 600; font-size: 0.875rem;">View All FAQs →</a>
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="final-cta">
        <div class="container">
            <h2>Ready to park smarter?</h2>
            <p>Find a parking location, check availability, and get on your way.</p>
            <div style="display: flex; gap: 16px; justify-content: center;">
                <a href="/search" class="btn btn-primary">Find Parking</a>
                <a href="/locations" class="btn btn-secondary">Explore Locations</a>
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
                        <li><a href="/pricing">Pricing</a></li>
                        <li><a href="#">App Download</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 NusaPark. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script>
        // Smooth scroll for overview cards and timeline nodes
        function scrollToStep(stepId) {
            const el = document.getElementById(stepId);
            if(el) {
                const navbarHeight = 72;
                const offset = el.getBoundingClientRect().top + window.scrollY - navbarHeight;
                window.scrollTo({ top: offset, behavior: 'smooth' });
            }
        }

        // FAQ Toggle
        function toggleFaq(btn) {
            const item = btn.parentElement;
            item.classList.toggle('open');
        }
    </script>
</body>
</html>
