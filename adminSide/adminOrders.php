<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE • Orders</title>
    <!-- SAME CSS FILE AS DASHBOARD & PRODUCTS (dark modern theme) -->
    <link rel="stylesheet" href="assets/css/adminDashboard.css">
</head>
<body>

    <!-- SIDEBAR – EXACT SAME AS BEFORE, ONLY "Orders" IS ACTIVE -->
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
                <a href="adminOrders.php" class="active">
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

    <!-- TOPBAR – EXACT SAME STYLE -->
    <header class="topbar">
        <div class="topbar-left">
            <h1 class="topbar-title">Orders</h1>
            
            <div class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 01-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search orders by ID or customer...">
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
            <h2 style="margin:0; font-size:28px;">All Orders</h2>
            <button class="reorder-btn" style="font-size:15px; padding:12px 28px; border-radius:9999px;">
                Export CSV
            </button>
        </div>

        <!-- MINI KPI CARDS FOR ORDERS -->
        <div class="kpi-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom:32px;">
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="kpi-value">1,284</div>
                <div class="kpi-label">Total Orders • March</div>
                <div class="kpi-change positive">↑ 9% from last month</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m3 0v4" />
                    </svg>
                </div>
                <div class="kpi-value">47</div>
                <div class="kpi-label">Pending Orders</div>
                <div class="kpi-change negative">↓ 4 this week</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-1m-6 0h-2" />
                    </svg>
                </div>
                <div class="kpi-value">₱312,450</div>
                <div class="kpi-label">Revenue This Month</div>
                <div class="kpi-change positive">↑ 14% from last month</div>
            </div>
        </div>

        <!-- ORDERS TABLE -->
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th style="width:100px;">ORDER ID</th>
                        <th>CUSTOMER</th>
                        <th>DATE</th>
                        <th>ITEMS</th>
                        <th>TOTAL</th>
                        <th>STATUS</th>
                        <th style="width:140px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="orders-table">
                    <!-- Order 1 -->
                    <tr>
                        <td><strong>#ORD-7842</strong></td>
                        <td>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="product-image" style="width:38px;height:38px;border-radius:50%;background-image:url('https://picsum.photos/id/64/600/400');background-size:cover;background-position:center;"></div>
                                <div>Emma Thompson</div>
                            </div>
                        </td>
                        <td>April 2, 2026</td>
                        <td>3 items</td>
                        <td>₱3,897</td>
                        <td><span style="color:#22ffaa; font-weight:600;">Completed</span></td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">View</button>
                        </td>
                    </tr>

                    <!-- Order 2 -->
                    <tr>
                        <td><strong>#ORD-7841</strong></td>
                        <td>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="product-image" style="width:38px;height:38px;border-radius:50%;background-image:url('https://picsum.photos/id/1009/600/400');background-size:cover;background-position:center;"></div>
                                <div>Liam Chen</div>
                            </div>
                        </td>
                        <td>April 1, 2026</td>
                        <td>1 item</td>
                        <td>₱1,299</td>
                        <td><span style="color:#ffcc33; font-weight:600;">Processing</span></td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">View</button>
                        </td>
                    </tr>

                    <!-- Order 3 -->
                    <tr>
                        <td><strong>#ORD-7840</strong></td>
                        <td>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="product-image" style="width:38px;height:38px;border-radius:50%;background-image:url('https://picsum.photos/id/201/600/400');background-size:cover;background-position:center;"></div>
                                <div>Sofia Reyes</div>
                            </div>
                        </td>
                        <td>March 31, 2026</td>
                        <td>4 items</td>
                        <td>₱4,896</td>
                        <td><span style="color:#ff4466; font-weight:600;">Pending</span></td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">View</button>
                        </td>
                    </tr>

                    <!-- Order 4 -->
                    <tr>
                        <td><strong>#ORD-7839</strong></td>
                        <td>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="product-image" style="width:38px;height:38px;border-radius:50%;background-image:url('https://picsum.photos/id/1005/600/400');background-size:cover;background-position:center;"></div>
                                <div>Noah Park</div>
                            </div>
                        </td>
                        <td>March 30, 2026</td>
                        <td>2 items</td>
                        <td>₱2,198</td>
                        <td><span style="color:#22ffaa; font-weight:600;">Completed</span></td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">View</button>
                        </td>
                    </tr>

                    <!-- Order 5 -->
                    <tr>
                        <td><strong>#ORD-7838</strong></td>
                        <td>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="product-image" style="width:38px;height:38px;border-radius:50%;background-image:url('https://picsum.photos/id/1016/600/400');background-size:cover;background-position:center;"></div>
                                <div>Ava Morales</div>
                            </div>
                        </td>
                        <td>March 29, 2026</td>
                        <td>5 items</td>
                        <td>₱6,495</td>
                        <td><span style="color:#ffcc33; font-weight:600;">Processing</span></td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

    <!-- ANIMATIONS JS – ONLY ANIMATIONS (no functions, no value changes) -->
    <script>
        // =============================================
        // CHMSTORE ADMIN ORDERS PAGE – ANIMATIONS ONLY
        // Pure visual animations. Same style as dashboard & products.
        // =============================================

        document.addEventListener('DOMContentLoaded', () => {

            // 1. Staggered fade-in for table rows
            const rows = document.querySelectorAll('#orders-table tr');
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

            // 2. Extra hover glow on customer avatars
            const avatars = document.querySelectorAll('.product-image');
            avatars.forEach(avatar => {
                avatar.addEventListener('mouseenter', () => {
                    avatar.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    avatar.style.transform = 'scale(1.15)';
                    avatar.style.boxShadow = '0 0 20px rgba(248, 73, 140, 0.6)';
                });
                avatar.addEventListener('mouseleave', () => {
                    avatar.style.transform = 'scale(1)';
                    avatar.style.boxShadow = '';
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

            console.log('%c✅ CHMSTORE Orders page animations loaded (visuals only)', 'color:#f8498c; font-weight:700');
        });
    </script>

</body>
</html>