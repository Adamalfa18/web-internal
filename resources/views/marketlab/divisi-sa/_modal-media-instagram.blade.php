<div class="modal fade" id="mediaModal{{ $post->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mediaModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
        <div class="modal-content">
            <div class="modal-body">
                <div class="row form-marketing row-post-instagram" enctype="multipart/form-data">
                    <div class="col-md-6">
                        {{-- Carousel Dinamis --}}
                        @if ($post->media->count())
                            <div id="carouselIndicators{{ $post->id }}" class="carousel slide"
                                data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($post->media as $key => $media)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            @if (in_array(pathinfo($media->post, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
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
                    <div class="col-md-6">
                        <form>

                            <div class="form-group">
                                <label>Upload Date</label>
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
                                        <span class="badge badge-secondary">Pending Approval</span>
                                    @elseif ($firstMedia->postingan->status == 1)
                                        <span class="badge badge-success ">Approval</span>
                                    @elseif ($firstMedia->postingan->status == 2)
                                        <span class="badge badge-danger">Revisi</span>
                                    @elseif ($firstMedia->postingan->status == 3)
                                        <span class="badge badge-danger">Done</span>
                                    @else
                                        <span class="badge badge-secondary">Status Tidak
                                            Diketahui</span>
                                    @endif
                                </div>
                            @endif

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                </button>
                                <button type="button" class="btn btn-primary"
                                    onclick="$('#mediaModal{{ $post->id }}').modal('hide'); setTimeout(function(){$('#editSAModal{{ $post->id }}').modal('show');}, 500);">
                                    Edit Post
                                </button>
                                <a href="javascript:void(0);" class="btn btn-secondary"
                                    onclick="deletePost({{ $post->id }})" title="Hapus Post">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                    </svg>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
