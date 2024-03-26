<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ststus 0 = Belum Lunas
 *        1 = Lunas
 * 
 * type 1 = Pending
 *      2 = Finish
 *      3 = Canseled
 * 
 * 
 */
class TransactionBatches extends Model
{
    protected $table = 'transaction_batches';

    protected $fillable = [
        'invoice', 'paid_amount', 'payment_method', 'deadline', 'type', 'status'
    ];

    use HasFactory;
}
