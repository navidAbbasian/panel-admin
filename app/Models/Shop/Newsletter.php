<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $table = 'newsletter';

    protected $fillable = [
        'user_mail',
        'createdBy',
        'editedBy'
    ];
}
