@extends('admin.layouts.panel')

@section('title', 'Pelanggan')

@section('content-header')
    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-create">Tambah Customer</button>
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
                            <th class="align-middle" style="width: 20%">No. Handphone</th>
                            <th class="align-middle" style="width: 40%">Alamat</th>
                            <th class="align-middle" style="width: 10%">Total Transaksi</th>
                            <th class="align-middle" style="width: 8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($datas as $index => $data)
                            <tr>
                                <td class="align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle">{{ $data->name }}</td>
                                <td class="align-middle">{{ $data->phone }}</td>
                                <td class="align-middle text-nowrap overflow-hidden">
                                    @shortenText($data->address)
                                </td>
                                <td class="align-middle">{{ $data->transaction_total }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <div class="m-2">
                                            <button href="#" class="btn btn-primary edit-customer-btn"
                                                data-id="{{ $data->id }}">Edit</button>
                                        </div>
                                        <form method="POST"
                                            action="{{ route('delete-customer', ['customer' => $data->id]) }}"
                                            class="delete-customer m-2">
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
        @slot('title', 'Tambah Customer')

        @slot('body')
            <form action="{{ route('create-customer') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukan Nama" required>
                </div>
                <div class="form-group">
                    <label>No. Handphone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Masukan No.Handphone" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control" id="" rows="5" required></textarea>
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
        @slot('title', 'Edit Customer')

        @slot('body')
            <form action="" method="post" id="edit-customer-form">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama" required>
                </div>
                <div class="form-group">
                    <label>No. Handphone</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Masukan No.Handphone" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control" id="address" rows="5" required></textarea>
                </div>
            @endslot

            @slot('button')
                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        @endslot
    @endcomponent


@endsection

@section('script')
    <script>
        $('.delete-customer').on('click', function() {
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

        $('.edit-customer-btn').on('click', function() {
            var customer_id = $(this).data('id');
            var editUrl = "{{ route('edit-customer', ['customer' => ':customer_id']) }}".replace(':customer_id',
                customer_id);
            var updateUrl = "{{ route('update-customer', ['customer' => ':customer_id']) }}".replace(':customer_id',
                customer_id);

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#edit-customer-form').attr('action', updateUrl);
                    $('#name').val(data.name)
                    $('#phone').val(data.phone)
                    $('#address').val(data.address)
                    $('#modal-edit').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    </script>
@endsection
