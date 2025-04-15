<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Update Laporan Harian</h6>
                                    <p class="text-sm">Berikut adalah update data laporan bulanan</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-header border-bottom pb-0">
                            <form action="{{ route('laporan-harian.update', $data[0]->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="performance_bulanan_id">Performance Bulanan ID</label>
                                                <input type="text" class="form-control" id="performance_bulanan_id"
                                                    name="performance_bulanan_id"
                                                    value="{{ $data[0]->performance_bulanan_id }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="hari">Hari</label>
                                                <input type="date" class="form-control" id="hari" name="hari"
                                                    value="{{ $data[0]->hari }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="roas">ROAS</label>
                                                <input type="number" step="0.01" class="form-control" id="roas"
                                                    name="roas" value="{{ $data[0]->roas }}" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="total">Total</label>
                                                <input type="number" step="0.01" class="form-control" id="total"
                                                    name="total" value="{{ $data[0]->total }}" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="omzet">Omzet</label>
                                                <input type="number" step="0.01" class="form-control" id="omzet"
                                                    name="omzet" value="{{ $data[0]->omzet }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mt-3">
                                        <label class="form-check-label">
                                            <h5>Meta</h5>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="meta_regular">Meta Regular</label>
                                                <input type="number" class="form-control" id="meta_regular"
                                                    name="meta_regular" value="{{ $data[0]->meta_regular }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="meta_cpas">Meta CPAS</label>
                                                <input type="number" class="form-control" id="meta_cpas"
                                                    name="meta_cpas" value="{{ $data[0]->meta_cpas }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mt-3">
                                        <label class="form-check-label">
                                            <h5>Google</h5>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="google_search">Google Search</label>
                                                <input type="number" class="form-control" id="google_search"
                                                    name="google_search" value="{{ $data[0]->google_search }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="google_youtube">Google YouTube</label>
                                                <input type="number" class="form-control" id="google_youtube"
                                                    name="google_youtube" value="{{ $data[0]->google_youtube }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="google_gtm">Google GTM</label>
                                                <input type="number" class="form-control" id="google_gtm"
                                                    name="google_gtm" value="{{ $data[0]->google_gtm }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="google_performance_max">Google Performance MAX</label>
                                                <input type="number" class="form-control"
                                                    id="google_performance_max" name="google_performance_max"
                                                    value="{{ $data[0]->google_performance_max }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="mt-3">
                                        <label class="form-check-label">
                                            <h5>Shopee</h5>
                                        </label>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="shopee_manual">Shopee Manual</label>
                                                    <input type="number" class="form-control" id="shopee_manual"
                                                        name="shopee_manual" value="{{ $data[0]->shopee_manual }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="shopee_auto_meta">Shopee Auto Meta</label>
                                                    <input type="number" class="form-control" id="shopee_auto_meta"
                                                        name="shopee_auto_meta"
                                                        value="{{ $data[0]->shopee_auto_meta ?? 0 }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="shopee_gmv">Shopee GMV</label>
                                                    <input type="number" class="form-control" id="shopee_gmv"
                                                        name="shopee_gmv" value="{{ $data[0]->shopee_gmv ?? 0 }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="shopee_toko">Shopee Toko</label>
                                                    <input type="number" class="form-control" id="shopee_toko"
                                                        name="shopee_toko" value="{{ $data[0]->shopee_toko ?? 0 }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="shopee_live">Shopee Live</label>
                                                    <input type="number" class="form-control" id="shopee_live"
                                                        name="shopee_live" value="{{ $data[0]->shopee_live ?? 0 }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mt-3">
                                        <label class="form-check-label">
                                            <h5>Tokopedia</h5>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="tokped_manual">Tokped Manual</label>
                                                    <input type="number" class="form-control" id="tokped_manual"
                                                        name="tokped_manual"
                                                        value="{{ $data[0]->tokped_manual ?? 0 }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="tokped_auto_meta">Tokopedia Auto Meta</label>
                                                    <input type="number" class="form-control" id="tokped_auto_meta"
                                                        name="tokped_auto_meta"
                                                        value="{{ $data[0]->tokped_auto_meta ?? 0 }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="tokped_toko">Tokopedia Toko</label>
                                                    <input type="number" class="form-control" id="tokped_toko"
                                                        name="tokped_toko" value="{{ $data[0]->tokped_toko ?? 0 }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="mt-3">
                                        <label class="form-check-label">
                                            <h5>Tiktok</h5>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="tiktok_live_shopping">Tiktok Live Shopping</label>
                                                <input type="number" class="form-control" id="tiktok_live_shopping"
                                                    name="tiktok_live_shopping"
                                                    value="{{ $data[0]->tiktok_live_shopping ?? 0 }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="tiktok_product_shopping">Tiktok Product Shopping</label>
                                                <input type="number" class="form-control"
                                                    id="tiktok_product_shopping" name="tiktok_product_shopping"
                                                    value="{{ $data[0]->tiktok_product_shopping ?? 0 }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="tiktok_video_shopping">Tiktok Video Shopping</label>
                                                <input type="number" class="form-control" id="tiktok_video_shopping"
                                                    name="tiktok_video_shopping"
                                                    value="{{ $data[0]->tiktok_video_shopping ?? 0 }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="tiktok_gmv_max">Tiktok GMV MAX</label>
                                                <input type="number" class="form-control" id="tiktok_gmv_max"
                                                    name="tiktok_gmv_max"
                                                    value="{{ $data[0]->tiktok_gmv_max ?? 0 }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

<script></script>
