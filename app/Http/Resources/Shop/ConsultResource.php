<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'communication_method'=>$this->communication_method,
            'consult_method'=>$this->consult_method,
            'is_user'=>$this->is_user,
            'user_id'=>$this->user_id,
            'report'=>$this->report,
            'status'=>$this->status,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
