<?php

namespace App\Http\Requests\Product;

use App\Http\Constants\LanguageConstant;
use App\Http\Constants\ProductConstant;
use App\Http\Constants\SharedConstant;
use App\Http\Controllers\Controller;
use App\Models\Store;
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
        if (Controller::isMerchant()) return true;

        if ($this->isStoreOwner()) return true;

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
            'category_id' => 'required|integer|exists:categories,id',
            'store_id' => 'required|integer|exists:stores,id',
            'status' => 'nullable|integer|in:' . SharedConstant::STATUSES['NOT AVAILABLE'] . ',' . SharedConstant::STATUSES['AVAILABLE'],
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'vat_type' => 'required|integer|in:' . ProductConstant::VAT_TYPES['INCLUDED_IN_PRICE'] . ',' . ProductConstant::VAT_TYPES['CALCULATED_FROM_PRICE'],
            'vat_amount' => 'required_if:vat_type,==,' . ProductConstant::VAT_TYPES['CALCULATED_FROM_PRICE'] . '|regex:/^\d+(\.\d{1,2})?$/',
            'translations' => 'array|required_array_keys:' . LanguageConstant::LOCALES['ENGLISH'] . ',' . LanguageConstant::LOCALES['ARABIC'],
            'translations.*.name' => 'required|string|min:3|max:255',
            'translations.*.description' => 'nullable|string|min:3|max:1000'
        ];
    }

    /**
     * @return mixed
     */
    public function isStoreOwner()
    {
        return Store::whereMerchantId(Auth::id())->whereId($this->get('store_id'))->exists();
    }
}
