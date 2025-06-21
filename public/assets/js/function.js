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

function formatRupiah(angka) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(angka);
}

document.addEventListener("DOMContentLoaded", function () {
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
                <label for="meta_regular_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="meta_regular_revenue" id="meta_regular_revenue" placeholder="Meta Regular Revenue" value="0">
            </div>
            <div class="col-md-6">
                <label for="meta_cpas" class="form-label">CPAS:</label>
                <input class="form-control ads-input" type="number" name="meta_cpas" id="meta_cpas" placeholder="Meta CPAS" value="0">
            </div>
            <div class="col-md-6">
                <label for="meta_cpas_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="meta_cpas_revenue" id="meta_cpas_revenue" placeholder="Meta CPAS Revenue" value="0">
            </div>
        </div>
    `,
        google_ads: `
        <div class="row" data-table="google_ads">
            <div>
                <label class="form-check-label"><h5>Google</h5></label>
            </div>
            <div class="col-md-6">
                <label for="google_search" class="form-label">Search:</label>
                <input class="form-control ads-input" type="number" name="google_search" id="google_search" placeholder="Google Search" value="0">
            </div>
            <div class="col-md-6">
                <label for="google_search_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="google_search_revenue" id="google_search_revenue" placeholder="Google Search Revenue" value="0">
            </div>
            <div class="col-md-6">
                <label for="google_performance_max" class="form-label">Performance Max:</label>
                <input class="form-control ads-input" type="number" name="google_performance_max" id="google_performance_max" placeholder="Performance Max" value="0">
            </div>
            <div class="col-md-6">
                <label for="google_performance_max_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="google_performance_max_revenue" id="google_performance_max_revenue" placeholder="Performance Max Revenue" value="0">
            </div>
        </div>
    `,
        shopee_ads: `
        <div class="row" data-table="shopee_ads">
            <div>
                <label class="form-check-label"><h5>Shopee</h5></label>
            </div>
            <div class="col-md-6">
                <label for="shopee_produk" class="form-label">Produk:</label>
                <input class="form-control ads-input" type="number" name="shopee_produk" id="shopee_produk" placeholder="Manual" value="0">
            </div>
            <div class="col-md-6">
                <label for="shopee_produk_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="shopee_produk_revenue" id="shopee_produk_revenue" placeholder="Manual" value="0">
            </div>
            <div class="col-md-6">
                <label for="shopee_toko" class="form-label">Toko:</label>
                <input class="form-control ads-input" type="number" name="shopee_toko" id="shopee_toko" placeholder="Toko" value="0">
            </div>
            <div class="col-md-6">
                <label for="shopee_toko_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="shopee_toko_revenue" id="shopee_toko_revenue" placeholder="Toko" value="0">
            </div>
            <div class="col-md-6">
                <label for="shopee_live" class="form-label">Live:</label>
                <input class="form-control ads-input" type="number" name="shopee_live" id="shopee_live" placeholder="Live" value="0">
            </div>
            <div class="col-md-6">
                <label for="shopee_live_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="shopee_live_revenue" id="shopee_live_revenue" placeholder="Live" value="0">
            </div>
        </div>
    `,
        tiktok_ads: `
        <div class="row" data-table="tiktok_ads">
            <div>
                <label class="form-check-label"><h5>TikTok</h5></label>
            </div>
            <div class="col-md-6">
                <label for="tiktok_gmv_max" class="form-label">GMV Max:</label>
                <input class="form-control ads-input" type="number" name="tiktok_gmv_max" id="tiktok_gmv_max" placeholder="GMV Max" value="0">
            </div>
            <div class="col-md-6">
                <label for="tiktok_gmv_max_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="tiktok_gmv_max_revenue" id="tiktok_gmv_max_revenue" placeholder="GMV Max" value="0">
            </div>
            <div class="col-md-6">
                <label for="tiktok_live_shopping" class="form-label">Live Shopping Ads:</label>
                <input class="form-control ads-input" type="number" name="tiktok_live_shopping" id="tiktok_live_shopping" placeholder="Live Shopping" value="0">
            </div>
            <div class="col-md-6">
                <label for="tiktok_live_shopping_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="tiktok_live_shopping_revenue" id="tiktok_live_shopping_revenue" placeholder="Live Shopping" value="0">
            </div>
            <div class="col-md-6">
                <label for="tiktok_product_shopping" class="form-label">Product Shopping Ads:</label>
                <input class="form-control ads-input" type="number" name="tiktok_product_shopping" id="tiktok_product_shopping" placeholder="Product Shopping" value="0">
            </div>
            <div class="col-md-6">
                <label for="tiktok_product_shopping_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="tiktok_product_shopping_revenue" id="tiktok_product_shopping_revenue" placeholder="Product Shopping" value="0">
            </div>
            <div class="col-md-6">
                <label for="tiktok_video_shopping" class="form-label">Video Shopping Ads:</label>
                <input class="form-control ads-input" type="number" name="tiktok_video_shopping" id="tiktok_video_shopping" placeholder="Video Shopping" value="0">
            </div>
            <div class="col-md-6">
                <label for="tiktok_video_shopping_revenue" class="form-label">Revenue:</label>
                <input class="form-control ads-input" type="number" name="tiktok_video_shopping_revenue" id="tiktok_video_shopping_revenue" placeholder="Video Shopping" value="0">
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
        let totalTopup = 0;

        document.querySelectorAll(".ads-input").forEach((input) => {
            const name = input.name.toLowerCase();
            if (!name.includes("revenue")) {
                const value = parseFloat(input.value) || 0;
                totalTopup += value;
            }
        });

        // Tampilkan dengan format rupiah
        document.getElementById("total_display").value =
            formatRupiah(totalTopup);

        // Simpan value aslinya di hidden input untuk dikirim ke server
        document.getElementById("total").value = totalTopup.toFixed(2);

        calculateRoas();
    }

    function calculateRoas() {
        const omzet = parseFloat(document.getElementById("omzet").value) || 0;
        const totalTopup =
            parseFloat(document.getElementById("total").value) || 0;
        const roas = totalTopup > 0 ? (omzet / totalTopup).toFixed(2) : "0.00";
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

function calculateOmzetFromRevenue() {
    let totalRevenue = 0;
    document.querySelectorAll('input[type="number"]').forEach((input) => {
        if (input.name.includes("revenue")) {
            totalRevenue += parseFloat(input.value) || 0;
        }
    });

    document.getElementById("omzet_display").value = formatRupiah(totalRevenue);
    document.getElementById("omzet").value = totalRevenue.toFixed(2);
    calculateRoas();
}

// Jalankan ketika ada perubahan input revenue
document.getElementById("ads-inputs").addEventListener("input", function (e) {
    if (e.target.name.includes("revenue")) {
        calculateOmzetFromRevenue();
    }
});

// Jalankan juga saat awal load form
calculateOmzetFromRevenue();
