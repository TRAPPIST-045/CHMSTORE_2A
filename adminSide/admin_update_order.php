<?php
/**
 * Update an order's status, persisting admin name + timestamps.
 *
 * POST:
 *   order_id         - order_code (e.g. CHM-ABC123) or numeric id
 *   status           - one of: Pending | Processing | Ready for Pickup | Completed | Cancelled
 *   payment_status   - optional (Unpaid | Paid | Refunded)
 *   cancel_reason    - optional (only for status=Cancelled)
 */
require '../controller/Controller.php';
MainController::requireLogin();

$orderId = $_POST['order_id']       ?? $_GET['order_id']       ?? null;
$status  = $_POST['status']         ?? $_GET['status']         ?? null;
if (!$orderId || !$status) {
    MainController::json(['ok'=>false,'error'=>'order_id & status required'],400);
}

$admin = UserModel::getCurrentAdmin();
$now   = date('M j, Y / g:i A');

$meta = [];
if (!empty($_POST['payment_status'])) $meta['payment_status'] = $_POST['payment_status'];

switch ($status) {
    case 'Processing':
        $meta['accepted_by']   = $admin;
        $meta['accepted_date'] = $now;
        break;
    case 'Ready for Pickup':
        $meta['processed_by']   = $admin;
        $meta['processed_date'] = $now;
        break;
    case 'Completed':
        $meta['completed_by']   = $admin;
        $meta['completed_date'] = $now;
        break;
    case 'Cancelled':
        $meta['cancel_reason']      = $_POST['cancel_reason'] ?? 'Not specified';
        $meta['cancel_reason_date'] = $now;
        break;
}

$ok = OrderModel::updateStatus($orderId, $status, $meta);

if (MainController::isAjax()) {
    MainController::json([
        'ok'         => $ok,
        'order_id'   => $orderId,
        'status'     => $status,
        'admin_name' => $admin,
        'timestamp'  => $now,
        'meta'       => $meta,
    ]);
}
MainController::redirect('admin_orders.php');
