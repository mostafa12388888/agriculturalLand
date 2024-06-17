<?php

namespace App\Models\Plant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantUpdate extends Model
{
    use HasFactory;
    protected $fillable = ['is_default', 'soil_Humidity', 'humidity', 'temperature', 'watering', 'user_id'];

}
