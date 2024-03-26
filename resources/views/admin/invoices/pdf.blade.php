<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<section>
    <div class="card card-info">
        <div class="text-center"> <!-- Add text-center class here -->
            <img src="{{ asset('images/logo-apk.png') }}" alt="APK Logo" width="200" style="filter: brightness(150%)"
                class="align-middle mt-2">
        </div>
        <form action="" method="post" class="form-horizontal" id="form-bayar">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row m-0">
                            <label class="col-sm-5 col-form-label" style="font-size: 14px;"><b>Nama</b></label>
                            <div class="col-sm-7">
                                : {{ $data->name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row m-0">
                            <label class="col-sm-5 col-form-label" style="font-size: 14px;"><b>Tanggal</b></label>
                            <div class="col-sm-7">
                                : {{ date($data->created_at) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row m-0">
                            <label class="col-sm-5 col-form-label" style="font-size: 14px;"><b>Sisa Pembayaran</b></label>
                            <div class="col-sm-7">
                                : Rp. {{ $data->paid_amount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row m-0">
                            <label class="col-sm-5 col-form-label" style="font-size: 14px;"><b>No. Invoice</b></label>
                            <div class="col-sm-7">
                                : {{ $data->invoice }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row m-0">
                            <label class="col-sm-5 col-form-label" style="font-size: 14px;"><b>Deadline</b></label>
                            <div class="col-sm-7">
                                : {{ date($data->deadline) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row m-0">
                            <label class="col-sm-5 col-form-label" style="font-size: 14px;"><b>Status</b></label>
                            <div class="col-sm-7">
                                : @if ($data->status == 1)
                                    Lunas
                                @else
                                    Belum Lunas
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row m-0">
                            <label class="col-sm-5 col-form-label" style="font-size: 14px;"><b>No. Handphone</b></label>
                            <div class="col-sm-7">
                                : {{ $data->phone }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row m-0">
                            <label class="col-sm-5 col-form-label" style="font-size: 14px;"><b>Pembayaran</b></label>
                            <div class="col-sm-7">
                                : {{ $data->payment_method }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row m-0">
                            <label class="col-sm-5 col-form-label" style="font-size: 14px;"><b>Catatan</b></label>
                            <div class="col-sm-7">
                                : {{ $data->note }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 2.5%">No</th>
                                    <th style="width: 35%">Produk</th>
                                    <th style="width: 12%">Quantity</th>
                                    <th style="width: 24%">Harga Satuan</th>
                                    <th style="width: 24%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trx as $item)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>@separator($item->qty)</td>
                                        <td class="text-right">Rp. @separator($item->unit_price)</td>
                                        <td class="text-right">Rp. @separator($item->total_price)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="font-weight-bold" colspan="4">Total Harga</td>
                                    <td class="text-right">
                                        Rp. @separator($total)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" colspan="4">DP (Uang Muka)</td>
                                    <td class="text-right">
                                        Rp. @separator($total - $data->paid_amount)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" colspan="4">Sisa Pembayaran</td>
                                    <td class="text-right">
                                        Rp. @separator($data->paid_amount)
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
