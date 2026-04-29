<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE - Home</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <div class="nav-brand">
            <span class="brand-name">CHMSTORE</span>
        </div>

        <ul class="nav-menu">
            <li class="nav-item active">
                <a href="#" class="nav-link">
                    <i class="fi fi-br-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fi fi-br-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fi fi-br-shopping-bag"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fi fi-br-settings"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>

        <div class="nav-actions">
            <button class="cart-button">
                <i class="fi fi-rr-shopping-cart"></i>
                <span class="cart-badge">3</span>
            </button>
        </div>
    </div>
</nav>

<section class="welcome-banner">
    <div class="banner-background"></div>
    <div class="banner-content">
        <div class="welcome-text">
            <h1 class="welcome-title">Welcome Back, <span class="student-name">Alex</span>! 👋</h1>
            <p class="welcome-subtitle">Ready to shop for your school essentials?</p>
        </div>

        <div class="banner-stats">
            <div class="stat-card">
                <i class="fi fi-br-star"></i>
                <div class="stat-info">
                    <span class="stat-value">450</span>
                    <span class="stat-label">Points</span>
                </div>
            </div>
            <div class="stat-card">
                <i class="fi fi-br-box"></i>
                <div class="stat-info">
                    <span class="stat-value">12</span>
                    <span class="stat-label">Orders</span>
                </div>
            </div>
            <div class="stat-card">
                <i class="fi fi-br-wallet"></i>
                <div class="stat-info">
                    <span class="stat-value">$85.00</span>
                    <span class="stat-label">Credits</span>
                </div>
            </div>
        </div>

        <button class="shop-now-btn">
            <span>Shop Now</span>
            <i class="fi fi-br-arrow-right"></i>
        </button>
    </div>
</section>

<section class="featured-section">
    <h2 class="section-title">Featured Products</h2>

    <div class="products-wrapper">
        <aside class="categories-sidebar">
            <h3 class="categories-title">Categories</h3>
            <ul class="categories-list">
                <li class="category-item active" data-category="all">
                    <i class="fi fi-rr-apps"></i>
                    <span>All Products</span>
                </li>
                <li class="category-item" data-category="uniforms">
                    <i class="fi fi-rr-shirt"></i>
                    <span>Uniforms</span>
                </li>
                <li class="category-item" data-category="supplies">
                    <i class="fi fi-rr-pencil"></i>
                    <span>School Supplies</span>
                </li>
                <li class="category-item" data-category="books">
                    <i class="fi fi-rr-book"></i>
                    <span>Books</span>
                </li>
                <li class="category-item" data-category="tech">
                    <i class="fi fi-rr-laptop"></i>
                    <span>Technology</span>
                </li>
                <li class="category-item" data-category="merch">
                    <i class="fi fi-rr-badge"></i>
                    <span>Merchandise</span>
                </li>
            </ul>
        </aside>

        <div class="products-display">
            <div class="product-carousel">
                <button class="carousel-btn prev-btn">
                    <i class="fi fi-br-angle-left"></i>
                </button>

                <div class="product-card">
                    <div class="product-image">
                        <img src="https://images.unsplash.com/photo-1622445275576-721325763afe?w=500" alt="Product">
                        <span class="product-badge">New</span>
                    </div>

                    <div class="product-info">
                        <h3 class="product-name">School Uniform Set</h3>
                        <p class="product-description">
                            Premium quality school uniform including shirt, pants, and tie. Available in all sizes.
                        </p>

                        <div class="product-details">
                            <span class="product-category">
                                <i class="fi fi-rr-shirt"></i> Uniforms
                            </span>
                            <span class="product-stock">
                                <i class="fi fi-rr-box"></i> In Stock
                            </span>
                        </div>

                        <div class="product-footer">
                            <span class="product-price">$45.99</span>
                            <button class="add-to-cart-btn">
                                <i class="fi fi-rr-shopping-cart-add"></i>
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>

                <button class="carousel-btn next-btn">
                    <i class="fi fi-br-angle-right"></i>
                </button>
            </div>

            <div class="product-thumbnails">
                <div class="thumbnail active" data-index="0">
                    <img src="https://images.unsplash.com/photo-1622445275576-721325763afe?w=100">
                </div>
                <div class="thumbnail" data-index="1">
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?w=100">
                </div>
                <div class="thumbnail" data-index="2">
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=100">
                </div>
                <div class="thumbnail" data-index="3">
                    <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=100">
                </div>
                <div class="thumbnail" data-index="4">
                    <img src="https://images.unsplash.com/photo-1456735190827-d1262f71b8a3?w=100">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-cta">
    <div class="cta-container">
        <div class="cta-content">
            <div class="cta-icon">
                <i class="fi fi-br-headset"></i>
            </div>
            <h2 class="cta-title">Need Help?</h2>
            <p class="cta-description">
                Have questions about our products or services? Our support team is here to help you!
            </p>
            <button class="cta-button">
                <span>Contact Us</span>
                <i class="fi fi-br-paper-plane"></i>
            </button>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3 class="footer-title">CHMSTORE</h3>
            <p class="footer-description">
                Your one-stop shop for all school essentials. Quality products, affordable prices, and excellent service.
            </p>
            <div class="footer-social">
                <a href="#" class="social-link"><i class="fi fi-br-facebook"></i></a>
                <a href="#" class="social-link"><i class="fi fi-br-twitter"></i></a>
                <a href="#" class="social-link"><i class="fi fi-br-instagram"></i></a>
            </div>
        </div>

        <div class="footer-section">
            <h4 class="footer-subtitle">Quick Links</h4>
            <ul class="footer-list">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Shipping Info</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4 class="footer-subtitle">Support</h4>
            <ul class="footer-list">
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Returns</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4 class="footer-subtitle">Contact Info</h4>
            <ul class="footer-contact-list">
                <li><i class="fi fi-rr-marker"></i><span>123 School Street, City, State</span></li>
                <li><i class="fi fi-rr-envelope"></i><span>support@chmstore.edu</span></li>
                <li><i class="fi fi-rr-phone-call"></i><span>+1 (555) 123-4567</span></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 CHMSTORE. All rights reserved.</p>
    </div>
</footer>

<script src="assets/js/home.js"></script>
</body>
</html>