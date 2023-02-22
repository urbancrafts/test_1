<?php

namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
   
class Reviews extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer,
            'comment' => $this->review,
            'star' => $this->star
        ];
    }
}
