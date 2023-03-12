<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductOptionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'product_id'=>$this->product_id,
            'title'=>$this->title,
            'different'=>$this->different,
            'type'=>$this->type,
            'order'=>$this->order,
            'description'=>$this->description,
            'prepaid'=>$this->prepaid,
            'opposite'=>$this->opposite,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
