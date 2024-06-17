<?php

namespace App\Http\Controllers\Auth;

use App\Enum\HttpStatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiAuthRequest;
use App\Http\Resources\Auth\ApiAuthLoginResource;
use App\Services\Auth\ApiAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public $apiAuthService;
    public function __construct(ApiAuthService $apiAuthService){

        $this->apiAuthService = $apiAuthService;
    }
    public function login(ApiAuthRequest $request)
    {

        $resource=new ApiAuthLoginResource($this->apiAuthService->login($request->email, $request->password));
        return $this->response($resource, HttpStatusCodeEnum::OK);
    }
    public function logout():JsonResponse
    {
        $resource = new ApiAuthLoginResource($this->apiAuthService->logout());
        return $this->response($resource,HttpStatusCodeEnum::OK);
    }

}
