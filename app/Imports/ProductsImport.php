<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'name' => $row['Nazwa produktu'],
            'manufacturer' => $row['Producent'],
            'unit_price' => $row['Jednostka ceny'],
            'weight' => $row['Waga'],
            'diameter' => $row['Średnica'],
            'length' => $row['Długość'],
            'width' => $row['Szerokość'],
            'height' => $row['Wysokość'],
            'thickness' => $row['Grubość'],
            'packaging_type' => $row['Typ pakowania'],
            'purchase_units' => $row['Jednostki zakupu'],
        ]);
    }
}
