<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeTransportation extends Model
{
    use HasFactory;

    protected $table = 'mode_transportation';

    protected $fillable = [
        'title',
        'status'
    ];
}
