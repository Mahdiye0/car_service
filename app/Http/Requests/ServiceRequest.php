<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                'type_service_id' => 'required|numeric',
                'province_id' => 'required|numeric',
                'county_id' => 'required|numeric',
                'city_id' => 'required|numeric',
                'adderss' => 'required|max:500|min:2|string',
                'provide_services' => 'required',
                'status' => 'required|numeric',
                'image'=>'required|image|mimes:png,jpg,jpeg,gif',
            ];
        }
        elseif($this->isMethod('put')){
            return [
                'type_service_id' => 'required|numeric',
                'province_id' => 'required|numeric',
                'county_id' => 'required|numeric',
                'city_id' => 'required|numeric',
                'adderss' => 'required|max:500|min:2|string',
                'provide_services' => 'required',
                'status' => 'required|numeric',
                'image'=>'image|mimes:png,jpg,jpeg,gif',
            ];
        }
    }
}
