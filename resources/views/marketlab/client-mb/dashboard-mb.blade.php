<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 bor
        er-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-4 mb-xl-0">
                    <div class="card card-aktif border shadow-xs mb-4">
                        <div class="style-dasboard card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="style-fount w-100">
                                        <p class="text-sm text-secondary mb-1">Client MB Aktif</p>
                                        <h1 class="mb-2 font-weight-bold">{{ $mb_aktip }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-xl-0">
                    <div class="card card-pending border shadow-xs mb-4">
                        <div class="style-dasboard card-body text-start p-3 w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="style-fount w-100">
                                        <p class="text-sm text-secondary mb-1">Client MB Pending</p>
                                        <h1 class="mb-2 font-weight-bold">{{ $mb_pending }}</h1>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-xl-0">
                    <div class="card card-tidak-aktif border shadow-xs mb-4">
                        <div class="style-dasboard card-body text-start p-3 w-100">

                            <div class="row">
                                <div class="col-12">
                                    <div class="style-fount w-100">
                                        <p class="text-sm text-secondary mb-1">Client MB Tidak Aktif</p>
                                        <h1 class="mb-2 font-weight-bold">{{ $mb_nonaktip }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-style">
                <div class="col-12 card border shadow-xs mb-4 pb-4">
                    <div class="mt-3 mb-3">
                        <h6 class="font-weight-semibold dasboard-style text-lg mb-0">
                            Clients MB Per Month
                        </h6>
                    </div>
                    <div class="col-lg-12">
                        <div>
                            <div class="card-header pb-5">
                            </div>
                            <div class="card-body p-3">
                                <div class="chart mt-n6">
                                    <canvas id="mb-chart" class="chart-canvas" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Tambahkan pustaka Chart.js sebelum script Anda -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Klien MB
        const mbCtx = document.getElementById('mb-chart').getContext('2d');
        const mbData = {
            labels: @json($mbClientsPerMonth->pluck('month')),
            datasets: [{
                    label: 'Klien MB Aktif',
                    data: @json($mbClientsPerMonth->pluck('active')),
                    backgroundColor: 'rgba(10, 185, 10, 0.8)',
                    borderColor: 'rgb(10, 185, 10)',
                    borderWidth: 1
                },
                {
                    label: 'Klien MB Pending',
                    data: @json($mbClientsPerMonth->pluck('pending')),
                    backgroundColor: 'rgba(255, 166, 0, 0.8)',
                    borderColor: 'rgb(255, 166, 0)',
                    borderWidth: 1
                },
                {
                    label: 'Klien MB Tidak Aktif',
                    data: @json($mbClientsPerMonth->pluck('inactive')),
                    backgroundColor: 'rgba(255, 0, 0, 0.8)',
                    borderColor: 'rgb(255, 0, 0)',
                    borderWidth: 1
                }
            ]
        };

        new Chart(mbCtx, {
            type: 'bar',
            data: mbData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Klien MB'
                        },
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
