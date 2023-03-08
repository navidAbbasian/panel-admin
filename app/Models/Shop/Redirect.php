<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;

    protected $table = 'redirects' ;

    protected $fillable = [
        'from_url',
        'to_url',
        'createdBy',
        'editedBy'
    ];
}
