<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\Transaction;
use App\Models\TransactionBatches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total_order = TransactionBatches::where('type', '1')->count();
        $customer = CustomerModel::count();

        $total_paid = TransactionBatches::where('type', '!=', '3')->where('type', '!=', '4')->sum('paid_amount');
        $total_omzet = DB::table('transaction as t')
            ->join('transaction_batches as tb', 't.batch_id', '=', 'tb.invoice')
            ->where('tb.type', '!=', 3)
            ->where('tb.type', '!=', 4)
            ->sum('t.total_price');

        $unpaid = TransactionBatches::where('type', 1)
            ->join('customer', 'transaction_batches.customer_id', '=', 'customer.id')
            ->orderby('deadline')->get();

        $datas = [
            'total_order'   => $total_order,
            'customer'      => $customer,
            'omzet'         => $total_omzet - $total_paid,
            'unpaid'        => $unpaid
        ];

        return view('admin.dashboards.index', compact('datas'));
    }
}
