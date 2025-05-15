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
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                    <i class="fas fa-instagram"></i>Instagram
                </button>
                <button id="btnTiktok" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"
                    onclick="showTiktok()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                    </svg>
                    <i class="fab fa-tiktok"></i>TikTok
                </button>
                <button class="btn btn-style-sa" onclick="toggleView()">
                    <i class="fas fa-mobile-alt"></i> <span id="btnText">Lihat Mode Mobile</span>
                </button>
            </div>

            <div class="style-button-ig d-flex justify-content-end">
                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                    data-toggle="modal" data-target="#editProfileModal">
                    <span class="btn-inner--icon">
                    </span>
                    <span class="btn-inner--text">Edit Profile</span>
                </a>
            </div>

            <div id="profileWrapper" class="">
                <!-- Instagram Page -->
                <div class="instagram-page" id="instagramSection" style="display: block;">
                    <div id="instagramProfileWrapper" class="desktop-view">
                <div class="profile-container">
                    <div class="profile-header">
                        <div class="profile-info">
                            <div class="row top-info">
                                <div class="col-md-3 style-ig">
                                    <img src="{{ asset('storage/' . $client->gambar_client) }}"
                                    class="profile-pic"
                                    id="profileStoryTrigger"
                                    style="cursor:pointer"
                                    data-toggle="modal"
                                    data-target="#storyModal">
                                </div>
                                <div class="col-md-9">
                                    <div class="style-clien-header">
                                        <div class="nama-brand">
                                            <h2>{{ $profile->username ?? $client->nama_brand }}</h2>
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
                                            @if($profile)
                                                <div class="stats">
                                                    <span><strong>Post</strong>
                                                        {{ $posts->where('category', 'post')->count() }}
                                                    </span>
                                                    <span><strong>Followers</strong> {{ $profile->followers }}</span>
                                                    <span><strong>Following</strong> {{ $profile->following }}</span>
                                                </div>
                                                {{-- <div class="stats">
                                                    
                                                    <span><strong>Reel</strong>
                                                        {{ $posts->where('category', 'reel')->count() }}
                                                    </span>
                                                    <span><strong>Story</strong>
                                                        {{ $posts->where('category', 'story')->count() }} </span>
                                                </div> --}}
                                                <div class="name_ig">
                                                    <span><strong>{{ $profile->name }}</strong></span>
                                                </div>
                                                <div class="bio">
                                                    <span>{{ $profile->bio }}</span>
                                                </div>
                                                <div class="link">
                                                    @foreach($profile->links as $link)
                                                        <a href="{{ $link->url }}" target="_blank">{{ $link->name }}</a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-danger">Profile belum diisi.</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabs Navigation -->
                            <div class="tabs">
                                <button class="tab-item active"
                                    onclick="switchTab(event, 'instagram-post')">Post</button>
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
                                                                <source
                                                                    src="{{ asset('storage/cover/' . $post->cover) }}"
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
                                                                <source
                                                                    src="{{ asset('storage/cover/' . $post->cover) }}"
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
                                                                <source
                                                                    src="{{ asset('storage/cover/' . $post->cover) }}"
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
                <!-- TikTok Page (Sembunyikan Awal) -->
                <div class="tiktok-page" style="display: none;" id="tiktokSection">
                    <div id="tiktokProfileWrapper" class="desktop-view">
                        <div class="profile-container">
                            <div class="profile-header">
                                <div class="profile-info">
                                    <div class="row style-tiktok-sa">
                                        <div class="col-md-3 style-ig">
                                            <img src="{{ asset('storage/' . $client->gambar_client) }}"
                                                class="profile-pic">
                                        </div>
                                        <div class="col-md-9 style-tiktok-sa">
                                            <div class="style-clien-header">
                                                <div class="nama-brand">
                                                    <h2>{{ $client->nama_brand }}</h2>
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
                                                <span><strong>Likes</strong> 5.7M </span>
                                            </div>
                                            <div class="bio">
                                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                                    Ducimus expedita reprehenderit eum ad quisquam ullam doloremque 
                                                    minima nam officia beatae? Nemo perspiciatis vel, alias accusamus 
                                                    fuga repellat voluptatem vero quia?
                                                </span>
                                            </div>
                                            <div class="link">
                                                <a href="">link.com/links</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabs Navigation -->
                    <div class="tabs">
                                <button class="tab-item active"
                                    onclick="switchTab(event, 'tiktok-videos')">Videos</button>
                    </div>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div id="tiktok-videos" class="tab-pane active">
                    <div class="gallery">
                                        @foreach ($tiktok as $tkpost)
                            @php
                                                $firstMedia = $tkpost->tiktok_media->first();
                            @endphp
                                <div class="gallery-item">
                                    <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#tiktokmediaModal{{ $tkpost->id }}">
                                                    @if ($tkpost->cover)
                                                        @if (Str::endsWith($tkpost->cover, '.webp'))
                                                            <img src="{{ asset('storage/cover_tiktok/' . $tkpost->cover) }}"
                                                                alt="Cover Image" class="img-fluid">
                                                        @elseif (Str::endsWith($tkpost->cover, '.webm'))
                                                            <video width="100%" controls>
                                                                <source
                                                                    src="{{ asset('storage/cover/' . $tkpost->cover) }}"
                                                                    type="video/webm">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    @elseif ($firstMedia)
                                                        @php
                                                            $ext = strtolower(pathinfo($firstMedia->media, PATHINFO_EXTENSION));
                                                        @endphp
                                                        @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                                            <video class="w-100" controls>
                                                                <source
                                                                    src="{{ asset('storage/tiktok_media/' . $firstMedia->media) }}"
                                                                    type="video/{{ $ext }}">
                                                                Browser tidak mendukung video.
                                                            </video>
                                                        @else
                                                            <img src="{{ asset('storage/tiktok_media/' . $firstMedia->media) }}"
                                                                class="img-fluid rounded" alt="TikTok Media">
                                                        @endif
                                                    @endif
                                                </a>
                                            </div>
                                        @endforeach
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
            </div>
            {{-- Add Modal Tiktok --}}
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
                        <form class="form-marketing form-marketing-tiktok"
                            action="{{ route('divisi-sa.storeTiktok', ['client_id' => $client_id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
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
                                        <input type="file" class="form-control d-none" id="tiktok_media"
                                            name="tiktok_media[]" accept=".webp, .webm" multiple>
                                        <button type="button" class="btn btn-primary" id="add-file-btn-tiktok">Add
                                            Gambar</button>
                                        <input type="file" class="form-control d-none" id="tiktok_cover"
                                            name="cover" accept=".webp">
                                        <button type="button" class="btn btn-primary" id="add-cover-btn-tiktok">Set
                                            Cover</button>
                                    </div>
                                    <div id="preview-container-tiktok" class="row mt-3"></div>
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
                            <form class="form-marketing form-marketing-edit" id="edit-form-{{ $post->id }}"
                                method="POST"
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
            @foreach ($tiktok as $tkpost)
                <div class="modal fade" id="tiktokmediaModal{{ $tkpost->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="mediaModalLabel{{ $tkpost->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
                        <div class="modal-content">

                            <div class="row form-marketing" enctype="multipart/form-data">
                                <div class="col-lg-6">
                                    {{-- Carousel Dinamis --}}
                                    @if ($tkpost->tiktok_media->count())
                                        <div id="carouselIndicators{{ $tkpost->id }}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($tkpost->tiktok_media as $key => $tiktok_media)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        @php
                                                            $ext = strtolower(pathinfo($tiktok_media->media, PATHINFO_EXTENSION));
                                                        @endphp
                                                        @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                                            <video class="d-block w-100" controls>
                                                                <source
                                                                    src="{{ asset('storage/tiktok_media/' . $tiktok_media->media) }}"
                                                                    type="video/{{ $ext }}">
                                                            </video>
                                                        @else
                                                            <img src="{{ asset('storage/tiktok_media/' . $tiktok_media->media) }}"
                                                                class="d-block w-100" alt="Post Tiktok Media">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if ($tkpost->tiktok_media->count() > 1)
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselIndicators{{ $tkpost->id }}"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselIndicators{{ $tkpost->id }}"
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
                                        {{-- tanggal upload --}}
                                        <div class="form-group">
                                            <label>Tanggal Upload</label>
                                            <input class="form-control" rows="3" disabled
                                                value="{{ $tkpost->created_at->format('d-m-Y') }}">
                                        </div>
                                        {{-- Captin --}}
                                        <div class="form-group">
                                            <label>Caption</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $tkpost->caption }}</textarea>
                                        </div>

                                        {{-- Notes --}}
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $tkpost->note }}</textarea>
                                        </div>

                                        {{-- Status --}}
                                        @php
                                            // ambil media pertama dari tkpost ini (kalau kamu dalam @foreach $posts)
                                            $firstMedia = $tiktok_medias->firstWhere('post_id', $tkpost->id);
                                        @endphp

                                        @if ($firstMedia && $firstMedia->post_tiktok)
                                            <div class="form-group">
                                                <label>Status:</label>
                                                @if ($firstMedia->post_tiktok->status == 0)
                                                    <span class="badge badge-secondary">Menunggu Persetujuan</span>
                                                @elseif ($firstMedia->post_tiktok->status == 1)
                                                    <span class="badge badge-success ">Disetujui</span>
                                                @elseif ($firstMedia->post_tiktok->status == 2)
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
                                                data-target="#editSATiktokModal{{ $tkpost->id }}">
                                                Edit Post
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit Tiktok SA -->
                <div class="modal fade modal-edit-sa-style" id="editSATiktokModal{{ $tkpost->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="editSATiktokModalLabel{{ $tkpost->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-marketing form-marketing-edit-tiktok" id="edit-form-{{ $tkpost->id }}" method="POST"
                                action="{{ route('divisi-sa.updateTiktok', ['client_id' => $tkpost->client_id, 'post_id' => $tkpost->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $tkpost->id }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSATiktokModalLabel{{ $tkpost->id }}">Edit Post
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{-- Caption --}}
                                    <div class="mb-3">
                                        <label for="caption{{ $tkpost->id }}" class="form-label">Caption</label>
                                        <textarea class="form-control" name="caption" id="caption{{ $tkpost->id }}" required>{{ $tkpost->caption }}</textarea>
                                    </div>
                                    {{-- Tanggal Upload --}}
                                    <div class="mb-3">
                                        <label for="created_at{{ $tkpost->id }}" class="form-label">Tanggal
                                            Upload</label>
                                        <input type="date" class="form-control" name="created_at"
                                            id="created_at{{ $tkpost->id }}"
                                            value="{{ $tkpost->created_at->format('Y-m-d') }}" required>
                                    </div>
                                    {{-- Upload Media --}}
                                    <div class="mb-3">
                                        <label for="edit_content_media_tiktok{{ $tkpost->id }}" class="form-label">Gambar
                                            / Video yang Ada</label>
                                        <div class="row mt-3" id="edit-preview-container-tiktok-{{ $tkpost->id }}">
                                            @foreach ($tkpost->tiktok_media as $key => $tiktok_media)
                                                <div class="col-md-4 mb-2 position-relative preview-item">
                                                    <input type="hidden" name="existing_media_ids[]"
                                                        value="{{ $tiktok_media->id }}">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-media"
                                                        data-media-id="{{ $tiktok_media->id }}">
                                                        &times;
                                                    </button>
                                                    @php
                                                        $ext = strtolower(pathinfo($tiktok_media->media, PATHINFO_EXTENSION));
                                                    @endphp
                                                    @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                                        <video class="w-100" controls>
                                                            <source
                                                                src="{{ asset('storage/tiktok_media/' . $tiktok_media->media) }}"
                                                                type="video/{{ $ext }}">
                                                            Browser tidak mendukung video.
                                                        </video>
                                                    @else
                                                        <img src="{{ asset('storage/tiktok_media/' . $tiktok_media->media) }}"
                                                            class="img-fluid rounded" alt="Media tkpost">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mt-2">
                                            <input type="file" class="form-control d-none edit-file-input-tiktok"
                                                id="edit_content_media_tiktok{{ $tkpost->id }}"
                                                data-id="{{ $tkpost->id }}" name="tiktok_media[]"
                                                accept=".webp, .webm" multiple>
                                            <button type="button" class="btn btn-primary edit-add-file-btn-tiktok"
                                                data-id="{{ $tkpost->id }}">
                                                Add Gambar
                                            </button>
                                        </div>
                                        <div class="row mt-2 edit-preview-container-tiktok"
                                            id="edit-preview-container-tiktok-{{ $tkpost->id }}"></div>
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
                <!-- End Modal Edit Tiktok SA -->
            @endforeach
            {{-- End modal Media Instagram --}}
        </div>
    </main>

    {{-- <script>
        function toggleMobileView() {
            const ig = document.getElementById('instagramSection');
            const tiktok = document.getElementById('tiktokSection');

            if (ig.style.display !== 'none') {
                ig.classList.toggle('mobile-mode');
            } else if (tiktok.style.display !== 'none') {
                tiktok.classList.toggle('mobile-mode');
            }
        }
    </script>
    <script>
        function showInstagram() {
            document.getElementById('instagramSection').style.display = 'block';
            document.getElementById('tiktokSection').style.display = 'none';

            document.getElementById('btnInstagram').classList.add('active');
            document.getElementById('btnTiktok').classList.remove('active');

            // Set tab aktif: Post
            setActiveTab('instagram', 'post');
        }

        function showTiktok() {
            document.getElementById('instagramSection').style.display = 'none';
            document.getElementById('tiktokSection').style.display = 'block';

            document.getElementById('btnInstagram').classList.remove('active');
            document.getElementById('btnTiktok').classList.add('active');

            // Set tab aktif: Videos
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

            // Reset semua tab
            tabItems.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            const targetBtn = Array.from(tabItems).find(btn => btn.getAttribute('onclick')?.includes(`${prefix}-${name}`));
            const targetPane = document.getElementById(`${prefix}-${name}`);

            if (targetBtn) targetBtn.classList.add('active');
            if (targetPane) targetPane.classList.add('active');
        }
    </script> --}}
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

        function toggleView() {
            const wrapper = document.getElementById('profileWrapper');
            const text = document.getElementById('btnText');

            if (!isMobile) {
                wrapper.classList.add('mobile-view');
                text.innerText = "Lihat Versi Desktop";
                isMobile = true;
            } else {
                wrapper.classList.remove('mobile-view');
                text.innerText = "Lihat Mode Mobile";
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

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(!$profile)
                        <div class="alert alert-warning">
                            Profile belum diisi untuk client <strong>{{ $client->nama_brand }}</strong>.
                        </div>
                    @else
                        <form class="form-marketing form-marketing-edit-profile-existing"
                            action="{{ route('divisi-sa.updateProfile', ['client_id' => $client_id]) }}"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @if($profile)
                                @method('PUT')
                            @endif
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required value="{{ $profile->username ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required value="{{ $profile->name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="followers" class="form-label">Followers</label>
                                <input type="text" class="form-control" name="followers" id="followers" required value="{{ $profile->followers ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="following" class="form-label">Following</label>
                                <input type="text" class="form-control" name="following" id="following" required value="{{ $profile->following ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" name="bio" id="bio" rows="3" required>{{ $profile->bio ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Link</label>
                                <button type="button" class="btn btn-primary btn-sm mb-2" id="add-link-btn-modal">Add Link</button>
                                <div id="links-container-modal" class="mt-2">
                                    @if($profile && $profile->links)
                                        @foreach($profile->links as $index => $link)
                                            <div class="mb-2 row align-items-center">
                                                <div class="col-md-5">
                                                    <input class="form-control mb-1" name="links[{{ $index }}][url]" placeholder="URL" required value="{{ $link->url }}">
                                                </div>
                                                <div class="col-md-5">
                                                    <input class="form-control mb-1" name="links[{{ $index }}][name]" placeholder="Nama Link" required value="{{ $link->name }}">
                                                </div>
                                                <div class="col-md-2 d-flex align-items-center">
                                                    <button type="button" class="btn btn-danger btn-sm remove-link-btn" title="Hapus Link">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addLinkBtn = document.getElementById("add-link-btn-modal");
            const linksContainer = document.getElementById("links-container-modal");
            let linkIndex = linksContainer.querySelectorAll('.row').length;

            if (addLinkBtn) {
                addLinkBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    linkIndex++;
                    const linkGroup = document.createElement("div");
                    linkGroup.className = "mb-2 row align-items-center";
                    linkGroup.innerHTML = `
                        <div class=\"col-md-5\">
                            <input class=\"form-control mb-1\" name=\"links[${linkIndex}][url]\" placeholder=\"URL\" required>
                        </div>
                        <div class=\"col-md-5\">
                            <input class=\"form-control mb-1\" name=\"links[${linkIndex}][name]\" placeholder=\"Nama Link\" required>
                        </div>
                        <div class=\"col-md-2 d-flex align-items-center\">
                            <button type=\"button\" class=\"btn btn-danger btn-sm remove-link-btn\" title=\"Hapus Link\">\n                                <i class=\"fas fa-trash\"></i>\n                            </button>
                        </div>
                    `;
                    linksContainer.appendChild(linkGroup);
                    linkGroup.querySelector(".remove-link-btn").addEventListener("click", function () {
                        linksContainer.removeChild(linkGroup);
                    });
                });
                // Remove link handler for existing links
                linksContainer.querySelectorAll('.remove-link-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        btn.closest('.row').remove();
                    });
                });
            }
        });
    </script>

</x-app-layout>
