<<<<<<< HEAD
<?php session_start(); ?>   <!-- ← THIS WAS MISSING – NOW ADDED -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE • Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        :root {
            --forest-green: #0a5c36;
            --crimson: #f8498c;
            --crimson-light: #F07AAF;
            --off-white: #FCF6F5;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0a5c36 0%, #083f26 100%);
        }
        
        .login-card {
            background: rgba(252, 246, 245, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px -12px rgb(248 73 140 / 0.25);
        }
        
        .brand-logo {
            font-family: 'Gokil', sans-serif;
            font-size: 4.5rem;
            line-height: 0.85;
            letter-spacing: -6px;
            transform: scaleY(1.6);
        }
        
        input:focus {
            border-color: var(--crimson);
            box-shadow: 0 0 0 4px rgba(248, 73, 140, 0.2);
        }
        
        .submit-btn {
            transition: all 0.3s ease;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgb(248 73 140);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    
    <div class="w-full max-w-lg">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="brand-logo text-[#FCF6F5]">CHMSTORE</h1>
            <p class="text-[#F07AAF] text-2xl font-bold tracking-[4px] mt-2" style="font-family: 'SuperBlocky', sans-serif;">
                ADMIN PORTAL
            </p>
            <p class="text-[#FCF6F5]/80 text-sm mt-1">CHMSU Campus Store • Inventory Control</p>
        </div>

        <!-- Login Card -->
        <div class="login-card rounded-3xl p-10 md:p-12">
            <form action="../app/controllers/adminLoginController.php" method="POST" class="space-y-8">
                
                <!-- ERROR MESSAGE (Session-based) -->
                <?php if (isset($_SESSION['login_error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-4 rounded-2xl text-center text-sm font-medium mb-6">
                        ❌ <?php echo $_SESSION['login_error']; ?>
                    </div>
                    <?php unset($_SESSION['login_error']); ?> <!-- clear after showing -->
                <?php endif; ?>

                <!-- Username -->
                <div>
                    <label class="block text-[#0a5c36] text-sm font-semibold mb-2 tracking-widest">USERNAME</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-5 top-1/2 -translate-y-1/2 text-[#0a5c36]/40"></i>
                        <input 
                            type="text" 
                            name="username" 
                            id="username"
                            required
                            class="w-full pl-12 pr-6 py-5 bg-white border border-transparent focus:border-[#f8498c] rounded-2xl text-lg placeholder:text-gray-400 outline-none transition-all"
                            placeholder="admin@chmsu.edu.ph">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-[#0a5c36] text-sm font-semibold mb-2 tracking-widest">PASSWORD</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-[#0a5c36]/40"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            required
                            class="w-full pl-12 pr-12 py-5 bg-white border border-transparent focus:border-[#f8498c] rounded-2xl text-lg placeholder:text-gray-400 outline-none transition-all"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" 
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-[#0a5c36]/40 hover:text-[#f8498c]">
                            <i class="fa-solid fa-eye" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="w-5 h-5 accent-[#f8498c]">
                        <span class="text-[#0a5c36] font-medium">Remember me</span>
                    </label>
                    <a href="#" class="text-[#f8498c] hover:underline font-medium">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    name="adminSubmit"
                    id="adminSubmit"              
                    class="submit-btn w-full bg-[#f8498c] hover:bg-[#e0387a] text-white font-bold text-xl py-6 rounded-2xl flex items-center justify-center gap-3">
                    <span>SIGN IN TO ADMIN</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-[#FCF6F5]/60 text-sm">
                © 2026 CHMSTORE • CHMSU Campus Store<br>
                Powered by CHMSU Admin System
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
        
        // Press Enter to submit
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const btn = document.getElementById('adminSubmit');
                if (btn) btn.click();
            }
        });
    </script>
</body>
</html>
=======
<?php
require '../controller/Controller.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['adminUsername'] ?? '');
    $p = trim($_POST['adminPassword'] ?? '');
    if (UserModel::login($u, $p)) {
        MainController::redirect('admin_productlist.php');
    }
    $error = 'Invalid username or password';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | CHMSTORE</title>
    <link rel="stylesheet" href="css/adminLogin.css">
    <link rel="stylesheet" href="css/adminLoginV2.css">
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
                <a class="nav-pill nav-disabled"><i class="fas fa-th-large"></i> Dashboard</a>
                <a class="nav-pill nav-disabled"><i class="fas fa-box"></i> Products</a>
                <a class="nav-pill nav-disabled"><i class="fas fa-shopping-cart"></i> Orders</a>
                <a class="nav-pill nav-disabled"><i class="fas fa-clipboard-list"></i> Inventory</a>
                <a class="nav-pill nav-disabled"><i class="fas fa-address-book"></i> Contact</a>
                <a href="#" class="nav-pill active"><i class="fas fa-key"></i> Pass</a>
            </div>
            <div class="nav-right-actions">
                <i class="fas fa-lock lock-icon"></i>
            </div>
        </nav>

        <main class="login-centered-area">
            <div class="login-wrapper">
                <div class="login-header-text"><h2>Login</h2></div>

                <?php if ($error): ?>
                    <div class="login-error-banner" data-testid="login-error">
                        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form id="adminLoginForm" class="login-card" method="POST" action="adminLogin.php" novalidate>
                    <div class="input-group">
                        <label>Username</label>
                        <input type="text" id="adminUsername" name="adminUsername"
                               class="input-field minimal-input"
                               placeholder="iamsuperadmin" required autocomplete="username">
                    </div>

                    <div class="input-group" style="margin-top: 20px;">
                        <label>Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="adminPassword" name="adminPassword"
                                   class="input-field minimal-input"
                                   placeholder="Enter password" required autocomplete="current-password">
                            <button type="button" id="togglePasswordBtn" class="password-toggle">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="login-actions">
                        <button id="loginSubmitBtn" type="submit" class="btn-primary login-btn-green" data-testid="login-submit-btn">
                            Log in
                        </button>
                        <a href="#" class="forgot-link">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="js/adminLogin.js"></script>
</body>
</html>
>>>>>>> ee6c9c3 (This is initial commit)
