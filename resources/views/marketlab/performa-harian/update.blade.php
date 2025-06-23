<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.marketlab.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Update Daily Report</h6>
                                    <p class="text-sm">Update daily report page</p>
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
                                                <label for="performance_bulanan_id">Performance ID</label>
                                                <input type="text" class="form-control" id="performance_bulanan_id"
                                                    name="performance_bulanan_id"
                                                    value="{{ $data[0]->performance_bulanan_id }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="hari">Date</label>
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
                                                    name="omzet" value="{{ $data[0]->omzet }}" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- META ADS --}}
                                <div class="row" data-table="meta_ads">
                                    <div><label class="form-check-label">
                                            <h5>Meta</h5>
                                        </label></div>
                                    <div class="col-md-6">
                                        <label for="meta_regular" class="form-label">Regular:</label>
                                        <input class="form-control" type="number" name="meta_regular" id="meta_regular"
                                            value="{{ $data[0]->meta_regular ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="meta_regular_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="meta_regular_revenue"
                                            id="meta_regular_revenue" value="{{ $data[0]->meta_regular_revenue ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="meta_cpas" class="form-label">CPAS:</label>
                                        <input class="form-control" type="number" name="meta_cpas" id="meta_cpas"
                                            value="{{ $data[0]->meta_cpas ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="meta_cpas_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="meta_cpas_revenue"
                                            id="meta_cpas_revenue" value="{{ $data[0]->meta_cpas_revenue ?? 0 }}">
                                    </div>
                                </div>

                                {{-- GOOGLE ADS --}}
                                <div class="row" data-table="google_ads">
                                    <div><label class="form-check-label">
                                            <h5>Google</h5>
                                        </label></div>
                                    <div class="col-md-6">
                                        <label for="google_search" class="form-label">Search:</label>
                                        <input class="form-control" type="number" name="google_search"
                                            id="google_search" value="{{ $data[0]->google_search ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="google_search_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="google_search_revenue"
                                            id="google_search_revenue"
                                            value="{{ $data[0]->google_search_revenue ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="google_performance_max" class="form-label">Performance Max:</label>
                                        <input class="form-control" type="number" name="google_performance_max"
                                            id="google_performance_max"
                                            value="{{ $data[0]->google_performance_max ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="google_performance_max_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="google_performance_max_revenue"
                                            id="google_performance_max_revenue"
                                            value="{{ $data[0]->google_performance_max_revenue ?? 0 }}">
                                    </div>
                                </div>

                                {{-- SHOPEE ADS --}}
                                <div class="row" data-table="shopee_ads">
                                    <div><label class="form-check-label">
                                            <h5>Shopee</h5>
                                        </label></div>
                                    <div class="col-md-6">
                                        <label for="shopee_produk" class="form-label">Produk:</label>
                                        <input class="form-control" type="number" name="shopee_produk"
                                            id="shopee_produk" value="{{ $data[0]->shopee_produk ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shopee_produk_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="shopee_produk_revenue"
                                            id="shopee_produk_revenue"
                                            value="{{ $data[0]->shopee_produk_revenue ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shopee_toko" class="form-label">Toko:</label>
                                        <input class="form-control" type="number" name="shopee_toko" id="shopee_toko"
                                            value="{{ $data[0]->shopee_toko ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shopee_toko_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="shopee_toko_revenue"
                                            id="shopee_toko_revenue" value="{{ $data[0]->shopee_toko_revenue ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shopee_live" class="form-label">Live:</label>
                                        <input class="form-control" type="number" name="shopee_live" id="shopee_live"
                                            value="{{ $data[0]->shopee_live ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shopee_live_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="shopee_live_revenue"
                                            id="shopee_live_revenue" value="{{ $data[0]->shopee_live_revenue ?? 0 }}">
                                    </div>
                                </div>

                                {{-- TIKTOK ADS --}}
                                <div class="row" data-table="tiktok_ads">
                                    <div><label class="form-check-label">
                                            <h5>TikTok</h5>
                                        </label></div>
                                    <div class="col-md-6">
                                        <label for="tiktok_gmv_max" class="form-label">GMV Max:</label>
                                        <input class="form-control" type="number" name="tiktok_gmv_max"
                                            id="tiktok_gmv_max" value="{{ $data[0]->tiktok_gmv_max ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tiktok_gmv_max_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="tiktok_gmv_max_revenue"
                                            id="tiktok_gmv_max_revenue"
                                            value="{{ $data[0]->tiktok_gmv_max_revenue ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tiktok_live_shopping" class="form-label">Live Shopping Ads:</label>
                                        <input class="form-control" type="number" name="tiktok_live_shopping"
                                            id="tiktok_live_shopping" value="{{ $data[0]->tiktok_live_shopping ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tiktok_live_shopping_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="tiktok_live_shopping_revenue"
                                            id="tiktok_live_shopping_revenue"
                                            value="{{ $data[0]->tiktok_live_shopping_revenue ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tiktok_product_shopping" class="form-label">Product Shopping
                                            Ads:</label>
                                        <input class="form-control" type="number" name="tiktok_product_shopping"
                                            id="tiktok_product_shopping"
                                            value="{{ $data[0]->tiktok_product_shopping ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tiktok_product_shopping_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="tiktok_product_shopping_revenue"
                                            id="tiktok_product_shopping_revenue"
                                            value="{{ $data[0]->tiktok_product_shopping_revenue ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tiktok_video_shopping" class="form-label">Video Shopping
                                            Ads:</label>
                                        <input class="form-control" type="number" name="tiktok_video_shopping"
                                            id="tiktok_video_shopping"
                                            value="{{ $data[0]->tiktok_video_shopping ?? 0 }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tiktok_video_shopping_revenue" class="form-label">Revenue:</label>
                                        <input class="form-control" type="number" name="tiktok_video_shopping_revenue"
                                            id="tiktok_video_shopping_revenue"
                                            value="{{ $data[0]->tiktok_video_shopping_revenue ?? 0 }}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // ID input spent
        const spentFields = [
            'meta_regular',
            'meta_cpas',
            'google_search',
            'google_performance_max',
            'shopee_produk',
            'shopee_toko',
            'shopee_live',
            'tiktok_gmv_max',
            'tiktok_live_shopping',
            'tiktok_product_shopping',
            'tiktok_video_shopping'
        ];

        // ID input revenue
        const revenueFields = [
            'meta_regular_revenue',
            'meta_cpas_revenue',
            'google_search_revenue',
            'google_performance_max_revenue',
            'shopee_produk_revenue',
            'shopee_toko_revenue',
            'shopee_live_revenue',
            'tiktok_gmv_max_revenue',
            'tiktok_live_shopping_revenue',
            'tiktok_product_shopping_revenue',
            'tiktok_video_shopping_revenue'
        ];

        const totalField = document.getElementById('total');
        const omzetField = document.getElementById('omzet');
        const roasField = document.getElementById('roas');

        function updateTotals() {
            let totalSpent = 0;
            let totalRevenue = 0;

            spentFields.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    const val = parseFloat(input.value);
                    if (!isNaN(val)) {
                        totalSpent += val;
                    }
                }
            });

            revenueFields.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    const val = parseFloat(input.value);
                    if (!isNaN(val)) {
                        totalRevenue += val;
                    }
                }
            });

            totalField.value = totalSpent.toFixed(2);
            omzetField.value = totalRevenue.toFixed(2);

            if (totalSpent > 0) {
                roasField.value = (totalRevenue / totalSpent).toFixed(2);
            } else {
                roasField.value = 0;
            }
        }

        // Gabungkan semua input yang perlu didengarkan
        const allFields = spentFields.concat(revenueFields);
        allFields.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('input', updateTotals);
            }
        });

        updateTotals(); // Jalankan saat load halaman
    });
</script>