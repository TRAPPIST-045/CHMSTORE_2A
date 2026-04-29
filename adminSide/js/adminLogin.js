/**
 * adminLogin.js — real form submission.
 * Shows a spinner, then lets the browser POST natively (PHP validates).
 */
document.addEventListener("DOMContentLoaded", () => {

    // 1. Password visibility toggle
    const passwordInput     = document.getElementById("adminPassword");
    const togglePasswordBtn = document.getElementById("togglePasswordBtn");
    const eyeIcon           = document.getElementById("eyeIcon");

    if (togglePasswordBtn && passwordInput) {
        togglePasswordBtn.addEventListener("click", () => {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        });
    }

    // 2. Spinner during submit (form posts natively to adminLogin.php)
    const form  = document.getElementById("adminLoginForm");
    const btn   = document.getElementById("loginSubmitBtn");

    if (form && btn) {
        form.addEventListener("submit", function (e) {
            const u = document.getElementById("adminUsername").value.trim();
            const p = passwordInput.value.trim();
            if (!u || !p) {
                e.preventDefault();
                return;
            }
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Authenticating...';
            btn.style.opacity       = "0.9";
            btn.style.pointerEvents = "none";
            // Let the form submit naturally — PHP redirects on success.
        });
    }
});
