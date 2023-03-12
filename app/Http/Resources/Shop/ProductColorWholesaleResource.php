<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductColorWholesaleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'product_color_id'=>$this->product_color_id,
            'price'=>$this->price,
            'from'=>$this->from,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
