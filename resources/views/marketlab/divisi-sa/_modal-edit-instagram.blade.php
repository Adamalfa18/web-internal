<!-- Modal Edit SA -->
<div class="modal fade modal-edit-sa-style" id="editSAModal{{ $post->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editSAModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-marketing form-marketing-edit" id="edit-form-{{ $post->id }}" method="POST"
                    action="{{ route('divisi-sa.update', ['client_id' => $post->client_id, 'post_id' => $post->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    <div class="modal-header modal-header-edit">
                        <h5 class="modal-title" id="editSAModalLabel{{ $post->id }}">Edit Post
                            Instagram
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    {{-- Caption --}}
                    <div class="mb-3">
                        <label for="caption{{ $post->id }}" class="form-label">Caption</label>
                        <textarea class="form-control" name="caption" id="caption{{ $post->id }}"
                            required>{{ $post->caption }}</textarea>
                    </div>
                    {{-- Tanggal Upload --}}
                    <div class="mb-3">
                        <label for="created_at{{ $post->id }}" class="form-label">
                            Upload Date</label>
                        <input type="date" class="form-control" name="created_at" id="created_at{{ $post->id }}"
                            value="{{ $post->created_at->format('Y-m-d') }}" required>
                    </div>
                    {{-- Upload Media --}}
                    <div class="mb-3">
                        <label for="edit_content_media{{ $post->id }}" class="form-label">Media</label>
                        <div class="row mt-3" id="edit-preview-container-{{ $post->id }}">
                            @foreach ($post->media as $key => $media)
                            <div class="col-md-4 mb-2 position-relative preview-item">
                                <input type="hidden" name="existing_media_ids[]" value="{{ $media->id }}">
                                <button type="button"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-media"
                                    data-media-id="{{ $media->id }}">
                                    &times;
                                </button>
                                @if (in_array(pathinfo($media->post, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
                                <video class="w-100" controls>
                                    <source src="{{ asset('storage/media/' . $media->post) }}" type="video/mp4">
                                    Browser not support video.
                                </video>
                                @else
                                <img src="{{ asset('storage/media/' . $media->post) }}" class="img-fluid rounded"
                                    alt="Media Post">
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-2">
                            <input type="file" class="form-control d-none edit-file-input"
                                id="edit_content_media{{ $post->id }}" data-id="{{ $post->id }}" name="content_media[]"
                                accept=".webp, .webm" multiple>
                            <button type="button" class="btn btn-primary edit-add-file-btn" data-id="{{ $post->id }}">
                                Add Media
                            </button>
                        </div>
                        <div class="row mt-2 edit-preview-container" id="edit-preview-container-{{ $post->id }}">
                        </div>
                    </div>
                    <!-- Add progress bar -->
                    <div class="progress mt-3" style="display: none;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            style="width: 0%"></div>
                    </div>
                    <div class="text-center mt-2" id="upload-status" style="display: none;">
                        <small class="text-muted">Uploading... <span id="upload-percentage">0</span>%</small>
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
<!-- End Modal Edit SA -->