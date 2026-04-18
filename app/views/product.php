<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - CHMSTORE</title>
    <link rel="stylesheet" href="../../public/assets/css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <a href="../../public/index.php" class="nav-logo">CHMSTORE</a>
        <div class="nav-links">
            <a href="home.php" class="nav-link">Home</a>
            <a href="product.php" class="nav-link active">Products</a>
            <a href="cart.php" class="nav-link">Cart</a>
            <a href="contact.php" class="nav-link">Contact</a>
        </div>
        <div class="nav-cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count">0</span>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="products-hero">
        <div class="hero-content">
            <h1 class="hero-title">OUR<br>COLLECTION</h1>
            <p class="hero-subtitle">Browse CHMSU's finest merchandise</p>
        </div>
        <div class="hero-badge">
            <span class="badge-text">Fresh<br>Stocks</span>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="filter-container">
            <button class="filter-btn active" data-category="all">All Items</button>
            <button class="filter-btn" data-category="apparel">Apparel</button>
            <button class="filter-btn" data-category="accessories">Accessories</button>
            <button class="filter-btn" data-category="school">School Supplies</button>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="products-section">
        <div class="products-grid">
            
            <!-- Product 1 -->
            <div class="product-item" data-category="apparel" data-testid="product-item-1">
                <div class="product-image" style="background-color: #c25f90;">
                    <span class="product-stock-badge in-stock">In Stock</span>
                </div>
                <div class="product-info">
                    <h3 class="product-name">CHMSU University Tee</h3>
                    <p class="product-desc">Premium cotton t-shirt with official CHMSU logo</p>
                    <div class="product-bottom">
                        <span class="product-price">₱450.00</span>
                        <button class="add-to-cart-btn" data-testid="add-to-cart-1">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-item" data-category="apparel" data-testid="product-item-2">
                <div class="product-image" style="background-color: #639cc7;">
                    <span class="product-stock-badge in-stock">In Stock</span>
                </div>
                <div class="product-info">
                    <h3 class="product-name">Campus Hoodie</h3>
                    <p class="product-desc">Cozy hoodie perfect for chilly campus days</p>
                    <div class="product-bottom">
                        <span class="product-price">₱850.00</span>
                        <button class="add-to-cart-btn" data-testid="add-to-cart-2">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-item" data-category="accessories" data-testid="product-item-3">
                <div class="product-image" style="background-color: #7c57a1;">
                    <span class="product-stock-badge in-stock">In Stock</span>
                </div>
                <div class="product-info">
                    <h3 class="product-name">CHMSU Baseball Cap</h3>
                    <p class="product-desc">Stylish cap with embroidered school logo</p>
                    <div class="product-bottom">
                        <span class="product-price">₱350.00</span>
                        <button class="add-to-cart-btn" data-testid="add-to-cart-3">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-item" data-category="school" data-testid="product-item-4">
                <div class="product-image" style="background-color: #0a5c36;">
                    <span class="product-stock-badge in-stock">In Stock</span>
                </div>
                <div class="product-info">
                    <h3 class="product-name">University Notebook Set</h3>
                    <p class="product-desc">Set of 3 premium notebooks with CHMSU design</p>
                    <div class="product-bottom">
                        <span class="product-price">₱280.00</span>
                        <button class="add-to-cart-btn" data-testid="add-to-cart-4">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-item" data-category="accessories" data-testid="product-item-5">
                <div class="product-image" style="background-color: #f8498c;">
                    <span class="product-stock-badge limited">Limited</span>
                </div>
                <div class="product-info">
                    <h3 class="product-name">Campus Tote Bag</h3>
                    <p class="product-desc">Durable canvas bag for all your campus needs</p>
                    <div class="product-bottom">
                        <span class="product-price">₱550.00</span>
                        <button class="add-to-cart-btn" data-testid="add-to-cart-5">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-item" data-category="apparel" data-testid="product-item-6">
                <div class="product-image" style="background-color: #F07AAF;">
                    <span class="product-stock-badge in-stock">In Stock</span>
                </div>
                <div class="product-info">
                    <h3 class="product-name">Sports Jersey</h3>
                    <p class="product-desc">Official CHMSU sports team jersey</p>
                    <div class="product-bottom">
                        <span class="product-price">₱680.00</span>
                        <button class="add-to-cart-btn" data-testid="add-to-cart-6">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="product-item" data-category="accessories" data-testid="product-item-7">
                <div class="product-image" style="background-color: #2B85C1;">
                    <span class="product-stock-badge in-stock">In Stock</span>
                </div>
                <div class="product-info">
                    <h3 class="product-name">Water Bottle</h3>
                    <p class="product-desc">Insulated stainless steel water bottle</p>
                    <div class="product-bottom">
                        <span class="product-price">₱420.00</span>
                        <button class="add-to-cart-btn" data-testid="add-to-cart-7">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="product-item" data-category="school" data-testid="product-item-8">
                <div class="product-image" style="background-color: #8bbce0;">
                    <span class="product-stock-badge limited">Limited</span>
                </div>
                <div class="product-info">
                    <h3 class="product-name">Study Planner</h3>
                    <p class="product-desc">Academic year planner with CHMSU branding</p>
                    <div class="product-bottom">
                        <span class="product-price">₱320.00</span>
                        <button class="add-to-cart-btn" data-testid="add-to-cart-8">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-box">
            <h2 class="cta-title">CAN'T FIND<br>WHAT YOU<br>NEED?</h2>
            <p class="cta-text">Let us know what you're looking for and we'll help you find it!</p>
            <button class="cta-button">CONTACT US</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="footer-brand">
                <h2 class="footer-logo">CHMSTORE</h2>
                <p class="footer-tagline">Your Campus Store</p>
            </div>
            <div class="footer-links">
                <h4>Quick Links</h4>
                <a href="index.html">Home</a>
                <a href="product.php">Products</a>
                <a href="#">About Us</a>
                <a href="#">Contact</a>
            </div>
            <div class="footer-contact">
                <h4>Connect</h4>
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 CHMSTORE - CHMSU. All rights reserved.</p>
        </div>
    </footer>

    <script src="../../public/assets/js/product.js"></script>
</body>
</html>
