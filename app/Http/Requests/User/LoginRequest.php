<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\Base\BaseFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email является обязательным полем.',
            'email.email' => 'Email должен быть действительным адресом электронной почты.',
            'password.required' => 'Пароль является обязательным полем.',
        ];
    }

}
