<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'role' => 'required|in:1,2,3',
                'user_name' => 'required|max:20',
                'password' => 'required|max:20|min:4',
            ];
        }
        elseif($this->isMethod('put')){
            return [
                'first_name' => 'required|max:120|min:2',
                'last_name' => 'required|max:120|min:2',
                'mobile' => 'required|numeric',
                'user_name' => 'required|max:20',
                'password' => 'required|max:20|min:4',
                'role' => 'required|in:1,2,3',

            ];
        }
    }
}
