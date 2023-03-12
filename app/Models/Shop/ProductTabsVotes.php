<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTabsVotes extends Model
{
    use HasFactory;

    protected $table = 'product_tabs_votes';

    protected $fillable = [
        'product_id',
        'tab_id',
        'title',
        'createdBy',
        'editedBy'
    ];
}
