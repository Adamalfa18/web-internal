<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.marketlab.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Update Data Layanan Client</h6>
                                    <p class="text-sm">Perbarui informasi layanan untuk client ini</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('marketing.update', $client_layanan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Nama Client -->
                                <div class="mb-4">
                                    <label class="form-label">Nama Client:</label>
                                    <input type="text" class="form-control" value="{{ $client->nama_client }}"
                                        readonly>
                                </div>

                                <!-- Nama Brand -->
                                <div class="mb-4">
                                    <label class="form-label">Nama Brand:</label>
                                    <input type="text" class="form-control" value="{{ $client->nama_brand }}"
                                        readonly>
                                </div>

                                <!-- Pilih Layanan -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Layanan:</label>
                                    <input type="text" class="form-control"
                                        value="{{ $client_layanan->layanan->nama_layanan ?? '-' }}" readonly>
                                    <input type="hidden" name="layanan_id" value="{{ $client_layanan->layanan->id }}">
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Status:</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                                        <option value="1"
                                            {{ old('status', $client_layanan->status ?? 1) == 1 ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="2"
                                            {{ old('status', $client_layanan->status ?? 2) == 2 ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="3"
                                            {{ old('status', $client_layanan->status ?? 3) == 3 ? 'selected' : '' }}>
                                            Paid
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Landing -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Tanggal Landing:</label>
                                    <input type="text" class="form-control"
                                        value="{{ $client_layanan->created_at ? $client_layanan->created_at->format('d M Y') : '-' }}"
                                        readonly>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Data Layanan</button>
                            </form>
                        </div> <!-- end card-body -->

                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
