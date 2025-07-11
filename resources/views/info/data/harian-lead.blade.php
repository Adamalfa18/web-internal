<x-clinet-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.clientnavbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <h5 class="font-weight-semibold text-lg mb-0">Monthly Report Information</h5>
                                <div class="row mt-2">
                                    <div class="col-xl-3 col-md-3 mb-xl-0">
                                        <div class="card border shadow-xs mb-4">
                                            <div class="style-day card-body text-start p-3 w-100">
                                                <div
                                                    class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-person-circle"
                                                        viewBox="0 0 16 16">
                                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                        <path fill-rule="evenodd"
                                                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                                    </svg>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="w-100">
                                                            <p class="text-sm text-secondary mb-1 text-center">Nama
                                                                Brand</p>
                                                            <h6 class="mb-2 font-weight-bold text-center">
                                                                {{ $report->client->nama_brand ?? '-' }}
                                                            </h6>
                                                            <div class="d-flex align-items-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 mb-xl-0">
                                        <div class="card border shadow-xs mb-4">
                                            <div class="style-day card-body text-start p-3 w-100">
                                                <div
                                                    class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-calendar-date"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.445 11.688V6.354h-.633A13 13 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23" />
                                                        <path
                                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                                    </svg>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="w-100">
                                                            <p class="text-sm text-secondary mb-1 text-center">Bulan
                                                            </p>
                                                            <h6 class="mb-2 font-weight-bold text-center">
                                                                {{
                                                                \Carbon\Carbon::parse($report->report_date)->translatedFormat('F
                                                                Y') ??
                                                                '-' }}
                                                            </h6>
                                                            <div class="d-flex align-items-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 mb-xl-0">
                                        <div class="card border shadow-xs mb-4">
                                            <div class="style-day card-body text-start p-3 w-100">
                                                <div
                                                    class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5m1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0M1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5" />
                                                    </svg>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="w-100">
                                                            <p class="text-sm text-secondary mb-1 text-center">Jenis
                                                                Layanan</p>
                                                            <h6 class="mb-2 font-weight-bold text-center">
                                                                {{ $report->jenis_layanan_mb ?? '-' }}
                                                            </h6>
                                                            <div class="d-flex align-items-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 mb-xl-0">
                                        <div class="card border shadow-xs mb-4">
                                            <div class="style-day card-body text-start p-3 w-100">
                                                <div
                                                    class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M0 0h1v15h15v1H0zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07" />
                                                    </svg>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="w-100">
                                                            <p class="text-sm text-secondary mb-1 text-center">Target
                                                                Leads</p>
                                                            <h6 class="mb-2 font-weight-bold text-center">
                                                                {{ $report->jenis_leads ?? '-' }}
                                                            </h6>
                                                            <div class="d-flex align-items-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <h5 class="font-weight-semibold text-lg mb-4">Graph Information for Service
                                    {{ $report->jenis_layanan_mb ?? '-' }} with Lead Target: {{ $report->jenis_leads ??
                                    '-' }} in
                                    {{ \Carbon\Carbon::parse($report->report_date)->translatedFormat('F Y') ?? '-' }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Spent Chart</h5>
                                        <canvas id="chartSpent" height="200"></canvas>
                                        <div id="customLegendSpent" class="mt-3 mb-3 text-center"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Daily Chart</h5>
                                        <canvas id="chartOther" height="200"></canvas>
                                        <div id="customLegendOther" class="mt-3 mb-3 text-center"></div>
                                    </div>
                                </div>

                                {{-- Tambah grafik funnel --}}
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5 class="font-weight-semibold text-lg mb-4 text-center">Grafik Funnel</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="funnelChart"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <div class="d-sm-flex align-items-center">
                                    <div>
                                        <h6 class="font-weight-semibold text-lg mb-0">Daily Report</h6>
                                        <p class="text-sm">List of market booster daily report</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="table-responsive p-0">
                                @if ($leads->isEmpty())
                                <div class="alert alert-warning">
                                    There is no daily report data for this month.
                                </div>
                                @else
                                <div class="mb-3 column-toggle-container">
                                    <label><input type="checkbox" class="column-toggle" data-column="3"> Revenue</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="4"> ROAS</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="5"> Impresi</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="6"> Click</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="7"> Leads</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="8"> Chat</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="9"> Respond</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="10">
                                        Greeting</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="11">
                                        Pricelist</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="12">
                                        Discuss</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="13">
                                        Closing</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="14"> Site
                                        Visit</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="15"> CPL</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="16"> CPC</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="17"> CR Leads to
                                        Chat</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="18"> CR Chat to
                                        Respond</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="19"> CR Respond to
                                        Closing</label>
                                    <label><input type="checkbox" class="column-toggle" data-column="20"> CR Respond to
                                        Site Visit</label>

                                </div>
                                <table class="table align-items-center mb-0" id="clientTableMB">
                                    <thead class="bg-gray-100">
                                        <tr class="tabel-style">
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Hari
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                Platform
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Spent
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">
                                                Revenue
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">ROAS
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">
                                                Impresi
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">Click
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">Leads
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">Chat
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">
                                                Respond
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">
                                                Greeting
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">
                                                Pricelist
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">
                                                Discuss
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">
                                                Closing
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">Site
                                                Visit
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">CPL
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">CPC
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">CR
                                                Leads
                                                to Chat</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">CR
                                                Chat to
                                                Respond</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">CR
                                                Respond
                                                to Closing</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                style="display: none;">CR
                                                Respond
                                                to Site Visit</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Detail</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leads as $lead)
                                        <tr class="client-row-mb">
                                            <td class="text-center">{{ $lead->hari }}</td>
                                            <td class="text-center">{{ $lead->platform }}</td>
                                            <td class="text-center">
                                                Rp {{ number_format($lead->spent, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center" style="display: none;">
                                                Rp {{ number_format($lead->revenue, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->roas }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->impresi }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->click }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->leads }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->chat }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->respond }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->greeting }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->pricelist }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->discuss }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->closing }}</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->site_visit }}</td>
                                            <td class="text-center" style="display: none;">
                                                Rp {{ number_format($lead->cpl, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center" style="display: none;">
                                                Rp {{ number_format($lead->cpc, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->cr_leads_to_chat }}%</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->cr_chat_to_respond }}%</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->cr_respond_to_closing }}%</td>
                                            <td class="text-center" style="display: none;">
                                                {{ $lead->cr_respond_to_site_visit }}%
                                            </td>
                                            <!-- Kolom aksi -->
                                            <td class="align-middle text-center">
                                                <button type="button"
                                                    class="btn-style btn btn-info text-secondary font-weight-bold text-xs"
                                                    data-bs-toggle="modal" data-bs-target="#detailModal{{ $lead->id }}">
                                                    Lihat Detail Harian
                                                </button>

                                                <!-- Modal Detail -->
                                                <div class="modal fade" id="detailModal{{ $lead->id }}" tabindex="-1"
                                                    aria-labelledby="detailModalLabel{{ $lead->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header mx-3 mt-3">
                                                                <h5 class="modal-title">
                                                                    Detail Lead Hari -
                                                                    {{
                                                                    \Carbon\Carbon::parse($lead->hari)->translatedFormat('l,
                                                                    d F Y') }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                            </div>
                                                            <div class="modal-body detail-lead-harian">
                                                                <h6 class="mb-3">
                                                                    Leads Target : {{ $lead->platform }}
                                                                </h6>
                                                                <div class="row">
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">Spent:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->spent }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label
                                                                            class="detail-lead-harian">Revenue:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->revenue }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">ROAS:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->roas }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">Leads:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->leads }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">Chat:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->chat }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label
                                                                            class="detail-lead-harian">Respond:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->respond }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label
                                                                            class="detail-lead-harian">Greeting:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->greeting }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label
                                                                            class="detail-lead-harian">Pricelist:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->pricelist }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label
                                                                            class="detail-lead-harian">Discuss:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->discuss }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label
                                                                            class="detail-lead-harian">Closing:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->closing }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">Site
                                                                            Visit:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->site_visit }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">CPL:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->cpl }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">CPC:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->cpc }}" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">CR
                                                                            Leads to Chat:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->cr_leads_to_chat }}%"
                                                                            readonly>

                                                                        <strong></strong>

                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">CR
                                                                            Chat to Respond:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->cr_chat_to_respond }}%"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">CR
                                                                            Respond to Closing:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->cr_respond_to_closing }}%"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <label class="detail-lead-harian">CR
                                                                            Respond to Site
                                                                            Visit:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->cr_respond_to_site_visit }}%"
                                                                            readonly>
                                                                    </div>

                                                                    <div class="col-md-12 mt-3">
                                                                        <label class="detail-lead-harian">Note:</label>
                                                                        <input class="form-control"
                                                                            value="{{ $lead->note }}" readonly>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Kolom aksi edit & hapus -->
                                            <td class="align-middle">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editLeadModal{{ $lead->id }}" type="button"
                                                    class="btn btn-primary text-secondary font-weight-bold text-xs active-client"
                                                    data-bs-toggle="tooltip" data-bs-title="Edit user">
                                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                </a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MODAL EDIT --}}
                @foreach ($leads as $lead)
                <div class="modal fade" id="editLeadModal{{ $lead->id }}" tabindex="-1"
                    aria-labelledby="editLeadModalLabel{{ $lead->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <form action="{{ route('data-client.update-harian-lead', $lead->id) }}" method="POST"
                            class="lead-form modal-content">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="performance_bulanan_id"
                                value="{{ $lead->performance_bulanan_id }}">

                            <div class="modal-header mx-3 mt-3">
                                <h5 class="modal-title">Edit Data Lead Harian</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" name="report_date"
                                            value="{{ $lead->hari }}" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Platform</label>
                                        <select class="form-control" name="platform" readonly>
                                            <option value="" disabled>Pilih Platform</option>
                                            <option value="Meta" {{ $lead->platform == 'Meta' ? 'selected' : '' }}>Meta
                                            </option>
                                            <option value="Google" {{ $lead->platform == 'Google' ? 'selected' : ''
                                                }}>Google</option>
                                            <option value="Facebook" {{ $lead->platform == 'Facebook' ? 'selected' : ''
                                                }}>Facebook
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Spent</label>
                                        <input type="text" class="form-control" name="spent" value="{{ $lead->spent }}"
                                            placeholder="Target Spent" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Impresi</label>
                                        <input type="text" class="form-control" name="impresi"
                                            value="{{ $lead->impresi }}" placeholder="Jumlah Impresi" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Click</label>
                                        <input type="text" class="form-control" name="click" value="{{ $lead->click }}"
                                            placeholder="Jumlah Click" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Leads</label>
                                        <input type="number" class="form-control" name="leads"
                                            value="{{ $lead->leads }}" placeholder="Target Lead" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">CPL</label>
                                        <input type="number" class="form-control" name="cpl" value="{{ $lead->cpl }}"
                                            placeholder="Cost Per Lead">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">CPC</label>
                                        <input type="number" class="form-control" name="cpc" value="{{ $lead->cpc }}"
                                            placeholder="Cost Per Click">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">
                                            <span style="font-size: 18px"> Client Input</span>
                                            <p style="font-size: 12px">The form is filled in directly by the client
                                                For
                                                provide the required data.</p>
                                        </label>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Chat</label>
                                        <input type="number" class="form-control" name="chat" value="{{ $lead->chat }}"
                                            placeholder="Chat">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Greeting</label>
                                        <input type="number" class="form-control" name="greeting"
                                            value="{{ $lead->greeting }}" placeholder="Greeting">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Pricelist</label>
                                        <input type="number" class="form-control" name="pricelist"
                                            value="{{ $lead->pricelist }}" placeholder="Pricelist">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Discuss</label>
                                        <input type="number" class="form-control" name="discuss"
                                            value="{{ $lead->discuss }}" placeholder="Discuss">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Closing</label>
                                        <input type="number" class="form-control" name="closing"
                                            value="{{ $lead->closing }}" placeholder="Closing">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Site Visit</label>
                                        <input type="number" class="form-control" name="site_visit"
                                            value="{{ $lead->site_visit }}" placeholder="Site Visits">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Revenue</label>
                                        <input type="text" class="form-control" name="revenue"
                                            value="{{ $lead->revenue }}" placeholder="Target Revenue">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">
                                            <span style="font-size: 18px">Results Form</span>
                                            <p style="font-size: 12px">Filled automatically from data that has been
                                                previously input.</p>
                                        </label>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">ROAS</label>
                                        <input type="number" class="form-control" name="roas" value="{{ $lead->roas }}"
                                            placeholder="Roas" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">Respond</label>
                                        <input type="number" class="form-control" name="respond"
                                            value="{{ $lead->respond }}" placeholder="Respond" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">CR Leads > Chat</label>
                                        <input type="number" class="form-control" name="cr_leads_chat"
                                            value="{{ $lead->cr_leads_to_chat }}" placeholder="CR Leads > Chat"
                                            readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">CR Chat > Respond</label>
                                        <input type="number" class="form-control" name="cr_chat_respond"
                                            value="{{ $lead->cr_chat_to_respond }}" placeholder="CR Chat > Respond"
                                            readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">CR Respond > Closing</label>
                                        <input type="number" class="form-control" name="cr_respond_closing"
                                            value="{{ $lead->cr_respond_to_closing }}"
                                            placeholder="CR Respond > Closing" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">CR Respond > Site Visit</label>
                                        <input type="number" class="form-control" name="cr_respond_site_visit"
                                            value="{{ $lead->cr_respond_to_site_visit }}"
                                            placeholder="CR Respond > Site Visit" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Note</label>
                                        <textarea class="form-control" name="note" rows="3"
                                            readonly>{{ $lead->note }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var funnelData = [
                @foreach ($totals_scaled as $label => $value)
                    {{ $value }},
                @endforeach
            ];

            var funnelLabels = {!! json_encode($funnelLabels) !!};

            var options = {
                series: [{
                    name: "Jumlah",
                    data: funnelData
                }],
                chart: {
                    type: 'bar',
                    height: 400,
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        isFunnel: true,
                        barHeight: '80%',
                    },
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opt) {
                        return funnelLabels[opt.dataPointIndex];
                    },
                    style: {
                        fontSize: '14px'
                    }
                },
                xaxis: {
                    categories: funnelLabels,
                    max: 100
                },
                tooltip: {
                    enabled: false
                },
                legend: {
                    show: false,
                },
            };

            var funnelChart = new ApexCharts(document.querySelector("#funnelChart"), options);
            funnelChart.render();
        });
    </script>

    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                data: [{
                    type: "funnel",
                    indexLabel: "{label} - {y}", // Menampilkan label + nilai dalam grafik
                    toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
                    neckWidth: 20,
                    neckHeight: 0,
                    valueRepresents: "area",
                    dataPoints: [
                        @foreach ($totals as $label => $value)
                            {
                                y: {{ $value }},
                                label: "{{ $label }}"
                            },
                        @endforeach
                    ],
                }],
            });

            calculatePercentage();
            chart.render();

            function calculatePercentage() {
                var dataPoint = chart.options.data[0].dataPoints;
                var total = dataPoint[0].y;
                for (var i = 0; i < dataPoint.length; i++) {
                    if (i == 0) {
                        chart.options.data[0].dataPoints[i].percentage = 100;
                    } else {
                        chart.options.data[0].dataPoints[i].percentage = (
                            (dataPoint[i].y / total) * 100
                        ).toFixed(2);
                    }
                }
            }
        };
    </script>

    <script>
        let chartSpent, chartOther;

        const labels = {!! json_encode($leads->pluck('hari')) !!};

        const datasetsSpent = [{
                label: 'Spent',
                data: {!! json_encode($leads->pluck('spent')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                fill: false,
                tension: 0.1,
            },
            {
                label: 'Revenue',
                data: {!! json_encode($leads->pluck('revenue')) !!},
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                fill: false,
                tension: 0.1,
            },
        ];

        const datasetsOther = [{
                label: 'Chat',
                data: {!! json_encode($leads->pluck('chat')) !!},
                borderColor: 'rgb(255, 159, 64)',
                backgroundColor: 'rgba(255, 159, 64, 0.1)',
                fill: false,
                tension: 0.1,
            },
            {
                label: 'Respond',
                data: {!! json_encode($leads->pluck('respond')) !!},
                borderColor: 'rgb(153, 102, 255)',
                backgroundColor: 'rgba(153, 102, 255, 0.1)',
                fill: false,
                tension: 0.1,
            },
            {
                label: 'Closing',
                data: {!! json_encode($leads->pluck('closing')) !!},
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                fill: false,
                tension: 0.1,
            }
        ];

        function createChart(ctxId, dataSets, legendContainerId) {
            const ctx = document.getElementById(ctxId).getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: dataSets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            setTimeout(() => generateCustomLegend(chart, legendContainerId), 100);
            return chart;
        }

        function generateCustomLegend(chart, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';

            chart.data.datasets.forEach((ds, index) => {
                const box = document.createElement('span');
                box.textContent = ds.label;

                box.style.backgroundColor = ds.hidden ? '#ccc' : ds.borderColor;
                box.style.color = '#fff';
                box.style.padding = '6px 12px';
                box.style.borderRadius = '8px';
                box.style.fontSize = '12px';
                box.style.fontWeight = '600';
                box.style.display = 'inline-block';
                box.style.lineHeight = '1';
                box.style.marginRight = '8px';
                box.style.cursor = 'pointer';

                box.addEventListener('click', function() {
                    const meta = chart.getDatasetMeta(index);
                    meta.hidden = meta.hidden === null ? !chart.data.datasets[index].hidden : null;
                    chart.update();
                    generateCustomLegend(chart, containerId);
                });

                container.appendChild(box);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            chartSpent = createChart('chartSpent', datasetsSpent, 'customLegendSpent');
            chartOther = createChart('chartOther', datasetsOther, 'customLegendOther');
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

        function unformatRupiah(rupiah) {
            return rupiah.replace(/[^0-9]/g, '');
        }

        function setupLeadFormEvents(form) {
            const getVal = (name) => parseInt(form.querySelector(`[name="${name}"]`)?.value) || 0;
            const setVal = (name, val) => {
                const input = form.querySelector(`[name="${name}"]`);
                if (input) input.value = val;
            }

            const formatInputRupiah = (el) => {
                el.addEventListener('input', function() {
                    const raw = unformatRupiah(this.value);
                    this.value = formatRupiah(raw);
                    calculateRoas();
                });
            }

            const calculateRoas = () => {
                const spent = parseFloat(unformatRupiah(form.querySelector('[name="spent"]')?.value || '0')) || 0;
                const revenue = parseFloat(unformatRupiah(form.querySelector('[name="revenue"]')?.value || '0')) || 0;
                const roas = spent > 0 ? (revenue / spent).toFixed(2) : 0;
                setVal('roas', roas);
            }

            const calculateRespond = () => {
                const respond = getVal('greeting') + getVal('pricelist') + getVal('discuss');
                setVal('respond', respond);
                calculateCRChatRespond();
                calculateCRRespondClosing();
                calculateCRRespondSiteVisit();
            }

            const calculateCRLeadsChat = () => {
                const leads = getVal('leads');
                const chat = getVal('chat');
                const cr = (leads > 0) ? ((chat / leads) * 100).toFixed(2) : 0;
                setVal('cr_leads_chat', cr);
            }

            const calculateCRChatRespond = () => {
                const chat = getVal('chat');
                const respond = getVal('respond');
                const cr = (chat > 0) ? ((respond / chat) * 100).toFixed(2) : 0;
                setVal('cr_chat_respond', cr);
            }

            const calculateCRRespondClosing = () => {
                const closing = getVal('closing');
                const respond = getVal('respond');
                const cr = (respond > 0) ? ((closing / respond) * 100).toFixed(2) : 0;
                setVal('cr_respond_closing', cr);
            }

            const calculateCRRespondSiteVisit = () => {
                const siteVisit = getVal('site_visit');
                const respond = getVal('respond');
                const cr = (respond > 0) ? ((siteVisit / respond) * 100).toFixed(2) : 0;
                setVal('cr_respond_site_visit', cr);
            }

            // Format semua input rupiah
            form.querySelectorAll('[name="spent"], [name="revenue"]').forEach(formatInputRupiah);

            // Listener input lainnya
            const listen = (name, fn) => {
                const el = form.querySelector(`[name="${name}"]`);
                if (el) el.addEventListener('input', fn);
            }

            listen('greeting', calculateRespond);
            listen('pricelist', calculateRespond);
            listen('discuss', calculateRespond);
            listen('leads', calculateCRLeadsChat);
            listen('chat', () => {
                calculateCRLeadsChat();
                calculateCRChatRespond();
            });
            listen('closing', calculateCRRespondClosing);
            listen('site_visit', calculateCRRespondSiteVisit);

            // Hitung awal
            calculateRoas();
            calculateRespond();
            calculateCRLeadsChat();
        }

        window.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.lead-form').forEach(setupLeadFormEvents);
        });
    </script>
    <script>
        document.querySelectorAll('.column-toggle').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const colIndex = parseInt(this.dataset.column);
                const table = document.querySelector('.table');
                const rows = table.querySelectorAll('thead tr, tbody tr');

                rows.forEach(row => {
                    const cells = row.querySelectorAll('th, td');
                    if (cells[colIndex]) {
                        cells[colIndex].style.display = this.checked ? '' : 'none';
                    }
                });
            });
        });
    </script>
    </x-app-layout>