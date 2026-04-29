document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const subjectInput = document.getElementById('subject');
    const messageTextarea = document.getElementById('message');
    const submitButton = document.querySelector('.submit-button');
    const successMessage = document.querySelector('.success-message');
    const charCount = document.getElementById('charCount');

    if (messageTextarea && charCount) {
        messageTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length;
            charCount.style.color = length > 450 ? '#f8498c' : length > 400 ? '#ff9800' : '#666';
        });
    }

    const navBackButton = document.querySelector('.nav-back');
    const navHomeButton = document.querySelector('.nav-home');

    if (navBackButton) navBackButton.addEventListener('click', e => { e.preventDefault(); window.history.back(); });
    if (navHomeButton) navHomeButton.addEventListener('click', e => { e.preventDefault(); window.location.href = '/'; });

    if (phoneInput) {
        phoneInput.addEventListener('input', e => {
            let value = e.target.value.replace(/\D/g, '').slice(0, 10);
            if (value.length >= 6) value = `(${value.slice(0, 3)}) ${value.slice(3, 6)}-${value.slice(6)}`;
            else if (value.length >= 3) value = `(${value.slice(0, 3)}) ${value.slice(3)}`;
            e.target.value = value;
        });
    }

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const name = nameInput.value.trim();
            const email = emailInput.value.trim();
            const phone = phoneInput.value.trim();
            const subject = subjectInput.value.trim();
            const message = messageTextarea.value.trim();

            if (!name || !email || !subject || !message) return showNotification('Please fill in all required fields', 'error');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) return showNotification('Please enter a valid email address', 'error');
            if (message.length < 10) return showNotification('Message must be at least 10 characters long', 'error');

            submitButton.classList.add('loading');
            submitButton.disabled = true;

            setTimeout(() => {
                submitButton.classList.remove('loading');
                submitButton.disabled = false;
                contactForm.classList.add('hidden');
                successMessage.classList.remove('hidden');
                setTimeout(() => { contactForm.reset(); charCount.textContent = '0'; }, 3000);
                setTimeout(() => { successMessage.classList.add('hidden'); contactForm.classList.remove('hidden'); }, 5000);
            }, 2000);
        });
    }

    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) this.style.borderColor = '#f8498c';
            else if (this.value.trim()) this.style.borderColor = '#0a5c36';
        });
        input.addEventListener('focus', function() { this.style.borderColor = '#2B85C1'; });
        input.addEventListener('input', function() { if (this.value.trim()) this.style.borderColor = '#e0e0e0'; });
    });

    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailPattern.test(this.value)) {
                this.style.borderColor = '#f8498c';
                showNotification('Please enter a valid email address', 'warning');
            }
        });
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed; top: 100px; right: 20px; padding: 15px 25px;
            background-color: ${type === 'error' ? '#f8498c' : type === 'warning' ? '#ff9800' : '#0a5c36'};
            color: white; border-radius: 25px; font-family: 'Poppins', sans-serif;
            font-size: 14px; font-weight: 500; box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 1000; animation: slideInRight 0.3s ease-out; max-width: 300px;
        `;
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => document.body.removeChild(notification), 300);
        }, 3000);
    }

    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight { from { transform: translateX(400px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes slideOutRight { from { transform: translateX(0); opacity: 1; } to { transform: translateX(400px); opacity: 0; } }
    `;
    document.head.appendChild(style);

    const contactContainer = document.querySelector('.contact-container');
    if (contactContainer) setTimeout(() => { contactContainer.style.opacity = '1'; }, 100);

    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            if (submitButton && !submitButton.disabled) submitButton.click();
        }
    });

    if (messageTextarea) {
        messageTextarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    }
});