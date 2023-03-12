<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_image';

    protected $fillable = [
        'product_id',
        'title',
        'alt',
        'pic',
        'small',
        'very_small',
        'order',
        'color_id',
        'createdBy',
        'editedBy'
    ];
}
