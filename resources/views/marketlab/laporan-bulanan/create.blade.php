<!-- resources/views/clients/create.blade.php -->

<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 bor
    er-radius-lg ">
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
                                            <h6 class="font-weight-semibold text-lg mb-0">Add Monthly Report</h6>
                                            <p class="text-sm">Input monthly report data</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header border-bottom pb-0">
                                    <form action="{{ route('laporan-bulanan.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="client_id" class="form-label">Id Client</label>
                                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                    <!-- Menyimpan nilai client_id -->
                                                    <input type="text" class="form-control" id="client_id_display"
                                                        placeholder="Target Spant" value="{{ $client->id }}" readonly>
                                                    <!-- Menampilkan nilai tanpa bisa diubah -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="report_date" class="form-label">Month</label>
                                                    <input type="month" class="form-control" name="report_date"
                                                        id="report_date" required pattern="\d{4}-\d{2}">
                                                    <!-- Menambahkan pola untuk format M -->
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label d-block">Jenis Layanan MB</label>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="layanan_mb"
                                                        id="layanan_mb_leads" value="Leads">
                                                    <label class="form-check-label" for="layanan_mb_leads">Leads</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="layanan_mb"
                                                        id="layanan_mb_marketplace" value="Marketplace">
                                                    <label class="form-check-label"
                                                        for="layanan_mb_marketplace">Marketplace</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row marketplace-only">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="target_spent" class="form-label">Target Spant</label>
                                                    <input type="number" class="form-control" name="target_spent"
                                                        id="targetSpentnBulananMB" placeholder="Target Spant">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="targetRevenueBulananMB" class="form-label">Target
                                                        Revenue</label>
                                                    <input type="number" class="form-control" name="target_revenue"
                                                        id="targetRevenueBulananMB" placeholder="Target Revenue">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="target_roas" class="form-label">Target Roas</label>
                                                    <input type="text" class="form-control" name="target_roas"
                                                        id="targetRoasBulananMB" placeholder="Target Roas">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row leads-only">
                                            <div class="mb-3">
                                                <label class="form-label d-block">Jenis Leads</label>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_leads"
                                                        id="leads_ff" value="F to F">
                                                    <label class="form-check-label" for="leads_ff">F to F</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_leads"
                                                        id="leads_roas_rev" value="Leads">
                                                    <label class="form-check-label" for="leads_roas_rev">Roas
                                                        Revenue</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_leads"
                                                        id="leads_total_closing" value="Total Closing">
                                                    <label class="form-check-label" for="leads_total_closing">Total
                                                        Closing</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_leads"
                                                        id="leads_site_visit" value="Site Visits">
                                                    <label class="form-check-label" for="leads_site_visit">Site
                                                        Visits</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row leads-site-visit-only" style="display: none;">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="spent_site_visit" class="form-label">
                                                        Spent</label>
                                                    <input type="number" class="form-control" name="spent_site_visit"
                                                        id="spent_site_visit" placeholder="Target Spent">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="leads_site_visit_value" class="form-label">Target
                                                        Leads</label>
                                                    <input type="number" class="form-control"
                                                        name="leads_site_visit_value" id="leads_site_visit_value"
                                                        placeholder="Target Leads">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="chat_site_visit" class="form-label">
                                                        Chat</label>
                                                    <input type="number" class="form-control" name="chat_site_visit"
                                                        id="chat_site_visit" placeholder="Chat">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="respond_site_visit" class="form-label">
                                                        Respond</label>
                                                    <input type="number" class="form-control" name="respond_site_visit"
                                                        id="respond_site_visit" placeholder="Respond">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="closing_site_visit" class="form-label">Target Site Visit
                                                        / Closing</label>
                                                    <input type="number" class="form-control" name="closing_site_visit"
                                                        id="closing_site_visit" placeholder="Site Visit / Closing">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- F to F --}}
                                        <div class="row leads-ff-only" style="display: none;">
                                            <div class="col-md-6"><label>Spent</label><input type="number"
                                                    name="spent_ff" class="form-control"></div>
                                            <div class="col-md-6"><label>Leads</label><input type="number"
                                                    name="leads_ff" class="form-control"></div>
                                            <div class="col-md-6"><label>Chat</label><input type="number" name="chat_ff"
                                                    class="form-control"></div>
                                            <div class="col-md-6"><label>Greeting</label><input type="number"
                                                    name="greeting_ff" class="form-control"></div>
                                            <div class="col-md-6"><label>Pricelist</label><input type="number"
                                                    name="pricelist_ff" class="form-control"></div>
                                            <div class="col-md-6"><label>Discuss</label><input type="number"
                                                    name="discuss_ff" class="form-control"></div>
                                        </div>

                                        {{-- Roas Revenue --}}
                                        <div class="row leads-roas-only" style="display: none;">
                                            <div class="col-md-6"><label>Spent</label><input type="number"
                                                    name="spent_roas" class="form-control"></div>
                                            <div class="col-md-6"><label>Revenue</label><input type="number"
                                                    name="revenue_roas" class="form-control"></div>
                                            <div class="col-md-6"><label>ROAS</label><input type="number"
                                                    name="roas_roas" class="form-control"></div>
                                            <div class="col-md-6"><label>Chat</label><input type="number"
                                                    name="chat_roas" class="form-control"></div>
                                            <div class="col-md-6"><label>Respond</label><input type="number"
                                                    name="chat_respond_roas" class="form-control"></div>
                                            <div class="col-md-6"><label>Closing</label><input type="number"
                                                    name="closing_roas" class="form-control"></div>
                                        </div>

                                        {{-- Total Closing --}}
                                        <div class="row leads-closing-only" style="display: none;">
                                            <div class="col-md-6"><label>Spent</label><input type="number"
                                                    name="spent_closing" class="form-control"></div>
                                            <div class="col-md-6"><label>Leads</label><input type="number"
                                                    name="leads_closing" class="form-control"></div>
                                            <div class="col-md-6"><label>Chat</label><input type="number"
                                                    name="chat_closing" class="form-control"></div>
                                            <div class="col-md-6"><label> Respond</label><input type="number"
                                                    name="chat_respond_closing" class="form-control"></div>
                                            <div class="col-md-6"><label>Closing</label><input type="number"
                                                    name="closing_closing" class="form-control"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3">
                                                        <label for="note" class="form-label">Note</label>
                                                        <textarea class="form-control" name="note" id="note"
                                                            placeholder="Note....." rows="3" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

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

        <script>
            document.addEventListener('DOMContentLoaded', function () {
    const layananLeads = document.getElementById('layanan_mb_leads');
    const layananMarketplace = document.getElementById('layanan_mb_marketplace');
    const marketplaceFields = document.querySelectorAll('.marketplace-only');
    const leadsFields = document.querySelectorAll('.leads-only');

    const jenisLeadsRadios = document.querySelectorAll('input[name="jenis_leads"]');
    const siteVisitFields = document.querySelectorAll('.leads-site-visit-only');
    const f2fFields = document.querySelectorAll('.leads-ff-only');
    const roasFields = document.querySelectorAll('.leads-roas-only');
    const closingFields = document.querySelectorAll('.leads-closing-only');

    function hideAllJenisLeadsFields() {
        siteVisitFields.forEach(el => el.style.display = 'none');
        f2fFields.forEach(el => el.style.display = 'none');
        roasFields.forEach(el => el.style.display = 'none');
        closingFields.forEach(el => el.style.display = 'none');
    }

    function toggleFields() {
        if (layananMarketplace.checked) {
            marketplaceFields.forEach(el => el.style.display = 'block');
            leadsFields.forEach(el => el.style.display = 'none');
            hideAllJenisLeadsFields();
        } else if (layananLeads.checked) {
            marketplaceFields.forEach(el => el.style.display = 'none');
            leadsFields.forEach(el => el.style.display = 'block');
            // default: hide semua
            hideAllJenisLeadsFields();

            // cek jenis leads yang aktif
            const selected = document.querySelector('input[name="jenis_leads"]:checked');
            if (selected) {
                switch (selected.id) {
                    case 'leads_site_visit':
                        siteVisitFields.forEach(el => el.style.display = 'block');
                        break;
                    case 'leads_ff':
                        f2fFields.forEach(el => el.style.display = 'block');
                        break;
                    case 'leads_roas_rev':
                        roasFields.forEach(el => el.style.display = 'block');
                        break;
                    case 'leads_total_closing':
                        closingFields.forEach(el => el.style.display = 'block');
                        break;
                }
            }
        } else {
            marketplaceFields.forEach(el => el.style.display = 'none');
            leadsFields.forEach(el => el.style.display = 'none');
            hideAllJenisLeadsFields();
        }
    }

    // listener utama
    layananLeads.addEventListener('change', toggleFields);
    layananMarketplace.addEventListener('change', toggleFields);
    jenisLeadsRadios.forEach(radio => radio.addEventListener('change', toggleFields));

    // jalankan saat load
    toggleFields();
});
        </script>


</x-app-layout>