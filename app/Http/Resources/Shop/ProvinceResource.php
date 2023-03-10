<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'send_price'=>$this->send_price,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
