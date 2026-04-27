<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClienteRequest extends FormRequest
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
            'nome' => 'required|min:3|max:255',

            'cpf' => [
                'required',
                'size:11',
                Rule::unique('clientes', 'cpf')->ignore($this->cliente->id),
            ],

            'telefone' => 'nullable|min:10|max:15',
            'email' => 'nullable|email',
            'endereco' => 'nullable|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.unique' => 'Este CPF já está cadastrado para outro cliente.',
        ];
    }
}
