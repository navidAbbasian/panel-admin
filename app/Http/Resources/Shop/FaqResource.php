<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'customer_id'=>$this->customer_id,
            'product_id'=>$this->product_id,
            'operator_id'=>$this->operator_id,
            'question_id'=>$this->question_id,
            'user_name'=>$this->user_name,
            'user_mail'=>$this->user_mail,
            'question'=>$this->question,
            'fake'=>$this->fake,
            'like'=>$this->like,
            'dislike'=>$this->dislike,
            'notice'=>$this->notice,
            'status'=>$this->status,
            'answer'=>$this->answer,
            'question_date'=>$this->question_date,
            'answer_date'=>$this->answer_date,
            'unknown'=>$this->unknown,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
