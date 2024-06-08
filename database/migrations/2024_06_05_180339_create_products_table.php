<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('manufacturer');
            $table->string('unit_price')->nullable();
            $table->float('weight')->nullable();
            $table->float('diameter')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->float('thickness')->nullable();
            $table->string('packaging_type')->nullable();
            $table->float('purchase_units_number')->nullable();
            $table->string('purchase_units_type')->nullable();
            $table->unsignedBigInteger('purchase_unit_id')->nullable(); // Dodaj kolumnę purchase_unit_id

           // Ustawienie klucza obcego
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
