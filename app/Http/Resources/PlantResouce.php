<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "soilHumidity"=>$this->soil_Humidity,
            "image"=>$this->image,
            "humidity"=>$this->humidity,
            "temperature"=>$this->temperature,
            "watering"=>$this->watering,
            "createdAt"=>$this->created_at,
            "updatedAt"=>$this->updated_at,
        ];
    }
}
