<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 bor
    er-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="col-lg-12 col-12">
                <div class="card card-body" id="profile">
                    <img src="{{ asset('/assets/img/backgroun-client.jpg') }}" alt="pattern-lines"
                        class="top-0 rounded-2 position-absolute start-0 w-100 h-100">
                    <div class="row z-index-2 justify-start">
                        <div class="col-sm-auto col-4 d-flex align-items-center">
                            <div class="avatar avatar-xl position-relative avatar-style">
                                <img src="{{ asset('storage/' . $client->gambar_client) }}" alt="bruce"
                                    class="w-100 h-100 object-fit-cover border-radius-lg shadow-sm" id="preview">
                            </div>
                        </div>
                        <div class="col-sm-auto col-12 my-auto ">
                            <div class="h-100 pb-3">
                                <h5 class="mb-1 font-weight-bolder">
                                    {{ $client->nama_brand }}
                                </h5>
                                <h5 class="mb-1 font-weight-bolder name-client-style">
                                    {{ $client->nama_client }}
                                </h5>
                            </div>
                            <div class="col-12">
                                <div>
                                    @switch($client->status_client)
                                    @case(1)
                                    <span
                                        class="badge badge-sm border border-success text-success bg-success status-client-style">Active</span>
                                    @break

                                    @case(2)
                                    <span
                                        class="badge badge-sm border border-warning text-warning bg-warning status-client-style">Pending</span>
                                    @break

                                    @case(3)
                                    <span
                                        class="badge badge-sm border border-danger text-danger bg-danger status-client-style">Paid</span>
                                    @break
                                    @endswitch
                                </div>
                                <div class="mt-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span
                                                class="badge badge-sm border border-success text-success bg-marketlab status-client-style">{{
                                                $client->pj }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span
                                                class="badge badge-sm border border-success text-success bg-marketlab status-client-style">{{
                                                $client->pegawai->nama }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 mb-2 row justify-content-center">
                <div class="col-lg-12 col-12 ">
                    <div class="card border shadow-xs mb-4 border-client" id="basic-info">
                        <div class="card-header border-bottom pb-0 border-client-bottom">
                            <h5>Info {{ $client->nama_brand }}</h5>
                        </div>
                        <div class="pt-0 card-body">
                            <div class="row col-12 mt-4">
                                <div class="col-4">
                                    <label for="name">Client Name</label>
                                    <input type="text" name="name" id="name" value="{{ $client->nama_client }}"
                                        class="form-control" disabled>
                                </div>
                                <div class="col-4">
                                    <label for="email">Email</label>
                                    <input value="{{ $client->email }}" class="form-control" disabled>
                                </div>
                                <div class="col-4">
                                    <label for="email">Phone Number</label>
                                    <input value="{{ $client->telepon_finance }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-6">
                                    <label for="alamat">Address</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control"
                                        disabled>{{ $client->alamat }}</textarea>
                                </div>
                                <div class="col-6">
                                    <label for="informasi_tambahan	">Notes</label>
                                    <textarea name="informasi_tambahan" id="informasi_tambahan" rows="3"
                                        class="form-control" disabled>{{ $client->informasi_tambahan }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{-- Notifikasi untuk data berhasil atau gagal --}}
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
                <div class="col-12">
                    <div class="card border shadow-xs mb-4 border-client">
                        <div class="card-header border-bottom pb-0 border-client-bottom">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Monthly Report</h6>
                                    <p class="text-sm">List of market booster monthly report</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2"
                                        href="{{ route('laporan-bulanan.create', ['client_id' => $client->id]) }}"
                                        role="button">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Add Monthly Report</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                                <form id="perPageForm"
                                    action="{{ route('laporan-bulanan.index', ['client_id' => $client->id]) }}"
                                    method="GET" class="me-3">
                                    <!-- Hidden input to send client_id with the request -->
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">

                                    <select name="perPage" onchange="this.form.submit();"
                                        class="form-select form-lots lost-style">
                                        <option value="10" {{ request('perPage', 10)==10 ? 'selected' : '' }}>10
                                        </option>
                                        <option value="20" {{ request('perPage', 10)==20 ? 'selected' : '' }}>20
                                        </option>
                                        <option value="40" {{ request('perPage', 10)==40 ? 'selected' : '' }}>40
                                        </option>
                                        <option value="60" {{ request('perPage', 10)==60 ? 'selected' : '' }}>60
                                        </option>
                                        <option value="80" {{ request('perPage', 10)==80 ? 'selected' : '' }}>80
                                        </option>
                                        <option value="100" {{ request('perPage', 10)==100 ? 'selected' : '' }}>
                                            100</option>
                                    </select>
                                </form>
                                <div class="input-group w-sm-25 ms-auto">
                                    <span class="input-group-text text-body">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                            </path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control"
                                        placeholder="Search by date (e.g., January 2023)" id="searchInput"
                                        onkeyup="searchByDate()">
                                </div>
                            </div>
                            <div class="table-responsive p-0">
                                @if ($reports->isEmpty())
                                <p class="ntp">No data available.</p>
                                @else
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                No
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Campaign Name
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                MB Service Type
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Target Spent
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Month
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $report)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="day-style text-sm font-weight-normal">
                                                    {{ ($reports->currentPage() - 1) * $reports->perPage() +
                                                    $loop->iteration }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm font-weight-normal">
                                                    {{ $report->nama_campaign }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($report->jenis_layanan_mb === 'Leads')
                                                <span class="badge bg-success text-white"
                                                    style="background-color: #198754 !important;">
                                                    {{ $report->jenis_layanan_mb }} -
                                                    {{ $report->jenis_leads }}
                                                </span>
                                                @else
                                                <span class="badge bg-success text-white"
                                                    style="background-color: #198754 !important;">
                                                    {{ $report->jenis_layanan_mb }}
                                                </span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm font-weight-normal">
                                                    Rp {{ number_format($report->target_spent, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center report-date">
                                                <!-- Tambahkan kelas report-date di sini -->
                                                <span class="text-secondary text-sm font-weight-normal">
                                                    {{ \Carbon\Carbon::parse($report->report_date)->format('F Y') }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <button type="button"
                                                    class="btn-style btn btn-info text-secondary font-weight-bold text-xs"
                                                    data-bs-toggle="modal" data-bs-toggle="tooltip"
                                                    data-bs-title="Detail"
                                                    data-bs-target="#reportDetailModal{{ $report->id }}">
                                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </button>
                                                {{-- Tampilkan data bulanan --}}
                                                @php
                                                $jenisLayanan = $report->jenis_layanan_mb;
                                                $jenisLeads = $report->jenis_leads;
                                                @endphp

                                                @if ($jenisLayanan === 'Marketplace')
                                                {{-- Jika layanan adalah Marketplace --}}
                                                <a href="{{ route('laporan-harian.index', ['performance_bulanan_id' => $report->id]) }}"
                                                    class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                    data-bs-toggle="tooltip" data-bs-title="Laporan Harian">
                                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                                        stroke="currentColor" className="size-6">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                </a>
                                                @elseif ($jenisLeads)
                                                {{-- Jika layanan adalah Lead --}}
                                                <a href="{{ route('laporan-harian.index-lead', ['performance_bulanan_id' => $report->id]) }}"
                                                    class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                    data-bs-toggle="tooltip" data-bs-title="Laporan Harian">

                                                    {{-- ICON atau TEKS --}}
                                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                                        stroke="currentColor" className="size-6">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                </a>
                                                @else
                                                {{-- Default atau tidak diketahui --}}
                                                <span class="text-muted">Layanan belum ditentukan</span>
                                                @endif
                                                {{-- <a
                                                    href="{{ route('laporan-harian.index', ['performance_bulanan_id' => $report->id]) }}"
                                                    type="button"
                                                    class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                    data-bs-toggle="tooltip" data-bs-title="Laporan Harian">
                                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                                        stroke="currentColor" className="size-6">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                </a> --}}
                                                {{-- Edit Data --}}
                                                <a href="{{ route('laporan-bulanan.edit', $report->id) }}" type="button"
                                                    class="btn btn-primary text-secondary font-weight-bold text-xs active-client"
                                                    data-bs-toggle="tooltip" data-bs-title="Edit user">
                                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                                        stroke="currentColor" className="size-6">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="reportDetailModal{{ $report->id }}" tabindex="-1"
                                            aria-labelledby="reportDetailModalLabel{{ $report->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="modal-header mb-3">
                                                            <h5 class="modal-title"
                                                                id="reportDetailModalLabel{{ $report->id }}">
                                                                Monthly Report Details
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        @if ($report->jenis_layanan_mb === 'Leads')
                                                        <h6 class="mb-3">
                                                            Service:
                                                            <span class="badge bg-success text-white"
                                                                style="background-color: #198754 !important;">
                                                                {{ $report->jenis_layanan_mb }}
                                                            </span>
                                                        </h6>
                                                        <h6 class="mb-3">
                                                            Leads Target :
                                                            <span class="badge bg-success text-white"
                                                                style="background-color: #198754 !important;">
                                                                {{ $report->jenis_leads }}
                                                            </span>
                                                        </h6>

                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label>Campaign Name</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->nama_campaign }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Target Spent</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->target_spent }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Target Revenue</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->target_revenue }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Target ROAS</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->target_roas }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Leads Target </label>
                                                                <input class="form-control"
                                                                    value="{{ $report->target_leads }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Chat</label>
                                                                <input class="form-control" value="{{ $report->chat }}"
                                                                    readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Respond</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->respond }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Greeting</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->greeting }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Pricelist</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->pricelist }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Discuss</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->discuss }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Closing</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->closing }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Site Visit</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->site_visit }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>CPL</label>
                                                                <input class="form-control" value="{{ $report->cpl }}"
                                                                    readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>CPC</label>
                                                                <input class="form-control" value="{{ $report->cpc }}"
                                                                    readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>CR Leads to Chat</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->cr_leads_to_chat }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>CR Chat to Respond</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->cr_chat_to_respond }}" readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>CR Respond to Closing</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->cr_respond_to_closing }}"
                                                                    readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>CR Respond to Site Visit</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->cr_respond_to_site_visit }}"
                                                                    readonly>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Report Date</label>
                                                                <input class="form-control"
                                                                    value="{{ \Carbon\Carbon::parse($report->report_date)->translatedFormat('d F Y') }}"
                                                                    readonly>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label>Note</label>
                                                                <textarea class="form-control" rows="3"
                                                                    readonly>{{ $report->note }}</textarea>
                                                            </div>
                                                        </div>

                                                        @else
                                                        <h6 class="mb-3">
                                                            Service:
                                                            <span class="badge bg-success text-white"
                                                                style="background-color: #198754 !important;">
                                                                {{ $report->jenis_layanan_mb }}
                                                            </span>
                                                        </h6>
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label>Target Spent</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->target_spent }}" readonly>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label>Target Revenue</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->target_revenue }}" readonly>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label>Target ROAS</label>
                                                                <input class="form-control"
                                                                    value="{{ $report->target_roas }}" readonly>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label>Report Date</label>
                                                                <input class="form-control"
                                                                    value="{{ \Carbon\Carbon::parse($report->report_date)->format('d F Y') }}"
                                                                    readonly>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label>Notes</label>
                                                                <textarea class="form-control" rows="3"
                                                                    readonly>{{ $report->note }}</textarea>
                                                            </div>
                                                        </div>
                                                        @endif

                                                        <div class="modal-footer mt-2">
                                                            <button type="button" class="btn btn-secondary"
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
                                    Page {{ $currentPage }} of {{ $totalPages }}
                                </p>
                                <div class="ms-auto">
                                    @if ($reports->onFirstPage())
                                    <button class="btn btn-sm btn-white mb-0" disabled>Previous</button>
                                    @else
                                    <a href="{{ $reports->previousPageUrl() . '&client_id=' . $client->id }}"
                                        class="btn btn-sm btn-white mb-0">Previous</a>
                                    @endif
                                    @if ($reports->hasMorePages())
                                    <a href="{{ $reports->nextPageUrl() . '&client_id=' . $client->id }}"
                                        class="btn btn-sm btn-white mb-0">Next</a>
                                    @else
                                    <button class="btn btn-sm btn-white mb-0" disabled>Next</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @php
    $labels = [];
    $spent = [];
    $revenue = [];
    $roas = [];

    foreach ($reports as $report) {
    $labels[] = \Carbon\Carbon::parse($report->report_date)->format('M Y');
    $spent[] = $report->target_spent;
    $revenue[] = $report->target_revenue;
    $roas[] = $report->target_roas;
    }

    $compareLabels = $compareSpent = $compareRevenue = $compareRoas = [];

    if (!empty($compareReports)) {
    foreach ($compareReports as $compareReport) {
    $compareLabels[] = \Carbon\Carbon::parse($compareReport->report_date)->format('D M');
    $compareSpent[] = $compareReport->target_spent;
    $compareRevenue[] = $compareReport->target_revenue;
    $compareRoas[] = $compareReport->target_roas;
    }
    }
    @endphp

    <script>
        function toggleCompare() {
            const compareSection = document.getElementById('compareSection');
            compareSection.style.display = compareSection.style.display === 'none' ? 'block' : 'none';
        }
        let spentChart, revenueChart, roasChart;

        document.addEventListener('DOMContentLoaded', function() {
            const labels = {!! json_encode($labels) !!};
            const spent = {!! json_encode($spent) !!};
            const revenue = {!! json_encode($revenue) !!};
            const roas = {!! json_encode($roas) !!};

            const compareLabels = {!! json_encode($compareLabels) !!};
            const compareSpent = {!! json_encode($compareSpent) !!};
            const compareRevenue = {!! json_encode($compareRevenue) !!};
            const compareRoas = {!! json_encode($compareRoas) !!};

            // SPENT CHART
            spentChart = new Chart(document.getElementById('spentChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Spent',
                        data: spent,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: false,
                        tension: 0.3
                    }]
                }
            });

            // REVENUE CHART
            revenueChart = new Chart(document.getElementById('revenueChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Revenue',
                        data: revenue,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: false,
                        tension: 0.3
                    }]
                }
            });

            // ROAS CHART
            roasChart = new Chart(document.getElementById('roasChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'ROAS',
                        data: roas,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false,
                        tension: 0.3
                    }]
                }
            });

            // Handle form compare
            document.getElementById('compareForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData(form);

                fetch("{{ route('laporan-bulanan.compare') }}", {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        updateCharts(data);
                    })
                    .catch(error => {
                        console.error('AJAX Error:', error);
                    });
            });

            // Fungsi update chart
            function updateCharts(data) {
                // Clear data labels dan datasets dulu supaya tidak conflict
                spentChart.data.labels = [];
                revenueChart.data.labels = [];
                roasChart.data.labels = [];

                spentChart.data.datasets = [];
                revenueChart.data.datasets = [];
                roasChart.data.datasets = [];

                // Set labels base
                spentChart.data.labels = data.baseLabels;
                revenueChart.data.labels = data.baseLabels;
                roasChart.data.labels = data.baseLabels;

                // Set dataset base
                spentChart.data.datasets.push({
                    label: 'Spent',
                    data: data.baseSpent,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: false,
                    tension: 0.3
                });
                revenueChart.data.datasets.push({
                    label: 'Revenue',
                    data: data.baseRevenue,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: false,
                    tension: 0.3
                });
                roasChart.data.datasets.push({
                    label: 'ROAS',
                    data: data.baseRoas,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false,
                    tension: 0.3
                });

                // Tambah dataset compare
                spentChart.data.datasets.push({
                    label: 'Compare Spent',
                    data: data.compareSpent,
                    borderColor: 'rgba(255, 99, 132, 0.6)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    fill: false,
                    tension: 0.3,
                    borderDash: [5, 5]
                });
                revenueChart.data.datasets.push({
                    label: 'Compare Revenue',
                    data: data.compareRevenue,
                    borderColor: 'rgba(54, 162, 235, 0.6)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    fill: false,
                    tension: 0.3,
                    borderDash: [5, 5]
                });
                roasChart.data.datasets.push({
                    label: 'Compare ROAS',
                    data: data.compareRoas,
                    borderColor: 'rgba(75, 192, 192, 0.6)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    fill: false,
                    tension: 0.3,
                    borderDash: [5, 5]
                });

                // Update semua chart
                spentChart.update();
                revenueChart.update();
                roasChart.update();
            }

        });
    </script>
</x-app-layout>