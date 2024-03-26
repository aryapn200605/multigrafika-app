@extends('admin.layouts.panel')

@section('title', 'Transaksi')

@section('content-header')
    <div class="input-group date" id="reservationdate" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" />
        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>

@endsection

@section('content')

    <section>
        <div class="d-flex">
            <div class="form-group mr-2">
                <select class="form-control select2-danger" name="status" id="status-dropdown"
                    data-dropdown-css-class="select2-danger" style="width: 20vh;">
                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semuanya</option>
                    <option value="lunas" {{ $status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="belum-lunas" {{ $status == 'belum-lunas' ? 'selected' : '' }}>Belum Lunas</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control select2-danger" name="lunas" id="type-dropdown"
                    data-dropdown-css-class="select2-danger" style="width: 20vh;">
                    <option value="all" {{ $type == 'all' ? 'selected' : '' }}>Semuanya</option>
                    <option value="proses" {{ $type == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $type == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ $type == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="datatable table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="align-middle" style="width: 2%">No</th>
                            <th class="align-middle" style="width: 15%">Tanggal</th>
                            <th class="align-middle" style="width: 15%">Invoice</th>
                            <th class="align-middle" style="width: 10%">Nama Customer</th>
                            <th class="align-middle" style="width: 15%">Sisa Pembayaran</th>
                            <th class="align-middle" style="width: 15%">Total</th>
                            <th class="align-middle" style="width: 20%">Status Pembayaran</th>
                            <th class="align-middle" style="width: 3%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($datas as $data)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $data['batch']->created_at->format('d F Y') }}</td>
                                <td class="align-middle">{{ $data['batch']->invoice }}</td>
                                <td class="align-middle">{{ $data['batch']->name }}</td>
                                <td class="align-middle text-right">Rp. @currency($data['batch']->paid_amount)</td>
                                <td class="align-middle text-right">Rp. @currency($data['total'])</td>
                                <td class="align-middle">
                                    @if ($data['batch']->status == 1)
                                        <span class="badge m-1 bg-success">Lunas</span>
                                    @else
                                        <span class="badge m-1 bg-danger">Belum Lunas</span>
                                    @endif
                                    |
                                    @if ($data['batch']->type == 1)
                                        <span class="badge m-1 bg-warning">Proses</span>
                                    @elseif($data['batch']->type == 2)
                                        <span class="badge m-1 bg-success">Selesai</span>
                                    @elseif($data['batch']->type == 3)
                                        <span class="badge m-1 bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-info btn-trx-info"
                                        data-id="{{ $data['batch']->invoice }}">
                                        <i class="fa fa-info"></i>
                                    </button>
                                    {{-- <button type="button" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    @component('components.modal', [
        'id' => 'modal-info',
    ])
        @slot('title', 'Transaksi')

        @slot('body')
            <input type="hidden" id="trx-id">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Tanggal :</label>
                        <input type="text" class="form-control" id="date" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Invoice :</label>
                        <input type="text" class="form-control" id="invoice" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Customer :</label>
                        <input type="text" class="form-control" id="customer" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>No. Handphone :</label>
                        <input type="text" class="form-control" id="phone" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Total Pembelian :</label>
                        <input type="text" class="form-control" id="total" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Sisa Pembayaran :</label>
                        <input type="text" class="form-control" id="paid" disabled>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Catatan :</label>
                        <textarea id="note" class="form-control" disabled></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="trx-details">
                            <!-- Detail transaksi akan ditampilkan di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        @endslot

        @slot('button')
            <div id="btns"></div>
        @endslot
    @endcomponent

    @component('components.modal', [
        'id' => 'modal-pay',
    ])
        @slot('title', 'Nominal')

        @slot('body')
            <div class="form-group">
                <label id="label">Nominal Pembayaran: (Yang harus dibayarkan = )</label>
                <input type="text" class="form-control" id="nominal">
            </div>
        @endslot

        @slot('button')
            <div class="btn btn-success" id="btn-bayar-sisa">Bayar</div>
        @endslot
    @endcomponent

@endsection

@section('script')
    <script>
        $('#status-dropdown').on('change', function() {
            redirectToTransaction();
        });

        $('#type-dropdown').on('change', function() {
            redirectToTransaction();
        });

        function redirectToTransaction() {
            var statusValue = $('#status-dropdown').val();
            var typeValue = $('#type-dropdown').val();

            var redirectUrl = 'transaction?status=' + encodeURIComponent(statusValue) + '&type=' + encodeURIComponent(
                typeValue);

            window.location.href = redirectUrl;
        }

        $('.btn-trx-info').on('click', function() {
            var batchId = $(this).data('id');

            // Kirim permintaan AJAX untuk mendapatkan data transaksi berdasarkan ID
            $.ajax({
                url: 'transaction/findOne/' + batchId,
                type: 'GET',
                success: function(response) {
                    $('#trx-id').val(response.batch.invoice);
                    $('#date').val(formatToLocalDate(response.batch.created_at));
                    $('#invoice').val(response.batch.invoice);
                    $('#customer').val(response.batch.name);
                    $('#phone').val(response.batch.phone);
                    $('#total').val(response.total);
                    $('#paid').val(response.batch.paid_amount);
                    $('#note').val(response.batch.note);

                    $('#trx-details').empty();

                    var rows = response.trx.map(function(trx) {
                        return '<tr>' +
                            '<td>' + trx.product_name + '</td>' +
                            '<td class="text-center">' + trx.qty + '</td>' +
                            '<td class="text-right">Rp. ' + (trx.unit_price).toLocaleString(
                                'id-ID') + '</td>' +
                            '<td class="text-right">Rp. ' + (trx.total_price).toLocaleString(
                                'id-ID') + '</td>' +
                            '</tr>';
                    });

                    if (response.batch.paid_amount == 0) {
                        $('#btn-pay').prop('disabled', true);
                    } else {
                        $('#btn-pay').prop('disabled', false);
                    }

                    $('#trx-details').html(rows.join(''));

                    var urlPdf = "{{ url('pdf/') }}/" + response.batch.invoice
                    var urlInvoice = "{{ url('admin/transaction/invoice/') }}/" + response.batch.invoice
                    var urlPaid = "{{ url('admin/transaction/paid/') }}/" + response.batch.invoice
                    var btn =
                        `<button onclick="pdf(this)" data-url="${urlPdf}" class="btn btn-warning mr-1">PDF</button>` +
                        `<button onclick="struk(this)" data-url="${urlInvoice}" class="btn btn-info mr-1">Print Struk</button>` +
                        '<button type="button" class="btn btn-danger mr-1" id="btn-batal">Hapus Pesanan</button>';

                    if (response.batch.status != 1) {
                        btn +=
                            `<button type="button" class="btn btn-success mr-1" onclick="paid(this)" data-url="${urlPaid}" id="btn-pay">Lunas</button>`;
                    }

                    if (response.batch.type == 1) {
                        btn +=
                            '<button type="button" class="btn btn-primary mr-1" id="btn-finish">Pesanan Selesai</button>';
                    }

                    $('#btns').html(btn)


                    $('#modal-info').modal('show');
                },
                error: function(err) {
                    console.error(err);
                }
            });
        });

        function paid(button) {
            var url = $(button).data('url');
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin melunaskan pembayaran?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lunaskan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(response) {
                            Swal.fire('Pelunasan Berhasil!', 'Pelunasan telah berhasil dilakukan.', 'success');
                            location.reload()
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Oops...', 'Terjadi kesalahan saat melakukan Pelunasan.', 'error');
                            location.reload()
                        }
                    });
                }
            });
        }

        function pdf(button) {
            var url = $(button).data('url');
            window.open(url, '_blank').focus();
        }

        function struk(button) {
            var url = $(button).data('url');

            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    invoice(data)
                },
                error: function(error) {

                }
            });
        }

        $(document).on('click', '#btn-bayar-sisa', function() {
            const nominalValue = parseFloat($('#nominal').val().replace(/[^0-9.]/g, '')) || 0;

            console.log('Nominal yang dibayar:', nominalValue);

            // Tempatkan logika pengiriman pembayaran AJAX Anda di sini
            // ...

            // Tutup modal pembayaran
            $('#modal-pay').modal('hide');
        });


        $(document).on('click', '#btn-batal', function() {
            Swal.fire({
                title: "Peringatan",
                icon: 'warning',
                text: "Apakah anda yakin untuk menghapus pesanan ini?",
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $('#trx-id').val();
                    $.ajax({
                        url: `transaction/delete/${id}`,
                        method: 'GET',
                        success: function(response) {
                            location.reload();
                            console.log(response);
                        },
                        error: function(error) {
                            console.error(error);
                            location.reload();
                        }
                    });
                }
            });
        });

        $(document).on('click', '#btn-finish', function() {
            Swal.fire({
                title: "Peringatan",
                icon: 'warning',
                text: "Apakah anda yakin menyelesaikan pesanan ini?",
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $('#trx-id').val();
                    $.ajax({
                        url: `transaction/finish/${id}`,
                        method: 'GET',
                        success: function(response) {
                            location.reload();
                            console.log(response);
                        },
                        error: function(error) {
                            console.error(error);
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection
