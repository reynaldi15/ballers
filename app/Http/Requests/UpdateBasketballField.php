<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBasketballField extends FormRequest
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
            'title'      => 'sometimes|required',
            'price'      => 'sometimes|required',
            'address'    => 'sometimes|required',
            'desc'       => 'sometimes|required',
            'date'       => 'sometimes|required',
            'start_time' => 'sometimes|required',
            'end_time'   => 'sometimes|required',
        ];
    }
}
