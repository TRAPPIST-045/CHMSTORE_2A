<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE - Student Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="background-title">CHMSTORE</div>
    <h1 class="background-sub">STUDENT LOGIN</h1>

    <button class="nav-back">
    <i class="fas fa-arrow-left"></i>
    </button>
    

    <div class="login-container">
    <div class="login-form">
        <h1 class="form-heading">Welcome Back</h1>

        <form id="loginForm">
            <div class="input-group">
                <label for="studentId">Student ID</label>
                <input type="text" id="studentId" name="studentId" placeholder="Enter your Student ID" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Enter your Password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye eye-icon"></i>
                        <i class="fas fa-eye-slash eye-icon hidden"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>

        <div class="form-footer">
            <p>Don't have an account? <a href="register.php" class="signup-link">Sign Up</a></p>
        </div>
    </div>

    <div class="login-photocards">
        <div class="login-card-wrapper left">
            <div class="login-card lc-left"></div>
        </div>
        <div class="login-card-wrapper middle">
            <div class="login-card lc-middle"></div>
        </div>
        <div class="login-card-wrapper right">
            <div class="login-card lc-right"></div>
        </div>
    </div>
</div>
    <script src="assets/js/login.js"></script>
</body>
</html>
