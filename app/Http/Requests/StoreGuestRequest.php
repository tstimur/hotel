<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'alpha', 'max:255'],
            'last_name' => ['required', 'string', 'alpha', 'max:255'],
            'phone_number' => ['required', 'phone:e164PhoneNumber', 'regex:/^\+?[0-9]{7,15}$/', 'unique:guests,phone_number'],
            'email' => ['email','max:255', 'unique:guests,email'],
            'country' => ['nullable', 'string', 'max:255']
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Имя обязательно для заполнения',
            'first_name.alpha' => 'Имя должно содержать только буквы',
            'last_name.required' => 'Фамилия обязательна для заполнения',
            'last_name.alpha' => 'Фамилия должна содержать только буквы',
            'phone_number.required' => 'Телефон обязателен',
            'phone_number.unique' => 'Этот телефон уже зарегистрирован',
            'phone_number.phone' => 'Телефон должен быть в правильном формате',
            'email.unique' => 'Этот email уже зарегистрирован',
        ];
    }
}
