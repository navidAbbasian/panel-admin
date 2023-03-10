<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'customer_id',
        'product_id',
        'operator_id',
        'question_id',
        'user_name',
        'user_mail',
        'question',
        'fake',
        'like',
        'dislike',
        'notice',
        'status',
        'answer',
        'question_date',
        'answer_date',
        'unknown',
        'createdBy',
        'editedBy'
    ];
}
