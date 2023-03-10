<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleCategory extends Model
{
    use HasFactory;

    protected $table = 'sale_categories';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'off',
        'createdBy',
        'editedBy'
    ];
}
