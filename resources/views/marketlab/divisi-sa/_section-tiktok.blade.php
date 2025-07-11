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
                            <img src="{{ asset('storage/' . $client->gambar_client) }}" class="profile-pic"
                                id="profileStoryTrigger" style="cursor:pointer" data-toggle="modal"
                                data-target="#storyModal">
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
                                            fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
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
                                <span class="ig-style-post"><strong>{{ $profileTiktok->following }}</strong>
                                    Following</span>
                                <span class="ig-style-post"><strong>{{ $profileTiktok->followers }}</strong>
                                    Followers</span>
                                <span class="ig-style-post"><strong>{{ $profileTiktok->likes }}</strong>
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
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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
                <button class="tab-item active" onclick="switchTab(event, 'tiktok-videos')">Videos</button>
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
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tiktokmediaModal{{ $tkpost->id }}">
                                @if ($tkpost->cover)
                                @if (Str::endsWith($tkpost->cover, '.webp'))
                                <img src="{{ asset('storage/cover_tiktok/' . $tkpost->cover) }}" alt="Cover Image"
                                    class="img-fluid">
                                @elseif (Str::endsWith($tkpost->cover, '.webm'))
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/cover/' . $tkpost->cover) }}" type="video/webm">
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
                                    <source src="{{ asset('storage/tiktok_media/' . $firstMedia->media) }}"
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
                                <source src="https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4"
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