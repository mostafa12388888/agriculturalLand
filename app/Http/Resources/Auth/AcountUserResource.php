<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcountUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // "phone"=>$this->phone,
            "userId"=>$this->id,
            "email"=>$this->email,
            "name"=>$this->name,
            "updatedAt"=>$this->updated_at,
            "createdAt"=>$this->created_at,
        ];
    }
}
