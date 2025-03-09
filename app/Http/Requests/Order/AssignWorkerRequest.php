<?php

declare(strict_types=1);

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AssignWorkerRequest extends FormRequest
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
