<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTabProperty extends Model
{
    use HasFactory;

    protected $table = 'product_tab_property';

    protected $fillable = [
        'title',
        'product_id',
        'tab_id',
        'description',
        'order',
        'createdBy',
        'editedBy'
    ];
}
