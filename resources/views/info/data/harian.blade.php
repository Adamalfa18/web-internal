<x-clinet-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.clientnavbar />
        <div class="container-fluid py-4 px-5">


            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>

            <p class="d-inline-flex gap-1">
            <div class="row">
                <div class="col-md-6">
                    <button id="btnTargetRoas" class="btn btn-primary btn-style-client" type="button"
                        onclick="toggleCollapse('multiCollapseExample1', 'multiCollapseExample2', this)">Laporan Harian
                        Target Roas</button>
                </div>
                <div class="col-md-6">
                    <button id="btnTargetLead" class="btn btn-primary btn-style-client" type="button"
                        onclick="toggleCollapse('multiCollapseExample2', 'multiCollapseExample1', this)">Laporan Harian
                        Target Lead</button>
                </div>
            </div>
            </p>
            @php
                $activeTabLead = session('activeTabLead', 'roas'); // Default ke 'roas' jika tidak ada
                // dd($activeTabLead); // Pastikan ini mengembalikan 'lead' setelah edit
            @endphp

            <div class="collapse multi-collapse {{ $activeTabLead === 'roas' ? 'show' : '' }}"
                id="multiCollapseExample1">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card border shadow-xs mb-4">
                                <div class="card-header border-bottom">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <h6 class="font-weight-semibold text-lg mb-3">Data Target</h6>
                                            </div>
                                            <table class="table align-items-center mb-0">
                                                <tbody>
                                                    <tr class="border-target">
                                                        <td class="align-middle">
                                                            <div class="title-target-style">
                                                                <span class="text-sm font-weight-normal">
                                                                    Target Spent
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="target-style">
                                                                <span class="text-sm font-weight-normal">
                                                                    Rp
                                                                    {{ number_format($laporanBulanan->target_spent, 0, ',', '.') }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="border-target">
                                                        <td class="align-middle">
                                                            <div class="title-target-style">
                                                                <span class="text-sm font-weight-normal">
                                                                    Target Revenue
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="target-style">
                                                                <span class="text-sm font-weight-normal">
                                                                    Rp
                                                                    {{ number_format($laporanBulanan->target_revenue, 0, ',', '.') }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="border-target">
                                                        <td class="align-middle">
                                                            <div class="title-target-style">
                                                                <span class="text-sm font-weight-normal">
                                                                    Target Roas
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="target-style">
                                                                <span class="text-sm font-weight-normal">
                                                                    {{ $laporanBulanan->target_roas }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <h6 class="font-weight-semibold text-lg mb-3">Data Real</h6>
                                            </div>
                                            <table class="table align- mb-0">
                                                <tbody>
                                                    <tr class="border-target">
                                                        <td class="align-middle">
                                                            <div class="title-target-style">
                                                                <span class="text-sm font-weight-normal">
                                                                    Toltal Spent
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="real-spent real-style"
                                                                style="background: {{ $totalSum > $laporanBulanan->target_spent ? 'red' : 'green' }};">
                                                                <span class="text-sm font-weight-normal">
                                                                    Rp {{ number_format($totalSum, 0, ',', '.') }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="border-target">
                                                        <td class="align-middle">
                                                            <div class="title-target-style">
                                                                <span class="text-sm font-weight-normal">
                                                                    Toltal Revenue
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="real-omzet real-style"
                                                                style="background: {{ $totalOmzet < $laporanBulanan->target_spent ? 'red' : 'green' }};">
                                                                <span class="text-sm font-weight-normal">
                                                                    Rp {{ number_format($totalOmzet, 0, ',', '.') }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="border-target">
                                                        <td class="align-middle">
                                                            <div class="title-target-style">
                                                                <span class="text-sm font-weight-normal">
                                                                    Toltal Roas
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="real-roas real-style"
                                                                style="background: {{ $totalRoas < $laporanBulanan->target_roas ? 'red' : 'green' }};">
                                                                <span class="text-sm font-weight-normal">
                                                                    {{ $totalRoas }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="font-weight-semibold text-lg mb-3">Note</h6>
                                            <p class="text-sm note-style">{{ $laporanBulanan->note }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Daftar Laporan Harian</h6>
                                            <p class="text-sm">Berikut adalah list daftar laporan Harian</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body px-0 py-0">
                                    <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                                        <form id="perPageForm" action="{{ route('laporan-harian.index') }}"
                                            method="GET" class="me-3">
                                            <input type="hidden" name="performance_bulanan_id"
                                                value="{{ $performanceBulananId }}">
                                            <!-- Tambahkan input tersembunyi untuk performance_bulanan_id -->
                                            <select name="perPage"
                                                onchange="document.getElementById('perPageForm').submit();"
                                                class="form-select form-lots lost-style">
                                                <option value="10"
                                                    {{ request('perPage') == 10 ? 'selected' : '' }}>10
                                                </option>
                                                <option value="20"
                                                    {{ request('perPage') == 20 ? 'selected' : '' }}>20
                                                </option>
                                                <option value="40"
                                                    {{ request('perPage') == 40 ? 'selected' : '' }}>40
                                                </option>
                                                <option value="60"
                                                    {{ request('perPage') == 60 ? 'selected' : '' }}>60
                                                </option>
                                                <option value="80"
                                                    {{ request('perPage') == 80 ? 'selected' : '' }}>80
                                                </option>
                                                <option value="100"
                                                    {{ request('perPage') == 100 ? 'selected' : '' }}>100
                                                </option>
                                            </select>
                                            {{-- Tambahkan input tersembunyi untuk status --}}
                                        </form>

                                        <div class="input-group w-sm-25 ms-auto">
                                            <span class="input-group-text text-body">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="table-responsive p-0">
                                        @if ($data->isEmpty())
                                            <p class="ntp">Tidak ada data yang tersedia.</p>
                                        @else
                                            <table class="table align-items-center mb-0">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            No</th>
                                                        <th
                                                            class="text-secondary text-xs font-weight-semibold opacity-7">
                                                            Total</th>
                                                        <th
                                                            class="text-secondary text-xs font-weight-semibold opacity-7">
                                                            Omzet</th>
                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            Roas</th>
                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            Hari</th>

                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            Detail Topup</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td class="align-middle text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    Rp {{ number_format($item->total, 0, ',', '.') }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    Rp {{ number_format($item->omzet, 0, ',', '.') }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ $item->roas }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ $item->hari }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <button type="button"
                                                                    class="btn-style btn btn-info text-secondary font-weight-bold text-xs"
                                                                    data-bs-toggle="modal" data-bs-toggle="tooltip"
                                                                    data-bs-title="Detail"
                                                                    data-bs-target="#reportDetailModal{{ $item->id }}">
                                                                    Lihat Detai Topup
                                                                </button>
                                                            </td>

                                                        </tr>
                                                        <div class="modal fade"
                                                            id="reportDetailModal{{ $item->id }}" tabindex="-1"
                                                            aria-labelledby="reportDetailModalLabel{{ $item->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="reportDetailModalLabel{{ $item->id }}">
                                                                            Detail Topup Harian</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body"
                                                                        style="max-height: 70vh; overflow-y: auto;">
                                                                        <div class="container">
                                                                            <form>

                                                                                <div class="row topup-style">
                                                                                    @if ($item->meta_regular > 0 || $item->meta_cpas > 0)
                                                                                        <div class="title-harian">
                                                                                            <h5>Topup Meta</h5>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>Meta
                                                                                                    Regular</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->meta_regular, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>Meta CPAS</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->meta_cpas, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="row topup-style">
                                                                                    @if ($item->google_search > 0 || $item->google_gtm > 0 || $item->google_youtube > 0 || $item->google_performance_max > 0)
                                                                                        <div class="title-harian">
                                                                                            <h5>Topup Google</h5>
                                                                                        </div>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>Google
                                                                                                    Search</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->google_search, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>Google
                                                                                                    GTM</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->google_gtm, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>Google
                                                                                                    YouTube</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->google_youtube, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>Performance
                                                                                                    MAX</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->google_performance_max, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="row topup-style">
                                                                                    @if (
                                                                                        $item->shopee_manual > 0 ||
                                                                                            $item->shopee_auto_meta > 0 ||
                                                                                            $item->shopee_gmv > 0 ||
                                                                                            $item->shopee_toko > 0 ||
                                                                                            $item->shopee_live > 0)
                                                                                        <div class="title-harian">
                                                                                            <h5>Topup Shopee</h5>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>Shopee
                                                                                                    Manual</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->shopee_manual, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>Shopee Auto
                                                                                                    Meta</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->shopee_auto_meta, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Shopee
                                                                                                    GMV</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->shopee_gmv, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Shopee
                                                                                                    Toko</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->shopee_toko, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Shopee
                                                                                                    Live</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->shopee_live, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="row topup-style">
                                                                                    @if ($item->tokped_manual > 0 || $item->tokped_auto_meta > 0 || $item->tokped_toko > 0)
                                                                                        <div class="title-harian">
                                                                                            <h5>Topup Tokopedia</h5>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Tokped
                                                                                                    Manual</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->tokped_manual, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Tokped Auto
                                                                                                    Meta</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->tokped_auto_meta, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Tokped
                                                                                                    Toko</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->tokped_toko, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="row topup-style">
                                                                                    @if (
                                                                                        $item->tiktok_live_shopping > 0 ||
                                                                                            $item->tiktok_product_shopping > 0 ||
                                                                                            $item->tiktok_video_shopping > 0 ||
                                                                                            $item->tiktok_gmv_max > 0)
                                                                                        <div class="title-harian">
                                                                                            <h5>Topup Tiktok</h5>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>TikTok Live
                                                                                                    Shopping</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->tiktok_live_shopping, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>TikTok Product
                                                                                                    Shopping</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->tiktok_product_shopping, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>TikTok Video
                                                                                                    Shopping</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->tiktok_video_shopping, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label>TikTok GMV
                                                                                                    Max</label>
                                                                                                <div
                                                                                                    class="readonly-input">
                                                                                                    Rp
                                                                                                    {{ number_format($item->tiktok_gmv_max, 0, ',', '.') }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                    <div class="border-top py-3 px-3 d-flex align-items-center">
                                        <p class="font-weight-semibold mb-0 text-dark text-sm">
                                            Page {{ $data->currentPage() }} of {{ $data->lastPage() }}
                                        </p>
                                        <div class="ms-auto">
                                            @if ($data->onFirstPage())
                                                <button class="btn btn-sm btn-white mb-0" disabled>Previous</button>
                                            @else
                                                <a href="{{ $data->previousPageUrl() . '&performance_bulanan_id=' . $performanceBulananId }}"
                                                    class="btn btn-sm btn-white mb-0">Previous</a>
                                            @endif

                                            @if ($data->hasMorePages())
                                                <a href="{{ $data->nextPageUrl() . '&performance_bulanan_id=' . $performanceBulananId }}"
                                                    class="btn btn-sm btn-white mb-0">Next</a>
                                            @else
                                                <button class="btn btn-sm btn-white mb-0" disabled>Next</button>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Pagination links -->
                                    {{-- {{ $data->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse multi-collapse {{ $activeTabLead === 'lead' ? 'show' : '' }}"
                id="multiCollapseExample2">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Daftar Laporan Harian
                                                Lead
                                            </h6>
                                            <p class="text-sm">Berikut adalah list daftar laporan Harian Lead</p>
                                        </div>
                                        <div class="ms-auto d-flex">
                                            <a class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2"
                                                href="#" data-bs-toggle="modal"
                                                data-bs-target="#addLaporanModal" role="button">
                                                <span class="btn-inner--icon">
                                                    <svg width="16" height="16"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="d-block me-2">
                                                        <path
                                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                    </svg>
                                                </span>
                                                <span class="btn-inner--text">Add Laporan Harian Lead1</span>
                                            </a>
                                        </div>

                                        <!-- Modal untuk menambahkan data lead -->
                                        <div class="modal fade" id="addLaporanModal" tabindex="-1"
                                            aria-labelledby="addLaporanModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addLaporanModalLabel">Tambah Data
                                                            Lead</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('data-client.laporan-harian.store-lead') }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="performance_bulanan_id"
                                                                    class="form-label">Performance Bulanan
                                                                    ID</label>
                                                                <input type="text" class="form-control"
                                                                    id="performance_bulanan_id"
                                                                    name="performance_bulanan_id"
                                                                    value="{{ $laporanBulanan->id }}" readonly
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="hari" class="form-label">Hari</label>
                                                                <input type="date" class="form-control"
                                                                    id="hari" name="hari" required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="leads"
                                                                            class="form-label">Leads</label>
                                                                        <input type="text" value="0"
                                                                            class="form-control" id="leads"
                                                                            name="leads" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="chat"
                                                                            class="form-label">Chat</label>
                                                                        <input type="text" value="0"
                                                                            class="form-control" id="chat"
                                                                            name="chat" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="chat_respon"
                                                                            class="form-label">Chat
                                                                            Respon</label>
                                                                        <input type="text" value="0"
                                                                            class="form-control" id="chat_respon"
                                                                            name="chat_respon" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="chat_no_respon"
                                                                            class="form-label">Chat No
                                                                            Respon</label>
                                                                        <input type="text" value="0"
                                                                            class="form-control" id="chat_no_respon"
                                                                            name="chat_no_respon" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="closing"
                                                                            class="form-label">Closing</label>
                                                                        <input type="text" value="0"
                                                                            class="form-control" id="closing"
                                                                            name="closing" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="revenue"
                                                                            class="form-label">Revenue</label>
                                                                        <input type="text" value="0"
                                                                            class="form-control" id="revenue"
                                                                            name="revenue" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 py-0">
                                    <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                                        <div class="input-group w-sm-25 ms-auto">
                                            <span class="input-group-text text-body">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="table-responsive p-0">
                                        @if ($leads->isEmpty())
                                            <p class="ntp">Tidak ada data lead yang tersedia.</p>
                                        @else
                                            <table class="table align-items-center mb-0">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            No</th>
                                                        <th
                                                            class="text-secondary text-xs font-weight-semibold opacity-7">
                                                            Tanggal</th>
                                                        <th
                                                            class="text-secondary text-xs font-weight-semibold opacity-7">
                                                            Revenue</th>
                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            Leads</th>
                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            Chat</th>
                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            Chat Respon</th>
                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            Chat No Respon</th>
                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            Closing</th>
                                                        <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($leads as $lead)
                                                        <tr>
                                                            <td class="align-middle text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ $lead->hari }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ number_format($lead->revenue, 0, ',', '.') }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ $lead->leads }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ $lead->chat }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ $lead->chat_respon }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ $lead->chat_no_respon }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ $lead->closing }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a href="#" type="button"
                                                                    class="btn btn-primary text-secondary font-weight-bold text-xs active-client"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editLeadModal{{ $lead->id }}"
                                                                    data-bs-title="Edit user">
                                                                    <svg width="20" height="20"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        strokeWidth={1.5} stroke="currentColor"
                                                                        className="size-6">
                                                                        <path strokeLinecap="round"
                                                                            strokeLinejoin="round"
                                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                    </svg>
                                                                </a>

                                                                <!-- Modal untuk mengedit data lead -->
                                                                <div class="modal fade"
                                                                    id="editLeadModal{{ $lead->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="editLeadModalLabel{{ $lead->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="editLeadModalLabel{{ $lead->id }}">
                                                                                    Edit Data Lead</h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ route('data-client.laporan-harian.update-lead', $lead->id) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <input type="hidden"
                                                                                        name="activeTabLead"
                                                                                        value="lead">

                                                                                    <div class="mb-3">
                                                                                        <label for="hari"
                                                                                            class="form-label">Hari</label>
                                                                                        <input type="date"
                                                                                            class="form-control"
                                                                                            id="hari"
                                                                                            name="hari"
                                                                                            value="{{ $lead->hari }}"
                                                                                            required>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="leads"
                                                                                                    class="form-label">Leads</label>
                                                                                                <input type="number"
                                                                                                    class="form-control"
                                                                                                    id="leads"
                                                                                                    name="leads"
                                                                                                    value="{{ $lead->leads }}"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="chat"
                                                                                                    class="form-label">Chat</label>
                                                                                                <input type="number"
                                                                                                    class="form-control"
                                                                                                    id="chat"
                                                                                                    name="chat"
                                                                                                    value="{{ $lead->chat }}"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="chat_respon"
                                                                                                    class="form-label">Chat
                                                                                                    Respon</label>
                                                                                                <input type="number"
                                                                                                    class="form-control"
                                                                                                    id="chat_respon"
                                                                                                    name="chat_respon"
                                                                                                    value="{{ $lead->chat_respon }}"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="chat_no_respon"
                                                                                                    class="form-label">Chat
                                                                                                    No
                                                                                                    Respon</label>
                                                                                                <input type="number"
                                                                                                    class="form-control"
                                                                                                    id="chat_no_respon"
                                                                                                    name="chat_no_respon"
                                                                                                    value="{{ $lead->chat_no_respon }}"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="closing"
                                                                                                    class="form-label">Closing</label>
                                                                                                <input type="number"
                                                                                                    class="form-control"
                                                                                                    id="closing"
                                                                                                    name="closing"
                                                                                                    value="{{ $lead->closing }}"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="mb-3">
                                                                                                <label for="revenue"
                                                                                                    class="form-label">Revenue</label>
                                                                                                <input type="number"
                                                                                                    class="form-control"
                                                                                                    id="revenue"
                                                                                                    name="revenue"
                                                                                                    value="{{ $lead->revenue }}"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Simpan</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleCollapse(showId, hideId, activeButton) {
                var showElement = document.getElementById(showId);
                var hideElement = document.getElementById(hideId);

                // Mengubah warna tombol aktif
                document.querySelectorAll('.btn-style-client').forEach(function(btn) {
                    btn.classList.remove('active'); // Menghapus kelas aktif dari semua tombol
                });
                activeButton.classList.add('active'); // Menambahkan kelas aktif pada tombol yang ditekan

                // Menampilkan elemen yang dipilih dan menyembunyikan yang lain
                if (showElement.classList.contains('show')) {
                    showElement.classList.remove('show');
                } else {
                    showElement.classList.add('show');
                }
                hideElement.classList.remove('show');
            }
        </script>

    </main>

    </x-app-layout>
