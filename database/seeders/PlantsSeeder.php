<?php

namespace Database\Seeders;

use App\Models\Plant\Plant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plants = [
            [
                "is_default" => true,
                "name" => "Rice",
                "image" => "agricultural/PlantsImage/1.jpg",
                "temperature" => 12,
                "soil_humidity" => 54,
                "humidity" => 32,
                "watering" => 32,
            ],
            [
                "is_default" => true,
                "name" => "Wheat",
                "image" => "agricultural/PlantsImage/4.jpg",
                "temperature" => 43,
                "soil_humidity" => 77,
                "humidity" => 65,
                "watering" => 12,
            ],
            [
                "is_default" => true,
                "name" => "Cotton",
                "image" => "agricultural/PlantsImage/2.jpg",
                "temperature" => 32,
                "soil_humidity" => 65,
                "humidity" => 32,
                "watering" => 12,
            ],
            [
                "is_default" => true,
                "name" => "Corn",
                "image" => "agricultural/PlantsImage/3.jpg",
                "temperature" => 12,
                "soil_humidity" => 23,
                "humidity" => 32,
                "watering" => 32,
            ],
        ];

        Plant::insert($plants);
    }
}
