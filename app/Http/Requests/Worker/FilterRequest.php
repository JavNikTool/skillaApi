<?php

declare(strict_types=1);

namespace App\Http\Requests\Worker;

use App\Http\Requests\Base\BaseFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'order_type_ids' => 'nullable|array',
            'order_type_ids.*' => 'integer|exists:order_types,id',
        ];
    }

    public function messages(): array
    {
        return [
            'order_type_ids.array' => 'Поле order_type_ids должно быть массивом.',
            'order_type_ids.*.integer' => 'Каждый элемент в order_type_ids должен быть целым числом.',
            'order_type_ids.*.exists' => 'Переданный тип заказа не существуют.',
        ];
    }
}
