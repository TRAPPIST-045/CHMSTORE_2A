<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE • Admin Dashboard</title>
    <!-- EXACT PATH REQUESTED BY USER -->
    <link rel="stylesheet" href="assets/css/adminDashboard.css">
</head>
<body>

    <!-- SIDEBAR – FIXED POSITION -->
    <aside class="sidebar">
        <!-- IMAGE LOGO – EXACT PATH -->
        <div class="sidebar-logo">
            <img src="assets/images/chmstoreLogo.png" alt="CHMSTORE" class="logo-img">
        </div>
        
        <ul class="nav-menu">
            <li>
                <a href="adminDashboard.php" class="active">
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
                <a href="adminSalesReports.php">
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

    <!-- TOPBAR – FIXED POSITION -->
    <header class="topbar">
        <div class="topbar-left">
            <h1 class="topbar-title">Dashboard</h1>
            
            <div class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 01-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search products, orders, customers...">
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
        <div class="welcome">
            <h2>Good morning, Mia!</h2>
            <div class="date">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2" />
                </svg>
                Thursday, April 2nd 2026 • Bacolod City
            </div>
        </div>

        <!-- KPI CARDS – ENHANCED -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 4.01V8" />
                    </svg>
                </div>
                <div class="kpi-value">₱428,650</div>
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
                <div class="kpi-label">Orders This Month</div>
                <div class="kpi-change positive">↑ 9% from last month</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div class="kpi-value">64</div>
                <div class="kpi-label">Items in Stock</div>
                <div class="kpi-change negative">↓ 3 low stock alerts</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.975 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118L4.98 8.72c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <div class="kpi-value">98.4%</div>
                <div class="kpi-label">Average Rating</div>
                <div class="kpi-change positive">↑ 4.2% this week</div>
            </div>
        </div>

        <!-- SALES CHART -->
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

        <!-- INVENTORY SECTION -->
        <div class="two-column">
            <!-- Live Inventory Table -->
            <div class="card inventory-card">
                <h3 class="section-title">Live Inventory</h3>
                <table>
                    <thead>
                        <tr>
                            <th>PRODUCT</th>
                            <th>STOCK</th>
                            <th>LEVEL</th>
                            <th>LAST SOLD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>CHMSU Legacy Journal</strong><br><small>Hardbound • SKU: LJ-450</small></td>
                            <td><strong>142</strong></td>
                            <td><div class="stock-bar"><div class="stock-fill high" style="width:92%"></div></div></td>
                            <td>2 hours ago</td>
                        </tr>
                        <tr>
                            <td><strong>CHMSU Vision Sovereign Kit</strong><br><small>Stationery Set • SKU: VS-850</small></td>
                            <td><strong>27</strong></td>
                            <td><div class="stock-bar"><div class="stock-fill low" style="width:22%"></div></div></td>
                            <td>Yesterday</td>
                        </tr>
                        <tr>
                            <td><strong>CHMSU Tote Bag</strong><br><small>Canvas • SKU: TB-550</small></td>
                            <td><strong>84</strong></td>
                            <td><div class="stock-bar"><div class="stock-fill medium" style="width:68%"></div></div></td>
                            <td>3 days ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Low Stock Alerts -->
            <div class="card alerts-card">
                <h3 class="section-title low-alert">Low Stock Alerts</h3>
                <div class="alert-item">
                    <strong>CHMSU Vision Sovereign Kit</strong> — only 27 left
                    <button class="reorder-btn">Reorder Now</button>
                </div>
                <div class="alert-item">
                    <strong>CHMSU Lanyard</strong> — only 9 left
                    <button class="reorder-btn">Reorder Now</button>
                </div>
            </div>
        </div>

        <!-- TOP PRODUCTS – NOW WITH REAL CHMSU PRODUCTS -->
        <div class="section">
            <h3 class="section-title">Top Selling This Week</h3>
            <div class="product-grid">
                <!-- CHMSU Legacy Journal -->
                <div class="product-card">
                    <div class="product-image" 
                         style="background-image: url('assets/images/chmsuLegacyJournal.png'); 
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

                <!-- CHMSU Vision Sovereign Kit -->
                <div class="product-card">
                    <div class="product-image" 
                         style="background-image: url('assets/images/chmsuVisionSovereignKit.png'); 
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

                <!-- CHMSU Tote Bag -->
                <div class="product-card">
                    <div class="product-image" 
                         style="background-image: url('assets/images/chmsuToteBag.png'); 
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
            </div>
        </div>
    </main>

    <!-- ANIMATIONS JS – ONLY ANIMATIONS (no functions, no value changes) -->
    <script>
        // =============================================
        // CHMSTORE ADMIN DASHBOARD – ANIMATIONS ONLY
        // Pure visual animations. No data logic. No value updates.
        // Works perfectly with the dark theme.
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

            // 2. Sales chart line drawing animation
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

            // 3. Subtle pulse on low stock alerts
            const alertItems = document.querySelectorAll('.alert-item');
            alertItems.forEach((alert, index) => {
                setTimeout(() => {
                    alert.style.animation = 'pulseAlert 2s infinite ease-in-out';
                }, index * 400);
            });

            // 4. Product cards hover lift + glow (extra smooth)
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

            // 5. Welcome message gentle slide-in
            const welcome = document.querySelector('.welcome');
            if (welcome) {
                welcome.style.opacity = '0';
                welcome.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    welcome.style.transition = 'all 1s cubic-bezier(0.4, 0, 0.2, 1)';
                    welcome.style.opacity = '1';
                    welcome.style.transform = 'translateY(0)';
                }, 200);
            }

            // Tiny CSS keyframe for alert pulse
            const style = document.createElement('style');
            style.innerHTML = `
                @keyframes pulseAlert {
                    0%, 100% { transform: scale(1); }
                    50% { transform: scale(1.04); }
                }
            `;
            document.head.appendChild(style);

            console.log('%c✅ CHMSTORE Dashboard animations loaded (visuals only)', 'color:#f8498c; font-weight:700');
        });
    </script>

</body>
</html>