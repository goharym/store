<?php

namespace App\Http\Requests\Category;

use App\Http\Constants\LanguageConstant;
use App\Http\Constants\UserConstant;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CreateRequest extends FormRequest
{


    /**
     * override failedValidation method.
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            $errors = $validator->errors();
            $response = Response::clientError(Response::formatErrors($errors));
        }
        throw new HttpResponseException($response);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Controller::isAdmin()) return true;

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'status' => 'nullable|integer|in:0,1',
            'translations' => 'array|required_array_keys:' . LanguageConstant::LOCALES['ENGLISH'] . ',' . LanguageConstant::LOCALES['ARABIC'],
            'translations.*.name' => 'required|string|min:3|max:255'
        ];
    }
}
