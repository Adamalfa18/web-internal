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
                                                    <label for="client_id" class="form-label">Id
                                                        Client</label><!-- Menyimpan nilai client_id -->
                                                    <input type="text" class="form-control" id="client_id"
                                                        name="client_id" placeholder="Target Spant"
                                                        value="{{ $reports->client_id }}" readonly>
                                                    <!-- Menampilkan nilai tanpa bisa diubah -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="target_roas" class="form-label">Target Roas</label>
                                                    <input type="text" class="form-control" name="target_roas"
                                                        id="target_roas" placeholder="Target Roas" required
                                                        value="{{ $reports->target_roas }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="target_spent" class="form-label">Target Spant</label>
                                                    <input type="text" class="form-control" name="target_spent"
                                                        id="target_spent" placeholder="Target Spant" required
                                                        value="{{ $reports->target_spent }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="target_revenue" class="form-label">Target
                                                        Revenue</label>
                                                    <input type="text" class="form-control" name="target_revenue"
                                                        id="target_revenue" placeholder="Target Revenue" required
                                                        value="{{ $reports->target_revenue }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="mb-3">
                                                        <label for="note" class="form-label">Note</label>
                                                        <textarea class="form-control" name="note" id="note"
                                                            placeholder="Note....." rows="3"
                                                            required>{{ $reports->note }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="report_date" class="form-label">Month</label>
                                                    <input type="month" class="form-control" name="report_date"
                                                        id="report_date" required pattern="\d{4}-\d{2}"
                                                        value="{{ $reports->report_date }}">
                                                    <!-- Menambahkan pola untuk format M -->
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

        <script></script>

</x-app-layout>