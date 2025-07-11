<div class="modal fade" id="tiktokmediaModal{{ $tkpost->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mediaModalLabel{{ $tkpost->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> {{-- modal-lg biar gede --}}
        <div class="modal-content">
            <div class="modal-body">
                <div class="row form-marketing row-post-tiktok" enctype="multipart/form-data">
                    <div class="col-md-6">
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
                                        data-bs-target="#carouselIndicators{{ $tkpost->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselIndicators{{ $tkpost->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <form>
                            {{-- tanggal upload --}}
                            <div class="form-group">
                                <label>Upload Date</label>
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

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                </button>
                                <button type="button" class="btn btn-primary"
                                    onclick="$('#mediaModal{{ $tkpost->id }}').modal('hide'); setTimeout(function(){$('#editSATiktokModal{{ $tkpost->id }}').modal('show');}, 500);">
                                    Edit Post
                                </button>
                                <a href="javascript:void(0);" class="btn btn-secondary"
                                    onclick="deletePostTiktok({{ $tkpost->id }})" title="Hapus Post">
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
