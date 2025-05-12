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
            <!-- Modal Add Post -->

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
                                            <a id="toggleViewBtn" onclick="toggleMobileView()"
                                                class="btn btn-sm btn-secondary d-flex align-items-center">
                                                <i class="fas fa-mobile-alt me-2"></i>
                                                <span class="btn-text">Mode Mobile</span>
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
                            @php
                                $firstMedia = $post_medias->firstWhere('post_id', $post->id);
                            @endphp
                            <div class="gallery-item">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal{{ $post->id }}" target="_blank">
                                    @if ($post->cover)
                                        {{-- Tampilkan cover jika ada --}}
                                        @if (Str::endsWith($post->cover, '.webp'))
                                            <img src="{{ asset('storage/cover/' . $post->cover) }}" alt="Cover Image" class="img-fluid">
                                        @elseif (Str::endsWith($post->cover, '.webm'))
                                            <video width="100%" controls>
                                                <source src="{{ asset('storage/cover/' . $post->cover) }}" type="video/webm">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    @elseif ($firstMedia)
                                        {{-- Jika tidak ada cover, tampilkan media pertama --}}
                                        @if (Str::endsWith($firstMedia->post, '.webp'))
                                            <img src="{{ asset('storage/media/' . $firstMedia->post) }}" alt="Social Media" class="img-fluid">
                                        @elseif (Str::endsWith($firstMedia->post, '.webm'))
                                            <video width="100%" controls>
                                                <source src="{{ asset('storage/media/' . $firstMedia->post) }}" type="video/webm">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    @endif
                                </a>
                            </div>
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
                                                <button type="button" class="btn btn-primary" 
                                                    data-bs-toggle="modal" 
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
                                <form class="form-marketing" action="{{ route('data-client.update-sa', ['client_id' => $client->id, 'post_id' => $post->id]) }}" method="POST" id="editForm{{ $post->id }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSAModalLabel{{ $post->id }}">Edit Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            {{-- Carousel Dinamis --}}
                                            @if ($post->media->count())
                                                <div id="carouselIndicators{{ $post->id }}"
                                                    class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach ($post->media as $key => $media)
                                                            <div
                                                                class="carousel-item {{ $key == 0 ? 'active' : '' }}">
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
                                                    <input type="date" class="form-control" name="created_at" id="created_at" value="{{ $post->created_at->format('Y-m-d') }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="note">Note</label>
                                                    <textarea class="form-control" name="note" id="note" rows="3">{{ $post->note }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status">Status</label>
                                                    <select class="form-select" name="status" id="status" required>
                                                        <option value="">Pilih Status</option>
                                                        <option value="1" {{ $firstMedia && $firstMedia->postingan && $firstMedia->postingan->status == 1 ? 'selected' : '' }}>Acc</option>
                                                        <option value="2" {{ $firstMedia && $firstMedia->postingan && $firstMedia->postingan->status == 2 ? 'selected' : '' }}>Revisi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="saveButton{{ $post->id }}">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
                    {{-- End Edit --}}
                @endforeach
            </div>
        </div>

    </main>
</x-clinet-layout>
