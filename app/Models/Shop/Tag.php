<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'title',
        'slug',
        'meta_desc',
        'meta_title',
        'body',
        'createdBy',
        'editedBy'
    ];
}
