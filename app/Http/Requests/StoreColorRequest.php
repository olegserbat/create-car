<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
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
            'name' => 'sometimes | required | max:20 | unique:colors',
            'price' => 'sometimes | required | decimal:2',
            'payment' => 'sometimes | required',
        ];
    }

    protected function prepareForValidation(): void
    {
        if($this->price) {
            $this->merge([
                'price' => str_replace(',', '.', $this->price),
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя цвета должно быть заполнено',
            'name.max' => 'Максисмальное имя не должно быть более 20 знаков',
            'name.unique' => 'Такое имя цвета уже заведено.
                Попробуйте новое имя или обновите информацию по данному имени в режиме обновления данных',
            'price.required' => 'Цена должна быть проставлена',
            'price.decimal' => 'Цена должна быть указана только цифрами c точкой в разделении копеек и двумя знаками после точки'
        ];
    }

}
