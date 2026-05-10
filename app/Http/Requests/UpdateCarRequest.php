<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'color_id' => 'required|exists:colors,id',
            'brend_id' => 'required|exists:brends,id',
            'total_price' => 'required|numeric|min:0',
            'comment' => 'nullable|string|max:65535',
        ];
    }

    public function messages(): array
    {
        return [
            'color_id.required' => 'Цвет обязателен для выбора.',
            'color_id.exists' => 'Выбранный цвет не существует.',
            'brend_id.required' => 'Бренд обязателен для выбора.',
            'brend_id.exists' => 'Выбранный бренд не существует.',
            'total_price.required' => 'Цена обязательна.',
            'total_price.numeric' => 'Цена должна быть числом.',
            'total_price.min' => 'Цена не может быть отрицательной.',
            'comment.max' => 'Комментарий слишком длинный.',
        ];
    }
}
