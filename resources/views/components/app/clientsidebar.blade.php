<aside class="sidenav navbar-style navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start "
    id="sidenav-main">
    <div class="sidenav-header mt-5">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0" href="#" target="_blank">
            <div class="dasboad-marketlab">
                <span class="font-weight-bold text-lg">Marketlab Hub</span>
                <span class="style-marketlab">By Marketlab</span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse px-style  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link  {{ in_array(Route::currentRouteName(), ['data-client.index', 'data-client.laporan-harian', 'data-client.laporan-bulanan']) ? 'active' : '' }}"
                    href="{{ route('data-client.index') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>account</title>
                            <g id="account" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="view-grid" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                        clip-rule="evenodd" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="font-weight-normal text-md ms-2">Client</span>
                </a>
            </li>

        </ul>
    </div>

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
