document.addEventListener("DOMContentLoaded", () => {
    
    const smartNav = document.getElementById("smartNav");
    let lastScrollY = window.scrollY;
    
    // The top utility bar is about 35px high
    const topBarHeight = 35;

    window.addEventListener("scroll", () => {
        const currentScrollY = window.scrollY;

        // 1. Make it sticky after scrolling past the utility bar
        if (currentScrollY > topBarHeight) {
            smartNav.classList.add("sticky");
        } else {
            smartNav.classList.remove("sticky");
        }

        // 2. Hide on scroll DOWN, Show on scroll UP
        if (currentScrollY > lastScrollY && currentScrollY > 150) {
            // Scrolling DOWN
            smartNav.classList.add("hidden");
        } else {
            // Scrolling UP
            smartNav.classList.remove("hidden");
        }

        lastScrollY = currentScrollY;
    });

    // Optional: Add simple parallax to hero images on mouse movement
    const heroVisuals = document.querySelector('.hero-visuals');
    const items = document.querySelectorAll('.display-item');

    if (heroVisuals && items.length > 0) {
        heroVisuals.addEventListener('mousemove', (e) => {
            const rect = heroVisuals.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;

            items.forEach((item, index) => {
                const depth = (index + 1) * 30; // Different depth for each item
                item.style.transform = `translate(${x * depth}px, ${y * depth}px) rotate(${item.style.transform.match(/rotate\(([^)]+)\)/)?.[1] || '0deg'})`;
            });
        });

        heroVisuals.addEventListener('mouseleave', () => {
            items.forEach((item) => {
                // Reset transform but keep the original rotation defined in CSS
                const originalRotation = item.classList.contains('item-1') ? '-10deg' :
                                         item.classList.contains('item-2') ? '5deg' :
                                         item.classList.contains('item-3') ? '15deg' : '-15deg';
                item.style.transform = `translate(0px, 0px) rotate(${originalRotation})`;
            });
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    
    // --- 1. CAROUSEL SLIDER LOGIC ---
    const carousel = document.getElementById('productCarousel');
    const slideLeftBtn = document.getElementById('slideLeft');
    const slideRightBtn = document.getElementById('slideRight');

    if (carousel && slideLeftBtn && slideRightBtn) {
        // Calculate scroll amount based on card width + gap
        const scrollAmount = 280; 

        slideLeftBtn.addEventListener('click', () => {
            carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });

        slideRightBtn.addEventListener('click', () => {
            carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        // Optional: Mouse Drag to Scroll (App-like feel)
        let isDown = false;
        let startX;
        let scrollLeft;

        carousel.addEventListener('mousedown', (e) => {
            isDown = true;
            carousel.style.cursor = 'grabbing';
            startX = e.pageX - carousel.offsetLeft;
            scrollLeft = carousel.scrollLeft;
        });
        carousel.addEventListener('mouseleave', () => {
            isDown = false;
            carousel.style.cursor = 'grab';
        });
        carousel.addEventListener('mouseup', () => {
            isDown = false;
            carousel.style.cursor = 'grab';
        });
        carousel.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - carousel.offsetLeft;
            const walk = (x - startX) * 2; // Scroll speed multiplier
            carousel.scrollLeft = scrollLeft - walk;
        });
    }

    // --- 2. FLASH SALE COUNTDOWN TIMER ---
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');

    if (hoursEl && minutesEl && secondsEl) {
        // Start from 08:17:56 (from your screenshot)
        let totalSeconds = (8 * 3600) + (17 * 60) + 56;

        setInterval(() => {
            if (totalSeconds <= 0) return; // Stop at 0
            
            totalSeconds--;

            const h = Math.floor(totalSeconds / 3600);
            const m = Math.floor((totalSeconds % 3600) / 60);
            const s = totalSeconds % 60;

            // Format with leading zeros
            hoursEl.innerText = h.toString().padStart(2, '0');
            minutesEl.innerText = m.toString().padStart(2, '0');
            secondsEl.innerText = s.toString().padStart(2, '0');
        }, 1000);
    }

    // --- 3. FILTER CHIP TOGGLE LOGIC ---
    const chips = document.querySelectorAll('.chip');
    chips.forEach(chip => {
        chip.addEventListener('click', function() {
            // Remove active class from all
            chips.forEach(c => c.classList.remove('active'));
            // Add active class to clicked
            this.classList.add('active');
        });
    });

});

// --- 4. WISHLIST HEART TOGGLE ---
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');
    
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent page jump if it's in a link later
            
            // Toggle the 'active' class on the button itself
            this.classList.toggle('active');
            
            // Find the icon inside the button
            const icon = this.querySelector('i');
            
            // Swap between regular (outline) and solid heart
            if (this.classList.contains('active')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
            }
        });
    });

    // --- 5. NOTIFICATION POPOUT LOGIC ---
    const notifTrigger = document.getElementById('notifTrigger');
    const notifPanel = document.getElementById('notifPanel');
    const closeNotif = document.getElementById('closeNotif');

    if (notifTrigger && notifPanel) {
        // Toggle panel on bell click
        notifTrigger.addEventListener('click', (e) => {
            // Prevent the click from immediately bubbling to the document
            e.stopPropagation();
            notifPanel.classList.toggle('show');
        });

        // Close on 'X' click
        closeNotif.addEventListener('click', (e) => {
            e.stopPropagation();
            notifPanel.classList.remove('show');
        });

        // Prevent closing when clicking INSIDE the panel
        notifPanel.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        // Close panel when clicking ANYWHERE ELSE on the document
        document.addEventListener('click', () => {
            if (notifPanel.classList.contains('show')) {
                notifPanel.classList.remove('show');
            }
        });

        // Simple Tab Switching logic for Notifications
        const notifTabs = document.querySelectorAll('.notif-tab');
        notifTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                notifTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }