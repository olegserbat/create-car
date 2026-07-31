<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStockRequest extends FormRequest
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
            'brend_name' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'number' => 'required|integer|min:1',
            'is_booked' => 'nullable|boolean',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'brend_name.required' => 'Название бренда обязательно для заполнения.',
            'brend_name.max' => 'Название бренда не должно превышать 255 символов.',
            'price.required' => 'Цена обязательна.',
            'price.numeric' => 'Цена должна быть числом.',
            'price.min' => 'Цена не может быть отрицательной.',
            'number.required' => 'Количество обязательно.',
            'number.integer' => 'Количество должно быть целым числом.',
            'number.min' => 'Количество не может быть меньше 1.',
            'is_booked.boolean' => 'Поле "забронировано" должно быть логическим.',
        ];
    }

    protected function prepareForValidation(): void
    {
        //dd($this->all());
    }
}
