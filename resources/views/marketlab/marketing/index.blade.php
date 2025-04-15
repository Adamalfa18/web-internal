<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
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
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Data Client</h6>
                                            <p class="text-sm">Berikut adalah list daftar client</p>
                                        </div>
                                        <div class="ms-auto d-flex">
                                            <a class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2"
                                                data-toggle="modal" data-target="#addClientModal">
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




                                <!-- Modal -->
                                <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addClientModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addClientModalLabel">Tambah Client</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form-marketing" action="{{ route('clients.store') }}"
                                                method="POST" onsubmit="return validateCheckboxes()"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-6" style="display: none;">
                                                        <div class="mb-3">
                                                            <div>
                                                                <label class="form-label">Layanan:</label>
                                                            </div>
                                                            @foreach ($layanans as $layanan)
                                                                <div class="form-check form-check-inline mt-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="layanan[]" value="{{ $layanan->id }}"
                                                                        required checked>
                                                                    <label
                                                                        class="form-check-label">{{ $layanan->nama_layanan }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-md-6" style="display: none;">
                                                            <div class="mb-3">
                                                                <label for="status_client" class="form-label">Status
                                                                    Client</label>
                                                                <input type="hidden" class="form-control"
                                                                    name="status_client" value="1"
                                                                    id="status_client" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="nama_client" class="form-label">Nama
                                                                Client</label>
                                                            <input type="text" class="form-control"
                                                                name="nama_client" id="nama_client"
                                                                placeholder="Marketlab....." required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="nama_brand" class="form-label">Nama
                                                                Brand</label>
                                                            <input type="text" class="form-control"
                                                                name="nama_brand" id="nama_brand"
                                                                placeholder="Marketlab......" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="nama_finance" class="form-label">Nama
                                                                Finance</label>
                                                            <input type="text" class="form-control"
                                                                name="nama_finance" id="nama_finance"
                                                                placeholder="Nama Finance" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <div class="mb-3">
                                                                <label for="date_in" class="form-label">Date
                                                                    In</label>
                                                                <input type="date" class="form-control"
                                                                    name="date_in" id="date_in" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email
                                                                Client</label>
                                                            <input type="email" class="form-control" name="email"
                                                                id="email" placeholder="Marketlab@gmail.com"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="telepon_finance" class="form-label">No
                                                                Telpon</label>
                                                            <input type="number" class="form-control"
                                                                name="telepon_finance" id="telepon_finance"
                                                                placeholder="08975454..." required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="pj" class="form-label">Status
                                                                Client</label>
                                                            <select class="form-select" name="pj" id="pj"
                                                                aria-label="Default select example" required>
                                                                <option value="Insan">Insan</option>
                                                                <option value="Feby">Feby</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="pegawai_id" class="form-label">Pegawai</label>
                                                            <select data-live-search="true"
                                                                class="form-select ukuran-select  @error('pegawai_id') is-invalid @enderror"
                                                                name="pegawai_id">
                                                                @foreach ($pegawai as $peg)
                                                                    @if (old('pegawai_id') == $peg->id)
                                                                        <option value="{{ $peg->id }}" selected>
                                                                            {{ $peg->id }}-{{ $peg->nama }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $peg->id }}">
                                                                            {{ $peg->id }}-{{ $peg->nama }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="gambar_client" class="form-label">Logo
                                                                Brand</label>
                                                            <input type="file" class="form-control"
                                                                name="gambar_client" id="gambar_client"
                                                                accept="image/*">
                                                        </div>
                                                    </div>
                                                    <label>Pilih Layanan:</label>
                                                    <div class="grid grid-cols-2 gap-2 mb-4">
                                                        @foreach ($layanans as $layanan)
                                                            <label
                                                                class="flex items-center space-x-2 bg-gray-100 p-2 rounded shadow">
                                                                <input type="checkbox" name="layanan_ids[]"
                                                                    value="{{ $layanan->id }}">
                                                                <span>{{ $layanan->nama_layanan }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">Alamat
                                                                Client</label>
                                                            <textarea type="text" class="form-control" name="alamat" id="alamat"
                                                                placeholder="Jl. Summarecon Bandung....." rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="informasi_tambahan"
                                                                class="form-label">Note</label>
                                                            <textarea class="form-control" name="informasi_tambahan" id="informasi_tambahan" placeholder="Note....."
                                                                rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-top py-3 px-3 d-flex align-items-center">
                                                    <div class="ms-auto">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-white mb-0">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabel Data Client -->




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
