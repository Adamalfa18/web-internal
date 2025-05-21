<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
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

                    @php
                    $isDisabled = $profile ? 'disabled' : '';
                    @endphp

                    @if($profile)
                    <div class="alert alert-info">
                        Profile sudah diisi
                    </div>
                    @endif

                    <form class="form-marketing form-marketing-edit-profile-tiktok"
                        action="{{ route('divisi-sa.storeProfileTiktok', ['client_id' => $client_id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if($profile)
                        @method('PUT')
                        @endif

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required
                                    value="{{ $profile->username ?? '' }}" {{ $isDisabled }}>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required
                                    value="{{ $profile->name ?? '' }}" {{ $isDisabled }}>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="followers" class="form-label">Followers</label>
                                <input type="text" class="form-control" name="followers" id="followers" required
                                    value="{{ $profile->followers ?? '' }}" {{ $isDisabled }}>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="following" class="form-label">Following</label>
                                <input type="text" class="form-control" name="following" id="following" required
                                    value="{{ $profile->following ?? '' }}" {{ $isDisabled }}>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="likes" class="form-label">Likes</label>
                                <input type="text" class="form-control" name="likes" id="likes" required
                                    value="{{ $profile->likes ?? '' }}" {{ $isDisabled }}>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" name="bio" id="bio" rows="3" required {{ $isDisabled
                                }}>{{ $profile->bio ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <button type="button" class="btn btn-primary btn-sm mb-2" id="add-link-btn" {{ $isDisabled
                                }}>Add Link</button>
                            <div id="links-container" class="mt-2">
                                @if($profile && $profile->links)
                                @foreach($profile->links as $index => $link)
                                <div class="mb-2 row align-items-center">
                                    <div class="col-md-5">
                                        <input class="form-control mb-1" name="links[{{ $index }}][url]"
                                            placeholder="URL" required value="{{ $link->url }}" {{ $isDisabled }}>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control mb-1" name="links[{{ $index }}][name]"
                                            placeholder="Nama Link" required value="{{ $link->name }}" {{ $isDisabled
                                            }}>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-link-btn"
                                            title="Hapus Link" {{ $isDisabled }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
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
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addLinkBtn = document.getElementById("add-link-btn");
            const linksContainer = document.getElementById("links-container");
            let linkIndex = linksContainer.querySelectorAll('.row').length;
    
            @if(!$profile)
                // hanya aktif kalau profile belum ada
                addLinkBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    linkIndex++;
                    const linkGroup = document.createElement("div");
                    linkGroup.className = "mb-2 row align-items-center";
                    linkGroup.innerHTML = `
                        <div class="col-md-5">
                            <input class="form-control mb-1" name="links[${linkIndex}][url]" placeholder="URL" required>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control mb-1" name="links[${linkIndex}][name]" placeholder="Nama Link" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm remove-link-btn" title="Hapus Link">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                    linksContainer.appendChild(linkGroup);
                    linkGroup.querySelector(".remove-link-btn").addEventListener("click", function () {
                        linksContainer.removeChild(linkGroup);
                    });
                });
    
                // Hapus link existing
                linksContainer.querySelectorAll('.remove-link-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        btn.closest('.row').remove();
                    });
                });
            @endif
        });
    </script>
</x-app-layout>