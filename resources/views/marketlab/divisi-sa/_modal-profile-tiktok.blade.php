{{-- MODAL PROFILE TIKTOK --}}
<div class="modal fade" id="addPofileTiktokModal" tabindex="-1" role="dialog" aria-labelledby="addPofileTiktokModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header modal-edit-profile-tiktok">
                    {{-- <div class="profile-tiktok"> --}}
                    <h5 class="modal-title">Edit Profile Tiktok</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php $isDisabled = $profileTiktok ? 'disabled' : ''; @endphp

                @if ($profileTiktok)
                    <div class="alert alert-info">Profile sudah diisi</div>
                @endif

                <form action="{{ route('divisi-sa.storeProfileTiktok', ['client_id' => $client_id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($profileTiktok)
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="tiktok_username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="tiktok_username" required
                                value="{{ $profileTiktok->username ?? '' }}" {{ $isDisabled }}>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="tiktok_name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="tiktok_name" required
                                value="{{ $profileTiktok->name ?? '' }}" {{ $isDisabled }}>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="tiktok_followers" class="form-label">Followers</label>
                            <input type="text" class="form-control" name="followers" id="tiktok_followers" required
                                value="{{ $profileTiktok->followers ?? '' }}" {{ $isDisabled }}>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="tiktok_following" class="form-label">Following</label>
                            <input type="text" class="form-control" name="following" id="tiktok_following" required
                                value="{{ $profileTiktok->following ?? '' }}" {{ $isDisabled }}>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="tiktok_likes" class="form-label">Likes</label>
                            <input type="text" class="form-control" name="likes" id="tiktok_likes" required
                                value="{{ $profileTiktok->likes ?? '' }}" {{ $isDisabled }}>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tiktok_bio" class="form-label">Bio</label>
                        <textarea class="form-control" name="bio" id="tiktok_bio" rows="3" required {{ $isDisabled }}>{{ $profileTiktok->bio ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Link</label>
                        <button type="button" class="btn btn-primary btn-sm mb-2 add-link-btn"
                            data-target="#tiktok-links-container" {{ $isDisabled }}>Add Link</button>
                        <div id="tiktok-links-container" class="mt-2">
                            @if ($profileTiktok && $profileTiktok->links)
                                @foreach ($profileTiktok->links as $index => $link)
                                    <div class="mb-2 row align-items-center">
                                        <div class="col-md-5">
                                            <input class="form-control mb-1" name="links[{{ $index }}][url]"
                                                placeholder="URL" required value="{{ $link->url }}"
                                                {{ $isDisabled }}>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control mb-1" name="links[{{ $index }}][name]"
                                                placeholder="Nama Link" required value="{{ $link->name }}"
                                                {{ $isDisabled }}>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-link-btn"
                                                {{ $isDisabled }}><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('list-client-sa.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary" {{ $isDisabled }}>Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- END TIKTOK --}}
<!-- Modal Edit Profile TikTok -->
<div class="modal fade" id="editProfileModalTiktok" tabindex="-1" role="dialog"
    aria-labelledby="editProfileModalTiktokLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header modal-edit-profile-tiktok">
                    <h5 class="modal-title">Edit Profile TikTok</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                @if (!$profileTiktok)
                    <div class="alert alert-warning">Profile TikTok belum diisi untuk
                        <strong>{{ $client->nama_brand }}</strong>.
                    </div>
                @else
                    <form action="{{ route('divisi-sa.updateProfileTiktok', ['client_id' => $client_id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required
                                value="{{ $profileTiktok->username }}">
                        </div>

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required
                                value="{{ $profileTiktok->name }}">
                        </div>

                        <div class="mb-3">
                            <label>Followers</label>
                            <input type="text" name="followers" class="form-control" required
                                value="{{ $profileTiktok->followers }}">
                        </div>

                        <div class="mb-3">
                            <label>Following</label>
                            <input type="text" name="following" class="form-control" required
                                value="{{ $profileTiktok->following }}">
                        </div>

                        <div class="mb-3">
                            <label>Likes</label>
                            <input type="text" name="likes" class="form-control" required
                                value="{{ $profileTiktok->likes }}">
                        </div>

                        <div class="mb-3">
                            <label>Bio</label>
                            <textarea name="bio" class="form-control" rows="3" required>{{ $profileTiktok->bio }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Link</label>
                            <button type="button" id="add-link-btn-modal-tiktok"
                                class="btn btn-sm btn-primary mb-2">Add Link</button>
                            <div id="links-container-modal-tiktok">
                                @foreach ($profileTiktok->links as $index => $link)
                                    <div class="mb-2 row align-items-center">
                                        <div class="col-md-5">
                                            <input name="links[{{ $index }}][url]" class="form-control"
                                                value="{{ $link->url }}" required placeholder="URL">
                                        </div>
                                        <div class="col-md-5">
                                            <input name="links[{{ $index }}][name]" class="form-control"
                                                value="{{ $link->name }}" required placeholder="Nama Link">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-link-btn"><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
