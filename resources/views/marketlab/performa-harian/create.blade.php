<!-- resources/views/clients/create.blade.php -->

<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="row">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="col-md-12">
                                <div class="card-header border-bottom pb-0">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Add Daily Report</h6>
                                            <p class="text-sm">Input daily report data</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header border-bottom pb-0">
                                    <form action="{{ route('laporan-harian.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="performance_bulanan_id" class="form-label">Month Id
                                                    </label>
                                                    <input type="hidden" name="performance_bulanan_id"
                                                        value="{{ $laporanBulanan->id }}">
                                                    <!-- Menyimpan nilai client_id -->
                                                    <input type="text" class="form-control" id="performance_bulanan_id"
                                                        value="{{ $laporanBulanan->id }}" readonly>
                                                    <!-- Menampilkan nilai tanpa bisa diubah -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="hari" class="form-label">Date</label>
                                                    <input type="date" class="form-control" name="hari" id="hari"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="omzet" class="form-label">Omzet</label>
                                                    <input type="number" class="form-control" name="omzet" id="omzet"
                                                        placeholder="Omzet Obtained" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="total" class="form-label">Total Topup</label>
                                                    <input type="text" class="form-control" name="total" id="total"
                                                        placeholder="Total Topup" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="roas" class="form-label">Roas Obtained</label>
                                                    <input type="text" class="form-control" name="roas" id="roas"
                                                        placeholder="Roas" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <label class="form-label form-check-label">Select Topup</label>
                                                </div>
                                                <div class="check-padding form-check form-check-inline">
                                                    <label class="padding-check form-check-label">
                                                        <input class="form-label jarak-check" type="checkbox"
                                                            name="tables[]" value="meta_ads"> Meta Ads
                                                    </label>
                                                    <label class="padding-check form-check-label">
                                                        <input class="form-label jarak-check" type="checkbox"
                                                            name="tables[]" value="google_ads"> Google Ads
                                                    </label>
                                                    <label class="padding-check form-check-label">
                                                        <input class="form-label jarak-check" type="checkbox"
                                                            name="tables[]" value="shopee_ads"> Shopee Ads
                                                    </label>
                                                    <label class="padding-check form-check-label">
                                                        <input class="form-label jarak-check" type="checkbox"
                                                            name="tables[]" value="tokped_ads"> Tokopedia Ads
                                                    </label>
                                                    <label class="padding-check form-check-label">
                                                        <input class="form-label jarak-check" type="checkbox"
                                                            name="tables[]" value="tiktok_ads"> TikTok Ads
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="ads-inputs">
                                            <!-- Input fields for ads will be dynamically added here -->
                                        </div>
                                        <div class="border-top py-3 px-3 d-flex align-items-center">
                                            <div class="ms-auto">
                                                <button type="submit" class="btn btn-sm btn-white mb-0">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script></script>

</x-app-layout>