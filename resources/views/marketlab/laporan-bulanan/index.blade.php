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
                                                class="badge badge-sm border border-success text-success bg-success status-client-style">Aktif</span>
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
                                                class="badge badge-sm border border-success text-success bg-marketlab status-client-style">{{ $client->pj }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span
                                                class="badge badge-sm border border-success text-success bg-marketlab status-client-style">{{ $client->pegawai->nama }}</span>
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

                            <div class="row col-10">
                                <div class="col-4">
                                    <label for="name">Nama Client</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ $client->nama_client }}" class="form-control" disabled>
                                </div>
                                <div class="col-4">
                                    <label for="email">Email</label>
                                    <input value="{{ $client->email }}" class="form-control" disabled>
                                </div>
                                <div class="col-4">
                                    <label for="email">No Telpon</label>
                                    <input value="{{ $client->telepon_finance }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row mt-2 col-11">
                                <div class="col-6">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control" disabled>{{ $client->alamat }}</textarea>
                                </div>
                                <div class="col-6">
                                    <label for="informasi_tambahan	">Alamat</label>
                                    <textarea name="informasi_tambahan" id="informasi_tambahan" rows="3" class="form-control" disabled>{{ $client->informasi_tambahan }}</textarea>
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
                                    <h6 class="font-weight-semibold text-lg mb-0">List Data Laporan Bulanan</h6>
                                    <p class="text-sm">Berikut adalah list data laporan Bulanan</p>
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
                                        <span class="btn-inner--text">Add Laporan Bulanan</span>
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
                                        <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10
                                        </option>
                                        <option value="20" {{ request('perPage', 10) == 20 ? 'selected' : '' }}>20
                                        </option>
                                        <option value="40" {{ request('perPage', 10) == 40 ? 'selected' : '' }}>40
                                        </option>
                                        <option value="60" {{ request('perPage', 10) == 60 ? 'selected' : '' }}>60
                                        </option>
                                        <option value="80" {{ request('perPage', 10) == 80 ? 'selected' : '' }}>80
                                        </option>
                                        <option value="100" {{ request('perPage', 10) == 100 ? 'selected' : '' }}>
                                            100</option>
                                    </select>
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
                                    <input type="text" class="form-control"
                                        placeholder="Search by date (e.g., January 2023)" id="searchInput"
                                        onkeyup="searchByDate()">
                                </div>
                            </div>
                            <div class="table-responsive p-0">
                                @if ($reports->isEmpty())
                                    <p class="ntp">Tidak ada laporan bulanan untuk client ini.</p>
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
                                                    Target Spent
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Target Revenue
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Rarget Roas
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Tanggal
                                                </th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reports as $report)
                                                <tr>
                                                    <td class="align-middle text-center">
                                                        <span class="day-style text-sm font-weight-normal">
                                                            {{ ($reports->currentPage() - 1) * $reports->perPage() + $loop->iteration }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-sm font-weight-normal">
                                                            {{ $report->target_spent }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-sm font-weight-normal">
                                                            {{ $report->target_revenue }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-sm font-weight-normal">
                                                            {{ $report->target_roas }}
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
                                                            <svg width="20" height="20"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            </svg>
                                                        </button>


                                                        {{-- Tampilkan data bulanan --}}
                                                        <a href="{{ route('laporan-harian.index', ['performance_bulanan_id' => $report->id]) }}"
                                                            type="button"
                                                            class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                            data-bs-toggle="tooltip" data-bs-title="Laporan Harian">
                                                            <svg width="20" height="20"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" strokeWidth={1.5}
                                                                stroke="currentColor" className="size-6">
                                                                <path strokeLinecap="round" strokeLinejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                            </svg>
                                                        </a>

                                                        {{-- Edit Data --}}
                                                        <a href="{{ route('laporan-bulanan.edit', $report->id) }}"
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
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="reportDetailModal{{ $report->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="reportDetailModalLabel{{ $report->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="reportDetailModalLabel{{ $report->id }}">
                                                                    Detail Laporan Bulanan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Target Spent:</strong>
                                                                    {{ $report->target_spent }}</p>
                                                                <p><strong>Target Revenue:</strong>
                                                                    {{ $report->target_revenue }}</p>
                                                                <p><strong>Target ROAS:</strong>
                                                                    {{ $report->target_roas }}</p>
                                                                <p><strong>Tanggal Laporan:</strong>
                                                                    {{ \Carbon\Carbon::parse($report->report_date)->format('d F Y') }}
                                                                </p>
                                                                <p><strong>Catatan:</strong> {{ $report->note }}
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
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
        <script></script>

    </main>

</x-app-layout>



{{-- <x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 bor
    er-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <h1>Laporan Bulanan</h1>
            <h2>Client: {{ $client->nama_client }}</h2> <!-- Menampilkan nama client yang dipilih -->


@if ($reports->isEmpty())
    <p>Tidak ada laporan bulanan untuk client ini.</p>
@else
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client ID</th>
                <th>Target Spent</th>
                <th>Target Revenue</th>
                <th>Report Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->client_id }}</td>
                    <td>{{ $report->target_spent }}</td>
                    <td>{{ $report->target_revenue }}</td>
                    <td>{{ $report->report_date }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endif

</div>

</main>

</x-app-layout> --}}
