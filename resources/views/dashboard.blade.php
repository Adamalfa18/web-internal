<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.marketlab.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-4 mb-xl-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-aktif border shadow-xs mb-4">
                                <div class="style-dasboard card-body text-start p-3 w-100">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="style-fount w-100">
                                                <p class="text-sm text-secondary mb-1">Client Aktif</p>
                                                <h1 class="mb-2 font-weight-bold">{{ $aktip }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-tidak-aktif border shadow-xs mb-4">
                                <div class="style-dasboard card-body text-start p-3 w-100">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="style-fount w-100">
                                                <p class="text-sm text-secondary mb-1">Tidak Aktif</p>
                                                <h1 class="mb-2 font-weight-bold">{{ $nonaktip }}</h1>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-xl-0">
                    <div class="row">
                        <div class="col-12">
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
                        <div class="col-12">
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
                </div>

                <div class="col-4 mb-xl-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-aktif border shadow-xs mb-4">
                                <div class="style-dasboard card-body text-start p-3 w-100">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="style-fount w-100">
                                                <p class="text-sm text-secondary mb-1">Client SA Aktif</p>
                                                <h1 class="mb-2 font-weight-bold">{{ $sa_aktip }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-tidak-aktif border shadow-xs mb-4">
                                <div class="style-dasboard card-body text-start p-3 w-100">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="style-fount w-100">
                                                <p class="text-sm text-secondary mb-1">Client SA Tidak Aktif</p>
                                                <h1 class="mb-2 font-weight-bold">{{ $sa_nonaktip }}</h1>

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
                <div class="col-12 card border shadow-xs mb-4 pb-4">
                    <div class="mt-3 mb-3">
                        <h6 class="font-weight-semibold dasboard-style text-lg mb-0">
                            Clients Per Month
                        </h6>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="combined-chart" class="chart-canvas" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const combinedCtx = document.getElementById('combined-chart').getContext('2d');

        const combinedData = {
            labels: @json($clientsPerMonth->pluck('month')),
            datasets: [{
                    label: 'Klien Aktif',
                    data: @json($clientsPerMonth->pluck('active')),
                    backgroundColor: 'rgba(10, 185, 10, 0.8)',
                    borderColor: 'rgb(10, 185, 10)',
                    borderWidth: 1
                },
                {
                    label: 'Klien Tidak Aktif',
                    data: @json($clientsPerMonth->pluck('inactive')),
                    backgroundColor: 'rgba(255, 0, 0, 0.8)',
                    borderColor: 'rgb(255, 0, 0)',
                    borderWidth: 1
                },
                {
                    label: 'Klien MB Aktif',
                    data: @json($mbClientsPerMonth->pluck('active')),
                    backgroundColor: 'rgba(10, 185, 150, 0.8)',
                    borderColor: 'rgb(10, 185, 150)',
                    borderWidth: 1
                },
                {
                    label: 'Klien MB Tidak Aktif',
                    data: @json($mbClientsPerMonth->pluck('inactive')),
                    backgroundColor: 'rgba(200, 0, 0, 0.8)',
                    borderColor: 'rgb(200, 0, 0)',
                    borderWidth: 1
                },
                {
                    label: 'Klien SA Aktif',
                    data: @json($saClientsPerMonth->pluck('active')),
                    backgroundColor: 'rgba(0, 185, 255, 0.8)',
                    borderColor: 'rgb(0, 185, 255)',
                    borderWidth: 1
                },
                {
                    label: 'Klien SA Tidak Aktif',
                    data: @json($saClientsPerMonth->pluck('inactive')),
                    backgroundColor: 'rgba(0, 0, 150, 0.8)',
                    borderColor: 'rgb(0, 0, 150)',
                    borderWidth: 1
                }
            ]
        };

        const combinedChart = new Chart(combinedCtx, {
            type: 'bar',
            data: combinedData,
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    },
                    legend: {
                        position: 'top'
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Klien'
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
