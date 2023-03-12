<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorWholesale extends Model
{
    use HasFactory;

    protected $table = 'product_colors_wholesale';

    protected $fillable = [
        'product_color_id',
        'price',
        'from',
        'createdBy',
        'editedBy'
    ];
}
