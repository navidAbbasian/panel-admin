<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersList extends Model
{
    use HasFactory;

    protected $table = 'customers_lists';

    protected $fillable = [
        'customer_id',
        'title',
        'link',
        'description',
        'products',
        'createdBy',
        'editedBy'
    ];
}
