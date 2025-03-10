<?php

declare(strict_types=1);

namespace App\Http\Requests\Order;

use App\Http\Requests\Base\BaseFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AssignWorkerRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'worker_id' => 'required|exists:workers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'worker_id.required' => 'Поле исполнитель обязательно для заполнения',
            'worker_id.exists' => 'Такого исполнителя не существует',
        ];
    }

}
