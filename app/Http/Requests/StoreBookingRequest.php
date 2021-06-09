<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'consumer_name' => 'required',
            'consumer_state' => 'required',
            'consumer_city' => 'required',
            'supplier_id' => 'required',
            'consumer_gender' => 'required',
            'consumer_age' => 'required',
            'consumer_aadhar_num' => 'required',
            'consumer_idproof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_covid_poritive' => 'required',
            'covid_positive_date' => 'exclude_if:is_covid_poritive,false|required|date',
            'consumer_address' => 'required',
            'consumer_phone_num' => 'required',
            'book_oxygen_cylinder' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'covid_positive_date.required' => 'Covid positive date is required if covid report is positive.',
        ];
    }
}
