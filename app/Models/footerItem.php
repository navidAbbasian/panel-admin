<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class footerItem extends Model
{
    use HasFactory;



    protected $fillable = [
        'title',
        'footer_id',
        'link',
        'createdBy',
        'editedBy'
    ];

    public function footers()
    {
        return $this->belongsTo(Footer::class);
    }
}
