<?php

namespace App\Http\Requests\Worker;

use App\Http\Requests\Base\BaseFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'phone' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Поле телефон обязательно для заполнения',
            'phone.string' => 'Телефон должен быть строкой',
        ];
    }
}
