@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
    <div class="row">
        <!-- Total Laporan Masuk -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Laporan Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_reports }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-inbox fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Laporan Ditolak -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Laporan Ditolak
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_rejected }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Laporan Diterima -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Laporan Diterima
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_accepted }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik Laporan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Statistik Laporan</h6>
        </div>
        <div class="card-body">
            <canvas id="reportChart"></canvas>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($recent_activities as $activity)
                        <li class="list-group-item">
                            {{ $activity->description }}
                            <span class="badge badge-info">{{ $activity->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('reportChart').getContext('2d');
        var reportChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Masuk', 'Diterima', 'Ditolak'],
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: [{{ $total_reports }}, {{ $total_accepted }}, {{ $total_rejected }}],
                    backgroundColor: ['#4e73df', '#1cc88a', '#e74a3b'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
@endsection
