<!-- resources/views/clients/create.blade.php -->

<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 bor
    er-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Update Data Client</h6>
                                    <p class="text-sm">Berikut adalah Update Data client</p>
                                </div>

                            </div>
                        </div>
                        <div class="card-header border-bottom pb-0">
                            <form action="{{ route('clients.update', $clients->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nama_client">Nama Client</label>
                                            <input type="text"
                                                class="form-control @error('nama_client') is-invalid @enderror"
                                                id="nama_client" name="nama_client"
                                                value="{{ old('nama_client', $clients->nama_client) }}" required>
                                            @error('nama_client')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nama_brand">Nama Brand</label>
                                            <input type="text"
                                                class="form-control @error('nama_brand') is-invalid @enderror"
                                                id="nama_brand" name="nama_brand"
                                                value="{{ old('nama_brand', $clients->nama_brand) }}">
                                            @error('nama_brand')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nama_finance">Nama Finance</label>
                                            <input type="text"
                                                class="form-control @error('nama_finance') is-invalid @enderror"
                                                id="nama_finance" name="nama_finance"
                                                value="{{ old('nama_finance', $clients->nama_finance) }}">
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
                                                <label for="date_in">Date In</label>
                                                <input type="date"
                                                    class="form-control @error('date_in') is-invalid @enderror"
                                                    id="date_in" name="date_in"
                                                    value="{{ old('date_in', $clients->date_in) }}" required>
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
                                                name="email" value="{{ old('email', $clients->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="telepon_finance">Telepon Finance</label>
                                            <input type="text"
                                                class="form-control @error('telepon_finance') is-invalid @enderror"
                                                id="telepon_finance" name="telepon_finance"
                                                value="{{ old('telepon_finance', $clients->telepon_finance) }}">
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
                                                <option value="{{ $clients->pj }}">Plih PJ</option>
                                                <option value="Insan">Insan</option>
                                                <option value="Feby">Feby</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="pegawai_id" class="form-label">Id Pegawai</label>
                                            <select data-live-search="true"
                                                class="form-select ukuran-select  @error('pegawai_id') is-invalid @enderror"
                                                name="pegawai_id">
                                                @foreach ($pegawai as $peg)
                                                    @if (old('pegawai_id', $clients->pegawai_id) == $peg->id)
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
                                            <label for="status_client">Status Client</label>
                                            <select class="form-select" name="status_client" id="status_client"
                                                aria-label="Default select example" required>
                                                <option value="{{ $clients->status_client }}">Plih Status</option>
                                                <option value="1">Aktif</option>
                                                <option value="2">Pending</option>
                                                <option value="3">Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="informasi_tambahan">Informasi Tambahan</label>
                                            <textarea class="form-control @error('informasi_tambahan') is-invalid @enderror" id="informasi_tambahan"
                                                name="informasi_tambahan">{{ old('informasi_tambahan', $clients->informasi_tambahan) }}</textarea>
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
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">{{ old('alamat', $clients->alamat) }}</textarea>
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
                                            <label for="gambar_client" class="form-label">Gambar Client</label>
                                            @if ($clients->gambar_client)
                                                <img src="{{ asset('storage/' . $clients->gambar_client) }}"
                                                    class="style-logo img-preview img-fluid mb-3 col-sm-5 d-block">
                                            @else
                                                <img class="img-preview img-fluid mb-3 col-sm-5"
                                                    style="display:none;">
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
                                        <label class="form-check-label">Pilih Layanan:</label>
                                    </div>
                                    @foreach ($layanans as $layanan)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('layanan') is-invalid @enderror"
                                                type="checkbox" name="layanan[]" value="{{ $layanan->id }}"
                                                @if (in_array($layanan->id, old('layanan', $clients->layanan->pluck('id')->toArray()))) checked @endif>
                                            <label class="form-check-label">{{ $layanan->nama_layanan }}</label>
                                        </div>
                                    @endforeach
                                    @error('layanan')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update Client</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script></script>

    </main>

</x-app-layout>
