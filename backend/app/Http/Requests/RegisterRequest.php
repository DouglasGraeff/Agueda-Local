<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:user_info,email'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[\d\s\+\-\(\)]+$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type_id' => ['required', 'integer', 'exists:user_types,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.max' => 'O nome não pode ter mais de 255 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser válido',
            'email.unique' => 'Este email já está registado',
            'phone.required' => 'O telefone é obrigatório',
            'phone.max' => 'O telefone não pode ter mais de 20 caracteres',
            'phone.regex' => 'O telefone deve conter apenas números e caracteres válidos',
            'password.required' => 'A palavra-passe é obrigatória',
            'password.min' => 'A palavra-passe deve ter pelo menos 8 caracteres',
            'password.confirmed' => 'As palavras-passe não correspondem',
            'user_type_id.required' => 'O tipo de utilizador é obrigatório',
            'user_type_id.exists' => 'O tipo de utilizador selecionado é inválido',
        ];
    }
}
