<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'product_id',
        'customer_id',
        'operator_id',
        'username',
        'comment',
        'answer',
        'goods',
        'bads',
        'offer',
        'status',
        'like',
        'dislike',
        'unknown',
        'buyed',
        'createdBy',
        'editedBy'
    ];
}
