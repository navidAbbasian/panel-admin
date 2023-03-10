<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    use HasFactory;

    protected $table = 'consult';

    protected $fillable = [
        'name',
        'communication_method',
        'consult_method',
        'is_user',
        'user_id',
        'report',
        'status',
        'editedBy',
        'createdBy'
    ];
}
