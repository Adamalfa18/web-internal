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
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="client_id" class="form-label">Id Client</label>
                                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                    <!-- Menyimpan nilai client_id -->
                                                    <input type="text" class="form-control" id="client_id_display"
                                                        placeholder="Target Spant" value="{{ $client->id }}" readonly>
                                                    <!-- Menampilkan nilai tanpa bisa diubah -->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama
                                                        Campaign</label>
                                                    <input type="text" class="form-control" name="nama_campaign"
                                                        placeholder="nama Campaign">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                        <div class="row marketplace-only mb-3">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="target_spent" class="form-label">Target Spant</label>
                                                    <input type="number" class="form-control" name="target_spent"
                                                        id="targetSpentnBulananMB" placeholder="Target Spant">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="targetRevenueBulananMB" class="form-label">Target
                                                        Revenue</label>
                                                    <input type="number" class="form-control" name="target_revenue"
                                                        id="targetRevenueBulananMB" placeholder="Target Revenue">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="target_roas" class="form-label">Target Roas</label>
                                                    <input type="text" class="form-control" name="target_roas"
                                                        id="targetRoasBulananMB" placeholder="Target Roas">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row leads-only mb-3">
                                            <div class="mb-3">
                                                <label class="form-label d-block">Jenis Leads</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_leads"
                                                        id="leads_roas_rev" value="Roas Revenue">
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
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Spant</label>
                                                        <input type="number" class="form-control" name="spent"
                                                            placeholder="Target Spant">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Leads</label>
                                                        <input type="number" class="form-control" name="leads"
                                                            placeholder="Target Lead">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Revenue</label>
                                                        <input type="text" class="form-control" name="revenue"
                                                            placeholder="Target Revenue">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Chat</label>
                                                        <input type="number" class="form-control" name="chat"
                                                            placeholder="Target chat">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Greeting</label>
                                                        <input type="number" class="form-control" name="greeting"
                                                            placeholder="Greeting">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Pricelist</label>
                                                        <input type="number" class="form-control" name="pricelist"
                                                            placeholder="Pricelist">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Discuss</label>
                                                        <input type="number" class="form-control" name="discuss"
                                                            placeholder="Discuss">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Respond</label>
                                                        <input type="number" class="form-control" name="respond"
                                                            placeholder="Respond">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Closing</label>
                                                        <input type="number" class="form-control" name="closing"
                                                            placeholder="Closing">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Site Visits</label>
                                                        <input type="number" class="form-control" name="site_visits"
                                                            placeholder="Site Visits">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Roas</label>
                                                        <input type="number" class="form-control" name="roas"
                                                            placeholder="Roas">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CPL</label>
                                                        <input type="number" class="form-control" name="cpl"
                                                            placeholder="CPL">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CPC</label>
                                                        <input type="number" class="form-control" name="cpc"
                                                            placeholder="CPC">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Leads > Chat*</label>
                                                        <input type="number" class="form-control"
                                                            name="cr_leads_chat" placeholder="CR Leads > Chat">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Chat > Respond*</label>
                                                        <input type="number" class="form-control"
                                                            name="cr_chat_respond" placeholder="CR Chat > Respond">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Respond > Closing*</label>
                                                        <input type="number" class="form-control"
                                                            name="cr_respond_closing"
                                                            placeholder="CR Respond > Closing">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Respond > Site Visit*</label>
                                                        <input type="number" class="form-control"
                                                            name="cr_respond_site_visit"
                                                            placeholder="CR Respond > Site Visit">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3">
                                                        <label for="note" class="form-label">Note</label>
                                                        <textarea class="form-control" name="note" id="note" placeholder="Note....." rows="3" required></textarea>
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
            document.addEventListener('DOMContentLoaded', function() {
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
                        marketplaceFields.forEach(el => el.style.display = 'flex');
                        leadsFields.forEach(el => el.style.display = 'none');
                        hideAllJenisLeadsFields();
                    } else if (layananLeads.checked) {
                        marketplaceFields.forEach(el => el.style.display = 'none');
                        leadsFields.forEach(el => el.style.display = 'flex');
                        // default: hide semua
                        hideAllJenisLeadsFields();

                        // cek jenis leads yang aktif
                        const selected = document.querySelector('input[name="jenis_leads"]:checked');
                        if (selected) {
                            switch (selected.id) {
                                case 'leads_site_visit':
                                    siteVisitFields.forEach(el => el.style.display = 'flex');
                                    break;
                                case 'leads_ff':
                                    f2fFields.forEach(el => el.style.display = 'flex');
                                    break;
                                case 'leads_roas_rev':
                                    roasFields.forEach(el => el.style.display = 'flex');
                                    break;
                                case 'leads_total_closing':
                                    closingFields.forEach(el => el.style.display = 'flex');
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
