<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPages extends Model
{
    use HasFactory;

    protected $table = 'other_pages';

    protected $fillable = [
        'title',
        'body',
        'createdBy',
        'editedBy'
    ];
}
