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
                                            name="content_media[]" accept=".jpg, .jpeg, .png, .gif, .mp4, .mov, .webm"
                                            multiple>
                                        <button type="button" class="btn btn-primary" id="add-file-btn">Add
                                            Gambar</button>
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

            <div id="profileWrapper" class="desktop-view">
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
                                            <a onclick="toggleMobileView()"
                                                class="btn btn-sm btn-secondary d-flex align-items-center">
                                                <i class="fas fa-mobile-alt me-2"></i> Lihat Mode Mobile
                                            </a>
                                        </div>
                                    </div>
                                    <div class="stats">
                                        <span><strong>testtt</strong> posts</span>
                                        <span><strong>testtt</strong> followers</span>
                                        <span><strong>testtt</strong> following</span>
                                    </div>
                                    <div class="real-name">{{ $client->nama_client }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabs">
                        <a href="#" class="active"><i class="fas fa-th"></i> POSTS</a>
                        <a href="#"><i class="far fa-bookmark"></i> SAVED</a>
                        <a href="#"><i class="far fa-user"></i> TAGGED</a>
                    </div>
                    <div class="gallery">
                        @forelse ($posts as $post)
                            {{-- Ambil media pertama yang sudah disiapkan di controller --}}
                            @php
                                $firstMedia = $post_medias->firstWhere('post_id', $post->id);
                            @endphp
                            @if ($firstMedia)
                                <div class="gallery-item">
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#mediaModal{{ $post->id }}" target="_blank">
                                        <img src="{{ asset('storage/media/' . $firstMedia->post) }}"
                                            alt="Social Media" class="img-fluid">
                                    </a>
                                </div>
                            @endif
                        @empty
                            <p>Belum ada media.</p>
                        @endforelse
                    </div>
                </div>


                {{-- Modal per Post --}}
                @foreach ($posts as $post)
                    <div class="modal fade" id="mediaModal{{ $post->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="mediaModalLabel{{ $post->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediaModalLabel{{ $post->id }}">Detail Post</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
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
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editSAModal{{ $post->id }}">
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
                    <div class="modal fade modal-edit-sa-style" id="editSAModal{{ $post->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editSAModalLabel{{ $post->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form class="form-marketing" id="edit-form-{{ $post->id }}" method="POST"
                                    action="{{ route('divisi-sa.update', ['client_id' => $post->client_id, 'post_id' => $post->id]) }}" 
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $post->id }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSAModalLabel{{ $post->id }}">Edit Post</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
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
                                            <label for="created_at{{ $post->id }}" class="form-label">Tanggal Upload</label>
                                            <input type="date" class="form-control" name="created_at"
                                                id="created_at{{ $post->id }}"
                                                value="{{ $post->created_at->format('Y-m-d') }}" required>
                                        </div>
                                        {{-- Upload Media --}}
                                        <div class="mb-3">
                                            <label for="edit_content_media{{ $post->id }}" class="form-label">Gambar / Video yang Ada</label>
                                            <div class="row mt-3" id="edit-preview-container-{{ $post->id }}">
                                                @foreach ($post->media as $key => $media)
                                                    <div class="col-md-4 mb-2 position-relative preview-item">
                                                        <input type="hidden" name="existing_media_ids[]" value="{{ $media->id }}">
                                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-media"
                                                            data-media-id="{{ $media->id }}">
                                                            &times;
                                                        </button>
                                                        @if (in_array(pathinfo($media->post, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
                                                            <video class="w-100" controls>
                                                                <source src="{{ asset('storage/media/' . $media->post) }}" type="video/mp4">
                                                                Browser tidak mendukung video.
                                                            </video>
                                                        @else
                                                            <img src="{{ asset('storage/media/' . $media->post) }}" class="img-fluid rounded" alt="Media Post">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="mt-2">
                                                <input type="file" class="form-control d-none edit-file-input" 
                                                    id="edit_content_media{{ $post->id }}"
                                                    data-id="{{ $post->id }}"
                                                    name="content_media[]" 
                                                    accept=".jpg, .jpeg, .png, .gif, .mp4, .mov, .webm"
                                                    multiple>
                                                <button type="button" class="btn btn-primary edit-add-file-btn" 
                                                        data-id="{{ $post->id }}">
                                                    Add Gambar
                                                </button>
                                            </div>
                                            <div class="row mt-2 edit-preview-container" id="edit-preview-container-{{ $post->id }}"></div>
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
            </div>
        </div>
    </main>

</x-app-layout>
