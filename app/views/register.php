<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE - Sign Up</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/css/register.css">
</head>
<body>
    <div class="background-title">CHMSTORE</div>
    <h1 class="background-sub">STUDENT SIGN UP</h1>

    <button class="nav-back">
        <i class="fas fa-arrow-left"></i>
    </button>

    <div class="login-container">
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

    <div class="login-form">
        <h1 class="form-heading">Join Us</h1>

        <form id="registerForm">
            <div class="input-group">
                <label for="studentId">Student ID</label>
                <input type="text" id="studentId" name="studentId" placeholder="Enter your Student ID" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your Email" required>
            </div>
            <button type="submit" class="login-button">Sign Up</button>
        </form>

        <div class="form-footer">
            <p>Already have an account? <a href="login.php" class="signup-link">Login</a></p>
        </div>
    </div>
</div>

    <script src="../../public/assets/js/register.js"></script>
</body>
</html>