<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE - Contact Us</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>
<body>
    <div class="background-title">CHMSTORE</div>

    <button class="nav-back">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    
    <button class="nav-home">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M3 9L12 2L21 9V20C21 20.53 20.79 21.04 20.41 21.41C20.04 21.79 19.53 22 19 22H5C4.47 22 3.96 21.79 3.59 21.41C3.21 21.04 3 20.53 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span>Home</span>
    </button>

    <div class="contact-container">
        <div class="contact-form">
            <div class="form-header">
                <h1 class="form-heading">Get In Touch</h1>
                <p class="form-subheading">We'd love to hear from you. Send us a message!</p>
            </div>

            <div class="success-message hidden">
                <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="10" fill="#0a5c36"/>
                    <path d="M8 12L11 15L16 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3>Message Sent!</h3>
                <p>Thank you for reaching out. We'll get back to you soon.</p>
            </div>

           <form id="contactForm">
    <div class="form-columns">
        <div class="form-left">
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>

            <div class="input-group">
                <label for="phone">Phone Number <span class="optional">(Optional)</span></label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
            </div>

            <button type="submit" class="submit-button">
                <span class="button-text">Send Message</span>
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>

        <div class="form-right">
            <div class="input-group">
                <label for="message">
                    Message
                    <span class="char-counter"><span id="charCount">0</span>/500</span>
                </label>
                <textarea id="message" name="message" placeholder="Write your message here..." maxlength="500" required></textarea>
            </div>
        </div>
    </div>
</form>

            <div class="form-footer">
                <div class="contact-info">
                    <div class="info-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>support@chmstore.edu</span>
                    </div>
                    <div class="info-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M22 16.92V19.92C22 20.49 21.54 20.97 20.97 21C20.72 21.01 20.47 21.02 20.21 21.02C10.44 21.02 2.56 13.16 2.56 3.42C2.56 3.16 2.57 2.91 2.58 2.66C2.61 2.09 3.09 1.63 3.66 1.63H6.66C7.19 1.63 7.64 2.05 7.67 2.58C7.72 3.64 7.89 4.67 8.17 5.66C8.3 6.11 8.15 6.59 7.79 6.89L5.79 8.62C7.34 11.94 10.01 14.61 13.33 16.16L15.06 14.16C15.36 13.8 15.84 13.65 16.29 13.78C17.28 14.06 18.31 14.23 19.37 14.28C19.9 14.31 20.32 14.76 20.32 15.29V18.29C20.33 18.92 19.88 19.41 19.25 19.41H19.22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>+1 (555) 123-4567</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/contact.js"></script>
</body>
</html>
