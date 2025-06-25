<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 bor
    er-radius-lg ">
        <x-app.marketlab.navbar />
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
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-3 text-center">Monthly Target
                                            </h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <h6 class="font-weight-semibold text-lg mb-3 text-center">Data Target
                                                </h6>
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
                                                <h6 class="font-weight-semibold text-lg mb-3 text-center">Data Real</h6>
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
                                                                style="background: {{ $totalOmzet < $laporanBulanan->target_revenue ? 'red' : 'green' }};">
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
                                    </div>
                                    {{-- Note --}}
                                    <div class="col-12 mt-3">
                                        <h6 class="font-weight-semibold text-lg mb-3">Note
                                        </h6>
                                        <p class="text-sm note-style">{{ $laporanBulanan->note }}</p>
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
                        {{-- Card Spent --}}
                        <div class="col-md-6">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <h6 class="font-weight-semibold text-lg mb-0">Spent</h6>
                                    <p class="text-sm">Spent this month</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartSpent" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        {{-- Card Revenue --}}
                        <div class="col-md-6">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <h6 class="font-weight-semibold text-lg mb-0">Revenue</h6>
                                    <p class="text-sm">Revenue this month</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartRevenue" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <h6 class="font-weight-semibold text-lg mb-0">ROAS</h6>
                                <p class="text-sm">ROAS this month</p>
                            </div>
                            <div class="card-body">
                                <canvas id="chartRoas" height="100"></canvas>
                            </div>
                        </div> --}}
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
                                        <div class="ms-auto d-flex">
                                            <a class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2"
                                                href="{{ route('laporan-harian.create', ['performance_bulanan_id' => $laporanBulanan->id]) }}"
                                                role="button">
                                                <span class="btn-inner--icon">
                                                    <svg width="16" height="16"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="d-block me-2">
                                                        <path
                                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                    </svg>
                                                </span>
                                                <span class="btn-inner--text">Add Daily Report</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 py-0">
                                    <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                                        <form id="perPageForm" action="{{ route('laporan-harian.index') }}"
                                            method="GET" class="me-3">
                                            <input type="hidden" name="performance_bulanan_id"
                                                value="{{ $performanceBulananId }}">
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
                                                    {{ request('perPage') == 100 ? 'selected' : '' }}>100
                                                </option>
                                            </select>
                                        </form>
                                    </div>

                                    <div class="table-responsive p-0">
                                        @if ($data->isEmpty())
                                            <p class="ntp">No data available.</p>
                                        @else
                                            <table class="table align-items-center mb-0">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <th class="text-center text-xs font-weight-semibold opacity-7">
                                                            No
                                                        </th>
                                                        <th class="text-xs font-weight-semibold opacity-7">Total Spent
                                                        </th>
                                                        <th class="text-xs font-weight-semibold opacity-7">Total
                                                            Revenue
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold opacity-7">
                                                            Roas
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold opacity-7">
                                                            Date
                                                        </th>
                                                        <th class="text-center text-xs font-weight-semibold opacity-7">
                                                            Topup
                                                            Details</th>
                                                        <th class="text-xs opacity-7"></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td class="text-center">
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    Rp {{ number_format($item->total, 0, ',', '.') }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="day-style text-sm font-weight-normal">
                                                                    Rp {{ number_format($item->omzet, 0, ',', '.') }}
                                                                </span>
                                                            </td>
                                                            <td class="text-center">
                                                                <span
                                                                    class="day-style text-sm font-weight-normal">{{ $item->roas }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                <span
                                                                    class="day-style text-sm font-weight-normal">{{ $item->hari }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button"
                                                                    class="btn-style btn btn-info text-secondary font-weight-bold text-xs"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#reportDetailModal{{ $item->id }}">
                                                                    View Detail
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('laporan-harian.edit', $item->id) }}"
                                                                    type="button"
                                                                    class="btn btn-primary text-secondary font-weight-bold text-xs active-client"
                                                                    data-bs-toggle="tooltip"
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

                                                                <form
                                                                    action="{{ route('laporan-harian.destroy', $item->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn-style btn btn-danger text-secondary font-weight-bold text-xs"
                                                                        data-bs-toggle="tooltip" data-bs-title="Hapus"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                                        <svg width="20" height="20"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            strokeWidth={1.5} stroke="currentColor"
                                                                            class="size-6">
                                                                            <path strokeLinecap="round"
                                                                                strokeLinejoin="round"
                                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
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

                                    {{-- MODALS --}}
                                    @foreach ($data as $item)
                                        <div class="modal fade" id="reportDetailModal{{ $item->id }}"
                                            tabindex="-1"
                                            aria-labelledby="reportDetailModalLabel{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header m-3">
                                                        <h5 class="modal-title"
                                                            id="reportDetailModalLabel{{ $item->id }}">
                                                            Daily Topup & Target Harian Details
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                    </div>

                                                    <div class="modal-body"
                                                        style="max-height: 80vh; overflow-y: auto;">
                                                        <div class="container">

                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h6
                                                                        class="font-weight-semibold text-lg mb-3 text-center">
                                                                        Target Harian</h6>
                                                                </div>

                                                                {{-- Data Target --}}
                                                                <div class="col-md-6">
                                                                    <h6
                                                                        class="font-weight-semibold text-lg mb-3 text-center">
                                                                        Data Target</h6>
                                                                    <table class="table align-items-center mb-0">
                                                                        <tbody>
                                                                            <tr class="border-target">
                                                                                <td class="align-middle">
                                                                                    <div class="title-target-style">
                                                                                        <span
                                                                                            class="text-sm font-weight-normal">Target
                                                                                            Spent</span>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="align-middle">
                                                                                    <div class="target-style"><span
                                                                                            class="text-sm font-weight-normal">Rp
                                                                                            {{ number_format($spent_harian, 0, ',', '.') }}</span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="border-target">
                                                                                <td class="align-middle">
                                                                                    <div class="title-target-style">
                                                                                        <span
                                                                                            class="text-sm font-weight-normal">Target
                                                                                            Revenue</span>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="align-middle">
                                                                                    <div class="target-style"><span
                                                                                            class="text-sm font-weight-normal">Rp
                                                                                            {{ number_format($revenue_harian, 0, ',', '.') }}</span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="border-target">
                                                                                <td class="align-middle">
                                                                                    <div class="title-target-style">
                                                                                        <span
                                                                                            class="text-sm font-weight-normal">Target
                                                                                            Roas</span>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="align-middle">
                                                                                    <div class="target-style"><span
                                                                                            class="text-sm font-weight-normal">{{ $laporanBulanan->target_roas }}</span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                {{-- Data Real --}}
                                                                <div class="col-md-6">
                                                                    <h6
                                                                        class="font-weight-semibold text-lg mb-3 text-center">
                                                                        Data Real</h6>
                                                                    <table class="table align-items-center mb-0">
                                                                        <tbody>
                                                                            <tr class="border-target">
                                                                                <td class="align-middle">
                                                                                    <div class="title-target-style">
                                                                                        <span
                                                                                            class="text-sm font-weight-normal">
                                                                                            Spent Achieved</span>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="align-middle">
                                                                                    <div class="real-spent real-style"
                                                                                        style="background: {{ $spent_harian > $item->total ? 'green' : 'red' }};">
                                                                                        <span
                                                                                            class="text-sm font-weight-normal">
                                                                                            Rp
                                                                                            {{ number_format($item->total, 0, ',', '.') }}
                                                                                        </span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="border-target">
                                                                                <td class="align-middle">
                                                                                    <div class="title-target-style">
                                                                                        <span
                                                                                            class="text-sm font-weight-normal">
                                                                                            Revenue Achieved</span>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="align-middle">
                                                                                    <div class="real-omzet real-style"
                                                                                        style="background: {{ $revenue_harian < $item->omzet ? 'green' : 'red' }};">
                                                                                        <span
                                                                                            class="text-sm font-weight-normal">
                                                                                            Rp
                                                                                            {{ number_format($item->omzet, 0, ',', '.') }}
                                                                                        </span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="border-target">
                                                                                <td class="align-middle">
                                                                                    <div class="title-target-style">
                                                                                        <span
                                                                                            class="text-sm font-weight-normal">
                                                                                            Roas Achieved</span>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="align-middle">
                                                                                    <div class="real-roas real-style"
                                                                                        style="background: {{ $totalRoas < $item->roas ? 'green' : 'red' }};">
                                                                                        <span
                                                                                            class="text-sm font-weight-normal">{{ $item->roas }}</span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                {{-- Note --}}
                                                                <div class="col-12 mt-3">
                                                                    <h6 class="font-weight-semibold text-lg mb-3">Note
                                                                    </h6>
                                                                    <p class="text-sm note-style">
                                                                        {{ $laporanBulanan->note }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">

                                                            <div class="row">
                                                                <form>
                                                                    {{-- SECTION: META --}}
                                                                    @if ($item->meta_regular > 0 || $item->meta_cpas > 0)
                                                                        <div class="row topup-style mt-4">
                                                                            <div class="title-harian">
                                                                                <h5>Topup Meta</h5>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Meta Regular</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->meta_regular, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Meta Regular Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->meta_regular_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Meta CPAS</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->meta_cpas, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Meta CPAS Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->meta_cpas_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    {{-- GOOGLE --}}
                                                                    @if ($item->google_search > 0 || $item->google_performance_max > 0)
                                                                        <div class="row topup-style mt-4">
                                                                            <div class="title-harian">
                                                                                <h5>Topup Google</h5>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Google Search</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->google_search, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Search Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->google_search_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Performance Max</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->google_performance_max, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Performance Max
                                                                                        Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->google_performance_max_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    {{-- SHOPEE --}}
                                                                    @if ($item->shopee_produk > 0 || $item->shopee_toko > 0 || $item->shopee_live > 0)
                                                                        <div class="row topup-style mt-4">
                                                                            <div class="title-harian">
                                                                                <h5>Topup Shopee</h5>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Produk</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->shopee_produk, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Produk Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->shopee_produk_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Toko</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->shopee_toko, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Toko Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->shopee_toko_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Live</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->shopee_live, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Live Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->shopee_live_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    {{-- TIKTOK --}}
                                                                    @if (
                                                                        $item->tiktok_live_shopping > 0 ||
                                                                            $item->tiktok_product_shopping > 0 ||
                                                                            $item->tiktok_video_shopping > 0 ||
                                                                            $item->tiktok_gmv_max > 0)
                                                                        <div class="row topup-style mt-4">
                                                                            <div class="title-harian">
                                                                                <h5>Topup TikTok</h5>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Live Shopping</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->tiktok_live_shopping, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Live Shopping Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->tiktok_live_shopping_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Product Shopping</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->tiktok_product_shopping, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Product Shopping
                                                                                        Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->tiktok_product_shopping_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Video Shopping</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->tiktok_video_shopping, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Video Shopping
                                                                                        Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->tiktok_video_shopping_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>GMV Max</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->tiktok_gmv_max, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>GMV Max Revenue</label>
                                                                                    <div class="readonly-input">Rp
                                                                                        {{ number_format($item->tiktok_gmv_max_revenue, 0, ',', '.') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                @endforeach
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
                                    <div class="ms-auto d-flex">
                                        <a class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2"
                                            href="#" data-bs-toggle="modal" data-bs-target="#addLaporanModal"
                                            role="button">
                                            <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path
                                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                </svg>
                                            </span>
                                            <span class="btn-inner--text">Add Daily Report Lead1</span>
                                        </a>
                                    </div>

                                    <!-- Modal untuk menambahkan data lead -->
                                    <div class="modal fade" id="addLaporanModal" tabindex="-1"
                                        aria-labelledby="addLaporanModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="modal-header mb-2">
                                                        <h5 class="modal-title" id="addLaporanModalLabel">Tambah
                                                            Data
                                                            Lead</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form action="{{ route('laporan-harian.store-lead') }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="performance_bulanan_id"
                                                                class="form-label">Performance Bulanan ID</label>
                                                            <input type="text" class="form-control"
                                                                id="performance_bulanan_id"
                                                                name="performance_bulanan_id"
                                                                value="{{ $laporanBulanan->id }}" readonly required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="hari" class="form-label">Hari</label>
                                                            <input type="date" class="form-control" id="hari"
                                                                name="hari" required>
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
                                                                        name="chat" required readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="chat_respon" class="form-label">Chat
                                                                        Respon</label>
                                                                    <input type="text" value="0"
                                                                        class="form-control" id="chat_respon"
                                                                        name="chat_respon" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="chat_no_respon"
                                                                        class="form-label">Chat
                                                                        No
                                                                        Respon</label>
                                                                    <input type="text" value="0"
                                                                        class="form-control" id="chat_no_respon"
                                                                        name="chat_no_respon" required readonly>
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
                                                                        name="closing" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="revenue"
                                                                        class="form-label">Revenue</label>
                                                                    <input type="text" value="0"
                                                                        class="form-control" id="revenue"
                                                                        name="revenue" required readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Tanggal</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
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
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" strokeWidth={1.5}
                                                                    stroke="currentColor" className="size-6">
                                                                    <path strokeLinecap="round" strokeLinejoin="round"
                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>
                                                            </a>

                                                            <!-- Modal untuk mengedit data lead -->
                                                            <div class="modal fade"
                                                                id="editLeadModal{{ $lead->id }}" tabindex="-1"
                                                                aria-labelledby="editLeadModalLabel{{ $lead->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editLeadModalLabel{{ $lead->id }}">
                                                                                Edit Data Lead</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('laporan-harian.update_lead', $lead->id) }}"
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
                                                                                        id="hari" name="hari"
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
                                                                                                required readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="chat_respon"
                                                                                                class="form-label">Chat
                                                                                                Respon</label>
                                                                                            <input type="number"
                                                                                                class="form-control"
                                                                                                id="chat_respon"
                                                                                                name="chat_respon"
                                                                                                value="{{ $lead->chat_respon }}"
                                                                                                required readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="chat_no_respon"
                                                                                                class="form-label">Chat
                                                                                                No
                                                                                                Respon</label>
                                                                                            <input type="number"
                                                                                                class="form-control"
                                                                                                id="chat_no_respon"
                                                                                                name="chat_no_respon"
                                                                                                value="{{ $lead->chat_no_respon }}"
                                                                                                required readonly>
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
                                                                                                required readonly>
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
                                                                                                required readonly>
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

                                                            <form
                                                                action="{{ route('laporan-harian.destroy_lead', $lead->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn-style btn btn-danger text-secondary font-weight-bold text-xs"
                                                                    data-bs-toggle="tooltip" data-bs-title="Hapus"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                                    <svg width="20" height="20"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        strokeWidth={1.5} stroke="currentColor"
                                                                        class="size-6">
                                                                        <path strokeLinecap="round"
                                                                            strokeLinejoin="round"
                                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                    </svg>
                                                                </button>
                                                            </form>
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

            fetch(`/performa-harian/compare?bulan=${bulan}`)
                .then(response => response.json())
                .then(data => {
                    compareLabels = data.labels; // simpan label tooltip untuk compare
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
