<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductColorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'product_id'=>$this->product_id,
            'color_id'=>$this->color_id,
            'category'=>$this->category,
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'order'=>$this->order,
            'default'=>$this->default,
            'off'=>$this->off,
            'amazing'=>$this->amazing,
            'gift'=>$this->gift,
            'package'=>$this->package,
            'package_color'=>$this->package_color,
            'package_price'=>$this->package_price,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
