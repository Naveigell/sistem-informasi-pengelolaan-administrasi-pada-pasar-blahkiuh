@extends('layouts.app')

@section('content')
    <div class="card-group">
        <div class="card p-2 p-lg-3">
            <div class="p-lg-3 p-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-circle btn-danger text-white btn-lg" href="javascript:void(0)">
                        <i class="fa fa-users"></i>
                    </button>
                    <div class="ml-4" style="width: 38%;">
                        <h4 class="font-light">Total Jumlah Pedagang</h4>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h2 class="display-7 mb-0">{{ $pedagang }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-2 p-lg-3">
            <div class="p-lg-3 p-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-circle btn-warning text-white btn-lg" href="javascript:void(0)">
                        <i class="fas fa-map"></i>
                    </button>
                    <div class="ml-4" style="width: 38%;">
                        <h4 class="font-light">Jumlah Tempat</h4>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h2 class="display-7 mb-0">{{ $tempat }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-2 p-lg-3">
            <div class="p-lg-3 p-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-circle btn-success text-white btn-lg" href="javascript:void(0)">
                        <i class="fas fa-male"></i>
                    </button>
                    <div class="ml-4" style="width: 38%;">
                        <h4 class="font-light">Total Jumlah Admin</h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h2 class="display-7 mb-0">{{ $admin }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <h5 class="card-title text-uppercase">Pengeluaran dan Pemasukan Pada Tahun {{ date('Y') }}</h5>
                        <ul class="list-inline dl mb-0 ml-auto">
                            <li class="list-inline-item text-danger"><i class="fa fa-circle"></i> Pengeluaran</li>
                            <li class="list-inline-item text-info"><i class="fa fa-circle"></i> Pemasukan</li>
                        </ul>
                    </div>

                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];

        const data = {
            labels: @json(array_keys($spending)),
            datasets: [{
                label: 'Pengeluaran',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: {{ json_encode(array_values($spending)) }},
                lineTension: 0.2
            },{
                label: 'Pemasukan',
                backgroundColor: 'rgb(99,187,255)',
                borderColor: 'rgb(99,200,255)',
                data: {{ json_encode(array_values($income)) }},
                lineTension: 0.2
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
    </script>
    <script>
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endpush
