<?php
require '../controller/Controller.php';
MainController::requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Product | CHMSTORE</title>
    <link rel="stylesheet" href="css/admin_addproduct.css">
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
            <div class="notification-bell">
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

    <main class="main-content-area">
        <div class="list-header-row">
            <div class="header-titles">
                <a href="admin_productlist.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Catalog</a>
                <h2 class="page-title">Create New Product</h2>
            </div>
            <div class="header-actions">
                <button type="button" class="btn-secondary" id="openTagsDrawerBtn"><i class="fas fa-tags"></i> Tags & Setup</button>
            </div>
        </div>

        <form action="admin_addproduct_action.php" method="POST" id="addProductForm" enctype="multipart/form-data">
            
            <div class="form-grid-top">
                <div class="form-card image-card">
                    <h3>Product Images</h3>
                    <div class="main-preview-container" id="mainPreviewContainer">
                        <img id="mainPreviewImage" src="../assets/images/uniformnobg.png" alt="Main Preview">
                        <div class="empty-preview-text">No Image Selected</div>
                    </div>
                    <div class="thumbnail-row">
                        <div class="thumb-box empty active"></div>
                        <div class="thumb-box empty"></div>
                        <div class="thumb-box empty"></div>
                        <div class="thumb-box empty"></div>
                    </div>
                    <input type="file" id="imageUploadInput" accept="image/*" style="display: none;">
                    <div class="input-group" style="margin-top: 15px;">
                        <label>Or use Image URL</label>
                        <input type="text" name="image" class="custom-input" placeholder="https://...">
                    </div>
                </div>

                <div class="form-card details-card">
                    <h3>Basic Information</h3>
                    
                    <div class="input-group">
                        <label>Product Name <span class="required">*</span></label>
                        <input type="text" name="name" id="mainProductName" class="custom-input" placeholder="e.g., Official College Polo" required>
                        <small id="nameWarning" class="warning-text" style="display:none; color: var(--crimson);">Product name is required for variants.</small>
                    </div>

                    <div class="input-group">
                        <label>Category</label>
                        <div class="category-wrapper">
                            <select name="category" id="categorySelect" class="custom-input">
                                <option value="Uniforms">Uniforms</option>
                                <option value="PE Attire">PE Attire</option>
                                <option value="Lanyards">Lanyards</option>
                                <option value="College Items">College Items</option>
                            </select>
                            <div class="category-actions" id="categoryActionBtns">
                                <button type="button" id="addCategoryBtn" class="btn-icon" title="Add Category"><i class="fas fa-plus"></i></button>
                                <button type="button" id="deleteCategoryBtn" class="btn-icon text-danger" title="Delete Category"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <div id="newCategoryInputArea" style="display:none; margin-top: 8px;">
                            <div style="display:flex; gap:8px;">
                                <input type="text" id="newCategoryName" class="custom-input" placeholder="New Category Name">
                                <button type="button" id="confirmAddCategory" class="btn-small btn-save"><i class="fas fa-check"></i></button>
                                <button type="button" id="cancelAddCategory" class="btn-small btn-cancel"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label>Base Price (₱)</label>
                            <input type="number" name="price" class="custom-input" placeholder="0.00" step="0.01" min="0">
                        </div>
                        <div class="input-group">
                            <label>Status</label>
                            <select name="status" class="custom-input">
                                <option value="published">Published</option>
                                <option value="unpublished">Unpublished</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Description</label>
                        <textarea name="description" class="custom-input custom-textarea" rows="4" placeholder="Product details..."></textarea>
                    </div>
                </div>
            </div>

            <div class="form-card variant-card" style="margin-bottom: 80px;">
                <div class="variant-header">
                    <h3><i class="fas fa-layer-group"></i> Variant & Stock Management</h3>
                    <button type="button" id="addCustomVariantBtn" class="btn-secondary" style="display:none;"><i class="fas fa-plus"></i> Add Custom Variant</button>
                </div>

                <div id="apparelControls" class="apparel-controls-section">
                    <div class="variant-builder-grid">
                        <div class="builder-group">
                            <label>1. Select Size</label>
                            <div class="box-selector">
                                <div class="size-box" data-size="XS">XS</div>
                                <div class="size-box" data-size="S">S</div>
                                <div class="size-box" data-size="M">M</div>
                                <div class="size-box" data-size="L">L</div>
                                <div class="size-box" data-size="XL">XL</div>
                                <div class="size-box" data-size="2XL">2XL</div>
                                <div class="size-box" data-size="3XL">3XL</div>
                            </div>
                        </div>
                        <div class="builder-group">
                            <label>2. Select Gender/Color</label>
                            <div class="box-selector">
                                <div class="gender-box" data-gender="Male">Male</div>
                                <div class="gender-box" data-gender="Female">Female</div>
                                <div class="gender-box" data-gender="Unisex">Unisex</div>
                            </div>
                        </div>
                        <div class="builder-action">
                            <button type="button" id="addApparelVariantBtn" class="btn-primary" disabled>
                                <i class="fas fa-arrow-down"></i> Add to Matrix
                            </button>
                        </div>
                    </div>
                </div>

                <div id="nonApparelControls" class="non-apparel-controls-section" style="display:none;">
                    <p class="text-muted"><i class="fas fa-info-circle"></i> This category doesn't use standard clothing sizes. Click "Add Custom Variant" above to build your inventory.</p>
                </div>

                <div class="matrix-table-wrapper">
                    <table class="variant-matrix-table">
                        <thead>
                            <tr>
                                <th>Variant Name</th>
                                <th>SKU</th>
                                <th width="120">Price (₱)</th>
                                <th width="100">Stock</th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody id="variantTableBody">
                            <tr class="empty-matrix-row">
                                <td colspan="5">Select size & gender (or add custom) to build your variant matrix.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-footer-sticky">
                <a href="admin_productlist.php" class="btn-cancel">Discard</a>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Complete Product</button>
            </div>
        </form>
    </main>
</div>

<div id="tagsDrawerOverlay" class="drawer-overlay">
    <div class="drawer-panel">
        <div class="drawer-header">
            <h3>Product Setup</h3>
            <button type="button" id="closeTagsDrawerBtn" class="btn-icon"><i class="fas fa-times"></i></button>
        </div>
        <div class="drawer-body">
            <div class="input-group">
                <label>Visibility Status</label>
                <label class="toggle-switch">
                    <input type="checkbox" id="collectionToggle" checked>
                    <span class="slider round"></span>
                </label>
                <small id="collectionStatusLabel">Visible on Store</small>
            </div>
            <hr>
            <div class="input-group">
                <label>Quick Tags</label>
                <div class="tags-container">
                    <span class="tag-chip">New Arrival</span>
                    <span class="tag-chip">Best Seller</span>
                    <span class="tag-chip">Clearance</span>
                </div>
            </div>
        </div>
        <div class="drawer-footer">
            <button type="button" id="saveTagsDrawer" class="btn-save" style="width:100%;">Apply</button>
        </div>
    </div>
</div>

<script src="js/admin_addproduct.js"></script> 
</body>
</html>