<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    protected $table = 'carousels';

    protected $fillable = [
        'title',
        'order',
        'type',
        'category_id',
        'createdBy',
        'editedBy'
    ];
}
