<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('manufacturer');
            $table->integer('total_units')->default(0);
            $table->string('purchase_units_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_units');
    }
}