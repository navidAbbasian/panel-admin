<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    use HasFactory;

    protected $table = 'tax_classes';

    protected $fillable = [
        'title',
        'percent',
        'createdBy',
        'editedBy'
    ];
}
