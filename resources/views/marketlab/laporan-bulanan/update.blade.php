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
                                            <h6 class="font-weight-semibold text-lg mb-0">Edit Monthly Report</h6>
                                            <p class="text-sm">Edit monthly report page</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header border-bottom pb-0">
                                    <form action="{{ route('laporan-bulanan.update', $reports->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label d-block">Jenis Layanan MB</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="layanan_mb"
                                                            value="Leads"
                                                            {{ $reports->jenis_layanan_mb === 'Leads' ? 'checked' : '' }}>
                                                        <label class="form-check-label">Leads</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="layanan_mb"
                                                            value="Marketplace"
                                                            {{ $reports->jenis_layanan_mb === 'Marketplace' ? 'checked' : '' }}>
                                                        <label class="form-check-label">Marketplace</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="client_id" class="form-label">Id Client</label>
                                                        <input type="hidden" name="client_id"
                                                            value="{{ $reports->client_id }}">
                                                        <input type="text" class="form-control"
                                                            id="client_id_display" value="{{ $reports->client_id }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Campaign</label>
                                                        <input type="text" class="form-control" name="nama_campaign"
                                                            value="{{ $reports->nama_campaign }}"
                                                            placeholder="Nama Campaign">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="report_date" class="form-label">Month</label>
                                                        <input type="month" class="form-control" name="report_date"
                                                            value="{{ $reports->report_date }}" id="report_date"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row marketplace-only mb-3 d-none">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Target Spant</label>
                                                        <input type="number" class="form-control" name="target_spent"
                                                            value="{{ $reports->target_spent }}"
                                                            placeholder="Target Spant">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Target Revenue</label>
                                                        <input type="number" class="form-control" name="target_revenue"
                                                            value="{{ $reports->target_revenue }}"
                                                            placeholder="Target Revenue">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Target Roas</label>
                                                        <input type="text" class="form-control" name="target_roas"
                                                            value="{{ $reports->target_roas }}"
                                                            placeholder="Target Roas">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row leads-only mb-3">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label d-block">Jenis Leads</label>
                                                    <div class="style-garp">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_leads" value="Roas Revenue"
                                                                {{ $reports->jenis_leads === 'Roas Revenue' ? 'checked' : '' }}>
                                                            <label class="form-check-label">Roas Revenue</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_leads" value="Total Closing"
                                                                {{ $reports->jenis_leads === 'Total Closing' ? 'checked' : '' }}>
                                                            <label class="form-check-label">Total Closing</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_leads" value="Site Visits"
                                                                {{ $reports->jenis_leads === 'Site Visits' ? 'checked' : '' }}>
                                                            <label class="form-check-label">Site Visits</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Spent</label>
                                                        <input type="text" class="form-control" name="spent"
                                                            value="{{ $reports->target_spent ? 'Rp ' . number_format($reports->target_spent, 0, ',', '.') : '' }}"
                                                            placeholder="Target Spent">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Leads</label>
                                                        <input type="number" class="form-control" name="leads"
                                                            value="{{ $reports->target_leads }}"
                                                            placeholder="Target Leads">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">CPL</label>
                                                        <input type="number" class="form-control" name="cpl"
                                                            value="{{ $reports->cpl }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">CPC</label>
                                                        <input type="number" class="form-control" name="cpc"
                                                            value="{{ $reports->cpc }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="form-label">
                                                        <span style="font-size: 18px">Input Client</span>
                                                        <p style="font-size: 12px">Formulir yang diisi langsung oleh
                                                            klien untuk memberikan data yang dibutuhkan.</p>
                                                    </label>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Chat</label>
                                                        <input type="number" class="form-control" name="chat"
                                                            value="{{ $reports->chat }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Greeting</label>
                                                        <input type="number" class="form-control" name="greeting"
                                                            value="{{ $reports->greeting }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Pricelist</label>
                                                        <input type="number" class="form-control" name="pricelist"
                                                            value="{{ $reports->pricelist }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Discuss</label>
                                                        <input type="number" class="form-control" name="discuss"
                                                            value="{{ $reports->discuss }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Closing</label>
                                                        <input type="number" class="form-control" name="closing"
                                                            value="{{ $reports->closing }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Site Visits</label>
                                                        <input type="number" class="form-control" name="site_visits"
                                                            value="{{ $reports->site_visit }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Revenue</label>
                                                        <input type="text" class="form-control" name="revenue"
                                                            value="{{ $reports->target_revenue ? 'Rp ' . number_format($reports->target_revenue, 0, ',', '.') : '' }}"
                                                            placeholder="Target Revenue">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="form-label">
                                                        <span style="font-size: 18px">Form Hasil</span>
                                                        <p style="font-size: 12px">Terisi otomatis dari data yang telah
                                                            diinput sebelumnya.</p>
                                                    </label>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Roas</label>
                                                        <input type="number" class="form-control" name="roas"
                                                            value="{{ $reports->target_roas }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Respond</label>
                                                        <input type="number" class="form-control" name="respond"
                                                            value="{{ $reports->respond }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Leads > Chat*</label>
                                                        <input type="number" class="form-control"
                                                            name="cr_leads_chat"
                                                            value="{{ $reports->cr_leads_to_chat }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Chat > Respond*</label>
                                                        <input type="number" class="form-control"
                                                            name="cr_chat_respond"
                                                            value="{{ $reports->cr_chat_to_respond }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Respond > Closing*</label>
                                                        <input type="number" class="form-control"
                                                            name="cr_respond_closing"
                                                            value="{{ $reports->cr_respond_to_closing }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Respond > Site Visit*</label>
                                                        <input type="number" class="form-control"
                                                            name="cr_respond_site_visit"
                                                            value="{{ $reports->cr_respond_to_site_visit }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="note" class="form-label">Note</label>
                                                    <textarea class="form-control" name="note" id="note" placeholder="Note....." rows="3" required>{{ $reports->note }}</textarea>
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
                // Fungsi untuk mengatur visibilitas berdasarkan jenis layanan
                function toggleJenisLayanan() {
                    let layananMB = document.querySelector('input[name="layanan_mb"]:checked')?.value;

                    const marketplaceSection = document.querySelector('.marketplace-only');
                    const leadsSection = document.querySelector('.leads-only');

                    if (layananMB === 'Marketplace') {
                        marketplaceSection?.classList.remove('d-none');
                        leadsSection?.classList.add('d-none');
                    } else if (layananMB === 'Leads') {
                        leadsSection?.classList.remove('d-none');
                        marketplaceSection?.classList.add('d-none');
                    } else {
                        // Default: sembunyikan semua
                        marketplaceSection?.classList.add('d-none');
                        leadsSection?.classList.add('d-none');
                    }
                }

                // Jalankan saat halaman pertama kali dimuat
                toggleJenisLayanan();

                // Pasang event listener ke radio input
                const radioButtons = document.querySelectorAll('input[name="layanan_mb"]');
                radioButtons.forEach(radio => {
                    radio.addEventListener('change', toggleJenisLayanan);
                });
            });
        </script>
        <script>
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
                let spentRaw = unformatRupiah(document.getElementsByName('spent')[0].value);
                let revenueRaw = unformatRupiah(document.getElementsByName('revenue')[0].value);

                let spent = parseFloat(spentRaw) || 0;
                let revenue = parseFloat(revenueRaw) || 0;

                let roas = spent > 0 ? (revenue / spent).toFixed(2) : 0;
                document.getElementsByName('roas')[0].value = roas;
            }

            // Hitung Respond
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
                let cr = (leads > 0) ? ((chat / leads) * 100).toFixed(2) : 0;
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

            // Event listeners format rupiah dan ROAS
            document.addEventListener('DOMContentLoaded', function() {
                const spentEl = document.getElementsByName('spent')[0];
                const revenueEl = document.getElementsByName('revenue')[0];

                if (spentEl) {
                    spentEl.value = formatRupiah(unformatRupiah(spentEl.value));
                    spentEl.addEventListener('input', function() {
                        const unformatted = unformatRupiah(this.value);
                        this.value = formatRupiah(unformatted);
                        calculateRoas();
                        calculateCPL(); // jika butuh menghitung CPL juga
                    });
                }

                if (revenueEl) {
                    revenueEl.value = formatRupiah(unformatRupiah(revenueEl.value));
                    revenueEl.addEventListener('input', function() {
                        const unformatted = unformatRupiah(this.value);
                        this.value = formatRupiah(unformatted);
                        calculateRoas();
                    });
                }
            });

            // Hitung CPL (jika dibutuhkan)
            function calculateCPL() {
                let spentRaw = unformatRupiah(document.getElementsByName('spent')[0].value);
                let leads = parseFloat(document.getElementsByName('leads')[0].value) || 0;
                let spent = parseFloat(spentRaw) || 0;

                let cpl = (leads > 0) ? (spent / leads).toFixed(2) : 0;
                document.getElementsByName('cpl')[0].value = cpl;
            }

            // Listener tambahan
            function setupListeners() {
                const input = (name, callback) => {
                    const el = document.getElementsByName(name)[0];
                    if (el) el.addEventListener('input', callback);
                };

                input('greeting', calculateRespond);
                input('pricelist', calculateRespond);
                input('discuss', calculateRespond);
                input('leads', () => {
                    calculateCRLeadsChat();
                    calculateCPL();
                });
                input('chat', () => {
                    calculateCRLeadsChat();
                    calculateCRChatRespond();
                });
                input('closing', calculateCRRespondClosing);
                input('site_visits', calculateCRRespondSiteVisit);
            }

            window.addEventListener('DOMContentLoaded', setupListeners);
        </script>




</x-app-layout>
