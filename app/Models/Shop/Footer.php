<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footer';

    protected $fillable = [
      'title',
      'createdBy',
      'editedBy'
    ];

    public function footerItems()
    {
        return $this->hasMany(Footer::class);
    }
}
