<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'owner'=>$this->owner,
            'title'=>$this->title,
            'keywords'=>$this->keywords,
            'description'=>$this->description,
            'gift_bones'=>$this->gift_bones,
            'ref_bones'=>$this->ref_bones,
            'address'=>$this->address,
            'email'=>$this->email,
            'tel'=>$this->tel,
            'logo'=>$this->logo,
            'logo_alt'=>$this->logo_alt,
            'logo_title'=>$this->logo_title,
            'aparat'=>$this->aparat,
            'facebook'=>$this->facebook,
            'twitter'=>$this->twitter,
            'telegram'=>$this->telegram,
            'instagram'=>$this->instagram,
            'whatsapp'=>$this->whatsapp,
            'enamad'=>$this->enamad,
            'reza'=>$this->reza,
            'membership'=>$this->membership,
            'banner'=>$this->banner,
            'banner_link'=>$this->banner_link,
            'org_color'=>$this->org_color,
            'org_hover_color'=>$this->org_hover_color,
            'light_color'=>$this->light_color,
            'secound_color'=>$this->secound_color,
            'secound_hover_color'=>$this->secound_hover_color,
            'specials_status'=>$this->specials_status,
            'gift_status'=>$this->gift_status,
            'consult_status'=>$this->consult_status,
            'fave_icon'=>$this->fave_icon,
            'freecargo'=>$this->freecargo,
            'shipment_price'=>$this->shipment_price,
            'account_owner'=>$this->account_owner,
            'owner_number'=>$this->owner_number,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
