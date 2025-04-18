<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
            <div class="container-fluid py-4 px-5">

                <div class="profile-container">
                    <div class="profile-header">
                        {{-- <img src="{{ $user->profile_photo_url }}" class="profile-pic"> --}}
                        <img src="" class="profile-pic">
                        <div class="profile-info">
                            <div class="top-info">
                                <h2>Adam Alfarizi</h2>
                                <button>Edit Profile</button>
                                <button>View Archive</button>
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="stats">
                                <span><strong>testtt</strong> posts</span>
                                <span><strong>testtt</strong> followers</span>
                                <span><strong>testtt</strong> following</span>
                            </div>
                            <div class="real-name">Adam</div>
                        </div>
                    </div>
                    <div class="tabs">
                        <a href="#" class="active"><i class="fas fa-th"></i> POSTS</a>
                        <a href="#"><i class="far fa-bookmark"></i> SAVED</a>
                        <a href="#"><i class="far fa-user"></i> TAGGED</a>
                    </div>

                    <div class="gallery">
                        @foreach ($social_media as $media)
                            <div class="gallery-item">
                                <a href="{{ $media->content }}" target="_blank">
                                    <img src="{{ $media->content }}" alt="Social Media" class="img-fluid">
                                </a>
                            </div>
                        @endforeach
                    </div>                               
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
