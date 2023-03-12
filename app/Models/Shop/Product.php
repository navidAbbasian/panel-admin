<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'meta_title',
        'meta_desc',
        'slug',
        'model',
        'brand',
        'description',
        'tax_class',
        'categories',
        'like',
        'price',
        'quantity',
        'status',
        'weight',
        'length',
        'height',
        'score',
        'tags',
        'option_title',
        'sale',
        'view',
        'video',
        'createdBy',
        'editedBy'
    ];
}
