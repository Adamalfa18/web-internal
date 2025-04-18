<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="collapse multi-collapse show" id="multiCollapseExample1">
                        <div class="card card-body">
                            <div class="card border shadow-xs mb-4 border-client">
                                <div class="card-header border-bottom pb-0 border-client-bottom">
                                    <div class="d-sm-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-semibold text-lg mb-0">Data Client</h6>
                                            <p class="text-sm">Berikut Adalah List Client SA</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead class="bg-gray-100">
                                                <tr class="tabel-style">
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        No
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama
                                                        Brand
                                                    </th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Nama Client</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Penanggung Jawab</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Status</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Tanggal Aktip</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="align-middle text-center">
                                                        {{-- Mengubah cara menghitung nomor urut laporan --}}
                                                        <span class="day-style text-sm font-weight-normal">
                                                        </span>
                                                    </td>
                                                    <td class="client-name-style">
                                                        {{-- <div class="d-flex px-2 py-1">
                                                    <div class="d-flex align-items-center">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center ms-1">
                                                        <h6 class="mb-0 text-sm font-weight-semibold">
                                                            {{ $client->nama_brand }}</h6>
                                                        <p class="text-sm text-secondary mb-0">
                                                            {{ $client->email }}
                                                        </p>
                                                    </div>
                                                </div> --}}
                                                    </td>
                                                    <td class="client-name-style">
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                                            {{-- {{ $client->nama_client }}</p> --}}
                                                        <p class="text-sm text-secondary mb-0">
                                                            {{-- {{ $client->telepon_finance }}</p> --}}
                                                    </td>
                                                    <td class="client-name-style">
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                                            {{-- {{ $client->pj }}</p> --}}
                                                        <p class="text-sm text-secondary mb-0">
                                                            {{-- {{ $client->pegawai->nama }}</p> --}}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{-- @switch($client->status_client)
                                                    @case(1)
                                                        <span
                                                            class="badge badge-sm border border-success text-success badge-aktif">Aktif
                                                        </span>
                                                    @break

                                                    @case(2)
                                                        <span
                                                            class="badge badge-sm border border-warning text-warning badge-pending">Pending
                                                        </span>
                                                    @break

                                                    @case(3)
                                                        <span
                                                            class="badge badge-sm border border-danger text-danger badge-paid">Paid
                                                        </span>
                                                    @break
                                                @endswitch --}}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{-- <span class="text-secondary text-sm font-weight-normal">
                                                    {{ $client->date_in }}
                                                </span> --}}
                                                    </td>
                                                    <td class="align-middle">
                                                        {{-- Tampilkan data bulanan --}}
                                                        <a href="{{ route('divisi-sa.index') }}" type="button"
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
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
