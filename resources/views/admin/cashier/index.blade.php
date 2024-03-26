@extends('admin.layouts.panel')

@section('title', 'Kasir')

@section('content-header')
    <button class="btn btn-primary" onclick="location.reload()">Reset</button>
@endsection

@section('content')

    <section>
        <div class="card card-info">
            <form action="" method="post" class="form-horizontal" id="form-bayar">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control tgl-input" name="date"
                                        placeholder="Tanggal" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="input-group col-sm-9 ">
                                    <input type="hidden" id="customer-id"name="customer_id" value="">
                                    <input type="text" class="form-control" name="customer" id="name-input"
                                        placeholder="Nama Lengkap">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger find-customer-btn">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. Invoice</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="invoice" placeholder="No. Invoice"
                                        value="{{ $invoices }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. Handphone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone" id="phone-input"
                                        placeholder="No. handphone">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 2.5%">No</th>
                                        <th style="width: 35%">Produk</th>
                                        <th style="width: 12%">Quantity</th>
                                        <th style="width: 24%">Harga Satuan</th>
                                        <th style="width: 24%">Total</th>
                                        <th style="width: 2.5%">Label</th>
                                    </tr>
                                </thead>
                                <tbody id="table-product">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="align-middle font-weight-bold" colspan="4">Total Harga</td>
                                        <td colspan="2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control form-control-sm text-right"
                                                    name="grand_total" id="grand-total" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle font-weight-bold" colspan="4">DP (Uang Muka)</td>
                                        <td colspan="2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control form-control-sm text-right"
                                                    name="deposits" id="deposits">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle font-weight-bold" colspan="4">Sisa Pembayaran</td>
                                        <td colspan="2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control form-control-sm text-right"
                                                    name="paid_amount" id="paid-amount" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-2">
                            <p class="lead">Status Pembayaran:</p>
                            <button type="button" class="btn btn-danger" id="payment-status">Belum Lunas</button>
                        </div> --}}
                        <div class="col-3">
                            <p class="lead">Metode Pembayaran:</p>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary payment" id="cash">Cash</button>
                                <button type="button" class="btn btn-outline-secondary payment"
                                    id="transfer">Transfer</button>
                            </div>
                            <input type="hidden" id="payment-method" name="payment_method" value="cash">
                        </div>
                        <div class="col-3">
                            <p class="lead">Deadline</p>
                            <input type="date" class="form-control datepicker" name="deadline">
                        </div>
                        <div class="col-6">
                            <p class="lead">Catatan</p>
                            <textarea class="form-control" rows="1" name="note" placeholder="Catatan ..." id="note"></textarea>
                        </div>
                        <div class="col-12 mt-2 ">
                            <button type="submit" class="btn btn-success float-right" id="btn-bayar"><i
                                    class="far fa-credit-card"></i>
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>

    @component('components.modal', [
        'id' => 'modal-customer',
    ])
        @slot('title', 'Cari Customer')

        @slot('body')
            <table class="datatable table table-bordered table-striped mt-2" id="datatable">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle" style="width: 2%">No</th>
                        <th class="align-middle" style="width: 30%">Nama</th>
                        <th class="align-middle" style="width: 30%">No. Handphone</th>
                        <th class="align-middle" style="width: 30%">Alamat</th>
                        <th class="align-middle" style="width: 8%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="customer-table-body">
                </tbody>
            </table>
        @endslot
    @endcomponent
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            var datas = [{
                id: 1,
                product: "",
                qty: 1,
                price: 0,
                total: 0
            }];

            var ids = 1;

            function swal(icon, title, text) {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text
                })
            }

            function loadRows() {
                var html = '';

                for (let i = 0; i < datas.length; i++) {
                    html += '<tr>' +
                        '<td class="align-middle text-center">' + datas[i].id + '</td>' +
                        '<td><input type="text" class="form-control form-control-sm" name="product[]" id="product-' +
                        datas[i].id +
                        '" value="' + datas[i].product + '"></td>' +
                        '<td><input type="text" class="form-control form-control-sm text-center" name="qty[]" id="qty-' +
                        datas[i].id +
                        '" value="' + datas[i].qty + '"></td>' +
                        '<td><div class="input-group input-group-sm"><div class="input-group-prepend"><span class="input-group-text">Rp.</span></div><input type="text" class="form-control form-control-sm text-right" name="price[]" id="price-' +
                        datas[i].id +
                        '" value="' + datas[i].price + '"></div></td>' +
                        '<td><div class="input-group input-group-sm"><div class="input-group-prepend"><span class="input-group-text">Rp.</span></div><input type="text" class="form-control form-control-sm text-right" name="total[]" id="total-' +
                        datas[i].id +
                        '" value="' + datas[i].total + '"></div></td>' +
                        '<td>';

                    if (i === datas.length - 1) {
                        html += '<button type="button" class="btn btn-primary btn-block btn-plus" data-id="' +
                            datas[i].id + '">' +
                            '<i class="fa fa-plus"></i>' +
                            '</button>';
                    } else {
                        html += '<button type="button" class="btn btn-danger btn-block btn-trash" data-id="' +
                            datas[i].id + '">' +
                            '<i class="fa fa-trash"></i>' +
                            '</button>';
                    }

                    html += '</td>' +
                        '</tr>';
                }
                $('#table-product').html(html);
                updateGrandTotal()
            }

            function updatePaidAmount() {
                const deposits = remove($('#deposits').val());
                const grandTotal = remove($('#grand-total').val());
                const paidAmount = add(grandTotal - deposits);
                $('#paid-amount').val(paidAmount);
            }

            function updateGrandTotal() {
                let grandTotal = 0;

                for (let i = 0; i < datas.length; i++) {
                    grandTotal += parseFloat(datas[i].total);
                }

                $('#grand-total').val(add(grandTotal));
                updatePaidAmount()
            }

            function add(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            function remove(str) {
                return str.replace(/,/g, '');
            }

            loadRows();

            $('input[type="text"], input[type="number"]').on('click', function() {
                $(this).select();
            });

            $('#table-product').on('click', '.btn-plus', function() {
                ids += 1
                datas.push({
                    id: ids,
                    product: "",
                    qty: 1,
                    price: 0,
                    total: 0
                })
                loadRows()
            });

            $('#table-product').on('click', '.btn-trash', function() {
                const id = $(this).data('id');
                const index = datas.findIndex(item => item.id === id);
                datas.splice(index, 1);
                loadRows()
            });

            $('#table-product').on('input', 'input[name^="product"]', function() {
                const id = $(this).attr('id').split('-')[1];
                const value = $(this).val();

                const dataIndex = datas.findIndex(item => item.id == id);
                if (dataIndex !== -1) {
                    datas[dataIndex].product = value;
                }
            });

            $('#table-product').on('input', 'input[name^="qty"]', function() {
                const id = $(this).attr('id').split('-')[1];
                const qtyInput = $(this);
                let qtyValue = parseFloat(qtyInput.val());

                if (qtyValue < 1 || isNaN(qtyValue)) {
                    qtyValue = 1;
                    qtyInput.val(qtyValue);
                }

                const priceInput = $('#price-' + id);
                const priceValue = remove(priceInput.val());

                const totalInput = $('#total-' + id);
                const newTotal = qtyValue * priceValue;

                totalInput.val(newTotal);

                const dataIndex = datas.findIndex(item => item.id == id);
                if (dataIndex !== -1) {
                    datas[dataIndex].qty = qtyValue;
                    datas[dataIndex].total = newTotal;
                }

                updateGrandTotal()
            });

            $('#table-product').on('input', 'input[name^="price"]', function() {
                const id = $(this).attr('id').split('-')[1];
                const priceInput = $(this);
                const priceValue = priceInput.val();

                const qtyInput = $('#qty-' + id);
                const qtyValue = parseFloat(qtyInput.val());

                const totalInput = $('#total-' + id);
                const newTotal = qtyValue * priceValue;

                totalInput.val(newTotal);

                const dataIndex = datas.findIndex(item => item.id == id);
                if (dataIndex !== -1) {
                    datas[dataIndex].price = parseFloat(priceValue);
                    datas[dataIndex].total = newTotal;
                }

                updateGrandTotal()
            });

            $('#table-product').on('input', 'input[name^="total"]', function() {
                const id = $(this).attr('id').split('-')[1];
                const totalInput = $(this);
                const totalValue = totalInput.val();

                const qtyInput = $('#qty-' + id);
                const qtyValue = parseFloat(qtyInput.val());

                let newPrice = 0;
                if (qtyValue !== 0) {
                    newPrice = totalValue / qtyValue;
                }

                const priceInput = $('#price-' + id);
                priceInput.val(newPrice);

                const dataIndex = datas.findIndex(item => item.id == id);
                if (dataIndex !== -1) {
                    datas[dataIndex].total = totalValue;
                    datas[dataIndex].price = newPrice;
                }

                updateGrandTotal()
            });

            $('#deposits').on('input', function() {
                const grandTotal = remove($('#grand-total').val());
                let deposits = remove($('#deposits').val());
                deposits = Math.max(0, Math.min(deposits, grandTotal));
                $('#deposits').val(add(deposits));
                updatePaidAmount();
            });

            $('.payment').on('click', function() {
                $('.payment').removeClass('active');
                $(this).addClass('active');
                $('#payment-method').val($(this).attr('id'));
                $('.payment').removeClass('btn-primary').addClass('btn-outline-secondary');
                $(this).removeClass('btn-outline-secondary').addClass('btn-primary');
            });

            $('#form-bayar').on('submit', function(event) {
                event.preventDefault();

                var allValues = {};

                allValues.date = new Date();
                allValues.customerId = $(this).find('input[name="customer_id"]').val();
                allValues.customerName = $(this).find('input[name="customer"]').val();
                allValues.invoice = $(this).find('input[name="invoice"]').val();
                allValues.phone = $(this).find('input[name="phone"]').val();
                allValues.datas = datas;
                allValues.grandTotal = remove($(this).find('input[name="grand_total"]').val());
                allValues.deposits = remove($(this).find('input[name="deposits"]').val());
                allValues.paidAmount = remove($(this).find('input[name="paid_amount"]').val());
                allValues.paymentMethod = $(this).find('input[name="payment_method"]').val();
                allValues.deadline = $(this).find('input[name="deadline"]').val();
                allValues.note = $(this).find('textarea[name="note"]').val();
                console.log('All Values:', allValues);

                if (allValues.customerName === '') {
                    swal("warning", "Peringatan", "Nama Customer belum diisi!")
                    return;
                }

                if (allValues.phone === '') {
                    swal("warning", "Peringatan", "Nomor Telepon belum diisi!")
                    return;
                }

                if (allValues.deadline === '') {
                    swal("warning", "Peringatan", "Deadline belum diisi!")
                    return;
                }

                if (allValues.note === '') {
                    swal("warning", "Peringatan", "Catatan belum diisi")
                    return;
                }

                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Apakah Anda akan melanjutkan pembayaran ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        performAjaxRequest();
                    } else {
                        console.log('Pembayaran dibatalkan');
                    }
                });

                function performAjaxRequest() {
                    $.ajax({
                        url: '{{ route('transaction') }}',
                        method: 'POST',
                        data: allValues,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: "Order berhasil di inputkan",
                        showCancelButton: true,
                        confirmButtonText: 'Print Struk',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            printstruk(allValues.invoice);
                        } else {
                            location.reload()
                        }
                    })
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Order tidak dapat di inputkan"
                        })
                    }
                    });
                }

            });
        });

        function printstruk(id) {
            var url = "{{ url('admin/transaction/invoice/') }}/" + id

            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    swalstruk(id)
                    invoice(data)
                },
                error: function(error) {

                }
            });
        }

        function swalstruk(id) {
            Swal.fire({
                icon: "success",
                title: "Sukses",
                text: "Berhasil Print Struk",
                showCancelButton: true,
                confirmButtonText: 'Print Struk',
            }).then((result) => {
                if (result.isConfirmed) {
                    printstruk(id);
                } else {
                    location.reload()
                }
            })
        }

        $('.find-customer-btn').on('click', function() {
            url = "{{ route('findAllCustomer') }}"

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    var html = '';
                    $.each(data, function(index, customer) {
                        html += '<tr>' +
                            '<td class="align-middle">' + (index + 1) + '</td>' +
                            '<td class="align-middle">' + customer.name + '</td>' +
                            '<td class="align-middle">' + customer.phone + '</td>' +
                            '<td class="align-middle">' + customer.address + '</td>' +
                            '<td class="align-middle">' +
                            '<button type="button" class="btn btn-success" onclick="selectCustomer(' +
                            customer.id + ', \'' + customer.name + '\', \'' + customer.phone +
                            '\')">Pilih</button>' +
                            '</td>' +
                            '</tr>';
                    });

                    $('#customer-table-body').html(html);

                    $('#modal-customer').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        function selectCustomer(customerId, customerName, customerPhone) {
            $('#modal-customer').modal('hide');
            $('#customer-id').val(customerId);
            $('#name-input').val(customerName);
            $('#phone-input').val(customerPhone);
        }
    </script>
@endsection
