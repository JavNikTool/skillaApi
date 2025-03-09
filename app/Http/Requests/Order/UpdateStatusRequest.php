<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Base\BaseFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:Создан,назначен исполнитель,завершен',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Поле статус обязательно для заполнения',
            'status.in' => 'Статус должен быть одним из следующих значений: Создан, назначен исполнитель, завершен',
        ];
    }
}
