<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->uuid === $this->route('user');
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', Rule::unique('user_info', 'email')->ignore($this->user()->id)],
            'phone' => ['sometimes', 'string', 'max:20', 'regex:/^[\d\s\+\-\(\)]+$/'],
            'current_password' => ['required_with:password', 'string'],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.max' => 'O nome não pode ter mais de 255 caracteres',
            'email.email' => 'O email deve ser válido',
            'email.unique' => 'Este email já está registado',
            'phone.max' => 'O telefone não pode ter mais de 20 caracteres',
            'phone.regex' => 'O telefone deve conter apenas números e caracteres válidos',
            'current_password.required_with' => 'A palavra-passe atual é obrigatória para alterar a palavra-passe',
            'password.min' => 'A palavra-passe deve ter pelo menos 8 caracteres',
            'password.confirmed' => 'As palavras-passe não correspondem',
        ];
    }
}
