<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\Transaction;
use App\Models\TransactionBatches;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class CashierController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $nextNumber = str_pad(TransactionBatches::count() + 1, 10, '0', STR_PAD_LEFT);
        return view('admin.cashier.index', ['printer' => $user->printer, 'invoices' => 'TRX-24' . $nextNumber]);
    }

    public function transaction(Request $request)
    {
        $request->validate([
            'customerName'      => 'required',
            'invoice'       => 'required',
            'phone'         => 'required',
            'datas'          => 'required',
            'note'          => 'required',
            'deadline'      => 'required',
            'grandTotal'   => 'required',
            'deposits'      => 'required',
            'paidAmount'   => 'required',
            'paymentMethod' => 'required',
        ]);

        $customer = CustomerModel::find($request->customer_id);

        if ($customer) {
            $customer->transaction_total += 1;
            $customer->save();
        } else {
            $customer = new CustomerModel();

            $customer->name = $request->customerName;
            $customer->phone = $request->phone;
            $customer->address = "none";
            $customer->transaction_total = 1;

            $customer->save();
        }

        $batch = new TransactionBatches();

        $batch->invoice = $request->invoice;
        $batch->paid_amount = $request->paidAmount;
        $batch->payment_method = $request->paymentMethod;
        $batch->note = $request->note;
        $batch->deadline = $request->deadline;
        $batch->customer_id = $customer->id;
        $batch->type = 1;

        if ($request->paidAmount == 0) {
            $batch->status = 1;
        } else {
            $batch->status = 0;
        }

        $batch->save();

        foreach ($request->datas as $data) {
            $trx = new Transaction();

            $trx->qty = $data['qty'];
            $trx->unit_price = $data['price'];
            $trx->total_price = $data['total'];
            $trx->product_name = $data['product'];
            $trx->batch_id = $request->invoice;

            $trx->save();
        }

        return response("success: " . $request->invoice, 200);
    }

    public function printReceipt(Request $request)
    {
        $data = [
            'title' => 'Contoh PDF',
            'content' => 'Ini adalah konten PDF.',
        ];

        // Generate PDF dengan ukuran kertas kustom (57mm lebar, 100mm tinggi)
        $pdf = Pdf::loadView('pdf.view', $data)->setPaper([0, 0, 57, 100]);

        // Tampilkan PDF
        return $pdf->stream();
    }
}
