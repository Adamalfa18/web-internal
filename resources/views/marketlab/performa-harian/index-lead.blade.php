<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 bor
    er-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4 border-client">
                            <div class="card-header border-bottom pb-0 border-client-bottom">
                                <h5 class="font-weight-semibold text-lg mb-0">Informasi Laporan Bulanan</h5>
                                <ul class="mb-4 text-sm">
                                    <li><strong>Client:</strong> {{ $report->client->nama_brand ?? '-' }}</li>
                                    <li><strong>Tanggal Laporan:</strong> {{ $report->report_date ?? '-' }}</li>
                                    <li><strong>Jenis Layanan:</strong> {{ $report->jenis_layanan_mb ?? '-' }}</li>
                                    <li><strong>Jenis Leads:</strong> {{ $report->jenis_leads ?? '-' }}</li>
                                </ul>
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
                                    <div class="ms-auto d-flex">
                                        <a class="btn btn-sm btn-clien btn-icon d-flex align-items-center me-2" href="#"
                                            role="button" data-bs-toggle="modal" data-bs-target="#createLeadModal">
                                            <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path
                                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                </svg>
                                            </span>
                                            <span class="btn-inner--text">Add Daily Report</span>
                                        </a>
                                    </div>
                                    <!-- Modal untuk Create -->
                                    <div class="modal fade" id="createLeadModal" tabindex="-1"
                                        aria-labelledby="createLeadModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <form action="{{ route('lead.store') }}" method="POST"
                                                class="modal-content">
                                                @csrf
                                                <input type="hidden" name="performance_bulanan_id"
                                                    value="{{ $report->id }}">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Data Harian</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>

                                                <div class="modal-body row">
                                                    @foreach ($fields as $field)
                                                    @if ($field == 'hari')
                                                    @continue
                                                    @endif
                                                    <div class="mb-3 col-md-6">
                                                        <label>{{ ucfirst($field) }}</label>
                                                        <input type="text" name="{{ $field }}" class="form-control">
                                                    </div>
                                                    @endforeach

                                                    <div class="mb-3 col-md-6">
                                                        <label>Hari</label>
                                                        <input type="date" name="hari" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label>Note</label>
                                                        <input type="text" name="note" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
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
                            @if ($leads->isEmpty())
                            <div class="alert alert-warning">
                                Belum ada data laporan harian untuk bulan ini.
                            </div>
                            @else
                            <table class="table align-items-center mb-0" id="clientTableMB">
                                <thead class="bg-gray-100">
                                    <tr class="tabel-style">
                                        @foreach ($fields as $field)
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                            {{ ucfirst($field) }}
                                        </th>
                                        @endforeach
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leads as $lead)
                                    <tr class="client-row-mb">
                                        @foreach ($fields as $field)
                                        <td class="client-name-style">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">
                                                        {{ $lead->$field }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        @endforeach
                                        <td class="align-middle">
                                            <a href=""
                                                class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                data-bs-toggle="tooltip" data-bs-title="Laporan Bulanan">
                                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
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
        </div>
    </main>
</x-app-layout>