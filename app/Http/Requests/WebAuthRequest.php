<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebAuthRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'login' => 'required|string|min:3|max:20',
            'password' => 'required|string|min:3|max:20',
        ];
    }

    public function messages() {
        return [
            'login.required' => 'Campo é obrigatório.',
            'login.min' => 'Mínimo 3 caracteres.',
            'login.max' => 'Máximo 20 caracteres.',
            'password.required' => 'Campo é obrigatório.',
            'password.min' => 'Mínimo 3 caracteres.',
            'password.max' => 'Máximo 20 caracteres.'
        ];
    }
}
