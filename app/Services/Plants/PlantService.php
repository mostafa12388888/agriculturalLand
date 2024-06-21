<?php
namespace App\Services\Plants;

use App\Exceptions\CanDeleteDefaultPlantException;
use App\Exceptions\CanNotDefined;
use App\Models\Plant;
use App\Models\Plant\Plant as PlantPlant;
use App\Repositories\Plants\PlantRepository;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class PlantService
{
    public function getPlant():mixed
    {

        $plant=PlantPlant::where("user_id",null)->orWhere("user_id",Auth::guard("api")->id())->get();

        return $plant;
    }
    public function storePlan(array $plantData):mixed
    {
        $image = isset($plantData["image"]) ? UploadImage($plantData["image"], "PlantsImage", "logo") : NULL;
        $plant=PlantPlant::create([
            "name"=>$plantData["name"],
            "user_id"=>auth()->user()->id,
            "image"=> $image,
            "watering"=>$plantData["watering"],
            "temperature"=>$plantData["temperature"],
            "humidity"=>$plantData["humidity"],
            "soil_Humidity"=>$plantData["soilHumidity"],
        ]);
        return $plant;
    }
    public function updatePlan(array $plantData,int $id):mixed
    {
        $plant=PlantPlant::find($id);
        if(!($plant)){
            return CanNotDefined::class;
        }
        $image=$plant->image;
        if (isset($plantData["image"])) {
            $image = UploadImage($plantData["image"], "PlantsImage", "logo");
        }
       $plantNew= PlantPlant::create([
             "name"=>$plantData["name"],
             "plant_id"=> $plant,
            "user_id"=>auth()->user()->id,
            "image"=> $image,
            "watering"=>$plantData["watering"],
            "temperature"=>$plantData["temperature"],
            "humidity"=>$plantData["humidity"],
            "soil_Humidity"=>$plantData["soilHumidity"],
            ]);
        return $plantNew;
    }


    public function getPlantByUserId(int $id):mixed
    {
        $plant=PlantPlant::where("user_id",$id)->get();
        return $plant;
    }

    public function getPlantById(int $id):mixed
    {
        $plant = PlantPlant::find($id)->get();
        if(!($plant))
            return CanNotDefined::class;

        return $plant;
    }
    public function deletePlan(int $id): mixed
    {
        $plant = PlantPlant::find($id);
        if(!$plant)
        return CanNotDefined::class;

        if ($plant->user_id != auth()->user()->id)
        return CanDeleteDefaultPlantException::class;
        $plant->delete();
        deleteImage("PlantsImage/" . $plant->image, "logo");

        return $plant;
    }

}
