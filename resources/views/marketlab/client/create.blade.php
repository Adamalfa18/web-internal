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
                                    <h6 class="font-weight-semibold text-lg mb-0">Daftar Client</h6>
                                    <p class="text-sm">Berikut adalah buat client baru client</p>
                                </div>

                            </div>
                        </div>
                        <div class="card-header border-bottom pb-0">
                            <!-- Tambahkan notifikasi error -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Akhir notifikasi error -->
                            <form action="{{ route('clients.store') }}" method="POST"
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
                                                    <label class="form-check-label">{{ $layanan->nama_layanan }}</label>
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
                                            <input type="text" class="form-control" name="nama_brand" id="nama_brand"
                                                placeholder="Marketlab......" required>
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
                                                <input type="date" class="form-control" name="date_in" id="date_in"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Client</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Marketlab@gmail.com" required>
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
                                            <label for="pj" class="form-label">Status Client</label>
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
                            <script></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</x-app-layout>
