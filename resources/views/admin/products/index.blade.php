@extends('admin.layouts.panel')

@section('title', 'Produk')

@section('content-header')

    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-create">Tambah Jenis Produk</button>
    <button class="btn btn-success" data-toggle="modal" data-target="#modal-excel">Tambah Excel</button>

@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                <table class="datatable table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="align-middle" style="width: 2%">No</th>
                            <th class="align-middle" style="width: 20%">Nama</th>
                            <th class="align-middle" style="width: 20%">Harga Satuan</th>
                            <th class="align-middle" style="width: 8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($datas as $index => $data)
                            <tr>
                                <td class="align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle">{{ $data->name }}</td>
                                <td class="align-middle">Rp. @currency($data->price)</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <div class="m-2">
                                            <button href="#" class="btn btn-primary edit-product-btn" data-id="{{ $data->id }}">Edit</button>
                                        </div>
                                        <form method="POST" action="{{ route('delete-product', ['product' => $data->id]) }}" class="delete-product m-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @component('components.modal', [
        'id' => 'modal-create',
    ])
        @slot('title', 'Tambah Produk')

        @slot('body')
            <form action="{{ route('create-product') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukan Nama Produk" required>
                </div>
                <div class="form-group">
                    <label>Harga Satuan Produk</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" class="form-control rupiah" data-original-value="0" value="0" name="price"
                            placeholder="Masukan Harga Satuan" required>
                    </div>
                </div>
            @endslot

            @slot('button')
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        @endslot
    @endcomponent

    @component('components.modal', [
        'id' => 'modal-edit',
    ])
        @slot('title', 'Edit Produk')

        @slot('body')
            <form action="" method="post" id="edit-product-form">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama Produk"
                        required>
                </div>
                <div class="form-group">
                    <label>Harga Satuan Produk</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" class="form-control rupiah" data-original-value="" name="price" id="price"
                            placeholder="Masukan Harga Satuan" required>
                    </div>
                </div>
            @endslot

            @slot('button')
                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        @endslot
    @endcomponent
    
    @component('components.modal', [
        'id' => 'modal-excel',
    ])
        @slot('title', 'Tambah Produk Menggunakan Excel')

        @slot('body')
            <form action="{{ route('createExcel') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>File Excel</label>
                    <input type="file" class="form-control-file" name="file" placeholder="Masukan File Produk" required>
                </div>
            @endslot

            @slot('button')
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        @endslot
    @endcomponent

@endsection

@section('script')
    <script>
        $('.delete-product').on('click', function() {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });

        $('.edit-product-btn').on('click', function() {
            var productId = $(this).data('id');
            var editUrl = "{{ route('edit-product', ['product' => ':productId']) }}".replace(':productId',
                productId);
            var updateUrl = "{{ route('update-product', ['product' => ':productId']) }}".replace(':productId',
                productId);

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#edit-product-form').attr('action', updateUrl);
                    $('#name').val(data.name)
                    $('#price').val(data.price)
                    $('#modal-edit').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    </script>
@endsection
