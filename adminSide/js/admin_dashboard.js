document.addEventListener("DOMContentLoaded", () => {
    // ==========================================
    // NOTIFICATION PANEL TOGGLE
    // ==========================================
    const notifTrigger = document.getElementById("notifTrigger");
    const notifPanel   = document.getElementById("notifPanel");
    const closeNotif   = document.getElementById("closeNotif");

    if (notifTrigger && notifPanel) {
        notifTrigger.addEventListener("click", (e) => {
            e.stopPropagation();
            notifPanel.classList.toggle("show");
        });
    }

    if (closeNotif) {
        closeNotif.addEventListener("click", () => {
            notifPanel.classList.remove("show");
        });
    }

    // Close when clicking outside
    document.addEventListener("click", (e) => {
        if (notifPanel && !notifPanel.contains(e.target) && notifTrigger && !notifTrigger.contains(e.target)) {
            notifPanel.classList.remove("show");
        }
    });
});