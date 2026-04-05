// Sample product data
const products = [
    {
        id: 1,
        name: 'School Uniform Set',
        description: 'Premium quality school uniform including shirt, pants, and tie. Available in all sizes.',
        price: 45.99,
        category: 'uniforms',
        image: 'https://images.unsplash.com/photo-1622445275576-721325763afe?w=500',
        badge: 'New',
        stock: true
    },
    {
        id: 2,
        name: 'Scientific Calculator',
        description: 'Advanced scientific calculator with 240+ functions. Perfect for math and science classes.',
        price: 24.99,
        category: 'supplies',
        image: 'https://images.unsplash.com/photo-1589998059171-988d887df646?w=500',
        badge: 'Popular',
        stock: true
    },
    {
        id: 3,
        name: 'Backpack Pro',
        description: 'Ergonomic design with multiple compartments. Water-resistant and durable material.',
        price: 39.99,
        category: 'supplies',
        image: 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500',
        badge: 'Sale',
        stock: true
    },
    {
        id: 4,
        name: 'Running Sneakers',
        description: 'Comfortable athletic shoes approved for PE classes. Multiple colors available.',
        price: 54.99,
        category: 'uniforms',
        image: 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=500',
        badge: 'New',
        stock: true
    },
    {
        id: 5,
        name: 'Study Notebook Set',
        description: 'Premium quality notebooks with 200 pages each. Set of 5 different subjects.',
        price: 18.99,
        category: 'supplies',
        image: 'https://images.unsplash.com/photo-1456735190827-d1262f71b8a3?w=500',
        badge: '',
        stock: true
    },
    {
        id: 6,
        name: 'Digital Tablet',
        description: 'Educational tablet with pre-loaded learning apps. Perfect for digital assignments.',
        price: 299.99,
        category: 'tech',
        image: 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=500',
        badge: 'New',
        stock: true
    },
    {
        id: 7,
        name: 'Chemistry Lab Kit',
        description: 'Complete chemistry experiment kit with safety equipment and 20+ experiments.',
        price: 79.99,
        category: 'supplies',
        image: 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=500',
        badge: '',
        stock: true
    },
    {
        id: 8,
        name: 'School Hoodie',
        description: 'Official school hoodie with embroidered logo. Soft cotton blend material.',
        price: 34.99,
        category: 'merch',
        image: 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=500',
        badge: 'Popular',
        stock: true
    }
];

// State
let currentProductIndex = 0;
let filteredProducts = [...products];
let cartItems = 3;

// Init
document.addEventListener('DOMContentLoaded', function () {
    initializeApp();
    setupEventListeners();
    displayProduct(currentProductIndex);
});

// Initialize
function initializeApp() {
    document.querySelector('.student-name').textContent = 'Alex';
    updateCartBadge();
}

// Events
function setupEventListeners() {
    setupNavigation();

    const shopNowBtn = document.querySelector('.shop-now-btn');
    if (shopNowBtn) {
        shopNowBtn.addEventListener('click', () => {
            document.querySelector('.featured-section').scrollIntoView({ behavior: 'smooth' });
        });
    }

    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    prevBtn && prevBtn.addEventListener('click', () => navigateProduct('prev'));
    nextBtn && nextBtn.addEventListener('click', () => navigateProduct('next'));

    document.querySelectorAll('.category-item').forEach(item => {
        item.addEventListener('click', function () {
            filterByCategory(this.getAttribute('data-category'));
            document.querySelectorAll('.category-item').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
        });
    });

    setupThumbnails();

    const addToCartBtn = document.querySelector('.add-to-cart-btn');
    addToCartBtn && addToCartBtn.addEventListener('click', addToCart);

    const cartButton = document.querySelector('.cart-button');
    cartButton && cartButton.addEventListener('click', () => {
        showNotification('Cart feature - Coming soon!', 'info');
    });

    const ctaButton = document.querySelector('.cta-button');
    ctaButton && ctaButton.addEventListener('click', () => {
        window.location.href = 'contact.html';
    });

    document.querySelectorAll('.footer-list a, .social-link').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
        });
    });
}

// Navigation
function setupNavigation() {
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
            this.parentElement.classList.add('active');

            const text = this.textContent.trim();

            if (text === 'Profile') showNotification('Profile page - Coming soon!', 'info');
            if (text === 'Orders') showNotification('Orders page - Coming soon!', 'info');
            if (text === 'Settings') showNotification('Settings page - Coming soon!', 'info');
        });
    });
}

// Display product
function displayProduct(index) {
    if (index < 0 || index >= filteredProducts.length) return;

    const product = filteredProducts[index];
    const card = document.querySelector('.product-card');

    const img = card.querySelector('.product-image img');
    img.src = product.image;
    img.alt = product.name;

    const badge = card.querySelector('.product-badge');
    badge.style.display = product.badge ? 'block' : 'none';
    badge.textContent = product.badge;

    card.querySelector('.product-name').textContent = product.name;
    card.querySelector('.product-description').textContent = product.description;
    card.querySelector('.product-price').textContent = `$${product.price.toFixed(2)}`;

    card.querySelector('.product-category').innerHTML =
        `<i class="${getCategoryIcon(product.category)}"></i> ${getCategoryName(product.category)}`;

    const stock = card.querySelector('.product-stock');
    stock.innerHTML = product.stock
        ? '<i class="fi fi-rr-box"></i> In Stock'
        : '<i class="fi fi-rr-cross-circle"></i> Out of Stock';

    stock.style.color = product.stock ? '#0a5c36' : '#f8498c';

    card.style.animation = 'none';
    setTimeout(() => card.style.animation = 'slideIn 0.5s ease-out', 10);

    updateActiveThumbnail(index);
}

