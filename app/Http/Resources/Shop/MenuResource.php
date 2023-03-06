<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{

    public function toArray($request)
    {
        return [
          'id'=>$this->id,
          'title'=>$this->title,
          'url'=>$this->url,
          'status'=>$this->status,
          "order"=>$this->order,
          'createdBy'=>$this->createdBy,
          'editedBy'=>$this->editedBy,
          'created_at' => $this->created_at->format('d/m/Y'),
          'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
