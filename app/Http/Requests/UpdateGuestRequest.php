<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuestRequest extends FormRequest
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
            'first_name.required' => 'Имя обязательно для заполнения',
            'first_name.alpha' => 'Имя должно содержать только буквы',
            'last_name.required' => 'Фамилия обязательна для заполнения',
            'last_name.alpha' => 'Фамилия должна содержать только буквы',
            'phone_number.required' => 'Телефон обязателен',
            'phone_number.unique' => 'Этот телефон уже используется',
            'phone_number.phone' => 'Телефон должен быть в правильном формате',
            'email.unique' => 'Этот email уже используется',
        ];
    }
}
