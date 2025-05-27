<x-clinet-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.clientnavbar />
        <div class="container-fluid py-4 px-5">


            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <button id="btnTargetRoas" class="btn btn-primary btn-style-client" type="button"
                        onclick="setActiveTab('roas')">Laporan Harian Target Roas</button>
                </div>
                <div class="col-md-6">
                    <button id="btnTargetLead" class="btn btn-primary btn-style-client" type="button"
                        onclick="setActiveTab('lead')">Laporan Harian Target Lead</button>
                </div>
            </div>

            @php
                $activeTabLead = session('activeTabLead', 'roas'); // Default ke 'roas' jika tidak ada
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
                                                                    Total Spent
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
                                                                    Total Revenue
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
                                                                    Total Roas
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
                    <!-- Tombol Compare -->
                    <div class="row mb-3 justify-content-end">
                        <div class="col-auto">
                            <button class="btn btn-primary" onclick="toggleCompare()">Compare</button>
                        </div>
                    </div>

                    <!-- Form Compare -->
                    <div class="row justify-content-end" id="compareSection" style="display: none;">
                        <div class="col-auto">
                            <form id="compareForm" class="d-flex align-items-end justify-content-end"
                                style="gap: 10px;">
                                @csrf
                                <div class="d-flex flex-column">
                                    <label for="bulanCompare" class="form-label mb-1">Select Month to Compare:</label>
                                    <input type="month" id="bulanCompare" name="bulanCompare" class="form-control"
                                        required>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success">View</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <h6 class="font-weight-semibold text-lg mb-0">Spent</h6>
                                <p class="text-sm">Spent this month</p>
                            </div>
                            <div class="card-body">
                                <canvas id="chartSpent" height="100"></canvas>
                            </div>
                        </div>
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <h6 class="font-weight-semibold text-lg mb-0">Revenue</h6>
                                <p class="text-sm">Omzet this month</p>
                            </div>
                            <div class="card-body">
                                <canvas id="chartRevenue" height="100"></canvas>
                            </div>
                        </div>
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <h6 class="font-weight-semibold text-lg mb-0">ROAS</h6>
                                <p class="text-sm">ROAS this month</p>
                            </div>
                            <div class="card-body">
                                <canvas id="chartRoas" height="100"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Daily Report List</h6>
                                            <p class="text-sm">Market booster daily report</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body px-0 py-0">
                                    <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                                        <form id="perPageForm" action="{{ route('data-client.laporan-harian') }}"
                                            method="GET" class="me-3">
                                            <input type="hidden" name="performance_bulanan_id"
                                                value="{{ $performanceBulananId }}">
                                            <!-- Tambahkan input tersembunyi untuk performance_bulanan_id -->
                                            <select name="perPage"
                                                onchange="document.getElementById('perPageForm').submit();"
                                                class="form-select form-lots lost-style">
                                                <option value="10"
                                                    {{ request('perPage') == 10 ? 'selected' : '' }}>
                                                    10
                                                </option>
                                                <option value="20"
                                                    {{ request('perPage') == 20 ? 'selected' : '' }}>
                                                    20
                                                </option>
                                                <option value="40"
                                                    {{ request('perPage') == 40 ? 'selected' : '' }}>
                                                    40
                                                </option>
                                                <option value="60"
                                                    {{ request('perPage') == 60 ? 'selected' : '' }}>
                                                    60
                                                </option>
                                                <option value="80"
                                                    {{ request('perPage') == 80 ? 'selected' : '' }}>
                                                    80
                                                </option>
                                                <option value="100"
                                                    {{ request('perPage') == 100 ? 'selected' : '' }}>
                                                    100
                                                </option>
                                            </select>
                                            {{-- Tambahkan input tersembunyi untuk status --}}
                                        </form>

                                    </div>
                                    <div class="table-responsive p-0">
                                        @if ($data->isEmpty())
                                            <p class="ntp">No data available.</p>
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
                                                            Date</th>

                                                        <th
                                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                            Topup Details</th>
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
                                                                    {{ \Carbon\Carbon::parse($item->hari)->format('Y-m-d') }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <button type="button"
                                                                    class="btn-style btn btn-info text-secondary font-weight-bold text-xs"
                                                                    data-bs-toggle="modal" data-bs-toggle="tooltip"
                                                                    data-bs-title="Detail"
                                                                    data-bs-target="#reportDetailModal{{ $item->id }}">
                                                                    View
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <div class="modal fade"
                                                            id="reportDetailModal{{ $item->id }}" tabindex="-1"
                                                            aria-labelledby="reportDetailModalLabel{{ $item->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-body"
                                                                        style="max-height: 80vh; overflow-y: auto;">
                                                                        <div class="modal-heade mb-2">
                                                                            <h5 class="modal-title"
                                                                                id="reportDetailModalLabel{{ $item->id }}">
                                                                                Daily Topup Details</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>

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

                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
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
                                            <h6 class="font-weight-semibold text-lg mb-0">Daily Report Lead List
                                            </h6>
                                            <p class="text-sm">Marketlab daily report lead list</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 py-0">

                                    <div class="table-responsive p-0">
                                        @if ($leads->isEmpty())
                                            <p class="ntp">No data available.</p>
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

                                                                <div class="modal fade"
                                                                    id="editLeadModal{{ $lead->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="editLeadModalLabel{{ $lead->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <div class="modal-header mb-3">
                                                                                    <h5 class="modal-title"
                                                                                        id="editLeadModalLabel{{ $lead->id }}">
                                                                                        Edit Data Lead</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>

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
                                                                                            required readonly>
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
                                                                                                    required readonly>
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
                                                                                        class="btn btn-primary">Save</button>
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
            document.addEventListener('DOMContentLoaded', function() {
                const filterNamaBrandMB = document.getElementById('filterNamaBrandMB');
                const filterTanggalAktipMB = document.getElementById('filterTanggalAktipMB');
                const rowsMB = document.querySelectorAll('.client-row-mb');

                // Hide rows that are NOT status 1 (aktif) on page load
                rowsMB.forEach(row => {
                    const statusMB = row.dataset.statusLayananMb;
                    if (statusMB != '1') {
                        row.style.display = 'none';
                    }
                });

                // Function to update row numbers
                function updateRowNumbers() {
                    let visibleCount = 1;
                    rowsMB.forEach(row => {
                        if (row.style.display !== 'none') {
                            row.querySelector('.row-number').textContent = visibleCount;
                            visibleCount++;
                        }
                    });
                }

                // Filter function
                function applyFilterMB() {
                    const namaBrandValueMB = filterNamaBrandMB.value.toLowerCase();
                    const tanggalValueMB = filterTanggalAktipMB.value;

                    rowsMB.forEach(row => {
                        const namaBrandMB = row.dataset.namaBrandMb;
                        const tanggalAktipMB = row.dataset.tanggalAktipMb;
                        const statusMB = row.dataset.statusLayananMb;

                        let showRowMB = true;

                        // Always hide if not active
                        if (statusMB != '1') {
                            showRowMB = false;
                        }

                        // Filter nama brand
                        if (namaBrandValueMB && !namaBrandMB.includes(namaBrandValueMB)) {
                            showRowMB = false;
                        }

                        // Filter tanggal aktip (exact match)
                        if (tanggalValueMB && tanggalAktipMB !== tanggalValueMB) {
                            showRowMB = false;
                        }

                        row.style.display = showRowMB ? '' : 'none';
                    });

                    // Update row numbers after filtering
                    updateRowNumbers();
                }

                filterNamaBrandMB.addEventListener('input', applyFilterMB);
                filterTanggalAktipMB.addEventListener('change', applyFilterMB);

                // Initial row number update
                updateRowNumbers();
            });
        </script>
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
    <script>
        function toggleCompare() {
            const compareSection = document.getElementById('compareSection');
            compareSection.style.display = compareSection.style.display === 'none' ? 'block' : 'none';
        }
        // Fungsi untuk mengatur tab aktif
        function setActiveTab(tab) {
            sessionStorage.setItem('activeTab', tab); // Simpan tab aktif di sessionStorage
            document.querySelectorAll('.collapse').forEach(collapse => {
                collapse.classList.remove('show'); // Sembunyikan semua tab
            });
            if (tab === 'lead') {
                document.getElementById('multiCollapseExample2').classList.add('show'); // Tampilkan tab Lead
            } else {
                document.getElementById('multiCollapseExample1').classList.add('show'); // Tampilkan tab Roas
            }
        }

        // Ambil tab aktif dari sessionStorage saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const activeTab = sessionStorage.getItem('activeTab') ||
                '{{ $activeTabLead }}'; // Ambil dari sessionStorage atau sesi
            setActiveTab(activeTab); // Atur tab aktif
        });
    </script>
    @php
        $shortLabels = [];
        $fullLabels = [];
        if (isset($data)) {
            foreach ($data as $item) {
                $shortLabels[] = \Carbon\Carbon::parse($item->hari)->format('j'); // hanya tanggal
                $fullLabels[] = \Carbon\Carbon::parse($item->hari)->format('j M'); // untuk tooltip
            }
        }
    @endphp
    <script>
        let chartSpent, chartRevenue, chartRoas;
        let compareLabels = [];

        const shortLabels = {!! json_encode($shortLabels) !!};
        const fullLabels = {!! json_encode($fullLabels) !!};



        function createChart(id, label1, data1, label2 = null, data2 = [], color1, color2) {
            const ctx = document.getElementById(id).getContext('2d');

            const config = {
                type: 'line',
                data: {
                    labels: shortLabels,
                    datasets: [{
                        label: label1,
                        data: data1,
                        borderColor: color1,
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                title: function(tooltipItems) {
                                    const index = tooltipItems[0].dataIndex;
                                    const datasetIndex = tooltipItems[0].datasetIndex;

                                    // datasetIndex 0 → data utama
                                    // datasetIndex 1 → data compare
                                    if (datasetIndex === 0) {
                                        return fullLabels[index];
                                    } else if (datasetIndex === 1) {
                                        return compareLabels[index] ?? shortLabels[index]; // fallback
                                    } else {
                                        return shortLabels[index];
                                    }
                                }
                            }
                        }

                    }
                }
            };

            if (label2 && data2.length) {
                config.data.datasets.push({
                    label: label2,
                    data: data2,
                    borderColor: color2,
                    fill: false,
                    tension: 0.1
                });
            }

            return new Chart(ctx, config);
        }


        function updateCharts(dataCompare) {
            // Hancurkan chart sebelumnya jika ada
            if (chartSpent) chartSpent.destroy();
            if (chartRevenue) chartRevenue.destroy();
            if (chartRoas) chartRoas.destroy();

            // Data original dari backend (data bulan ini)
            const spent = {!! json_encode($data->pluck('total')) !!};
            const revenue = {!! json_encode($data->pluck('omzet')) !!};
            const roas = {!! json_encode($data->pluck('roas')) !!};

            // Buat ulang chart dengan data perbandingan
            chartSpent = createChart('chartSpent', 'Spent', spent, 'Compare Spent', dataCompare.spent, 'rgb(255, 99, 132)',
                'rgb(255, 205, 86)');
            chartRevenue = createChart('chartRevenue', 'Revenue', revenue, 'Compare Revenue', dataCompare.revenue,
                'rgb(54, 162, 235)', 'rgb(153, 102, 255)');
            chartRoas = createChart('chartRoas', 'ROAS', roas, 'Compare ROAS', dataCompare.roas, 'rgb(75, 192, 192)',
                'rgb(201, 203, 207)');
        }


        document.getElementById('compareForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const bulan = document.getElementById('bulanCompare').value;
            const performanceId = document.querySelector('input[name="performance_bulanan_id"]').value;

            fetch(`/data-client/performa-harian/compare?bulan=${bulan}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    compareLabels = data.labels;
                    updateCharts(data);
                })
                .catch(error => {
                    console.error('Gagal ambil data compare:', error);
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi chart awal dengan data bulan ini
            chartSpent = createChart('chartSpent', 'Spent', {!! json_encode($data->pluck('total')) !!}, null, [], 'rgb(255, 99, 132)',
                '');
            chartRevenue = createChart('chartRevenue', 'Revenue', {!! json_encode($data->pluck('omzet')) !!}, null, [],
                'rgb(54, 162, 235)', '');
            chartRoas = createChart('chartRoas', 'ROAS', {!! json_encode($data->pluck('roas')) !!}, null, [], 'rgb(75, 192, 192)',
                '');
        });
    </script>

    </x-app-layout>
