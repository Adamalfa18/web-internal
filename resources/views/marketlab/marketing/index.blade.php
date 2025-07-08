<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="collapse multi-collapse show" id="multiCollapseExample1">
                        <div class="card card-body">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Service List</h6>
                                            <p class="text-sm">Marketlab clients services list</p>
                                        </div>
                                        <div class="ms-auto d-flex">
                                            <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                                data-toggle="modal" data-target="#addServiceModal">
                                                <span class="btn-inner--icon">
                                                    <svg width="16" height="16"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="d-block me-2">
                                                        <path
                                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                    </svg>
                                                </span>
                                                <span class="btn-inner--text">Add Service</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <!-- Filters -->
                                    <form id="filterForm" method="GET" class="d-flex m-3 gap-2">

                                        <!-- Filter berdasarkan Layanan -->
                                        <select name="clientFilter" class="form-select me-2">
                                            <option value="">Select Service</option>
                                            @foreach ($layanans as $layanan)
                                                <option value="{{ $layanan->id }}"
                                                    {{ request('clientFilter') == $layanan->id ? 'selected' : '' }}>
                                                    {{ $layanan->nama_layanan }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- Filter berdasarkan Tanggal Landing -->
                                        <input type="date" name="dateFilter" value="{{ request('dateFilter') }}"
                                            class="form-control" />

                                        <!-- Filter brand -->
                                        <input type="text" name="brand" value="{{ request('brand') }}"
                                            class="form-control" placeholder="Search Brand Name">

                                        <button type="submit" class="btn btn-primary">Filter</button>

                                        <a href="{{ route('marketing.index') }}?status={{ request('status', 1) }}"
                                            class="btn btn-secondary" id="resetFilter">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                            </svg>
                                        </a>
                                    </form>
                                </div>

                                <!-- Pindahkan notifikasi error dan success ke sini -->
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive p-0">
                                        @if (session('success') || session('error'))
                                            <script>
                                                alert("{{ session('success') ?: session('error') }}")
                                            </script>
                                        @endif

                                        <!-- Tabel Data Layanan -->
                                        <table class="table align-items-center mb-0">
                                            <thead class="bg-gray-100">
                                                <tr class="tabel-style">
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">No
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Service</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Landing Date</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Client Name</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Brand Name</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Penaggung Jawab</th>

                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Status</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($client_layanans as $cl)
                                                    <tr data-client-id="{{ $cl->client->id ?? '' }}"
                                                        data-landing-date="{{ $cl->created_at ? $cl->created_at->format('Y-m-d') : '' }}">
                                                        <td class="align-middle text-center">
                                                            {{ $loop->iteration }}
                                                        </td>

                                                        <td class="align-middle">
                                                            <span class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $cl->layanan->nama_layanan ?? '-' }}
                                                            </span>
                                                        </td>

                                                        <td class="align-middle text-center text-sm">
                                                            <span class="text-secondary text-sm font-weight-normal">
                                                                {{ $cl->created_at ? $cl->created_at->format('d M Y') : '-' }}
                                                            </span>
                                                        </td>

                                                        <td class="client-name-style">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $cl->client->nama_client ?? '-' }}
                                                            </p>
                                                        </td>

                                                        <td class="client-name-style">
                                                            <div class="d-flex px-2 py-1">
                                                                <div
                                                                    class="d-flex flex-column justify-content-center ms-1">
                                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                                        {{ $cl->client->nama_brand ?? '-' }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <div class="d-flex px-2 py-1">
                                                                <div
                                                                    class="d-flex flex-column justify-content-center ms-1">
                                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                                        {{ $cl->pegawai->nama ?? '-' }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="align-middle text-center text-sm">
                                                            @switch($cl->status)
                                                                @case(1)
                                                                    <span
                                                                        class="badge badge-sm border border-success text-success badge-aktif">
                                                                        Aktif
                                                                    </span>
                                                                @break

                                                                @case(2)
                                                                    <span
                                                                        class="badge badge-sm border border-warning text-warning badge-warning">
                                                                        Pending
                                                                    </span>
                                                                @break

                                                                @case(3)
                                                                    <span
                                                                        class="badge badge-sm border border-danger text-danger badge-paid">
                                                                        Tidak Aktif
                                                                    </span>
                                                                @break
                                                            @endswitch
                                                        </td>

                                                        <td class="align-middle">
                                                            <a href="{{ route('marketing.edit', $cl->id) }}"
                                                                class="btn btn-primary text-secondary font-weight-bold text-xs active-client"
                                                                data-bs-toggle="tooltip" data-bs-title="Edit layanan">
                                                                <svg width="20" height="20"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" strokeWidth={1.5}
                                                                    stroke="currentColor">
                                                                    <path strokeLinecap="round" strokeLinejoin="round"
                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <!-- Pagination -->
                                        <div class="d-flex justify-content-center mt-4">
                                            {{ $client_layanans->appends(request()->except('page'))->links('vendor.pagination.custom') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Modal Add Service -->
                    <!-- Modal Tambah Service -->
                    <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog"
                        aria-labelledby="addServiceModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addServiceModalLabel">Add Layanan</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="form-marketing" action="{{ route('client_layanan.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="client_id" class="form-label">Nama Brand</label>
                                            <select class="form-select" name="client_id" id="client_id" required>
                                                <option value="">Pilih Brand</option>
                                                @foreach ($clients->filter(fn($client) => $client->status_client == 1) as $client)
                                                    <option value="{{ $client->id }}">{{ $client->nama_brand }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="layanan_id" class="form-label">Nama Layanan</label>
                                            <select class="form-select" name="layanan_id" id="layanan_id" required>
                                                <option value="">Pilih Layanan</option>
                                                @foreach ($layanans as $layanan)
                                                    <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pegawai_id" class="form-label">Penaggung Jawab</label>
                                            <select data-live-search="true"
                                                class="form-select ukuran-select  @error('pegawai_id') is-invalid @enderror"
                                                name="pegawai_id">
                                                @foreach ($pegawai as $peg)
                                                    @if (old('pegawai_id') == $peg->id)
                                                        <option value="{{ $peg->id }}" selected>
                                                            {{ $peg->nama }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $peg->id }}">
                                                            {{ $peg->nama }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="created_at" class="form-label">Tanggal Assign</label>
                                            <input type="date" class="form-control" name="created_at"
                                                id="created_at" required>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <!-- End Modal Add Service -->

                </div>
            </div>
        </div>

    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clientFilter = document.getElementById('clientFilter');
            const dateFilter = document.getElementById('dateFilter');

            clientFilter.addEventListener('change', filterTable);
            dateFilter.addEventListener('change', filterTable);

            function filterTable() {
                const clientId = clientFilter.value;
                const selectedDate = dateFilter.value;

                const rows = document.querySelectorAll('table tbody tr');

                rows.forEach(function(row) {
                    const rowClientId = row.getAttribute('data-client-id');
                    const rowDate = row.getAttribute('data-landing-date');

                    let showRow = true;

                    if (clientId && clientId !== rowClientId) {
                        showRow = false;
                    }

                    if (selectedDate && selectedDate !== rowDate) {
                        showRow = false;
                    }

                    row.style.display = showRow ? '' : 'none';
                });
            }
        });
    </script>

</x-app-layout>
