<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'number',
        'sales',
        'market',
        'product',
        'off',
        'revenue',
        'createdBy',
        'editedBy'
    ];
}
