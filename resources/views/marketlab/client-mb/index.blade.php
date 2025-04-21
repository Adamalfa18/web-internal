<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="font-weight-semibold text-lg mb-3">Data Status</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button id="btnTargetRoas" class="btn btn-primary btn-style-client"
                                                type="button"
                                                onclick="toggleCollapse('multiCollapseExample1', this)">Client
                                                Aktip</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button id="btnTargetLead2" class="btn btn-primary btn-style-client"
                                                type="button"
                                                onclick="toggleCollapse('multiCollapseExample2', this)">Client
                                                Pending</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button id="btnTargetLead3" class="btn btn-primary btn-style-client"
                                                type="button"
                                                onclick="toggleCollapse('multiCollapseExample3', this)">Client Tidak
                                                Aktip</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="collapse multi-collapse show" id="multiCollapseExample1">
                        <div class="card card-body">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead class="bg-gray-100">
                                                <tr class="tabel-style">
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">No
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama
                                                        Brand
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama Client</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Penanggung Jawab</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Tanggal Aktip</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients->filter(function ($client) {
        return $client->status_client == 1;
    }) as $client)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            {{-- Mengubah cara menghitung nomor urut laporan --}}
                                                            <span class="day-style text-sm font-weight-normal">
                                                                {{ $loop->iteration + ($clients->currentPage() - 1) * $clients->perPage() }}
                                                            </span>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset('storage/' . $client->gambar_client) }}"
                                                                        class="avatar avatar-sm rounded-circle me-2"
                                                                        alt="user1">
                                                                </div>
                                                                <div
                                                                    class="d-flex flex-column justify-content-center ms-1">
                                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                                        {{ $client->nama_brand }}</h6>
                                                                    <p class="text-sm text-secondary mb-0">
                                                                        {{ $client->email }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $client->nama_client }}</p>
                                                            <p class="text-sm text-secondary mb-0">
                                                                {{ $client->telepon_finance }}</p>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $client->pj }}</p>
                                                            <p class="text-sm text-secondary mb-0">
                                                                {{ $client->pegawai->nama }}</p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            @switch($client->status_client)
                                                                @case(1)
                                                                    <span
                                                                        class="badge badge-sm border border-success text-success badge-aktif">Aktif
                                                                    </span>
                                                                @break

                                                                @case(2)
                                                                    <span
                                                                        class="badge badge-sm border border-warning text-warning badge-pending">Pending
                                                                    </span>
                                                                @break

                                                                @case(3)
                                                                    <span
                                                                        class="badge badge-sm border border-danger text-danger badge-paid">Paid
                                                                    </span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-sm font-weight-normal">
                                                                {{ $client->date_in }}
                                                            </span>
                                                        </td>
                                                        <td class="align-middle">
                                                            {{-- Tampilkan data bulanan --}}
                                                            <a href="{{ route('laporan-bulanan.index', ['client_id' => $client->id]) }}"
                                                                type="button"
                                                                class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-title="Laporan Bulanan">
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
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="border-top py-3 px-3 d-flex align-items-center">
                                        <p class="font-weight-semibold mb-0 text-dark text-sm">Page
                                            {{ $currentPage }} of
                                            {{ $totalPages }}</p>
                                        <div class="ms-auto">
                                            @if ($totalPages > 1)
                                                @if ($currentPage == 1)
                                                    <button class="btn btn-sm btn-white mb-0" disabled>Previous</button>
                                                @else
                                                    <a href="{{ $clients->previousPageUrl() . '&status=' . request('status') . '&search=' . request('search') }}"
                                                        class="btn btn-sm btn-white mb-0">Previous</a>
                                                @endif
                                                @if ($currentPage == $totalPages)
                                                    <button class="btn btn-sm btn-white mb-0" disabled>Next</button>
                                                @else
                                                    <a href="{{ $clients->nextPageUrl() . '&status=' . request('status') . '&search=' . request('search') }}"
                                                        class="btn btn-sm btn-white mb-0">Next</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <div class="card card-body">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead class="bg-gray-100">
                                                <tr class="tabel-style">
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        No
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama
                                                        Brand
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama Client</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Penanggung Jawab</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Tanggal Aktip</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients->filter(function ($client) {
        return $client->status_client == 2;
    }) as $client)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            {{-- Mengubah cara menghitung nomor urut laporan --}}
                                                            <span class="day-style text-sm font-weight-normal">
                                                                {{ $loop->iteration + ($clients->currentPage() - 1) * $clients->perPage() }}
                                                            </span>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset('storage/' . $client->gambar_client) }}"
                                                                        class="avatar avatar-sm rounded-circle me-2"
                                                                        alt="user1">
                                                                </div>
                                                                <div
                                                                    class="d-flex flex-column justify-content-center ms-1">
                                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                                        {{ $client->nama_brand }}</h6>
                                                                    <p class="text-sm text-secondary mb-0">
                                                                        {{ $client->email }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $client->nama_client }}</p>
                                                            <p class="text-sm text-secondary mb-0">
                                                                {{ $client->telepon_finance }}</p>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $client->pj }}</p>
                                                            <p class="text-sm text-secondary mb-0">
                                                                {{ $client->pegawai->nama }}</p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            @switch($client->status_client)
                                                                @case(1)
                                                                    <span
                                                                        class="badge badge-sm border border-success text-success badge-aktif">Aktif
                                                                    </span>
                                                                @break

                                                                @case(2)
                                                                    <span
                                                                        class="badge badge-sm border border-warning text-warning badge-pending">Pending
                                                                    </span>
                                                                @break

                                                                @case(3)
                                                                    <span
                                                                        class="badge badge-sm border border-danger text-danger badge-paid">Paid
                                                                    </span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-sm font-weight-normal">
                                                                {{ $client->date_in }}
                                                            </span>
                                                        </td>
                                                        <td class="align-middle">
                                                            {{-- Tampilkan data bulanan --}}
                                                            <a href="{{ route('laporan-bulanan.index', ['client_id' => $client->id]) }}"
                                                                type="button"
                                                                class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-title="Laporan Bulanan">
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
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="border-top py-3 px-3 d-flex align-items-center">
                                        <p class="font-weight-semibold mb-0 text-dark text-sm">Page
                                            {{ $currentPage }} of
                                            {{ $totalPages }}</p>
                                        <div class="ms-auto">
                                            @if ($totalPages > 1)
                                                @if ($currentPage == 1)
                                                    <button class="btn btn-sm btn-white mb-0"
                                                        disabled>Previous</button>
                                                @else
                                                    <a href="{{ $clients->previousPageUrl() . '&status=' . request('status') . '&search=' . request('search') }}"
                                                        class="btn btn-sm btn-white mb-0">Previous</a>
                                                @endif
                                                @if ($currentPage == $totalPages)
                                                    <button class="btn btn-sm btn-white mb-0" disabled>Next</button>
                                                @else
                                                    <a href="{{ $clients->nextPageUrl() . '&status=' . request('status') . '&search=' . request('search') }}"
                                                        class="btn btn-sm btn-white mb-0">Next</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="collapse multi-collapse" id="multiCollapseExample3">
                        <div class="card card-body">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead class="bg-gray-100">
                                                <tr class="tabel-style">
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        No
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama
                                                        Brand
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama Client</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Penanggung Jawab</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Tanggal Aktip</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients->filter(function ($client) {
        return $client->status_client == 3;
    }) as $client)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            {{-- Mengubah cara menghitung nomor urut laporan --}}
                                                            <span class="day-style text-sm font-weight-normal">
                                                                {{ $loop->iteration + ($clients->currentPage() - 1) * $clients->perPage() }}
                                                            </span>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset('storage/' . $client->gambar_client) }}"
                                                                        class="avatar avatar-sm rounded-circle me-2"
                                                                        alt="user1">
                                                                </div>
                                                                <div
                                                                    class="d-flex flex-column justify-content-center ms-1">
                                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                                        {{ $client->nama_brand }}</h6>
                                                                    <p class="text-sm text-secondary mb-0">
                                                                        {{ $client->email }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $client->nama_client }}</p>
                                                            <p class="text-sm text-secondary mb-0">
                                                                {{ $client->telepon_finance }}</p>
                                                        </td>
                                                        <td class="client-name-style">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $client->pj }}</p>
                                                            <p class="text-sm text-secondary mb-0">
                                                                {{ $client->pegawai->nama }}</p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            @switch($client->status_client)
                                                                @case(1)
                                                                    <span
                                                                        class="badge badge-sm border border-success text-success badge-aktif">Aktif
                                                                    </span>
                                                                @break

                                                                @case(2)
                                                                    <span
                                                                        class="badge badge-sm border border-warning text-warning badge-pending">Pending
                                                                    </span>
                                                                @break

                                                                @case(3)
                                                                    <span
                                                                        class="badge badge-sm border border-danger text-danger badge-paid">Paid
                                                                    </span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-sm font-weight-normal">
                                                                {{ $client->date_in }}
                                                            </span>
                                                        </td>
                                                        <td class="align-middle">
                                                            {{-- Tampilkan data bulanan --}}
                                                            <a href="{{ route('laporan-bulanan.index', ['client_id' => $client->id]) }}"
                                                                type="button"
                                                                class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-title="Laporan Bulanan">
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
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="border-top py-3 px-3 d-flex align-items-center">
                                        <p class="font-weight-semibold mb-0 text-dark text-sm">Page
                                            {{ $currentPage }} of
                                            {{ $totalPages }}</p>
                                        <div class="ms-auto">
                                            @if ($totalPages > 1)
                                                @if ($currentPage == 1)
                                                    <button class="btn btn-sm btn-white mb-0"
                                                        disabled>Previous</button>
                                                @else
                                                    <a href="{{ $clients->previousPageUrl() . '&status=' . request('status') . '&search=' . request('search') }}"
                                                        class="btn btn-sm btn-white mb-0">Previous</a>
                                                @endif
                                                @if ($currentPage == $totalPages)
                                                    <button class="btn btn-sm btn-white mb-0" disabled>Next</button>
                                                @else
                                                    <a href="{{ $clients->nextPageUrl() . '&status=' . request('status') . '&search=' . request('search') }}"
                                                        class="btn btn-sm btn-white mb-0">Next</a>
                                                @endif
                                            @endif
                                        </div>
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
        function toggleCollapse(showId, activeButton) {
            // Hide all elements with class multi-collapse
            document.querySelectorAll('.multi-collapse').forEach(function(collapse) {
                collapse.classList.remove('show'); // Hide all elements
            });

            // Remove active class from all buttons
            document.querySelectorAll('.btn-style-client').forEach(function(btn) {
                btn.classList.remove('active'); // Remove active class from all buttons
            });

            // Add active class to the clicked button
            activeButton.classList.add('active');

            // Show the selected element
            var showElement = document.getElementById(showId);
            showElement.classList.add('show');
        }
    </script>

</x-app-layout>
