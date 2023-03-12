<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $table = 'product_option';

    protected $fillable = [
        'product_id',
        'title',
        'different',
        'type',
        'order',
        'description',
        'prepaid',
        'opposite',
        'createdBy',
        'editedBy'
    ];
}