// Navigation logic
function navigateProduct(dir) {
    currentProductIndex =
        dir === 'next'
            ? (currentProductIndex + 1) % filteredProducts.length
            : (currentProductIndex - 1 + filteredProducts.length) % filteredProducts.length;

    displayProduct(currentProductIndex);
}

// Filter
function filterByCategory(category) {
    filteredProducts = category === 'all'
        ? [...products]
        : products.filter(p => p.category === category);

    currentProductIndex = 0;
    displayProduct(currentProductIndex);
    updateThumbnails();
}

// Helpers
const getCategoryIcon = c => ({
    uniforms: 'fi fi-rr-shirt',
    supplies: 'fi fi-rr-pencil',
    books: 'fi fi-rr-book',
    tech: 'fi fi-rr-laptop',
    merch: 'fi fi-rr-badge'
}[c] || 'fi fi-rr-apps');

const getCategoryName = c => ({
    uniforms: 'Uniforms',
    supplies: 'School Supplies',
    books: 'Books',
    tech: 'Technology',
    merch: 'Merchandise'
}[c] || 'Products');

// Thumbnails
function setupThumbnails() {
    updateThumbnails();
}

function updateThumbnails() {
    const container = document.querySelector('.product-thumbnails');
    container.innerHTML = '';

    filteredProducts.slice(0, 5).forEach((p, i) => {
        const t = document.createElement('div');
        t.className = `thumbnail ${i === currentProductIndex ? 'active' : ''}`;
        t.setAttribute('data-index', i);
        t.innerHTML = `<img src="${p.image}" alt="${p.name}">`;

        t.addEventListener('click', () => {
            currentProductIndex = i;
            displayProduct(i);
        });

        container.appendChild(t);
    });
}

function updateActiveThumbnail(i) {
    document.querySelectorAll('.thumbnail').forEach((t, idx) =>
        t.classList.toggle('active', idx === i)
    );
}

// Cart
function addToCart() {
    const product = filteredProducts[currentProductIndex];

    if (!product.stock) {
        showNotification('This product is out of stock!', 'error');
        return;
    }

    cartItems++;
    updateCartBadge();
    showNotification(`${product.name} added to cart!`, 'success');

    const btn = document.querySelector('.add-to-cart-btn');
    btn.style.transform = 'scale(0.95)';
    setTimeout(() => btn.style.transform = 'scale(1)', 200);
}

function updateCartBadge() {
    const badge = document.querySelector('.cart-badge');
    if (!badge) return;

    badge.textContent = cartItems;
    badge.style.transform = 'scale(1.2)';
    setTimeout(() => badge.style.transform = 'scale(1)', 200);
}

// Notification
function showNotification(msg, type = 'info') {
    const n = document.createElement('div');
    n.className = `notification notification-${type}`;

    const icon = {
        success: 'fi-rr-check-circle',
        error: 'fi-rr-cross-circle',
        warning: 'fi-rr-exclamation',
        info: 'fi-rr-info'
    }[type];

    n.innerHTML = `<i class="fi ${icon}"></i><span>${msg}</span>`;

    const colors = {
        success: '#0a5c36',
        error: '#f8498c',
        warning: '#ff9800',
        info: '#2B85C1'
    };

    n.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        padding: 16px 24px;
        background-color: ${colors[type]};
        color: white;
        border-radius: 25px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        z-index: 10000;
        animation: slideInRight 0.3s ease-out;
        display: flex;
        align-items: center;
        gap: 10px;
    `;

    document.body.appendChild(n);

    setTimeout(() => {
        n.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => n.remove(), 300);
    }, 3000);
}

// Animations
const style = document.createElement('style');
style.textContent = `
@keyframes slideInRight {
    from { transform: translateX(400px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(400px); opacity: 0; }
}`;
document.head.appendChild(style);

// Keyboard
document.addEventListener('keydown', e => {
    if (e.key === 'ArrowRight') navigateProduct('next');
    if (e.key === 'ArrowLeft') navigateProduct('prev');

    if (e.key === 'Enter' && e.target.tagName !== 'BUTTON') {
        document.querySelector('.add-to-cart-btn')?.click();
    }
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault();
        document.querySelector(a.getAttribute('href'))?.scrollIntoView({ behavior: 'smooth' });
    });
});

// Parallax
window.addEventListener('scroll', () => {
    const b = document.querySelector('.welcome-banner');
    const y = window.pageYOffset;

    if (b && y < 500) {
        b.style.transform = `translateY(${y * 0.5}px)`;
        b.style.opacity = 1 - (y / 500);
    }
});