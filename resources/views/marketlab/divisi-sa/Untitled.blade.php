<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">

            {{-- Error & Session --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Modal Add Post Instagram --}}
            @include('partials.modal-add-post-instagram')

            {{-- Top Buttons --}}
            <div class="d-flex gap-2 mb-3">
                <button id="btnInstagram" class="btn btn-sm btn-outline-primary active d-flex align-items-center gap-2"
                    onclick="showInstagram()">
                    <svg ...></svg>
                    <i class="fas fa-instagram"></i>Instagram
                </button>
                <button id="btnTiktok" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"
                    onclick="showTiktok()">
                    <svg ...></svg>
                    <i class="fab fa-tiktok"></i>TikTok
                </button>
                <button class="btn btn-style-sa" onclick="toggleView()">
                    <i class="fas fa-mobile-alt"></i> <span id="btnText">Ubah Preview</span>
                </button>
            </div>

            <div id="profileWrapper">
                {{-- Instagram Section --}}
                @include('partials.section-instagram')

                {{-- TikTok Section --}}
                @include('partials.section-tiktok')
            </div>

            {{-- Modal Add Post TikTok --}}
            @include('partials.modal-add-post-tiktok')

            {{-- Modal per Post Instagram --}}
            @foreach($posts as $post)
                <blade
                    include|(%26%2339%3Bpartials.modal-media-instagram%26%2339%3B%2C%20%5B%26%2339%3Bpost%26%2339%3B%20%3D%3E%20%24post%5D)%0D />
                <blade
                    include|(%26%2339%3Bpartials.modal-edit-instagram%26%2339%3B%2C%20%5B%26%2339%3Bpost%26%2339%3B%20%3D%3E%20%24post%5D)%0D />
            @endforeach

            {{-- Modal per Post TikTok --}}
            @foreach($tiktok as $tkpost)
                <blade
                    include|(%26%2339%3Bpartials.modal-media-tiktok%26%2339%3B%2C%20%5B%26%2339%3Btkpost%26%2339%3B%20%3D%3E%20%24tkpost%5D)%0D />
                <blade
                    include|(%26%2339%3Bpartials.modal-edit-tiktok%26%2339%3B%2C%20%5B%26%2339%3Btkpost%26%2339%3B%20%3D%3E%20%24tkpost%5D)%0D />
            @endforeach

        </div>

        {{-- Modal Profile Instagram --}}
        @include('partials.modal-profile-instagram')

        {{-- Modal Profile TikTok --}}
        @include('partials.modal-profile-tiktok')

        {{-- Modal Edit Profile TikTok --}}
        @include('partials.modal-edit-profile-tiktok')

        {{-- Modal Edit Profile Instagram --}}
        @include('partials.modal-edit-profile-instagram')

    </main>

    {{-- Scripts --}}
    <script>
        // ... All your JS code here, keep as is, or move to separate files for clarity

    </script>
</x-app-layout>
