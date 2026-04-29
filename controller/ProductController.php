<?php
class ProductController extends MainController 
{
    // This handles the Add Product form submission
    public static function store() {
        self::requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData = [
                'name'        => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'category'    => $_POST['category'] ?? 'Uniforms',
                'price'       => $_POST['price'] ?? 0,
                'image'       => $_POST['image'] ?? '',
                'status'      => $_POST['status'] ?? 'published'
            ];

            try {
                $productId = ProductModel::create($productData);

                // Handle variants...
                if (!empty($_POST['variants']['name'])) {
                    // loop and save variants here
                }

                self::redirect('../adminSide/admin_productlist.php?success=1');
            } catch (Exception $e) {
                self::redirect('../adminSide/admin_addproduct.php?error=1');
            }
        }
    }

    // This handles the AJAX requests
    public static function handleAjax() {
        self::requireLogin();
        // Decode JSON and call ProductModel based on the action...
    }
}