<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsletterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user_mail'=>$this->user_mail,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
