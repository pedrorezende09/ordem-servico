<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'cpf' => 'required|size:11|unique:clientes,cpf',
            'telefone' => 'nullable|min:10|max:15',
            'email' => 'nullable|email',
            'endereco' => 'nullable|max:255'
        ];
    }


    public function messages(): array 
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve ter 11 números',
            'cpf.unique' => 'Este CPF já está cadastrado.',

            'email.email' => 'Informe um email válido.',
        ];
    }
}
