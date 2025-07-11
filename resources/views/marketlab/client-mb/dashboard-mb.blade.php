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
                                        <p class="text-sm text-secondary mb-1">Active MB Client</p>
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
                                        <p class="text-sm text-secondary mb-1">Inactive MB Client</p>
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

            <div class="col-12 col-md-auto mb-3">
                <form id="filterForm" class="row g-2 align-items-end" method="GET">
                    @csrf
                    <!-- Select Client -->
                    <div class="col-12 col-md-auto">
                        <label for="clientSelect" class="form-label">Select Client MB:</label>
                        <select name="client_id" id="clientSelect" class="form-select" required>
                            <option value="">-- Select Client --</option>
                            @foreach($clientMbAktif as $client)
                            <option value="{{ $client->id }}">{{ $client->nama_brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Select Month -->
                    <div class="col-12 col-md-auto">
                        <label for="grafikDashboardBulan" class="form-label">Select Month:</label>
                        <input type="month" id="grafikDashboardBulan" name="grafikDashboardBulan" class="form-control"
                            required>
                    </div>
                    <!-- Submit Button -->
                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-success w-100">View</button>
                    </div>
                </form>
            </div>

            <div class="row mb-4">
                <div class="card border shadow-xs mb-4 border-client">
                    <div class="card-header border-bottom pb-0 border-client-bottom">
                        <h6 class="font-weight-semibold text-lg mb-0">Spent</h6>
                        <p class="text-sm">Spent this month</p>
                    </div>
                    <div class="card-body">
                        <canvas id="chartSpent" height="100"></canvas>
                    </div>
                </div>
                <div class="card border shadow-xs mb-4 border-client">
                    <div class="card-header border-bottom pb-0 border-client-bottom">
                        <h6 class="font-weight-semibold text-lg mb-0">Revenue</h6>
                        <p class="text-sm">Omzet this month</p>
                    </div>
                    <div class="card-body">
                        <canvas id="chartRevenue" height="100"></canvas>
                    </div>
                </div>
                <div class="card border shadow-xs mb-4 border-client">
                    <div class="card-header border-bottom pb-0 border-client-bottom">
                        <h6 class="font-weight-semibold text-lg mb-0">ROAS</h6>
                        <p class="text-sm">ROAS this month</p>
                    </div>
                    <div class="card-body">
                        <canvas id="chartRoas" height="100"></canvas>
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
                    label: 'Active MB Client',
                    data: @json($mbClientsPerMonth->pluck('active')),
                    backgroundColor: 'rgba(10, 185, 10, 0.8)',
                    borderColor: 'rgb(10, 185, 10)',
                    borderWidth: 1
                },
                {
                    label: 'Client MB Pending',
                    data: @json($mbClientsPerMonth->pluck('pending')),
                    backgroundColor: 'rgba(255, 166, 0, 0.8)',
                    borderColor: 'rgb(255, 166, 0)',
                    borderWidth: 1
                },
                {
                    label: 'Inactive MB Client',
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
                            text: 'Total Clients MB'
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filterForm');

    const chartSpent = new Chart(document.getElementById('chartSpent'), {
        type: 'line',
        data: {
            labels: ['Spent'],
            datasets: [{
                label: 'Spent',
                data: [0],
                backgroundColor: '#4e73df'
            }]
        }
    });

    const chartRevenue = new Chart(document.getElementById('chartRevenue'), {
        type: 'line',
        data: {
            labels: ['Omzet'],
            datasets: [{
                label: 'Omzet',
                data: [0],
                backgroundColor: '#1cc88a'
            }]
        }
    });

    const chartRoas = new Chart(document.getElementById('chartRoas'), {
        type: 'line',
        data: {
            labels: ['ROAS'],
            datasets: [{
                label: 'ROAS',
                data: [0],
                backgroundColor: '#f6c23e'
            }]
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("{{ route('dashboard.mb.chart-data') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();  // Parse response JSON
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            // Update labels dan data masing-masing chart
            chartSpent.data.labels = data.labels;
            chartSpent.data.datasets[0].data = data.spent;
            chartSpent.update();

            chartRevenue.data.labels = data.labels;
            chartRevenue.data.datasets[0].data = data.omzet;
            chartRevenue.update();

            chartRoas.data.labels = data.labels;
            chartRoas.data.datasets[0].data = data.roas;
            chartRoas.update();
        })
        .catch(err => {
            console.error(err);
            alert("Terjadi kesalahan saat memuat data grafik.");
        });
    });
});
    </script>
</x-app-layout>