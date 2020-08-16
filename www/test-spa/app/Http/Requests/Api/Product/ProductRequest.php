<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductRequest
 * @package App\Http\Requests\Api\Product
 */
class ProductRequest extends FormRequest
{
    /**
     * @var null
     */
    public $validator = null;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:200|unique:products',
            'description' => 'required|string|max:1000',
            'cost'  => 'required|integer|max:9999999999',
            'count' => 'required|integer|max:9999999999',
            'external_id' => 'required|integer|max:9999999999|unique:products'
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
