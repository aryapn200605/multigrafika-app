<?php

namespace App\Imports;

use App\Models\ProductModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $product = new ProductModel([
                'name' => $row[0], // Sesuaikan dengan kolom A di Excel
                'price' => $row[1], // Sesuaikan dengan kolom B di Excel
                'sellable' => 1, // Tetapkan nilai sellable selalu 1
            ]);

            $product->save();
        }
    }
}