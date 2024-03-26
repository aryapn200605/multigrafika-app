<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionBatches;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $batches = TransactionBatches::join('customer', 'transaction_batches.customer_id', '=', 'customer.id')
            ->where('type', '!=', 4)
            ->orderBy('status', 'asc');

        $status = $request->query('status');
        $type = $request->query('type');

        if ($status == 'lunas') {
            $batches->where('transaction_batches.status', 1);
        } else if ($status == 'belum-lunas') {
            $batches->where('transaction_batches.status', 0);
        }

        if ($type == 'proses') {
            $batches->where('transaction_batches.type', 1);
        } else if ($type == 'selesai') {
            $batches->where('transaction_batches.type', 2);
        } else if ($type == 'batal') {
            $batches->where('transaction_batches.type', 3);
        }

        $batches = $batches->get();

        $datas = [];

        foreach ($batches as $batch) {
            $transactions = Transaction::where('batch_id', $batch->invoice)->get();

            $total = $transactions->sum('total_price');

            $datas[] = [
                'batch' => $batch,
                'trx'   => $transactions,
                'total' => $total,
            ];
        }

        // dd($datas);

        return view('admin.transactions.index', ['datas' => $datas, 'type' => $type, 'status' => $status]);
    }

    public function findOne(String $id)
    {
        $batch = TransactionBatches::join('customer', 'transaction_batches.customer_id', '=', 'customer.id')
            ->where('transaction_batches.invoice', $id)
            ->first();


        if (!$batch) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        $transactions = Transaction::where('batch_id', $batch->invoice)->get();
        $total = $transactions->sum('total_price');

        $data = [
            'batch' => $batch,
            'trx'   => $transactions,
            'total' => $total,
        ];

        return response()->json($data);
    }

    public function cancellation(String $id)
    {
        $trx = TransactionBatches::where('invoice', $id)->first();

        if ($trx) {
            $trx->type = 3;
            $trx->save();
            return response('Success cancel the transaction', 200);
        } else {
            return response('Transaction not found', 404);
        }
    }

    public function finishOrder(String $id)
    {
        $trx = TransactionBatches::where('invoice', $id)->first();

        if ($trx) {
            $trx->type = 2;
            $trx->save();
            return response('Success finish the transaction', 200);
        } else {
            return response('Transaction not found', 404);
        }
    }

    public function deleteOrder(String $id)
    {
        $trx = TransactionBatches::where('invoice', $id)->first();

        if ($trx) {
            $trx->type = 4;
            $trx->save();
            return response('Success delete the transaction', 200);
        } else {
            return response('Transaction not found', 404);
        }
    }

    public function paid(String $id)
    {
        $trx = TransactionBatches::where('invoice', $id)->first();

        if ($trx) {
            $trx->status = 1;
            $trx->paid_amount = 0;
            $trx->save();
            return response('Success paid the transaction', 200);
        } else {
            return response('Transaction not found', 404);
        }
    }

    public function invoice(String $id)
    {
        $data = TransactionBatches::join('customer', 'transaction_batches.customer_id', '=', 'customer.id')
            ->where('transaction_batches.invoice', $id)
            ->first();
        $transactions = Transaction::where('batch_id', $data->invoice)->get();
        $total = $transactions->sum('total_price');

        $formattedData = [
            "invoice" => $data->invoice,
            "phone" => $data->phone,
            "customer" => $data->name,
            "date" => $data->created_at,
            "payment_method" => $data->payment_method,
            "status" => $data->status == 1 ? "Lunas" : "Belum Lunas",
            "products" => $transactions,
            "total" => $total,
            "paid_amount" => $data->paid_amount,
            "note" => $data->note
        ];

        return $formattedData;
    }

    public function pdf(String $id)
    {
        $data = TransactionBatches::join('customer', 'transaction_batches.customer_id', '=', 'customer.id')
            ->where('transaction_batches.invoice', $id)
            ->first();

        $trx = Transaction::where('batch_id', $data->invoice)->get();
        $total = $trx->sum('total_price');

        // dd(compact('data', 'trx', 'total'));    
        return view('admin.invoices.pdf', compact('data', 'trx', 'total'));

        // return PDF::loadView('invoices.pdf', compact('data', 'trx', 'total'))
        //     ->download('invoice-' . $data->invoice . '.pdf');

        // return PDF::loadView('invoices.pdf', compact('data', 'trx', 'total'))
        //     ->stream('invoice-' . $data->invoice . '.pdf');
    }
}
