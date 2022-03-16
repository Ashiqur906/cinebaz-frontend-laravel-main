<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'password'  => 'required|max:191|min:6',
            'password_confirmation' => 'required_with:password|same:password',
        ];

        if($this->phone){
            $rules['phone'] = 'required|string|unique:members,phone|regex:/(1)[0-9]{9}/|max:11|min:10';
            $rules['email'] = 'nullable|email|max:255|unique:members,email';
        }else{
            $rules['email'] = 'required|email|max:255|unique:members,email';
        }



        return  $rules;
    }
}
