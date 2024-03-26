@extends('admin.layouts.panel')

@section('title', 'Printer Setting')

@section('content-header')

@endsection

@section('content')

<h1>List of Printers</h1>
<ul id="printerList"></ul>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (navigator && navigator.printer) {
            navigator.printer.getPrinters().then(function (printers) {
                var printerList = document.getElementById('printerList');
                printers.forEach(function (printer) {
                    var listItem = document.createElement('li');
                    listItem.textContent = printer.name;
                    printerList.appendChild(listItem);
                });
            }).catch(function (error) {
                console.error('Error fetching printer list:', error);
            });
        } else {
            console.error('Navigator printer API not supported.');
        }
    });
</script>

@endsection

@section('script')
    <script></script>
@endsection
