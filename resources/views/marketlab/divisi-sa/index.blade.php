<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            {{-- Alert --}}
            @include('marketlab.divisi-sa._alert')

            {{-- Modal Add Post --}}
            @include('marketlab.divisi-sa._modal-add-post', ['client_id' => $client_id])

            {{-- Tombol Filter & Preview --}}
            @include('marketlab.divisi-sa._toolbar')

            <div id="profileWrapper" class="">
                <!-- Instagram Page -->
                @include('marketlab.divisi-sa._section-instagram')
                {{-- TikTok Section --}}
                @include('marketlab.divisi-sa._section-tiktok')
            </div>
            {{-- Modal Add Post TikTok --}}
            @include('marketlab.divisi-sa._modal-add-post-tiktok')
            {{-- Modal per Post *Instagram --}}

            @foreach ($posts as $post)
                @include('marketlab.divisi-sa._modal-media-instagram', compact('post', 'post_medias'))
                @include('marketlab.divisi-sa._modal-edit-instagram', compact('post'))
            @endforeach
            {{-- End modal Media Instagram --}}

            {{-- Modal per Post *Tiktok --}}
            @foreach ($tiktok as $tkpost)
                @include('marketlab.divisi-sa._modal-media-tiktok', compact('tkpost', 'tiktok_medias'))
                @include('marketlab.divisi-sa._modal-edit-tiktok', compact('tkpost'))
            @endforeach
            {{-- End modal Media Instagram --}}
        </div>
        {{-- Modal Profile Instagram --}}
        @include('marketlab.divisi-sa._modal-profile-instagram', [
            'profileIG' => $profileIG,
            'client_id' => $client_id,
            'client' => $client,
        ])
        {{-- Modal Profile TikTok --}}
        @include('marketlab.divisi-sa._modal-profile-tiktok', [
            'profileTiktok' => $profileTiktok,
            'client_id' => $client_id,
            'client' => $client,
        ])
        </div>
    </main>
    <!-- JavaScript -->
    @include('marketlab.divisi-sa._scripts')


</x-app-layout>
