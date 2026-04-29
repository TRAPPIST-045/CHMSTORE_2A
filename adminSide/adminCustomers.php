<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE • Customers</title>
    <!-- SAME CSS FILE AS ALL OTHER ADMIN PAGES (dark modern theme) -->
    <link rel="stylesheet" href="assets/css/adminDashboard.css">
</head>
<body>

    <!-- SIDEBAR – EXACT SAME, ONLY "Customers" IS ACTIVE -->
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
                <a href="adminSalesReports.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-9 9-4-4-6 6" />
                    </svg>
                    <span>Sales Reports</span>
                </a>
            </li>
            <li>
                <a href="adminCustomers.php" class="active">
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
            <h1 class="topbar-title">Customers</h1>
            
            <div class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 01-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search customers by name or email...">
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
            <h2 style="margin:0; font-size:28px;">All Customers</h2>
            <button class="reorder-btn" style="font-size:15px; padding:12px 28px; border-radius:9999px;">
                + Add New Customer
            </button>
        </div>

        <!-- CUSTOMERS KPI SUMMARY -->
        <div class="kpi-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom:32px;">
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 01-5.356-1.857M17 20H7m5-2v-2c0-.656-.126-1.284-.356-1.852M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.284.356-1.852m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="kpi-value">2,847</div>
                <div class="kpi-label">Total Customers</div>
                <div class="kpi-change positive">↑ 124 this month</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M5 19.5l7-7 7 7" />
                    </svg>
                </div>
                <div class="kpi-value">1,392</div>
                <div class="kpi-label">Active Customers</div>
                <div class="kpi-change positive">↑ 8% from last month</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="kpi-value">₱428,650</div>
                <div class="kpi-label">Revenue from Customers</div>
                <div class="kpi-change positive">↑ 18% from last month</div>
            </div>
        </div>

        <!-- CUSTOMERS TABLE -->
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th style="width:60px;">AVATAR</th>
                        <th>CUSTOMER NAME</th>
                        <th>EMAIL</th>
                        <th>TOTAL ORDERS</th>
                        <th>TOTAL SPENT</th>
                        <th>LAST ORDER</th>
                        <th>STATUS</th>
                        <th style="width:140px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="customers-table">
                    <!-- Customer 1 -->
                    <tr>
                        <td><div class="product-image" style="width:48px;height:48px;border-radius:50%;background-image:url('https://picsum.photos/id/64/600/400');background-size:cover;background-position:center;"></div></td>
                        <td><strong>Emma Thompson</strong></td>
                        <td>emma.thompson@email.com</td>
                        <td><strong>12</strong></td>
                        <td>₱18,450</td>
                        <td>April 2, 2026</td>
                        <td><span style="color:#22ffaa; font-weight:600;">Active</span></td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">View</button>
                        </td>
                    </tr>

                    <!-- Customer 2 -->
                    <tr>
                        <td><div class="product-image" style="width:48px;height:48px;border-radius:50%;background-image:url('https://picsum.photos/id/1009/600/400');background-size:cover;background-position:center;"></div></td>
                        <td><strong>Liam Chen</strong></td>
                        <td>liam.chen@email.com</td>
                        <td><strong>8</strong></td>
                        <td>₱9,820</td>
                        <td>March 31, 2026</td>
                        <td><span style="color:#22ffaa; font-weight:600;">Active</span></td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">View</button>
                        </td>
                    </tr>

                    <!-- Customer 3 -->
                    <tr>
                        <td><div class="product-image" style="width:48px;height:48px;border-radius:50%;background-image:url('https://picsum.photos/id/201/600/400');background-size:cover;background-position:center;"></div></td>
                        <td><strong>Sofia Reyes</strong></td>
                        <td>sofia.reyes@email.com</td>
                        <td><strong>5</strong></td>
                        <td>₱4,250</td>
                        <td>March 28, 2026</td>
                        <td><span style="color:#ffcc33; font-weight:600;">Inactive</span></td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">View</button>
                        </td>
                    </tr>

                    <!-- Customer 4 -->
                    <tr>
                        <td><div class="product-image" style="width:48px;height:48px;border-radius:50%;background-image:url('https://picsum.photos/id/1005/600/400');background-size:cover;background-position:center;"></div></td>
                        <td><strong>Noah Park</strong></td>
                        <td>noah.park@email.com</td>
                        <td><strong>15</strong></td>
                        <td>₱22,780</td>
                        <td>April 1, 2026</td>
                        <td><span style="color:#22ffaa; font-weight:600;">Active</span></td>
                        <td>
                            <button class="reorder-btn" style="padding:6px 16px; font-size:13px;">View</button>
                        </td>
                    </tr>

                    <!-- Customer 5 -->
                    <tr>
                        <td><div class="product-image" style="width:48px;height:48px;border-radius:50%;background-image:url('https://picsum.photos/id/1016/600/400');background-size:cover;background-position:center;"></div></td>
                        <td><strong>Ava Morales</strong></td>
                        <td>ava.morales@email.com</td>
                        <td><strong>3</strong></td>
                        <td>₱2,899</td>
                        <td>March 25, 2026</td>
                        <td><span style="color:#ffcc33; font-weight:600;">Inactive</span></td>
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
        // CHMSTORE ADMIN CUSTOMERS PAGE – ANIMATIONS ONLY
        // Pure visual animations. Same style as all other pages.
        // =============================================

        document.addEventListener('DOMContentLoaded', () => {

            // 1. Staggered fade-in for table rows
            const rows = document.querySelectorAll('#customers-table tr');
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

            // 3. KPI cards stagger (same as sales reports & dashboard)
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

            console.log('%c✅ CHMSTORE Customers page animations loaded (visuals only)', 'color:#f8498c; font-weight:700');
        });
    </script>

</body>
</html>