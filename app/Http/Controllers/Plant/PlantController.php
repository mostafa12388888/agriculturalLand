<?php

namespace App\Http\Controllers\Plant;

use App\Enum\HttpStatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Plant\PlantRequest;
use App\Services\Plants\PlantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    protected PlantService $service;
    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct(PlantService $service )
    {
        $this->service=$service;
    }

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index()
    {
        return( $this->service->getPlant());
        return $this->response($this->service->getPlant(),HttpStatusCodeEnum::OK);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(PlantRequest $request): JsonResponse
    {
        return $this->response($this->service->storePlan($request->all()),HttpStatusCodeEnum::OK);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->response($this->service->getPlantById($id),HttpStatusCodeEnum::OK);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return JsonResponse
     */
    public function update(PlantRequest $request,int $id): JsonResponse
    {
        return $this->response($this->service->updatePlan($request->all(),$id),HttpStatusCodeEnum::OK);

    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function delete(int $id):JsonResponse
    {
        return $this->response($this->service->deletePlan($id),HttpStatusCodeEnum::OK);
    }

}
