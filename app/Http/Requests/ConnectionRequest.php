<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnectionRequest extends FormRequest
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
            'username' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'port' => 'required|numeric|min:4',
            'password' =>'required',
            'service_name'=> 'required|string|max:255',
            'wallet'=>'required|string|max:255'
        ];
    }

}
