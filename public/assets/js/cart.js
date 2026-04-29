// Cart page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Update cart totals
    function updateCartTotals() {
        let subtotal = 0;
        const cartItems = document.querySelectorAll('.cart-item');
        
        cartItems.forEach(item => {
            const price = parseFloat(item.getAttribute('data-price'));
            const quantity = parseInt(item.querySelector('.qty-input').value);
            const itemTotal = price * quantity;
            
            // Update item price display
            item.querySelector('.item-price').textContent = '₱' + itemTotal.toFixed(2);
            
            subtotal += itemTotal;
        });
        
        // Calculate other costs
        const shipping = 100;
        const discount = 0;
        const total = subtotal + shipping - discount;
        
        // Update summary
        document.querySelector('.subtotal-amount').textContent = '₱' + subtotal.toFixed(2);
        document.querySelector('.shipping-amount').textContent = '₱' + shipping.toFixed(2);
        document.querySelector('.discount-amount').textContent = '-₱' + discount.toFixed(2);
        document.querySelector('.total-amount').textContent = '₱' + total.toFixed(2);
        
        // Update cart count
        const totalItems = Array.from(cartItems).reduce((sum, item) => {
            return sum + parseInt(item.querySelector('.qty-input').value);
        }, 0);
        document.querySelector('.cart-count').textContent = totalItems;
        document.querySelector('.items-count').textContent = cartItems.length + ' items';
    }
    
    // Quantity increase
    document.querySelectorAll('.qty-btn.plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            const input = cartItem.querySelector('.qty-input');
            let value = parseInt(input.value);
            
            if (value < 10) {
                input.value = value + 1;
                updateCartTotals();
                showNotification('Quantity updated!');
            }
        });
    });
    
    // Quantity decrease
    document.querySelectorAll('.qty-btn.minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            const input = cartItem.querySelector('.qty-input');
            let value = parseInt(input.value);
            
            if (value > 1) {
                input.value = value - 1;
                updateCartTotals();
                showNotification('Quantity updated!');
            }
        });
    });
    
    // Remove item
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Remove this item from cart?')) {
                const cartItem = this.closest('.cart-item');
                cartItem.style.opacity = '0';
                cartItem.style.transform = 'translateX(-100%)';
                
                setTimeout(() => {
                    cartItem.remove();
                    updateCartTotals();
                    showNotification('Item removed from cart');
                    
                    // Check if cart is empty
                    if (document.querySelectorAll('.cart-item').length === 0) {
                        showEmptyCart();
                    }
                }, 300);
            }
        });
    });
    
    // Apply promo code
    document.querySelector('.apply-promo-btn').addEventListener('click', function() {
        const promoInput = document.querySelector('.promo-input');
        const promoCode = promoInput.value.trim().toUpperCase();
        
        if (promoCode === 'CHMSU2025') {
            const subtotal = parseFloat(document.querySelector('.subtotal-amount').textContent.replace('₱', '').replace(',', ''));
            const discount = subtotal * 0.1; // 10% discount
            
            document.querySelector('.discount-amount').textContent = '-₱' + discount.toFixed(2);
            showNotification('Promo code applied! 10% discount');
            promoInput.value = '';
            updateCartTotals();
        } else if (promoCode === '') {
            showNotification('Please enter a promo code', 'error');
        } else {
            showNotification('Invalid promo code', 'error');
        }
    });
    
    // Checkout button
    document.querySelector('.checkout-btn').addEventListener('click', function() {
        alert('Proceeding to checkout...\n\nThis is a demo. In production, this would redirect to the checkout page.');
    });
    
    // Add recommended items
    document.querySelectorAll('.add-rec-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            showNotification('Item added to cart!');
            
            // Update cart count
            let currentCount = parseInt(document.querySelector('.cart-count').textContent);
            document.querySelector('.cart-count').textContent = currentCount + 1;
        });
    });
    
    // Show empty cart message
    function showEmptyCart() {
        const cartItems = document.querySelector('.cart-items');
        cartItems.innerHTML = `
            <div style="text-align: center; padding: 60px 20px;">
                <i class="fas fa-shopping-cart" style="font-size: 5rem; color: #ccc; margin-bottom: 20px;"></i>
                <h2 style="color: var(--forest-green); margin-bottom: 15px;">Your cart is empty</h2>
                <p style="color: #666; margin-bottom: 30px;">Add some items to get started!</p>
                <a href="product.php" style="display: inline-block; padding: 15px 30px; background-color: var(--crimson); color: white; text-decoration: none; border-radius: 10px; font-weight: 600;">
                    Shop Now
                </a>
            </div>
        `;
        
        // Update cart count
        document.querySelector('.cart-count').textContent = '0';
    }
    
    // Notification function
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background-color: ${type === 'success' ? '#0a5c36' : '#ff4444'};
            color: white;
            padding: 15px 25px;
            border-radius: 50px;
            font-weight: 600;
            z-index: 10000;
            animation: slideIn 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 2000);
    }
    
    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Initial totals calculation
    updateCartTotals();
});
