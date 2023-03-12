<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'product_id'=>$this->product_id,
            'title'=>$this->title,
            'alt'=>$this->alt,
            'pic'=>$this->pic,
            'small'=>$this->small,
            'very_small'=>$this->very_small,
            'order'=>$this->order,
            'color_id'=>$this->color_id,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
