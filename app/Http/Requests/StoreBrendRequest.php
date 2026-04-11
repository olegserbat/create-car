<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrendRequest extends FormRequest
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
            'name' => 'sometimes | required | max:30 | unique:App\Models\Brend,name',
            'comment' => 'sometimes | nullable | max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Такой бренд уже существует',
            'name.required' => 'Поле не может быть пустым',
            'name.max' => 'Поле не может быть больше 30 символов',
            'comment.max' => 'Поле не может быть больше 255 символов',
        ];
    }
}
