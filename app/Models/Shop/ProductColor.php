<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_color';

    protected $fillable = [
        'product_id',
        'color_id',
        'category',
        'price',
        'quantity',
        'order',
        'default',
        'off',
        'amazing',
        'gift',
        'package',
        'package_color',
        'package_price',
        'createdBy',
        'editedBy'
    ];
}
