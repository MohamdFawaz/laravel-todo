<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response as IlluminateResponse;


/**
 * Class Request.
 */
abstract class Request extends FormRequest
{
    /**
     * @var string
     */
    protected $error = '';

    protected function failedAuthorization()
    {

        return response()->json(['This action is unauthorized.'],403);
    }




    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $validations = [];

        $errors = collect($validator->errors());

        foreach ($errors as $field => $error){
            $validations['errors'][$field][] = [
                'error' => reset($error)
            ];
        }

        throw new HttpResponseException(response(
            $validations,
            IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }

}
