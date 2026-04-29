<?php
require '../controller/Controller.php';
MainController::requireLogin();

$category = $_GET['category'] ?? 'all';
$search   = $_GET['q'] ?? '';

// Load ALL products — JS handles client-side filtering
$products = ProductModel::getAll(null, null);

// Load recent messages for notification panel
$allMsgs       = MessageModel::getAll();
$notifMessages = array_slice(
    array_filter(array_values($allMsgs), fn($m) => ($m['msg_folder'] ?? '') === 'inbox'),
    0, 8
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Product List | CHMSTORE</title>
    <link rel="stylesheet" href="css/admin_productlist.css">
    <link rel="stylesheet" href="css/admin_global.css">
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
            <a href="admin_productlist.php" class="nav-pill active"><i class="fas fa-box"></i> Products</a>
            <a href="admin_orders.php" class="nav-pill"><i class="fas fa-shopping-cart"></i> Orders</a>
            <a href="#" class="nav-pill"><i class="fas fa-clipboard-list"></i> Inventory</a>
            <a href="admin_contacts.php" class="nav-pill"><i class="fas fa-address-book"></i> Messages</a>
            <a href="admin_logout.php" class="nav-pill"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="nav-right-actions">
            <div class="notification-bell" id="notifTrigger">
                <i class="fas fa-bell"></i>
                <span class="badge red"><?= MessageModel::unreadCount() ?></span>
            </div>
            <div class="admin-profile-pill">
                <div class="admin-text">
                    <span class="admin-name"><?= htmlspecialchars(UserModel::getCurrentAdmin()) ?></span>
                    <span class="admin-role">Manager</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Notification panel -->
    <div id="notifPanel" class="notif-panel">
        <div class="notif-header">
            <span>Notifications</span>
            <button id="closeNotif" class="close-notif-btn"><i class="fas fa-times"></i></button>
        </div>
        <div class="notif-tabs">
            <button class="notif-tab active" data-tab="all">All</button>
            <button class="notif-tab" data-tab="orders">Orders</button>
            <button class="notif-tab" data-tab="messages">Messages</button>
        </div>
        <div class="notif-body" id="notifBody">
            <p style="padding:16px;color:#888">No new notifications.</p>
        </div>
    </div>

    <main class="main-content-area">

        <div class="list-header-row">
            <h2 class="page-title">Product Catalog</h2>
            <div class="header-actions">
                <div class="list-search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" placeholder="Search products..."
                           class="list-search-input" id="productSearchInput"
                           value="<?= htmlspecialchars($search) ?>">
                </div>
                <a href="admin_addproduct.php" class="add-product-btn" data-testid="add-product-btn">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </div>
        </div>

        <!-- FIXED: data-filter values now match exact DB category names -->
        <div class="list-filters">
            <button class="filter-pill <?= $category==='all'?'active':'' ?>"           data-filter="all">All Products</button>
            <button class="filter-pill <?= $category==='Uniforms'?'active':'' ?>"      data-filter="Uniforms">Uniforms</button>
            <button class="filter-pill <?= $category==='PE Attire'?'active':'' ?>"     data-filter="PE Attire">PE Attire</button>
            <button class="filter-pill <?= $category==='Lanyards'?'active':'' ?>"      data-filter="Lanyards">Lanyards</button>
            <button class="filter-pill <?= $category==='College Items'?'active':'' ?>" data-filter="College Items">College Items</button>
        </div>

        <div class="product-grid-scroll">
            <?php if (empty($products)): ?>
                <p class="empty-state">No products found.</p>
            <?php else: ?>
            <div class="product-grid-3col" id="productGrid">
                <?php foreach ($products as $p):
                    $variantNames = array_map(
                        fn($v) => trim(($v['size']??'').' '.($v['color']??'')) ?: ($v['variant_name']??''),
                        $p['variants']);
                    $variantNames = array_values(array_filter(array_unique($variantNames)));
                    $genders = array_values(array_unique(array_column($p['variants'],'color')));
                ?>
                <div class="landscape-card"
                     data-id="<?= (int)$p['id'] ?>"
                     data-category="<?= htmlspecialchars($p['category']) ?>"
                     data-status="<?= htmlspecialchars($p['status']) ?>"
                     data-variants="<?= htmlspecialchars(implode(',',$variantNames)) ?>"
                     data-genders="<?= htmlspecialchars(implode(',',$genders) ?: 'U') ?>">
                    <div class="lc-media-section">
                        <div class="lc-main-img">
                            <img src="<?= htmlspecialchars($p['image'] ?: '../assets/images/uniformnobg.png') ?>"
                                 alt="<?= htmlspecialchars($p['name']) ?>">
                        </div>
                    </div>
                    <div class="lc-body">
                        <div class="lc-info-section">
                            <div class="lc-header-row">
                                <div class="lc-text-header">
                                    <span class="lc-category"><?= htmlspecialchars($p['category']) ?></span>
                                    <h3 class="lc-name"><?= htmlspecialchars($p['name']) ?></h3>
                                </div>
                                <span class="lc-status <?= $p['total_stock']>0?'in-stock':'out-of-stock' ?>">
                                    Stock: <?= (int)$p['total_stock'] ?>
                                </span>
                            </div>
                            <p class="lc-description-preview">
                                <?= htmlspecialchars(mb_strimwidth($p['description'] ?? '',0,120,'…')) ?>
                            </p>
                            <div class="lc-mini-row">
                                <div class="lc-mini-boxes" data-type="variants"></div>
                                <div class="lc-mini-boxes" data-type="genders"></div>
                            </div>
                            <div class="lc-bottom-row">
                                <div class="lc-price-rating">
                                    <span class="lc-price">₱<?= number_format($p['price'],2) ?></span>
                                    <span class="lc-rating-unhover"><i class="fas fa-star"></i> 4.9 <span class="sold-text">(45 sold)</span></span>
                                </div>
                                <span class="lc-status-pill <?= $p['status']==='published'?'published':'unpublished' ?>">
                                    <?= htmlspecialchars(ucfirst($p['status'])) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="lc-click-overlay">
                        <div class="lc-overlay-buttons">
                            <!-- CHANGED: now a button that opens modal instead of a link -->
                            <button type="button"
                                    class="btn-overlay-update"
                                    data-product-id="<?= (int)$p['id'] ?>"
                                    data-testid="update-product-<?= (int)$p['id'] ?>">
                                <i class="fas fa-pen"></i> Update
                            </button>
                            <button type="button" class="btn-overlay-unpublish"
                                    data-product-id="<?= (int)$p['id'] ?>"
                                    data-current-status="<?= htmlspecialchars($p['status']) ?>"
                                    data-testid="unpublish-product-<?= (int)$p['id'] ?>">
                                <i class="fas fa-eye-slash"></i>
                                <?= $p['status']==='published' ? 'Unpublish' : 'Publish' ?>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <p class="empty-filter-state" id="emptyFilterState" style="display:none;">No products found for this filter.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<!-- ===== EDIT PRODUCT MODAL ===== -->
<div id="editProductModal" class="modal-overlay">
    <div class="modal-card edit-modal-card">
        <div class="modal-header">
            <h3><i class="fas fa-pen"></i> Edit Product</h3>
            <button id="closeEditModal" type="button"><i class="fas fa-times"></i></button>
        </div>
        <div class="edit-modal-body">
            <input type="hidden" id="editProductId">

            <div class="edit-modal-top">
                <!-- Image Section -->
                <div class="edit-image-section">
                    <div class="edit-image-preview-wrap">
                        <img id="editImagePreview" src="../assets/images/uniformnobg.png" alt="Preview">
                    </div>
                    <label class="edit-field-label">Image URL / Path</label>
                    <input type="text" id="editProductImage" class="edit-input" placeholder="../assets/images/...">
                </div>

                <!-- Details Section -->
                <div class="edit-details-section">
                    <div class="edit-field-group">
                        <label class="edit-field-label">Product Name <span class="required">*</span></label>
                        <input type="text" id="editProductName" class="edit-input" placeholder="Product name">
                    </div>
                    <div class="edit-field-row">
                        <div class="edit-field-group">
                            <label class="edit-field-label">Category</label>
                            <select id="editProductCategory" class="edit-input edit-select">
                                <option value="Uniforms">Uniforms</option>
                                <option value="PE Attire">PE Attire</option>
                                <option value="Lanyards">Lanyards</option>
                                <option value="College Items">College Items</option>
                            </select>
                        </div>
                        <div class="edit-field-group">
                            <label class="edit-field-label">Base Price (₱)</label>
                            <input type="number" id="editProductPrice" class="edit-input" placeholder="0.00" step="0.01" min="0">
                        </div>
                        <div class="edit-field-group">
                            <label class="edit-field-label">Status</label>
                            <select id="editProductStatus" class="edit-input edit-select">
                                <option value="published">Published</option>
                                <option value="unpublished">Unpublished</option>
                            </select>
                        </div>
                    </div>
                    <div class="edit-field-group">
                        <label class="edit-field-label">Description</label>
                        <textarea id="editProductDescription" class="edit-input edit-textarea" rows="3" placeholder="Product description…"></textarea>
                    </div>
                </div>
            </div>

            <!-- Variants & Stock Table -->
            <div class="edit-variants-section">
                <div class="edit-variants-header">
                    <h4><i class="fas fa-layer-group"></i> Variants &amp; Stock</h4>
                    <button type="button" id="editAddVariantBtn" class="btn-add-variant">
                        <i class="fas fa-plus"></i> Add Variant
                    </button>
                </div>
                <div class="edit-table-wrap">
                    <table class="edit-variant-table">
                        <thead>
                            <tr>
                                <th>Variant Name</th>
                                <th>Size</th>
                                <th>Color / Gender</th>
                                <th>SKU</th>
                                <th>Price (₱)</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="editVariantTableBody">
                            <tr class="empty-matrix-row">
                                <td colspan="7">No variants yet.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="cancelEditModal" class="btn-modal-cancel">Cancel</button>
            <button type="button" id="saveEditBtn" class="btn-modal-save">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div id="toastContainer" class="toast-container"></div>

<!-- Embedded product data for JS -->
<script id="products-data" type="application/json">
<?= json_encode(array_values($products), JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>
</script>

<!-- Embedded messages for notification panel -->
<script id="notif-messages-data" type="application/json">
<?= json_encode(array_values($notifMessages), JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>
</script>

<script src="js/admin_productlist.js"></script>
</body>
</html>