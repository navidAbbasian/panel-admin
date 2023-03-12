<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTab extends Model
{
    use HasFactory;

    protected $table = 'product_tabs';

    protected $fillable =[
        'product_id',
        'title',
        'type',
        'order',
        'description',
        'collation_id',
        'comment_id',
        'createdBy',
        'editedBy'
    ];
}
