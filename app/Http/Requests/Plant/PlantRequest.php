<?php

namespace App\Http\Requests\Plant;

use Illuminate\Foundation\Http\FormRequest;

class PlantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required",
            "image"=>"mimes:png,jpg,jpeg,gif",
            "watering"=>"required|numeric",
            "temperature" => "required|numeric",
            "humidity" => "required|numeric",
            "soilHumidity" => "required|numeric",
        ];
    }
}
