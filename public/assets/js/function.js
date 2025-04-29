// document.addEventListener("DOMContentLoaded", function () {
//     const addFileBtn = document.getElementById('add-file-btn');
//     const fileInput = document.getElementById('content_media');
//     const previewContainer = document.getElementById('preview-container');
//     const form = document.querySelector('.form-marketing');
//     const editForm = document.getElementById('edit-form') || form;

//     // Simpan file baru yang dipilih
//     let filesToUpload = [];
//     // Simpan elemen preview agar bisa dikelola index-nya
//     let previewElements = [];

//     // Klik tombol untuk pilih file
//     addFileBtn.addEventListener('click', () => {
//         fileInput.click();
//     });

//     // Saat file dipilih
//     fileInput.addEventListener('change', (e) => {
//         const newFiles = Array.from(e.target.files);

//         newFiles.forEach((file) => {
//             filesToUpload.push(file);
//             renderPreview(file);
//         });

//         fileInput.value = '';
//     });

//     function renderPreview(file, isExisting = false, existingUrl = '') {
//         const reader = new FileReader();
//         const col = document.createElement('div');
//         col.className = 'col-md-3 mb-3 preview-item';

//         const card = document.createElement('div');
//         card.className = 'position-relative border p-1 rounded';

//         const removeBtn = document.createElement('button');
//         removeBtn.innerHTML = '&times;';
//         removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
//         removeBtn.type = 'button';
//         removeBtn.onclick = () => {
//             if (!isExisting) {
//                 const index = previewElements.indexOf(col);
//                 if (index > -1) {
//                     filesToUpload.splice(index, 1);
//                     previewElements.splice(index, 1);
//                 }
//             }
//             previewContainer.removeChild(col);
//         };

//         let media;

//         if (isExisting) {
//             media = file.type === 'video' ?
//                 document.createElement('video') :
//                 document.createElement('img');

//             media.src = existingUrl;
//             if (file.type === 'video') {
//                 media.controls = true;
//                 media.className = 'w-100';
//             } else {
//                 media.className = 'img-fluid';
//             }

//             card.appendChild(removeBtn);
//             card.appendChild(media);
//             col.appendChild(card);
//             previewContainer.appendChild(col);
//         } else {
//             reader.onload = function (e) {
//                 if (file.type.startsWith('video/')) {
//                     media = document.createElement('video');
//                     media.src = e.target.result;
//                     media.controls = true;
//                     media.className = 'w-100';
//                 } else {
//                     media = document.createElement('img');
//                     media.src = e.target.result;
//                     media.className = 'img-fluid';
//                 }

//                 card.appendChild(removeBtn);
//                 card.appendChild(media);
//                 col.appendChild(card);
//                 previewContainer.appendChild(col);
//                 previewElements.push(col);
//             };
//             reader.readAsDataURL(file);
//         }
//     }

//     // Submit form pakai fetch
//     editForm.addEventListener('submit', function (e) {
//         e.preventDefault();

//         const formData = new FormData(editForm);
//         filesToUpload.forEach((file) => {
//             formData.append('content_media[]', file);
//         });

//         fetch(editForm.action, {
//                 method: 'POST',
//                 body: formData,
//             })
//             .then(res => res.redirected ? window.location.href = res.url : res.text())
//             .then(data => console.log(data))
//             .catch(err => console.error('Upload error:', err));
//     });

//     // ====== FUNGSI UNTUK EDIT ======

//     // Fungsi untuk load data post ke modal
//     window.showEditModal = function (data) {
//         // Kosongkan form & preview sebelumnya
//         editForm.reset();
//         previewContainer.innerHTML = '';
//         filesToUpload = [];
//         previewElements = [];

//         // Isi form dengan data
//         document.getElementById('post-id').value = data.id;
//         document.getElementById('caption').value = data.caption;
//         document.getElementById('content').value = data.content;
//         document.getElementById('created_at').value = data.created_at;

//         // Render media lama (gambar/video dari server)
//         if (data.media && data.media.length > 0) {
//             data.media.forEach(media => {
//                 renderPreview({
//                     type: media.type
//                 }, true, media.url);
//             });
//         }

//         // Tampilkan modal edit
//         $('#editSAModal').modal('show');
//     };
// });


