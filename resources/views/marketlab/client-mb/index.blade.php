<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.marketlab.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="collapse multi-collapse show" id="multiCollapseExample1">
                        <div class="card card-body">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Clients MB List</h6>
                                            <p class="text-sm">Marketlab clients MB list</p>
                                        </div>

                                        <form method="GET" class="d-flex gap-2">
                                            <input type="text" name="nama_brand" value="{{ request('nama_brand') }}"
                                                placeholder="Search Brand Name" class="form-control form-control-sm">
                                            <input type="date" name="tanggal_aktif"
                                                value="{{ request('tanggal_aktif') }}"
                                                class="form-control form-control-sm">
                                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                                            <a href="{{ route('clients-mb.index') }}?status={{ request('status', 1) }}"
                                                class="btn btn-secondary" id="resetFilter">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                                </svg>
                                            </a>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0" id="clientTableMB">
                                            <thead class="bg-gray-100">
                                                <tr class="tabel-style">
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">No
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Brand Name</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Client Name</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Active Date</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients as $client)
                                                <tr class="client-row-mb"
                                                    data-nama-brand-mb="{{ strtolower($client->nama_brand) }}"
                                                    data-tanggal-aktip-mb="{{ $client->date_in }}"
                                                    data-status-layanan-mb="{{ $client->status_layanan }}">
                                                    <td class="align-middle text-center row-number">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="client-name-style">
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                                <h6 class="mb-0 text-sm font-weight-semibold">
                                                                    {{ $client->nama_brand }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="client-name-style">
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                                            {{ $client->nama_client }}</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        @switch($client->status_layanan)
                                                        @case(1)
                                                        <span
                                                            class="badge badge-sm border border-success text-success badge-aktif">Active</span>
                                                        @break

                                                        @case(2)
                                                        <span
                                                            class="badge badge-sm border border-warning text-warning badge-pending">Pending</span>
                                                        @break

                                                        @case(3)
                                                        <span
                                                            class="badge badge-sm border border-danger text-danger badge-paid">Paid</span>
                                                        @break
                                                        @endswitch
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-sm font-weight-normal">
                                                            {{ $client->date_in }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="{{ route('laporan-bulanan.index', ['client_id' => $client->id]) }}"
                                                            class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                            data-bs-toggle="tooltip" data-bs-title="Laporan Bulanan">
                                                            <svg width="20" height="20"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
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

                                        <!-- Pagination -->
                                        <div class="d-flex justify-content-center mt-4">
                                            {{
                                            $clients->appends(request()->except('page'))->links('vendor.pagination.custom')
                                            }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JS for filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterNamaBrandMB = document.getElementById('filterNamaBrandMB');
            const filterTanggalAktipMB = document.getElementById('filterTanggalAktipMB');
            const rowsMB = document.querySelectorAll('.client-row-mb');

            // Hide rows that are NOT status 1 (aktif) on page load
            rowsMB.forEach(row => {
                const statusMB = row.dataset.statusLayananMb;
                if (statusMB != '1') {
                    row.style.display = 'none';
                }
            });

            // Function to update row numbers
            function updateRowNumbers() {
                let visibleCount = 1;
                rowsMB.forEach(row => {
                    if (row.style.display !== 'none') {
                        row.querySelector('.row-number').textContent = visibleCount;
                        visibleCount++;
                    }
                });
            }

            // Filter function
            function applyFilterMB() {
                const namaBrandValueMB = filterNamaBrandMB.value.toLowerCase();
                const tanggalValueMB = filterTanggalAktipMB.value;

                rowsMB.forEach(row => {
                    const namaBrandMB = row.dataset.namaBrandMb;
                    const tanggalAktipMB = row.dataset.tanggalAktipMb;
                    const statusMB = row.dataset.statusLayananMb;

                    let showRowMB = true;

                    // Always hide if not active
                    if (statusMB != '1') {
                        showRowMB = false;
                    }

                    // Filter Brand Name
                    if (namaBrandValueMB && !namaBrandMB.includes(namaBrandValueMB)) {
                        showRowMB = false;
                    }

                    // Filter tanggal aktip (exact match)
                    if (tanggalValueMB && tanggalAktipMB !== tanggalValueMB) {
                        showRowMB = false;
                    }

                    row.style.display = showRowMB ? '' : 'none';
                });

                // Update row numbers after filtering
                updateRowNumbers();
            }

            filterNamaBrandMB.addEventListener('input', applyFilterMB);
            filterTanggalAktipMB.addEventListener('change', applyFilterMB);

            // Initial row number update
            updateRowNumbers();
        });
    </script>
</x-app-layout>