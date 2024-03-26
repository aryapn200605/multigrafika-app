<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $fillable = [
        'qty', 'unit_price', 'total_price', 'product_id', 'customer_id', 'batch_id'
    ];

    use HasFactory;
}
