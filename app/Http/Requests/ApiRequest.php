<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function Laravel\Prompts\error;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Validation\ValidationException;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   abstract public function authorize();


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        $errors =  (new ValidationException($validator))->errors();

        if(!empty($errors)){
            $transformErrors = [];
            foreach($errors as $filed=>$messages)
            $transformErrors[]=[

                $filed => $messages[0]
            ];
        }
        throw new HttpResponseException(
        response()->json([
            'status' => 'error',
            'code'=> JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            'message'=>"Something went wrong",
            'errors' => $transformErrors
        ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY),

        );

    }

}
