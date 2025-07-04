<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 bor
    er-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <h5 class="font-weight-semibold text-lg mb-0">Informasi Laporan Bulanan</h5>
                                <div class="row mt-2">
                                    <div class="col-xl-3 col-md-3 mb-xl-0">
                                        <div class="card border shadow-xs mb-4">
                                            <div class="style-day card-body text-start p-3 w-100">
                                                <div
                                                    class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-person-circle"
                                                        viewBox="0 0 16 16">
                                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                        <path fill-rule="evenodd"
                                                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                                    </svg>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="w-100">
                                                            <p class="text-sm text-secondary mb-1 text-center">Nama
                                                                Brand</p>
                                                            <h6 class="mb-2 font-weight-bold text-center">
                                                                {{ $report->client->nama_brand ?? '-' }}
                                                            </h6>
                                                            <div class="d-flex align-items-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 mb-xl-0">
                                        <div class="card border shadow-xs mb-4">
                                            <div class="style-day card-body text-start p-3 w-100">
                                                <div
                                                    class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-calendar-date"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.445 11.688V6.354h-.633A13 13 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23" />
                                                        <path
                                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                                    </svg>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="w-100">
                                                            <p class="text-sm text-secondary mb-1 text-center">Tanggal
                                                                Laporan</p>
                                                            <h6 class="mb-2 font-weight-bold text-center">
                                                                {{ \Carbon\Carbon::parse($report->report_date)->translatedFormat('F Y') ?? '-' }}
                                                            </h6>
                                                            <div class="d-flex align-items-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 mb-xl-0">
                                        <div class="card border shadow-xs mb-4">
                                            <div class="style-day card-body text-start p-3 w-100">
                                                <div
                                                    class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-briefcase"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5m1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0M1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5" />
                                                    </svg>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="w-100">
                                                            <p class="text-sm text-secondary mb-1 text-center">Jenis
                                                                Layanan</p>
                                                            <h6 class="mb-2 font-weight-bold text-center">
                                                                {{ $report->jenis_layanan_mb ?? '-' }}
                                                            </h6>
                                                            <div class="d-flex align-items-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 mb-xl-0">
                                        <div class="card border shadow-xs mb-4">
                                            <div class="style-day card-body text-start p-3 w-100">
                                                <div
                                                    class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-graph-up"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M0 0h1v15h15v1H0zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07" />
                                                    </svg>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="w-100">
                                                            <p class="text-sm text-secondary mb-1 text-center">Jenis
                                                                Leads</p>
                                                            <h6 class="mb-2 font-weight-bold text-center">
                                                                {{ $report->jenis_leads ?? '-' }}
                                                            </h6>
                                                            <div class="d-flex align-items-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                <h5 class="font-weight-semibold text-lg mb-4">Informasi Grafik Layanan
                                    {{ $report->jenis_layanan_mb ?? '-' }} dengan Jenis
                                    Lead: {{ $report->jenis_leads ?? '-' }} pada Bulan
                                    {{ \Carbon\Carbon::parse($report->report_date)->translatedFormat('F Y') ?? '-' }}
                                </h5>
                                @if ($report->jenis_leads == 'F to F')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Spent
                                            </h5>
                                            <canvas id="chartSpent" height="200"></canvas>
                                            <div id="customLegendSpent" class="mt-3 mb-4 text-center"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Harian
                                            </h5>
                                            <div id="chartContainer" class="mt-4 mb-4" style="height: 270px;"></div>
                                        </div>
                                    </div>
                                @elseif ($report->jenis_leads == 'Roas Revenue')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Spent
                                            </h5>
                                            <canvas id="chartSpent" height="200"></canvas>
                                            <div id="customLegendSpent" class="customSpent mt-4 mb-4"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Harian
                                            </h5>
                                            <canvas id="chartOther" height="200"></canvas>
                                            <div id="customLegendOther" class="customOther mt-4 mb-4"></div>
                                        </div>
                                    </div>
                                @elseif ($report->jenis_leads == 'Total Closing')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Spent
                                            </h5>
                                            <canvas id="chartSpent" height="200"></canvas>
                                            <div id="customLegendSpent" class="mt-3 mb-3 text-center"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Harian
                                            </h5>
                                            <canvas id="chartOther" height="200"></canvas>
                                            <div id="customLegendOther" class="mt-3 mb-3 text-center"></div>
                                        </div>
                                    </div>
                                @elseif ($report->jenis_leads == 'Site Visits')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Spent
                                            </h5>
                                            <canvas id="chartSpent" height="200"></canvas>
                                            <div id="customLegendSpent" class="mt-3 mb-3 text-center"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Harian
                                            </h5>
                                            <canvas id="chartOther" height="200"></canvas>
                                            <div id="customLegendOther" class="mt-3 mb-3 text-center"></div>
                                        </div>
                                    </div>
                                @else
                                    <p>Tidak ada grafik untuk jenis leads ini.</p>
                                @endif
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
                                        <h6 class="font-weight-semibold text-lg mb-0">Daily Report</h6>
                                        <p class="text-sm">List of market booster daily report</p>
                                    </div>
                                    <div class="ms-auto d-flex">
                                        <a class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2"
                                            href="#" role="button" data-bs-toggle="modal"
                                            data-bs-target="#createLeadModal">
                                            <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path
                                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                </svg>
                                            </span>
                                            <span class="btn-inner--text">Add Daily Report</span>
                                        </a>
                                    </div>
                                    <!-- Modal untuk Create -->
                                    <div class="modal fade" id="createLeadModal" tabindex="-1"
                                        aria-labelledby="createLeadModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <form action="{{ route('lead.store') }}" method="POST"
                                                class="modal-content">
                                                @csrf
                                                <input type="hidden" name="performance_bulanan_id"
                                                    value="{{ $report->id }}">

                                                <div class="modal-header mx-3 mt-3 ">
                                                    <h5 class="modal-title">Tambah Data Harian</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body row">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-3">
                                                            <label>Hari</label>
                                                            <input type="date" name="hari" class="form-control"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($fields as $field)
                                                            @if ($field == 'hari' || $field == 'note')
                                                                @continue
                                                            @endif
                                                            <div class="mb-3 col-md-4">
                                                                <label>{{ ucfirst($field) }}</label>
                                                                <input type="text"
                                                                    placeholder="Data {{ $field }}"
                                                                    name="{{ $field }}" class="form-control">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12">
                                                            <label>Note</label>
                                                            <textarea type="text" rows="3" name="note" class="form-control" required> </textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="table-responsive p-0">
                                @if ($leads->isEmpty())
                                    <div class="alert alert-warning">
                                        Belum ada data laporan harian untuk bulan ini.
                                    </div>
                                @else
                                    <table class="table align-items-center mb-0" id="clientTableMB">
                                        <thead class="bg-gray-100">
                                            <tr class="tabel-style">
                                                @foreach ($fields as $field)
                                                    @if ($field == 'note')
                                                        @continue
                                                    @endif
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        {{ ucfirst($field) }}
                                                    </th>
                                                @endforeach
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Topup Details</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leads as $lead)
                                                <tr class="client-row-mb">
                                                    @foreach ($fields as $field)
                                                        @if ($field == 'note')
                                                            @continue
                                                        @endif
                                                        <td class="client-name-style">
                                                            <div class="d-flex px-2 py-1">
                                                                <div
                                                                    class="d-flex flex-column justify-content-center ms-1">
                                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                                        {{ $lead->$field }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @endforeach
                                                    <td class="align-middle text-center">
                                                        <button type="button"
                                                            class="btn-style btn btn-info text-secondary font-weight-bold text-xs"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#detailModal{{ $lead->id }}">
                                                            Lihat Detail Harian
                                                        </button>
                                                        <!-- Modal Detail Harian -->
                                                        <div class="modal fade" id="detailModal{{ $lead->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="detailModalLabel{{ $lead->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header mx-3 mt-3">
                                                                        <h5 class="modal-title">Detail Harian -
                                                                            {{ \Carbon\Carbon::parse($lead->hari)->translatedFormat('l, d F Y') ?? '-' }}
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Tutup"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form>
                                                                            <div class="row">
                                                                                @foreach ($fields as $field)
                                                                                    @if ($field == 'hari' || $field == 'note')
                                                                                        @continue
                                                                                    @endif
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="text-start">{{ ucfirst($field) }}</label>
                                                                                            <div
                                                                                                class="readonly-input text-start">
                                                                                                {{ $lead->$field ?? '-' }}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- <div class="col-md-6 mb-3">
                                                                                        <strong>{{ ucfirst($field) }}</strong><br>
                                                                                        {{ $lead->$field ?? '-' }}
                                                                                    </div> --}}
                                                                                @endforeach
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            class="text-start">Note</label>
                                                                                        <div
                                                                                            class="readonly-textarea text-start">
                                                                                            {{ $lead->note ?? '-' }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="#"
                                                            class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                            data-bs-toggle="tooltip" data-bs-title="Laporan Bulanan">
                                                            <svg width="20" height="20"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                            </svg>
                                                        </a>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editLeadModal{{ $lead->id }}"
                                                            type="button"
                                                            class="btn btn-primary text-secondary font-weight-bold text-xs active-client"
                                                            data-bs-toggle="tooltip" data-bs-title="Edit user">
                                                            <svg width="20" height="20"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" strokeWidth={1.5}
                                                                stroke="currentColor" className="size-6">
                                                                <path strokeLinecap="round" strokeLinejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                            </svg>
                                                        </a>
                                                        <form
                                                            action="{{ route('laporan-harian-lead.destroy', $lead->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button ype="submit"
                                                                class="btn-style btn btn-danger text-secondary font-weight-bold text-xs"
                                                                data-bs-toggle="tooltip" data-bs-title="Hapus"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                                <svg width="20" height="20"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" strokeWidth={1.5}
                                                                    stroke="currentColor" class="size-6">
                                                                    <path strokeLinecap="round" strokeLinejoin="round"
                                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                </svg>
                                                            </button>
                                                        </form>

                                                        @foreach ($leads as $lead)
                                                            <div class="modal fade"
                                                                id="editLeadModal{{ $lead->id }}" tabindex="-1"
                                                                aria-labelledby="editLeadModalLabel{{ $lead->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <form
                                                                        action="{{ route('lead.update', $lead->id) }}"
                                                                        method="POST" class="modal-content">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <input type="hidden"
                                                                            name="performance_bulanan_id"
                                                                            value="{{ $report->id }}">

                                                                        <div class="modal-header mx-3 mt-3">
                                                                            <h5 class="modal-title"
                                                                                id="editLeadModalLabel{{ $lead->id }}">
                                                                                Edit Data
                                                                                Harian</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Tutup"></button>
                                                                        </div>

                                                                        <div class="modal-body row">
                                                                            {{-- Hari manual tetap di sini --}}
                                                                            <div class="row">
                                                                                <div class="mb-3 col-md-3">
                                                                                    <label>Hari</label>
                                                                                    <input type="date"
                                                                                        name="hari"
                                                                                        class="form-control"
                                                                                        value="{{ $lead->hari }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                {{-- Loop field kecuali 'hari' --}}
                                                                                @foreach ($fields as $field)
                                                                                    @if ($field == 'hari' || $field == 'note')
                                                                                        @continue
                                                                                    @endif
                                                                                    <div class="mb-3 col-md-4">
                                                                                        <label>{{ ucfirst($field) }}</label>
                                                                                        <input type="text"
                                                                                            name="{{ $field }}"
                                                                                            class="form-control"
                                                                                            value="{{ $lead->$field }}">
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="mb-3 col-md-12">
                                                                                    <label for="note">Note</label>
                                                                                    <textarea name="note" id="note" class="form-control text-start" rows="3">{{ $lead->note }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Update</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endforeach
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                data: [{
                    type: "funnel",
                    indexLabel: "{label} - {y}", // Menampilkan label + nilai dalam grafik
                    toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
                    neckWidth: 20,
                    neckHeight: 0,
                    valueRepresents: "area",
                    dataPoints: [
                        @foreach ($totals as $label => $value)
                            {
                                y: {{ $value }},
                                label: "{{ $label }}"
                            },
                        @endforeach
                    ],
                }],
            });

            calculatePercentage();
            chart.render();

            function calculatePercentage() {
                var dataPoint = chart.options.data[0].dataPoints;
                var total = dataPoint[0].y;
                for (var i = 0; i < dataPoint.length; i++) {
                    if (i == 0) {
                        chart.options.data[0].dataPoints[i].percentage = 100;
                    } else {
                        chart.options.data[0].dataPoints[i].percentage = (
                            (dataPoint[i].y / total) * 100
                        ).toFixed(2);
                    }
                }
            }
        };
    </script>

    <script>
        let chartSpent, chartOther;

        const labels = {!! json_encode($leads->pluck('hari')) !!};

        @php $jenis = $report->jenis_leads; @endphp

        @if ($jenis == 'F to F')
            const datasetsSpent = [{
                label: 'Spent',
                data: {!! json_encode($leads->pluck('spent')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                fill: false,
                tension: 0.1,
            }];

            const datasetsOther = [{
                    label: 'Leads',
                    data: {!! json_encode($leads->pluck('leads')) !!},
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgba(255, 205, 86, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Chat',
                    data: {!! json_encode($leads->pluck('chat')) !!},
                    borderColor: 'rgb(255, 159, 64)',
                    backgroundColor: 'rgba(255, 159, 64, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Greeting',
                    data: {!! json_encode($leads->pluck('greeting')) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Pricelist',
                    data: {!! json_encode($leads->pluck('pricelist')) !!},
                    borderColor: 'rgb(153, 102, 255)',
                    backgroundColor: 'rgba(153, 102, 255, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Discuss',
                    data: {!! json_encode($leads->pluck('discuss')) !!},
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Note',
                    data: {!! json_encode($leads->pluck('note')) !!},
                    borderColor: 'rgb(201, 203, 207)',
                    backgroundColor: 'rgba(201, 203, 207, 0.1)',
                    fill: false,
                    tension: 0.1,
                }
            ];
        @elseif ($jenis == 'Roas Revenue')
            const datasetsSpent = [{
                label: 'Spent',
                data: {!! json_encode($leads->pluck('spent')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                fill: false,
                tension: 0.1,
            }];

            const datasetsOther = [{
                    label: 'Revenue',
                    data: {!! json_encode($leads->pluck('revenue')) !!},
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgba(255, 205, 86, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'ROAS',
                    data: {!! json_encode($leads->pluck('roas')) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Chat',
                    data: {!! json_encode($leads->pluck('chat')) !!},
                    borderColor: 'rgb(255, 159, 64)',
                    backgroundColor: 'rgba(255, 159, 64, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Respond',
                    data: {!! json_encode($leads->pluck('respond')) !!},
                    borderColor: 'rgb(153, 102, 255)',
                    backgroundColor: 'rgba(153, 102, 255, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Closing',
                    data: {!! json_encode($leads->pluck('closing')) !!},
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    fill: false,
                    tension: 0.1,
                }
            ];
        @elseif ($jenis == 'Total Closing')
            const datasetsSpent = [{
                label: 'Spent',
                data: {!! json_encode($leads->pluck('spent')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                fill: false,
                tension: 0.1,
            }];

            const datasetsOther = [{
                    label: 'Leads',
                    data: {!! json_encode($leads->pluck('leads')) !!},
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgba(255, 205, 86, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Chat',
                    data: {!! json_encode($leads->pluck('chat')) !!},
                    borderColor: 'rgb(255, 159, 64)',
                    backgroundColor: 'rgba(255, 159, 64, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Respond',
                    data: {!! json_encode($leads->pluck('respond')) !!},
                    borderColor: 'rgb(153, 102, 255)',
                    backgroundColor: 'rgba(153, 102, 255, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Closing',
                    data: {!! json_encode($leads->pluck('closing')) !!},
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    fill: false,
                    tension: 0.1,
                }
            ];
        @elseif ($jenis == 'Site Visits')
            const datasetsSpent = [{
                label: 'Spent',
                data: {!! json_encode($leads->pluck('spent')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                fill: false,
                tension: 0.1,
            }];

            const datasetsOther = [{
                    label: 'Leads',
                    data: {!! json_encode($leads->pluck('leads')) !!},
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgba(255, 205, 86, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Respond',
                    data: {!! json_encode($leads->pluck('respond')) !!},
                    borderColor: 'rgb(153, 102, 255)',
                    backgroundColor: 'rgba(153, 102, 255, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Closing',
                    data: {!! json_encode($leads->pluck('closing')) !!},
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    fill: false,
                    tension: 0.1,
                }
            ];
        @endif

        // Fungsi chart & legend tetap sama
        function createChart(ctxId, dataSets, legendContainerId) {
            const ctx = document.getElementById(ctxId).getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: dataSets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            setTimeout(() => generateCustomLegend(chart, legendContainerId), 100);
            return chart;
        }

        function generateCustomLegend(chart, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';

            chart.data.datasets.forEach((ds, index) => {
                const box = document.createElement('span');
                box.textContent = ds.label;

                box.style.backgroundColor = ds.hidden ? '#ccc' : ds.borderColor;
                box.style.color = '#fff';
                box.style.padding = '6px 12px';
                box.style.borderRadius = '8px';
                box.style.fontSize = '12px';
                box.style.fontWeight = '600';
                box.style.display = 'inline-block';
                box.style.lineHeight = '1';
                box.style.marginRight = '8px';
                box.style.cursor = 'pointer';

                box.addEventListener('click', function() {
                    const meta = chart.getDatasetMeta(index);
                    meta.hidden = meta.hidden === null ? !chart.data.datasets[index].hidden : null;
                    chart.update();
                    generateCustomLegend(chart, containerId);
                });

                container.appendChild(box);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            chartSpent = createChart('chartSpent', datasetsSpent, 'customLegendSpent');
            chartOther = createChart('chartOther', datasetsOther, 'customLegendOther');
        });
    </script>




</x-app-layout>
