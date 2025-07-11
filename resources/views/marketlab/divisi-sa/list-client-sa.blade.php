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
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Clients SA List</h6>
                                            <p class="text-sm">Marketlab clients SA list</p>
                                        </div>
                                        <div class="ms-md-auto pe-md-3 d-flex align-items-center gap-2">
                                            <!-- Filter Form -->
                                            <form method="GET" action="{{ route('list-client-sa.index') }}"
                                                class="d-flex gap-2">
                                                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                                                    class="form-control form-control-sm">

                                                <input type="text" name="brand" placeholder="Search Brand Name"
                                                    value="{{ request('brand') }}" class="form-control form-control-sm">

                                                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                                <a href="{{ route('list-client-sa.index') }}?status={{ request('status', 1) }}"
                                                    class="btn btn-secondary" id="resetFilter">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                                    </svg>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0" id="clientTableSA">
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
                                                <tr class="client-row-sa"
                                                    data-nama-brand-sa="{{ strtolower($client->nama_brand) }}"
                                                    data-tanggal-aktip-sa="{{ $client->date_in }}"
                                                    data-status-sa="{{ $client->status_layanan }}">
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
                                                        <a href="{{ route('divisi-sa.index', ['client_id' => $client->id]) }}"
                                                            class="btn btn-info text-secondary font-weight-bold text-xs active-client"
                                                            data-bs-toggle="tooltip" data-bs-title="Laporan Bulanan">
                                                            <svg width="20" height="20"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" strokeWidth={1.5}
                                                                stroke="currentColor" className="size-6">
                                                                <path strokeLinecap="round" strokeLinejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                            </svg>
                                                        </a>
                                                        {{-- <a
                                                            href="{{ route('divisi-sa.editProfile', ['client_id' => $client->id]) }}"
                                                            class="btn btn-primary text-secondary font-weight-bold text-xs active-client"
                                                            data-bs-title="Edit instagram">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-instagram"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                                            </svg>
                                                        </a>
                                                        <a href="{{ route('divisi-sa.editProfileTiktok', ['client_id' => $client->id]) }}"
                                                            class="btn btn-primary text-secondary font-weight-bold text-xs active-client"
                                                            data-bs-title="Edit tiktok">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-tiktok"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                                                            </svg>
                                                        </a> --}}
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

    <!-- jQuery (if not already loaded) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Real-time Search & Filter Script -->
    <script>
        $(document).ready(function() {
            function updateRowNumbers() {
                let visibleCount = 1;
                $('#clientTableSA tbody tr').each(function() {
                    if ($(this).is(':visible')) {
                        $(this).find('.row-number').text(visibleCount);
                        visibleCount++;
                    }
                });
            }

            function applyFilterSA() {
                var valueBrandSA = $('#searchClientSA').val().toLowerCase();
                var valueTanggalSA = $('#filterTanggalAktipSA').val();

                $('#clientTableSA tbody tr').each(function() {
                    var row = $(this);
                    var namaBrandSA = row.data('nama-brand-sa');
                    var tanggalAktipSA = row.data('tanggal-aktip-sa');
                    var statusSA = row.data('status-sa');

                    // Always hide if status ≠ 1
                    if (statusSA != 1) {
                        row.hide();
                        return; // skip this row
                    }

                    var showRowSA = true;

                    // Filter Brand Name
                    if (valueBrandSA && namaBrandSA.indexOf(valueBrandSA) === -1) {
                        showRowSA = false;
                    }

                    // Filter tanggal aktip (exact match)
                    if (valueTanggalSA && tanggalAktipSA !== valueTanggalSA) {
                        showRowSA = false;
                    }

                    row.toggle(showRowSA);
                });

                // Update row numbers after filtering
                updateRowNumbers();
            }

            // Apply filter on search and date change
            $('#searchClientSA').on('keyup', applyFilterSA);
            $('#filterTanggalAktipSA').on('change', applyFilterSA);

            // Jalankan filter pertama kali untuk hide yang tidak aktif
            applyFilterSA();
        });

        $(document).on('click', '[data-client-id]', function() {
            var clientId = $(this).data('client-id');
            var modal = $('#editProfileModal');
            var form = modal.find('form');
            var urlUpdate = '/divisi-sa/profile/' + clientId;
            var urlStore = '/divisi-sa/profile/' + clientId;

            // Reset form
            form[0].reset();
            form.find('input[name="_method"]').remove();

            // Ambil data profile via AJAX
            $.get('/divisi-sa/profile/' + clientId + '/json', function(profile) {
                if (profile) {
                    // Isi field
                    form.find('[name="username"]').val(profile.username);
                    form.find('[name="name"]').val(profile.name);
                    form.find('[name="followers"]').val(profile.followers);
                    form.find('[name="following"]').val(profile.following);
                    form.find('[name="bio"]').val(profile.bio);

                    // Set action dan method
                    form.attr('action', urlUpdate);
                    form.prepend('<input type="hidden" name="_method" value="PUT">');

                    // Isi links
                    var linksContainer = form.find('#links-container');
                    linksContainer.html('');
                    if (profile.links && profile.links.length) {
                        profile.links.forEach(function(link, idx) {
                            linksContainer.append(`
                        <div class="mb-2 row">
                            <div class="col-md-5">
                                <textarea class="form-control mb-1" name="links[${idx}][url]" placeholder="URL" required>${link.url}</textarea>
                            </div>
                            <div class="col-md-5">
                                <textarea class="form-control mb-1" name="links[${idx}][name]" placeholder="Nama Link" required>${link.name}</textarea>
                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <button type="button" class="btn btn-danger btn-sm remove-link-btn" title="Hapus Link">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    `);
                        });
                    }
                } else {
                    // Profile belum ada, kosongkan field
                    form.find(
                        '[name="username"],[name="name"],[name="followers"],[name="following"],[name="bio"]'
                        ).val('');
                    form.attr('action', urlStore);
                    // Tidak perlu _method PUT
                }
            });
        });
    </script>
</x-app-layout>