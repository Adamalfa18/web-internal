document.addEventListener("DOMContentLoaded", function () {
    const addFileBtn = document.getElementById("add-file-btn");
    const addCoverBtn = document.getElementById("add-cover-btn");
    const fileInput = document.getElementById("content_media");
    const coverInput = document.getElementById("cover");
    const previewContainer = document.getElementById("preview-container");
    const form = document.querySelector(".form-marketing-instagram");

    let filesToUpload = [];
    let coverFile = null;

    if (addFileBtn) {
        addFileBtn.addEventListener("click", () => fileInput.click());

        fileInput.addEventListener("change", (e) => {
            const newFiles = Array.from(e.target.files);
            newFiles.forEach((file) => {
                filesToUpload.push(file);
                renderPreview(file, filesToUpload.length - 1);
            });
            fileInput.value = "";
        });
    }

    if (addCoverBtn) {
        addCoverBtn.addEventListener("click", () => coverInput.click());

        coverInput.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (file) {
                coverFile = file; // Simpan cover ke variabel terpisah
                renderPreview(file, filesToUpload.length); // Index aman
            }
            coverInput.value = "";
        });
    }

    function renderPreview(file, index) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const col = document.createElement("div");
            col.className = "col-md-3 mb-3";

            const card = document.createElement("div");
            card.className = "position-relative border p-1 rounded";

            const removeBtn = document.createElement("button");
            removeBtn.innerHTML = "&times;";
            removeBtn.className =
                "btn btn-danger btn-sm position-absolute top-0 end-0";
            removeBtn.type = "button";
            removeBtn.onclick = () => {
                filesToUpload.splice(index, 1);
                previewContainer.removeChild(col);
            };

            let media;
            if (file.type.startsWith("video/")) {
                media = document.createElement("video");
                media.src = e.target.result;
                media.controls = true;
                media.className = "w-100";
            } else {
                media = document.createElement("img");
                media.src = e.target.result;
                media.className = "img-fluid";
            }

            card.appendChild(removeBtn);
            card.appendChild(media);
            col.appendChild(card);
            previewContainer.appendChild(col);
        };
        reader.readAsDataURL(file);
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(form);

        filesToUpload.forEach((file) => {
            formData.append("content_media[]", file);
        });

        if (coverFile) {
            formData.append("cover", coverFile);
        }

        const token = form.querySelector('input[name="_token"]').value;

        const progressBar = form.querySelector(".progress");
        const progressBarInner = progressBar.querySelector(".progress-bar");
        const uploadStatus = form.querySelector("#upload-status");
        const uploadPercentage = form.querySelector("#upload-percentage");

        progressBar.style.display = "block";
        uploadStatus.style.display = "block";

        // Use XMLHttpRequest instead of fetch for upload progress
        const xhr = new XMLHttpRequest();
        xhr.open("POST", form.action, true);

        xhr.upload.addEventListener("progress", function (e) {
            if (e.lengthComputable) {
                const percentCompleted = Math.round((e.loaded * 100) / e.total);
                progressBarInner.style.width = percentCompleted + "%";
                uploadPercentage.textContent = percentCompleted;
            }
        });

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    uploadStatus.innerHTML =
                        '<small class="text-success">Upload selesai!</small>';
                    progressBar.classList.add("bg-success");
                    setTimeout(() => {
                        window.location.href = xhr.responseURL;
                    }, 1000);
                } else {
                    uploadStatus.innerHTML =
                        '<small class="text-danger">Upload gagal!</small>';
                    console.error("Upload error:", xhr.responseText);
                }
            }
        };

        xhr.open("POST", form.action, true);
        xhr.setRequestHeader("X-CSRF-TOKEN", token);
        xhr.send(formData);
    });

    // ------------------- UNTUK MODAL EDIT ----------------------
    let editFilesToUpload = {};

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-existing-media")) {
            const btn = e.target;
            const parent = btn.closest(".preview-item");
            if (parent) {
                parent.remove();

                const mediaId = btn.getAttribute("data-media-id");
                const form = btn.closest("form");
                if (form) {
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "media_to_delete[]";
                    input.value = mediaId;
                    form.appendChild(input);
                }
            }
        }
    });

    document.querySelectorAll(".edit-add-file-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const postId = button.getAttribute("data-id");
            const fileInput = document.querySelector(
                `#edit_content_media${postId}`
            );
            if (fileInput) fileInput.click();
        });
    });

    document.querySelectorAll(".edit-file-input").forEach((fileInput) => {
        fileInput.addEventListener("change", (e) => {
            const postId = fileInput.getAttribute("data-id");
            const files = Array.from(e.target.files);

            if (!editFilesToUpload[postId]) {
                editFilesToUpload[postId] = [];
            }

            files.forEach((file) => {
                editFilesToUpload[postId].push(file);
                renderEditPreview(file, postId);
            });

            fileInput.value = ""; // reset
        });
    });

    function renderEditPreview(file, postId) {
        const container = document.querySelector(
            `#edit-preview-container-${postId}`
        );
        if (!container) return;

        const reader = new FileReader();
        const col = document.createElement("div");
        col.className = "col-md-3 mb-3 preview-item";

        const card = document.createElement("div");
        card.className = "position-relative border p-1 rounded";

        const removeBtn = document.createElement("button");
        removeBtn.innerHTML = "&times;";
        removeBtn.className =
            "btn btn-danger btn-sm position-absolute top-0 end-0";
        removeBtn.type = "button";
        removeBtn.onclick = () => {
            const index = editFilesToUpload[postId].indexOf(file);
            if (index > -1) {
                editFilesToUpload[postId].splice(index, 1);
            }
            container.removeChild(col);
        };

        reader.onload = function (e) {
            let media;
            if (file.type.startsWith("video/")) {
                media = document.createElement("video");
                media.src = e.target.result;
                media.controls = true;
                media.className = "w-100";
            } else {
                media = document.createElement("img");
                media.src = e.target.result;
                media.className = "img-fluid";
            }

            card.appendChild(removeBtn);
            card.appendChild(media);
            col.appendChild(card);
            container.appendChild(col);
        };
        reader.readAsDataURL(file);
    }

    // Handle form submission for edit
    document.querySelectorAll(".form-marketing-edit").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const postId = this.querySelector('input[name="id"]').value;

            // Get all existing media IDs that are still visible (not deleted)
            const existingMediaIds = Array.from(
                this.querySelectorAll(
                    '.preview-item input[name="existing_media_ids[]"]'
                )
            ).map((input) => input.value);

            // Add existing media IDs to formData
            existingMediaIds.forEach((id) => {
                formData.append("media_to_delete[]", id);
            });

            // Add new files to FormData
            if (editFilesToUpload[postId]) {
                editFilesToUpload[postId].forEach((file) => {
                    formData.append("content_media[]", file);
                });
            }

            // Get CSRF token from the form's _token input
            const token = this.querySelector('input[name="_token"]').value;

            const progressBar = form.querySelector(".progress");
            const progressBarInner = progressBar.querySelector(".progress-bar");
            const uploadStatus = form.querySelector("#upload-status");
            const uploadPercentage = form.querySelector("#upload-percentage");

            progressBar.style.display = "block";
            uploadStatus.style.display = "block";

            // Use XMLHttpRequest instead of fetch for upload progress
            const xhr = new XMLHttpRequest();
            xhr.open("POST", form.action, true);

            xhr.upload.addEventListener("progress", function (e) {
                if (e.lengthComputable) {
                    const percentCompleted = Math.round(
                        (e.loaded * 100) / e.total
                    );
                    progressBarInner.style.width = percentCompleted + "%";
                    uploadPercentage.textContent = percentCompleted;
                }
            });

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        uploadStatus.innerHTML =
                            '<small class="text-success">Upload selesai!</small>';
                        progressBar.classList.add("bg-success");
                        setTimeout(() => {
                            window.location.href = xhr.responseURL;
                        }, 1000);
                    } else {
                        uploadStatus.innerHTML =
                            '<small class="text-danger">Upload gagal!</small>';
                        console.error("Upload error:", xhr.responseText);
                    }
                }
            };

            xhr.open("POST", form.action, true);
            xhr.setRequestHeader("X-CSRF-TOKEN", token);
            xhr.send(formData);
        });
    });

    // --- TIKTOK FORM HANDLER ---
    const addFileBtnTiktok = document.getElementById("add-file-btn-tiktok");
    const addCoverBtnTiktok = document.getElementById("add-cover-btn-tiktok");
    const fileInputTiktok = document.getElementById("tiktok_media");
    const coverInputTiktok = document.getElementById("tiktok_cover");
    const previewContainerTiktok = document.getElementById(
        "preview-container-tiktok"
    );
    const tiktokForm = document.querySelector(".form-marketing-tiktok");

    let tiktokFilesToUpload = [];
    let tiktokCoverFile = null;

    if (addFileBtnTiktok && fileInputTiktok && previewContainerTiktok) {
        addFileBtnTiktok.addEventListener("click", () =>
            fileInputTiktok.click()
        );

        fileInputTiktok.addEventListener("change", (e) => {
            const newFiles = Array.from(e.target.files);
            newFiles.forEach((file) => {
                tiktokFilesToUpload.push(file);
                renderPreviewTiktok(file, tiktokFilesToUpload.length - 1);
            });
            fileInputTiktok.value = "";
        });
    }

    if (addCoverBtnTiktok && coverInputTiktok && previewContainerTiktok) {
        addCoverBtnTiktok.addEventListener("click", () =>
            coverInputTiktok.click()
        );

        coverInputTiktok.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (file) {
                tiktokCoverFile = file;
                renderPreviewTiktok(file, tiktokFilesToUpload.length, true);
            }
            coverInputTiktok.value = "";
        });
    }

    function renderPreviewTiktok(file, index, isCover = false) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const col = document.createElement("div");
            col.className = "col-md-3 mb-3";

            const card = document.createElement("div");
            card.className = "position-relative border p-1 rounded";

            const removeBtn = document.createElement("button");
            removeBtn.innerHTML = "&times;";
            removeBtn.className =
                "btn btn-danger btn-sm position-absolute top-0 end-0";
            removeBtn.type = "button";
            removeBtn.onclick = () => {
                if (isCover) {
                    tiktokCoverFile = null;
                } else {
                    tiktokFilesToUpload.splice(index, 1);
                }
                previewContainerTiktok.removeChild(col);
            };

            let media;
            if (file.type.startsWith("video/")) {
                media = document.createElement("video");
                media.src = e.target.result;
                media.controls = true;
                media.className = "w-100";
            } else {
                media = document.createElement("img");
                media.src = e.target.result;
                media.className = "img-fluid";
            }

            card.appendChild(removeBtn);
            card.appendChild(media);
            col.appendChild(card);
            previewContainerTiktok.appendChild(col);
        };
        reader.readAsDataURL(file);
    }

    // Handle TikTok form submission
    document.querySelectorAll(".form-marketing-tiktok").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Tambahkan media TikTok
            tiktokFilesToUpload.forEach((file) => {
                formData.append("tiktok_media[]", file);
            });

            // Tambahkan cover jika ada
            if (tiktokCoverFile) {
                formData.append("cover", tiktokCoverFile);
            }

            const token = this.querySelector('input[name="_token"]').value;

            const xhr = new XMLHttpRequest();

            // Update progress bar
            const progressBar = form.querySelector(".progress-bar");
            const progressContainer = form.querySelector(".progress");
            const uploadStatus = form.querySelector("#upload-status");
            const uploadPercentage = form.querySelector("#upload-percentage");

            progressContainer.style.display = "block";
            uploadStatus.style.display = "block";
            progressBar.style.width = "0%";
            uploadPercentage.innerText = "0";

            xhr.upload.addEventListener("progress", function (e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percent + "%";
                    uploadPercentage.innerText = percent;
                }
            });

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        uploadStatus.innerHTML =
                            '<small class="text-success">Upload selesai!</small>';
                        progressBar.classList.add("bg-success");
                        setTimeout(() => {
                            window.location.href = xhr.responseURL;
                        }, 1000);
                    } else {
                        uploadStatus.innerHTML =
                            '<small class="text-danger">Upload gagal!</small>';
                        console.error("Upload error:", xhr.responseText);
                    }
                }
            };

            xhr.open("POST", form.action, true);
            xhr.setRequestHeader("X-CSRF-TOKEN", token);
            xhr.send(formData);
        });
    });

    // ------------------- UNTUK MODAL EDIT TIKTOK ----------------------
    let editFilesToUploadTiktok = {};

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-existing-media")) {
            const btn = e.target;
            const parent = btn.closest(".preview-item");
            if (parent) {
                parent.remove();

                const mediaId = btn.getAttribute("data-media-id");
                const form = btn.closest("form");
                if (form) {
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "media_to_delete_tiktok[]";
                    input.value = mediaId;
                    form.appendChild(input);
                }
            }
        }
    });

    document.querySelectorAll(".edit-add-file-btn-tiktok").forEach((button) => {
        button.addEventListener("click", () => {
            const postId = button.getAttribute("data-id");
            const fileInput = document.querySelector(
                `#edit_content_media_tiktok${postId}`
            );
            if (fileInput) fileInput.click();
        });
    });

    document
        .querySelectorAll(".edit-file-input-tiktok")
        .forEach((fileInput) => {
            fileInput.addEventListener("change", (e) => {
                const postId = fileInput.getAttribute("data-id");
                const files = Array.from(e.target.files);

                if (!editFilesToUploadTiktok[postId]) {
                    editFilesToUploadTiktok[postId] = [];
                }

                files.forEach((file) => {
                    editFilesToUploadTiktok[postId].push(file);
                    renderEditPreviewTiktok(file, postId);
                });

                fileInput.value = ""; // reset
            });
        });

    function renderEditPreviewTiktok(file, postId) {
        const container = document.querySelector(
            `#edit-preview-container-tiktok-${postId}`
        );
        if (!container) return;

        const reader = new FileReader();
        const col = document.createElement("div");
        col.className = "col-md-4 mb-2 position-relative preview-item";

        const card = document.createElement("div");
        card.className = "position-relative border p-1 rounded";

        const removeBtn = document.createElement("button");
        removeBtn.innerHTML = "&times;";
        removeBtn.className =
            "btn btn-danger btn-sm position-absolute top-0 end-0";
        removeBtn.type = "button";
        removeBtn.onclick = () => {
            const index = editFilesToUploadTiktok[postId].indexOf(file);
            if (index > -1) {
                editFilesToUploadTiktok[postId].splice(index, 1);
            }
            container.removeChild(col);
        };

        reader.onload = function (e) {
            let media;
            if (file.type.startsWith("video/")) {
                media = document.createElement("video");
                media.src = e.target.result;
                media.controls = true;
                media.className = "w-100";
            } else {
                media = document.createElement("img");
                media.src = e.target.result;
                media.className = "img-fluid rounded";
            }

            card.appendChild(removeBtn);
            card.appendChild(media);
            col.appendChild(card);
            container.appendChild(col);
        };
        reader.readAsDataURL(file);
    }

    // Handle form submission for edit TikTok
    document.querySelectorAll(".form-marketing-edit-tiktok").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const postId = this.querySelector('input[name="id"]').value;

            // Get all existing media IDs that are still visible (not deleted)
            const existingMediaIds = Array.from(
                this.querySelectorAll(
                    '.preview-item input[name="existing_media_ids[]"]'
                )
            ).map((input) => input.value);

            // Add existing media IDs to formData
            existingMediaIds.forEach((id) => {
                formData.append("media_to_delete_tiktok[]", id);
            });

            // Add new files to FormData
            if (editFilesToUploadTiktok[postId]) {
                editFilesToUploadTiktok[postId].forEach((file) => {
                    formData.append("tiktok_media[]", file);
                });
            }

            // Get CSRF token from the form's _token input
            const token = this.querySelector('input[name="_token"]').value;

            const progressBar = form.querySelector(".progress");
            const progressBarInner = progressBar.querySelector(".progress-bar");
            const uploadStatus = form.querySelector("#upload-status");
            const uploadPercentage = form.querySelector("#upload-percentage");

            progressBar.style.display = "block";
            uploadStatus.style.display = "block";

            // Use XMLHttpRequest instead of fetch for upload progress
            const xhr = new XMLHttpRequest();
            xhr.open("POST", form.action, true);

            xhr.upload.addEventListener("progress", function (e) {
                if (e.lengthComputable) {
                    const percentCompleted = Math.round(
                        (e.loaded * 100) / e.total
                    );
                    progressBarInner.style.width = percentCompleted + "%";
                    uploadPercentage.textContent = percentCompleted;
                }
            });

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        uploadStatus.innerHTML =
                            '<small class="text-success">Upload selesai!</small>';
                        progressBar.classList.add("bg-success");
                        setTimeout(() => {
                            window.location.href = xhr.responseURL;
                        }, 1000);
                    } else {
                        uploadStatus.innerHTML =
                            '<small class="text-danger">Upload gagal!</small>';
                        console.error("Upload error:", xhr.responseText);
                    }
                }
            };

            xhr.open("POST", form.action, true);
            xhr.setRequestHeader("X-CSRF-TOKEN", token);
            xhr.send(formData);
        });
    });

    // Handle form submission for edit profile (modal)
    document
        .querySelectorAll(".form-marketing-edit-profile-existing")
        .forEach((form) => {
            form.addEventListener("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                const action = this.action;
                const method =
                    this.querySelector('input[name="_method"]')?.value ||
                    "POST";
                const token = this.querySelector('input[name="_token"]').value;
                // Remove previous alert
                const alertSuccess =
                    this.closest(".modal-content").querySelector(
                        ".alert-success"
                    );
                const alertError =
                    this.closest(".modal-content").querySelector(
                        ".alert-danger"
                    );
                if (alertSuccess) alertSuccess.remove();
                if (alertError) alertError.remove();

                fetch(action, {
                    method: method === "PUT" ? "POST" : method,
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                })
                    .then(async (response) => {
                        if (response.redirected) {
                            window.location.href = response.url;
                            return;
                        }
                        const text = await response.text();
                        // Try to parse error message from response
                        let errorMsg = "";
                        try {
                            const json = JSON.parse(text);
                            errorMsg = json.message || text;
                        } catch {
                            errorMsg = text;
                        }
                        // Show error in modal
                        const alert = document.createElement("div");
                        alert.className = "alert alert-danger";
                        alert.innerText = errorMsg;
                        this.closest(".modal-content")
                            .querySelector(".modal-body")
                            .prepend(alert);
                    })
                    .catch((err) => {
                        const alert = document.createElement("div");
                        alert.className = "alert alert-danger";
                        alert.innerText = "Terjadi kesalahan: " + err;
                        this.closest(".modal-content")
                            .querySelector(".modal-body")
                            .prepend(alert);
                    });
            });
        });

    // Handle form submission for delete TikTok
    document
        .querySelectorAll(".form-marketing-delete-tiktok")
        .forEach((form) => {
            form.addEventListener("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                const action = this.action;
                const method =
                    this.querySelector('input[name="_method"]')?.value ||
                    "POST";
                const token = this.querySelector('input[name="_token"]').value;

                const modal = this.closest(".modal-content");
                const alertSuccess = modal.querySelector(".alert-success");
                const alertError = modal.querySelector(".alert-danger");

                if (alertSuccess) alertSuccess.remove();
                if (alertError) alertError.remove();

                fetch(action, {
                    method: method === "PUT" ? "POST" : method,
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                })
                    .then(async (response) => {
                        if (response.redirected) {
                            window.location.href = response.url;
                            return;
                        }

                        if (response.ok) {
                            const alert = document.createElement("div");
                            alert.className = "alert alert-success";
                            alert.innerText =
                                "Profil TikTok berhasil diperbarui!";
                            modal.querySelector(".modal-body").prepend(alert);
                            return;
                        }

                        const text = await response.text();
                        let errorMsg = "";
                        try {
                            const json = JSON.parse(text);
                            errorMsg = json.message || text;
                        } catch {
                            errorMsg = text;
                        }

                        const alert = document.createElement("div");
                        alert.className = "alert alert-danger";
                        alert.innerText = errorMsg;
                        modal.querySelector(".modal-body").prepend(alert);
                    })
                    .catch((err) => {
                        const alert = document.createElement("div");
                        alert.className = "alert alert-danger";
                        alert.innerText = "Terjadi kesalahan: " + err;
                        modal.querySelector(".modal-body").prepend(alert);
                    });
            });
        });
});

