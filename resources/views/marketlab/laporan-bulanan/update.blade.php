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
                                                        value="{{ $reports->report_date }}" id="report_date" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label d-block">Jenis Layanan MB</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="layanan_mb"
                                                    value="Leads" {{ $reports->jenis_layanan_mb === 'Leads' ? 'checked'
                                                : '' }}>
                                                <label class="form-check-label">Leads</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="layanan_mb"
                                                    value="Marketplace" {{ $reports->jenis_layanan_mb === 'Marketplace'
                                                ? 'checked' : '' }}>
                                                <label class="form-check-label">Marketplace</label>
                                            </div>
                                        </div>

                                        <div class="row marketplace-only mb-3">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Target Spant</label>
                                                    <input type="number" class="form-control" name="target_spent"
                                                        value="{{ $reports->target_spent }}" placeholder="Target Spant">
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
                                                        value="{{ $reports->target_roas }}" placeholder="Target Roas">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row leads-only mb-3">
                                            <div class="mb-3">
                                                <label class="form-label d-block">Jenis Leads</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_leads"
                                                        value="Roas Revenue" {{ $reports->jenis_leads === 'Roas Revenue'
                                                    ? 'checked' : '' }}>
                                                    <label class="form-check-label">Roas Revenue</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_leads"
                                                        value="Total Closing" {{ $reports->jenis_leads === 'Total
                                                    Closing' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Total Closing</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_leads"
                                                        value="Site Visits" {{ $reports->jenis_leads === 'Site Visits' ?
                                                    'checked' : '' }}>
                                                    <label class="form-check-label">Site Visits</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Spant</label>
                                                        <input type="number" class="form-control" name="spent"
                                                            value="{{ $reports->target_spent }}"
                                                            placeholder="Target Spant">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Leads</label>
                                                        <input type="number" class="form-control" name="leads"
                                                            value="{{ $reports->target_leads }}"
                                                            placeholder="Target Leads">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Revenue</label>
                                                        <input type="text" class="form-control" name="revenue"
                                                            value="{{ $reports->target_revenue }}"
                                                            placeholder="Target Revenue">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>Chat</label><input type="number"
                                                            class="form-control" name="chat"
                                                            value="{{ $reports->chat }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>Greeting</label><input type="number"
                                                            class="form-control" name="greeting"
                                                            value="{{ $reports->greeting }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>Pricelist</label><input type="number"
                                                            class="form-control" name="pricelist"
                                                            value="{{ $reports->pricelist }}"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>Discuss</label><input type="number"
                                                            class="form-control" name="discuss"
                                                            value="{{ $reports->discuss }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>Respond</label><input type="number"
                                                            class="form-control" name="respond"
                                                            value="{{ $reports->respond }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>Closing</label><input type="number"
                                                            class="form-control" name="closing"
                                                            value="{{ $reports->closing }}"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>Site Visits</label><input type="number"
                                                            class="form-control" name="site_visits"
                                                            value="{{ $reports->site_visit }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>Roas</label><input type="number"
                                                            class="form-control" name="roas"
                                                            value="{{ $reports->target_roas }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>CPL</label><input type="number"
                                                            class="form-control" name="cpl" value="{{ $reports->cpl }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>CPC</label><input type="number"
                                                            class="form-control" name="cpc" value="{{ $reports->cpc }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>CR Leads > Chat*</label><input
                                                            type="number" class="form-control" name="cr_leads_chat"
                                                            value="{{ $reports->cr_leads_to_chat }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>CR Chat > Respond*</label><input
                                                            type="number" class="form-control" name="cr_chat_respond"
                                                            value="{{ $reports->cr_chat_to_respond }}"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>CR Respond > Closing*</label><input
                                                            type="number" class="form-control" name="cr_respond_closing"
                                                            value="{{ $reports->cr_respond_to_closing }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3"><label>CR Respond > Site Visit*</label><input
                                                            type="number" class="form-control"
                                                            name="cr_respond_site_visit"
                                                            value="{{ $reports->cr_respond_to_site_visit }}"></div>
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

        <script>
            document.addEventListener('DOMContentLoaded', function () {
        let jenis = document.getElementById('jenis_layanan_mb')?.value;
        let leads = document.getElementById('jenis_leads')?.value;

        if (jenis === 'Leads') {
            if (leads === 'F to F') {
                document.querySelector('.leads-ff-only').style.display = 'block';
            } else if (leads === 'Roas Revenue') {
                document.querySelector('.leads-roas-only').style.display = 'block';
            }
        } else if (jenis === 'Marketplace') {
            document.querySelector('.marketplace-only')?.style?.removeProperty('display');
        } else if (jenis === 'Website') {
            document.querySelector('.website-only')?.style?.removeProperty('display');
        }
    });
        </script>


</x-app-layout>