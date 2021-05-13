<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'document' => ['string', 'required'],
            'document_type' => ['string', 'required'],
            'full_name' => ['string', 'required'],
            'display_name' => ['string', 'required'],
            'phone' => ['string'],
            'password' => ['string', 'required'],
            'email' => ['email', 'unique:clients,id', 'required']
        ];
    }
}
