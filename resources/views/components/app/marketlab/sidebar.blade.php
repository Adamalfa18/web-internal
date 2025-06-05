<aside class="sidenav navbar-style navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start "
    id="sidenav-main">
    <div class="sidenav-header mt-5">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0" href="{{ route('dashboard') }}" target="_blank">
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
            @auth
            @if (in_array(Auth::user()->user_role_id, [1, 2]))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <!-- Icon for account -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-window-sidebar {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-white' }}"
                            viewBox="0 0 16 16">
                            <path
                                d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                            <path
                                d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v2H1V3a1 1 0 0 1 1-1zM1 13V6h4v8H2a1 1 0 0 1-1-1m5 1V6h9v7a1 1 0 0 1-1 1z" />
                        </svg>
                    </div>
                    <span class="font-weight-normal text-md ms-2">Dashboard</span>
                </a>
            </li>
            @endif
            @endauth

            <!-- Marketing -->
            @auth
            @if (in_array(Auth::user()->user_role_id, [1, 2, 3]))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ in_array(Route::currentRouteName(), ['marketing.index', 'dashboard.marketing', 'clients.index', 'clients.create', 'clients.edit', 'marketing.edit']) ? 'active' : '' }}"
                    href="#" id="dropdownMarketing" data-bs-toggle="dropdown" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-square {{ in_array(Route::currentRouteName(), ['marketing.index', 'dashboard.marketing', 'clients.index', 'clients.create', 'clients.edit', 'marketing.edit']) ? 'text-primary' : 'text-white' }}"
                            viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path
                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Marketing</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMarketing">
                    <li><a class="dropdown-item {{ is_current_route('dashboard.marketing') ? 'active' : '' }}"
                            href="{{ route('dashboard.marketing') }}">Dashboard</a></li>
                    {{-- <li><a class="dropdown-item {{ is_current_route('marketing.index') ? 'active' : '' }}"
                            href="{{ route('marketing.index') }}">Layanan</a></li> --}}
                    <li><a class="dropdown-item {{ in_array(Route::currentRouteName(), ['marketing.index', 'marketing.edit']) ? 'active' : '' }}"
                            href="{{ route('marketing.index') }}">Layanan</a>
                    </li>
                    <li><a class="dropdown-item {{ in_array(Route::currentRouteName(), ['clients.index', 'clients.create', 'clients.edit']) ? 'active' : '' }}"
                            href="{{ route('clients.index') }}">Client</a></li>
                </ul>
            </li>
            @endif
            @endauth

            @auth
            @if (in_array(Auth::user()->user_role_id, [1, 2, 7, 8]))
            <!-- Client MB -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ in_array(Route::currentRouteName(), ['dashboard.mb', 'clients-mb.index', 'laporan-bulanan.index', 'laporan-harian.index']) ? 'active' : '' }}"
                    href="#" id="dropdownClientMB" data-bs-toggle="dropdown" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-speedometer {{ in_array(Route::currentRouteName(), ['dashboard.mb', 'clients-mb.index', 'laporan-bulanan.index', 'laporan-harian.index']) ? 'text-primary' : 'text-white' }}"
                            viewBox="0 0 16 16">
                            <path
                                d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2M3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.39.39 0 0 0-.029-.518z" />
                            <path fill-rule="evenodd"
                                d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.95 11.95 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Client MB</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownClientMB">
                    @if (Auth::user()->user_role_id != 8)
                    <li>
                        <a class="dropdown-item {{ is_current_route('dashboard.mb') ? 'active' : '' }}"
                            href="{{ route('dashboard.mb') }}">Dashboard</a>
                    </li>
                    @endif
                    <li>
                        <a class="dropdown-item {{ in_array(Route::currentRouteName(), ['clients-mb.index', 'laporan-bulanan.index', 'laporan-bulanan.create', 'laporan-bulanan.edit', 'laporan-harian.index', 'laporan-harian.create', 'laporan-harian.edit']) ? 'active' : '' }}"
                            href="{{ route('clients-mb.index') }}">Client MB</a>
                    </li>
                </ul>
            </li>
            @endif
            @endauth


            @auth
            @if (in_array(Auth::user()->user_role_id, [1, 2, 4, 5]))
            <!-- Client SA -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ in_array(Route::currentRouteName(), ['dashboard.sa', 'list-client-sa.index', 'divisi-sa.index']) ? 'active' : '' }}"
                    href="#" id="dropdownClientSA" data-bs-toggle="dropdown" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-phone {{ in_array(Route::currentRouteName(), ['dashboard.sa', 'list-client-sa.index', 'divisi-sa.index']) ? 'text-primary' : 'text-white' }}"
                            viewBox="0 0 16 16">
                            <path
                                d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Client SA</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownClientSA">
                    @if (Auth::user()->user_role_id != 5)
                    <li><a class="dropdown-item {{ is_current_route('dashboard.sa') ? 'active' : '' }}"
                            href="{{ route('dashboard.sa') }}">Dashboard</a></li>
                    @endif
                    <li><a class="dropdown-item {{ in_array(Route::currentRouteName(), ['list-client-sa.index', 'divisi-sa.index']) ? 'active' : '' }}"
                            href="{{ route('list-client-sa.index') }}">Client SA</a></li>
                </ul>
            </li>
            @endif
            @endauth


            <!-- Account -->
            @if (!in_array(auth()->user()->user_role_id, [2, 3, 4, 5, 7, 8, 9, 10]))
            <li class="nav-item">
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['acount.index', 'acount.create', 'acount.edit']) ? 'active' : '' }}"
                    href="{{ route('acount.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-person-lock {{ in_array(Route::currentRouteName(), ['acount.index', 'acount.create', 'acount.edit']) ? 'text-primary' : 'text-white' }}"
                            viewBox="0 0 16 16">
                            <path
                                d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m0 5.996V14H3s-1 0-1-1 1-4 6-4q.845.002 1.544.107a4.5 4.5 0 0 0-.803.918A11 11 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664zM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                        </svg>
                    </div>
                    <span class="font-weight-normal text-md ms-2">Account Pages</span>
                </a>
            </li>
            @endif

            {{-- version --}}
            @if (!in_array(auth()->user()->user_role_id, [2, 3, 4, 5, 7, 8, 9, 10]))
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'marketlab.version' ? 'active' : '' }}"
                    href="{{ route('marketlab.version') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-card-list {{ Route::currentRouteName() === 'marketlab.version' ? 'text-primary' : 'text-white' }}"
                            viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                        </svg>
                    </div>
                    <span class="font-weight-normal text-md ms-2">Version</span>
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
        <a class="navbar-brand d-flex align-items-center m-0" href="#" target="_blank">
            <div class="dasboad-marketlab">
                <img class="width-logo" src="{{ asset('assets/img/marketlab.png') }}" alt="">
                <span>V 2.0</span>
            </div>
        </a>
    </div>

</aside>