<?php
require '../controller/Controller.php';
MainController::requireLogin(); // Secures the page

// Fetch live stats using your exact model methods
$orderStats = OrderModel::getDashboardStats();

$stats = [
    'revenue'  => $orderStats['revenue'],
    'orders'   => $orderStats['total_orders'], // Today's orders
    'products' => count(ProductModel::getAll(null, null, true)), // All published products
    'messages' => MessageModel::unreadCount() 
];

// Fetch live recent orders
$allOrders = OrderModel::getAll();
$recentOrders = array_slice($allOrders, 0, 5); // Get the top 5 most recent
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard | CHMSTORE</title>
    <link rel="stylesheet" href="css/admin_global.css"> 
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-layout-100vh">

    <nav class="pill-navbar">
        <div class="nav-brand">
            <div class="brand-logo-placeholder">CH</div>
            <span class="brand-text">CHMSTORE</span>
        </div>
        <div class="nav-pills-container">
            <a href="admin_dashboard.php" class="nav-pill active"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="admin_productlist.php" class="nav-pill"><i class="fas fa-box"></i> Products</a>
            <a href="admin_orders.php" class="nav-pill"><i class="fas fa-shopping-cart"></i> Orders</a>
            <a href="#" class="nav-pill"><i class="fas fa-clipboard-list"></i> Inventory</a>
            <a href="admin_contacts.php" class="nav-pill"><i class="fas fa-address-book"></i> Messages</a>
            <a href="admin_logout.php" class="nav-pill"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="nav-right-actions">
            <div class="notification-bell" id="notifTrigger">
                <i class="fas fa-bell"></i>
                <?php if ($stats['messages'] > 0): ?>
                    <span class="badge red"><?= $stats['messages'] ?></span>
                <?php endif; ?>
            </div>
            <div class="admin-profile-pill">
                <div class="admin-text">
                    <span class="admin-name"><?= htmlspecialchars(UserModel::getCurrentAdmin()) ?></span>
                    <span class="admin-role">Manager</span>
                </div>
            </div>
        </div>
    </nav>

    <div id="notifPanel" class="notif-panel">
        <div class="notif-header">
            <span>Notifications</span>
            <button id="closeNotif" class="close-notif-btn"><i class="fas fa-times"></i></button>
        </div>
        <div class="notif-body" id="notifBody">
            <p style="padding:16px;color:#888">Notification integration pending.</p>
        </div>
    </div>

    <main class="main-content-area">
        <div class="list-header-row">
            <h2 class="page-title">Dashboard Overview</h2>
            <div class="header-actions">
                <button class="add-product-btn" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Report
                </button>
            </div>
        </div>

        <div class="dashboard-stats-grid">
            <div class="stat-card">
                <div class="stat-icon bg-green-light">
                    <i class="fas fa-peso-sign text-green"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-title">Total Revenue</span>
                    <h3 class="stat-value">₱<?= number_format($stats['revenue'], 2) ?></h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-blue-light">
                    <i class="fas fa-shopping-cart text-blue"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-title">Today's Orders</span>
                    <h3 class="stat-value"><?= number_format($stats['orders']) ?></h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-purple-light">
                    <i class="fas fa-box text-purple"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-title">Active Products</span>
                    <h3 class="stat-value"><?= number_format($stats['products']) ?></h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-crimson-light">
                    <i class="fas fa-envelope text-crimson"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-title">Unread Messages</span>
                    <h3 class="stat-value"><?= number_format($stats['messages']) ?></h3>
                </div>
            </div>
        </div>

        <div class="dashboard-bottom-grid">
            <div class="dashboard-card card-span-2">
                <div class="dashboard-card-header">
                    <h3>Recent Orders</h3>
                    <a href="admin_orders.php" class="view-all-link">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recentOrders)): ?>
                                <tr><td colspan="5" style="text-align:center; padding: 20px; color: #888;">No recent orders found.</td></tr>
                            <?php else: ?>
                                <?php foreach ($recentOrders as $order): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($order['order_code'] ?? 'ORD-'.$order['id']) ?></strong></td>
                                    <td><?= htmlspecialchars($order['student_name'] ?: 'Unknown Student') ?></td>
                                    <td><?= htmlspecialchars(date('M d, Y', strtotime($order['created_at']))) ?></td>
                                    <td>₱<?= number_format($order['total'], 2) ?></td>
                                    <td>
                                        <span class="status-pill <?= strtolower(str_replace(' ', '-', $order['status'])) ?>">
                                            <?= htmlspecialchars($order['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div class="quick-actions-list">
                    <a href="admin_addproduct.php" class="quick-action-item">
                        <div class="qa-icon"><i class="fas fa-plus"></i></div>
                        <div class="qa-text">
                            <h4>Add New Product</h4>
                            <p>Update your catalog</p>
                        </div>
                        <i class="fas fa-chevron-right qa-arrow"></i>
                    </a>
                    <a href="admin_orders.php" class="quick-action-item">
                        <div class="qa-icon"><i class="fas fa-truck"></i></div>
                        <div class="qa-text">
                            <h4>Process Orders</h4>
                            <p>Manage pending shipments</p>
                        </div>
                        <i class="fas fa-chevron-right qa-arrow"></i>
                    </a>
                    <a href="admin_contacts.php" class="quick-action-item">
                        <div class="qa-icon"><i class="fas fa-reply"></i></div>
                        <div class="qa-text">
                            <h4>Respond to Messages</h4>
                            <p>Check student inquiries</p>
                        </div>
                        <i class="fas fa-chevron-right qa-arrow"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="js/admin_dashboard.js"></script>
</body>
</html>