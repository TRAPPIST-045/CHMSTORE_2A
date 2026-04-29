<?php
require '../controller/Controller.php';
MainController::requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Prepare the main product data matching your ProductModel expectations
    $productData = [
        'name'        => trim($_POST['name'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'category'    => trim($_POST['category'] ?? 'Uniforms'),
        'price'       => (float)($_POST['price'] ?? 0),
        'image'       => trim($_POST['image'] ?? ''), 
        'status'      => trim($_POST['status'] ?? 'published')
    ];

    try {
        // 2. Insert the main product to get the new ID
        $productId = ProductModel::create($productData);

        // 3. Check if any variants were built in the matrix
        if (!empty($_POST['variants']) && !empty($_POST['variants']['name'])) {
            
            $variantNames  = $_POST['variants']['name'];
            $variantSkus   = $_POST['variants']['sku'];
            $variantPrices = $_POST['variants']['price'];
            $variantStocks = $_POST['variants']['stock'];

            // Loop through the arrays and save each variant to the database
            for ($i = 0; $i < count($variantNames); $i++) {
                // Skip completely empty rows just to be safe
                if (trim($variantNames[$i]) === '') continue;

                $vData = [
                    'variant_name' => $variantNames[$i],
                    'sku'          => $variantSkus[$i] ?? '',
                    'price'        => $variantPrices[$i] ?? 0,
                    'stock'        => $variantStocks[$i] ?? 0,
                    // Your matrix combines size & gender into the variant_name, 
                    // so we pass empty strings for the individual columns.
                    'size'         => '', 
                    'color'        => ''
                ];
                
                ProductModel::addVariant($productId, $vData);
            }
        }

        // 4. Success! Redirect back to your product list
        MainController::redirect('admin_productlist.php');

    } catch (Exception $e) {
        // If the database throws an error, bounce back to the form
        MainController::redirect('admin_addproduct.php?error=failed');
    }
} else {
    // Prevent direct browser access to this script
    MainController::redirect('admin_productlist.php');
}
?>