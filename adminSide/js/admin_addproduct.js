document.addEventListener("DOMContentLoaded", () => {
    // 1. CATEGORY & UI TOGGLE LOGIC
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
                apparelControls.style.display = "block";
                nonApparelControls.style.display = "none";
                addCustomVariantBtn.style.display = "none";
            }
        });
        categorySelect.dispatchEvent(new Event("change"));
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

    if (deleteCategoryBtn) {
        deleteCategoryBtn.addEventListener("click", () => {
            const selected = categorySelect.value;
            if (confirm(`Delete category "${selected}"?`)) {
                const optionToRemove = categorySelect.querySelector(`option[value="${selected}"]`);
                if (optionToRemove) optionToRemove.remove();
                categorySelect.dispatchEvent(new Event("change"));
            }
        });
    }

    // 2. VARIANT MATRIX & BOX GRID LOGIC
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
            checkApparelAddState();
        });
    });

    function validateNameInput() {
        if (!nameInput.value.trim()) {
            nameInput.classList.add("input-error");
            if (nameWarning) nameWarning.style.display = "block";
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
        const isGenderSelected = document.querySelector(".gender-box.active") !== null;
        if (addApparelVariantBtn) {
            addApparelVariantBtn.disabled = !(isNameFilled && isSizeSelected && isGenderSelected);
        }
    }

    function createVariantRow(variantName, skuSuffix) {
        const shortName = nameInput.value.trim().substring(0, 3).toUpperCase() || "PRD";
        const autoSKU = `${shortName}-${skuSuffix}-${Math.floor(100 + Math.random() * 900)}`;
        const row = document.createElement("tr");
        row.setAttribute("data-variant", variantName);
        
        // Match the HTML table headers: Variant Name, SKU, Price, Stock, Action
        row.innerHTML = `
            <td><input type="text" name="variants[name][]" class="matrix-input" value="${variantName}" placeholder="Name"></td>
            <td><input type="text" name="variants[sku][]" class="matrix-input" value="${autoSKU}"></td>
            <td><input type="number" name="variants[price][]" class="matrix-input" placeholder="0.00" step="0.01"></td>
            <td><input type="number" name="variants[stock][]" class="matrix-input" value="0" min="0"></td>
            <td><button type="button" class="btn-delete-variant"><i class="fas fa-trash-alt"></i></button></td>
        `;
        row.querySelector(".btn-delete-variant").addEventListener("click", () => {
            row.remove();
            if (tableBody.children.length === 0) {
                tableBody.innerHTML = '<tr class="empty-matrix-row"><td colspan="5">Select size & gender (or add custom) to build your variant matrix.</td></tr>';
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

    // 3. IMAGE UPLOADER
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

    // 4. DRAWER LOGIC
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

    [cancelTagsDrawer, closeTagsDrawerXBtn, saveTagsDrawer].forEach((btn) => {
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
});