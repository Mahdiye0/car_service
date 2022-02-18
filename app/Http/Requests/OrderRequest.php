<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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

                'service_id' => 'required|numeric',
                'user_id' => 'required|numeric',
                'address' => 'nullable|max:500|min:2|string',
                'rate' => 'nullable|numeric',
                'status' => 'nullable|numeric',

            ];
        }
        elseif($this->isMethod('put')){
            return [

                'service_id' => 'required|numeric',
                'user_id' => 'required|numeric',
                'address' => 'nullable|max:500|min:2|string',
                'rate' => 'nullable|numeric',
                'status' => 'nullable|numeric',



            ];
        }
    }
}
