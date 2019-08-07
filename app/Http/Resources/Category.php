<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{

    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image
        ];
    }

    public function with($request)
    {
        return [
            'version' => '9.9.9.9',
            'by' => 'Vũ Xuân Quý'
        ];
    }
}
