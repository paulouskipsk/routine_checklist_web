<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebChecklistItemRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'description' => 'required|string|min:3|max:150',
            'status' => 'required|string|min:1|max:1',
            'sequence' => 'required|integer',
            'score' => 'required|integer',
            'shelflife' => 'required|integer',
            'type' => 'required|string|min:1|max:1',
            'shelflife' => 'integer',
            'type_obs' => ['required', Rule::in(['N', 'O', 'R'])],
            'required_photo' => ['required', Rule::in(['S', 'N'])],
            'quant_photo' => ['integer', Rule::requiredIf('required_photo' == 'S'), 'min:1'],
            'chkl_id' => 'integer',
            'sect_id' => 'integer|nullable',
        ];
    }

    public function messages() {
        return [
            'description.required' => 'Campo é obrigatório.',
            'description.min' => 'Mínimo 3 caracteres.',
            'description.max' => 'Máximo 150 caracteres.',
            'status.required' => 'Campo é obrigatório.',
            'status.min' => 'Permitido apenas 1 caractere.',
            'status.max' => 'Permitido aRequestpenas 1 caractere.',
            'shelflife.*' => 'Tempo de Vida do Checklist é Obrigatório.',
            'frequency.*' => 'Frequencia é Obrigatória',
            'frequency_composition.*' => 'A composição de Frequencia é Obrigatória',
            'chkl_type.required' => 'Campo é obrigatório.',
            'chkl_type.min' => 'Permitido apenas 1 caractere.',
            'chkl_type.max' => 'Permitido apenas 1 caractere.',  
            'required_photo.required' => 'Informar se a foto deve ser Obrigatória',
            'type_obs.required' => 'Informar o comportamento da observação'
        ];
    }
}
