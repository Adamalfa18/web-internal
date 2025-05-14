<x-clinet-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.clientnavbar />

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

            {{-- Button Instagram Tiktok Dan Mode --}}
            <div class="d-flex gap-2 mb-3">
                <button id="btnInstagram" class="btn btn-sm btn-outline-primary active d-flex align-items-center gap-2"
                    onclick="showInstagram()">
                    <i class="fas fa-instagram"></i> Lihat Instagram
                </button>
                <button id="btnTiktok" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"
                    onclick="showTiktok()">
                    <i class="fab fa-tiktok"></i> Lihat TikTok
                </button>
                <button class="btn btn-style-sa" onclick="toggleView()">
                    <i class="fas fa-mobile-alt"></i> <span id="btnText">Lihat Mode Mobile</span>
                </button>
            </div>
            {{-- End Button Instagram Tiktok Dan Mode --}}

            <!-- End Modal Add Post -->
            <div id="profileWrapper" class="">
                {{-- Instagram Paost --}}
                <div class="instagram-page" id="instagramSection" style="display: block;">
                    <div id="instagramProfileWrapper" class="desktop-view">
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
                                                    <h2>{{ $client->nama_brand }}</h2>
                                                </div>
                                            </div>
                                            <div class="stats">
                                                <span><strong>Post</strong>
                                                    {{ $posts->where('category', 'post')->count() }}
                                                </span>
                                                <span><strong>Reel</strong>
                                                    {{ $posts->where('category', 'reel')->count() }}
                                                </span>
                                                <span><strong>Story</strong>
                                                    {{ $posts->where('category', 'story')->count() }} </span>
                                            </div>
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
                                            </div>
                                            <div class="stats">
                                                <span><strong>Followers</strong> 1.2M </span>
                                                <span><strong>Likes</strong> 5.7M </span>
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
                                                        @if (Str::endsWith($firstMedia->media, '.webp'))
                                                            <img src="{{ asset('storage/tiktok_media/' . $firstMedia->media) }}"
                                                                alt="TikTok Media" class="img-fluid">
                                                        @elseif (Str::endsWith($firstMedia->media, '.webm'))
                                                            <video width="100%" controls>
                                                                <source
                                                                    src="{{ asset('storage/media/' . $firstMedia->media) }}"
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
                {{-- End TikTok Page --}}

            </div>

            {{-- Instagram --}}
            @foreach ($posts as $post)
                <div class="modal fade" id="mediaModal{{ $post->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="mediaModalLabel{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediaModalLabel{{ $post->id }}">Detail Post</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

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

                                        {{-- Note --}}
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
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editSAModal{{ $post->id }}">
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
                <div class="modal fade" id="editSAModal{{ $post->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editSAModalLabel{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-marketing"
                                action="{{ route('data-client.update-sa', ['client_id' => $client->id, 'post_id' => $post->id]) }}"
                                method="POST" id="editForm{{ $post->id }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSAModalLabel{{ $post->id }}">Edit Post
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="row">
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
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="caption" class="form-label">Caption</label>
                                                <textarea class="form-control" name="caption" id="caption" readonly>{{ $post->caption }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="created_at" class="form-label">Tanggal Upload</label>
                                                <input type="date" class="form-control" name="created_at"
                                                    id="created_at" value="{{ $post->created_at->format('Y-m-d') }}"
                                                    disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="note">Note</label>
                                                <textarea class="form-control" name="note" id="note" rows="3">{{ $post->note }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status">Status</label>
                                                <select class="form-select" name="status" id="status" required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="1"
                                                        {{ $firstMedia && $firstMedia->postingan && $firstMedia->postingan->status == 1 ? 'selected' : '' }}>
                                                        Acc</option>
                                                    <option value="2"
                                                        {{ $firstMedia && $firstMedia->postingan && $firstMedia->postingan->status == 2 ? 'selected' : '' }}>
                                                        Revisi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            id="saveButton{{ $post->id }}">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Modal Edit SA --}}
            @endforeach
            {{-- End Instagram --}}

            {{-- Modal per Post *Tiktok  --}}
            @foreach ($tiktok as $tiktok)
                <div class="modal fade" id="tiktokmediaModal{{ $tiktok->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="tiktokmediaModalLabel{{ $tiktok->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tiktokmediaModalLabel{{ $tiktok->id }}">Detail Post
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="row form-marketing" enctype="multipart/form-data">
                                <div class="col-lg-6">
                                    {{-- Carousel Dinamis --}}
                                    @if ($tiktok->tiktok_media->count())
                                        <div id="carouselIndicators{{ $tiktok->id }}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($tiktok->tiktok_media as $key => $tiktok_media)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        @if (in_array(pathinfo($tiktok_media->media, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
                                                            <video class="d-block w-100" controls>
                                                                <source
                                                                    src="{{ asset('storage/tiktok_media/' . $tiktok_media->media) }}"
                                                                    type="video/mp4">
                                                            </video>
                                                        @else
                                                            <img src="{{ asset('storage/tiktok_media/' . $tiktok_media->media) }}"
                                                                class="d-block w-100" alt="Post Tiktok Media">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if ($tiktok->tiktok_media->count() > 1)
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselIndicators{{ $tiktok->id }}"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"
                                                        aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselIndicators{{ $tiktok->id }}"
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
                                            <textarea class="form-control" rows="3" disabled>{{ $tiktok->created_at->format('d-m-Y') }}</textarea>
                                        </div>

                                        {{-- Captin --}}
                                        <div class="form-group">
                                            <label>Caption</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $tiktok->caption }}</textarea>
                                        </div>

                                        {{-- Note --}}
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $tiktok->note }}</textarea>
                                        </div>

                                        {{-- Status --}}
                                        @php
                                            // ambil media pertama dari tiktok ini (kalau kamu dalam @foreach $posts)
                                            $firstMedia = $post_medias->firstWhere('post_id', $tiktok->id);
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
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editTiktokmediaModal{{ $tiktok->id }}">
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
                <div class="modal fade" id="editTiktokmediaModal{{ $tiktok->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editTiktokmediaModalLabel{{ $tiktok->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-marketing"
                                action="{{ route('data-client.update-sa', ['client_id' => $client->id, 'post_id' => $tiktok->id]) }}"
                                method="POST" id="editForm{{ $tiktok->id }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTiktokmediaModalLabel{{ $tiktok->id }}">Edit
                                        Post
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        {{-- Carousel Dinamis --}}
                                        @if ($tiktok->tiktok_media->count())
                                            <div id="carouselIndicators{{ $tiktok->id }}" class="carousel slide"
                                                data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($tiktok->tiktok_media as $key => $tiktok_media)
                                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                            @if (in_array(pathinfo($tiktok_media->media, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
                                                                <video class="d-block w-100" controls>
                                                                    <source
                                                                        src="{{ asset('storage/tiktok_media/' . $tiktok_media->media) }}"
                                                                        type="video/mp4">
                                                                </video>
                                                            @else
                                                                <img src="{{ asset('storage/tiktok_media/' . $tiktok_media->media) }}"
                                                                    class="d-block w-100" alt="Post Media">
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if ($tiktok->tiktok_media->count() > 1)
                                                    <button class="carousel-control-prev" type="button"
                                                        data-bs-target="#carouselIndicators{{ $tiktok->id }}"
                                                        data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button"
                                                        data-bs-target="#carouselIndicators{{ $tiktok->id }}"
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
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="caption" class="form-label">Caption</label>
                                                <textarea class="form-control" name="caption" id="caption" readonly>{{ $tiktok->caption }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="created_at" class="form-label">Tanggal Upload</label>
                                                <input type="date" class="form-control" name="created_at"
                                                    id="created_at"
                                                    value="{{ $tiktok->created_at->format('Y-m-d') }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="note">Note</label>
                                                <textarea class="form-control" name="note" id="note" rows="3">{{ $tiktok->note }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status">Status</label>
                                                <select class="form-select" name="status" id="status" required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="1"
                                                        {{ $firstMedia && $firstMedia->postingan && $firstMedia->postingan->status == 1 ? 'selected' : '' }}>
                                                        Acc</option>
                                                    <option value="2"
                                                        {{ $firstMedia && $firstMedia->postingan && $firstMedia->postingan->status == 2 ? 'selected' : '' }}>
                                                        Revisi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            id="saveButton{{ $tiktok->id }}">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Modal Edit SA --}}
            @endforeach
            {{-- End modal Media Instagram --}}
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editForm{{ $post->id }}');
            const saveButton = document.getElementById('saveButton{{ $post->id }}');

            if (form && saveButton) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    console.log('Form submission started');

                    const formData = new FormData(form);
                    console.log('Form data:', Object.fromEntries(formData));

                    fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Success:', data);
                            if (data.success) {
                                window.location.reload();
                            } else {
                                alert(data.message || 'Terjadi kesalahan saat menyimpan data');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menyimpan data');
                        });
                });
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
</x-clinet-layout>
