@extends('admin.layouts.panel')

@section('title', 'Dashboard')

@section('content-header')

@endsection

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pesanan</span>
                    <span class="info-box-number">
                        @currency($datas['total_order'])

                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Customer</span>
                    <span class="info-box-number">@currency($datas['customer'])</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-solid fa-sack-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Omzet</span>
                    <span class="info-box-number">@currency($datas['omzet'])</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        {{-- <div class="clearfix hidden-md-up"></div> --}}

        {{-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-solid fa-money-bill"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Omzet</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div> --}}
        <!-- /.col -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pesanan Belum Lunas</h5>
                </div>
                <div class="card-body">
                    <table class="datatable table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th class="align-middle" style="width: 2%">No</th>
                                <th class="align-middle" style="width: 15%">Tanggal</th>
                                <th class="align-middle" style="width: 15%">Invoice</th>
                                <th class="align-middle" style="width: 10%">Nama Customer</th>
                                <th class="align-middle" style="width: 15%">Sisa Pembayaran</th>
                                <th class="align-middle" style="width: 20%">Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas['unpaid'] as $data)
                                <tr class="text-center">
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $data->created_at }}</td>
                                    <td class="align-middle">{{ $data->invoice }}</td>
                                    <td class="align-middle">{{ $data->name }}</td>
                                    <td class="align-middle">{{ $data->paid_amount }}</td>
                                    <td class="align-middle">{{ $data->payment_method}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pesanan Dalam Proses</h5>
                </div>
                <div class="card-body">
                    <table class="datatable table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th class="align-middle" style="width: 2%">No</th>
                                <th class="align-middle" style="width: 15%">Tanggal</th>
                                <th class="align-middle" style="width: 15%">Invoice</th>
                                <th class="align-middle" style="width: 10%">Nama Customer</th>
                                <th class="align-middle" style="width: 15%">Sisa Pembayaran</th>
                                <th class="align-middle" style="width: 20%">Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas['unpaid'] as $data)
                                <tr class="text-center">
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $data->created_at }}</td>
                                    <td class="align-middle">{{ $data->invoice }}</td>
                                    <td class="align-middle">{{ $data->name }}</td>
                                    <td class="align-middle">{{ $data->paid_amount }}</td>
                                    <td class="align-middle">{{ $data->payment_method}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('script')
    <script></script>
@endsection
