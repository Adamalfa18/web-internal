<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-body mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button
                                            class="btn btn-style-client {{ request('status', 1) == 1 ? 'btn-primary active' : 'btn-outline-primary' }}"
                                            type="button" onclick="filterByStatus(1)">
                                            Client Aktif
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button
                                            class="btn btn-style-client {{ request('status') == 2 ? 'btn-primary active' : 'btn-outline-primary' }}"
                                            type="button" onclick="filterByStatus(2)">
                                            Client Tidak Aktif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Add Client -->
                    <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog"
                        aria-labelledby="addClientModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addClientModalLabel">Edit Data Client</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Akhir notifikasi error -->
                                <form class="form-marketing" action="{{ route('clients.store') }}" method="POST"
                                    onsubmit="return validateCheckboxes()" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6" style="display: none;">
                                            <div class="mb-3">
                                                <div>
                                                    <label class="form-label">Layanan:</label>
                                                </div>
                                                @foreach ($layanans as $layanan)
                                                    <div class="form-check form-check-inline mt-2">
                                                        <input class="form-check-input" type="checkbox" name="layanan[]"
                                                            value="{{ $layanan->id }}" required checked>
                                                        <label
                                                            class="form-check-label">{{ $layanan->nama_layanan }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-6" style="display: none;">
                                                <div class="mb-3">
                                                    <label for="status_client" class="form-label">Status Client</label>
                                                    <input type="hidden" class="form-control" name="status_client"
                                                        value="1" id="status_client" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_client" class="form-label">Nama Client</label>
                                                <input type="text" class="form-control" name="nama_client"
                                                    id="nama_client" placeholder="Marketlab....." required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_brand" class="form-label">Nama Brand</label>
                                                <input type="text" class="form-control" name="nama_brand"
                                                    id="nama_brand" placeholder="Marketlab......" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_finance" class="form-label">Nama Finance</label>
                                                <input type="text" class="form-control" name="nama_finance"
                                                    id="nama_finance" placeholder="Nama Finance" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="date_in" class="form-label">Date In</label>
                                                    <input type="date" class="form-control" name="date_in"
                                                        id="date_in" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Client</label>
                                                <input type="email" class="form-control" name="email"
                                                    id="email" placeholder="Marketlab@gmail.com" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="telepon_finance" class="form-label">No Telpon</label>
                                                <input type="number" class="form-control" name="telepon_finance"
                                                    id="telepon_finance" placeholder="08975454..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="pj" class="form-label">Penagung Jawab</label>
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
                                                <label for="gambar_client" class="form-label">Logo Brand</label>
                                                <input type="file" class="form-control" name="gambar_client"
                                                    id="gambar_client" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat Client</label>
                                                <textarea type="text" class="form-control" name="alamat" id="alamat"
                                                    placeholder="Jl. Summarecon Bandung....." rows="3" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="informasi_tambahan" class="form-label">Note</label>
                                                <textarea class="form-control" name="informasi_tambahan" id="informasi_tambahan" placeholder="Note....."
                                                    rows="3" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top py-3 px-3 d-flex align-items-center">
                                        <div class="ms-auto">
                                            <button type="submit" class="btn btn-sm btn-white mb-0">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Add Client -->

                    <div class="card card-body">
                        <div class="card border shadow-xs border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <div class="d-sm-flex align-items-center">
                                    <div>
                                        <h6 class="font-weight-semibold text-lg mb-0">Data Client</h6>
                                        <p class="text-sm">Berikut adalah list daftar client</p>
                                    </div>
                                    <div class="ms-auto d-flex">
                                        <a class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2"
                                            data-toggle="modal" data-target="#addClientModal">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                            <span class="btn-inner--text">Add Client Modal</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <form id="filterForm" method="GET" class="d-flex m-3 gap-2">
                        <input type="hidden" name="status" value="{{ request('status', 1) }}">
                        <input type="text" name="brand" value="{{ request('brand') }}" class="form-control"
                            placeholder="Cari Nama Brand">
                        <input type="date" name="date_aktif" value="{{ request('date_aktif') }}"
                            class="form-control">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('clients.index') }}?status={{ request('status', 1) }}"
                            class="btn btn-secondary" id="resetFilter">
                            Filter
                        </a>
                    </form>

                    <!-- Data Table -->
                    <div class="collapse multi-collapse show" id="multiCollapseExample1">
                        <div class="card card-body">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0" id="clientTable">
                                            <thead class="bg-gray-100">
                                                <tr class="tabel-style">
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        No
                                                    </th>
                                                    <th class="text-secondary font-weight-semibold opacity-7">
                                                        Nama Brand</th>
                                                    <th class="text-secondary font-weight-semibold opacity-7">
                                                        Nama Client</th>
                                                    <th class="text-secondary font-weight-semibold opacity-7">
                                                        Penanggung Jawab</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Tanggal Aktif</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients as $key => $client)
                                                    <tr>
                                                        <td class="text-sm">
                                                            {{ ($clients->currentPage() - 1) * $clients->perPage() + $loop->iteration }}
                                                        </td>
                                                        <td class="client-tab-style">
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
                                                                        {{ $client->email }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="client-tab-style">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $client->nama_client }}</p>
                                                            <p class="text-sm text-secondary mb-0">
                                                                {{ $client->telepon_finance }}</p>
                                                        </td>
                                                        <td class="client-tab-style">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $client->pj }}</p>
                                                            <p class="text-sm text-secondary mb-0">
                                                                {{ $client->pegawai->nama }}</p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            @switch($client->status_client)
                                                                @case(1)
                                                                    <span
                                                                        class="badge badge-sm border border-success text-success badge-aktif">Aktif</span>
                                                                @break

                                                                @case(2)
                                                                    <span
                                                                        class="badge badge-sm border border-danger text-danger badge-paid">Paid</span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-sm font-weight-normal">{{ $client->date_in }}</span>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#editClientModal{{ $client->id }}"
                                                                class="btn btn-primary text-secondary font-weight-bold text-xs active-client">
                                                                <svg width="20" height="20"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
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
                                            {{ $clients->appends(request()->except('page'))->links('vendor.pagination.custom') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Client Modals -->
        @foreach ($clients as $client)
            <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editClientModalLabel{{ $client->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editClientModalLabel{{ $client->id }}">
                                Edit Data
                                Client</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Akhir notifikasi error -->
                        <form class="form-marketing" action="{{ route('clients.update', $client->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $client->id }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nama_client">Nama
                                            Client</label>
                                        <input type="text"
                                            class="form-control @error('nama_client') is-invalid @enderror"
                                            id="nama_client" name="nama_client"
                                            value="{{ old('nama_client', $client->nama_client) }}" required>
                                        @error('nama_client')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nama_brand">Nama
                                            Brand</label>
                                        <input type="text"
                                            class="form-control @error('nama_brand') is-invalid @enderror"
                                            id="nama_brand" name="nama_brand"
                                            value="{{ old('nama_brand', $client->nama_brand) }}">
                                        @error('nama_brand')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nama_finance">Nama
                                            Finance</label>
                                        <input type="text"
                                            class="form-control @error('nama_finance') is-invalid @enderror"
                                            id="nama_finance" name="nama_finance"
                                            value="{{ old('nama_finance', $client->nama_finance) }}">
                                        @error('nama_finance')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="date_in">Date
                                                In</label>
                                            <input type="date"
                                                class="form-control @error('date_in') is-invalid @enderror"
                                                id="date_in" name="date_in"
                                                value="{{ old('date_in', $client->date_in) }}" required>
                                            @error('date_in')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            name="email" value="{{ old('email', $client->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="telepon_finance">Telepon
                                            Finance</label>
                                        <input type="text"
                                            class="form-control @error('telepon_finance') is-invalid @enderror"
                                            id="telepon_finance" name="telepon_finance"
                                            value="{{ old('telepon_finance', $client->telepon_finance) }}">
                                        @error('telepon_finance')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="pj" class="form-label">PJ</label>
                                        <select class="form-select" name="pj" id="pj"
                                            aria-label="Default select example" required>
                                            <option value="Insan" {{ $client->pj == 'Insan' ? 'selected' : '' }}>
                                                Insan</option>
                                            <option value="Feby" {{ $client->pj == 'Feby' ? 'selected' : '' }}>Feby
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="pegawai_id" class="form-label">Id
                                            Pegawai</label>
                                        <select data-live-search="true"
                                            class="form-select ukuran-select  @error('pegawai_id') is-invalid @enderror"
                                            name="pegawai_id">
                                            @foreach ($pegawai as $peg)
                                                @if (old('pegawai_id', $client->pegawai_id) == $peg->id)
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
                                        <label for="status_client">Status
                                            Client</label>
                                        <select class="form-select" name="status_client" id="status_client"
                                            aria-label="Default select example" required>
                                            <option value="1"
                                                {{ $client->status_client == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="2"
                                                {{ $client->status_client == 2 ? 'selected' : '' }}>Tidak Aktif
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="informasi_tambahan">Informasi
                                            Tambahan</label>
                                        <textarea class="form-control @error('informasi_tambahan') is-invalid @enderror" id="informasi_tambahan"
                                            name="informasi_tambahan">{{ old('informasi_tambahan', $client->informasi_tambahan) }}</textarea>
                                        @error('informasi_tambahan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">{{ old('alamat', $client->alamat) }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gambar_client" class="form-label">Gambar
                                            Client</label>
                                        @if ($client->gambar_client)
                                            <img src="{{ asset('storage/' . $client->gambar_client) }}"
                                                class="style-logo img-preview img-fluid mb-3 col-sm-5 d-block">
                                        @else
                                            <img class="img-preview img-fluid mb-3 col-sm-5" style="display:none;">
                                        @endif
                                        <input class="form-control @error('gambar_client') is-invalid @enderror"
                                            type="file" id="gambar_client" name="gambar_client"
                                            onchange="previewImage()">
                                        @error('gambar_client')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3" style="display: none;">
                                <div>
                                    <label class="form-check-label">Pilih
                                        Layanan:</label>
                                </div>
                                @foreach ($layanans as $layanan)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('layanan') is-invalid @enderror"
                                            type="checkbox" name="layanan[]" value="{{ $layanan->id }}"
                                            @if (in_array($layanan->id, old('layanan', $client->layanan->pluck('id')->toArray()))) checked @endif>
                                        <label class="form-check-label">{{ $layanan->nama_layanan }}</label>
                                    </div>
                                @endforeach
                                @error('layanan')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update
                                Client</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </main>
    <script>
        function filterByStatus(status) {
            const url = new URL(window.location.href);
            url.searchParams.set('status', status);
            // Reset page ke 1 saat ganti status
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }

        document.getElementById('resetFilter').addEventListener('click', function() {
            const url = new URL(window.location.href);
            // Hapus semua parameter kecuali status
            url.searchParams.delete('brand');
            url.searchParams.delete('date_aktif');
            url.searchParams.delete('page');
            // Pertahankan status yang sedang aktif
            const currentStatus = new URLSearchParams(window.location.search).get('status') || 1;
            window.location.href = url.toString() + '?status=' + currentStatus;
        });
    </script>
</x-app-layout>
