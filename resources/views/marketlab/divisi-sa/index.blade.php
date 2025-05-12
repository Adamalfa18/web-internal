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
                        <form class="form-marketing"
                            action="{{ route('divisi-sa.store', ['client_id' => $client_id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select name="category" id="category">
                                            <option value="post">Post</option>
                                            <option value="reel">Reel</option>
                                            <option value="story">Story</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="caption" class="form-label">Caption</label>
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
                                        <input type="file" class="form-control d-none" id="content_media"
                                            name="content_media[]" accept=".webp, .webm" multiple>
                                        <button type="button" class="btn btn-primary" id="add-file-btn">Add
                                            Gambar</button>
                                        <input type="file" class="form-control d-none" id="cover" name="cover"
                                            accept=".webp">
                                        <button type="button" class="btn btn-primary" id="add-cover-btn">Set
                                            Cover</button>
                                    </div>
                                    <div id="preview-container" class="row mt-3"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal Add Post -->

            <div class="d-flex gap-2 mb-3">
                <button id="btnInstagram" class="btn btn-sm btn-outline-primary active d-flex align-items-center gap-2"
                    onclick="showInstagram()">
                    <i class="fas fa-instagram"></i> Lihat Instagram
                </button>
                <button id="btnTiktok" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"
                    onclick="showTiktok()">
                    <i class="fab fa-tiktok"></i> Lihat Tiktok
                </button>
                <button class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2"
                    onclick="toggleMobileView()">
                    <i class="fas fa-mobile-alt"></i> Lihat Mode Mobile
                </button>
            </div>

            <!-- Instagram Page -->
            <div class="instagram-page">
                <div id="instagramProfileWrapper" class="desktop-view">
                    <div class="profile-container">
                        <div class="profile-header">
                            <div class="profile-info">
                                <div class="row top-info">
                                    <div class="col-md-3 style-ig">
                                        <img src="{{ asset('storage/' . $client->gambar_client) }}" class="profile-pic">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="style-clien-header">
                                            <div class="nama-brand">
                                                <h2>{{ $client->nama_brand }}</h2>
                                            </div>
                                            <div class="style-button-ig">
                                                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                                    data-toggle="modal" data-target="#addPostModal">
                                                    <span class="btn-inner--icon">
                                                        <svg width="16" height="16"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="d-block me-2">
                                                            <path
                                                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                        </svg>
                                                    </span>
                                                    <span class="btn-inner--text">Add Post</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="stats">
                                            <span><strong>Post</strong> {{ $posts->where('category', 'post')->count() }} </span>
                                            <span><strong>Reel</strong> {{ $posts->where('category', 'reel')->count() }} </span>
                                            <span><strong>Story</strong> {{ $posts->where('category', 'story')->count() }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs Navigation -->
                        <div class="tabs">
                            <button class="tab-item active" onclick="switchTab(event, 'instagram-post')">Post</button>
                            <button class="tab-item" onclick="switchTab(event, 'instagram-reel')">Reel</button>
                            <button class="tab-item" onclick="switchTab(event, 'instagram-story')">Story</button>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div id="instagram-post" class="tab-pane active">
                                <div class="gallery">
                                    @foreach ($posts->where('category', 'post') as $post)
                                        @php
                                            $firstMedia = $post_medias->firstWhere('post_id', $post->id);
                                        @endphp
                                        <div class="gallery-item">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#mediaModal{{ $post->id }}">
                                                @if ($post->cover)
                                                    @if (Str::endsWith($post->cover, '.webp'))
                                                        <img src="{{ asset('storage/cover/' . $post->cover) }}"
                                                            alt="Cover Image" class="img-fluid">
                                                    @elseif (Str::endsWith($post->cover, '.webm'))
                                                        <video width="100%" controls>
                                                            <source src="{{ asset('storage/cover/' . $post->cover) }}"
                                                                type="video/webm">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                @elseif ($firstMedia)
                                                    @if (Str::endsWith($firstMedia->post, '.webp'))
                                                        <img src="{{ asset('storage/media/' . $firstMedia->post) }}"
                                                            alt="Social Media" class="img-fluid">
                                                    @elseif (Str::endsWith($firstMedia->post, '.webm'))
                                                        <video width="100%" controls>
                                                            <source
                                                                src="{{ asset('storage/media/' . $firstMedia->post) }}"
                                                                type="video/webm">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div id="instagram-reel" class="tab-pane">
                                <div class="gallery">
                                    @foreach ($posts->where('category', 'reel') as $post)
                                        @php
                                            $firstMedia = $post_medias->firstWhere('post_id', $post->id);
                                        @endphp
                                        <div class="gallery-item">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#mediaModal{{ $post->id }}">
                                                @if ($post->cover)
                                                    @if (Str::endsWith($post->cover, '.webp'))
                                                        <img src="{{ asset('storage/cover/' . $post->cover) }}"
                                                            alt="Cover Image" class="img-fluid">
                                                    @elseif (Str::endsWith($post->cover, '.webm'))
                                                        <video width="100%" controls>
                                                            <source src="{{ asset('storage/cover/' . $post->cover) }}"
                                                                type="video/webm">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                @elseif ($firstMedia)
                                                    @if (Str::endsWith($firstMedia->post, '.webp'))
                                                        <img src="{{ asset('storage/media/' . $firstMedia->post) }}"
                                                            alt="Social Media" class="img-fluid">
                                                    @elseif (Str::endsWith($firstMedia->post, '.webm'))
                                                        <video width="100%" controls>
                                                            <source
                                                                src="{{ asset('storage/media/' . $firstMedia->post) }}"
                                                                type="video/webm">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div id="instagram-story" class="tab-pane">
                                <div class="gallery">
                                    @foreach ($posts->where('category', 'story') as $post)
                                        @php
                                            $firstMedia = $post_medias->firstWhere('post_id', $post->id);
                                        @endphp
                                        <div class="gallery-item">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#mediaModal{{ $post->id }}">
                                                @if ($post->cover)
                                                    @if (Str::endsWith($post->cover, '.webp'))
                                                        <img src="{{ asset('storage/cover/' . $post->cover) }}"
                                                            alt="Cover Image" class="img-fluid">
                                                    @elseif (Str::endsWith($post->cover, '.webm'))
                                                        <video width="100%" controls>
                                                            <source src="{{ asset('storage/cover/' . $post->cover) }}"
                                                                type="video/webm">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                @elseif ($firstMedia)
                                                    @if (Str::endsWith($firstMedia->post, '.webp'))
                                                        <img src="{{ asset('storage/media/' . $firstMedia->post) }}"
                                                            alt="Social Media" class="img-fluid">
                                                    @elseif (Str::endsWith($firstMedia->post, '.webm'))
                                                        <video width="100%" controls>
                                                            <source
                                                                src="{{ asset('storage/media/' . $firstMedia->post) }}"
                                                                type="video/webm">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="addTiktokModal" tabindex="-1" role="dialog"
                aria-labelledby="addTiktokModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTiktokModalLabel">Tambah Post Tiktok</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-marketing"
                            action="{{ route('divisi-sa.store', ['client_id' => $client_id]) }}" method="POST"
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
                                        <input type="file" class="form-control d-none" id="content_media"
                                            name="content_media[]" accept=".webp, .webm" multiple>
                                        <button type="button" class="btn btn-primary" id="add-file-btn">Add
                                            Gambar</button>
                                        <input type="file" class="form-control d-none" id="cover"
                                            name="cover" accept=".webp">
                                        <button type="button" class="btn btn-primary" id="add-cover-btn">Set
                                            Cover</button>
                                    </div>
                                    <div id="preview-container" class="row mt-3"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- TikTok Page (Sembunyikan Awal) -->
            <div class="tiktok-page" style="display: none;">
                <div id="tiktokProfileWrapper" class="desktop-view">
                    <div class="profile-container">
                        <div class="profile-header">
                            <div class="profile-info">
                                <div class="row top-info">
                                    <div class="col-md-3 style-ig">
                                        <img src="{{ asset('storage/' . $client->gambar_client) }}"
                                            class="profile-pic">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="style-clien-header">
                                            <div class="nama-brand">
                                                <h2>{{ $client->nama_brand }} (TikTok)</h2>
                                            </div>
                                            <div class="style-button-ig">
                                                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                                    data-toggle="modal" data-target="#addTiktokModal">
                                                    <span class="btn-inner--icon">
                                                        <svg width="16" height="16"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="d-block me-2">
                                                            <path
                                                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                        </svg>
                                                    </span>
                                                    <span class="btn-inner--text">Add Video</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="stats">
                                            <span><strong>Followers</strong> 1.2M </span>
                                            <span><strong>Following</strong> 120 </span>
                                            <span><strong>Likes</strong> 5.7M </span>
                                        </div>
                                        <div class="reel-name">{{ $client->nama_client }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs Navigation -->
                        <div class="tabs">
                            <button class="tab-item active"
                                onclick="switchTab(event, 'tiktok-videos')">Videos</button>
                            <button class="tab-item" onclick="switchTab(event, 'tiktok-liked')">Liked</button>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div id="tiktok-videos" class="tab-pane active">
                                <div class="gallery">
                                    @for ($i = 1; $i <= 6; $i++)
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#mediaTiktokModal">
                                            <div class="gallery-item">
                                                <video width="100%" controls>
                                                    <source
                                                        src="https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </a>
                                    @endfor
                                </div>
                            </div>

                            <div id="tiktok-liked" class="tab-pane">
                                <div class="gallery">
                                    @for ($i = 1; $i <= 6; $i++)
                                        <div class="gallery-item">
                                            <video width="100%" controls>
                                                <source
                                                    src="https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4"
                                                    type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal per Post *Instagram  --}}
            @foreach ($posts as $post)
                <div class="modal fade" id="mediaModal{{ $post->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="mediaModalLabel{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
                        <div class="modal-content">

                            <div class="row form-marketing" enctype="multipart/form-data">
                                <div class="col-lg-6">
                                    {{-- Carousel Dinamis --}}
                                    @if ($post->media->count())
                                        <div id="carouselIndicators{{ $post->id }}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($post->media as $key => $media)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        @if (in_array(pathinfo($media->post, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
                                                            <video class="d-block w-100" controls>
                                                                <source
                                                                    src="{{ asset('storage/media/' . $media->post) }}"
                                                                    type="video/mp4">
                                                            </video>
                                                        @else
                                                            <img src="{{ asset('storage/media/' . $media->post) }}"
                                                                class="d-block w-100" alt="Post Media">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if ($post->media->count() > 1)
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselIndicators{{ $post->id }}"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselIndicators{{ $post->id }}"
                                                    data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-6">
                                    <form>

                                        <div class="form-group">
                                            <label>Tanggal Upload</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $post->created_at->format('d-m-Y') }}</textarea>
                                        </div>                                        

                                        {{-- Captin --}}
                                        <div class="form-group">
                                            <label>Caption</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $post->caption }}</textarea>
                                        </div>

                                        {{-- Notes --}}
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $post->note }}</textarea>
                                        </div>

                                        {{-- Status --}}
                                        @php
                                            // ambil media pertama dari post ini (kalau kamu dalam @foreach $posts)
                                            $firstMedia = $post_medias->firstWhere('post_id', $post->id);
                                        @endphp

                                        @if ($firstMedia && $firstMedia->postingan)
                                            <div class="form-group">
                                                <label>Status:</label>
                                                @if ($firstMedia->postingan->status == 0)
                                                    <span class="badge badge-secondary">Menunggu Persetujuan</span>
                                                @elseif ($firstMedia->postingan->status == 1)
                                                    <span class="badge badge-success ">Disetujui</span>
                                                @elseif ($firstMedia->postingan->status == 2)
                                                    <span class="badge badge-danger">Perlu Revisi</span>
                                                @else
                                                    <span class="badge badge-secondary">Status Tidak
                                                        Diketahui</span>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#editSAModal{{ $post->id }}">
                                                Edit Post
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit SA -->
                <div class="modal fade modal-edit-sa-style" id="editSAModal{{ $post->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="editSAModalLabel{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-marketing" id="edit-form-{{ $post->id }}" method="POST"
                                action="{{ route('divisi-sa.update', ['client_id' => $post->client_id, 'post_id' => $post->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $post->id }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSAModalLabel{{ $post->id }}">Edit Post
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    {{-- Caption --}}
                                    <div class="mb-3">
                                        <label for="caption{{ $post->id }}" class="form-label">Caption</label>
                                        <textarea class="form-control" name="caption" id="caption{{ $post->id }}" required>{{ $post->caption }}</textarea>
                                    </div>
                                    {{-- Tanggal Upload --}}
                                    <div class="mb-3">
                                        <label for="created_at{{ $post->id }}" class="form-label">Tanggal
                                            Upload</label>
                                        <input type="date" class="form-control" name="created_at"
                                            id="created_at{{ $post->id }}"
                                            value="{{ $post->created_at->format('Y-m-d') }}" required>
                                    </div>
                                    {{-- Upload Media --}}
                                    <div class="mb-3">
                                        <label for="edit_content_media{{ $post->id }}" class="form-label">Gambar
                                            / Video yang Ada</label>
                                        <div class="row mt-3" id="edit-preview-container-{{ $post->id }}">
                                            @foreach ($post->media as $key => $media)
                                                <div class="col-md-4 mb-2 position-relative preview-item">
                                                    <input type="hidden" name="existing_media_ids[]"
                                                        value="{{ $media->id }}">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-media"
                                                        data-media-id="{{ $media->id }}">
                                                        &times;
                                                    </button>
                                                    @if (in_array(pathinfo($media->post, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
                                                        <video class="w-100" controls>
                                                            <source src="{{ asset('storage/media/' . $media->post) }}"
                                                                type="video/mp4">
                                                            Browser tidak mendukung video.
                                                        </video>
                                                    @else
                                                        <img src="{{ asset('storage/media/' . $media->post) }}"
                                                            class="img-fluid rounded" alt="Media Post">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mt-2">
                                            <input type="file" class="form-control d-none edit-file-input"
                                                id="edit_content_media{{ $post->id }}"
                                                data-id="{{ $post->id }}" name="content_media[]"
                                                accept=".webp, .webm" multiple>
                                            <button type="button" class="btn btn-primary edit-add-file-btn"
                                                data-id="{{ $post->id }}">
                                                Add Gambar
                                            </button>
                                        </div>
                                        <div class="row mt-2 edit-preview-container"
                                            id="edit-preview-container-{{ $post->id }}"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Edit SA -->
            @endforeach
            {{-- End modal Media Instagram --}}

            {{-- Modal per Post *Tiktok  --}}
            @foreach ($posts as $post)
                <div class="modal fade" id="mediaModal{{ $post->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="mediaModalLabel{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
                        <div class="modal-content">

                            <div class="row form-marketing" enctype="multipart/form-data">
                                <div class="col-lg-6">
                                    {{-- Carousel Dinamis --}}
                                    @if ($post->media->count())
                                        <div id="carouselIndicators{{ $post->id }}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($post->media as $key => $media)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        @if (in_array(pathinfo($media->post, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
                                                            <video class="d-block w-100" controls>
                                                                <source
                                                                    src="{{ asset('storage/media/' . $media->post) }}"
                                                                    type="video/mp4">
                                                            </video>
                                                        @else
                                                            <img src="{{ asset('storage/media/' . $media->post) }}"
                                                                class="d-block w-100" alt="Post Media">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if ($post->media->count() > 1)
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselIndicators{{ $post->id }}"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselIndicators{{ $post->id }}"
                                                    data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-6">
                                    <form>
                                        {{-- Captin --}}
                                        <div class="form-group">
                                            <label>Caption</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $post->caption }}</textarea>
                                        </div>

                                        {{-- Notes --}}
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $post->note }}</textarea>
                                        </div>

                                        {{-- Status --}}
                                        @php
                                            // ambil media pertama dari post ini (kalau kamu dalam @foreach $posts)
                                            $firstMedia = $post_medias->firstWhere('post_id', $post->id);
                                        @endphp

                                        @if ($firstMedia && $firstMedia->postingan)
                                            <div class="form-group">
                                                <label>Status:</label>
                                                @if ($firstMedia->postingan->status == 0)
                                                    <span class="badge badge-secondary">Menunggu Persetujuan</span>
                                                @elseif ($firstMedia->postingan->status == 1)
                                                    <span class="badge badge-success ">Disetujui</span>
                                                @elseif ($firstMedia->postingan->status == 2)
                                                    <span class="badge badge-danger">Perlu Revisi</span>
                                                @else
                                                    <span class="badge badge-secondary">Status Tidak
                                                        Diketahui</span>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#editSAModal{{ $post->id }}">
                                                Edit Post
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit SA -->
                <div class="modal fade modal-edit-sa-style" id="editSAModal{{ $post->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="editSAModalLabel{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-marketing" id="edit-form-{{ $post->id }}" method="POST"
                                action="{{ route('divisi-sa.update', ['client_id' => $post->client_id, 'post_id' => $post->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $post->id }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSAModalLabel{{ $post->id }}">Edit Post
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{-- Caption --}}
                                    <div class="mb-3">
                                        <label for="caption{{ $post->id }}" class="form-label">Caption</label>
                                        <textarea class="form-control" name="caption" id="caption{{ $post->id }}" required>{{ $post->caption }}</textarea>
                                    </div>
                                    {{-- Tanggal Upload --}}
                                    <div class="mb-3">
                                        <label for="created_at{{ $post->id }}" class="form-label">Tanggal
                                            Upload</label>
                                        <input type="date" class="form-control" name="created_at"
                                            id="created_at{{ $post->id }}"
                                            value="{{ $post->created_at->format('Y-m-d') }}" required>
                                    </div>
                                    {{-- Upload Media --}}
                                    <div class="mb-3">
                                        <label for="edit_content_media{{ $post->id }}" class="form-label">Gambar
                                            / Video yang Ada</label>
                                        <div class="row mt-3" id="edit-preview-container-{{ $post->id }}">
                                            @foreach ($post->media as $key => $media)
                                                <div class="col-md-4 mb-2 position-relative preview-item">
                                                    <input type="hidden" name="existing_media_ids[]"
                                                        value="{{ $media->id }}">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-media"
                                                        data-media-id="{{ $media->id }}">
                                                        &times;
                                                    </button>
                                                    @if (in_array(pathinfo($media->post, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
                                                        <video class="w-100" controls>
                                                            <source src="{{ asset('storage/media/' . $media->post) }}"
                                                                type="video/mp4">
                                                            Browser tidak mendukung video.
                                                        </video>
                                                    @else
                                                        <img src="{{ asset('storage/media/' . $media->post) }}"
                                                            class="img-fluid rounded" alt="Media Post">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mt-2">
                                            <input type="file" class="form-control d-none edit-file-input"
                                                id="edit_content_media{{ $post->id }}"
                                                data-id="{{ $post->id }}" name="content_media[]"
                                                accept=".webp, .webm" multiple>
                                            <button type="button" class="btn btn-primary edit-add-file-btn"
                                                data-id="{{ $post->id }}">
                                                Add Gambar
                                            </button>
                                        </div>
                                        <div class="row mt-2 edit-preview-container"
                                            id="edit-preview-container-{{ $post->id }}"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Edit SA -->
            @endforeach
            {{-- End modal Media Instagram --}}
        </div>
    </main>

    <!-- Script untuk switch tab -->
    <script>
        function switchTab(evt, tabId) {
            // Dapatkan semua tab content dan sembunyikan
            const tabContents = document.querySelectorAll('.tab-pane');
            tabContents.forEach(content => {
                content.classList.remove('active');
            });

            // Dapatkan semua tab buttons dan hapus active class
            const tabButtons = document.querySelectorAll('.tab-item');
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });

            // Tampilkan tab yang dipilih dan aktifkan button
            document.getElementById(tabId).classList.add('active');
            evt.currentTarget.classList.add('active');
        }

        function showInstagram() {
            document.querySelector('.instagram-page').style.display = 'block';
            document.querySelector('.tiktok-page').style.display = 'none';

            // Update button states
            document.getElementById('btnInstagram').classList.add('active');
            document.getElementById('btnTiktok').classList.remove('active');
        }

        function showTiktok() {
            document.querySelector('.tiktok-page').style.display = 'block';
            document.querySelector('.instagram-page').style.display = 'none';

            // Update button states
            document.getElementById('btnTiktok').classList.add('active');
            document.getElementById('btnInstagram').classList.remove('active');
        }

        // Inisialisasi tampilan awal
        document.addEventListener('DOMContentLoaded', function() {
            showInstagram(); // Tampilkan Instagram secara default
        });
    </script>
</x-app-layout>
