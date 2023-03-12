<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTabReview extends Model
{
    use HasFactory;

    protected $table = 'product_tabs_reviews';

    protected $fillable = [
        'product_id',
        'tab_id',
        'title',
        'description',
        'order',
        'createdBy',
        'editedBy'
    ];
}
