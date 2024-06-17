<?php

namespace App\Http\Controllers;

use App\Enum\HttpStatusCodeEnum;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * @param  $payload
     * @param int $statusCode
     * @param string|null $message
     * @return JsonResponse
     */
    protected function response($payload, int $statusCode, string $message = null): JsonResponse
    {
        $status = "error";
        if (is_null($message)) {
            switch ($statusCode) {
                case HttpStatusCodeEnum::OK:
                    $status = 'success';
                    break;
                case HttpStatusCodeEnum::CREATED:
                    $status = 'success';
                    $message = trans('common.resource_added_successfully');
                    break;
                case HttpStatusCodeEnum::INTERNAL_SERVER_ERROR:
                    $message = trans('common.something_went_wrong');
                    break;
                case HttpStatusCodeEnum::UNAUTHORIZED:
                    $message = trans('common.unauthorised');
                    break;
                default:
                    $message = null;
                    break;
            }
        }
        $request = Request()->segment(1);
        // has version
        $version = str_contains($request, 'v') ? substr($request, 1) : 1;

        $response = [
            "version" => $version,
            "code" => $statusCode,
            "status" => $status,
            "message" => $message,
            "data" => $payload,

        ];
        return response()->json($response, $statusCode, [], JSON_INVALID_UTF8_IGNORE);
    }
}
