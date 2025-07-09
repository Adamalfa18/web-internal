 {{-- MODAL PROFILE INSTAGRAM --}}
 <div class="modal fade" id="addProfileIGModal" tabindex="-1" role="dialog" aria-labelledby="addProfileIGModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-body">
                 <div class="modal-header header-profile-instagram">
                     <h5 class="modal-title">Edit Profile Instagram</h5>
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

                 @php $isDisabled = $profileIG ? 'disabled' : ''; @endphp

                 @if ($profileIG)
                     <div class="alert alert-info">Profile sudah diisi</div>
                 @endif

                 <form action="{{ route('divisi-sa.storeProfile', ['client_id' => $client_id]) }}" method="POST"
                     enctype="multipart/form-data">
                     @csrf
                     @if ($profileIG)
                         @method('PUT')
                     @endif

                     <div class="row">
                         <div class="mb-3 col-md-6">
                             <label for="ig_username" class="form-label">Username</label>
                             <input type="text" class="form-control" name="username" id="ig_username" required
                                 value="{{ $profileIG->username ?? '' }}" {{ $isDisabled }}>
                         </div>
                         <div class="mb-3 col-md-6">
                             <label for="ig_name" class="form-label">Name</label>
                             <input type="text" class="form-control" name="name" id="ig_name" required
                                 value="{{ $profileIG->name ?? '' }}" {{ $isDisabled }}>
                         </div>
                     </div>

                     <div class="row">
                         <div class="mb-3 col-md-6">
                             <label for="ig_followers" class="form-label">Followers</label>
                             <input type="text" class="form-control" name="followers" id="ig_followers" required
                                 value="{{ $profileIG->followers ?? '' }}" {{ $isDisabled }}>
                         </div>
                         <div class="mb-3 col-md-6">
                             <label for="ig_following" class="form-label">Following</label>
                             <input type="text" class="form-control" name="following" id="ig_following" required
                                 value="{{ $profileIG->following ?? '' }}" {{ $isDisabled }}>
                         </div>
                     </div>

                     <div class="mb-3">
                         <label for="ig_bio" class="form-label">Bio</label>
                         <textarea class="form-control" name="bio" id="ig_bio" rows="3" required {{ $isDisabled }}>{{ $profileIG->bio ?? '' }}</textarea>
                     </div>

                     <div class="mb-3">
                         <label class="form-label">Link</label>
                         <button type="button" class="btn btn-primary btn-sm mb-2 add-link-btn"
                             data-target="#ig-links-container" {{ $isDisabled }}>Add Link</button>
                         <div id="ig-links-container" class="mt-2">
                             @if ($profileIG && $profileIG->links)
                                 @foreach ($profileIG->links as $index => $link)
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
 {{-- END IG --}}
 <!-- Modal Edit Profile Instagram -->
 <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-body">
                 <div class="modal-header header-profile-instagram">
                     <h5 class="modal-title">Edit Profile Instagram</h5>
                     <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                 </div>
                 @if (!$profileIG)
                     <div class="alert alert-warning">Profile Instagram belum diisi untuk
                         <strong>{{ $client->nama_brand }}</strong>.
                     </div>
                 @else
                     <form action="{{ route('divisi-sa.updateProfile', ['client_id' => $client_id]) }}"
                         method="POST" enctype="multipart/form-data">
                         @csrf
                         @method('PUT')

                         <div class="mb-3">
                             <label>Username</label>
                             <input type="text" name="username" class="form-control" required
                                 value="{{ $profileIG->username }}">
                         </div>

                         <div class="mb-3">
                             <label>Name</label>
                             <input type="text" name="name" class="form-control" required
                                 value="{{ $profileIG->name }}">
                         </div>

                         <div class="mb-3">
                             <label>Followers</label>
                             <input type="text" name="followers" class="form-control" required
                                 value="{{ $profileIG->followers }}">
                         </div>

                         <div class="mb-3">
                             <label>Following</label>
                             <input type="text" name="following" class="form-control" required
                                 value="{{ $profileIG->following }}">
                         </div>

                         <div class="mb-3">
                             <label>Bio</label>
                             <textarea name="bio" class="form-control" rows="3" required>{{ $profileIG->bio }}</textarea>
                         </div>

                         <div class="mb-3">
                             <label>Link</label>
                             <button type="button" id="add-link-btn-modal" class="btn btn-sm btn-primary mb-2">Add
                                 Link</button>
                             <div id="links-container-modal">
                                 @foreach ($profileIG->links as $index => $link)
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
