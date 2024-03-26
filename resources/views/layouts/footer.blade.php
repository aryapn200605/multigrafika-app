<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('lte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
<!-- DataTables  & Plugins -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.6.0/js/dataTables.autoFill.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/keytable/2.11.0/js/dataTables.keyTable.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.4.1/js/dataTables.rowGroup.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.3.0/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.6.0/js/dataTables.searchBuilder.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.2.0/js/dataTables.searchPanes.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/staterestore/1.3.0/js/dataTables.stateRestore.min.js">
</script>
<!-- SweetAlert2 -->
<script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
{{-- PRINTER --}}
<script src="https://cdn.jsdelivr.net/npm/recta/dist/recta.js"></script>

@if (session('success'))
    <script>
        toastr.success('{{ session('success') }}');
    </script>
@endif

@if (session('info'))
    <script>
        toastr.info('{{ session('info') }}');
    </script>
@endif

@if (session('error'))
    <script>
        toastr.error('{{ session('error') }}');
    </script>
@endif

@if (session('warning'))
    <script>
        toastr.warning('{{ session('warning') }}');
    </script>
@endif

<script>
    var printer = new Recta('8257655463', '1811')

    const logout = () => {
        Swal.fire({
            title: 'Ingin logout dari sistem?',
            showCancelButton: true,
            confirmButtonText: 'Logout',
            cancelButtonText: 'Batal',
            icon: 'warning'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('logout') }}",
                    type: 'GET'
                }).then(() => {
                    window.location.href = '/login'
                })
            }
        })
    }

    function formatToLocalDate(utcDate) {
        const dateObject = new Date(utcDate);

        const localDate = dateObject.toLocaleString();

        return localDate;
    }

    function invoice(datas) {
        const {
            invoice,
            phone,
            customer,
            date,
            payment_method,
            status,
            products,
            total,
            paid_amount,
            note
        } = datas;

        console.log(datas);

        printer.open().then(function() {
            printer.reset();

            printer.align("CENTER").bold(true).text("Multigrafika\n");
            printer.align("LEFT").bold(true).raw("Kode Order: ").bold(false).text(invoice);
            printer.align("LEFT").bold(true).raw("No. Handphone: ").bold(false).text(phone);
            printer.align("LEFT").bold(true).raw("Customer: ").bold(false).text(customer);
            printer.align("LEFT").bold(true).raw("Tanggal: ").bold(false).text(formatToLocalDate(date));
            printer.align("LEFT").bold(true).raw("Metode Pembayaran: ").bold(false).text(payment_method);
            printer.align("LEFT").bold(true).raw("Status: ").bold(false).text(status + "\n");

            printer.align("CENTER").text("-------------------------------");
            printer.bold(true).text("Produk");
            printer.align("CENTER").text("-------------------------------");

            products.forEach(product => {
                printer.align("LEFT").bold(true).text(product.product_name);
                printer.align("RIGHT").bold(false).text(
                    `@${product.qty} x ${product.unit_price} = ${product.total_price}`);
            });

            printer.align("CENTER").text("-------------------------------");
            printer.align("LEFT").bold(true).text(`Total: ${total}`);
            printer.align("LEFT").bold(true).text(`Sisa Pembayaran: ${paid_amount}`);
            printer.align("LEFT").bold(true).text(`Catatan:`);
            printer.align("LEFT").bold(false).text(note);
            printer.align("CENTER").text("-------------------------------");

            printer.align("CENTER").text("\nTerimakasih");
            printer.align("CENTER").text("Selamat Berbelanja Kembali");

            printer.cut();
            printer.print();
        });
    }


    $(document).ready(function() {
        $('.select2').select2()

        new DataTable('.datatable');

        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        $(".rupiah").on("input", function() {
            var sanitizedValue = $(this).val().replace(/[^0-9]/g, '');
            var numericValue = parseInt(sanitizedValue, 10);
            $(this).attr('data-original-value', isNaN(numericValue) ? 0 : numericValue);
            if (numericValue > 1000000000000) {
                numericValue = 1000000000000;
            }
            var rupiahFormat = numericValue.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&.');
            $(this).val(rupiahFormat);
        });

        var today = new Date().toISOString().split('T')[0];
        $('.datepicker').attr('min', today);

        function updateTanggalJam() {
            var now = new Date();

            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            var formattedDate = now.toLocaleDateString('id-ID', options);

            var formattedTime = now.toLocaleTimeString();

            var dateTimeString = formattedDate + ' ' + formattedTime;

            $('.tgl-input').val(dateTimeString);
        }

        updateTanggalJam();

        setInterval(updateTanggalJam, 1000);
    });
</script>
