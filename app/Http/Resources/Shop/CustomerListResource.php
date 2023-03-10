<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerListResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'customer_id'=>$this->customer_id,
            'link'=>$this->link,
            'description'=>$this->description,
            'products'=>$this->products,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