document.addEventListener("DOMContentLoaded", function () {
    // ... existing code ...
    const tables = {
        meta_ads: `
        <div class="row" data-table="meta_ads">
            <div>
                <label class="form-check-label"><h5>Meta</h5></label>
            </div>
            <div class="col-md-6">
                <label for="meta_regular" class="form-label">Regular:</label>
                <input class="form-control ads-input" type="number" name="meta_regular" id="meta_regular" placeholder="Meta Regular" value="0">
            </div>
            <div class="col-md-6">
                <label for="meta_cpas" class="form-label">CPAS:</label>
                <input class="form-control ads-input" type="number" name="meta_cpas" id="meta_cpas" placeholder="Meta CPAS" value="0">
            </div>
        </div>
    `,
        google_ads: `
        <div class="row" data-table="google_ads">
            <div>
                <label class="form-check-label"><h5>Google</h5></label>
            </div>
            <div class="col-md-3">
                <label for="google_search" class="form-label">Search:</label>
                <input class="form-control ads-input" type="number" name="google_search" id="google_search" placeholder="Google Search" value="0">
            </div>
            <div class="col-md-3">
                <label for="google_youtube" class="form-label">YouTube:</label>
                <input class="form-control ads-input" type="number" name="google_youtube" id="google_youtube" placeholder="Google YouTube" value="0">
            </div>
            <div class="col-md-3">
                <label for="google_gtm" class="form-label">GTM:</label>
                <input class="form-control ads-input" type="number" name="google_gtm" id="google_gtm" placeholder="Google GTM" value="0">
            </div>
            <div class="col-md-3">
                <label for="google_performance_max" class="form-label">Performance Max:</label>
                <input class="form-control ads-input" type="number" name="google_performance_max" id="google_performance_max" placeholder="Performance Max" value="0">
            </div>
        </div>
    `,
        shopee_ads: `
        <div class="row" data-table="shopee_ads">
            <div>
                <label class="form-check-label"><h5>Shopee</h5></label>
            </div>
            <div class="col-md-4">
                <label for="shopee_manual" class="form-label">Manual:</label>
                <input class="form-control ads-input" type="number" name="shopee_manual" id="shopee_manual" placeholder="Manual" value="0">
            </div>
            <div class="col-md-4">
                <label for="shopee_auto_meta" class="form-label">Auto Meta:</label>
                <input class="form-control ads-input" type="number" name="shopee_auto_meta" id="shopee_auto_meta" placeholder="Auto Meta" value="0">
            </div>
            <div class="col-md-4">
                <label for="shopee_gmv" class="form-label">GMV:</label>
                <input class="form-control ads-input" type="number" name="shopee_gmv" id="shopee_gmv" placeholder="GMV" value="0">
            </div>
            <div class="col-md-6">
                <label for="shopee_toko" class="form-label">Toko:</label>
                <input class="form-control ads-input" type="number" name="shopee_toko" id="shopee_toko" placeholder="Toko" value="0">
            </div>
            <div class="col-md-6">
                <label for="shopee_live" class="form-label">Live:</label>
                <input class="form-control ads-input" type="number" name="shopee_live" id="shopee_live" placeholder="Live" value="0">
            </div>
        </div>
    `,
        tokped_ads: `
        <div class="row" data-table="tokped_ads">
            <div>
                <label class="form-check-label"><h5>Tokopedia</h5></label>
            </div>
            <div class="col-md-4">
                <label for="tokped_manual" class="form-label">Manual:</label>
                <input class="form-control ads-input" type="number" name="tokped_manual" id="tokped_manual" placeholder="Manual" value="0">
            </div>
            <div class="col-md-4">
                <label for="tokped_auto_meta" class="form-label">Auto Meta:</label>
                <input class="form-control ads-input" type="number" name="tokped_auto_meta" id="tokped_auto_meta" placeholder="Auto Meta" value="0">
            </div>
            <div class="col-md-4">
                <label for="tokped_toko" class="form-label">Toko:</label>
                <input class="form-control ads-input" type="number" name="tokped_toko" id="tokped_toko" placeholder="Toko" value="0">
            </div>
        </div>
    `,
        tiktok_ads: `
        <div class="row" data-table="tiktok_ads">
            <div>
                <label class="form-check-label"><h5>TikTok</h5></label>
            </div>
            <div class="col-md-3">
                <label for="tiktok_gmv_max" class="form-label">GMV Max:</label>
                <input class="form-control ads-input" type="number" name="tiktok_gmv_max" id="tiktok_gmv_max" placeholder="GMV Max" value="0">
            </div>
            <div class="col-md-3">
                <label for="tiktok_live_shopping" class="form-label">Live Shopping:</label>
                <input class="form-control ads-input" type="number" name="tiktok_live_shopping" id="tiktok_live_shopping" placeholder="Live Shopping" value="0">
            </div>
            <div class="col-md-3">
                <label for="tiktok_product_shopping" class="form-label">Product Shopping:</label>
                <input class="form-control ads-input" type="number" name="tiktok_product_shopping" id="tiktok_product_shopping" placeholder="Product Shopping" value="0">
            </div>
            <div class="col-md-3">
                <label for="tiktok_video_shopping" class="form-label">Video Shopping:</label>
                <input class="form-control ads-input" type="number" name="tiktok_video_shopping" id="tiktok_video_shopping" placeholder="Video Shopping" value="0">
            </div>
        </div>
    `,
    };
    document.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const inputsContainer = document.getElementById("ads-inputs");
            if (this.checked) {
                // inputsContainer.innerHTML += tables[this.value];
                inputsContainer.insertAdjacentHTML(
                    "beforeend",
                    tables[this.value]
                );
            } else {
                const rows = inputsContainer.querySelectorAll(
                    `[data-table="${this.value}"]`
                );
                rows.forEach((row) => row.remove());
            }
            calculateTotalTopup();
        });
    });

    document
        .getElementById("ads-inputs")
        .addEventListener("input", calculateTotalTopup);
    document.getElementById("omzet").addEventListener("input", calculateRoas);
    document.getElementById("total").addEventListener("input", calculateRoas);

    function calculateTotalTopup() {
        let total = 0;
        document.querySelectorAll(".ads-input").forEach((input) => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById("total").value = total || 0;
        calculateRoas();
    }

    function calculateRoas() {
        const omzet = parseFloat(document.getElementById("omzet").value) || 0;
        const total = parseFloat(document.getElementById("total").value) || 0;
        const roas = total ? (omzet / total).toFixed(2) : 0;
        document.getElementById("roas").value = roas;
    }

    document.querySelector("form").addEventListener("submit", function (event) {
        // Ensure all inputs are updated before form submission
        calculateTotalTopup();
        calculateRoas();

        document.querySelectorAll(".ads-input").forEach((input) => {
            if (!input.value) {
                input.value = 0;
            }
        });

        document
            .querySelectorAll('input[type="checkbox"]')
            .forEach((checkbox) => {
                if (!checkbox.checked) {
                    const hiddenInputs = tables[checkbox.value]
                        .match(/name="([^"]+)"/g)
                        .map((name) =>
                            name.replace('name="', "").replace('"', "")
                        );
                    hiddenInputs.forEach((name) => {
                        const hiddenInput = document.createElement("input");
                        hiddenInput.type = "hidden";
                        hiddenInput.name = name;
                        hiddenInput.value = 0;
                        this.appendChild(hiddenInput);
                    });
                }
            });
    });
});

