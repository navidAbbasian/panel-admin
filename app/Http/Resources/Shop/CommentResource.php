<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'customer_id'=>$this->customer_id,
            'product_id'=>$this->product_id,
            'operator_id'=>$this->operator_id,
            'username'=>$this->username,
            'comment'=>$this->comment,
            'answer'=>$this->answer,
            'goods'=>$this->goods,
            'bads'=>$this->bads,
            'offer'=>$this->offer,
            'status'=>$this->status,
            'like'=>$this->like,
            'dislike'=>$this->dislike,
            'unknown'=>$this->unknown,
            'buyed'=>$this->buyed,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
