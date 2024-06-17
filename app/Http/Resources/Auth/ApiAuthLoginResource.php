<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiAuthLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            "userData"=> isset($this->user)?AcountUserResource::make($this->user):null,
            "message"=>$this->message,
            "AccessToken" => $this->access_token??'',
            "refreshToken" => $this->refresh_token??'',
        ];
    }
}
