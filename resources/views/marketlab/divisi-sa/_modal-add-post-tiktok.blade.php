{{-- Add Modal Tiktok --}}
<div class="modal fade" id="addTiktokModal" tabindex="-1" role="dialog" aria-labelledby="addTiktokModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header modal-header-add-tiktok">
                    <h5 class="modal-title" id="addTiktokModalLabel">Add Post Tiktok</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-marketing form-marketing-tiktok"
                    action="{{ route('divisi-sa.storeTiktok', ['client_id' => $client_id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
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
                                <label for="created_at" class="form-label">Upload Date</label>
                                <input type="date" class="form-control" name="created_at" id="created_at" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="content" class="form-label">Upload Media</label>
                                <p class="text-muted small mb-2">
                                    * Media format must be <strong>.webp</strong> for image or
                                    <strong>.webm</strong> for video
                                </p>
                                <input type="file" class="form-control d-none" id="tiktok_media"
                                    name="tiktok_media[]" accept=".webp, .webm" multiple>
                                <button type="button" class="btn btn-primary" id="add-file-btn-tiktok">Add
                                    Media</button>
                                <input type="file" class="form-control d-none" id="tiktok_cover" name="cover"
                                    accept=".webp">
                                <button type="button" class="btn btn-primary" id="add-cover-btn-tiktok">Add
                                    Cover</button>
                            </div>
                            <div id="preview-container-tiktok" class="row mt-3"></div>
                            <!-- Add progress bar -->
                            <div class="progress mt-3" style="display: none;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    style="width: 0%"></div>
                            </div>
                            <div class="text-center mt-2" id="upload-status" style="display: none;">
                                <small class="text-muted">Uploading... <span id="upload-percentage">0</span>%</small>
                            </div>
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
