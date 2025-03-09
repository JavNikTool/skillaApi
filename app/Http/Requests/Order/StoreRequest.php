<?php

declare(strict_types=1);

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'order_type_id' => 'required|exists:order_types,id',
            'partnership_id' => 'required|exists:partnerships,id',
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'address' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Создан,назначен исполнитель,завершен',
        ];
    }

    public function messages(): array
    {
        return [
            'order_type_id.required' => 'Поле тип заказа обязательно для заполнения',
            'order_type_id.exists' => 'Такого типа заказа не существует',
            'partnership_id.required' => 'Поле партнерство обязательно для заполнения',
            'partnership_id.exists' => 'Такого партнерства не существует',
            'user_id.required' => 'Поле пользователь обязательно для заполнения',
            'user_id.exists' => 'Такого пользователя не существует',
            'description.string' => 'Описание должно быть строкой',
            'date.required' => 'Поле дата обязательно для заполнения',
            'date.date' => 'Дата должна быть в формате даты',
            'address.required' => 'Поле адрес обязательно для заполнения',
            'address.string' => 'Адрес должен быть строкой',
            'amount.required' => 'Поле стоимость обязательно для заполнения',
            'amount.numeric' => 'Стоимость должна быть числом',
            'amount.min' => 'Стоимость должна быть не меньше 0',
            'status.required' => 'Поле статус обязательно для заполнения',
            'status.in' => 'Статус должен быть одним из следующих значений: Создан, назначен исполнитель, завершен',
        ];
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
