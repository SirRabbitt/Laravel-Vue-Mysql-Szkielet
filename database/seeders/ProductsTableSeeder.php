<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $filePath = storage_path('app/products.xlsx');

        if (file_exists($filePath)) {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Pomijamy pierwszy wiersz, ponieważ zawiera nagłówki
            $headers = array_shift($rows);

            foreach ($rows as $row) {
                $data = array_combine($headers, $row);

                // Przypisanie danych do zmiennych
                $name = $data['Nazwa produktu'];
                $manufacturer = $data['Producent'];
                $unit_price = $data['Jednostka ceny'] ?? null;
                $weight = $data['Waga'] ?? null;
                $diameter = $data['Średnica'] ?? null;
                $length = $data['Długość'] ?? null;
                $width = $data['Szerokość'] ?? null;
                $height = $data['Wysokość'] ?? null;
                $thickness = $data['Grubość'] ?? null;
                $packaging_type = $data['Typ pakowania'] ?? null;
                $purchase_units_nuber = $data['Jednostki zakupu liczba'] ?? null;
                $purchase_units_type = $data['Jednostki zakupu typ'] ?? null;

                
                // Przygotowanie danych do zapisu
                $productData = [
                    'name' => $name,
                    'manufacturer' => $manufacturer,
                    'unit_price' => $unit_price,
                    'weight' => $weight,
                    'diameter' => $diameter,
                    'length' => $length,
                    'width' => $width,
                    'height' => $height,
                    'thickness' => $thickness,
                    'packaging_type' => $packaging_type,
                    'purchase_units_nuber' => $purchase_units_nuber,
                    'purchase_units_type' => $purchase_units_type,
                ];

                // Wyświetl dane przed dodaniem do bazy danych
                print_r($productData);

                // Dodaj wpis do bazy danych
                Product::create($productData);
            }
        } else {
            $this->command->error('File not found: ' . $filePath);
        }
    }
}
