<?php

namespace App\Http\Requests;

use App\Enums\Frequency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebChecklistRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'description' => 'required|string|min:3|max:150',
            'status' => 'required|string|min:1|max:1',
            'shelflife' => 'required|integer',
            'frequency' => 'required|string|min:1|max:1',
            'chkl_type' => 'required|string|min:1|max:1',
            'frequency_composition' =>[
                Rule::requiredIf(in_array($this->frequency, [Frequency::WEEKLY->value, Frequency::MONTHLY->value])), 
                'array'
            ],
        ];
    }

    public function messages() {
        return [
            'description.required' => 'Campo é obrigatório.',
            'description.min' => 'Mínimo 3 caracteres.',
            'description.max' => 'Máximo 150 caracteres.',
            'status.required' => 'Campo é obrigatório.',
            'status.min' => 'Permitido apenas 1 caractere.',
            'status.max' => 'Permitido apenas 1 caractere.',
            'shelflife.*' => 'Tempo de Vida do Checklist é Obrigatório.',
            'frequency.*' => 'Frequencia é Obrigatória',
            'frequency_composition.*' => 'A composição de Frequencia é Obrigatória',
            'chkl_type.required' => 'Campo é obrigatório.',
            'chkl_type.min' => 'Permitido apenas 1 caractere.',
            'chkl_type.max' => 'Permitido apenas 1 caractere.',            
        ];
    }
}
