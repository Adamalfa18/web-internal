<aside class="sidenav navbar-style navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start "
    id="sidenav-main">
    <div class="sidenav-header mt-5">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
            href=" https://demos.creative-tim.com/corporate-ui-dashboard/pages/dashboard.html " target="_blank">
            <div class="dasboad-marketlab">
                <span class="font-weight-bold text-lg">Internal Hub</span>
                <span class="style-marketlab">By Marketlab</span>
            </div>
        </a>
    </div>
    <!-- Sidebar Start -->
    <div class="collapse navbar-collapse px-style w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{-- Dasboard --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <!-- Icon for account -->
                    </div>
                    <span class="font-weight-normal text-md ms-2">Dashboard</span>
                </a>
            </li>

            <!-- Marketing -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ in_array(Route::currentRouteName(), ['marketing.index', 'dashboard.marketing', 'clients.index', 'clients.create', 'clients.edit']) ? 'active' : '' }}"
                    href="#" id="dropdownMarketing" data-bs-toggle="dropdown" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>dashboard</title>
                            <g id="dashboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="template" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 L24,5.14285714 C24,6.08962286 23.2325143,6.85714286 22.2857143,6.85714286 L1.71428571,6.85714286 C0.76752,6.85714286 0,6.08962286 0,5.14285714 L0,1.71428571 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M0,12 C0,11.0532171 0.76752,10.2857143 1.71428571,10.2857143 L12,10.2857143 C12.9468,10.2857143 13.7142857,11.0532171 13.7142857,12 L13.7142857,22.2857143 C13.7142857,23.2325143 12.9468,24 12,24 L1.71428571,24 C0.76752,24 0,23.2325143 0,22.2857143 L0,12 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M18.8571429,10.2857143 C17.9103429,10.2857143 17.1428571,11.0532171 17.1428571,12 L17.1428571,22.2857143 C17.1428571,23.2325143 17.9103429,24 18.8571429,24 L22.2857143,24 C23.2325143,24 24,23.2325143 24,22.2857143 L24,12 C24,11.0532171 23.2325143,10.2857143 22.2857143,10.2857143 L18.8571429,10.2857143 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Marketing</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMarketing">
                    <li><a class="dropdown-item {{ is_current_route('dashboard.marketing') ? 'active' : '' }}"
                            href="{{ route('dashboard.marketing') }}">Dashboard</a></li>
                    <li><a class="dropdown-item {{ is_current_route('marketing.index') ? 'active' : '' }}"
                            href="{{ route('marketing.index') }}">Layanan</a></li>
                    <li><a class="dropdown-item {{ in_array(Route::currentRouteName(), ['clients.index', 'clients.create', 'clients.edit']) ? 'active' : '' }}"
                            href="{{ route('clients.index') }}">Client</a></li>
                </ul>
            </li>

            <!-- Client MB -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ in_array(Route::currentRouteName(), ['dashboard.mb', 'clients-mb.index', 'laporan-bulanan.index', 'laporan-harian.index']) ? 'active' : '' }}"
                    href="#" id="dropdownClientMB" data-bs-toggle="dropdown" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>dashboard</title>
                            <g id="dashboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="template" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 L24,5.14285714 C24,6.08962286 23.2325143,6.85714286 22.2857143,6.85714286 L1.71428571,6.85714286 C0.76752,6.85714286 0,6.08962286 0,5.14285714 L0,1.71428571 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M0,12 C0,11.0532171 0.76752,10.2857143 1.71428571,10.2857143 L12,10.2857143 C12.9468,10.2857143 13.7142857,11.0532171 13.7142857,12 L13.7142857,22.2857143 C13.7142857,23.2325143 12.9468,24 12,24 L1.71428571,24 C0.76752,24 0,23.2325143 0,22.2857143 L0,12 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M18.8571429,10.2857143 C17.9103429,10.2857143 17.1428571,11.0532171 17.1428571,12 L17.1428571,22.2857143 C17.1428571,23.2325143 17.9103429,24 18.8571429,24 L22.2857143,24 C23.2325143,24 24,23.2325143 24,22.2857143 L24,12 C24,11.0532171 23.2325143,10.2857143 22.2857143,10.2857143 L18.8571429,10.2857143 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Client MB</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownClientMB">
                    <li><a class="dropdown-item {{ is_current_route('dashboard.mb') ? 'active' : '' }}"
                            href="{{ route('dashboard.mb') }}">Dashboard</a></li>
                    <li><a class="dropdown-item {{ in_array(Route::currentRouteName(), ['clients-mb.index', 'laporan-bulanan.index', 'laporan-bulanan.create', 'laporan-bulanan.edit', 'laporan-harian.index', 'laporan-harian.create', 'laporan-harian.edit']) ? 'active' : '' }}"
                            href="{{ route('clients-mb.index') }}">Client MB</a></li>
                </ul>
            </li>

            <!-- Client SA -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ in_array(Route::currentRouteName(), ['dashboard.sa', 'list-client-sa.index', 'divisi-sa.index']) ? 'active' : '' }}"
                    href="#" id="dropdownClientSA" data-bs-toggle="dropdown" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>dashboard</title>
                            <g id="dashboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="template" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 L24,5.14285714 C24,6.08962286 23.2325143,6.85714286 22.2857143,6.85714286 L1.71428571,6.85714286 C0.76752,6.85714286 0,6.08962286 0,5.14285714 L0,1.71428571 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M0,12 C0,11.0532171 0.76752,10.2857143 1.71428571,10.2857143 L12,10.2857143 C12.9468,10.2857143 13.7142857,11.0532171 13.7142857,12 L13.7142857,22.2857143 C13.7142857,23.2325143 12.9468,24 12,24 L1.71428571,24 C0.76752,24 0,23.2325143 0,22.2857143 L0,12 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M18.8571429,10.2857143 C17.9103429,10.2857143 17.1428571,11.0532171 17.1428571,12 L17.1428571,22.2857143 C17.1428571,23.2325143 17.9103429,24 18.8571429,24 L22.2857143,24 C23.2325143,24 24,23.2325143 24,22.2857143 L24,12 C24,11.0532171 23.2325143,10.2857143 22.2857143,10.2857143 L18.8571429,10.2857143 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Client SA</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownClientSA">
                    <li><a class="dropdown-item {{ is_current_route('dashboard.sa') ? 'active' : '' }}"
                            href="{{ route('dashboard.sa') }}">Dashboard</a></li>
                    <li><a class="dropdown-item {{ in_array(Route::currentRouteName(), ['list-client-sa.index', 'divisi-sa.index']) ? 'active' : '' }}"
                            href="{{ route('list-client-sa.index') }}">Client SA</a></li>
                </ul>
            </li>

            <!-- Account -->
            @if (!in_array(auth()->user()->user_role_id, [3, 4, 5]))
                <li class="nav-item">
                    <a class="nav-link {{ in_array(Route::currentRouteName(), ['acount.index', 'acount.create', 'acount.edit']) ? 'active' : '' }}"
                        href="{{ route('acount.index') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <!-- Icon for account -->
                        </div>
                        <span class="font-weight-normal text-md ms-2">Account Pages</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
    <!-- Sidebar End -->

    <!-- JS for auto open dropdown if active -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Find all nav links with dropdown-toggle class
            var dropdownLinks = document.querySelectorAll('.nav-link.dropdown-toggle');

            dropdownLinks.forEach(function(link) {
                // Check if this link already active
                if (link.classList.contains('active')) {
                    // Open its parent dropdown
                    var dropdownMenu = link.nextElementSibling;
                    if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                        dropdownMenu.classList.add('show');
                    }
                }
            });
        });
    </script>


    <div class="sidenav-header mt-5">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
            href=" https://demos.creative-tim.com/corporate-ui-dashboard/pages/dashboard.html " target="_blank">
            <div class="dasboad-marketlab">
                <img class="width-logo" src="{{ asset('assets/img/marketlab.png') }}" alt="">
                <span>V 1.0</span>
            </div>
        </a>
    </div>

</aside>
