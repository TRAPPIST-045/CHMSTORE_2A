window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    //const bgSub = document.querySelector('.background-sub');

    if (scrollY > window.innerHeight) {
        document.body.style.backgroundColor = 'var(--accent-blue)';
        document.body.style.transition = 'background-color 0.3s ease';
        bgSub.style.color = 'var(--off-white)';
    } else {
        document.body.style.backgroundColor = 'var(--off-white)';
        bgSub.style.color = 'var(--crimson)';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const passwordToggleButton = document.querySelector('.password-toggle');
    const eyeIconShow = document.querySelector('.eye-icon:not(.hidden)');
    const eyeIconHide = document.querySelector('.eye-icon.hidden');

    if (passwordToggleButton && passwordInput && eyeIconShow && eyeIconHide) {
        passwordToggleButton.addEventListener('click', function(e) {
            e.preventDefault();
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIconShow.classList.add('hidden');
                eyeIconHide.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIconShow.classList.remove('hidden');
                eyeIconHide.classList.add('hidden');
            }
        });
    }

    const navBackButton = document.querySelector('.nav-back');
    const navSignupButton = document.querySelector('.nav-signup');
    const signupLink = document.querySelector('.signup-link');

    if (navBackButton) {
        navBackButton.addEventListener('click', e => {
            e.preventDefault();
            window.location.href = 'index.php';
        });
    }

    if (navSignupButton) {
        navSignupButton.addEventListener('click', e => {
            e.preventDefault();
            window.location.href = '/signup';
        });
    }

    if (signupLink) {
        signupLink.addEventListener('click', e => {
            e.preventDefault();
            window.location.href = 'register.php';
        });
    }

    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const studentId = document.getElementById('studentId').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!studentId || !email || !password) {
                alert('Please fill in all fields');
                return;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address');
                return;
            }

            alert(`Login successful!\n\nStudent ID: ${studentId}\nEmail: ${email}`);
        });
    }

    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            this.style.borderColor = this.value.trim() === '' ? '#f8498c' : '#2B85C1';
        });
        input.addEventListener('focus', function() {
            this.style.borderColor = '#2B85C1';
        });
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') this.style.borderColor = '#e0e0e0';
        });
    });

    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailPattern.test(this.value)) {
                this.style.borderColor = '#f8498c';
            }
        });
    }

    const loginContainer = document.querySelector('.login-container');
    if (loginContainer) {
        setTimeout(() => { loginContainer.style.opacity = '1'; }, 100);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && document.activeElement.tagName !== 'BUTTON') {
            const submitButton = document.querySelector('.login-button');
            if (submitButton) submitButton.click();
        }
    });
});