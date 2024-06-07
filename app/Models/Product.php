<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'manufacturer',
        'unit_price',
        'weight',
        'diameter',
        'length',
        'width',
        'height',
        'thickness',
        'packaging_type',
        'purchase_units',
    ];
    
}
