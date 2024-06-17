<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCodeEnum;
use Exception;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    /**
     * @param $request
     * @param Exception|Throwable $e
     * @return \Illuminate\Http\Response|JsonResponse|Response
     * @throws Throwable
     */
    public function render($request, Exception|Throwable $e): \Illuminate\Http\Response|JsonResponse|Response
    {
        if ($request->is('api/*')) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(
                    [
                        'status' => "error",
                        'message' => trans('validation.messages.entity_not_found'), 'code' => HttpStatusCodeEnum::NOT_FOUND],
                    HttpStatusCodeEnum::NOT_FOUND
                );
            } elseif ($e instanceof EntityNotFoundException) {
                return response()->json(
                    [
                        'status' => "error",
                        'message' => trans('validation.messages.entity_not_found'),
                        'code' => HttpStatusCodeEnum::NOT_FOUND],
                    HttpStatusCodeEnum::NOT_FOUND
                );
            } elseif ($e instanceof ValidationException) {
                return response()->json(
                    [
                        'status' => "error",
                        'message' => $e->validator->errors()->first(),
                        'errors' => $e->errors(),
                        'code' => HttpStatusCodeEnum::UNPROCESSABLE_ENTITY
                    ],
                    HttpStatusCodeEnum::UNPROCESSABLE_ENTITY
                );
            } elseif ($e instanceof IApplicationException) {
                return response()->json(
                    [
                        'status' => "error",
                        'message' => $e->getMessage(),
                        'code' => $e->getCode(),
                        'errors' => []
                    ],
                    HttpStatusCodeEnum::UNPROCESSABLE_ENTITY
                );
            } else {
                if (!config('app.debug')) {
                    return response()->json(['message' => 'internal server error', 'code' => HttpStatusCodeEnum::INTERNAL_SERVER_ERROR], HttpStatusCodeEnum::INTERNAL_SERVER_ERROR);
                }
            }
            return parent::render($request, $e);
        }
        return parent::render($request, $e);
    }
}
