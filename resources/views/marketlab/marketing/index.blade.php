<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="collapse multi-collapse show" id="multiCollapseExample1">
                        <div class="card card-body">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Data Layanan</h6>
                                            <p class="text-sm">Berikut adalah list daftar layanan</p>
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

                                <!-- Pindahkan notifikasi error dan success ke sini -->
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive p-0">
                                        <!-- Notifikasi Error -->
                                        @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <!-- Notifikasi Success -->
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <!-- Tabel Data Layanan -->
                                        <table class="table align-items-center mb-0">
                                            <thead class="bg-gray-100">
                                                <tr class="tabel-style">
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        No
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama Layanan
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Tanggal Landing</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama Client</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama Brand</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Status</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($client_layanans as $cl)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            {{ $loop->iteration }}
                                                        </td>

                                                        <td class="align-middle text-center text-sm">
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
                                                                <div class="d-flex flex-column justify-content-center ms-1">
                                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                                        {{ $cl->client->nama_brand ?? '-' }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="align-middle text-center text-sm">
                                                            @switch($cl->status)
                                                                @case(1)
                                                                    <span class="badge badge-sm border border-success text-success badge-aktif">
                                                                        Aktif
                                                                    </span>
                                                                    @break
                                                        
                                                                @case(0)
                                                                    <span class="badge badge-sm border border-danger text-danger badge-paid">
                                                                        Tidak Aktif
                                                                    </span>
                                                                    @break
                                                            @endswitch
                                                        </td>                                                        

                                                        <td class="align-middle">
                                                            {{-- Tampilkan data bulanan --}}
                                                            <a href="{{ route('laporan-bulanan.index', ['client_id' => $cl->client->id]) }}"
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

                                                            {{-- Edit Data --}}
                                                            <a href="{{ route('marketing.edit', $cl->id) }}"
                                                                type="button"
                                                                class="btn btn-primary text-secondary font-weight-bold text-xs active-client"
                                                                data-bs-toggle="tooltip" data-bs-title="Edit layanan">
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

                    <!-- Modal Add Service -->
                    <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog"
                    aria-labelledby="addServiceModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addServiceModalLabel">Tambah Service</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="form-marketing" action="{{ route('client_layanan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="client_id" class="form-label">Nama Client</label>
                                                    <select class="form-select" name="client_id" id="client_id" required>
                                                        <option value="">Pilih Client</option>
                                                        @foreach($clients->filter(function($client) { return $client->status_client == 1; }) as $client)
                                                            <option value="{{ $client->id }}">{{ $client->nama_client }} - {{ $client->nama_brand }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="layanan_id" class="form-label">Nama Layanan</label>
                                                    <select class="form-select" name="layanan_id" id="layanan_id" required>
                                                        <option value="">Pilih Layanan</option>
                                                        @foreach($layanans as $layanan)
                                                            @if (!$client->layanans->contains('id', $layanan->id))
                                                                <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('layanan_id')
                                                        <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="created_at" class="form-label">Tanggal Assign</label>
                                                    <input type="date" class="form-control" name="created_at" id="created_at" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Add Service -->



                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <div class="card card-body">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Data Client</h6>
                                            <p class="text-sm">Berikut adalah list daftar client</p>
                                        </div>
                                        <div class="ms-auto d-flex">
                                            <a class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2"
                                                href="{{ route('clients.create') }}" role="button">
                                                <span class="btn-inner--icon">
                                                    <svg width="16" height="16"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="d-block me-2">
                                                        <path
                                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                    </svg>
                                                </span>
                                                <span class="btn-inner--text">Add Client</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
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

                                                            {{-- Edit Data --}}
                                                            <a href="{{ route('clients.edit', $client->id) }}"
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
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Data Client</h6>
                                            <p class="text-sm">Berikut adalah list daftar client</p>
                                        </div>
                                        <div class="ms-auto d-flex">
                                            <a class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2"
                                                href="{{ route('clients.create') }}" role="button">
                                                <span class="btn-inner--icon">
                                                    <svg width="16" height="16"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="d-block me-2">
                                                        <path
                                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                    </svg>
                                                </span>
                                                <span class="btn-inner--text">Add Client</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
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

                                                            {{-- Edit Data --}}
                                                            <a href="{{ route('clients.edit', $client->id) }}"
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
    <!-- Include jQuery dan Bootstrap JS -->
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
