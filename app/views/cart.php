<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - CHMSTORE</title>
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <a href="index.php" class="nav-logo">CHMSTORE</a>
        <div class="nav-links">
            <a href="home.php" class="nav-link">Home</a>
            <a href="product.php" class="nav-link">Products</a>
            <a href="cart.php" class="nav-link active">Cart</a>
            <a href="contact.php" class="nav-link">Contact</a>
        </div>
        <div class="nav-cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count">3</span>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="cart-header">
        <div class="header-content">
            <h1 class="page-title">YOUR<br>CART</h1>
            <p class="page-subtitle">Review your items before checkout</p>
        </div>
        <div class="header-badge">
            <span class="badge-text">Ready<br>To Ship</span>
        </div>
    </section>

    <!-- Cart Content -->
    <section class="cart-section">
        <div class="cart-container">
            
            <!-- Cart Items Column -->
            <div class="cart-items">
                <div class="cart-items-header">
                    <h2>Items in Your Cart</h2>
                    <span class="items-count">3 items</span>
                </div>

                <!-- Cart Item 1 -->
                <div class="cart-item" data-id="1" data-price="450">
                    <div class="item-image" style="background-color: #c25f90;"></div>
                    <div class="item-details">
                        <h3 class="item-name">CHMSU University Tee</h3>
                        <p class="item-desc">Premium cotton t-shirt with official CHMSU logo</p>
                        <span class="item-stock">In Stock</span>
                    </div>
                    <div class="item-actions">
                        <div class="quantity-controls">
                            <button class="qty-btn minus" data-testid="decrease-qty-1">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="qty-input" value="1" min="1" max="10" readonly>
                            <button class="qty-btn plus" data-testid="increase-qty-1">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="item-price-section">
                            <span class="item-price">₱450.00</span>
                            <button class="remove-btn" data-testid="remove-item-1">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Cart Item 2 -->
                <div class="cart-item" data-id="2" data-price="850">
                    <div class="item-image" style="background-color: #639cc7;"></div>
                    <div class="item-details">
                        <h3 class="item-name">Campus Hoodie</h3>
                        <p class="item-desc">Cozy hoodie perfect for chilly campus days</p>
                        <span class="item-stock">In Stock</span>
                    </div>
                    <div class="item-actions">
                        <div class="quantity-controls">
                            <button class="qty-btn minus" data-testid="decrease-qty-2">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="qty-input" value="1" min="1" max="10" readonly>
                            <button class="qty-btn plus" data-testid="increase-qty-2">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="item-price-section">
                            <span class="item-price">₱850.00</span>
                            <button class="remove-btn" data-testid="remove-item-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Cart Item 3 -->
                <div class="cart-item" data-id="3" data-price="550">
                    <div class="item-image" style="background-color: #f8498c;"></div>
                    <div class="item-details">
                        <h3 class="item-name">Campus Tote Bag</h3>
                        <p class="item-desc">Durable canvas bag for all your campus needs</p>
                        <span class="item-stock limited">Limited Stock</span>
                    </div>
                    <div class="item-actions">
                        <div class="quantity-controls">
                            <button class="qty-btn minus" data-testid="decrease-qty-3">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="qty-input" value="1" min="1" max="10" readonly>
                            <button class="qty-btn plus" data-testid="increase-qty-3">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="item-price-section">
                            <span class="item-price">₱550.00</span>
                            <button class="remove-btn" data-testid="remove-item-3">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Continue Shopping Button -->
                <a href="product.php" class="continue-shopping">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
            </div>

            <!-- Order Summary Column -->
            <div class="order-summary">
                <h2>Order Summary</h2>
                
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span class="subtotal-amount">₱1,850.00</span>
                </div>
                
                <div class="summary-row">
                    <span>Shipping</span>
                    <span class="shipping-amount">₱100.00</span>
                </div>
                
                <div class="summary-row discount">
                    <span>Discount</span>
                    <span class="discount-amount">-₱0.00</span>
                </div>
                
                <div class="divider"></div>
                
                <div class="summary-row total">
                    <span>Total</span>
                    <span class="total-amount">₱1,950.00</span>
                </div>

                <!-- Promo Code -->
                <div class="promo-section">
                    <input type="text" class="promo-input" placeholder="Enter promo code">
                    <button class="apply-promo-btn">Apply</button>
                </div>

                <!-- Checkout Button -->
                <button class="checkout-btn" data-testid="checkout-button">
                    <span>Proceed to Checkout</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <!-- Payment Methods -->
                <div class="payment-info">
                    <p>We Accept:</p>
                    <div class="payment-icons">
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-mastercard"></i>
                        <i class="fab fa-cc-paypal"></i>
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>

                <!-- Security Badge -->
                <div class="security-badge">
                    <i class="fas fa-lock"></i>
                    <span>Secure Checkout</span>
                </div>
            </div>

        </div>
    </section>

    <!-- Recommended Products -->
    <section class="recommended-section">
        <h2 class="section-title">You Might Also Like</h2>
        <div class="recommended-grid">
            
            <div class="recommended-item">
                <div class="rec-image" style="background-color: #7c57a1;"></div>
                <h4>CHMSU Baseball Cap</h4>
                <span class="rec-price">₱350.00</span>
                <button class="add-rec-btn">Add to Cart</button>
            </div>

            <div class="recommended-item">
                <div class="rec-image" style="background-color: #2B85C1;"></div>
                <h4>Water Bottle</h4>
                <span class="rec-price">₱420.00</span>
                <button class="add-rec-btn">Add to Cart</button>
            </div>

            <div class="recommended-item">
                <div class="rec-image" style="background-color: #0a5c36;"></div>
                <h4>University Notebook Set</h4>
                <span class="rec-price">₱280.00</span>
                <button class="add-rec-btn">Add to Cart</button>
            </div>

            <div class="recommended-item">
                <div class="rec-image" style="background-color: #F07AAF;"></div>
                <h4>Sports Jersey</h4>
                <span class="rec-price">₱680.00</span>
                <button class="add-rec-btn">Add to Cart</button>
            </div>

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
                <a href="cart.php">Cart</a>
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

    <script src="assets/js/cart.js"></script>
</body>
</html>
