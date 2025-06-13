<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardCardRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'board_category_id' => 'required',
        ];

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'O nome da categoria é obrigatório',
            'board_category_id.required' => 'A categoria é obrigatória'
        ];
    }
}
