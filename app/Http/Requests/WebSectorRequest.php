<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebSectorRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'description' => 'required|string|min:3|max:50',
            'status' => 'required|string|min:1|max:1',
        ];
    }

    public function messages() {
        return [
            'description.required' => 'Campo é obrigatório.',
            'description.min' => 'Mínimo 3 caracteres.',
            'description.max' => 'Máximo 50 caracteres.',
            'status.required' => 'Campo é obrigatório.',
            'status.min' => 'Permitido apenas 1 caractere.',
            'status.max' => 'Permitido apenas 1 caractere.'
        ];
    }
}
