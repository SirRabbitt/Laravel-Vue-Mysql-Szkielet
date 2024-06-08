<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Product;
use App\Models\PurchaseUnit;
use Illuminate\Support\Facades\DB;

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

            // Tablica do przechowywania sum jednostek zakupu
            $unitsSummary = [];

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
                $purchase_units_number = $data['Jednostki zakupu liczba'] ?? 1; // Domyślna wartość 1
                $purchase_units_type = $data['Jednostki zakupu typ'] ?? 'szt'; // Domyślna wartość "szt"

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
                    'purchase_units_number' => $purchase_units_number,
                    'purchase_units_type' => $purchase_units_type,
                ];

                // Znajdź lub utwórz jednostkę zakupu
                $purchaseUnit = PurchaseUnit::updateOrCreate(
                    [
                        'name' => $name,
                        'manufacturer' => $manufacturer,
                        'purchase_units_type' => $purchase_units_type,
                    ],
                    [
                        'total_units' => DB::raw('total_units + ' . $purchase_units_number)
                    ]
                );

                // Ustaw purchase_unit_id w danych produktu
                $productData['purchase_unit_id'] = $purchaseUnit->id;

                // Znajdź lub utwórz produkt
                $product = Product::updateOrCreate([
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
                    'purchase_units_number' => $purchase_units_number,
                    'purchase_units_type' => $purchase_units_type,
                ], $productData);

                // Wyświetl dane przed dodaniem do bazy danych
                print_r($productData);
            }

            // Zapisz sumowane jednostki zakupu do bazy danych
            foreach ($unitsSummary as $summary) {
                $purchaseUnit = PurchaseUnit::updateOrCreate(
                    [
                        'product_id' => $summary['product_id'],
                        'name' => $summary['name'],
                        'manufacturer' => $summary['manufacturer'],
                        'purchase_units_type' => $summary['purchase_units_type'],
                    ],
                    [
                        'total_units' => $summary['total_units']
                    ]
                );

                // Zaktualizuj pole purchase_unit_id w tabeli products
                Product::where('id', $summary['product_id'])->update(['purchase_unit_id' => $purchaseUnit->id]);
            }
        } else {
            $this->command->error('File not found: ' . $filePath);
        }
    }
}
