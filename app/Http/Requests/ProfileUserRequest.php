<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUserRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'first_name' => 'required|max:120|min:2',
                'last_name' => 'required|max:120|min:2',
                'mobile' => 'required|numeric',
                'user_name' => 'required|max:20|unique:users,user_name',
                'image'=>'image|mimes:png,jpg,jpeg,gif',

            ];
        }
        elseif($this->isMethod('put')){
            return [
                'first_name' => 'required|max:120|min:2',
                'last_name' => 'required|max:120|min:2',
                'mobile' => 'required|numeric',
                'user_name' => ['required', Rule::unique('users')->ignore($this->user)],
                'image'=>'image|mimes:png,jpg,jpeg,gif',
            ];
        }
    }

}
