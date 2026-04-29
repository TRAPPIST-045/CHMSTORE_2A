<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE • Sales Reports</title>
    <!-- SAME CSS FILE AS ALL OTHER ADMIN PAGES (dark modern theme) -->
    <link rel="stylesheet" href="assets/css/adminDashboard.css">
</head>
<body>

    <!-- SIDEBAR – EXACT SAME, ONLY "Sales Reports" IS ACTIVE -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="assets/images/chmstoreLogo.png" alt="CHMSTORE" class="logo-img">
        </div>
        
        <ul class="nav-menu">
            <li>
                <a href="adminDashboard.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1v-5m10-10l2 2m-2-2v10a1 1 0 01-1 1v-5m-6 0a1 1 0 001-1v5" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="adminProducts.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="adminOrders.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a href="adminInventory.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 01-2-2H6a2 2 0 01-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-4" />
                    </svg>
                    <span>Inventory</span>
                </a>
            </li>
            <li>
                <a href="adminSalesReports.php" class="active">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-9 9-4-4-6 6" />
                    </svg>
                    <span>Sales Reports</span>
                </a>
            </li>
            <li>
                <a href="adminCustomers.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 01-5.356-1.857M17 20H7m5-2v-2c0-.656-.126-1.284-.356-1.852M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.284.356-1.852m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a href="adminSettings.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 002.573-1.066c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 00.817 1.194 1.724 1.724 0 01.817 1.194c-.94 1.543.827 3.31 2.37 2.37.426 1.756 2.924 1.756 3.35 0a1.724 1.724 0 00.817 1.194" />
                    </svg>
                    <span>Settings</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            CHMSTORE ADMIN<br>
            <span>v3.1 • LIVE • Bacolod City</span>
        </div>
    </aside>

    <!-- TOPBAR – EXACT SAME STYLE -->
    <header class="topbar">
        <div class="topbar-left">
            <h1 class="topbar-title">Sales Reports</h1>
            
            <div class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 01-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search reports by date or product...">
            </div>
        </div>

        <div class="topbar-right">
            <div class="notification">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-9-5.197V8.5" />
                </svg>
                <span class="notification-dot">3</span>
            </div>

            <div class="user-profile">
                <div class="user-text">
                    <div class="user-name">Mia Park</div>
                    <div class="user-role">Super Admin</div>
                </div>
                <div class="avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7" />
                    </svg>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- PAGE HEADER -->
        <div class="section" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
            <h2 style="margin:0; font-size:28px;">Sales Overview • March 2026</h2>
            <button class="reorder-btn" style="font-size:15px; padding:12px 28px; border-radius:9999px;">
                📥 Export Report (PDF/Excel)
            </button>
        </div>

        <!-- KPI SUMMARY CARDS -->
        <div class="kpi-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom:32px;">
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 4.01V8" />
                    </svg>
                </div>
                <div class="kpi-value">₱1,284,650</div>
                <div class="kpi-label">Total Revenue • March</div>
                <div class="kpi-change positive">↑ 18% from last month</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="kpi-value">1,284</div>
                <div class="kpi-label">Total Orders</div>
                <div class="kpi-change positive">↑ 9% from last month</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-1m-6 0h-2" />
                    </svg>
                </div>
                <div class="kpi-value">₱2,498</div>
                <div class="kpi-label">Avg Order Value</div>
                <div class="kpi-change positive">↑ 4% from last month</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-9 9-4-4-6 6" />
                    </svg>
                </div>
                <div class="kpi-value">98.4%</div>
                <div class="kpi-label">Conversion Rate</div>
                <div class="kpi-change positive">↑ 2.1%</div>
            </div>
        </div>

        <!-- MAIN SALES CHART (LARGER & MORE DETAILED) -->
        <div class="section">
            <h3 class="section-title">Sales Trend — Last 30 Days</h3>
            <div class="chart-box">
                <svg class="sales-chart" id="salesChart" viewBox="0 0 1200 380" xmlns="http://www.w3.org/2000/svg">
                    <!-- Grid -->
                    <line x1="80" y1="60" x2="80" y2="320" stroke="#f1ede9" stroke-width="3"/>
                    <line x1="240" y1="60" x2="240" y2="320" stroke="#f1ede9" stroke-width="3"/>
                    <line x1="400" y1="60" x2="400" y2="320" stroke="#f1ede9" stroke-width="3"/>
                    <line x1="560" y1="60" x2="560" y2="320" stroke="#f1ede9" stroke-width="3"/>
                    <line x1="720" y1="60" x2="720" y2="320" stroke="#f1ede9" stroke-width="3"/>
                    <line x1="880" y1="60" x2="880" y2="320" stroke="#f1ede9" stroke-width="3"/>
                    <line x1="1040" y1="60" x2="1040" y2="320" stroke="#f1ede9" stroke-width="3"/>
                    
                    <line x1="80" y1="110" x2="1120" y2="110" stroke="#f1ede9" stroke-width="3"/>
                    <line x1="80" y1="180" x2="1120" y2="180" stroke="#f1ede9" stroke-width="3"/>
                    <line x1="80" y1="250" x2="1120" y2="250" stroke="#f1ede9" stroke-width="3"/>
                    
                    <!-- Gradient fill -->
                    <defs>
                        <linearGradient id="salesGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#f8498c" stop-opacity="0.25"/>
                            <stop offset="100%" stop-color="#f8498c" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <polyline id="salesFill" points="100,310 260,255 420,210 580,225 740,145 900,110 1060,130" fill="url(#salesGrad)" stroke="none"/>
                    
                    <!-- Line -->
                    <polyline id="salesLine" points="100,310 260,255 420,210 580,225 740,145 900,110 1060,130" fill="none" stroke="#f8498c" stroke-width="14" stroke-linejoin="round" stroke-linecap="round"/>
                    <polyline id="salesLineThin" points="100,310 260,255 420,210 580,225 740,145 900,110 1060,130" fill="none" stroke="#F07AAF" stroke-width="6" stroke-linejoin="round" stroke-linecap="round"/>
                    
                    <!-- Dots -->
                    <circle cx="100" cy="310" r="11" fill="#fff" stroke="#f8498c" stroke-width="7"/>
                    <circle cx="260" cy="255" r="11" fill="#fff" stroke="#f8498c" stroke-width="7"/>
                    <circle cx="420" cy="210" r="11" fill="#fff" stroke="#f8498c" stroke-width="7"/>
                    <circle cx="580" cy="225" r="11" fill="#fff" stroke="#f8498c" stroke-width="7"/>
                    <circle cx="740" cy="145" r="11" fill="#fff" stroke="#f8498c" stroke-width="7"/>
                    <circle cx="900" cy="110" r="11" fill="#fff" stroke="#f8498c" stroke-width="7"/>
                    <circle cx="1060" cy="130" r="11" fill="#fff" stroke="#f8498c" stroke-width="7"/>
                    
                    <!-- Labels -->
                    <text x="85" y="355" font-size="17" fill="#b0aeb4" font-family="SuperBlocky">MAR 03</text>
                    <text x="245" y="355" font-size="17" fill="#b0aeb4" font-family="SuperBlocky">MAR 10</text>
                    <text x="405" y="355" font-size="17" fill="#b0aeb4" font-family="SuperBlocky">MAR 17</text>
                    <text x="565" y="355" font-size="17" fill="#b0aeb4" font-family="SuperBlocky">MAR 24</text>
                    <text x="725" y="355" font-size="17" fill="#b0aeb4" font-family="SuperBlocky">MAR 31</text>
                    <text x="885" y="355" font-size="17" fill="#b0aeb4" font-family="SuperBlocky">APR 07</text>
                    <text x="1045" y="355" font-size="17" fill="#b0aeb4" font-family="SuperBlocky">APR 14</text>
                </svg>
            </div>
        </div>

        <!-- TOP SELLING PRODUCTS – REAL CHMSU PRODUCTS -->
        <div class="section">
            <h3 class="section-title">Top Selling Products • March</h3>
            <div class="product-grid">

                <!-- 1 -->
                <div class="product-card">
                    <div class="product-image" 
                         style="background-image: url('../public/assets/images/chmsuLegacyJournal.png'); 
                                background-size: contain; 
                                background-position: center; 
                                background-color: #f8f9fa;">
                    </div>
                    <div class="product-info">
                        <div class="product-name">CHMSU Legacy Journal</div>
                        <div class="product-stats">
                            <span>1,284 sold</span>
                            <span class="price">₱450</span>
                        </div>
                    </div>
                </div>

                <!-- 2 -->
                <div class="product-card">
                    <div class="product-image" 
                         style="background-image: url('../public/assets/images/chmsuVisionSovereignKit.png'); 
                                background-size: contain; 
                                background-position: center; 
                                background-color: #f8f9fa;">
                    </div>
                    <div class="product-info">
                        <div class="product-name">CHMSU Vision Sovereign Kit</div>
                        <div class="product-stats">
                            <span>892 sold</span>
                            <span class="price">₱850</span>
                        </div>
                    </div>
                </div>

                <!-- 3 -->
                <div class="product-card">
                    <div class="product-image" 
                         style="background-image: url('../public/assets/images/chmsuToteBag.png'); 
                                background-size: contain; 
                                background-position: center; 
                                background-color: #f8f9fa;">
                    </div>
                    <div class="product-info">
                        <div class="product-name">CHMSU Tote Bag</div>
                        <div class="product-stats">
                            <span>673 sold</span>
                            <span class="price">₱550</span>
                        </div>
                    </div>
                </div>

                <!-- 4 -->
                <div class="product-card">
                    <div class="product-image" 
                         style="background-image: url('../public/assets/images/chmsuLanyard.png'); 
                                background-size: contain; 
                                background-position: center; 
                                background-color: #f8f9fa;">
                    </div>
                    <div class="product-info">
                        <div class="product-name">CHMSU Lanyard</div>
                        <div class="product-stats">
                            <span>541 sold</span>
                            <span class="price">₱180</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- ANIMATIONS JS – ONLY ANIMATIONS (no functions, no value changes) -->
    <script>
        // =============================================
        // CHMSTORE ADMIN SALES REPORTS PAGE – ANIMATIONS ONLY
        // Pure visual animations. Same style as dashboard, products, orders & inventory.
        // =============================================

        document.addEventListener('DOMContentLoaded', () => {

            // 1. Staggered fade-in for KPI cards
            const kpiCards = document.querySelectorAll('.kpi-card');
            kpiCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                    card.style.transitionDelay = `${index * 80}ms`;
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 300);
            });

            // 2. Sales chart line drawing animation (same as dashboard)
            const salesLine = document.getElementById('salesLine');
            const salesLineThin = document.getElementById('salesLineThin');
            const salesFill = document.getElementById('salesFill');

            if (salesLine) {
                const length = salesLine.getTotalLength();
                
                salesLine.style.strokeDasharray = length;
                salesLine.style.strokeDashoffset = length;
                salesLineThin.style.strokeDasharray = length;
                salesLineThin.style.strokeDashoffset = length;
                salesFill.style.opacity = '0';

                setTimeout(() => {
                    salesLine.style.transition = 'stroke-dashoffset 2.2s cubic-bezier(0.4, 0, 0.2, 1)';
                    salesLine.style.strokeDashoffset = '0';
                    
                    salesLineThin.style.transition = 'stroke-dashoffset 2.2s cubic-bezier(0.4, 0, 0.2, 1)';
                    salesLineThin.style.strokeDashoffset = '0';
                    
                    salesFill.style.transition = 'opacity 1.8s ease 1.2s';
                    salesFill.style.opacity = '1';
                }, 800);
            }

            // 3. Product cards hover lift + glow (same as dashboard)
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    card.style.transform = 'translateY(-12px) scale(1.04)';
                    card.style.boxShadow = '0 25px 40px rgba(248, 73, 140, 0.35)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0) scale(1)';
                    card.style.boxShadow = '';
                });
            });

            // 4. Page header gentle entrance
            const header = document.querySelector('.section');
            if (header) {
                header.style.opacity = '0';
                header.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    header.style.transition = 'all 0.9s cubic-bezier(0.4, 0, 0.2, 1)';
                    header.style.opacity = '1';
                    header.style.transform = 'translateY(0)';
                }, 100);
            }

            // Tiny CSS keyframe
            const style = document.createElement('style');
            style.innerHTML = `
                @keyframes pulseAlert {
                    0%, 100% { transform: scale(1); }
                    50% { transform: scale(1.04); }
                }
            `;
            document.head.appendChild(style);

            console.log('%c✅ CHMSTORE Sales Reports page animations loaded (visuals only)', 'color:#f8498c; font-weight:700');
        });
    </script>

</body>
</html>