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
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="client_id" class="form-label">ID Client</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $reports->client_id }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="report_date" class="form-label">Month</label>
                                                    <input type="month" class="form-control" name="report_date"
                                                        id="report_date" required value="{{ $reports->report_date }}">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Jenis Layanan & Leads --}}
                                        @if ($reports->jenis_layanan_mb === 'Leads')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="jenis_layanan_mb" class="form-label">Jenis Layanan</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $reports->jenis_layanan_mb }}" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="jenis_leads" class="form-label">Jenis Leads</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $reports->jenis_leads }}" readonly>
                                            </div>
                                        </div>

                                        @if ($reports->jenis_leads === 'F to F')
                                        {{-- Leads: F to F --}}
                                        <div class="row mt-4">
                                            <div class="col-md-4"><label>Spent</label><input type="number"
                                                    name="spent_ff" class="form-control"
                                                    value="{{ $reports->target_spent }}"></div>
                                            <div class="col-md-4"><label>Leads</label><input type="number"
                                                    name="leads_ff" class="form-control"
                                                    value="{{ $reports->target_leads }}"></div>
                                            <div class="col-md-4"><label>Chat</label><input type="number" name="chat_ff"
                                                    class="form-control" value="{{ $reports->chat }}"></div>
                                            <div class="col-md-4"><label>Greeting</label><input type="number"
                                                    name="greeting_ff" class="form-control"
                                                    value="{{ $reports->greeting }}"></div>
                                            <div class="col-md-4"><label>Pricelist</label><input type="number"
                                                    name="pricelist_ff" class="form-control"
                                                    value="{{ $reports->pricelist }}"></div>
                                            <div class="col-md-4"><label>Discuss</label><input type="number"
                                                    name="discuss_ff" class="form-control"
                                                    value="{{ $reports->discuss }}"></div>
                                        </div>
                                        @elseif ($reports->jenis_leads === 'Roas Revenue')
                                        {{-- Leads: Roas Revenue --}}
                                        <div class="row mt-4">
                                            <div class="col-md-4"><label>Spent</label><input type="number"
                                                    name="spent_roas" class="form-control"
                                                    value="{{ $reports->target_spent }}"></div>
                                            <div class="col-md-4"><label>Revenue</label><input type="number"
                                                    name="revenue_roas" class="form-control"
                                                    value="{{ $reports->target_revenue }}"></div>
                                            <div class="col-md-4"><label>ROAS</label><input type="number"
                                                    name="roas_roas" class="form-control"
                                                    value="{{ $reports->target_roas }}"></div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-4"><label>Chat</label><input type="number"
                                                    name="chat_roas" class="form-control" value="{{ $reports->chat }}">
                                            </div>
                                            <div class="col-md-4"><label>Respond</label><input type="number"
                                                    name="chat_respond_roas" class="form-control"
                                                    value="{{ $reports->respond }}"></div>
                                            <div class="col-md-4"><label>Closing</label><input type="number"
                                                    name="closing_roas" class="form-control"
                                                    value="{{ $reports->closing }}"></div>
                                        </div>
                                        @elseif ($reports->jenis_leads === 'Total Closing')
                                        {{-- Leads: Total Closing --}}
                                        <div class="row mt-4">
                                            <div class="col-md-4"><label>Spent</label><input type="number"
                                                    name="spent_total" class="form-control"
                                                    value="{{ $reports->target_spent }}"></div>
                                            <div class="col-md-4"><label>Leads</label><input type="number"
                                                    name="leads_total" class="form-control"
                                                    value="{{ $reports->target_leads }}"></div>
                                            <div class="col-md-4"><label>Chat</label><input type="number"
                                                    name="chat_total" class="form-control" value="{{ $reports->chat }}">
                                            </div>
                                            <div class="col-md-4"><label>Respond</label><input type="number"
                                                    name="respond_total" class="form-control"
                                                    value="{{ $reports->respond }}"></div>
                                            <div class="col-md-4"><label>Closing</label><input type="number"
                                                    name="closing_total" class="form-control"
                                                    value="{{ $reports->closing }}"></div>
                                        </div>
                                        @elseif ($reports->jenis_leads === 'Site Visits')
                                        {{-- Leads: Site Visits --}}
                                        <div class="row mt-4">
                                            <div class="col-md-4"><label>Spent</label><input type="number"
                                                    name="spent_site" class="form-control"
                                                    value="{{ $reports->target_spent }}"></div>
                                            <div class="col-md-4"><label>Target Leads</label><input type="number"
                                                    name="leads_site" class="form-control"
                                                    value="{{ $reports->target_leads }}"></div>
                                            <div class="col-md-4"><label>Chat</label><input type="number"
                                                    name="chat_site" class="form-control" value="{{ $reports->chat }}">
                                            </div>
                                            <div class="col-md-4"><label>Respond</label><input type="number"
                                                    name="respond_site" class="form-control"
                                                    value="{{ $reports->respond }}"></div>
                                            <div class="col-md-4"><label>Site Visit / Closing</label><input
                                                    type="number" name="closing_site" class="form-control"
                                                    value="{{ $reports->closing }}"></div>
                                        </div>
                                        @endif

                                        @elseif ($reports->jenis_layanan_mb === 'Marketplace')
                                        {{-- Form untuk Marketplace --}}
                                        <div class="row mt-4">
                                            <div class="col-md-6"><label>Target Roas</label><input type="number"
                                                    name="target_roas" class="form-control"
                                                    value="{{ $reports->target_roas }}"></div>
                                            <div class="col-md-6"><label>Target Spent</label><input type="number"
                                                    name="target_spent" class="form-control"
                                                    value="{{ $reports->target_spent }}"></div>
                                            <div class="col-md-6"><label>Target Revenue</label><input type="number"
                                                    name="target_revenue" class="form-control"
                                                    value="{{ $reports->target_revenue }}"></div>
                                        </div>
                                        @endif

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Note</label>
                                                <textarea class="form-control" name="note" id="note"
                                                    placeholder="Note....." rows="3"
                                                    required>{{ $reports->note }}</textarea>
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