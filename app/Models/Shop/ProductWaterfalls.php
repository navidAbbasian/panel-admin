<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWaterfalls extends Model
{
    use HasFactory;

    protected $table = 'product_waterfalls';

    protected $fillable = [
        'product_id',
        'title',
        'order',
        'createdBy',
        'editedBy'
    ];
}
