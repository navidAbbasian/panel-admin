<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = 'config';

    protected $fillable = [
        'name',
        'owner',
        'title',
        'keywords',
        'description',
        'gift_bones',
        'ref_bones',
        'address',
        'email',
        'tel',
        'logo',
        'logo_alt',
        'logo_title',
        'aparat',
        'facebook',
        'twitter',
        'telegram',
        'instagram',
        'whatsapp',
        'enamad',
        'reza',
        'membership',
        'banner',
        'banner_link',
        'org_color',
        'org_hover_color',
        'light_color',
        'secound_color',
        'secound_hover_color',
        'specials_status',
        'gift_status',
        'consult_status',
        'fave_icon',
        'freecargo',
        'shipment_price',
        'account_owner',
        'owner_number',
        'createdBy',
        'editedBy'
    ];
}
