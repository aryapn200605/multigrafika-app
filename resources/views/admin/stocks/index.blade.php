@extends('admin.layouts.panel')

@section('title', 'Stok Barang')

@section('content-header')

    <button class="btn btn-primary">Tambah Stok Barang</button>

@endsection

@section('content')

    <section>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped" id="datatable">
                    <thead>
                        <tr class="text-center">
                            <th class="align-middle" style="width: 2%">No</th>
                            <th class="align-middle" style="width: 20%">Nama</th>
                            <th class="align-middle" style="width: 20%">Jumlah Barang</th>
                            <th class="align-middle" style="width: 8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td class="align-middle">1</td>
                            <td class="align-middle">Banner</td>
                            <td class="align-middle">Rp. @currency(20000)</td>
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
