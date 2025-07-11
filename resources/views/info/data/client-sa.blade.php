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
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-instagram" viewBox="0 0 16 16">
                        <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                    </svg>
                    Instagram
                </button>
                <button id="btnTiktok" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"
                    onclick="showTiktok()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-tiktok" viewBox="0 0 16 16">
                        <path
                            d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                    </svg>
                    TikTok
                </button>
                <button class="btn btn-style-sa" onclick="toggleView()">
                    <span id="btnText">Ubah Preview</span>
                </button>
            </div>
            {{-- End Button Instagram Tiktok Dan Mode --}}

            <div id="profileWrapper" class="">
                <!-- Instagram Page -->
                <div class="instagram-page" id="instagramSection" style="display: block;">
                    <div id="instagramProfileWrapper" class="desktop-view">
                        <div class="profile-container">
                            <div class="profile-header">
                                <div class="profile-info">
                                    <div class="row top-info ig-style">
                                        <div class="col-md-3 style-ig">
                                            <img src="{{ asset('storage/' . $client->gambar_client) }}"
                                                class="profile-pic" id="profileStoryTrigger" style="cursor:pointer"
                                                data-toggle="modal" data-target="#storyModal">
                                        </div>
                                        <div class="col-md-9 ig-style">
                                            <div class="style-clien-header">
                                                <div class="nama-brand">
                                                    <h2>{{ $profileIG->username ?? $client->nama_brand }}</h2>
                                                </div>
                                                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                                    data-toggle="modal" data-target="#addPostModal">
                                                    <span class="btn-inner--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-plus-square-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0" />
                                                        </svg>
                                                    </span>
                                                </a>
                                                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                                    data-toggle="modal" data-target="#editProfileModal">
                                                    <span class="btn-inner--icon">
                                                    </span>
                                                    <span class="btn-inner--text">Edit Profile</span>
                                                </a>
                                                <div class="style-button-ig">

                                                </div>
                                            </div>
                                            @if ($profileIG)
                                            <div class="stats">

                                                <span class="ig-style-post">{{ $posts->where('category',
                                                    'post')->count() }}<strong>
                                                        Post</strong></span>
                                                <span>{{ $profileIG->followers }}<strong> Followers</strong> </span>
                                                <span>{{ $profileIG->following }}<strong> Following</strong> </span>
                                            </div>
                                            <div class="name_ig">
                                                <span><strong>{{ $profileIG->name }}</strong></span>
                                            </div>
                                            <div class="bio">
                                                <span>{{ $profileIG->bio }}</span>
                                            </div>
                                            <div class="link">
                                                @foreach ($profileIG->links as $link)
                                                <a href="{{ $link->url }}" target="_blank">{{ $link->name }}</a>
                                                @endforeach
                                            </div>
                                            @else
                                            <div class="style-clien-header mt-3">
                                                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                                    data-toggle="modal" data-target="#addProfileIGModal">
                                                    <span class="btn-inner--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-pencil-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                        </svg>
                                                    </span>
                                                </a>

                                                <div class="text-danger">Profile belum diisi.</div>
                                            </div>
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
                                        <div class="gallery-item image-wrapper">

                                            @if ($firstMedia && $firstMedia->postingan)
                                            @php
                                            $status = $firstMedia->postingan->status;
                                            $ribbonText = 'Unknown';
                                            $ribbonClass = '';

                                            switch ($status) {
                                            case 0:
                                            $ribbonText = 'Pending';
                                            $ribbonClass = 'pending';
                                            break;
                                            case 1:
                                            $ribbonText = 'Approved';
                                            $ribbonClass = 'approved';
                                            break;
                                            case 2:
                                            $ribbonText = 'Needs Revision';
                                            $ribbonClass = 'revision';
                                            break;
                                            case 3:
                                            $ribbonText = 'Completed';
                                            $ribbonClass = 'completed';
                                            break;
                                            default:
                                            $ribbonText = 'Unknown';
                                            $ribbonClass = 'unknown';
                                            }
                                            @endphp

                                            <div class="ribbon {{ $ribbonClass }}">{{ $ribbonText }}</div>
                                            @endif

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
                                                    <source src="{{ asset('storage/media/' . $firstMedia->post) }}"
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
                                        <div class="gallery-item image-wrapper">
                                            @if ($firstMedia && $firstMedia->postingan)
                                            @php
                                            $status = $firstMedia->postingan->status;
                                            $ribbonText = 'Unknown';
                                            $ribbonClass = '';

                                            switch ($status) {
                                            case 0:
                                            $ribbonText = 'Pending';
                                            $ribbonClass = 'pending';
                                            break;
                                            case 1:
                                            $ribbonText = 'Approved';
                                            $ribbonClass = 'approved';
                                            break;
                                            case 2:
                                            $ribbonText = 'Needs Revision';
                                            $ribbonClass = 'revision';
                                            break;
                                            case 3:
                                            $ribbonText = 'Completed';
                                            $ribbonClass = 'completed';
                                            break;
                                            default:
                                            $ribbonText = 'Unknown';
                                            $ribbonClass = 'unknown';
                                            }
                                            @endphp

                                            <div class="ribbon {{ $ribbonClass }}">{{ $ribbonText }}</div>
                                            @endif
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
                                                    <source src="{{ asset('storage/media/' . $firstMedia->post) }}"
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
                                        <div class="gallery-item image-wrapper">
                                            @if ($firstMedia && $firstMedia->postingan)
                                            @php
                                            $status = $firstMedia->postingan->status;
                                            $ribbonText = 'Unknown';
                                            $ribbonClass = '';

                                            switch ($status) {
                                            case 0:
                                            $ribbonText = 'Pending';
                                            $ribbonClass = 'pending';
                                            break;
                                            case 1:
                                            $ribbonText = 'Approved';
                                            $ribbonClass = 'approved';
                                            break;
                                            case 2:
                                            $ribbonText = 'Needs Revision';
                                            $ribbonClass = 'revision';
                                            break;
                                            case 3:
                                            $ribbonText = 'Completed';
                                            $ribbonClass = 'completed';
                                            break;
                                            default:
                                            $ribbonText = 'Unknown';
                                            $ribbonClass = 'unknown';
                                            }
                                            @endphp

                                            <div class="ribbon {{ $ribbonClass }}">{{ $ribbonText }}</div>
                                            @endif
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
                                                    <source src="{{ asset('storage/media/' . $firstMedia->post) }}"
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
                                    <div class="row top-info">
                                        <div class="col-md-3 style-tiktok-title">
                                            <div class="style-clien-header">
                                                <div class="nama-brand">
                                                    <h6>{{ $profileTiktok->username ?? $client->nama_brand }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 style-ig">
                                            <img src="{{ asset('storage/' . $client->gambar_client) }}"
                                                class="profile-pic" id="profileStoryTrigger" style="cursor:pointer"
                                                data-toggle="modal" data-target="#storyModal">
                                        </div>
                                        <div class="col-md-9 tiktok-style">
                                            <div class="style-clien-header">
                                                <div class="nama-brand style-tiktok-title">
                                                    <h2>{{ $profileTiktok->username ?? $client->nama_brand }}</h2>
                                                </div>
                                                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                                    data-bs-toggle="modal" data-bs-target="#addTiktokModal">
                                                    <span class="btn-inner--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-plus-square-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0" />
                                                        </svg>
                                                    </span>
                                                </a>
                                                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                                    data-toggle="modal" data-target="#editProfileModalTiktok">
                                                    <span class="btn-inner--icon"></span>
                                                    <span class="btn-inner--text">Edit Profile</span>
                                                </a>
                                            </div>

                                            @if ($profileTiktok)
                                            <div class="stats">
                                                <span class="ig-style-post"><strong>{{ $profileTiktok->following
                                                        }}</strong>
                                                    Following</span>
                                                <strong class="ig-style-post"><strong>{{ $profileTiktok->followers
                                                        }}</strong>
                                                    Followers</span>
                                                    <span class="ig-style-post"><strong>{{ $profileTiktok->likes
                                                            }}</strong>
                                                        Likes</span>
                                            </div>
                                            <div class="name_ig">
                                                <span><strong>{{ $profileTiktok->name }}</strong></span>
                                            </div>
                                            <div class="bio">
                                                <span>{{ $profileTiktok->bio }}</span>
                                            </div>
                                            <div class="link">
                                                @foreach ($profileTiktok->links as $link)
                                                <a href="{{ $link->url }}" target="_blank">{{ $link->name }}</a>
                                                @endforeach
                                            </div>
                                            @else
                                            <div class="style-clien-header mt-3">
                                                <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                                    data-toggle="modal" data-target="#addPofileTiktokModal">
                                                    <span class="btn-inner--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-pencil-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                        </svg>
                                                    </span>
                                                </a>
                                                <div class="text-danger">Profile belum diisi.</div>
                                            </div>
                                            @endif
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
                                    <div class="gallery tiktok-gallery">
                                        @foreach ($tiktok as $tkpost)
                                        @php
                                        $firstMedia = $tkpost->tiktok_media->first();
                                        @endphp
                                        <div class="gallery-item image-wrapper">
                                            @if ($firstMedia && $firstMedia->post_tiktok)
                                            @php
                                            $status = $firstMedia->post_tiktok->status;
                                            $ribbonText = 'Status Tidak Diketahui';
                                            $ribbonClass = 'unknown';

                                            switch ($status) {
                                            case 0:
                                            $ribbonText = 'Pending';
                                            $ribbonClass = 'pending';
                                            break;
                                            case 1:
                                            $ribbonText = 'Approved';
                                            $ribbonClass = 'approved';
                                            break;
                                            case 2:
                                            $ribbonText = 'Needs Revision';
                                            $ribbonClass = 'revision';
                                            break;
                                            case 3:
                                            $ribbonText = 'Completed';
                                            $ribbonClass = 'completed';
                                            break;
                                            default:
                                            $ribbonText = 'Unknown';
                                            $ribbonClass = 'unknown';
                                            }
                                            @endphp

                                            <div class="ribbon {{ $ribbonClass }}">{{ $ribbonText }}</div>
                                            @endif
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#tiktokmediaModal{{ $tkpost->id }}">
                                                @if ($tkpost->cover)
                                                @if (Str::endsWith($tkpost->cover, '.webp'))
                                                <img src="{{ asset('storage/cover_tiktok/' . $tkpost->cover) }}"
                                                    alt="Cover Image" class="img-fluid">
                                                @elseif (Str::endsWith($tkpost->cover, '.webm'))
                                                <video width="100%" controls>
                                                    <source src="{{ asset('storage/cover/' . $tkpost->cover) }}"
                                                        type="video/webm">
                                                    Your browser does not support the video tag.
                                                </video>
                                                @endif
                                                @elseif ($firstMedia)
                                                @php
                                                $ext = strtolower(
                                                pathinfo($firstMedia->media, PATHINFO_EXTENSION),
                                                );
                                                @endphp
                                                @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                                <video class="w-100 carousel-media-3by4" controls>
                                                    <source
                                                        src="{{ asset('storage/tiktok_media/' . $firstMedia->media) }}"
                                                        type="video/{{ $ext }}">
                                                    Browser not support video.
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
                                        @for ($i = 1; $i <= 6; $i++) <div class="gallery-item">
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
        </div>
        </div>

        {{-- Instagram --}}
        @foreach ($posts as $post)
        <div class="modal fade" id="mediaModal{{ $post->id }}" tabindex="-1" role="dialog"
            aria-labelledby="mediaModalLabel{{ $post->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
                <div class="modal-content">
                    <div class="modal-body">
                        {{-- <div class="modal-header">
                            <h5 class="modal-title" id="mediaModalLabel{{ $post->id }}">Detail Post</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> --}}

                        <div class="row form-marketing" enctype="multipart/form-data">
                            <div class="col-lg-6">
                                {{-- Carousel Dinamis --}}
                                @if ($post->media->count())
                                <div id="carouselIndicators{{ $post->id }}" class="carousel slide"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($post->media as $key => $media)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            @if (in_array(pathinfo($media->post, PATHINFO_EXTENSION), ['mp4', 'mov',
                                            'webm']))
                                            <video class="d-block w-100" controls>
                                                <source src="{{ asset('storage/media/' . $media->post) }}"
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
                                        data-bs-target="#carouselIndicators{{ $post->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselIndicators{{ $post->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
                                        <textarea class="form-control" rows="3"
                                            disabled>{{ $post->created_at->format('d-m-Y') }}</textarea>
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
                                        <span class="badge badge-secondary">Status Unknown</span>
                                        @endif
                                    </div>
                                    @endif

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
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
        </div>
        <!-- Modal Edit SA -->
        <div class="modal fade" id="editSAModal{{ $post->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editSAModalLabel{{ $post->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-marketing-edit-sa"
                            action="{{ route('data-client.update-sa', ['client_id' => $client->id, 'post_id' => $post->id]) }}"
                            method="POST" id="editForm{{ $post->id }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-header mb-3">
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
                                                @if (in_array(pathinfo($media->post, PATHINFO_EXTENSION), ['mp4', 'mov',
                                                'webm']))
                                                <video class="d-block w-100" controls>
                                                    <source src="{{ asset('storage/media/' . $media->post) }}"
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
                                            data-bs-target="#carouselIndicators{{ $post->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselIndicators{{ $post->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
                                            <textarea class="form-control" name="caption" id="caption"
                                                readonly>{{ $post->caption }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="created_at" class="form-label">Tanggal Upload</label>
                                            <input type="date" class="form-control" name="created_at" id="created_at"
                                                value="{{ $post->created_at->format('Y-m-d') }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea class="form-control" name="note" id="note"
                                                rows="3">{{ $post->note }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-select" name="status" id="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="1" {{ $firstMedia && $firstMedia->postingan &&
                                                    $firstMedia->postingan->status == 1 ? 'selected' : '' }}>
                                                    Acc</option>
                                                <option value="2" {{ $firstMedia && $firstMedia->postingan &&
                                                    $firstMedia->postingan->status == 2 ? 'selected' : '' }}>
                                                    Revisi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"
                                        id="saveButton{{ $post->id }}">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Edit SA --}}
        @endforeach
        {{-- End Instagram --}}

        {{-- Modal per Post *Tiktok --}}
        @foreach ($tiktok as $tiktok)
        <div class="modal fade" id="tiktokmediaModal{{ $tiktok->id }}" tabindex="-1" role="dialog"
            aria-labelledby="tiktokmediaModalLabel{{ $tiktok->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
                <div class="modal-content">
                    <div class="modal-body">
                        {{-- <div class="modal-header">
                            <h5 class="modal-title" id="tiktokmediaModalLabel{{ $tiktok->id }}">Detail Post
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> --}}

                        <div class="row form-marketing" enctype="multipart/form-data">
                            <div class="col-lg-6">
                                {{-- Carousel Dinamis --}}
                                @if ($tiktok->tiktok_media->count())
                                <div id="carouselIndicators{{ $tiktok->id }}" class="carousel slide"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($tiktok->tiktok_media as $key => $tiktok_media)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            @if (in_array(pathinfo($tiktok_media->media, PATHINFO_EXTENSION), ['mp4',
                                            'mov', 'webm']))
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
                                        data-bs-target="#carouselIndicators{{ $tiktok->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselIndicators{{ $tiktok->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
                                        <textarea class="form-control" rows="3"
                                            disabled>{{ $tiktok->created_at->format('d-m-Y') }}</textarea>
                                    </div>

                                    {{-- Captin --}}
                                    <div class="form-group">
                                        <label>Caption</label>
                                        <textarea class="form-control" rows="3"
                                            disabled>{{ $tiktok->caption }}</textarea>
                                    </div>

                                    {{-- Note --}}
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea class="form-control" rows="3" disabled>{{ $tiktok->note }}</textarea>
                                    </div>

                                    {{-- Status --}}
                                    @php
                                    // ambil media pertama dari tiktok ini (kalau kamu dalam @foreach $posts)
                                    $firstMedia = $tiktok_medias->firstWhere('post_id', $tiktok->id);
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
                                        <span class="badge badge-secondary">Status Unknown</span>
                                        @endif
                                    </div>
                                    @endif

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
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
        </div>
        <!-- Modal Edit tiktok -->
        <div class="modal fade" id="editTiktokmediaModal{{ $tiktok->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editTiktokmediaModalLabel{{ $tiktok->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-marketing form-marketing-edit-tiktok"
                            action="{{ route('data-client.update-tiktok', ['client_id' => $client->id, 'post_id' => $tiktok->id]) }}"
                            method="POST" id="editFormTiktok{{ $tiktok->id }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTiktokmediaModalLabel{{ $tiktok->id }}">Edit
                                    Post
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="caption-tiktok-{{ $tiktok->id }}" class="form-label">Caption</label>
                                    <textarea class="form-control" name="caption" id="caption-tiktok-{{ $tiktok->id }}"
                                        required readonly>{{ $tiktok->caption }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="created_at-tiktok-{{ $tiktok->id }}" class="form-label">Tanggal
                                        Upload</label>
                                    <input type="date" class="form-control" name="created_at"
                                        id="created_at-tiktok-{{ $tiktok->id }}"
                                        value="{{ $tiktok->created_at->format('Y-m-d') }}" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="note-tiktok-{{ $tiktok->id }}" class="form-label">Note</label>
                                    <textarea class="form-control" name="note"
                                        id="note-tiktok-{{ $tiktok->id }}">{{ $tiktok->note }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status-tiktok-{{ $tiktok->id }}" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status-tiktok-{{ $tiktok->id }}"
                                        required>
                                        <option value="">Pilih Status</option>
                                        <option value="1" {{ $tiktok->status == 1 ? 'selected' : '' }}>Acc
                                        </option>
                                        <option value="2" {{ $tiktok->status == 2 ? 'selected' : '' }}>
                                            Revisi
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
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
            // Handle all edit forms
            document.querySelectorAll('form.form-marketing-edit-sa').forEach(function(form) {
                const saveButton = form.querySelector('button[type="submit"]');

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
                                    alert(data.message ||
                                        'Terjadi kesalahan saat menyimpan data');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menyimpan data');
                            });
                    });
                }
            });

            document.querySelectorAll('form.form-marketing-edit-tiktok').forEach(function(form) {
                const saveButton = form.querySelector('button[type="submit"]');

                if (form && saveButton) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        console.log('TikTok form submission started');

                        const formData = new FormData(form);

                        fetch(form.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json' // penting agar Laravel tahu ini request AJAX
                                }
                            })
                            .then(async response => {
                                // Jika respons JSON valid
                                const contentType = response.headers.get('content-type') ||
                                    '';
                                if (contentType.includes('application/json')) {
                                    const data = await response.json();
                                    console.log('Success:', data);
                                    if (data.success) {
                                        window.location.reload();
                                    } else {
                                        alert(data.message ||
                                            'Terjadi kesalahan saat menyimpan data');
                                    }
                                } else if (response.ok) {
                                    // Kalau respons bukan JSON tapi sukses (200), reload saja
                                    window.location.reload();
                                } else {
                                    throw new Error('Respons tidak valid atau gagal');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menyimpan data');
                            });
                    });
                }
            });
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
</x-clinet-layout>