<!-- Instagram Page -->
<div class="instagram-page" id="instagramSection" style="display: block;">
    <div id="instagramProfileWrapper" class="desktop-view">
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-info">
                    <div class="row top-info ig-style">
                        <div class="col-md-3 style-ig">
                            <img src="{{ asset('storage/' . $client->gambar_client) }}" class="profile-pic"
                                id="profileStoryTrigger" style="cursor:pointer" data-toggle="modal"
                                data-target="#storyModal">
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
                                            fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
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

                                <span class="ig-style-post">{{ $posts->where('category', 'post')->count() }}<strong>
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
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </span>
                                </a>

                                <div class="text-danger">Profile Not added yet. Please fill in.</div>
                            </div>
                            @endif
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

                            <a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal{{ $post->id }}">
                                @if ($post->cover)
                                @if (Str::endsWith($post->cover, '.webp'))
                                <img src="{{ asset('storage/cover/' . $post->cover) }}" alt="Cover Image"
                                    class="img-fluid">
                                @elseif (Str::endsWith($post->cover, '.webm'))
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/cover/' . $post->cover) }}" type="video/webm">
                                    Your browser does not support the video tag.
                                </video>
                                @endif
                                @elseif ($firstMedia)
                                @if (Str::endsWith($firstMedia->post, '.webp'))
                                <img src="{{ asset('storage/media/' . $firstMedia->post) }}" alt="Social Media"
                                    class="img-fluid">
                                @elseif (Str::endsWith($firstMedia->post, '.webm'))
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/media/' . $firstMedia->post) }}" type="video/webm">
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
                            <a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal{{ $post->id }}">
                                @if ($post->cover)
                                @if (Str::endsWith($post->cover, '.webp'))
                                <img src="{{ asset('storage/cover/' . $post->cover) }}" alt="Cover Image"
                                    class="img-fluid">
                                @elseif (Str::endsWith($post->cover, '.webm'))
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/cover/' . $post->cover) }}" type="video/webm">
                                    Your browser does not support the video tag.
                                </video>
                                @endif
                                @elseif ($firstMedia)
                                @if (Str::endsWith($firstMedia->post, '.webp'))
                                <img src="{{ asset('storage/media/' . $firstMedia->post) }}" alt="Social Media"
                                    class="img-fluid">
                                @elseif (Str::endsWith($firstMedia->post, '.webm'))
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/media/' . $firstMedia->post) }}" type="video/webm">
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
                            <a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal{{ $post->id }}">
                                @if ($post->cover)
                                @if (Str::endsWith($post->cover, '.webp'))
                                <img src="{{ asset('storage/cover/' . $post->cover) }}" alt="Cover Image"
                                    class="img-fluid">
                                @elseif (Str::endsWith($post->cover, '.webm'))
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/cover/' . $post->cover) }}" type="video/webm">
                                    Your browser does not support the video tag.
                                </video>
                                @endif
                                @elseif ($firstMedia)
                                @if (Str::endsWith($firstMedia->post, '.webp'))
                                <img src="{{ asset('storage/media/' . $firstMedia->post) }}" alt="Social Media"
                                    class="img-fluid">
                                @elseif (Str::endsWith($firstMedia->post, '.webm'))
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/media/' . $firstMedia->post) }}" type="video/webm">
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