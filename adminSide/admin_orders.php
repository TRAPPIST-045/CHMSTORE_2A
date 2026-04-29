<?php
require '../controller/Controller.php';
MainController::requireLogin();

$orders = OrderModel::getAll();
$stats  = OrderModel::getDashboardStats();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Orders | CHMSTORE</title>
    <link rel="stylesheet" href="css/admin_orders.css">
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
            <a href="admin_dashboard.php" class="nav-pill"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="admin_productlist.php" class="nav-pill"><i class="fas fa-box"></i> Products</a>
            <a href="admin_orders.php" class="nav-pill active"><i class="fas fa-shopping-cart"></i> Orders</a>
            <a href="#" class="nav-pill"><i class="fas fa-clipboard-list"></i> Inventory</a>
            <a href="admin_contacts.php" class="nav-pill"><i class="fas fa-address-book"></i> Messages</a>
            <a href="admin_logout.php" class="nav-pill"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="nav-right-actions">
            <div class="notification-bell" id="notifTrigger">
                <i class="fas fa-bell"></i><span class="badge red"><?= MessageModel::unreadCount() ?></span>
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
        <div class="notif-tabs">
            <button class="notif-tab active">All</button>
            <button class="notif-tab">Orders</button>
        </div>
        <div class="notif-body"><p style="padding:16px;color:#888">All caught up.</p></div>
    </div>

    <main class="main-content-area">
        <h2 class="page-title">Orders Dashboard</h2>

        <!-- OVERVIEW CARDS -->
        <div class="dashboard-cards-grid">
            <div class="dashboard-card">
                <span class="dash-value" id="totalOrdersToday"><?= (int)$stats['total_orders'] ?></span>
                <span class="dash-label">Total Orders Today</span>
            </div>
            <div class="dashboard-card">
                <span class="dash-value" id="pendingOrdersCount"><?= (int)$stats['pending'] ?></span>
                <span class="dash-label">Pending / Processing</span>
            </div>
            <div class="dashboard-card">
                <span class="dash-value" id="readyForPickupCount"><?= (int)$stats['ready'] ?></span>
                <span class="dash-label">Ready for Pickup</span>
            </div>
            <div class="dashboard-card">
                <span class="dash-value" id="totalRevenueToday">₱<?= number_format($stats['revenue'],2) ?></span>
                <span class="dash-label">Total Revenue</span>
            </div>
        </div>

        <!-- FILTER PILLS + SEARCH -->
        <div class="orders-toolbar">
            <div class="status-filters">
                <button class="status-pill active" data-filter="all">All</button>
                <button class="status-pill"        data-filter="pending">Pending</button>
                <button class="status-pill"        data-filter="processing">Processing</button>
                <button class="status-pill"        data-filter="ready for pickup">Ready for Pickup</button>
                <button class="status-pill"        data-filter="completed">Completed</button>
                <button class="status-pill"        data-filter="cancelled">Cancelled</button>
            </div>
            <input id="orderSearchInput" type="text" placeholder="Search by ID, student, status…">
        </div>

        <!-- ORDERS TABLE -->
        <div class="table-card">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th><th>Student</th><th>Items</th>
                        <th>Status</th><th>Payment</th><th>Total</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody">
                    <?php foreach ($orders as $o):
                        $itemsJson = htmlspecialchars(json_encode($o['items']), ENT_QUOTES, 'UTF-8');
                        $statusSlug = strtolower(str_replace(' ','-', $o['status']));
                        $completed = $o['status']==='Completed';
                        $cancelled = $o['status']==='Cancelled';
                    ?>
                    <tr class="order-row"
                        data-order-id="<?= htmlspecialchars($o['order_code']) ?>"
                        data-order-date="<?= date('M j, Y / g:i A', strtotime($o['created_at'])) ?>"
                        data-order-status="<?= htmlspecialchars($o['status']) ?>"
                        data-student-name="<?= htmlspecialchars($o['student_name'] ?? 'Unknown') ?>"
                        data-student-email="<?= htmlspecialchars($o['student_email'] ?? '') ?>"
                        data-payment-method="<?= htmlspecialchars($o['payment_method']) ?>"
                        data-payment-status="<?= htmlspecialchars($o['payment_status']) ?>"
                        data-reference-number="<?= htmlspecialchars($o['reference_number'] ?? '') ?>"
                        data-pickup-code="<?= htmlspecialchars($o['pickup_code']) ?>"
                        data-total="<?= (float)$o['total'] ?>"
                        data-order-items='<?= $itemsJson ?>'
                        data-accepted-by="<?= htmlspecialchars($o['accepted_by'] ?? '') ?>"
                        data-accepted-date="<?= htmlspecialchars($o['accepted_date'] ?? '') ?>"
                        data-processed-by="<?= htmlspecialchars($o['processed_by'] ?? '') ?>"
                        data-processed-date="<?= htmlspecialchars($o['processed_date'] ?? '') ?>"
                        data-completed-by="<?= htmlspecialchars($o['completed_by'] ?? '') ?>"
                        data-completed-date="<?= htmlspecialchars($o['completed_date'] ?? '') ?>"
                        data-cancel-reason="<?= htmlspecialchars($o['cancel_reason'] ?? '') ?>"
                        data-cancel-reason-date="<?= htmlspecialchars($o['cancel_reason_date'] ?? '') ?>">
                        <td>#<?= htmlspecialchars($o['order_code']) ?></td>
                        <td><?= htmlspecialchars($o['student_name'] ?? 'Unknown') ?></td>
                        <td><?= count($o['items']) ?> item(s)</td>
                        <td>
                            <span class="status-cell status-<?= $statusSlug ?>">
                                <span class="status-dot"></span> <?= htmlspecialchars($o['status']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($o['payment_status']) ?> • <?= htmlspecialchars($o['payment_method']) ?></td>
                        <td>₱<?= number_format($o['total'],2) ?></td>
                        <td class="table-action-buttons">
                            <?php if ($completed): ?>
                                <button class="btn-table-action primary" data-action="issue-receipt"><i class="fas fa-receipt"></i> Issue Receipt</button>
                            <?php elseif (!$cancelled): ?>
                                <button class="btn-table-action primary" data-action="review">Review</button>
                                <button class="btn-table-action cancel"  data-action="cancel">Cancel</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- RIGHT-SIDE ORDER SUMMARY PANEL -->
    <aside id="orderSummaryPanel" class="order-summary-panel">
        <div class="summary-header">
            <h3>Order <span id="summaryOrderId">#</span></h3>
            <button id="closeSummaryPanelBtn" type="button"><i class="fas fa-times"></i></button>
        </div>
        <div class="summary-body">
            <div class="summary-info-item"><span class="label">Date Placed</span><span class="value" id="summaryOrderDate"></span></div>
            <div class="summary-info-item"><span class="label">Student</span><span class="value" id="summaryStudentName"></span></div>
            <div class="summary-info-item"><span class="label">Email</span><span class="value" id="summaryStudentEmail"></span></div>
            <div class="summary-info-item"><span class="label">Payment Method</span><span class="value" id="summaryPaymentMethod"></span></div>
            <div class="summary-info-item" id="summaryReferenceNumberItem">
                <span class="label">Reference #</span><span class="value" id="summaryReferenceNumber"></span>
            </div>
            <div class="summary-info-item"><span class="label">Payment Status</span><span class="value" id="summaryPaymentStatus"></span></div>
            <div class="summary-info-item"><span class="label">Current Status</span><span class="value" id="summaryCurrentStatus"></span></div>
            <div class="summary-info-item"><span class="label">Pickup Code</span><span class="value" id="summaryPickupCode"></span></div>

            <h4>Ordered Items</h4>
            <div id="summaryOrderItems" class="summary-items"></div>
            <div class="summary-totals">
                <div class="row"><span>Subtotal</span><span id="summarySubtotal">₱0.00</span></div>
                <div class="row total"><span>Total</span><span id="summaryTotal">₱0.00</span></div>
            </div>
        </div>
        <div class="summary-footer" id="summaryDynamicStatusActions"></div>
    </aside>

    <!-- TOAST CONTAINER -->
    <div id="notificationContainer" class="toast-container"></div>

    <!-- GENERIC CONFIRMATION MODAL -->
    <div id="confirmationModal" class="modal-overlay">
        <div class="modal-card">
            <h3 id="modalTitle">Confirm</h3>
            <p  id="modalMessage">Are you sure?</p>
            <div class="modal-actions">
                <button id="modalCancelBtn"  type="button" class="btn-secondary">Cancel</button>
                <button id="modalConfirmBtn" type="button" class="btn-primary">Confirm</button>
            </div>
        </div>
    </div>

    <!-- CANCEL-REASON MODAL -->
    <div id="cancelReasonModal" class="modal-overlay">
        <div class="modal-card">
            <h3>Cancel Order <span id="cancelReasonOrderId"></span></h3>
            <div id="cancelReasonOptions" class="reason-options">
                <label><input type="radio" name="cancelReason" value="Student request">Student request</label>
                <label><input type="radio" name="cancelReason" value="Out of stock">Out of stock</label>
                <label><input type="radio" name="cancelReason" value="Payment issue">Payment issue</label>
                <label><input type="radio" name="cancelReason" value="Other Reason">Other Reason</label>
            </div>
            <textarea id="otherReasonText" placeholder="Specify other reason…"></textarea>
            <div class="modal-actions">
                <button id="cancelReasonModalCloseBtn" type="button" class="btn-secondary">Close</button>
                <button id="confirmCancelReasonBtn"    type="button" class="btn-primary danger">Confirm Cancellation</button>
            </div>
        </div>
    </div>

    <!-- PAYMENT STUB MODAL -->
    <div id="paymentStubDisplayModal" class="modal-overlay">
        <div class="modal-card wide">
            <div class="modal-header">
                <h3>Payment Stub <span id="paymentStubOrderId"></span></h3>
                <button id="closePaymentStubModalBtn" type="button"><i class="fas fa-times"></i></button>
            </div>
            <div id="paymentStubModalContent" class="stub-content">Loading…</div>
            <div class="modal-actions">
                <button id="printStubModalBtn" type="button" class="btn-primary"><i class="fas fa-print"></i> Print This Stub</button>
            </div>
        </div>
    </div>
</div>

<script src="js/admin_orders.js"></script>
</body>
</html>
