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
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label d-block">MB Service Type</label>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="layanan_mb"
                                                            id="layanan_mb_leads" value="Leads">
                                                        <label class="form-check-label"
                                                            for="layanan_mb_leads">Leads</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="layanan_mb"
                                                            id="layanan_mb_marketplace" value="Marketplace">
                                                        <label class="form-check-label"
                                                            for="layanan_mb_marketplace">Marketplace</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="client_id" class="form-label">Id Client</label>
                                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                        <input type="text" class="form-control" id="client_id_display"
                                                            placeholder="Spent Target" value="{{ $client->id }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Campaign Name</label>
                                                        <input type="text" class="form-control" name="nama_campaign"
                                                            placeholder="Campaign Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="report_date" class="form-label">Month</label>
                                                        <input type="month" class="form-control" name="report_date"
                                                            id="report_date" required pattern="\d{4}-\d{2}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row marketplace-only mb-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="target_spent" class="form-label">Target
                                                            Spent</label>
                                                        <input type="text" class="form-control" name="target_spent"
                                                            id="targetSpentnBulananMB" placeholder="Spent Target">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="targetRevenueBulananMB" class="form-label">Target
                                                            Revenue</label>
                                                        <input type="text" class="form-control" name="target_revenue"
                                                            id="targetRevenueBulananMB" placeholder="Revenue Target ">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="target_roas" class="form-label">ROAS Target </label>
                                                        <input type="text" class="form-control" name="target_roas"
                                                            id="targetRoasBulananMB" placeholder="ROAS Target ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row leads-only mb-3">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label d-block">Leads Target </label>
                                                    <div class="style-garp">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_leads" id="leads_roas_rev"
                                                                value="Roas Revenue">
                                                            <label class="form-check-label" for="leads_roas_rev">Roas
                                                                Revenue</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_leads" id="leads_total_closing"
                                                                value="Total Closing">
                                                            <label class="form-check-label"
                                                                for="leads_total_closing">Total Closing</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_leads" id="leads_site_visit"
                                                                value="Site Visits">
                                                            <label class="form-check-label" for="leads_site_visit">Site
                                                                Visits</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Spent -->
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Spent</label>
                                                        <input type="text" class="form-control" name="spent" id="spent"
                                                            placeholder="Spent Target">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Leads</label>
                                                        <input type="number" class="form-control" name="leads"
                                                            placeholder="Target Lead">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">CPL</label>
                                                        <input type="number" class="form-control" name="cpl"
                                                            placeholder="Cost Per Leads">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">CPC</label>
                                                        <input type="number" class="form-control" name="cpc"
                                                            placeholder="Cost Per Click">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Chat</label>
                                                        <input type="number" class="form-control" name="chat"
                                                            placeholder="Target chat">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Greeting</label>
                                                        <input type="number" class="form-control" name="greeting"
                                                            placeholder="Greeting">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Pricelist</label>
                                                        <input type="number" class="form-control" name="pricelist"
                                                            placeholder="Pricelist">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Discuss</label>
                                                        <input type="number" class="form-control" name="discuss"
                                                            placeholder="Discuss">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Closing</label>
                                                        <input type="number" class="form-control" name="closing"
                                                            placeholder="Closing">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Site Visits</label>
                                                        <input type="number" class="form-control" name="site_visits"
                                                            placeholder="Site Visits">
                                                    </div>
                                                </div>
                                                <!-- Revenue -->
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Revenue</label>
                                                        <input type="text" class="form-control" name="revenue"
                                                            id="revenue" placeholder="Revenue Target ">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- ROAS -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">ROAS</label>
                                                        <input type="number" class="form-control" name="roas" id="roas"
                                                            placeholder="ROAS">
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
                                                        <label class="form-label">CR Leads > Chat*</label>
                                                        <input type="number" class="form-control" name="cr_leads_chat"
                                                            placeholder="CR Leads > Chat">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Chat > Respond*</label>
                                                        <input type="number" class="form-control" name="cr_chat_respond"
                                                            placeholder="CR Chat > Respond">
                                                    </div>
                                                </div>
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
                                                    <label for="note" class="form-label">Note</label>
                                                    <textarea class="form-control" name="note" id="note"
                                                        placeholder="Note....." rows="3" required></textarea>
                                                </div>
                                            </div>
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
        <script>
            function formatRupiah(angka) {
                let number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            }

            // Format hanya field nama: spent, revenue, target_spent, target_revenue
            const rupiahNames = ['spent', 'revenue', 'target_spent', 'target_revenue'];

            rupiahNames.forEach(function(fieldName) {
                const inputs = document.querySelectorAll(`input[name="${fieldName}"]`);
                inputs.forEach(function(input) {
                    input.addEventListener('input', function(e) {
                        let value = e.target.value.replace(/[^0-9]/g, '');
                        e.target.value = formatRupiah(value);
                    });

                    // Optional: bersihkan format saat submit
                    input.form?.addEventListener('submit', function() {
                        inputs.forEach(function(el) {
                            el.value = el.value.replace(/\./g, '').replace(/[^0-9]/g, '');
                        });
                    });
                });
            });
        </script>


        {{-- <script>
            function calculateRoas() {
                let spent = parseFloat(document.getElementById('spent').value) || 0;
                let revenue = parseFloat(document.getElementById('revenue').value) || 0;
                let roas = spent > 0 ? (revenue / spent).toFixed(2) : 0;
                document.getElementById('roas').value = roas;
            }

            function calculateRespond() {
                let greeting = parseInt(document.getElementsByName('greeting')[0].value) || 0;
                let pricelist = parseInt(document.getElementsByName('pricelist')[0].value) || 0;
                let discuss = parseInt(document.getElementsByName('discuss')[0].value) || 0;

                let respond = greeting + pricelist + discuss;
                document.getElementsByName('respond')[0].value = respond;

                calculateCRChatRespond();
                calculateCRRespondClosing();
                calculateCRRespondSiteVisit();
            }

            function calculateCRLeadsChat() {
                let leads = parseInt(document.getElementsByName('leads')[0].value) || 0;
                let chat = parseInt(document.getElementsByName('chat')[0].value) || 0;
                let cr = (chat > 0) ? ((chat / leads) * 100).toFixed(2) : 0;
                document.getElementsByName('cr_leads_chat')[0].value = cr;
            }

            function calculateCRChatRespond() {
                let respond = parseInt(document.getElementsByName('respond')[0].value) || 0;
                let chat = parseInt(document.getElementsByName('chat')[0].value) || 0;
                let cr = (chat > 0) ? ((respond / chat) * 100).toFixed(2) : 0;
                document.getElementsByName('cr_chat_respond')[0].value = cr;
            }

            function calculateCRRespondClosing() {
                let closing = parseInt(document.getElementsByName('closing')[0].value) || 0;
                let respond = parseInt(document.getElementsByName('respond')[0].value) || 0;
                let cr = (respond > 0) ? ((closing / respond) * 100).toFixed(2) : 0;
                document.getElementsByName('cr_respond_closing')[0].value = cr;
            }

            function calculateCRRespondSiteVisit() {
                let siteVisit = parseInt(document.getElementsByName('site_visits')[0].value) || 0;
                let respond = parseInt(document.getElementsByName('respond')[0].value) || 0;
                let cr = (respond > 0) ? ((siteVisit / respond) * 100).toFixed(2) : 0;
                document.getElementsByName('cr_respond_site_visit')[0].value = cr;
            }

            // Event listeners
            document.getElementById('spent').addEventListener('input', calculateRoas);
            document.getElementById('revenue').addEventListener('input', calculateRoas);

            document.getElementsByName('greeting')[0].addEventListener('input', calculateRespond);
            document.getElementsByName('pricelist')[0].addEventListener('input', calculateRespond);
            document.getElementsByName('discuss')[0].addEventListener('input', calculateRespond);

            document.getElementsByName('leads')[0].addEventListener('input', calculateCRLeadsChat);
            document.getElementsByName('chat')[0].addEventListener('input', () => {
                calculateCRLeadsChat();
                calculateCRChatRespond();
            });

            document.getElementsByName('closing')[0].addEventListener('input', calculateCRRespondClosing);
            document.getElementsByName('site_visits')[0].addEventListener('input', calculateCRRespondSiteVisit);
        </script> --}}

        {{-- <script>
            // Format Rupiah
            function formatRupiah(angka) {
                const number_string = angka.replace(/[^,\d]/g, '').toString();
                const split = number_string.split(',');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                const ribuan = split[0].substr(sisa).match(/\d{3}/g);
                if (ribuan) {
                    rupiah += (sisa ? '.' : '') + ribuan.join('.');
                }
                return split[1] !== undefined ? 'Rp ' + rupiah + ',' + split[1] : 'Rp ' + rupiah;
            }

            // Hilangkan format
            function unformatRupiah(rupiah) {
                return rupiah.replace(/[^0-9]/g, '');
            }

            // Hitung ROAS
            function calculateRoas() {
                let spentRaw = unformatRupiah(document.getElementById('spent').value);
                let revenueRaw = unformatRupiah(document.getElementById('revenue').value);

                let spent = parseFloat(spentRaw) || 0;
                let revenue = parseFloat(revenueRaw) || 0;

                let roas = spent > 0 ? (revenue / spent).toFixed(2) : 0;
                document.getElementById('roas').value = roas;
            }

            // Respon, CR, dsb (fungsi sebelumnya tetap dipakai)
            function calculateRespond() {
                let greeting = parseInt(document.getElementsByName('greeting')[0].value) || 0;
                let pricelist = parseInt(document.getElementsByName('pricelist')[0].value) || 0;
                let discuss = parseInt(document.getElementsByName('discuss')[0].value) || 0;

                let respond = greeting + pricelist + discuss;
                document.getElementsByName('respond')[0].value = respond;

                calculateCRChatRespond();
                calculateCRRespondClosing();
                calculateCRRespondSiteVisit();
            }

            function calculateCRLeadsChat() {
                let leads = parseInt(document.getElementsByName('leads')[0].value) || 0;
                let chat = parseInt(document.getElementsByName('chat')[0].value) || 0;
                let cr = (chat > 0) ? ((chat / leads) * 100).toFixed(2) : 0;
                document.getElementsByName('cr_leads_chat')[0].value = cr;
            }

            function calculateCRChatRespond() {
                let respond = parseInt(document.getElementsByName('respond')[0].value) || 0;
                let chat = parseInt(document.getElementsByName('chat')[0].value) || 0;
                let cr = (chat > 0) ? ((respond / chat) * 100).toFixed(2) : 0;
                document.getElementsByName('cr_chat_respond')[0].value = cr;
            }

            function calculateCRRespondClosing() {
                let closing = parseInt(document.getElementsByName('closing')[0].value) || 0;
                let respond = parseInt(document.getElementsByName('respond')[0].value) || 0;
                let cr = (respond > 0) ? ((closing / respond) * 100).toFixed(2) : 0;
                document.getElementsByName('cr_respond_closing')[0].value = cr;
            }

            function calculateCRRespondSiteVisit() {
                let siteVisit = parseInt(document.getElementsByName('site_visits')[0].value) || 0;
                let respond = parseInt(document.getElementsByName('respond')[0].value) || 0;
                let cr = (respond > 0) ? ((siteVisit / respond) * 100).toFixed(2) : 0;
                document.getElementsByName('cr_respond_site_visit')[0].value = cr;
            }

            // Event listeners
            document.getElementById('spent').addEventListener('input', function() {
                let unformatted = unformatRupiah(this.value);
                this.value = formatRupiah(unformatted);
                calculateRoas();
            });

            document.getElementById('revenue').addEventListener('input', function() {
                let unformatted = unformatRupiah(this.value);
                this.value = formatRupiah(unformatted);
                calculateRoas();
            });

            // Jika form lainnya sudah ada, aktifkan listener-nya juga
            const setupListeners = () => {
                const input = (name, callback) => {
                    const el = document.getElementsByName(name)[0];
                    if (el) el.addEventListener('input', callback);
                };

                input('greeting', calculateRespond);
                input('pricelist', calculateRespond);
                input('discuss', calculateRespond);
                input('leads', calculateCRLeadsChat);
                input('chat', () => {
                    calculateCRLeadsChat();
                    calculateCRChatRespond();
                });
                input('closing', calculateCRRespondClosing);
                input('site_visits', calculateCRRespondSiteVisit);
            };

            // Jalankan listener tambahan setelah load
            window.addEventListener('DOMContentLoaded', setupListeners);
        </script> --}}


</x-app-layout>