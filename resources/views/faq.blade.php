<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ & Support - NusaPark</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="faq-page-body">

    <!-- NAVBAR (Reused) -->
    <x-navbar active="faq" />

    <!-- HERO & SEARCH -->
    <section class="faq-hero">
        <div class="container">
            <h1>How can we help?</h1>
            <p>Find quick answers about parking, payments, locations, reservations, and your NusaPark experience.</p>
            
            <div class="faq-search-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" id="faqSearchInput" class="faq-search-input" placeholder="Search questions..." oninput="handleSearch()">
            </div>
            
            <div class="faq-search-suggestions">
                <button class="faq-suggest-btn" onclick="setSearch('How is parking calculated')">"How is parking calculated?"</button>
                <button class="faq-suggest-btn" onclick="setSearch('payment methods')">"What payment methods..."</button>
                <button class="faq-suggest-btn" onclick="setSearch('gate didn\\'t open')">"Why didn't the gate open?"</button>
            </div>
        </div>
    </section>

    <!-- MAIN LAYOUT -->
    <section class="faq-main-section">
        <div class="container">
            <div class="faq-container">
                
                <!-- Category Nav -->
                <div class="faq-nav-container">
                    <div class="faq-category-nav" id="categoryNav">
                        <button class="faq-cat-btn active" onclick="setCategory('all', this)">All Questions</button>
                        <button class="faq-cat-btn" onclick="setCategory('getting-started', this)">Getting Started</button>
                        <button class="faq-cat-btn" onclick="setCategory('find-parking', this)">Find Parking</button>
                        <button class="faq-cat-btn" onclick="setCategory('pricing', this)">Pricing</button>
                        <button class="faq-cat-btn" onclick="setCategory('enter-exit', this)">Enter & Exit</button>
                        <button class="faq-cat-btn" onclick="setCategory('payment', this)">Payment</button>
                        <button class="faq-cat-btn" onclick="setCategory('reservations', this)">Reservations</button>
                        <button class="faq-cat-btn" onclick="setCategory('account', this)">Account</button>
                        <button class="faq-cat-btn" onclick="setCategory('technical', this)">Technical Help</button>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="faq-content-area">
                    
                    <!-- Featured (Only shown when searching 'all' with no text) -->
                    <div id="featuredSection" class="featured-questions">
                        <h2 class="faq-section-title">Popular questions</h2>
                        <div class="featured-grid">
                            <button class="featured-card" onclick="openFaq('faq-05')">
                                How is my parking fee calculated?
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                            <button class="featured-card" onclick="openFaq('faq-09')">
                                What payment methods does NusaPark support?
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                            <button class="featured-card" onclick="openFaq('faq-08')">
                                What happens when I enter?
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                            <button class="featured-card" onclick="openFaq('faq-02')">
                                How do I find a parking location?
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Dynamic List Header -->
                    <div class="faq-section-header" id="listHeader">
                        <h2 class="faq-section-title" id="listTitle">All Questions</h2>
                        <div class="faq-section-desc" id="listDesc">Browse all available frequently asked questions.</div>
                        <div class="faq-result-count" id="resultCount" style="display:none;"></div>
                    </div>

                    <!-- List Container -->
                    <div class="faq-accordion-list" id="faqList">
                        <!-- Populated by JS -->
                    </div>

                    <!-- Empty State -->
                    <div class="faq-empty-state" id="emptyState" style="display:none;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <h3>We couldn't find an answer for that.</h3>
                        <p>No questions matched your search criteria. Try using different keywords.</p>
                        <div class="faq-empty-actions">
                            <button class="btn btn-primary" onclick="setSearch('')">Clear Search</button>
                            <a href="/search" class="btn btn-secondary">Find Parking</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="faq-help-cta">
        <div class="container">
            <h2>Still looking for something?</h2>
            <p>Explore NusaPark or start by finding a parking location.</p>
            <div style="display: flex; gap: 16px; justify-content: center;">
                <a href="/search" class="btn btn-secondary">Find Parking</a>
                <a href="/how-it-works" class="btn btn-secondary" style="background:transparent; color:white;">How It Works</a>
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
        // Structured FAQ Data
        const faqData = [
            {
                id: 'faq-01',
                category: 'getting-started',
                question: 'What is NusaPark?',
                answer: '<p>NusaPark is a smart parking platform that helps users discover and use parking facilities seamlessly across Indonesia. We connect various property infrastructure to provide a unified parking experience.</p>',
                keywords: ['about', 'platform', 'definition']
            },
            {
                id: 'faq-02',
                category: 'find-parking',
                question: 'How do I find a parking location?',
                answer: '<p>You can discover locations by using the <a href="/search">Search Parking</a> feature to find a specific destination, or browse available facilities on the <a href="/locations">Locations</a> page. You can check location information, pricing, and availability before you arrive.</p>',
                keywords: ['search', 'location', 'discover', 'where']
            },
            {
                id: 'faq-03',
                category: 'find-parking',
                question: 'Can I see available parking spaces?',
                answer: '<p>Where supported, NusaPark can display current parking availability in real-time. This feature depends on the specific parking facility\'s hardware and connectivity.</p>',
                keywords: ['availability', 'full', 'empty', 'slots', 'real-time']
            },
            {
                id: 'faq-04',
                category: 'pricing',
                question: 'Are parking rates the same everywhere?',
                answer: '<p>No. Applicable rates can vary significantly by parking location and configured vehicle/category rules (such as VIP or EV). Always <a href="/pricing">check the pricing</a> specific to your destination.</p>',
                keywords: ['price', 'cost', 'expensive', 'cheap', 'tariff', 'rates']
            },
            {
                id: 'faq-05',
                category: 'pricing',
                question: 'How is my parking fee calculated?',
                answer: '<p>Fees are generally calculated based on your parking duration, selected vehicle category, and the applicable location tariff rules. Special conditions like daily maximums or event rates may apply where configured.</p>',
                keywords: ['calculate', 'math', 'total', 'bill', 'duration']
            },
            {
                id: 'faq-06',
                category: 'pricing',
                question: 'Why can the estimated price differ from the final charge?',
                answer: '<p>Our estimator provides a projection based on the duration you input. Real-world traffic, delays in exiting the facility, or passing into a new billing hour threshold can alter the final recorded duration and charge.</p>',
                keywords: ['estimate', 'wrong', 'differ', 'charge', 'different']
            },
            {
                id: 'faq-07',
                category: 'enter-exit',
                question: 'How does vehicle recognition work?',
                answer: '<p>A vehicle recognition system (like ANPR) can automatically identify your vehicle at supported entrances and exits. This helps process the parking session quickly without manual ticketing.</p>',
                keywords: ['camera', 'anpr', 'license', 'plate', 'recognition', 'scan']
            },
            {
                id: 'faq-08',
                category: 'enter-exit',
                question: 'What happens when I enter?',
                answer: '<p>As your vehicle arrives, it is recognized (where supported). The entry is processed, a parking session is initiated, and the barrier opens automatically to let you in.</p>',
                keywords: ['enter', 'arrival', 'barrier', 'gate', 'open']
            },
            {
                id: 'faq-09',
                category: 'payment',
                question: 'What payment methods does NusaPark support?',
                answer: '<p>NusaPark systems support various methods including QRIS, E-wallet, NFC, Electronic cards, and Auto payment. <strong>Available payment methods depend on the specific parking location.</strong></p>',
                keywords: ['pay', 'qris', 'ewallet', 'nfc', 'card', 'cashless', 'method']
            },
            {
                id: 'faq-10',
                category: 'payment',
                question: 'My payment failed. What should I do?',
                answer: '<p>1. Check your app or wallet transaction status.<br>2. Do not immediately repeat the payment if the first transaction is still processing.<br>3. Try an alternative available payment method.<br>4. Follow on-site instructions or seek parking staff assistance if the issue occurs at the gate.</p>',
                keywords: ['fail', 'error', 'declined', 'stuck', 'payment']
            },
            {
                id: 'faq-11',
                category: 'reservations',
                question: 'Can I reserve a parking space?',
                answer: '<p>Reservation availability depends heavily on the parking location and product configuration. Standard parking usually does not require reservation, while specialized slots (like EV charging) might support it where configured.</p>',
                keywords: ['book', 'reserve', 'guarantee', 'slot']
            },
            {
                id: 'faq-12',
                category: 'account',
                question: 'Do I need to log in?',
                answer: '<p>Public features like searching locations and estimating prices are available without logging in. However, managing your vehicles, tracking sessions, and using auto-payment require an authenticated account.</p>',
                keywords: ['login', 'register', 'account', 'sign up']
            },
            {
                id: 'faq-13',
                category: 'technical',
                question: 'The parking map is not loading.',
                answer: '<p>Check your internet connection, refresh the location data, or try again shortly. Our systems use local edge processing for core gate operations, but map rendering requires cloud connectivity.</p>',
                keywords: ['map', 'load', 'blank', 'error', 'broken', 'technical']
            },
            {
                id: 'faq-14',
                category: 'enter-exit',
                question: 'Why didn\'t the barrier open?',
                answer: '<p>This could be due to a vehicle recognition issue, an unverified payment status, or a temporary facility condition. Follow the instructions displayed on the local screen and contact on-site assistance where available.</p>',
                keywords: ['stuck', 'barrier', 'gate', 'closed', 'not opening']
            }
        ];

        const catDescriptions = {
            'all': 'Browse all available frequently asked questions.',
            'getting-started': 'Basic information about using the NusaPark platform.',
            'find-parking': 'Learn how to search for locations and check availability.',
            'pricing': 'Understand how rates are calculated and estimated.',
            'enter-exit': 'Learn about vehicle recognition, gates, and parking sessions.',
            'payment': 'Information on supported cashless methods and troubleshooting.',
            'reservations': 'Questions regarding slot booking where supported.',
            'account': 'Managing your profile, vehicles, and notifications.',
            'technical': 'Troubleshooting app or website service issues.'
        };

        const catTitles = {
            'all': 'All Questions',
            'getting-started': 'Getting Started',
            'find-parking': 'Find Parking',
            'pricing': 'Pricing',
            'enter-exit': 'Enter & Exit',
            'payment': 'Payment',
            'reservations': 'Reservations',
            'account': 'Account',
            'technical': 'Technical Help'
        };

        let activeCategory = 'all';
        let searchQuery = '';

        function renderFaq() {
            const listContainer = document.getElementById('faqList');
            const emptyState = document.getElementById('emptyState');
            const featuredSec = document.getElementById('featuredSection');
            const listHeader = document.getElementById('listHeader');
            const resultCount = document.getElementById('resultCount');
            
            // Filter logic
            const q = searchQuery.toLowerCase().trim();
            const filtered = faqData.filter(item => {
                const matchCat = activeCategory === 'all' || item.category === activeCategory;
                const matchSearch = q === '' || 
                                    item.question.toLowerCase().includes(q) || 
                                    item.answer.toLowerCase().includes(q) ||
                                    item.keywords.some(k => k.toLowerCase().includes(q));
                return matchCat && matchSearch;
            });

            // UI State Management
            if(q === '' && activeCategory === 'all') {
                featuredSec.style.display = 'block';
                listHeader.style.display = 'block';
                resultCount.style.display = 'none';
            } else {
                featuredSec.style.display = 'none';
                listHeader.style.display = 'block';
                if(q !== '') {
                    resultCount.style.display = 'inline-block';
                    resultCount.textContent = `${filtered.length} result${filtered.length !== 1 ? 's' : ''} found`;
                } else {
                    resultCount.style.display = 'none';
                }
            }

            document.getElementById('listTitle').textContent = catTitles[activeCategory];
            document.getElementById('listDesc').textContent = q !== '' ? `Search results for "${searchQuery}"` : catDescriptions[activeCategory];

            listContainer.innerHTML = '';
            
            if(filtered.length === 0) {
                listHeader.style.display = 'none';
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
                
                filtered.forEach(item => {
                    const el = document.createElement('div');
                    el.className = 'faq-item';
                    el.id = item.id;
                    
                    // Simple highlighting logic for title
                    let displayTitle = item.question;
                    if(q !== '') {
                        const regex = new RegExp(`(${q})`, 'gi');
                        displayTitle = displayTitle.replace(regex, '<span class="highlight-match">$1</span>');
                    }

                    el.innerHTML = `
                        <button class="faq-question" onclick="toggleAccordion(this)" aria-expanded="false" aria-controls="ans-${item.id}">
                            <span>${displayTitle}</span>
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="faq-answer" id="ans-${item.id}">
                            ${item.answer}
                        </div>
                    `;
                    listContainer.appendChild(el);
                });
            }
        }

        function toggleAccordion(btnElem) {
            const item = btnElem.parentElement;
            const isOpen = item.classList.contains('open');
            
            // Optional: Close others (accordion behavior)
            // document.querySelectorAll('.faq-item').forEach(i => {
            //     i.classList.remove('open');
            //     i.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
            // });

            if(!isOpen) {
                item.classList.add('open');
                btnElem.setAttribute('aria-expanded', 'true');
            } else {
                item.classList.remove('open');
                btnElem.setAttribute('aria-expanded', 'false');
            }
        }

        function setCategory(cat, btnElem) {
            activeCategory = cat;
            document.querySelectorAll('.faq-cat-btn').forEach(b => b.classList.remove('active'));
            if(btnElem) {
                btnElem.classList.add('active');
            } else {
                // Find matching btn if called programmatically
                const btns = document.querySelectorAll('.faq-cat-btn');
                btns.forEach(b => {
                    if(b.textContent.toLowerCase().replace(' & ', '-').replace(' ', '-') === cat) b.classList.add('active');
                });
            }
            renderFaq();
        }

        function handleSearch() {
            searchQuery = document.getElementById('faqSearchInput').value;
            renderFaq();
        }

        function setSearch(val) {
            document.getElementById('faqSearchInput').value = val;
            searchQuery = val;
            renderFaq();
        }

        function openFaq(id) {
            setSearch('');
            setCategory('all', document.querySelector('.faq-cat-btn'));
            setTimeout(() => {
                const el = document.getElementById(id);
                if(el) {
                    el.classList.add('open');
                    el.querySelector('.faq-question').setAttribute('aria-expanded', 'true');
                    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 100);
        }

        // Initial render
        renderFaq();
    </script>
</body>
</html>
