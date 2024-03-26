@extends('admin.layouts.panel')

@section('title', 'Buku Besar')

@section('content-header')

@endsection

@section('content')

    <section>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped" id="datatable">
                    <thead>
                        <tr class="text-center">
                            <th class="align-middle" style="width: 2%">No</th>
                            <th class="align-middle" style="width: 15%">Tanggal</th>
                            <th class="align-middle" style="width: 15%">Invoice</th>
                            <th class="align-middle" style="width: 15%">Nama Customer</th>
                            <th class="align-middle" style="width: 25%">Produk</th>
                            <th class="align-middle" style="width: 10%">Total</th>
                            <th class="align-middle" style="width: 5%">Status Pembayaran</th>
                            <th class="align-middle" style="width: 8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td class="align-middle">1</td>
                            <td class="align-middle">10 November 2023</td>
                            <td class="align-middle">TRX-192801937812</td>
                            <td class="align-middle">Andi S</td>
                            <td class="align-middle">Banner 1x1m Tipe A</td>
                            <td class="align-middle">Rp. @currency(200000)</td>
                            <td class="align-middle">
                                @if (1 == 1)
                                <span class="badge bg-success">Lunas</span>
                                @else
                                <span class="badge bg-danger">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="#">Detail</a>
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script></script>
@endsection
