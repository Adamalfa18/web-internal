<x-clinet-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.clientnavbar />
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
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Daftar Laporan Bulanan</h6>
                                    <p class="text-sm">Berikut adalah list daftar laporan Bulanan</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                                <div class="input-group w-sm-25 ms-auto">
                                    <span class="input-group-text text-body">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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
                                                    No</th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Target Spent</th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Target Revenue</th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Target Roas</th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Tanggal</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reports as $index => $report)
                                                <tr>
                                                    <td class="align-middle text-center">
                                                        {{ $reports->firstItem() + $index }}</td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-sm font-weight-normal">{{ $report->target_spent }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-sm font-weight-normal">{{ $report->target_revenue }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-sm font-weight-normal">{{ $report->target_roas }}</span>
                                                    </td>
                                                    <td class="align-middle text-center report-date">
                                                        <span
                                                            class="text-secondary text-sm font-weight-normal">{{ \Carbon\Carbon::parse($report->report_date)->format('F Y') }}</span>
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
                                                        <a href="{{ route('data-client.laporan-harian', ['performance_bulanan_id' => $report->id]) }}"
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
                                                                    Detail Laporan Bulanan
                                                                    {{ \Carbon\Carbon::parse($report->report_date)->format('d F Y') }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="pt-0 card-body">

                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label for="target_spant">Target
                                                                                Spent</label>
                                                                            <input type="text" name="name"
                                                                                id="name"
                                                                                value="{{ $report->target_spent }}"
                                                                                class="form-control" disabled>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label for="target_revenue">Target
                                                                                Revenue</label>
                                                                            <input
                                                                                value="{{ $report->target_revenue }}"
                                                                                class="form-control" disabled>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label for="target_roas">Target
                                                                                Roas</label>
                                                                            <input value="{{ $report->target_roas }}"
                                                                                class="form-control" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mt-2">
                                                                        <div class="col-12">
                                                                            <label
                                                                                for="informasi_tambahan">Note</label>
                                                                            <textarea name="informasi_tambahan" id="informasi_tambahan" rows="3" class="form-control" disabled>{{ $report->note }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-4">
                                                                            <label
                                                                                for="informasi_tambahan	">Bulan</label>
                                                                            <input
                                                                                value=" {{ \Carbon\Carbon::parse($report->report_date)->format('d F Y') }}"
                                                                                class="form-control" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="d-flex justify-content-center">
                                        <ul class="pagination">
                                            @if ($reports->onFirstPage())
                                                <li class="page-item disabled"><span class="page-link">&laquo;</span>
                                                </li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $reports->previousPageUrl() }}">&laquo;</a></li>
                                            @endif

                                            @for ($i = 1; $i <= $reports->lastPage(); $i++)
                                                @if ($i == $reports->currentPage())
                                                    <li class="page-item active"><span
                                                            class="page-link">{{ $i }}</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ $reports->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor

                                            @if ($reports->hasMorePages())
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $reports->nextPageUrl() }}">&raquo;</a></li>
                                            @else
                                                <li class="page-item disabled"><span class="page-link">&raquo;</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                <label for="dataCount" class="me-2">Tampilkan:</label>
                                <select id="dataCount" class="form-select" onchange="changeDataCount()">
                                    <option value="10"
                                        {{ isset($dataCount) && $dataCount == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20"
                                        {{ isset($dataCount) && $dataCount == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50"
                                        {{ isset($dataCount) && $dataCount == 50 ? 'selected' : '' }}>50</option>
                                    <option value="60"
                                        {{ isset($dataCount) && $dataCount == 60 ? 'selected' : '' }}>60</option>
                                    <option value="80"
                                        {{ isset($dataCount) && $dataCount == 80 ? 'selected' : '' }}>80</option>
                                    <option value="100"
                                        {{ isset($dataCount) && $dataCount == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function searchByDate() {
                const input = document.getElementById('searchInput');
                const filter = input.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const dateCell = row.querySelector('.report-date span'); // Pastikan selector ini benar
                    if (dateCell) {
                        const dateText = dateCell.textContent || dateCell.innerText;
                        row.style.display = dateText.toLowerCase().includes(filter) ? '' : 'none';
                    }
                });
            }

            function changeDataCount() {
                const count = document.getElementById('dataCount').value;
                // Pastikan URL sesuai dengan rute yang ada
                window.location.href = `?count=${count}`; // Sesuaikan URL sesuai kebutuhan
            }
        </script>

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
