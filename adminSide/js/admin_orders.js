/**
 * admin_orders.js
 * - Reads orders from the PHP-rendered table rows (data-* attributes)
 * - Status transitions persist via fetch -> admin_update_order.php
 * - Client-side filters / search / summary panel / modals / payment stub
 */
document.addEventListener("DOMContentLoaded", () => {
    // --- CURRENT ADMIN (from server-side) ---
    const currentAdminName = (window.CURRENT_ADMIN && window.CURRENT_ADMIN.name) || "Admin";

    // --- DOM REFERENCES ---
    const orderRowsContainer = document.getElementById("ordersTableBody");
    let   allOrderRows       = document.querySelectorAll(".order-row");
    const statusFilterPills  = document.querySelectorAll(".status-pill");
    const orderSearchInput   = document.getElementById("orderSearchInput");

    // Summary panel
    const orderSummaryPanel        = document.getElementById("orderSummaryPanel");
    const closeSummaryPanelBtn     = document.getElementById("closeSummaryPanelBtn");
    const summaryDynamicStatusActions = document.getElementById("summaryDynamicStatusActions");

    const summaryOrderId          = document.getElementById("summaryOrderId");
    const summaryOrderDate        = document.getElementById("summaryOrderDate");
    const summaryStudentName      = document.getElementById("summaryStudentName");
    const summaryStudentEmail     = document.getElementById("summaryStudentEmail");
    const summaryPaymentMethod    = document.getElementById("summaryPaymentMethod");
    const summaryPaymentStatus    = document.getElementById("summaryPaymentStatus");
    const summaryReferenceNumber  = document.getElementById("summaryReferenceNumber");
    const summaryCurrentStatus    = document.getElementById("summaryCurrentStatus");
    const summaryPickupCode       = document.getElementById("summaryPickupCode");
    const summaryOrderItemsDiv    = document.getElementById("summaryOrderItems");
    const summarySubtotal         = document.getElementById("summarySubtotal");
    const summaryTotal            = document.getElementById("summaryTotal");

    // Toasts
    const notificationContainer = document.getElementById("notificationContainer");

    // Generic confirm modal
    const confirmationModal = document.getElementById("confirmationModal");
    const modalTitle        = document.getElementById("modalTitle");
    const modalMessage      = document.getElementById("modalMessage");
    const modalCancelBtn    = document.getElementById("modalCancelBtn");
    const modalConfirmBtn   = document.getElementById("modalConfirmBtn");
    let   genericModalCallback = null;

    // Cancel reason modal
    const cancelReasonModal        = document.getElementById("cancelReasonModal");
    const cancelReasonOrderIdSpan  = document.getElementById("cancelReasonOrderId");
    const cancelReasonOptionsDiv   = document.getElementById("cancelReasonOptions");
    const otherReasonTextarea      = document.getElementById("otherReasonText");
    const cancelReasonModalCloseBtn= document.getElementById("cancelReasonModalCloseBtn");
    const confirmCancelReasonBtn   = document.getElementById("confirmCancelReasonBtn");
    let   cancelReasonModalCallback = null;

    // Payment stub modal
    const paymentStubDisplayModal  = document.getElementById("paymentStubDisplayModal");
    const paymentStubOrderIdSpan   = document.getElementById("paymentStubOrderId");
    const paymentStubModalContent  = document.getElementById("paymentStubModalContent");
    const closePaymentStubModalBtn = document.getElementById("closePaymentStubModalBtn");
    const printStubModalBtn        = document.getElementById("printStubModalBtn");
    let   currentStubOrderData = null;

    // ---------- HELPERS ----------
    function formatCurrentDateTime() {
        return new Date().toLocaleString("en-US", {
            year: "numeric", month: "short", day: "numeric",
            hour: "2-digit", minute: "2-digit", hour12: true,
        }).replace(",", " /");
    }
    function formatCurrency(amount) { return `₱${parseFloat(amount || 0).toFixed(2)}`; }

    function showNotification(message, type = "info", duration = 3000) {
        if (!notificationContainer) return;
        const toast = document.createElement("div");
        toast.classList.add("toast-message", `toast-${type}`);
        const icon = type === "success" ? "fa-check-circle"
                   : type === "error"   ? "fa-times-circle" : "fa-info-circle";
        toast.innerHTML = `<i class="fas ${icon}"></i> ${message}`;
        notificationContainer.prepend(toast);
        requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add("show")));
        setTimeout(() => {
            toast.classList.remove("show");
            setTimeout(() => toast.remove(), 400);
        }, duration);
    }

    // Backend call
    async function updateOrderOnServer(orderId, status, extra = {}) {
        const body = new URLSearchParams({ order_id: orderId, status, ...extra });
        const resp = await fetch("admin_update_order.php", {
            method: "POST",
            headers: { "X-Requested-With": "XMLHttpRequest", "Content-Type": "application/x-www-form-urlencoded" },
            body,
        });
        if (!resp.ok) throw new Error("Network error " + resp.status);
        const data = await resp.json();
        if (!data.ok) throw new Error(data.error || "Update failed");
        return data;
    }

    // ---------- CONFIRM MODAL ----------
    function showConfirmationModal(title, message, callback) {
        modalTitle.textContent   = title;
        modalMessage.textContent = message;
        genericModalCallback = callback;
        confirmationModal.classList.add("show");

        const confirmHandler = () => { genericModalCallback && genericModalCallback(true);  hideConfirmationModal(); };
        const cancelHandler  = () => { genericModalCallback && genericModalCallback(false); hideConfirmationModal(); };
        modalConfirmBtn.addEventListener("click", confirmHandler, { once: true });
        modalCancelBtn .addEventListener("click", cancelHandler,  { once: true });

        const overlayHandler = (e) => { if (e.target === confirmationModal) { cancelHandler(); } };
        confirmationModal.addEventListener("click", overlayHandler, { once: true });

        const esc = (e) => { if (e.key === "Escape") cancelHandler(); };
        document.addEventListener("keydown", esc, { once: true });
    }
    function hideConfirmationModal() {
        confirmationModal.classList.remove("show");
        genericModalCallback = null;
    }

    // ---------- CANCEL REASON MODAL ----------
    function showCancelReasonModal(orderId, callback) {
        cancelReasonOrderIdSpan.textContent = `#${orderId}`;
        cancelReasonOptionsDiv.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
        otherReasonTextarea.value = "";
        cancelReasonModalCallback = callback;
        cancelReasonModal.classList.add("show");

        const confirmHandler = () => {
            const sel = cancelReasonOptionsDiv.querySelector('input[name="cancelReason"]:checked');
            const other = otherReasonTextarea.value.trim();
            if (!sel && !other) { showNotification("Please select or specify a reason.", "error"); return; }
            let reason = sel ? sel.value : "";
            if (reason === "Other Reason") {
                if (!other) { showNotification('Specify the "Other Reason".', "error"); return; }
                reason = `Other: ${other}`;
            } else if (!reason && other) reason = `Specified: ${other}`;
            cancelReasonModalCallback({ confirmed: true, reason: reason || "Not specified" });
            hideCancelReasonModal();
        };
        const closeHandler = () => { cancelReasonModalCallback({ confirmed: false }); hideCancelReasonModal(); };

        confirmCancelReasonBtn.addEventListener("click", confirmHandler, { once: true });
        cancelReasonModalCloseBtn.addEventListener("click", closeHandler, { once: true });
        cancelReasonModal.addEventListener("click", (e) => { if (e.target === cancelReasonModal) closeHandler(); }, { once: true });
        document.addEventListener("keydown", (e) => { if (e.key === "Escape") closeHandler(); }, { once: true });
    }
    function hideCancelReasonModal() {
        cancelReasonModal.classList.remove("show");
        cancelReasonOrderIdSpan.textContent = "";
        cancelReasonModalCallback = null;
    }

    // ---------- PAYMENT STUB MODAL ----------
    function showPaymentStubModal(orderRowElement, stubType = "payment_stub") {
        currentStubOrderData = orderRowElement;
        const data = orderRowElement.dataset;
        paymentStubOrderIdSpan.textContent = `#${data.orderId}`;
        paymentStubModalContent.innerHTML  = getPrintableDocumentContent(orderRowElement, stubType);
        paymentStubDisplayModal.classList.add("show");

        closePaymentStubModalBtn.onclick = hidePaymentStubModal;
        printStubModalBtn.onclick = () => {
            if (currentStubOrderData) {
                showNotification(`Printing ${stubType.replace("_"," ")} for #${data.orderId}.`, "info");
                printDocument(currentStubOrderData, stubType);
            }
        };
        paymentStubDisplayModal.addEventListener("click",
            (e) => { if (e.target === paymentStubDisplayModal) hidePaymentStubModal(); },
            { once: true });
    }
    function hidePaymentStubModal() {
        paymentStubDisplayModal.classList.remove("show");
        paymentStubOrderIdSpan.textContent = "";
        paymentStubModalContent.innerHTML  = "Loading…";
        closePaymentStubModalBtn.onclick = null;
        printStubModalBtn.onclick = null;
        currentStubOrderData = null;
    }

    // ---------- STATUS DISPLAY ----------
    function updateOrderStatusDisplay(rowElement, newStatus, newPayment = null) {
        rowElement.dataset.orderStatus = newStatus;
        if (newPayment !== null) rowElement.dataset.paymentStatus = newPayment;

        const statusCell = rowElement.querySelector(".status-cell");
        if (statusCell) {
            statusCell.className = "status-cell status-" + newStatus.toLowerCase().replace(/\s/g, "-");
            statusCell.innerHTML = `<span class="status-dot"></span> ${newStatus}`;
        }
        if (orderSummaryPanel.classList.contains("show") &&
            summaryOrderId.textContent === `#${rowElement.dataset.orderId}`) {
            summaryCurrentStatus.textContent = newStatus;
            if (newPayment !== null) summaryPaymentStatus.textContent = newPayment;
        }
    }

    // ---------- CLOSE PANEL ----------
    if (closeSummaryPanelBtn) {
        closeSummaryPanelBtn.addEventListener("click", () => {
            orderSummaryPanel.classList.remove("show");
            allOrderRows.forEach(r => r.classList.remove("active"));
        });
    }

    // ---------- POPULATE SUMMARY ----------
    function populateAndShowSummaryPanel(rowElement) {
        const data = rowElement.dataset;
        let items = [];
        try { items = JSON.parse(data.orderItems || "[]"); } catch (_) { items = []; }

        orderSummaryPanel.querySelectorAll(".summary-admin-details-group").forEach(el => el.remove());

        summaryOrderId.textContent      = `#${data.orderId || "0000"}`;
        summaryOrderDate.textContent    = data.orderDate || "N/A";
        summaryStudentName.textContent  = data.studentName || "N/A";
        summaryStudentEmail.textContent = data.studentEmail || "N/A";
        summaryPaymentMethod.textContent = data.paymentMethod || "N/A";

        const refItem = document.getElementById("summaryReferenceNumberItem");
        if (data.paymentMethod === "Online Payment" && data.referenceNumber) {
            summaryReferenceNumber.textContent = data.referenceNumber;
            refItem.style.display = "";
        } else {
            refItem.style.display = "none";
        }
        summaryPaymentStatus.textContent  = data.paymentStatus || "N/A";
        summaryCurrentStatus.textContent  = data.orderStatus   || "N/A";
        summaryPickupCode.textContent     = data.pickupCode    || "N/A";

        // Admin/date details
        const currentStatusItem = summaryCurrentStatus.closest(".summary-info-item");
        if (currentStatusItem) {
            let html = "";
            const add = (label, icon, v) => {
                if (v) html += `<div class="summary-admin-item"><span class="label"><i class="fas ${icon}"></i> ${label}:</span><span class="value">${v}</span></div>`;
            };
            add("Accepted By",   "fa-user-check",    data.acceptedBy);
            add("Accepted On",   "fa-calendar-alt",  data.acceptedDate);
            add("Processed By",  "fa-tasks",         data.processedBy);
            add("Processed On",  "fa-calendar-alt",  data.processedDate);
            add("Completed By",  "fa-calendar-check",data.completedBy);
            add("Completed On",  "fa-calendar-alt",  data.completedDate);
            add("Cancel Reason", "fa-times-circle",  data.cancelReason);
            add("Cancelled On",  "fa-calendar-alt",  data.cancelReasonDate);
            if (html) currentStatusItem.insertAdjacentHTML("afterend",
                `<div class="summary-admin-details-group">${html}</div>`);
        }

        // Items
        summaryOrderItemsDiv.innerHTML = "";
        let subtotal = 0;
        if (items.length) {
            items.forEach(it => {
                summaryOrderItemsDiv.insertAdjacentHTML("beforeend", `
                    <div class="item-entry">
                        <div class="item-name-variant">
                            <span class="item-name">${it.name}</span>
                            <span class="item-variant">${it.variant || ''}</span>
                        </div>
                        <span class="item-qty">x ${it.qty}</span>
                        <span class="item-price">${formatCurrency(it.price * it.qty)}</span>
                    </div>`);
                subtotal += parseFloat(it.price) * parseInt(it.qty, 10);
            });
        } else {
            summaryOrderItemsDiv.innerHTML = '<div class="item-entry">No items listed.</div>';
        }
        summarySubtotal.textContent = formatCurrency(subtotal);
        summaryTotal.textContent    = formatCurrency(data.total || 0);

        updateSummaryStatusActions(rowElement,
            data.orderId, data.orderStatus, data.paymentMethod, data.paymentStatus, data.pickupCode);

        orderSummaryPanel.classList.add("show");
    }

    // ---------- TABLE CLICK DELEGATION ----------
    orderRowsContainer.addEventListener("click", function (event) {
        const row  = event.target.closest(".order-row");
        const btn  = event.target.closest(".btn-table-action");
        if (!row) return;

        if (row.classList.contains("active") && orderSummaryPanel.classList.contains("show") && !btn) {
            orderSummaryPanel.classList.remove("show");
            row.classList.remove("active");
            return;
        }

        allOrderRows.forEach(r => r.classList.remove("active"));
        row.classList.add("active");

        const orderId = row.dataset.orderId;
        const status  = row.dataset.orderStatus;

        if (!btn) { populateAndShowSummaryPanel(row); return; }
        event.stopPropagation();

        const action = btn.dataset.action;
        if (action === "review") {
            populateAndShowSummaryPanel(row);
            return;
        }
        if (action === "cancel" && status !== "Completed" && status !== "Cancelled") {
            showCancelReasonModal(orderId, async (result) => {
                if (!result.confirmed) return showNotification("Cancellation aborted.", "info");
                try {
                    const data = await updateOrderOnServer(orderId, "Cancelled", {
                        cancel_reason: result.reason,
                        payment_status: row.dataset.paymentStatus === "Paid" ? "Refunded" : row.dataset.paymentStatus,
                    });
                    const ts = data.timestamp || formatCurrentDateTime();
                    row.dataset.cancelReason      = result.reason;
                    row.dataset.cancelReasonDate  = ts;
                    row.dataset.acceptedBy = row.dataset.acceptedDate = "";
                    row.dataset.processedBy = row.dataset.processedDate = "";
                    row.dataset.completedBy = row.dataset.completedDate = "";
                    updateOrderStatusDisplay(row, "Cancelled",
                        row.dataset.paymentStatus === "Paid" ? "Refunded" : row.dataset.paymentStatus);
                    row.querySelector(".table-action-buttons").innerHTML = "";
                    showNotification(`Order #${orderId} cancelled — ${result.reason}`, "success");
                    closeSummaryPanelBtn.click();
                    initializeOverviewCounts();
                    filterOrdersByStatus(document.querySelector(".status-pill.active")?.dataset.filter || "all");
                } catch (err) {
                    showNotification("Error: " + err.message, "error");
                }
            });
            return;
        }
        if (action === "issue-receipt" && status === "Completed") {
            showNotification(`Generating receipt for #${orderId}…`, "info");
            printDocument(row, "final_receipt");
        }
    });

    // ---------- DYNAMIC STATUS BUTTON ----------
    function updateSummaryStatusActions(row, orderId, status, paymentMethod, paymentStatus, pickupCode) {
        summaryDynamicStatusActions.innerHTML = "";
        let details = { actionType:"", buttonText:"", buttonClass:"btn-summary-action",
            noteText:"", newOrderStatus:status, newPaymentStatus:paymentStatus,
            confirmationTitle:"Confirm Order Update", confirmationMessage:"" };

        switch (status) {
            case "Pending":
                if (paymentMethod === "Cash at BOA") {
                    details = Object.assign(details, {
                        buttonText:"Generate Payment Stub",
                        actionType:"generate-payment-stub",
                        buttonClass:"btn-summary-action btn-status-cashier-payment",
                        noteText:"Order awaiting payment at the school cashier (BAO). Generate stub to proceed.",
                        newOrderStatus:"Processing",
                        newPaymentStatus:"Unpaid",
                        confirmationMessage:`Generate payment stub for #${orderId} (Cash at BAO) and move to 'Processing'?`,
                    });
                } else {
                    details = Object.assign(details, {
                        buttonText:"Accept Order & Confirm Payment",
                        actionType:"accept-order-confirm-payment",
                        buttonClass:"btn-summary-action btn-status-confirm-payment",
                        newOrderStatus:"Processing", newPaymentStatus:"Paid",
                        noteText:"Online order received. Acceptance confirms payment.",
                        confirmationMessage:`Accept online order #${orderId}? Payment will be marked 'Paid'.`,
                    });
                }
                break;
            case "Processing":
                details = Object.assign(details, {
                    buttonText:"Mark Ready for Pick Up",
                    actionType:"mark-ready-for-pickup",
                    buttonClass:"btn-summary-action btn-status-ready",
                    noteText:"Order is being prepared and packed.",
                    newOrderStatus:"Ready for Pickup",
                    confirmationMessage:`Mark #${orderId} as 'Ready for Pickup'?`,
                });
                break;
            case "Ready for Pickup":
                details = Object.assign(details, {
                    buttonText:"Mark as Completed",
                    actionType:"mark-completed",
                    buttonClass:"btn-summary-action btn-status-complete",
                    newOrderStatus:"Completed",
                });
                if (paymentMethod === "Cash at BOA" && paymentStatus === "Unpaid") {
                    details.noteText = `Payment due at BAO. Marking as Completed confirms cash payment. Pickup Code: ${pickupCode}.`;
                    details.newPaymentStatus = "Paid";
                    details.confirmationMessage = `Mark #${orderId} Completed and confirm cash payment?`;
                } else {
                    details.noteText = `Customer pickup via code: ${pickupCode}. Mark Completed to finalise.`;
                    details.newPaymentStatus = "Paid";
                    details.confirmationMessage = `Mark #${orderId} as Completed?`;
                }
                break;
            case "Completed":
                details.noteText = "This order has been completed. Issue a receipt from the table actions if needed.";
                break;
            case "Cancelled":
                details.noteText = `This order has been cancelled — ${row.dataset.cancelReason || "unknown reason"}.`;
                break;
            default: details.noteText = "No status actions available.";
        }

        if (details.actionType && status !== "Completed" && status !== "Cancelled") {
            const b = document.createElement("button");
            b.type = "button";
            b.className = details.buttonClass;
            b.dataset.action  = details.actionType;
            b.dataset.orderId = orderId;
            b.innerHTML = `<i class="fas fa-arrow-alt-circle-right"></i> ${details.buttonText}`;
            summaryDynamicStatusActions.appendChild(b);

            b.addEventListener("click", () => {
                showConfirmationModal(details.confirmationTitle, details.confirmationMessage, async (ok) => {
                    if (!ok) return showNotification("Update aborted.", "info");
                    try {
                        const extra = {};
                        if (details.newPaymentStatus && details.newPaymentStatus !== paymentStatus) {
                            extra.payment_status = details.newPaymentStatus;
                        }
                        const data = await updateOrderOnServer(orderId, details.newOrderStatus, extra);

                        const ts = data.timestamp || formatCurrentDateTime();
                        row.dataset.orderStatus = details.newOrderStatus;
                        if (details.newPaymentStatus) row.dataset.paymentStatus = details.newPaymentStatus;

                        if (details.newOrderStatus === "Processing")       { row.dataset.acceptedBy = currentAdminName;  row.dataset.acceptedDate = ts; }
                        if (details.newOrderStatus === "Ready for Pickup") { row.dataset.processedBy = currentAdminName; row.dataset.processedDate = ts; }
                        if (details.newOrderStatus === "Completed")        { row.dataset.completedBy = currentAdminName; row.dataset.completedDate = ts; }

                        updateOrderStatusDisplay(row, details.newOrderStatus, details.newPaymentStatus);

                        // Refresh action buttons
                        const tdActions = row.querySelector(".table-action-buttons");
                        if (details.newOrderStatus === "Completed" && tdActions) {
                            tdActions.innerHTML = `<button class="btn-table-action primary" data-action="issue-receipt"><i class="fas fa-receipt"></i> Issue Receipt</button>`;
                        } else if (details.newOrderStatus !== "Cancelled" && tdActions) {
                            tdActions.innerHTML = `
                                <button class="btn-table-action primary" data-action="review">Review</button>
                                <button class="btn-table-action cancel"  data-action="cancel">Cancel</button>`;
                        }

                        populateAndShowSummaryPanel(row);
                        initializeOverviewCounts();
                        filterOrdersByStatus(document.querySelector(".status-pill.active")?.dataset.filter || "all");

                        showNotification(`Order #${orderId} → "${details.newOrderStatus}".`, "success");
                        if (details.actionType === "generate-payment-stub") showPaymentStubModal(row, "payment_stub");
                    } catch (err) {
                        showNotification("Error: " + err.message, "error");
                    }
                });
            });
        }
        summaryDynamicStatusActions.insertAdjacentHTML("beforeend",
            `<p class="summary-actions-note">${details.noteText}</p>`);
    }

    // ---------- PRINTABLE CONTENT ----------
    function getPrintableDocumentContent(row, type = "summary_details") {
        const d = row.dataset;
        let items = []; try { items = JSON.parse(d.orderItems || "[]"); } catch (_) {}
        let html = "";
        items.forEach(it => {
            html += `<li>${it.name} (${it.variant||""}) x ${it.qty} - ${formatCurrency(it.price*it.qty)}</li>`;
        });

        const block = (k, v, date) => (v || date) ? `<p><strong>${k}:</strong> ${v||"N/A"}</p><p><strong>On:</strong> ${date||"N/A"}</p>` : "";

        let title = "CHMSTORE Order Details";
        let footer = `Present this document and pickup code at the Business Affairs Office (BAO).`;
        if (type === "payment_stub")   { title = "CHMSTORE Payment Stub";    footer = `**Payment Stub.** Present at BAO to pay order #${d.orderId}.`; }
        if (type === "final_receipt")  { title = "CHMSTORE Official Receipt"; footer = `Official receipt for order #${d.orderId}. Retain for records.`; }

        return `
        <div class="print-receipt-content">
            <h1 class="text-center">${title}</h1>
            <div class="print-details-block">
                <p><strong>Order ID:</strong> #${d.orderId}</p>
                <p><strong>Date Placed:</strong> ${d.orderDate}</p>
                <p><strong>Student Name:</strong> ${d.studentName}</p>
                <p><strong>Student Email:</strong> ${d.studentEmail}</p>
                <p><strong>Payment Method:</strong> ${d.paymentMethod}</p>
                <p><strong>Payment Status:</strong> ${d.paymentStatus}</p>
                <p><strong>Order Status:</strong> ${d.orderStatus}</p>
                ${block("Accepted By",  d.acceptedBy,  d.acceptedDate)}
                ${block("Processed By", d.processedBy, d.processedDate)}
                ${block("Completed By", d.completedBy, d.completedDate)}
                ${block("Cancel Reason",d.cancelReason,d.cancelReasonDate)}
                <p><strong>Pickup Code:</strong> <span class="pickup-code">${d.pickupCode}</span></p>
            </div>
            <h4>Ordered Items:</h4>
            <ul>${html}</ul>
            <div class="print-totals-block">
                <div class="print-total-row"><span class="label">Subtotal:</span><span class="value">${formatCurrency(d.total)}</span></div>
                <div class="print-total-row"><span class="label">Delivery Fee:</span><span class="value">${formatCurrency(0)}</span></div>
                <div class="print-total-row"><span class="label print-grand-total">Total:</span><span class="value print-grand-total">${formatCurrency(d.total)}</span></div>
            </div>
            <p class="footer-note">${footer}</p>
        </div>`;
    }

    function printDocument(row, type = "summary_details") {
        const html = getPrintableDocumentContent(row, type);
        const d = row.dataset;
        const w = window.open("", "_blank", "width=800,height=600,toolbar=no,menubar=no,scrollbars=yes");
        if (!w) { showNotification("Pop-up blocked — allow pop-ups to print.", "error"); return; }
        w.document.write(`
            <html>
            <head>
                <title>${type === "final_receipt" ? "Official Receipt" : type === "payment_stub" ? "Payment Stub" : "Order Details"} — #${d.orderId}</title>
                <link rel="stylesheet" href="css/admin_orders.css">
            </head>
            <body class="print-document-wrapper">${html}</body>
            </html>`);
        w.document.close();
        setTimeout(() => { w.focus(); w.print(); w.close(); }, 600);
    }

    // ---------- FILTERS ----------
    function filterOrdersByStatus(filterValue) {
        allOrderRows = document.querySelectorAll(".order-row");
        allOrderRows.forEach(row => {
            const s = row.dataset.orderStatus.toLowerCase().replace(/\s/g, "-");
            const f = filterValue.toLowerCase().replace(/\s/g, "-");
            row.style.display = (f === "all" || s === f) ? "" : "none";
        });
        if (orderSummaryPanel.classList.contains("show")) closeSummaryPanelBtn.click();
        hideConfirmationModal(); hideCancelReasonModal(); hidePaymentStubModal();
    }
    statusFilterPills.forEach(pill => pill.addEventListener("click", function () {
        statusFilterPills.forEach(p => p.classList.remove("active"));
        this.classList.add("active");
        filterOrdersByStatus(this.dataset.filter);
    }));

    // ---------- SEARCH ----------
    if (orderSearchInput) {
        orderSearchInput.addEventListener("input", function () {
            const q = this.value.toLowerCase().trim();
            allOrderRows = document.querySelectorAll(".order-row");
            const curr = (document.querySelector(".status-pill.active")?.dataset.filter || "all")
                         .toLowerCase().replace(/\s/g, "-");
            allOrderRows.forEach(row => {
                const s   = row.dataset.orderStatus.toLowerCase().replace(/\s/g,"-");
                const oid = row.dataset.orderId.toLowerCase();
                const nm  = row.dataset.studentName.toLowerCase();
                const passF = curr === "all" || s === curr;
                const passQ = !q || oid.includes(q) || nm.includes(q) || s.includes(q);
                row.style.display = (passF && passQ) ? "" : "none";
            });
            if (orderSummaryPanel.classList.contains("show")) closeSummaryPanelBtn.click();
        });
    }

    // ---------- NOTIF BELL ----------
    const notifTrigger = document.getElementById("notifTrigger");
    const notifPanel   = document.getElementById("notifPanel");
    const closeNotif   = document.getElementById("closeNotif");
    if (notifTrigger && notifPanel) {
        notifTrigger.addEventListener("click", e => { e.stopPropagation(); notifPanel.classList.toggle("show"); });
        closeNotif && closeNotif.addEventListener("click", e => { e.stopPropagation(); notifPanel.classList.remove("show"); });
        notifPanel.addEventListener("click", e => e.stopPropagation());
        document.addEventListener("click", () => notifPanel.classList.remove("show"));
    }

    // ---------- OVERVIEW COUNTS ----------
    function initializeOverviewCounts() {
        allOrderRows = document.querySelectorAll(".order-row");
        let total = allOrderRows.length, pending = 0, ready = 0, revenue = 0;
        allOrderRows.forEach(r => {
            const s = r.dataset.orderStatus.toLowerCase();
            const t = parseFloat(r.dataset.total || 0);
            if (s === "pending" || s === "processing") pending++;
            if (s === "ready for pickup") ready++;
            if (s === "completed") revenue += t;
        });
        document.getElementById("totalOrdersToday").textContent     = total;
        document.getElementById("pendingOrdersCount").textContent   = pending;
        document.getElementById("readyForPickupCount").textContent  = ready;
        document.getElementById("totalRevenueToday").textContent    = formatCurrency(revenue);
    }

    // ---------- INIT ----------
    initializeOverviewCounts();
    filterOrdersByStatus(document.querySelector(".status-pill.active")?.dataset.filter || "all");
});
