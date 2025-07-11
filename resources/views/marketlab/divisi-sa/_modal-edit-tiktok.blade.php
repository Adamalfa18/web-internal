<!-- Modal Edit Tiktok SA -->
<div class="modal fade modal-edit-sa-style" id="editSATiktokModal{{ $tkpost->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editSATiktokModalLabel{{ $tkpost->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-marketing form-marketing-edit-tiktok" id="edit-form-{{ $tkpost->id }}" method="POST"
                    action="{{ route('divisi-sa.updateTiktok', ['client_id' => $tkpost->client_id, 'post_id' => $tkpost->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $tkpost->id }}">
                    <div class="modal-header header-sa-tiktok-edit">
                        <h5 class="modal-title" id="editSATiktokModalLabel{{ $tkpost->id }}">Edit
                            Post Tiktok
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- Caption --}}
                    <div class="mb-3">
                        <label for="caption{{ $tkpost->id }}" class="form-label">Caption</label>
                        <textarea class="form-control" name="caption" id="caption{{ $tkpost->id }}"
                            required>{{ $tkpost->caption }}</textarea>
                    </div>
                    {{-- Tanggal Upload --}}
                    <div class="mb-3">
                        <label for="created_at{{ $tkpost->id }}" class="form-label">
                            Upload Date</label>
                        <input type="date" class="form-control" name="created_at" id="created_at{{ $tkpost->id }}"
                            value="{{ $tkpost->created_at->format('Y-m-d') }}" required>
                    </div>
                    {{-- Upload Media --}}
                    <div class="mb-3">
                        <label for="edit_content_media_tiktok{{ $tkpost->id }}" class="form-label">Media</label>
                        <div class="row mt-3" id="edit-preview-container-tiktok-{{ $tkpost->id }}">
                            @foreach ($tkpost->tiktok_media as $key => $tiktok_media)
                            <div class="col-md-4 mb-2 position-relative preview-item">
                                <input type="hidden" name="existing_media_ids[]" value="{{ $tiktok_media->id }}">
                                <button type="button"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-media"
                                    data-media-id="{{ $tiktok_media->id }}">
                                    &times;
                                </button>
                                @php
                                $ext = strtolower(
                                pathinfo($tiktok_media->media, PATHINFO_EXTENSION),
                                );
                                @endphp
                                @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                <video class="w-100" controls>
                                    <source src="{{ asset('storage/tiktok_media/' . $tiktok_media->media) }}"
                                        type="video/{{ $ext }}">
                                    Browser not support video.
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
                                id="edit_content_media_tiktok{{ $tkpost->id }}" data-id="{{ $tkpost->id }}"
                                name="tiktok_media[]" accept=".webp, .webm" multiple>
                            <button type="button" class="btn btn-primary edit-add-file-btn-tiktok"
                                data-id="{{ $tkpost->id }}">
                                Add Media
                            </button>
                        </div>
                        <div class="row mt-2 edit-preview-container-tiktok"
                            id="edit-preview-container-tiktok-{{ $tkpost->id }}">
                        </div>
                        <!-- Add progress bar -->
                        <div class="progress mt-3" style="display: none;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: 0%"></div>
                        </div>
                        <div class="text-center mt-2" id="upload-status" style="display: none;">
                            <small class="text-muted">Uploading... <span id="upload-percentage">0</span>%</small>
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
<!-- End Modal Edit Tiktok SA -->