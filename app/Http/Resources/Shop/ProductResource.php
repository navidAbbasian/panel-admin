<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'meta_title'=>$this->meta_title,
            'meta_desc'=>$this->meta_desc,
            'slug'=>$this->slug,
            'model'=>$this->model,
            'brand'=>$this->brand,
            'description'=>$this->description,
            'tax_class'=>$this->tax_class,
            'categories'=>$this->categories,
            'like'=>$this->like,
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'status'=>$this->status,
            'weight'=>$this->weight,
            'length'=>$this->length,
            'height'=>$this->height,
            'score'=>$this->score,
            'tags'=>$this->tags,
            'option_title'=>$this->option_title,
            'sale'=>$this->sale,
            'view'=>$this->view,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
