<?php

namespace App\Models\Plant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;
    protected $fillable = ['is_default', 'soil_Humidity', "user_id", 'humidity', 'temperature', 'watering', 'image','name'];
}