function calculateTotal() {
    const metaRegular =
        parseFloat(document.getElementById("meta_regular").value) || 0;
    const metaCpas =
        parseFloat(document.getElementById("meta_cpas").value) || 0;
    const googleGtm =
        parseFloat(document.getElementById("google_gtm").value) || 0;
    const googleSearch =
        parseFloat(document.getElementById("google_search").value) || 0;
    const googleYoutube =
        parseFloat(document.getElementById("google_youtube").value) || 0;
    const googlePerformanceMax =
        parseFloat(document.getElementById("google_performance_max").value) ||
        0;
    const shopeeManual =
        parseFloat(document.getElementById("shopee_manual").value) || 0;
    const shopeAutoMeta =
        parseFloat(document.getElementById("shopee_auto_meta").value) || 0;
    const shopeeGmv =
        parseFloat(document.getElementById("shopee_gmv").value) || 0;
    const shopeeToko =
        parseFloat(document.getElementById("shopee_toko").value) || 0;
    const shopeeLive =
        parseFloat(document.getElementById("shopee_live").value) || 0;
    const tokpedManual =
        parseFloat(document.getElementById("tokped_manual").value) || 0;
    const tokpedAutoMeta =
        parseFloat(document.getElementById("tokped_auto_meta").value) || 0;
    const tokpedToko =
        parseFloat(document.getElementById("tokped_toko").value) || 0;
    const tiktokLiveShopping =
        parseFloat(document.getElementById("tiktok_live_shopping").value) || 0;
    const tiktokProductShopping =
        parseFloat(document.getElementById("tiktok_product_shopping").value) ||
        0;
    const tiktokVideoShopping =
        parseFloat(document.getElementById("tiktok_video_shopping").value) || 0;
    const tiktokGmvMax =
        parseFloat(document.getElementById("tiktok_gmv_max").value) || 0;

    const total =
        metaRegular +
        metaCpas +
        googleGtm +
        googleSearch +
        googleYoutube +
        googlePerformanceMax +
        shopeeManual +
        shopeAutoMeta +
        shopeeGmv +
        shopeeToko +
        shopeeLive +
        tokpedManual +
        tokpedAutoMeta +
        tokpedToko +
        tiktokLiveShopping +
        tiktokProductShopping +
        tiktokVideoShopping +
        tiktokGmvMax;
    document.getElementById("total").value = total.toFixed(2);

    // Update ROAS based on omzet and total
    const omzet = parseFloat(document.getElementById("omzet").value) || 0;
    const roasValue = total > 0 ? omzet / total : 0;
    document.getElementById("roas").value = roasValue.toFixed(2);
}

document.querySelectorAll('input[type="number"]').forEach((input) => {
    input.addEventListener("input", calculateTotal);
});

// Initial calculation
calculateTotal();

// function toggleCollapse(showId, hideId, activeButton) {
//     var showElement = document.getElementById(showId);
//     var hideElement = document.getElementById(hideId);

//     // Mengubah warna tombol aktif
//     document.querySelectorAll('.btn-style-client').forEach(function (btn) {
//         btn.classList.remove('active'); // Menghapus kelas aktif dari semua tombol
//     });
//     activeButton.classList.add('active'); // Menambahkan kelas aktif pada tombol yang ditekan

//     if (showElement.classList.contains('show')) {
//         showElement.classList.remove('show');
//     } else {
//         showElement.classList.add('show');
//     }
//     hideElement.classList.remove('show');
// }
