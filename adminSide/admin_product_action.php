<?php
require '../controller/Controller.php';
MainController::requireLogin();

// Ensure this is strictly an AJAX POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    MainController::json(['ok' => false, 'error' => 'Invalid request method'], 405);
}

// Grab the raw JSON sent by the JS fetch() API
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

if (!$data || !isset($data['action'])) {
    MainController::json(['ok' => false, 'error' => 'Invalid JSON payload'], 400);
}

try {
    $action = $data['action'];

    // ==========================================
    // ACTION: PUBLISH / UNPUBLISH TOGGLE
    // ==========================================
    if ($action === 'toggle_status') {
        $id = (int)($data['id'] ?? 0);
        $newStatus = $data['status'] ?? '';

        if ($id <= 0 || empty($newStatus)) {
            MainController::json(['ok' => false, 'error' => 'Missing ID or Status']);
        }

        // Call the exact method you already wrote in ProductModel
        $success = ProductModel::setStatus($id, $newStatus);
        
        if ($success) {
            MainController::json(['ok' => true]);
        } else {
            MainController::json(['ok' => false, 'error' => 'Database update failed']);
        }
    }

    // ==========================================
    // ACTION: SAVE EDITS FROM MODAL
    // ==========================================
    elseif ($action === 'update') {
        $id = (int)($data['id'] ?? 0);
        if ($id <= 0) {
            MainController::json(['ok' => false, 'error' => 'Invalid Product ID']);
        }

        // 1. Update the main product row
        $productData = [
            'name'        => trim($data['name'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'category'    => trim($data['category'] ?? ''),
            'price'       => (float)($data['price'] ?? 0),
            'image'       => trim($data['image'] ?? ''),
            'status'      => trim($data['status'] ?? 'published')
        ];
        
        ProductModel::update($id, $productData);

        // 2. Handle Variants: Wipe the old ones and insert the updated list
        if (isset($data['variants']) && is_array($data['variants'])) {
            
            // Delete existing variants for this product
            ProductModel::deleteVariants($id);

            // Insert the new batch
            foreach ($data['variants'] as $v) {
                $vData = [
                    'variant_name' => trim($v['variant_name'] ?? ''),
                    'size'         => trim($v['size'] ?? ''),
                    'color'        => trim($v['color'] ?? ''),
                    'sku'          => trim($v['sku'] ?? ''),
                    'price'        => (float)($v['price'] ?? 0),
                    'stock'        => (int)($v['stock'] ?? 0)
                ];
                ProductModel::addVariant($id, $vData);
            }
        }

        MainController::json(['ok' => true]);
    }

    // Unrecognized action fallback
    else {
        MainController::json(['ok' => false, 'error' => 'Unknown action requested'], 400);
    }

} catch (Exception $e) {
    // Catch fatal DB errors and pass them safely to the JS console/toast
    MainController::json(['ok' => false, 'error' => $e->getMessage()], 500);
}
?>