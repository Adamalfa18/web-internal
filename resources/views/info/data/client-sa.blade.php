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
            <div class="profile-container">
                <div class="profile-header">
                    <img src="{{ asset('storage/' . $client->gambar_client) }}" class="profile-pic">
                    <div class="profile-info">
                        <div class="stats">
                            <span><strong>testtt</strong> posts</span>
                            <span><strong>testtt</strong> followers</span>
                            <span><strong>testtt</strong> following</span>
                        </div>
                        <div class="real-name">{{ $client->nama_client }}</div>
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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal{{ $post->id }}"
                                    target="_blank">
                                    <img src="{{ asset('storage/media/' . $firstMedia->post) }}" alt="Social Media"
                                        class="img-fluid">
                                </a>
                            </div>
                        @endif
                    @empty
                        <p>Belum ada media.</p>
                    @endforelse
                </div>

                {{-- Modal per Post --}}
                @foreach ($posts as $post)
                    <div class="modal fade" id="mediaModal{{ $post->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="mediaModalLabel{{ $post->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            {{-- modal-lg biar gede --}}
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediaModalLabel{{ $post->id }}">Detail Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                <label>Notes</label>
                                                <textarea class="form-control" rows="3" disabled>{{ $post->notes }}</textarea>
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
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#editSAModal">
                                                    Edit SA
                                                </button>
                                                <!-- Modal Edit SA -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit SA -->
                    <div class="modal fade modal-edit-sa-style" id="editSAModal" tabindex="-1" role="dialog"
                        aria-labelledby="editSAModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form class="form-marketing" id="edit-form" action="" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" id="post-id">
                                    <!-- Menyimpan ID post untuk edit -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSAModalLabel">Edit Post</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
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
                                                    <label for="content" class="form-label">Konten (Teks)</label>
                                                    <textarea class="form-control" name="content" id="content" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="created_at" class="form-label">Tanggal Upload</label>
                                                    <input type="date" class="form-control" name="created_at"
                                                        id="created_at" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="edit_content_media" class="form-label">Upload Gambar /
                                                        Video</label>
                                                    <input type="file" class="form-control d-none"
                                                        id="edit_content_media" name="content_media[]"
                                                        accept=".jpg, .jpeg, .png, .gif, .mp4, .mov, .webm" multiple>
                                                    <button type="button" class="btn btn-primary"
                                                        id="edit-add-file-btn">Add Gambar</button>
                                                </div>
                                                <div id="edit-preview-container" class="row mt-3"></div>
                                            </div>
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
                    {{-- End Modal Edit SA --}}
                    {{-- End Edit --}}
                @endforeach
            </div>
        </div>

    </main>
</x-clinet-layout>
