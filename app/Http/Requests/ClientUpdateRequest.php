<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'document' => ['string'],
            'document_type' => ['string'],
            'full_name' => ['string'],
            'display_name' => ['string'],
            'phone' => ['string'],
            'password' => ['string'],
            'email' => ['email', 'unique:clients,id']
        ];
    }
}
