<x-clinet-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.clientnavbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <h5 class="font-weight-semibold text-lg mb-0">Informasi Laporan Bulanan</h5>
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
                                                            <p class="text-sm text-secondary mb-1 text-center">Tanggal
                                                                Laporan</p>
                                                            <h6 class="mb-2 font-weight-bold text-center">
                                                                {{
                                                                \Carbon\Carbon::parse($report->report_date)->translatedFormat('F
                                                                Y') ?? '-' }}
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
                                                            <p class="text-sm text-secondary mb-1 text-center">Jenis
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
                                <h5 class="font-weight-semibold text-lg mb-4">Informasi Grafik Layanan
                                    {{ $report->jenis_layanan_mb ?? '-' }} dengan Jenis
                                    Lead: {{ $report->jenis_leads ?? '-' }} pada Bulan
                                    {{ \Carbon\Carbon::parse($report->report_date)->translatedFormat('F Y') ?? '-' }}
                                </h5>
                                @if ($report->jenis_leads == 'F to F')
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Spent
                                        </h5>
                                        <canvas id="chartSpent" height="200"></canvas>
                                        <div id="customLegendSpent" class="mt-3 mb-4 text-center"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Harian
                                        </h5>
                                        <div id="chartContainer" class="mt-4 mb-4" style="height: 270px;"></div>
                                    </div>
                                </div>
                                @elseif ($report->jenis_leads == 'Roas Revenue')
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Spent
                                        </h5>
                                        <canvas id="chartSpent" height="200"></canvas>
                                        <div id="customLegendSpent" class="customSpent mt-4 mb-4"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Harian
                                        </h5>
                                        <canvas id="chartOther" height="200"></canvas>
                                        <div id="customLegendOther" class="customOther mt-4 mb-4"></div>
                                    </div>
                                </div>
                                @elseif ($report->jenis_leads == 'Total Closing')
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Spent
                                        </h5>
                                        <canvas id="chartSpent" height="200"></canvas>
                                        <div id="customLegendSpent" class="mt-3 mb-3 text-center"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Harian
                                        </h5>
                                        <canvas id="chartOther" height="200"></canvas>
                                        <div id="customLegendOther" class="mt-3 mb-3 text-center"></div>
                                    </div>
                                </div>
                                @elseif ($report->jenis_leads == 'Site Visits')
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Spent
                                        </h5>
                                        <canvas id="chartSpent" height="200"></canvas>
                                        <div id="customLegendSpent" class="mt-3 mb-3 text-center"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="font-weight-semibold text-lg mb-2 text-center">Grafik Harian
                                        </h5>
                                        <canvas id="chartOther" height="200"></canvas>
                                        <div id="customLegendOther" class="mt-3 mb-3 text-center"></div>
                                    </div>
                                </div>
                                @else
                                <p>Tidak ada grafik untuk jenis leads ini.</p>
                                @endif
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
                                    Belum ada data laporan harian untuk bulan ini.
                                </div>
                                @else
                                <table class="table align-items-center mb-0" id="clientTableMB">
                                    <thead class="bg-gray-100">
                                        <tr class="tabel-style">
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Hari</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Spent</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Revenue
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">ROAS</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Leads</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Chat</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Respond
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Greeting
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Pricelist
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Discuss
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Closing
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Site Visit
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">CPL</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">CPC</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">CR Leads
                                                to Chat</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">CR Chat to
                                                Respond</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">CR Respond
                                                to Closing</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">CR Respond
                                                to Site Visit</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Topup Details</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leads as $lead)
                                        <tr class="client-row-mb">
                                            <td>{{ $lead->hari }}</td>
                                            <td>{{ $lead->spent }}</td>
                                            <td>{{ $lead->revenue }}</td>
                                            <td>{{ $lead->roas }}</td>
                                            <td>{{ $lead->leads }}</td>
                                            <td>{{ $lead->chat }}</td>
                                            <td>{{ $lead->respond }}</td>
                                            <td>{{ $lead->greeting }}</td>
                                            <td>{{ $lead->pricelist }}</td>
                                            <td>{{ $lead->discuss }}</td>
                                            <td>{{ $lead->closing }}</td>
                                            <td>{{ $lead->site_visit }}</td>
                                            <td>{{ $lead->cpl }}</td>
                                            <td>{{ $lead->cpc }}</td>
                                            <td>{{ $lead->cr_leads_to_chat }}</td>
                                            <td>{{ $lead->cr_chat_to_respond }}</td>
                                            <td>{{ $lead->cr_respond_to_closing }}</td>
                                            <td>{{ $lead->cr_respond_to_site_visit }}</td>

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
                                                                    Detail Harian - {{
                                                                    \Carbon\Carbon::parse($lead->hari)->translatedFormat('l,
                                                                    d F Y') }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-4 mb-2"><strong>Spent:</strong>
                                                                        {{ $lead->spent }}</div>
                                                                    <div class="col-md-4 mb-2"><strong>Revenue:</strong>
                                                                        {{ $lead->revenue }}</div>
                                                                    <div class="col-md-4 mb-2"><strong>ROAS:</strong> {{
                                                                        $lead->roas }}</div>
                                                                    <div class="col-md-4 mb-2"><strong>Leads:</strong>
                                                                        {{ $lead->leads }}</div>
                                                                    <div class="col-md-4 mb-2"><strong>Chat:</strong> {{
                                                                        $lead->chat }}</div>
                                                                    <div class="col-md-4 mb-2"><strong>Respond:</strong>
                                                                        {{ $lead->respond }}</div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <strong>Greeting:</strong> {{ $lead->greeting }}
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <strong>Pricelist:</strong> {{ $lead->pricelist
                                                                        }}
                                                                    </div>
                                                                    <div class="col-md-4 mb-2"><strong>Discuss:</strong>
                                                                        {{ $lead->discuss }}</div>
                                                                    <div class="col-md-4 mb-2"><strong>Closing:</strong>
                                                                        {{ $lead->closing }}</div>
                                                                    <div class="col-md-4 mb-2"><strong>Site
                                                                            Visit:</strong> {{ $lead->site_visit }}
                                                                    </div>
                                                                    <div class="col-md-4 mb-2"><strong>CPL:</strong> {{
                                                                        $lead->cpl }}</div>
                                                                    <div class="col-md-4 mb-2"><strong>CPC:</strong> {{
                                                                        $lead->cpc }}</div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <strong>CR Leads to Chat:</strong> {{
                                                                        $lead->cr_leads_to_chat }}%
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <strong>CR Chat to Respond:</strong> {{
                                                                        $lead->cr_chat_to_respond }}%
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <strong>CR Respond to Closing:</strong> {{
                                                                        $lead->cr_respond_to_closing }}%
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <strong>CR Respond to Site Visit:</strong> {{
                                                                        $lead->cr_respond_to_site_visit }}%
                                                                    </div>

                                                                    <div class="col-md-12 mt-3">
                                                                        <strong>Note:</strong><br>{{ $lead->note }}
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
                                                    data-bs-toggle="tooltip" data-bs-title="Input data">
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
                <div class="modal fade" id="editLeadModal{{ $lead->id }}" tabindex="-1"
                    aria-labelledby="editLeadModalLabel{{ $lead->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <form action="{{ route('data-client.update-harian-lead', $lead->id) }}" method="POST"
                            class="modal-content">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="performance_bulanan_id"
                                value="{{ $lead->performance_bulanan_id }}">
                            <div class="modal-header mx-3 mt-3">
                                <h5 class="modal-title">Edit Data Harian</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" name="report_date" value="{{ $lead->hari }}"
                                        required readonly>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Spent</label>
                                        <input type="number" id="spent-edit-{{ $lead->id }}" class="form-control"
                                            name="spent" value="{{ $lead->spent }}" placeholder="Spent" readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Leads</label>
                                        <input type="number" id="leads-edit-{{ $lead->id }}" class="form-control"
                                            name="leads" value="{{ $lead->leads }}" placeholder="Leads" readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Chat</label>
                                        <input type="number" id="chat-edit-{{ $lead->id }}" class="form-control"
                                            name="chat" value="{{ $lead->chat }}" placeholder="Chat">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Greeting</label>
                                        <input type="number" id="greeting-edit-{{ $lead->id }}" class="form-control"
                                            name="greeting" value="{{ $lead->greeting }}" placeholder="Greeting">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Pricelist</label>
                                        <input type="number" id="pricelist-edit-{{ $lead->id }}" class="form-control"
                                            name="pricelist" value="{{ $lead->pricelist }}" placeholder="Pricelist">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Discuss</label>
                                        <input type="number" id="discuss-edit-{{ $lead->id }}" class="form-control"
                                            name="discuss" value="{{ $lead->discuss }}" placeholder="Discuss">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Respond</label>
                                        <input type="number" id="respond-edit-{{ $lead->id }}" class="form-control"
                                            name="respond" value="{{ $lead->respond }}" placeholder="Respond" readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Closing</label>
                                        <input type="number" id="closing-edit-{{ $lead->id }}" class="form-control"
                                            name="closing" value="{{ $lead->closing }}" placeholder="Closing">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Site Visit</label>
                                        <input type="number" id="site_visit-edit-{{ $lead->id }}" class="form-control"
                                            name="site_visit" value="{{ $lead->site_visit }}" placeholder="Site Visit">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Revenue</label>
                                        <input type="number" id="revenue-edit-{{ $lead->id }}" class="form-control"
                                            name="revenue" value="{{ $lead->revenue }}" placeholder="Revenue">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">ROAS</label>
                                        <input type="number" id="roas-edit-{{ $lead->id }}" class="form-control"
                                            name="roas" value="{{ $lead->roas }}" placeholder="Roas" readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">CPL</label>
                                        <input type="number" id="cpl-edit-{{ $lead->id }}" class="form-control"
                                            name="cpl" value="{{ $lead->cpl }}" placeholder="CPL" readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">CPC</label>
                                        <input type="number" id="cpc-edit-{{ $lead->id }}" class="form-control"
                                            name="cpc" value="{{ $lead->cpc }}" placeholder="CPC" readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">CR Leads > Chat</label>
                                        <input type="number" id="cr_leads_chat-edit-{{ $lead->id }}"
                                            class="form-control" name="cr_leads_chat"
                                            value="{{ $lead->cr_leads_to_chat }}" placeholder="CR Leads > Chat"
                                            readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">CR Chat > Respond</label>
                                        <input type="number" id="cr_chat_respond-edit-{{ $lead->id }}"
                                            class="form-control" name="cr_chat_respond"
                                            value="{{ $lead->cr_chat_to_respond }}" placeholder="CR Chat > Respond"
                                            readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">CR Respond > Closing</label>
                                        <input type="number" id="cr_respond_closing-edit-{{ $lead->id }}"
                                            class="form-control" name="cr_respond_closing"
                                            value="{{ $lead->cr_respond_to_closing }}"
                                            placeholder="CR Respond > Closing" readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">CR Respond > Site Visit</label>
                                        <input type="number" id="cr_respond_site_visit-edit-{{ $lead->id }}"
                                            class="form-control" name="cr_respond_site_visit"
                                            value="{{ $lead->cr_respond_to_site_visit }}"
                                            placeholder="CR Respond > Site Visit" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Note</label>
                                    <textarea class="form-control" name="note" rows="3" required
                                        readonly>{{ $lead->note }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
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

        @php $jenis = $report->jenis_leads; @endphp

        @if ($jenis == 'F to F')
            const datasetsSpent = [{
                label: 'Spent',
                data: {!! json_encode($leads->pluck('spent')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                fill: false,
                tension: 0.1,
            }];

            const datasetsOther = [{
                    label: 'Leads',
                    data: {!! json_encode($leads->pluck('leads')) !!},
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgba(255, 205, 86, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Chat',
                    data: {!! json_encode($leads->pluck('chat')) !!},
                    borderColor: 'rgb(255, 159, 64)',
                    backgroundColor: 'rgba(255, 159, 64, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Greeting',
                    data: {!! json_encode($leads->pluck('greeting')) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Pricelist',
                    data: {!! json_encode($leads->pluck('pricelist')) !!},
                    borderColor: 'rgb(153, 102, 255)',
                    backgroundColor: 'rgba(153, 102, 255, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Discuss',
                    data: {!! json_encode($leads->pluck('discuss')) !!},
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'Note',
                    data: {!! json_encode($leads->pluck('note')) !!},
                    borderColor: 'rgb(201, 203, 207)',
                    backgroundColor: 'rgba(201, 203, 207, 0.1)',
                    fill: false,
                    tension: 0.1,
                }
            ];
        @elseif ($jenis == 'Roas Revenue')
            const datasetsSpent = [{
                label: 'Spent',
                data: {!! json_encode($leads->pluck('spent')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                fill: false,
                tension: 0.1,
            }];

            const datasetsOther = [{
                    label: 'Revenue',
                    data: {!! json_encode($leads->pluck('revenue')) !!},
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgba(255, 205, 86, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: 'ROAS',
                    data: {!! json_encode($leads->pluck('roas')) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
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
        @elseif ($jenis == 'Total Closing')
            const datasetsSpent = [{
                label: 'Spent',
                data: {!! json_encode($leads->pluck('spent')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                fill: false,
                tension: 0.1,
            }];

            const datasetsOther = [{
                    label: 'Leads',
                    data: {!! json_encode($leads->pluck('leads')) !!},
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgba(255, 205, 86, 0.1)',
                    fill: false,
                    tension: 0.1,
                },
                {
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
        @elseif ($jenis == 'Site Visits')
            const datasetsSpent = [{
                label: 'Spent',
                data: {!! json_encode($leads->pluck('spent')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                fill: false,
                tension: 0.1,
            }];

            const datasetsOther = [{
                    label: 'Leads',
                    data: {!! json_encode($leads->pluck('leads')) !!},
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgba(255, 205, 86, 0.1)',
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
        @endif

        // Fungsi chart & legend tetap sama
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
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const leadId = "{{ $lead->id }}";

    const spent = document.getElementById(`spent-edit-${leadId}`);
    const revenue = document.getElementById(`revenue-edit-${leadId}`);
    const greeting = document.getElementById(`greeting-edit-${leadId}`);
    const pricelist = document.getElementById(`pricelist-edit-${leadId}`);
    const discuss = document.getElementById(`discuss-edit-${leadId}`);
    const respond = document.getElementById(`respond-edit-${leadId}`);
    const leads = document.getElementById(`leads-edit-${leadId}`);
    const chat = document.getElementById(`chat-edit-${leadId}`);
    const closing = document.getElementById(`closing-edit-${leadId}`);
    const siteVisits = document.getElementById(`site_visits-edit-${leadId}`);

    const roas = document.getElementById(`roas-edit-${leadId}`);
    const crLeadsChat = document.getElementById(`cr_leads_chat-edit-${leadId}`);
    const crChatRespond = document.getElementById(`cr_chat_respond-edit-${leadId}`);
    const crRespondClosing = document.getElementById(`cr_respond_closing-edit-${leadId}`);
    const crRespondSiteVisit = document.getElementById(`cr_respond_site_visit-edit-${leadId}`);

    function editCalculateRoas() {
        let s = parseFloat(spent.value) || 0;
        let r = parseFloat(revenue.value) || 0;
        roas.value = s > 0 ? (r / s).toFixed(2) : 0;
    }

    function editCalculateRespond() {
        let g = parseInt(greeting.value) || 0;
        let p = parseInt(pricelist.value) || 0;
        let d = parseInt(discuss.value) || 0;
        respond.value = g + p + d;

        editCalculateCRChatRespond();
        editCalculateCRRespondClosing();
        editCalculateCRRespondSiteVisit();
    }

    function editCalculateCRLeadsChat() {
        let l = parseInt(leads.value) || 0;
        let c = parseInt(chat.value) || 0;
        crLeadsChat.value = l > 0 ? ((c / l) * 100).toFixed(2) : 0;
    }

    function editCalculateCRChatRespond() {
        let c = parseInt(chat.value) || 0;
        let r = parseInt(respond.value) || 0;
        crChatRespond.value = c > 0 ? ((r / c) * 100).toFixed(2) : 0;
    }

    function editCalculateCRRespondClosing() {
        let r = parseInt(respond.value) || 0;
        let cl = parseInt(closing.value) || 0;
        crRespondClosing.value = r > 0 ? ((cl / r) * 100).toFixed(2) : 0;
    }

    function editCalculateCRRespondSiteVisit() {
        let r = parseInt(respond.value) || 0;
        let s = parseInt(siteVisits.value) || 0;
        crRespondSiteVisit.value = r > 0 ? ((s / r) * 100).toFixed(2) : 0;
    }

    spent.addEventListener('input', editCalculateRoas);
    revenue.addEventListener('input', editCalculateRoas);

    greeting.addEventListener('input', editCalculateRespond);
    pricelist.addEventListener('input', editCalculateRespond);
    discuss.addEventListener('input', editCalculateRespond);

    leads.addEventListener('input', editCalculateCRLeadsChat);
    chat.addEventListener('input', () => {
        editCalculateCRLeadsChat();
        editCalculateCRChatRespond();
    });

    closing.addEventListener('input', editCalculateCRRespondClosing);
    siteVisits.addEventListener('input', editCalculateCRRespondSiteVisit);
});
    </script>


    </x-app-layout>