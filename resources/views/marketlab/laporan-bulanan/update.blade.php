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
                                                    <label class="form-label d-block">MB Service Type</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="layanan_mb"
                                                            value="Leads" {{ $reports->jenis_layanan_mb === 'Leads' ?
                                                        'checked' : '' }}>
                                                        <label class="form-check-label">Leads</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="layanan_mb"
                                                            value="Marketplace" {{ $reports->jenis_layanan_mb ===
                                                        'Marketplace' ? 'checked' : '' }}>
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
                                                        <input type="text" class="form-control" id="client_id_display"
                                                            value="{{ $reports->client_id }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Campaign Name</label>
                                                        <input type="text" class="form-control" name="nama_campaign"
                                                            value="{{ $reports->nama_campaign }}"
                                                            placeholder="Campaign Name">
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
                                                        <label class="form-label">Spent Target</label>
                                                        <input type="number" class="form-control" name="target_spent"
                                                            value="{{ $reports->target_spent }}"
                                                            placeholder="Spent Target">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Revenue Target </label>
                                                        <input type="number" class="form-control" name="target_revenue"
                                                            value="{{ $reports->target_revenue }}"
                                                            placeholder="Revenue Target ">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">ROAS Target </label>
                                                        <input type="text" class="form-control" name="target_roas"
                                                            value="{{ $reports->target_roas }}"
                                                            placeholder="ROAS Target ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row leads-only mb-3">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label d-block">Leads Target</label>
                                                    <div class="style-garp">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_leads" value="Roas Revenue" {{
                                                                $reports->jenis_leads === 'Roas Revenue' ? 'checked' :
                                                            '' }}>
                                                            <label class="form-check-label">Roas Revenue</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_leads" value="Total Closing" {{
                                                                $reports->jenis_leads === 'Total Closing' ? 'checked' :
                                                            '' }}>
                                                            <label class="form-check-label">Total Closing</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_leads" value="Site Visits" {{
                                                                $reports->jenis_leads === 'Site Visits' ? 'checked' : ''
                                                            }}>
                                                            <label class="form-check-label">Site Visits</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Spent</label>
                                                        <input type="text" class="rupiah-input form-control"
                                                            name="target_spent"
                                                            value="{{ $reports->target_spent ? 'Rp ' . number_format($reports->target_spent, 0, ',', '.') : '' }}"
                                                            placeholder="Spent Target">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Leads</label>
                                                        <input type="number" class="form-control" name="leads"
                                                            value="{{ $reports->target_leads }}"
                                                            placeholder="Leads Target ">
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
                                                        <span style="font-size: 18px">Client Input</span>
                                                        <p style="font-size: 12px">The form is filled in directly by the
                                                            client
                                                            For
                                                            provide the required data.</p>
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
                                                        <input type="text" class="rupiah-input form-control"
                                                            name="target_revenue"
                                                            value="{{ $reports->target_revenue ? 'Rp ' . number_format($reports->target_revenue, 0, ',', '.') : '' }}"
                                                            placeholder="Revenue Target ">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="form-label">
                                                        <span style="font-size: 18px">Results Form</span>
                                                        <p style="font-size: 12px">Filled automatically from data that
                                                            has been previously input.</p>
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
                                                        <input type="number" class="form-control" name="cr_leads_chat"
                                                            value="{{ $reports->cr_leads_to_chat }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">CR Chat > Respond*</label>
                                                        <input type="number" class="form-control" name="cr_chat_respond"
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
                                                    <textarea class="form-control" name="note" id="note"
                                                        placeholder="Note....." rows="3"
                                                        required>{{ $reports->note }}</textarea>
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
    </main>

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
        document.addEventListener('DOMContentLoaded', function() {
            const formatRupiah = (number) => {
                let numberString = number.replace(/[^,\d]/g, "").toString();
                let split = numberString.split(",");
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
                return rupiah ? "Rp " + rupiah : "";
            };

            const parseRupiah = (value) => {
                return value.replace(/[^0-9]/g, "");
            };

            const rupiahInputs = document.querySelectorAll('.rupiah-input');

            rupiahInputs.forEach(input => {
                if (!input) return;

                // Format awal saat halaman dibuka
                input.value = formatRupiah(parseRupiah(input.value));

                input.addEventListener('input', function() {
                    let cursorPos = input.selectionStart;
                    let oldLength = input.value.length;

                    // Format ulang isi input
                    this.value = formatRupiah(this.value);

                    let newLength = this.value.length;
                    input.setSelectionRange(cursorPos + (newLength - oldLength), cursorPos + (
                        newLength - oldLength));
                });

                // Saat form disubmit, ubah ke angka mentah
                if (input.form) {
                    input.form.addEventListener('submit', function() {
                        input.value = parseRupiah(input.value);
                    });
                }
            });
        });
    </script>






</x-app-layout>