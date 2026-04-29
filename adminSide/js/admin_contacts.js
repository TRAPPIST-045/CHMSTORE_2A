/**
 *  admin_contacts.js
 *  - Loads messages from <script id="messages-data" type="application/json"> (rendered by PHP)
 *  - Star / move / delete / mark_read / send all persist via admin_message_action.php
 */
document.addEventListener("DOMContentLoaded", () => {

    // ===== NOTIFICATION PANEL (matches admin_productlist) =====
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
        closeNotif.addEventListener("click", () => notifPanel.classList.remove("show"));
    }
    document.addEventListener("click", (e) => {
        if (notifPanel && !notifPanel.contains(e.target) && e.target !== notifTrigger) {
            notifPanel.classList.remove("show");
        }
    });

    // ===== LOAD DATA FROM PHP =====
    let messagesDB = [];
    try {
        const raw = document.getElementById("messages-data")?.textContent;
        if (raw) messagesDB = JSON.parse(raw).map(m => ({
            ...m,
            msg_id:      Number(m.msg_id ?? m.id),
            is_read:     !!m.is_read,
            is_starred:  !!m.is_starred,
            is_selected: false,
        }));
    } catch (e) { console.error("messages-data parse failed", e); }

    const currentAdmin = {
        name:  (window.CURRENT_ADMIN && window.CURRENT_ADMIN.name)  || "Admin",
        email: (window.CURRENT_ADMIN && window.CURRENT_ADMIN.email) || "admin@chmstore.edu.ph",
    };

    let currentFolder   = "inbox";
    let activeMessageId = null;

    // ===== DOM =====
    const folderItems              = document.querySelectorAll(".gmail-folder");
    const inboxBadge               = document.getElementById("inboxBadge");
    const viewMessageList          = document.getElementById("viewMessageList");
    const viewMessageRead          = document.getElementById("viewMessageRead");
    const messageListContainer     = document.getElementById("messageListContainer");
    const masterCheckbox           = document.getElementById("masterCheckbox");
    const selectDropdownTrigger    = document.getElementById("selectDropdownTrigger");
    const selectDropdownMenu       = document.getElementById("selectDropdownMenu");
    const batchActions             = document.getElementById("batchActions");
    const composeModal             = document.getElementById("composeModal");
    const composeTo                = document.getElementById("composeTo");
    const composeSubject           = document.getElementById("composeSubject");
    const composeMessage           = document.getElementById("composeMessage");
    const notificationContainer    = document.getElementById("notificationContainer");
    const inlineReplyBox           = document.getElementById("inlineReplyBox");
    const replyEditor              = document.getElementById("replyEditor");
    const emojiPicker              = document.getElementById("emojiPicker");
    const emojiBtn                 = document.getElementById("emojiBtn");

    // ===== API HELPER =====
    async function api(action, payload = {}) {
        const resp = await fetch("admin_message_action.php", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-Requested-With": "XMLHttpRequest" },
            body: JSON.stringify({ action, ...payload }),
        });
        if (!resp.ok) throw new Error("Network " + resp.status);
        const data = await resp.json();
        if (!data.ok) throw new Error(data.error || "Action failed");
        return data;
    }

    // ===== TOAST =====
    function showToast(msg) {
        const t = document.createElement("div");
        t.className = "toast-message";
        t.textContent = msg;
        notificationContainer.prepend(t);
        requestAnimationFrame(() => requestAnimationFrame(() => t.classList.add("show")));
        setTimeout(() => { t.classList.remove("show"); setTimeout(() => t.remove(), 400); }, 3000);
    }

    // ===== RENDER LIST =====
    function renderList() {
        const filtered = messagesDB.filter(m =>
            currentFolder === "starred"
                ? (m.is_starred && m.msg_folder !== "trash")
                : m.msg_folder === currentFolder
        );

        const unread = messagesDB.filter(m => m.msg_folder === "inbox" && !m.is_read).length;
        inboxBadge.textContent = unread > 0 ? unread : "";

        document.getElementById("listPaginationText").textContent =
            filtered.length === 0 ? "0 of 0" : `1–${filtered.length} of ${filtered.length}`;

        if (filtered.length === 0) {
            const labels = { inbox:"Inbox", starred:"Starred", sent:"Sent", archive:"Archive", trash:"Trash" };
            messageListContainer.innerHTML = `<div class="empty-folder"><i class="fas fa-inbox"></i><p>${labels[currentFolder]||currentFolder} is empty.</p></div>`;
            updateMasterCheckboxState(filtered);
            return;
        }

        filtered.sort((a, b) => b.msg_id - a.msg_id);

        messageListContainer.innerHTML = filtered.map(m => {
            const displayName = currentFolder === "sent"
                ? `To: ${m.receiver_name || m.receiver_email || "Student"}`
                : m.sender_name;
            const snippet = (m.msg_body || "").replace(/\n/g, " ");
            return `
                <div class="msg-row ${m.is_read ? "" : "unread"} ${m.is_selected ? "selected" : ""}" data-id="${m.msg_id}">
                    <div class="row-controls">
                        <input type="checkbox" class="gmail-checkbox row-checkbox" data-id="${m.msg_id}" ${m.is_selected ? "checked" : ""}>
                        <button class="star-btn ${m.is_starred ? "active" : ""}" data-id="${m.msg_id}">
                            <i class="${m.is_starred ? "fas" : "far"} fa-star"></i>
                        </button>
                    </div>
                    <div class="row-sender"  data-action="open">${displayName}</div>
                    <div class="row-content" data-action="open">
                        <span class="row-subject">${m.msg_subject}</span>
                        <span class="row-snippet"> — ${snippet}</span>
                    </div>
                    <div class="row-date"    data-action="open">${m.date_added}</div>
                </div>`;
        }).join("");

        attachRowListeners();
        updateMasterCheckboxState(filtered);
    }

    function attachRowListeners() {
        document.querySelectorAll('[data-action="open"]').forEach(el => {
            el.addEventListener("click", e => {
                const id = parseInt(e.target.closest(".msg-row").dataset.id, 10);
                openMessage(id);
            });
        });
        document.querySelectorAll(".row-checkbox").forEach(cb => {
            cb.addEventListener("change", e => {
                const id = parseInt(e.target.dataset.id, 10);
                const m  = messagesDB.find(x => x.msg_id === id);
                if (m) m.is_selected = e.target.checked;
                e.target.closest(".msg-row").classList.toggle("selected", e.target.checked);
                updateMasterCheckboxState(getFiltered());
            });
        });
        document.querySelectorAll(".star-btn").forEach(btn => {
            btn.addEventListener("click", async e => {
                e.stopPropagation();
                const id = parseInt(e.currentTarget.dataset.id, 10);
                const m  = messagesDB.find(x => x.msg_id === id);
                if (!m) return;
                const newStar = !m.is_starred;
                try {
                    await api(newStar ? "star" : "unstar", { id });
                    m.is_starred = newStar;
                    renderList();
                } catch (err) { showToast("Error: " + err.message); }
            });
        });
    }

    function getFiltered() {
        return messagesDB.filter(m =>
            currentFolder === "starred"
                ? (m.is_starred && m.msg_folder !== "trash")
                : m.msg_folder === currentFolder
        );
    }

    // ===== MASTER CHECKBOX =====
    function updateMasterCheckboxState(filtered) {
        if (filtered.length === 0) {
            masterCheckbox.checked = false;
            masterCheckbox.classList.remove("partial");
            batchActions.classList.add("hidden");
            return;
        }
        const sel = filtered.filter(m => m.is_selected).length;
        if (sel === 0) {
            masterCheckbox.checked = false; masterCheckbox.classList.remove("partial");
            batchActions.classList.add("hidden");
        } else if (sel === filtered.length) {
            masterCheckbox.checked = true; masterCheckbox.classList.remove("partial");
            batchActions.classList.remove("hidden");
        } else {
            masterCheckbox.checked = false; masterCheckbox.classList.add("partial");
            batchActions.classList.remove("hidden");
        }
    }

    masterCheckbox.addEventListener("click", (e) => {
        if (e.target.classList.contains("partial")) {
            masterCheckbox.classList.remove("partial"); masterCheckbox.checked = true;
        }
        getFiltered().forEach(m => m.is_selected = masterCheckbox.checked);
        renderList();
    });

    selectDropdownTrigger.addEventListener("click", (e) => { e.stopPropagation(); selectDropdownMenu.classList.toggle("show"); });
    document.addEventListener("click", () => { selectDropdownMenu.classList.remove("show"); emojiPicker.classList.remove("show"); });

    selectDropdownMenu.addEventListener("click", (e) => {
        if (e.target.tagName !== "A") return;
        e.preventDefault();
        const a = e.target.dataset.select;
        const filtered = getFiltered();
        filtered.forEach(m => {
            if (a === "all")         m.is_selected = true;
            else if (a === "none")   m.is_selected = false;
            else if (a === "read")   m.is_selected = m.is_read;
            else if (a === "unread") m.is_selected = !m.is_read;
            else if (a === "starred")   m.is_selected = m.is_starred;
            else if (a === "unstarred") m.is_selected = !m.is_starred;
        });
        renderList();
    });

    document.getElementById("refreshBtn").addEventListener("click", () => { renderList(); showToast("Messages refreshed."); });

    // ===== BATCH =====
    async function batchUpdate(folderOrReadFlag, kind) {
        const selected = messagesDB.filter(m => m.is_selected && m.msg_folder === currentFolder);
        if (!selected.length) return;
        for (const m of selected) {
            try {
                if (kind === "move")      await api("move", { id: m.msg_id, folder: folderOrReadFlag });
                else if (kind === "read") await api("mark_read", { id: m.msg_id });
            } catch (_) {}
        }
        selected.forEach(m => {
            if (kind === "move") m.msg_folder = folderOrReadFlag;
            else if (kind === "read") m.is_read = true;
            m.is_selected = false;
        });
        renderList();
    }
    document.getElementById("batchArchiveBtn").addEventListener("click", () => {
        const n = messagesDB.filter(m => m.is_selected && m.msg_folder === currentFolder).length;
        batchUpdate("archive", "move").then(() => showToast(`${n} conversation${n!==1?"s":""} archived.`));
    });
    document.getElementById("batchDeleteBtn").addEventListener("click", () => {
        const n = messagesDB.filter(m => m.is_selected && m.msg_folder === currentFolder).length;
        batchUpdate("trash", "move").then(() => showToast(`${n} conversation${n!==1?"s":""} moved to Trash.`));
    });
    document.getElementById("batchMarkReadBtn").addEventListener("click", () => {
        batchUpdate(null, "read").then(() => showToast("Marked as read."));
    });

    // ===== OPEN MESSAGE =====
    async function openMessage(id) {
        const m = messagesDB.find(x => x.msg_id === id);
        if (!m) return;
        activeMessageId = id;

        if (!m.is_read) {
            try { await api("mark_read", { id }); } catch(_){}
            m.is_read = true;
        }

        viewMessageList.classList.remove("active");
        viewMessageRead.classList.add("active");

        document.getElementById("readSubject").textContent      = m.msg_subject;
        document.getElementById("readFolderLabel").innerHTML    = `${m.msg_folder.charAt(0).toUpperCase()+m.msg_folder.slice(1)} <i class="fas fa-times"></i>`;
        document.getElementById("readSenderName").textContent   = m.sender_name;
        document.getElementById("readSenderEmail").textContent  = `<${m.sender_email}>`;
        document.getElementById("readDate").textContent         = m.full_date || m.date_added;
        document.getElementById("readBody").innerHTML           = (m.msg_body || "").replace(/\n/g, "<br>");

        const avatar = document.getElementById("readAvatar");
        avatar.textContent = (m.sender_name || "?").charAt(0).toUpperCase();
        const colors = { student:"#0a5c36", system:"#0b57d0", admin:"#9c27b0" };
        avatar.style.background = colors[m.sender_type] || "#888";

        const star = document.getElementById("btnReadStar");
        star.innerHTML = m.is_starred ? '<i class="fas fa-star" style="color:#f5b400"></i>' : '<i class="far fa-star"></i>';

        const filtered = getFiltered();
        const idx = filtered.findIndex(x => x.msg_id === id);
        document.getElementById("readPaginationText").textContent = `${idx+1} of ${filtered.length}`;

        hideReplyBox();
        renderList();
    }

    // ===== READ TOOLBAR =====
    document.getElementById("btnBackToList").addEventListener("click", () => {
        activeMessageId = null;
        viewMessageRead.classList.remove("active");
        viewMessageList.classList.add("active");
        hideReplyBox();
        renderList();
    });
    document.getElementById("btnReadArchive").addEventListener("click", async () => {
        const m = messagesDB.find(x => x.msg_id === activeMessageId); if (!m) return;
        try { await api("move", { id: m.msg_id, folder: "archive" }); m.msg_folder = "archive"; showToast("Archived."); document.getElementById("btnBackToList").click(); }
        catch(e){ showToast("Error: "+e.message); }
    });
    document.getElementById("btnReadDelete").addEventListener("click", async () => {
        const m = messagesDB.find(x => x.msg_id === activeMessageId); if (!m) return;
        try { await api("move", { id: m.msg_id, folder: "trash" });   m.msg_folder = "trash";   showToast("Moved to Trash."); document.getElementById("btnBackToList").click(); }
        catch(e){ showToast("Error: "+e.message); }
    });
    document.getElementById("btnReadUnread").addEventListener("click", async () => {
        const m = messagesDB.find(x => x.msg_id === activeMessageId); if (!m) return;
        try { await api("mark_unread", { id: m.msg_id }); m.is_read = false; showToast("Marked as unread."); document.getElementById("btnBackToList").click(); }
        catch(e){ showToast("Error: "+e.message); }
    });
    document.getElementById("btnReadStar").addEventListener("click", async () => {
        const m = messagesDB.find(x => x.msg_id === activeMessageId); if (!m) return;
        const next = !m.is_starred;
        try { await api(next ? "star" : "unstar", { id: m.msg_id }); m.is_starred = next; showToast(next ? "Starred." : "Star removed."); openMessage(activeMessageId); }
        catch(e){ showToast("Error: "+e.message); }
    });

    // ===== FOLDERS =====
    folderItems.forEach(item => {
        item.addEventListener("click", (e) => {
            e.preventDefault();
            folderItems.forEach(i => i.classList.remove("active"));
            item.classList.add("active");
            currentFolder = item.dataset.folder;
            messagesDB.forEach(m => m.is_selected = false);
            if (viewMessageRead.classList.contains("active")) {
                viewMessageRead.classList.remove("active");
                viewMessageList.classList.add("active");
                hideReplyBox();
                activeMessageId = null;
            }
            renderList();
        });
    });

    // ===== REPLY BOX =====
    let attachedFiles = [];
    function hideReplyBox() {
        if (inlineReplyBox) {
            inlineReplyBox.style.display = "none";
            replyEditor.innerHTML = "";
            attachedFiles = [];
            renderAttachments();
            document.getElementById("replyTab").classList.add("active");
            document.getElementById("forwardTab").classList.remove("active");
        }
        document.getElementById("footerPillBtns").style.display = "flex";
    }
    function showReplyBox(mode = "reply") {
        const m = messagesDB.find(x => x.msg_id === activeMessageId);
        if (mode === "forward") {
            document.getElementById("forwardTab").classList.add("active");
            document.getElementById("replyTab").classList.remove("active");
            document.getElementById("replyToLine").innerHTML = "To: <span id='replyToEmail'></span>";
        } else {
            document.getElementById("replyTab").classList.add("active");
            document.getElementById("forwardTab").classList.remove("active");
            const toEl = document.getElementById("replyToEmail");
            if (toEl && m) toEl.textContent = m.sender_email;
        }
        document.getElementById("footerPillBtns").style.display = "none";
        inlineReplyBox.style.display = "block";
        setTimeout(() => { replyEditor.scrollIntoView({behavior:"smooth",block:"center"}); replyEditor.focus(); }, 50);
    }
    document.getElementById("btnTopReply").addEventListener("click",     () => showReplyBox("reply"));
    document.getElementById("btnBottomReply").addEventListener("click",  () => showReplyBox("reply"));
    document.getElementById("btnBottomForward").addEventListener("click",() => showReplyBox("forward"));

    document.getElementById("replyTab").addEventListener("click", () => {
        document.getElementById("replyTab").classList.add("active");
        document.getElementById("forwardTab").classList.remove("active");
        const m = messagesDB.find(x => x.msg_id === activeMessageId);
        const toEl = document.getElementById("replyToEmail");
        if (toEl && m) toEl.textContent = m.sender_email;
    });
    document.getElementById("forwardTab").addEventListener("click", () => {
        document.getElementById("forwardTab").classList.add("active");
        document.getElementById("replyTab").classList.remove("active");
        const toEl = document.getElementById("replyToEmail");
        if (toEl) toEl.textContent = "";
    });

    // ===== EMOJI =====
    const emojis = ["😀","😂","😍","🥰","😎","😢","😡","👍","👎","🙏","🔥","❤️","✅","⭐","🎉","📎","📧","💬","🛒","📦","✔️","❌","⚠️","💡","🕐","📝","📋","💳","🏷️","📣"];
    emojis.forEach(em => {
        const s = document.createElement("span");
        s.textContent = em;
        s.addEventListener("click", () => { replyEditor.focus(); document.execCommand("insertText", false, em); emojiPicker.classList.remove("show"); });
        emojiPicker.appendChild(s);
    });
    emojiBtn.addEventListener("click", (e) => { e.stopPropagation(); emojiPicker.classList.toggle("show"); });

    // ===== ATTACHMENTS =====
    function renderAttachments() {
        const c = document.getElementById("replyAttachments"); if (!c) return;
        c.innerHTML = "";
        attachedFiles.forEach((f, i) => {
            const chip = document.createElement("div");
            chip.className = "attachment-chip";
            const icon = f.type?.startsWith("image/") ? "fa-image" : "fa-paperclip";
            chip.innerHTML = `<i class="fas ${icon}"></i> ${f.name} <button data-i="${i}"><i class="fas fa-times"></i></button>`;
            chip.querySelector("button").addEventListener("click", () => { attachedFiles.splice(i,1); renderAttachments(); });
            c.appendChild(chip);
        });
        c.style.paddingBottom = attachedFiles.length ? "10px" : "0";
    }
    document.getElementById("replyFileInput").addEventListener("change", (e) => { attachedFiles.push(...Array.from(e.target.files)); renderAttachments(); e.target.value=""; });
    document.getElementById("replyImageInput").addEventListener("change", (e) => { attachedFiles.push(...Array.from(e.target.files)); renderAttachments(); e.target.value=""; });

    // ===== SEND REPLY =====
    document.getElementById("btnSendReply").addEventListener("click", async () => {
        const body = replyEditor.innerText.trim();
        if (!body) return showToast("Please write a message before sending.");

        const m = messagesDB.find(x => x.msg_id === activeMessageId);
        const isForward = document.getElementById("forwardTab").classList.contains("active");
        const toEmail   = document.getElementById("replyToEmail").textContent.trim();

        const to   = isForward ? toEmail : (m?.sender_email || "");
        const subj = (isForward ? "Fwd: " : "Re: ") + (m?.msg_subject || "");
        const recvName = isForward ? (toEmail.split("@")[0] || "Recipient") : (m?.sender_name || "");

        try {
            const data = await api("send", {
                receiver_email: to, receiver_name: recvName, subject: subj, body,
            });
            if (data.message) {
                const nm = {
                    ...data.message,
                    msg_id:      Number(data.message.id),
                    msg_folder:  data.message.folder,
                    msg_subject: data.message.subject,
                    msg_body:    data.message.body,
                    is_read:     !!data.message.is_read,
                    is_starred:  !!data.message.is_starred,
                    is_selected: false,
                    date_added:  new Date().toLocaleTimeString([], {hour:"2-digit",minute:"2-digit"}),
                };
                messagesDB.push(nm);
            }
            hideReplyBox();
            showToast(`Message sent to ${to || "recipient"}.`);
            if (currentFolder === "sent") renderList();
        } catch (err) {
            showToast("Error: " + err.message);
        }
    });

    document.getElementById("btnDiscardReply").addEventListener("click", () => { hideReplyBox(); showToast("Reply discarded."); });

    // ===== COMPOSE =====
    function openCompose() {
        composeTo.value = ""; composeSubject.value = ""; composeMessage.value = "";
        composeModal.classList.add("show"); composeTo.focus();
    }
    const closeCompose = () => composeModal.classList.remove("show");
    document.getElementById("btnComposeNew").addEventListener("click", openCompose);
    document.getElementById("closeComposeBtn").addEventListener("click", closeCompose);
    document.getElementById("discardComposeBtn").addEventListener("click", closeCompose);

    document.getElementById("sendComposeBtn").addEventListener("click", async () => {
        const to   = composeTo.value.trim();
        const sub  = composeSubject.value.trim();
        const body = composeMessage.value.trim();
        if (!to)   return showToast("Please add a recipient.");
        if (!body) return showToast("Please write a message before sending.");

        try {
            const data = await api("send", {
                receiver_email: to,
                receiver_name:  to.includes("@") ? to.split("@")[0] : to,
                subject:        sub || "(No subject)",
                body,
            });
            if (data.message) {
                const nm = {
                    ...data.message,
                    msg_id:      Number(data.message.id),
                    msg_folder:  data.message.folder,
                    msg_subject: data.message.subject,
                    msg_body:    data.message.body,
                    is_read:     !!data.message.is_read,
                    is_starred:  !!data.message.is_starred,
                    is_selected: false,
                    date_added:  new Date().toLocaleTimeString([], {hour:"2-digit",minute:"2-digit"}),
                };
                messagesDB.push(nm);
            }
            showToast(`Message sent to ${to}.`);
            closeCompose();
            if (currentFolder === "sent") renderList();
        } catch (err) {
            showToast("Error: " + err.message);
        }
    });

    // ===== INIT =====
    renderList();
});