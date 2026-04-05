<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE • Inventory</title>
    <!-- SAME CSS FILE AS DASHBOARD, PRODUCTS & ORDERS (dark modern theme) -->
    <link rel="stylesheet" href="assets/css/adminDashboard.css">
</head>
<body>

    <!-- SIDEBAR – EXACT SAME, ONLY "Inventory" IS ACTIVE -->
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
                <a href="adminInventory.php" class="active">
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

    <!-- TOPBAR – EXACT SAME STYLE -->
    <header class="topbar">
        <div class="topbar-left">
            <h1 class="topbar-title">Inventory</h1>
            
            <div class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 01-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search inventory by SKU or product...">
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
            <h2 style="margin:0; font-size:28px;">Live Inventory</h2>
            <button class="reorder-btn" style="font-size:15px; padding:12px 28px; border-radius:9999px;">
                + Add New Item
            </button>
        </div>

        <!-- INVENTORY SUMMARY KPI CARDS -->
        <div class="kpi-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom:32px;">
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div class="kpi-value">248</div>
                <div class="kpi-label">Total Items</div>
                <div class="kpi-change positive">↑ 12 this week</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m3 0v4" />
                    </svg>
                </div>
                <div class="kpi-value">12</div>
                <div class="kpi-label">Low Stock Items</div>
                <div class="kpi-change negative">↓ 3 from yesterday</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="kpi-value">3</div>
                <div class="kpi-label">Out of Stock</div>
                <div class="kpi-change negative">Needs attention</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 01-2 2H7a2 2 0 01-2 2v16m14 0h-4m-6 0H5" />
                    </svg>
                </div>
                <div class="kpi-value">89%</div>
                <div class="kpi-label">Avg Stock Health</div>
                <div class="kpi-change positive">↑ 5%</div>
            </div>
        </div>

        <!-- INVENTORY TABLE -->
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th style="width:80px;">IMAGE</th>
                        <th>PRODUCT NAME</th>
                        <th>SKU</th>
                        <th>CATEGORY</th>
                        <th>CURRENT STOCK</th>
                        <th>STOCK LEVEL</th>
                        <th>LAST RESTOCKED</th>
                        <th style="width:140px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="inventory-table">

                    <!-- 1 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuDesktopOrganizer.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Desktop Organizer</strong></td>
                        <td><small>DO-650</small></td>
                        <td>School Supplies</td>
                        <td><strong>142</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill high" style="width:92%"></div></div></td>
                        <td>2 days ago</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                    <!-- 2 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuKeyRingKit.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Key Ring Kit</strong></td>
                        <td><small>KR-280</small></td>
                        <td>Accessories</td>
                        <td><strong>89</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill high" style="width:88%"></div></div></td>
                        <td>5 days ago</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                    <!-- 3 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuLanyard.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Lanyard</strong></td>
                        <td><small>LY-180</small></td>
                        <td>Accessories</td>
                        <td><strong>156</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill high" style="width:95%"></div></div></td>
                        <td>Yesterday</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                    <!-- 4 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuLegacyJournal.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Legacy Journal</strong></td>
                        <td><small>LJ-450</small></td>
                        <td>School Supplies</td>
                        <td><strong>73</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill medium" style="width:68%"></div></div></td>
                        <td>1 week ago</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                    <!-- 5 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuPin.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Enamel Pin</strong></td>
                        <td><small>EP-150</small></td>
                        <td>Accessories</td>
                        <td><strong>214</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill high" style="width:91%"></div></div></td>
                        <td>3 days ago</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                    <!-- 6 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuToteBag.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Tote Bag</strong></td>
                        <td><small>TB-550</small></td>
                        <td>Accessories</td>
                        <td><strong>64</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill medium" style="width:76%"></div></div></td>
                        <td>6 days ago</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                    <!-- 7 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuTravelMug.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Travel Mug</strong></td>
                        <td><small>TM-420</small></td>
                        <td>Accessories</td>
                        <td><strong>31</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill low" style="width:45%"></div></div></td>
                        <td>2 weeks ago</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                    <!-- 8 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuVisionPortfolio.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Vision Portfolio</strong></td>
                        <td><small>VP-380</small></td>
                        <td>School Supplies</td>
                        <td><strong>98</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill high" style="width:89%"></div></div></td>
                        <td>4 days ago</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                    <!-- 9 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuVisionSovereignKit.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Vision Sovereign Kit</strong></td>
                        <td><small>VS-850</small></td>
                        <td>School Supplies</td>
                        <td><strong>12</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill low" style="width:18%"></div></div></td>
                        <td>3 weeks ago</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                    <!-- 10 -->
                    <tr>
                        <td><div class="product-image" style="width:60px;height:60px;border-radius:12px;background-image:url('../public/assets/images/chmsuWaterBottle.png');background-size:contain;background-position:center;background-color:#f8f9fa;"></div></td>
                        <td><strong>CHMSU Water Bottle</strong></td>
                        <td><small>WB-350</small></td>
                        <td>Accessories</td>
                        <td><strong>105</strong></td>
                        <td><div class="stock-bar"><div class="stock-fill high" style="width:83%"></div></div></td>
                        <td>1 day ago</td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">Edit</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </main>

    <!-- ANIMATIONS JS – ONLY ANIMATIONS (no functions, no value changes) -->
    <script>
        // =============================================
        // CHMSTORE ADMIN INVENTORY PAGE – ANIMATIONS ONLY
        // Pure visual animations. Same style as dashboard, products & orders.
        // =============================================

        document.addEventListener('DOMContentLoaded', () => {

            // 1. Staggered fade-in for table rows
            const rows = document.querySelectorAll('#inventory-table tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(25px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                    row.style.transitionDelay = `${index * 60}ms`;
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, 200);
            });

            // 2. Extra hover glow on product thumbnails
            const thumbnails = document.querySelectorAll('.product-image');
            thumbnails.forEach(thumb => {
                thumb.addEventListener('mouseenter', () => {
                    thumb.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    thumb.style.transform = 'scale(1.12)';
                    thumb.style.boxShadow = '0 0 20px rgba(248, 73, 140, 0.6)';
                });
                thumb.addEventListener('mouseleave', () => {
                    thumb.style.transform = 'scale(1)';
                    thumb.style.boxShadow = '';
                });
            });

            // 3. Page header gentle entrance
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

            // Tiny CSS keyframe (kept minimal)
            const style = document.createElement('style');
            style.innerHTML = `
                @keyframes pulseAlert {
                    0%, 100% { transform: scale(1); }
                    50% { transform: scale(1.04); }
                }
            `;
            document.head.appendChild(style);

            console.log('%c✅ CHMSTORE Inventory page animations loaded (visuals only)', 'color:#f8498c; font-weight:700');
        });
    </script>

</body>
</html>