<!-- Modal Add Post -->
<div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header header-add-post">
                    <h5 class="modal-title" id="addPostModalLabel">Add Post Instagram</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-marketing form-marketing-instagram"
                    action="{{ route('divisi-sa.store', ['client_id' => $client_id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" name="category" id="category"
                                    aria-label="Default select example" required>
                                    <option value="post">Post</option>
                                    <option value="reel">Reel</option>
                                    <option value="story">Story</option>
                                </select>
                            </div>
                        </div>
                    </div>
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
                                <input type="file" class="form-control d-none" id="content_media" name="content_media[]"
                                    accept=".webp, .webm" multiple>
                                <button type="button" class="btn btn-primary" id="add-file-btn">Add
                                    Media</button>
                                <input type="file" class="form-control d-none" id="cover" name="cover" accept=".webp">
                                <button type="button" class="btn btn-primary" id="add-cover-btn">Add
                                    Cover</button>
                            </div>
                            <div id="preview-container" class="row mt-3"></div>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Add Post -->