    {{-- Script untuk modal Instagram --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const igAddLinkBtn = document.querySelector("#addPofileIGModal #add-link-btn");
            const igLinksContainer = document.querySelector("#addPofileIGModal #links-container");
            let igLinkIndex = igLinksContainer ? igLinksContainer.querySelectorAll(".row").length : 0;

            @if (!$profileIG)
                if (igAddLinkBtn && igLinksContainer) {
                    igAddLinkBtn.addEventListener("click", function(e) {
                        e.preventDefault();
                        igLinkIndex++;
                        const linkGroup = document.createElement("div");
                        linkGroup.className = "mb-2 row align-items-center";
                        linkGroup.innerHTML = `
                        <div class="col-md-5">
                            <input class="form-control mb-1" name="links[${igLinkIndex}][url]" placeholder="URL" required>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control mb-1" name="links[${igLinkIndex}][name]" placeholder="Nama Link" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm remove-link-btn" title="Hapus Link">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                        igLinksContainer.appendChild(linkGroup);
                        linkGroup.querySelector(".remove-link-btn").addEventListener("click", function() {
                            igLinksContainer.removeChild(linkGroup);
                        });
                    });

                    igLinksContainer.querySelectorAll(".remove-link-btn").forEach(function(btn) {
                        btn.addEventListener("click", function() {
                            btn.closest(".row").remove();
                        });
                    });
                }
            @endif
        });
    </script>

    {{-- Script untuk modal TikTok --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tiktokAddLinkBtn = document.querySelector("#addPofileTiktokModal #add-link-btn");
            const tiktokLinksContainer = document.querySelector("#addPofileTiktokModal #links-container");
            let tiktokLinkIndex = tiktokLinksContainer ? tiktokLinksContainer.querySelectorAll(".row").length : 0;

            @if (!$profileTiktok)
                if (tiktokAddLinkBtn && tiktokLinksContainer) {
                    tiktokAddLinkBtn.addEventListener("click", function(e) {
                        e.preventDefault();
                        tiktokLinkIndex++;
                        const linkGroup = document.createElement("div");
                        linkGroup.className = "mb-2 row align-items-center";
                        linkGroup.innerHTML = `
                        <div class="col-md-5">
                            <input class="form-control mb-1" name="links[${tiktokLinkIndex}][url]" placeholder="URL" required>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control mb-1" name="links[${tiktokLinkIndex}][name]" placeholder="Nama Link" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm remove-link-btn" title="Hapus Link">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                        tiktokLinksContainer.appendChild(linkGroup);
                        linkGroup.querySelector(".remove-link-btn").addEventListener("click", function() {
                            tiktokLinksContainer.removeChild(linkGroup);
                        });
                    });

                    tiktokLinksContainer.querySelectorAll(".remove-link-btn").forEach(function(btn) {
                        btn.addEventListener("click", function() {
                            btn.closest(".row").remove();
                        });
                    });
                }
            @endif
        });
    </script>

    <script>
        document.querySelectorAll('.add-link-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const container = document.querySelector(this.dataset.target);
                const index = container.children.length;
                const html = `
                <div class="mb-2 row align-items-center">
                    <div class="col-md-5">
                        <input class="form-control mb-1" name="links[${index}][url]" placeholder="URL" required>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control mb-1" name="links[${index}][name]" placeholder="Nama Link" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger btn-sm remove-link-btn"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            `;
                container.insertAdjacentHTML('beforeend', html);
            });
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-link-btn')) {
                e.target.closest('.row').remove();
            }
        });
    </script>

    <script>
        function showInstagram() {
            document.getElementById('instagramSection').style.display = 'block';
            document.getElementById('tiktokSection').style.display = 'none';

            document.getElementById('btnInstagram').classList.add('active');
            document.getElementById('btnTiktok').classList.remove('active');

            // Reset tab to Post
            setActiveTab('instagram', 'post');
        }

        function showTiktok() {
            document.getElementById('instagramSection').style.display = 'none';
            document.getElementById('tiktokSection').style.display = 'block';

            document.getElementById('btnInstagram').classList.remove('active');
            document.getElementById('btnTiktok').classList.add('active');

            // Reset tab to Videos
            setActiveTab('tiktok', 'videos');
        }

        function switchTab(event, tabId) {
            const isInstagram = tabId.startsWith('instagram');
            const prefix = isInstagram ? 'instagram' : 'tiktok';

            // Nonaktifkan semua tab dan kontennya
            document.querySelectorAll(`#${prefix}Section .tab-item`).forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll(`#${prefix}Section .tab-pane`).forEach(pane => {
                pane.classList.remove('active');
            });

            // Aktifkan tab yang diklik
            event.currentTarget.classList.add('active');
            document.getElementById(tabId)?.classList.add('active');
        }

        function setActiveTab(prefix, name) {
            const tabItems = document.querySelectorAll(`#${prefix}Section .tab-item`);
            const tabPanes = document.querySelectorAll(`#${prefix}Section .tab-pane`);

            tabItems.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            const targetBtn = Array.from(tabItems).find(btn => btn.getAttribute('onclick')?.includes(`${prefix}-${name}`));
            const targetPane = document.getElementById(`${prefix}-${name}`);

            if (targetBtn) targetBtn.classList.add('active');
            if (targetPane) targetPane.classList.add('active');
        }
    </script>
    <script>
        let isMobile = false;
        let ps;

        function toggleView() {
            const wrapper = document.getElementById('profileWrapper');
            const text = document.getElementById('btnText');

            if (!isMobile) {
                wrapper.classList.add('mobile-view');
                document.body.classList.add('no-scroll');
                document.documentElement.classList.add('no-scroll');

                // Init PerfectScrollbar
                if (ps) ps.destroy();
                ps = new PerfectScrollbar('#profileWrapper');
                text.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-display" viewBox="0 0 16 16">
                    <path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4q0 1 .25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75Q6 13 6 12H2s-2 0-2-2zm1.398-.855a.76.76 0 0 0-.254.302A1.5 1.5 0 0 0 1 4.01V10c0 .325.078.502.145.602q.105.156.302.254a1.5 1.5 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.76.76 0 0 0 .254-.302 1.5 1.5 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.76.76 0 0 0-.302-.254A1.5 1.5 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145"/>
                </svg>
            `;

                isMobile = true;
            } else {
                wrapper.classList.remove('mobile-view');
                document.body.classList.remove('no-scroll');
                document.documentElement.classList.remove('no-scroll');

                // Destroy PerfectScrollbar
                if (ps) ps.destroy();

                text.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-phone" viewBox="0 0 16 16">
                        <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                    </svg>
                    `;
                isMobile = false;
            }
        }

        function switchTab(evt, tabId) {
            const container = document.querySelector('.tab-content');
            const panes = container.querySelectorAll('.tab-pane');
            const tabs = document.querySelectorAll('.tab-item');

            tabs.forEach(tab => tab.classList.remove('active'));
            panes.forEach(pane => pane.classList.remove('active'));

            evt.target.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }
    </script>

    {{-- <script>
        function toggleView() {
            const wrapper = document.getElementById('profileWrapper');
            const text = document.getElementById('btnText');
            const body = document.body;

            if (!isMobile) {
                wrapper.classList.add('mobile-view');
                body.classList.add('no-scroll');
                text.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-display" viewBox="0 0 16 16">
                <path d="..." />
            </svg>
        `;
                isMobile = true;
            } else {
                wrapper.classList.remove('mobile-view');
                body.classList.remove('no-scroll');
                text.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-phone" viewBox="0 0 16 16">
                <path d="..." />
            </svg>
        `;
                isMobile = false;
            }
        }

        function switchTab(evt, tabId) {
            const container = document.querySelector('.tab-content');
            const panes = container.querySelectorAll('.tab-pane');
            const tabs = document.querySelectorAll('.tab-item');

            tabs.forEach(tab => tab.classList.remove('active'));
            panes.forEach(pane => pane.classList.remove('active'));

            evt.target.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }
    </script> --}}


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function initLinkHandler(addBtnId, containerId) {
                const addBtn = document.getElementById(addBtnId);
                const container = document.getElementById(containerId);

                if (!addBtn || !container) return;

                let linkIndex = container.querySelectorAll('.row').length;

                addBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    linkIndex++;

                    const group = document.createElement("div");
                    group.className = "mb-2 row align-items-center";
                    group.innerHTML = `
                    <div class="col-md-5">
                        <input class="form-control mb-1" name="links[${linkIndex}][url]" placeholder="URL" required>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control mb-1" name="links[${linkIndex}][name]" placeholder="Nama Link" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger btn-sm remove-link-btn"><i class="fas fa-trash"></i></button>
                    </div>
                `;
                    container.appendChild(group);

                    group.querySelector(".remove-link-btn").addEventListener("click", function() {
                        group.remove();
                    });
                });

                container.querySelectorAll('.remove-link-btn').forEach(function(btn) {
                    btn.addEventListener("click", function() {
                        btn.closest('.row').remove();
                    });
                });
            }

            initLinkHandler("add-link-btn-modal", "links-container-modal");
            initLinkHandler("add-link-btn-modal-tiktok", "links-container-modal-tiktok");
        });
    </script>
    <script>
        function deletePost(postId) {
            if (confirm('Apakah Anda yakin ingin menghapus post ini?')) {
                fetch(`/divisi-sa/{{ $client->id }}/instagram/${postId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert(data.message || 'Terjadi kesalahan saat menghapus post');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus post');
                    });
            }
        }

        function deletePostTiktok(postId) {
            if (confirm('Apakah Anda yakin ingin menghapus post ini?')) {
                fetch(`/divisi-sa/{{ $client->id }}/tiktok/${postId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert(data.message || 'Terjadi kesalahan saat menghapus post');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus post');
                    });
            }
        }
    </script>