document.addEventListener("DOMContentLoaded", function () {
    // ------------------- UNTUK MODAL ADD ----------------------
    const addFileBtn = document.getElementById('add-file-btn');
    const fileInput = document.getElementById('content_media');
    const previewContainer = document.getElementById('preview-container');
    let filesToUpload = [];

    if (addFileBtn) {
        addFileBtn.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', (e) => {
            const newFiles = Array.from(e.target.files);

            newFiles.forEach(file => {
                filesToUpload.push(file);
                renderPreview(file, filesToUpload.length - 1);
            });

            fileInput.value = '';
        });
    }

    function renderPreview(file, index) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const col = document.createElement('div');
            col.className = 'col-md-3 mb-3';

            const card = document.createElement('div');
            card.className = 'position-relative border p-1 rounded';

            const removeBtn = document.createElement('button');
            removeBtn.innerHTML = '&times;';
            removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
            removeBtn.type = 'button';
            removeBtn.onclick = () => {
                filesToUpload.splice(index, 1);
                previewContainer.removeChild(col);
            };

            let media;
            if (file.type.startsWith('video/')) {
                media = document.createElement('video');
                media.src = e.target.result;
                media.controls = true;
                media.className = 'w-100';
            } else {
                media = document.createElement('img');
                media.src = e.target.result;
                media.className = 'img-fluid';
            }

            card.appendChild(removeBtn);
            card.appendChild(media);
            col.appendChild(card);
            previewContainer.appendChild(col);
        };

        reader.readAsDataURL(file);
    }

    const form = document.querySelector('.form-marketing');
    form.addEventListener('submit', function (e) {
        const formData = new FormData(form);

        filesToUpload.forEach(file => {
            formData.append('content_media[]', file);
        });

        e.preventDefault();

        fetch(form.action, {
                method: 'POST',
                body: formData,
            })
            .then(res => res.redirected ? window.location.href = res.url : res.text())
            .then(data => console.log(data))
            .catch(err => console.error('Upload error:', err));
    });

    // ------------------- UNTUK MODAL EDIT ----------------------
    const editAddFileBtn = document.getElementById('edit-add-file-btn');
    const editFileInput = document.getElementById('edit_content_media');
    const editPreviewContainer = document.getElementById('edit-preview-container');
    let editFilesToUpload = [];
    let editPreviewElements = [];

    if (editAddFileBtn) {
        editAddFileBtn.addEventListener('click', () => editFileInput.click());

        editFileInput.addEventListener('change', (e) => {
            const newFiles = Array.from(e.target.files);

            newFiles.forEach((file) => {
                editFilesToUpload.push(file);
                renderEditPreview(file);
            });

            editFileInput.value = '';
        });
    }

    function renderEditPreview(file, isExisting = false, existingUrl = '') {
        const reader = new FileReader();
        const col = document.createElement('div');
        col.className = 'col-md-3 mb-3 preview-item';

        const card = document.createElement('div');
        card.className = 'position-relative border p-1 rounded';

        const removeBtn = document.createElement('button');
        removeBtn.innerHTML = '&times;';
        removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
        removeBtn.type = 'button';
        removeBtn.onclick = () => {
            if (!isExisting) {
                const index = editPreviewElements.indexOf(col);
                if (index > -1) {
                    editFilesToUpload.splice(index, 1);
                    editPreviewElements.splice(index, 1);
                }
            }
            editPreviewContainer.removeChild(col);
        };

        let media;
        if (isExisting) {
            media = file.type === 'video' ? document.createElement('video') : document.createElement('img');
            media.src = existingUrl;
            if (file.type === 'video') {
                media.controls = true;
                media.className = 'w-100';
            } else {
                media.className = 'img-fluid';
            }

            card.appendChild(removeBtn);
            card.appendChild(media);
            col.appendChild(card);
            editPreviewContainer.appendChild(col);
        } else {
            reader.onload = function (e) {
                if (file.type.startsWith('video/')) {
                    media = document.createElement('video');
                    media.src = e.target.result;
                    media.controls = true;
                    media.className = 'w-100';
                } else {
                    media = document.createElement('img');
                    media.src = e.target.result;
                    media.className = 'img-fluid';
                }

                card.appendChild(removeBtn);
                card.appendChild(media);
                col.appendChild(card);
                editPreviewContainer.appendChild(col);
                editPreviewElements.push(col);
            };
            reader.readAsDataURL(file);
        }
    }
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
                <input class="form-control ads-input" type="text" name="meta_regular" id="meta_regular" placeholder="Meta Regular" value="0">
            </div>
            <div class="col-md-6">
                <label for="meta_cpas" class="form-label">CPAS:</label>
                <input class="form-control ads-input" type="text" name="meta_cpas" id="meta_cpas" placeholder="Meta CPAS" value="0">
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
                <input class="form-control ads-input" type="text" name="google_search" id="google_search" placeholder="Google Search" value="0">
            </div>
            <div class="col-md-3">
                <label for="google_youtube" class="form-label">YouTube:</label>
                <input class="form-control ads-input" type="text" name="google_youtube" id="google_youtube" placeholder="Google YouTube" value="0">
            </div>
            <div class="col-md-3">
                <label for="google_gtm" class="form-label">GTM:</label>
                <input class="form-control ads-input" type="text" name="google_gtm" id="google_gtm" placeholder="Google GTM" value="0">
            </div>
            <div class="col-md-3">
                <label for="google_performance_max" class="form-label">Performance Max:</label>
                <input class="form-control ads-input" type="text" name="google_performance_max" id="google_performance_max" placeholder="Performance Max" value="0">
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
                <input class="form-control ads-input" type="text" name="shopee_manual" id="shopee_manual" placeholder="Manual" value="0">
            </div>
            <div class="col-md-4">
                <label for="shopee_auto_meta" class="form-label">Auto Meta:</label>
                <input class="form-control ads-input" type="text" name="shopee_auto_meta" id="shopee_auto_meta" placeholder="Auto Meta" value="0">
            </div>
            <div class="col-md-4">
                <label for="shopee_gmv" class="form-label">GMV:</label>
                <input class="form-control ads-input" type="text" name="shopee_gmv" id="shopee_gmv" placeholder="GMV" value="0">
            </div>
            <div class="col-md-6">
                <label for="shopee_toko" class="form-label">Toko:</label>
                <input class="form-control ads-input" type="text" name="shopee_toko" id="shopee_toko" placeholder="Toko" value="0">
            </div>
            <div class="col-md-6">
                <label for="shopee_live" class="form-label">Live:</label>
                <input class="form-control ads-input" type="text" name="shopee_live" id="shopee_live" placeholder="Live" value="0">
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
                <input class="form-control ads-input" type="text" name="tokped_manual" id="tokped_manual" placeholder="Manual" value="0">
            </div>
            <div class="col-md-4">
                <label for="tokped_auto_meta" class="form-label">Auto Meta:</label>
                <input class="form-control ads-input" type="text" name="tokped_auto_meta" id="tokped_auto_meta" placeholder="Auto Meta" value="0">
            </div>
            <div class="col-md-4">
                <label for="tokped_toko" class="form-label">Toko:</label>
                <input class="form-control ads-input" type="text" name="tokped_toko" id="tokped_toko" placeholder="Toko" value="0">
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
                <input class="form-control ads-input" type="text" name="tiktok_gmv_max" id="tiktok_gmv_max" placeholder="GMV Max" value="0">
            </div>
            <div class="col-md-3">
                <label for="tiktok_live_shopping" class="form-label">Live Shopping:</label>
                <input class="form-control ads-input" type="text" name="tiktok_live_shopping" id="tiktok_live_shopping" placeholder="Live Shopping" value="0">
            </div>
            <div class="col-md-3">
                <label for="tiktok_product_shopping" class="form-label">Product Shopping:</label>
                <input class="form-control ads-input" type="text" name="tiktok_product_shopping" id="tiktok_product_shopping" placeholder="Product Shopping" value="0">
            </div>
            <div class="col-md-3">
                <label for="tiktok_video_shopping" class="form-label">Video Shopping:</label>
                <input class="form-control ads-input" type="text" name="tiktok_video_shopping" id="tiktok_video_shopping" placeholder="Video Shopping" value="0">
            </div>
        </div>
    `,
    };
    document.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const inputsContainer = document.getElementById("ads-inputs");
            if (this.checked) {
                inputsContainer.innerHTML += tables[this.value];
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
