<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE • Settings</title>
    <!-- SAME CSS FILE AS ALL OTHER ADMIN PAGES (dark modern theme) -->
    <link rel="stylesheet" href="assets/css/adminDashboard.css">
</head>
<body>

    <!-- SIDEBAR – EXACT SAME, ONLY "Settings" IS ACTIVE -->
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
                <a href="adminCustomers.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 01-5.356-1.857M17 20H7m5-2v-2c0-.656-.126-1.284-.356-1.852M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.284.356-1.852m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a href="adminSettings.php" class="active">
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
            <h1 class="topbar-title">Settings</h1>
            
            <div class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 01-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search settings...">
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
            <h2 style="margin:0; font-size:28px;">Account &amp; Store Settings</h2>
            <button class="reorder-btn" style="font-size:15px; padding:12px 28px; border-radius:9999px;">
                💾 Save All Changes
            </button>
        </div>

        <!-- SETTINGS SECTIONS (cards) -->
        <div class="two-column" style="grid-template-columns: 1fr 1fr; gap:24px;">

            <!-- PROFILE CARD -->
            <div class="card">
                <h3 class="section-title">Profile</h3>
                <div style="display:flex; align-items:center; gap:20px; margin-bottom:24px;">
                    <div class="avatar" style="width:80px; height:80px; font-size:32px;">
                        👩‍💼
                    </div>
                    <div style="flex:1;">
                        <input type="text" value="Mia Park" style="width:100%; background:#2a2839; border:1px solid #f1ede920; border-radius:12px; padding:12px 16px; color:#f1ede9; font-size:17px; margin-bottom:8px;">
                        <input type="email" value="mia.park@chmstore.com" style="width:100%; background:#2a2839; border:1px solid #f1ede920; border-radius:12px; padding:12px 16px; color:#f1ede9; font-size:17px;">
                    </div>
                </div>
                <button class="reorder-btn" style="width:100%; padding:14px;">Update Profile Picture</button>
            </div>

            <!-- STORE INFO -->
            <div class="card">
                <h3 class="section-title">Store Information</h3>
                <div style="margin-bottom:16px;">
                    <label style="display:block; color:#b0aeb4; font-size:13px; margin-bottom:6px;">Store Name</label>
                    <input type="text" value="CHMSTORE Bacolod" style="width:100%; background:#2a2839; border:1px solid #f1ede920; border-radius:12px; padding:12px 16px; color:#f1ede9; font-size:17px;">
                </div>
                <div style="margin-bottom:16px;">
                    <label style="display:block; color:#b0aeb4; font-size:13px; margin-bottom:6px;">Store Tagline</label>
                    <input type="text" value="Cute &amp; Colorful Kids Fashion" style="width:100%; background:#2a2839; border:1px solid #f1ede920; border-radius:12px; padding:12px 16px; color:#f1ede9; font-size:17px;">
                </div>
                <div>
                    <label style="display:block; color:#b0aeb4; font-size:13px; margin-bottom:6px;">Currency</label>
                    <select style="width:100%; background:#2a2839; border:1px solid #f1ede920; border-radius:12px; padding:12px 16px; color:#f1ede9; font-size:17px;">
                        <option>🇵🇭 Philippine Peso (₱)</option>
                        <option>🇺🇸 US Dollar ($)</option>
                    </select>
                </div>
            </div>

            <!-- APPEARANCE -->
            <div class="card">
                <h3 class="section-title">Appearance</h3>
                <div style="display:flex; justify-content:space-between; align-items:center; padding:14px 0; border-bottom:1px solid #f1ede910;">
                    <span>Dark Mode</span>
                    <div style="background:#f8498c; color:white; width:48px; height:26px; border-radius:9999px; position:relative;">
                        <div style="position:absolute; right:2px; top:2px; background:white; width:22px; height:22px; border-radius:50%;"></div>
                    </div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; padding:14px 0; border-bottom:1px solid #f1ede910;">
                    <span>Neon Glow Effects</span>
                    <div style="background:#f8498c; color:white; width:48px; height:26px; border-radius:9999px; position:relative;">
                        <div style="position:absolute; right:2px; top:2px; background:white; width:22px; height:22px; border-radius:50%;"></div>
                    </div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; padding:14px 0;">
                    <span>Compact Sidebar</span>
                    <div style="background:#2a2839; color:#b0aeb4; width:48px; height:26px; border-radius:9999px; position:relative;">
                        <div style="position:absolute; left:2px; top:2px; background:#b0aeb4; width:22px; height:22px; border-radius:50%;"></div>
                    </div>
                </div>
            </div>

            <!-- SECURITY -->
            <div class="card">
                <h3 class="section-title">Security</h3>
                <button class="reorder-btn" style="width:100%; margin-bottom:12px; background:#22ffaa;">Change Password</button>
                <button class="reorder-btn" style="width:100%; background:#ff4466;">Enable Two-Factor Authentication</button>
                
            </div>

        </div>

    </main>

    <!-- ANIMATIONS JS – ONLY ANIMATIONS (no functions, no value changes) -->
    <script>
        // =============================================
        // CHMSTORE ADMIN SETTINGS PAGE – ANIMATIONS ONLY
        // Pure visual animations. Same style as all other pages.
        // =============================================

        document.addEventListener('DOMContentLoaded', () => {

            // 1. Staggered fade-in for all setting cards
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                    card.style.transitionDelay = `${index * 100}ms`;
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 200);
            });

            // 2. Page header gentle entrance
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

            console.log('%c✅ CHMSTORE Settings page animations loaded (visuals only)', 'color:#f8498c; font-weight:700');
        });
    </script>

</body>
</html>