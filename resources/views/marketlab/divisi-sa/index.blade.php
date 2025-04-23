<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Modal Add Post -->
            <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPostModalLabel">Tambah Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-marketing" action="{{ route('divisi-sa.store', ['client_id' => $client_id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="created_at" class="form-label">Caption</label>
                                        <textarea class="form-control" name="caption" id="caption" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="created_at" class="form-label">Tanggal Upload</label>
                                        <input type="date" class="form-control" name="created_at" id="created_at"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Upload Gambar / Video</label>
                                        <input type="file" class="form-control" name="content[]" id="content" required multiple accept=".webp, .webm">
                                        <button type="button" class="btn btn-primary" id="add-file-btn">Add Gambar</button>
                                    </div>
                                    <div id="preview-container" class="row mt-3"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- End Modal Add Post -->

            <div class="profile-container">
                <div class="profile-header">
                    <img src="" class="profile-pic">
                    <div class="profile-info">
                        <div class="top-info">
                            <h2>{{$client->nama_brand}}</h2>
                            <div class="ms-auto d-flex">
                                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                    data-toggle="modal" data-target="#addPostModal">
                                    <span class="btn-inner--icon">
                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                            <path
                                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                        </svg>
                                    </span>
                                    <span class="btn-inner--text">Add Post</span>
                                </a>
                            </div>
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="stats">
                            <span><strong>testtt</strong> posts</span>
                            <span><strong>testtt</strong> followers</span>
                            <span><strong>testtt</strong> following</span>
                        </div>
                        <div class="real-name">{{$client->nama_client}}</div>
                    </div>
                </div>

                <div class="tabs">
                    <a href="#" class="active"><i class="fas fa-th"></i> POSTS</a>
                    <a href="#"><i class="far fa-bookmark"></i> SAVED</a>
                    <a href="#"><i class="far fa-user"></i> TAGGED</a>
                </div>

                <div class="gallery">
                    @foreach ($social_media as $media)
                        @foreach ($media->content as $file)
                            <div class="gallery-item">
                                <a href="{{ asset('storage/post' . $file) }}" target="_blank">
                                    @if (Str::endsWith($file, ['.webp']))
                                        <img src="{{ asset('storage/' . $file) }}" alt="Gambar" class="img-fluid">
                                    @elseif (Str::endsWith($file, ['.webm']))
                                        <video src="{{ asset('storage/' . $file) }}" controls class="img-fluid"></video>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('content');
            const previewContainer = document.getElementById('preview-container');
            const addFileBtn = document.getElementById('add-file-btn');

            let selectedFiles = [];

            addFileBtn.addEventListener('click', function () {
                input.click();
            });

            input.addEventListener('change', function (event) {
                const newFiles = Array.from(event.target.files);

                // Hindari duplikat berdasarkan nama dan ukuran
                newFiles.forEach(newFile => {
                    const isDuplicate = selectedFiles.some(existingFile =>
                        existingFile.name === newFile.name && existingFile.size === newFile.size
                    );
                    if (!isDuplicate) {
                        selectedFiles.push(newFile);
                    }
                });

                renderPreview();
                updateInputFiles();
                input.value = ''; // agar bisa upload file yang sama lagi
            });

            function renderPreview() {
                previewContainer.innerHTML = '';

                selectedFiles.forEach((file, index) => {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-3 position-relative';

                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = '×';
                    removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                    removeBtn.addEventListener('click', function () {
                        selectedFiles.splice(index, 1);
                        renderPreview();
                        updateInputFiles();
                    });

                    let preview;
                    if (file.type.startsWith('image/')) {
                        preview = document.createElement('img');
                        preview.src = URL.createObjectURL(file);
                        preview.className = 'img-fluid rounded';
                    } else if (file.type.startsWith('video/')) {
                        preview = document.createElement('video');
                        preview.src = URL.createObjectURL(file);
                        preview.controls = true;
                        preview.className = 'img-fluid rounded';
                    }

                    col.appendChild(removeBtn);
                    col.appendChild(preview);
                    previewContainer.appendChild(col);
                });
            }

            function updateInputFiles() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
            }
        });
    </script>    
</x-app-layout>
