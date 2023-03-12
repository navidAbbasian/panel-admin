<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected $fillable = [
        'title',
        'parent_id',
        'meta_title',
        'slug',
        'order',
        'new',
        'description',
        'meta_desc',
        'alt',
        'pic_title',
        'off',
        'createdBy',
        'editedBy'
    ];

    public function subcategory()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }
}
