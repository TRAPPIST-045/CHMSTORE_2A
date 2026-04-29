document.addEventListener("DOMContentLoaded", () => {

  // ==========================================
  // 1. CATEGORY & UI TOGGLE LOGIC (ORIGINAL - KEPT)
  // ==========================================
  const categorySelect = document.getElementById("categorySelect");
  const apparelControls = document.getElementById("apparelControls");
  const nonApparelControls = document.getElementById("nonApparelControls");
  const addCustomVariantBtn = document.getElementById("addCustomVariantBtn");

  const addCategoryBtn = document.getElementById("addCategoryBtn");
  const deleteCategoryBtn = document.getElementById("deleteCategoryBtn");
  const categoryActionBtns = document.getElementById("categoryActionBtns");
  const newCategoryInputArea = document.getElementById("newCategoryInputArea");
  const newCategoryNameInput = document.getElementById("newCategoryName");
  const confirmAddCategoryBtn = document.getElementById("confirmAddCategory");
  const cancelAddCategoryBtn = document.getElementById("cancelAddCategory");

  if (categorySelect) {
    categorySelect.addEventListener("change", function () {
      if (this.value === "Lanyards" || this.value === "College Items") {
        apparelControls.style.display = "none";
        nonApparelControls.style.display = "block";
        addCustomVariantBtn.style.display = "inline-flex";
      } else {
        apparelControls.style.display = "flex";
        nonApparelControls.style.display = "none";
        addCustomVariantBtn.style.display = "none";
      }
    });
    categorySelect.dispatchEvent(new Event("change"));
  }

  if (deleteCategoryBtn) {
    deleteCategoryBtn.addEventListener("click", () => {
      const selected = categorySelect.value;
      if (confirm(`Are you sure you want to delete the category "${selected}"?`)) {
        const optionToRemove = categorySelect.querySelector(`option[value="${selected}"]`);
        if (optionToRemove) optionToRemove.remove();
        categorySelect.dispatchEvent(new Event("change"));
      }
    });
  }

  if (addCategoryBtn) {
    addCategoryBtn.addEventListener("click", () => {
      categoryActionBtns.style.display = "none";
      newCategoryInputArea.style.display = "block";
      newCategoryNameInput.focus();
    });
    cancelAddCategoryBtn.addEventListener("click", () => {
      newCategoryInputArea.style.display = "none";
      categoryActionBtns.style.display = "flex";
      newCategoryNameInput.value = "";
    });
    confirmAddCategoryBtn.addEventListener("click", () => {
      const newCat = newCategoryNameInput.value.trim();
      if (newCat) {
        const opt = document.createElement("option");
        opt.value = newCat;
        opt.textContent = newCat;
        categorySelect.appendChild(opt);
        categorySelect.value = newCat;
        categorySelect.dispatchEvent(new Event("change"));
        cancelAddCategoryBtn.click();
      }
    });
  }

  // ==========================================
  // 2. VARIANT MATRIX & BOX GRID LOGIC (ORIGINAL - KEPT)
  // ==========================================
  const nameInput = document.getElementById("mainProductName");
  const nameWarning = document.getElementById("nameWarning");
  const tableBody = document.getElementById("variantTableBody");
  const addApparelVariantBtn = document.getElementById("addApparelVariantBtn");

  const sizeBoxes = document.querySelectorAll(".size-box");
  const genderBoxes = document.querySelectorAll(".gender-box");

  sizeBoxes.forEach((box) => {
    box.addEventListener("click", function () {
      sizeBoxes.forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
      checkApparelAddState();
    });
  });

  genderBoxes.forEach((box) => {
    box.addEventListener("click", function () {
      genderBoxes.forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
    });
  });

  function validateNameInput() {
    if (!nameInput.value.trim()) {
      nameInput.classList.add("input-error");
      if (nameWarning) nameWarning.style.display = "inline";
      nameInput.focus();
      return false;
    }
    return true;
  }

  if (nameInput) {
    nameInput.addEventListener("input", () => {
      nameInput.classList.remove("input-error");
      if (nameWarning) nameWarning.style.display = "none";
      checkApparelAddState();
    });
  }

  function checkApparelAddState() {
    const isNameFilled = nameInput.value.trim() !== "";
    const isSizeSelected = document.querySelector(".size-box.active") !== null;
    if (addApparelVariantBtn) {
      addApparelVariantBtn.disabled = !(isNameFilled && isSizeSelected);
    }
  }

  function createVariantRow(variantName, skuSuffix) {
    const shortName = nameInput.value.trim().substring(0, 3).toUpperCase() || "PRD";
    const autoSKU = `${shortName}-${skuSuffix}-${Math.floor(100 + Math.random() * 900)}`;
    const row = document.createElement("tr");
    row.setAttribute("data-variant", variantName);
    row.innerHTML = `
      <td><input type="text" class="matrix-input" value="${variantName}" placeholder="Name"></td>
      <td><input type="text" class="matrix-input" value="${autoSKU}"></td>
      <td><input type="number" class="matrix-input" placeholder="0.00"></td>
      <td><input type="number" class="matrix-input" value="0"></td>
      <td><input type="number" class="matrix-input" value="5"></td>
      <td><button type="button" class="btn-delete-variant"><i class="fas fa-trash-alt"></i></button></td>
    `;
    row.querySelector(".btn-delete-variant").addEventListener("click", () => {
      row.remove();
      if (tableBody.children.length === 0) {
        tableBody.innerHTML = '<tr class="empty-matrix-row"><td colspan="6">Select size & gender to add variant</td></tr>';
      }
    });
    return row;
  }

  if (addApparelVariantBtn) {
    addApparelVariantBtn.addEventListener("click", () => {
      const activeSize = document.querySelector(".size-box.active");
      const activeGender = document.querySelector(".gender-box.active");
      const sizeStr = activeSize.dataset.size;
      const genderStr = activeGender.dataset.gender;
      const genderCode = genderStr.charAt(0).toUpperCase();
      const variantComboName = `${genderStr} - ${sizeStr}`;
      const exists = Array.from(tableBody.querySelectorAll("tr")).some(
        (row) => row.dataset.variant === variantComboName
      );
      if (exists) { alert(`The variant "${variantComboName}" already exists.`); return; }
      const emptyMsg = tableBody.querySelector(".empty-matrix-row");
      if (emptyMsg) emptyMsg.remove();
      tableBody.appendChild(createVariantRow(variantComboName, `${genderCode}-${sizeStr}`));
    });
  }

  if (addCustomVariantBtn && tableBody) {
    addCustomVariantBtn.addEventListener("click", () => {
      if (!validateNameInput()) return;
      const emptyMsg = tableBody.querySelector(".empty-matrix-row");
      if (emptyMsg) emptyMsg.remove();
      tableBody.appendChild(createVariantRow("", "CUS"));
    });
  }

  // ==========================================
  // 3. IMAGE UPLOADER (ORIGINAL - KEPT)
  // ==========================================
  const mainPreviewContainer = document.getElementById("mainPreviewContainer");
  const mainPreviewImage = document.getElementById("mainPreviewImage");
  const imageUploadInput = document.getElementById("imageUploadInput");
  const thumbBoxes = document.querySelectorAll(".thumb-box");

  if (mainPreviewImage) {
    const initialMainImageSrc = mainPreviewImage.src;

    function setMainPreview(src, isImagePresent) {
      mainPreviewImage.src = src;
      if (isImagePresent) mainPreviewContainer.classList.add("has-image");
      else mainPreviewContainer.classList.remove("has-image");
    }

    function resetMainPreview() {
      thumbBoxes.forEach((tb) => tb.classList.remove("active"));
      const firstFilledThumb = document.querySelector(".thumb-box:not(.empty)");
      if (firstFilledThumb) {
        const img = firstFilledThumb.querySelector("img");
        setMainPreview(img.src, true);
        firstFilledThumb.classList.add("active");
      } else {
        setMainPreview(initialMainImageSrc, false);
        if (thumbBoxes[0]) thumbBoxes[0].classList.add("active");
      }
    }

    thumbBoxes.forEach((thumbBox) => {
      thumbBox.onclick = function () {
        if (thumbBox.classList.contains("empty")) {
          imageUploadInput.click();
        } else {
          const img = thumbBox.querySelector("img");
          thumbBoxes.forEach((tb) => tb.classList.remove("active"));
          thumbBox.classList.add("active");
          setMainPreview(img.src, true);
        }
      };
    });

    resetMainPreview();

    if (imageUploadInput) {
      imageUploadInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            const emptyThumbBox = document.querySelector(".thumb-box.empty");
            if (emptyThumbBox) {
              const imageUrl = e.target.result;
              const newImg = document.createElement("img");
              newImg.src = imageUrl;
              emptyThumbBox.appendChild(newImg);
              const newDeleteBtn = document.createElement("button");
              newDeleteBtn.type = "button";
              newDeleteBtn.className = "delete-thumb-btn";
              newDeleteBtn.innerHTML = '<i class="fas fa-times"></i>';
              newDeleteBtn.onclick = function (ev) {
                ev.stopPropagation();
                newImg.remove();
                newDeleteBtn.remove();
                emptyThumbBox.classList.add("empty");
                emptyThumbBox.classList.remove("active");
                resetMainPreview();
              };
              emptyThumbBox.appendChild(newDeleteBtn);
              emptyThumbBox.classList.remove("empty");
              thumbBoxes.forEach((tb) => tb.classList.remove("active"));
              emptyThumbBox.classList.add("active");
              setMainPreview(imageUrl, true);
            } else {
              alert("All 4 image slots are full. Delete an image first.");
            }
          };
          reader.readAsDataURL(file);
        }
        event.target.value = "";
      });
    }
  }

  // ==========================================
  // 4. DRAWER LOGIC (ORIGINAL - KEPT)
  // ==========================================
  const openTagsModalBtn = document.getElementById("openTagsDrawerBtn");
  const tagsDrawerOverlay = document.getElementById("tagsDrawerOverlay");
  const cancelTagsDrawer = document.getElementById("cancelTagsDrawer");
  const closeTagsDrawerXBtn = document.getElementById("closeTagsDrawerBtn");
  const saveTagsDrawer = document.getElementById("saveTagsDrawer");

  function closeDrawer() {
    if (tagsDrawerOverlay) tagsDrawerOverlay.classList.remove("show");
  }

  if (openTagsModalBtn) {
    openTagsModalBtn.addEventListener("click", () => tagsDrawerOverlay.classList.add("show"));
  }

  [cancelTagsDrawer, closeTagsDrawerXBtn].forEach((btn) => {
    if (btn) btn.addEventListener("click", closeDrawer);
  });

  if (tagsDrawerOverlay) {
    tagsDrawerOverlay.addEventListener("click", function (event) {
      if (event.target === tagsDrawerOverlay) closeDrawer();
    });
  }

  document.querySelectorAll(".tag-chip").forEach((chip) => {
    chip.addEventListener("click", function () { this.classList.toggle("active"); });
  });

  if (saveTagsDrawer) {
    saveTagsDrawer.addEventListener("click", () => { closeDrawer(); });
  }

  const collectionToggle = document.getElementById("collectionToggle");
  const collectionStatusLabel = document.getElementById("collectionStatusLabel");
  const collectionGroupArea = document.getElementById("collectionGroupArea");

  if (collectionToggle && collectionGroupArea && collectionStatusLabel) {
    collectionToggle.addEventListener("change", function () {
      collectionStatusLabel.textContent = this.checked ? "On" : "Off";
      collectionGroupArea.style.display = this.checked ? "block" : "none";
    });
  }

  // ==========================================
  // 5. LOAD EMBEDDED DATA
  // ==========================================
  let productsDB = [];
  let notifMessagesDB = [];

  try {
    const raw = document.getElementById("products-data")?.textContent;
    if (raw) productsDB = JSON.parse(raw);
  } catch (e) { console.error("products-data parse failed", e); }

  try {
    const raw = document.getElementById("notif-messages-data")?.textContent;
    if (raw) notifMessagesDB = JSON.parse(raw).map(m => ({
      ...m,
      msg_id:     Number(m.msg_id ?? m.id),
      is_read:    !!m.is_read,
      is_starred: !!m.is_starred,
    }));
  } catch (e) { console.error("notif-messages-data parse failed", e); }

  // ==========================================
  // 6. POPULATE MINI VARIANT & GENDER PILLS
  // ==========================================
  document.querySelectorAll(".landscape-card").forEach((card) => {
    const variants = card.dataset.variants ? card.dataset.variants.split(",").filter(Boolean) : [];
    const genders  = card.dataset.genders  ? card.dataset.genders.split(",").filter(Boolean)  : [];

    const variantBox = card.querySelector('.lc-mini-boxes[data-type="variants"]');
    const genderBox  = card.querySelector('.lc-mini-boxes[data-type="genders"]');

    if (variantBox) {
      variants.slice(0, 4).forEach((v) => {
        const pill = document.createElement("span");
        pill.className = "lc-variant-pill";
        pill.textContent = v;
        variantBox.appendChild(pill);
      });
    }
    if (genderBox) {
      genders.slice(0, 3).forEach((g) => {
        if (!g) return;
        const pill = document.createElement("span");
        pill.className = "lc-gender-pill";
        pill.textContent = g.charAt(0).toUpperCase();
        genderBox.appendChild(pill);
      });
    }
  });

  // ==========================================
  // 7. CARD OVERLAY TOGGLE (CLICK)
  // ==========================================
  document.querySelectorAll(".landscape-card").forEach((card) => {
    card.addEventListener("click", function (e) {
      if (e.target.closest(".lc-click-overlay")) return;
      document.querySelectorAll(".landscape-card.show-overlay").forEach((c) => {
        if (c !== this) c.classList.remove("show-overlay");
      });
      this.classList.toggle("show-overlay");
    });
  });

  document.addEventListener("click", (e) => {
    if (!e.target.closest(".landscape-card") && !e.target.closest("#editProductModal")) {
      document.querySelectorAll(".landscape-card.show-overlay").forEach((c) => c.classList.remove("show-overlay"));
    }
  });

  // ==========================================
  // 8. FILTER PILLS (CLIENT-SIDE - FIXED)
  // ==========================================
  const filterPills  = document.querySelectorAll(".filter-pill");
  const productGrid  = document.getElementById("productGrid");
  const emptyFilterState = document.getElementById("emptyFilterState");
  const searchInput  = document.getElementById("productSearchInput");

  function applyFilters() {
    const activePill  = document.querySelector(".filter-pill.active");
    const filterValue = activePill ? activePill.dataset.filter : "all";
    const searchValue = searchInput ? searchInput.value.toLowerCase().trim() : "";

    let hasVisible = false;

    document.querySelectorAll(".landscape-card").forEach((card) => {
      const category = card.dataset.category || "";
      const name     = (card.querySelector(".lc-name")?.textContent || "").toLowerCase();
      const desc     = (card.querySelector(".lc-description-preview")?.textContent || "").toLowerCase();

      const categoryMatch = filterValue === "all" || category === filterValue;
      const searchMatch   = !searchValue || name.includes(searchValue) || desc.includes(searchValue);

      if (categoryMatch && searchMatch) {
        card.style.display = "";
        hasVisible = true;
      } else {
        card.style.display = "none";
      }
    });

    if (emptyFilterState) {
      emptyFilterState.style.display = hasVisible ? "none" : "block";
    }
  }

  filterPills.forEach((pill) => {
    pill.addEventListener("click", function () {
      filterPills.forEach((p) => p.classList.remove("active"));
      this.classList.add("active");
      applyFilters();
    });
  });

  if (searchInput) {
    searchInput.addEventListener("input", () => applyFilters());
  }

  // Apply filters on load (respects active pill set by PHP)
  applyFilters();

  // ==========================================
  // 9. TOAST HELPER
  // ==========================================
  function showToast(msg, type = "default") {
    const tc = document.getElementById("toastContainer");
    if (!tc) return;
    const t = document.createElement("div");
    t.className = "toast-message" + (type === "success" ? " toast-success" : "");
    t.textContent = msg;
    tc.prepend(t);
    requestAnimationFrame(() => requestAnimationFrame(() => t.classList.add("show")));
    setTimeout(() => { t.classList.remove("show"); setTimeout(() => t.remove(), 400); }, 3500);
  }

  // ==========================================
  // 10. NOTIFICATION PANEL + MESSAGES
  // ==========================================
  const notifTrigger = document.getElementById("notifTrigger");
  const notifPanel   = document.getElementById("notifPanel");
  const closeNotif   = document.getElementById("closeNotif");
  const notifBody    = document.getElementById("notifBody");

  const avatarColors = { student: "#0a5c36", system: "#0b57d0", admin: "#9c27b0" };

  function renderNotifMessages(filter = "all") {
    if (!notifBody) return;

    let messages = [...notifMessagesDB].sort((a, b) => b.msg_id - a.msg_id);

    if (filter === "messages") {
      messages = messages.filter(m => m.msg_folder === "inbox");
    } else {
      messages = messages.filter(m => m.msg_folder === "inbox");
    }

    if (messages.length === 0) {
      notifBody.innerHTML = '<p class="notif-empty">No new messages.</p>';
      return;
    }

    notifBody.innerHTML = messages.slice(0, 6).map(m => {
      const initials = (m.sender_name || "?").charAt(0).toUpperCase();
      const snippet  = (m.msg_body || "").replace(/\n/g, " ").substring(0, 55);
      const color    = avatarColors[m.sender_type] || "#888";
      const unread   = !m.is_read;
      return `
        <a href="admin_contacts.php" class="notif-msg-row${unread ? " unread" : ""}">
          <div class="notif-avatar" style="background:${color}">${initials}</div>
          <div class="notif-msg-info">
            <div class="notif-msg-header">
              <span class="notif-sender">${escHtml(m.sender_name || "Unknown")}</span>
              <span class="notif-date">${escHtml(m.date_added || "")}</span>
            </div>
            <div class="notif-subject${unread ? " fw-bold" : ""}">${escHtml(m.msg_subject || "(no subject)")}</div>
            <div class="notif-snippet">${escHtml(snippet)}…</div>
          </div>
          ${unread ? '<span class="notif-unread-dot"></span>' : ""}
        </a>`;
    }).join("") + `<a href="admin_contacts.php" class="notif-view-all"><i class="fas fa-inbox"></i> View all messages</a>`;
  }

  function escHtml(str) {
    return String(str).replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;");
  }

  renderNotifMessages();

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
    if (notifPanel && !notifPanel.contains(e.target) && notifTrigger && !notifTrigger.contains(e.target)) {
      notifPanel.classList.remove("show");
    }
  });

  document.querySelectorAll(".notif-tab").forEach((tab) => {
    tab.addEventListener("click", function () {
      document.querySelectorAll(".notif-tab").forEach((t) => t.classList.remove("active"));
      this.classList.add("active");
      renderNotifMessages(this.dataset.tab || "all");
    });
  });

  // ==========================================
  // 11. PUBLISH / UNPUBLISH (AJAX)
  // ==========================================
  document.querySelectorAll(".btn-overlay-unpublish").forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      e.stopPropagation();
      const id            = parseInt(btn.dataset.productId, 10);
      const currentStatus = btn.dataset.currentStatus;
      const newStatus     = currentStatus === "published" ? "unpublished" : "published";

      btn.disabled = true;
      try {
        const resp = await fetch("admin_product_action.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ action: "toggle_status", id, status: newStatus }),
        });
        const data = await resp.json();
        if (data.ok) {
          const card = btn.closest(".landscape-card");
          if (card) {
            card.dataset.status = newStatus;
            const pill = card.querySelector(".lc-status-pill");
            if (pill) {
              pill.className = `lc-status-pill ${newStatus}`;
              pill.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
            }
            btn.dataset.currentStatus = newStatus;
            btn.innerHTML = `<i class="fas fa-eye-slash"></i> ${newStatus === "published" ? "Unpublish" : "Publish"}`;
          }
          showToast(`Product ${newStatus === "published" ? "published" : "unpublished"}.`, "success");
        } else {
          showToast("Error: " + (data.error || "Action failed"));
        }
      } catch (err) {
        showToast("Network error: " + err.message);
      }
      btn.disabled = false;
    });
  });

  // ==========================================
  // 12. EDIT MODAL
  // ==========================================
  const editModal    = document.getElementById("editProductModal");
  const closeEditBtn = document.getElementById("closeEditModal");
  const cancelEditBtn = document.getElementById("cancelEditModal");
  const saveEditBtn  = document.getElementById("saveEditBtn");

  function openEditModal(productId) {
    const product = productsDB.find(p => parseInt(p.id) === parseInt(productId));
    if (!product) { showToast("Product data not found."); return; }

    document.getElementById("editProductId").value          = product.id;
    document.getElementById("editProductName").value        = product.name || "";
    document.getElementById("editProductCategory").value    = product.category || "Uniforms";
    document.getElementById("editProductDescription").value = product.description || "";
    document.getElementById("editProductPrice").value       = product.price || 0;
    document.getElementById("editProductStatus").value      = product.status || "published";
    document.getElementById("editProductImage").value       = product.image || "";

    const imgPreview = document.getElementById("editImagePreview");
    if (imgPreview) imgPreview.src = product.image || "../assets/images/uniformnobg.png";

    renderEditVariantsTable(product.variants || []);
    editModal.classList.add("show");
  }

  function renderEditVariantsTable(variants) {
    const tbody = document.getElementById("editVariantTableBody");
    if (!tbody) return;
    tbody.innerHTML = "";
    if (!variants.length) {
      tbody.innerHTML = '<tr class="empty-matrix-row"><td colspan="7">No variants yet. Click "Add Variant" to add one.</td></tr>';
      return;
    }
    variants.forEach((v) => tbody.appendChild(createEditVariantRow(v)));
  }

  function createEditVariantRow(v = {}) {
    const row = document.createElement("tr");
    row.dataset.variantId = v.id || "";
    row.innerHTML = `
      <td><input type="text" class="matrix-input" name="variant_name" value="${escHtml(v.variant_name||"")}" placeholder="e.g. Male - S"></td>
      <td><input type="text" class="matrix-input" name="size"         value="${escHtml(v.size||"")}" placeholder="S / M / L"></td>
      <td><input type="text" class="matrix-input" name="color"        value="${escHtml(v.color||"")}" placeholder="Male / Female"></td>
      <td><input type="text" class="matrix-input" name="sku"          value="${escHtml(v.sku||"")}" placeholder="SKU-001"></td>
      <td><input type="number" class="matrix-input" name="price"      value="${parseFloat(v.price||0)}" min="0" step="0.01" placeholder="0.00"></td>
      <td><input type="number" class="matrix-input stock-highlight" name="stock" value="${parseInt(v.stock||0)}" min="0"></td>
      <td><button type="button" class="btn-delete-variant"><i class="fas fa-trash-alt"></i></button></td>
    `;
    row.querySelector(".btn-delete-variant").addEventListener("click", () => {
      row.remove();
      const tbody = document.getElementById("editVariantTableBody");
      if (!tbody.querySelector("tr:not(.empty-matrix-row)")) {
        tbody.innerHTML = '<tr class="empty-matrix-row"><td colspan="7">No variants yet. Click "Add Variant" to add one.</td></tr>';
      }
    });
    return row;
  }

  // Add Variant button
  document.getElementById("editAddVariantBtn")?.addEventListener("click", () => {
    const tbody = document.getElementById("editVariantTableBody");
    const emptyRow = tbody?.querySelector(".empty-matrix-row");
    if (emptyRow) emptyRow.remove();
    tbody?.appendChild(createEditVariantRow());
  });

  // Image preview live update
  document.getElementById("editProductImage")?.addEventListener("input", function () {
    const preview = document.getElementById("editImagePreview");
    if (preview) preview.src = this.value || "../assets/images/uniformnobg.png";
  });

  // Open modal on Update button click
  document.querySelectorAll(".btn-overlay-update").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.stopPropagation();
      openEditModal(btn.dataset.productId);
    });
  });

  function closeEditModal() {
    editModal.classList.remove("show");
  }

  closeEditBtn?.addEventListener("click", closeEditModal);
  cancelEditBtn?.addEventListener("click", closeEditModal);
  editModal?.addEventListener("click", (e) => {
    if (e.target === editModal) closeEditModal();
  });

  // Save
  saveEditBtn?.addEventListener("click", async () => {
    const id   = parseInt(document.getElementById("editProductId").value, 10);
    const name = document.getElementById("editProductName").value.trim();
    if (!name) { showToast("Product name is required."); return; }

    const variantRows = document.querySelectorAll("#editVariantTableBody tr:not(.empty-matrix-row)");
    const variants = Array.from(variantRows).map(row => ({
      variant_name: row.querySelector('[name="variant_name"]').value.trim(),
      size:         row.querySelector('[name="size"]').value.trim(),
      color:        row.querySelector('[name="color"]').value.trim(),
      sku:          row.querySelector('[name="sku"]').value.trim(),
      price:        parseFloat(row.querySelector('[name="price"]').value) || 0,
      stock:        parseInt(row.querySelector('[name="stock"]').value)   || 0,
    }));

    const payload = {
      action:      "update",
      id,
      name,
      description: document.getElementById("editProductDescription").value.trim(),
      category:    document.getElementById("editProductCategory").value,
      price:       parseFloat(document.getElementById("editProductPrice").value) || 0,
      image:       document.getElementById("editProductImage").value.trim(),
      status:      document.getElementById("editProductStatus").value,
      variants,
    };

    saveEditBtn.disabled = true;
    saveEditBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

    try {
      const resp = await fetch("admin_product_action.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });
      const data = await resp.json();
      if (data.ok) {
        showToast("Product updated successfully!", "success");
        closeEditModal();
        setTimeout(() => location.reload(), 900);
      } else {
        showToast("Error: " + (data.error || "Update failed"));
      }
    } catch (err) {
      showToast("Network error: " + err.message);
    }

    saveEditBtn.disabled = false;
    saveEditBtn.innerHTML = '<i class="fas fa-save"></i> Save Changes';
  });

});