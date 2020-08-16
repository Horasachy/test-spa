<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * Class RegisterRequest
 * @package App\Http\Requests\Api\Auth
 */
class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
            'password_confirmation'=> 'required'
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $validator
     */
    public function withValidator($validator)
    {
        $validator->after(function () {
            $this->merge([
                'password' => Hash::make($this->password),
                'password_confirmation' => Hash::make($this->password_confirmation)
            ]);
        });
    }

}
