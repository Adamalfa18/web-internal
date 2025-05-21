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
                                        <p class="text-sm text-secondary mb-1">Client Aktif</p>
                                        <h1 class="mb-2 font-weight-bold">{{ $aktip }}</h1>
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
                                        <p class="text-sm text-secondary mb-1">Client Pending</p>
                                        <h1 class="mb-2 font-weight-bold">{{ $pending }}</h1>

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
                                        <p class="text-sm text-secondary mb-1">Client Tidak Aktif</p>
                                        <h1 class="mb-2 font-weight-bold">{{ $nonaktip }}</h1>

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
                            Clients Per Month
                        </h6>
                    </div>
                    <div class="col-lg-12">
                        <div>
                            <div class="card-header pb-5">

                            </div>
                            <div class="card-body p-3">
                                <div class="chart mt-n6">
                                    <canvas id="clients-chart" class="chart-canvas" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('clients-chart').getContext('2d');

        // Array nama bulan
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        const clientsData = {
            labels: @json($clientsPerMonth->pluck('month')), // Menggunakan nama bulan dan tahun yang sudah diproses
            datasets: [{
                    label: 'Client Aktif',
                    data: @json($clientsPerMonth->pluck('active')),
                    backgroundColor: 'rgb(10, 185, 10, 0.8)',
                    borderColor: 'rgb(10, 185, 10)',
                    borderWidth: 1
                },
                {
                    label: 'Client Pending',
                    data: @json($clientsPerMonth->pluck('pending')),
                    backgroundColor: 'rgb(255, 166, 0, 0.8)',
                    borderColor: 'rgb(255, 166, 0)',
                    borderWidth: 1
                },
                {
                    label: 'Client Tidak Aktif',
                    data: @json($clientsPerMonth->pluck('inactive')),
                    backgroundColor: 'rgb(255, 0, 0,0.8)',
                    borderColor: 'rgb(255, 0, 0)',
                    borderWidth: 1
                }
            ]
        };

        const clientsChart = new Chart(ctx, {
            type: 'bar',
            data: clientsData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0, // Mengatur nilai minimum sumbu Y menjadi 1
                        title: {
                            display: true,
                            text: 'Total Clients' // Menambahkan label untuk sumbu Y
                        },
                        ticks: {
                            // Mengatur agar hanya menampilkan angka bulat
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,

                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>