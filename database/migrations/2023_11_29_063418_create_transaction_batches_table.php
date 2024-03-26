<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_batches', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->string('paid_amount');
            $table->string('payment_method');
            $table->string('deadline');
            $table->string('customer_id');
            $table->string('note');
            $table->integer('type'); // Type Pemasukan / Pengeluaran
            $table->integer('status'); // Status Lunas / Belum Lunas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_batches');
    }
};
