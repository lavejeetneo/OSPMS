<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StorUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required',
            'age' => 'required',
            'aadhar_num' => 'required',
            'idproof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required',
            'state' => 'required',
            'phone_num' => 'required',
            'supplier_city' => 'required',
            'password' => ['required', Rules\Password::defaults()],
        ];
    }
}
