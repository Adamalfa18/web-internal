<x-clinet-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.clientnavbar />
        <div class="container-fluid py-4 px-5">

            @foreach ($clients as $client)
                <div class="mt-2 mb-2 row justify-content-center">
                    <div class="col-lg-12 col-12 ">
                        <div class="card info-style" id="basic-info">
                            <div class="card-header">
                                <h5>Hallo {{ $client->nama_brand }}</h5>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-6 col-lg-4">
                                        <label for="name">Client Name</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ $client->nama_client }}" class="form-control" disabled>
                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <label for="email">Email</label>
                                        <input value="{{ $client->email }}" class="form-control" disabled>
                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <label for="email">Phone Number</label>
                                        <input value="{{ $client->telepon_finance }}" class="form-control" disabled>
                                    </div>

                                    <div class="col-6 col-lg-4">
                                        <label for="tanggal_aktif">PIC 1</label>
                                        <input value="{{ $client->pj }}" class="form-control" disabled>
                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <label for="tanggal_berakhir">PIC 2</label>
                                        <input value="{{ $client->pegawai->nama }}" class="form-control" disabled>
                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <label for="status_client">Status Client</label>
                                        <input type="text" name="status_client" id="status_client"
                                            value="@switch($client->status_client)
                                                @case(1) Aktif @break
                                                @case(2) Progres @break
                                                @case(3) Paid @break
                                            @endswitch"
                                            class="form-control" disabled>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <label for="alamat">Address</label>
                                        <textarea name="alamat" id="alamat" rows="3" class="form-control" disabled>{{ $client->alamat }}</textarea>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="informasi_tambahan">Note</label>
                                        <textarea name="informasi_tambahan" id="informasi_tambahan" rows="3" class="form-control" disabled>{{ $client->informasi_tambahan }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card info-style mb-3">
                    <div class="pt-3 card-body">
                        <div class="row">
                            @php
                                $jumlahLayanan = $client->layanans->count();
                                $colClass = 'col-4'; // default

                                if ($jumlahLayanan == 1) {
                                    $colClass = 'col-12';
                                } elseif ($jumlahLayanan == 2) {
                                    $colClass = 'col-6';
                                }
                            @endphp

                            @foreach ($client->layanans as $layanan)
                                @if ($client->status_client == 1)
                                    <div class="{{ $colClass }} style-client-index">
                                        <a class="col-12 btn btn-outline-primary style-client-a"
                                            href="{{ route('data-client.laporan-bulanan', ['client_id' => encrypt($client->id), 'layanan' => encrypt($layanan->nama_layanan)]) }}">
                                            <div class="info-style info-btn-style">
                                                Monthly Report {{ $layanan->nama_layanan }}
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </main>
</x-clinet-layout>
