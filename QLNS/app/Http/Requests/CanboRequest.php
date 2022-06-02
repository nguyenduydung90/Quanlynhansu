<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CanboRequest extends FormRequest
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
            'hoten'=>'required',
            'gioitinh'=>'required',
            'sdt'=>'required',
            'ngaysinh'=>'required',
            'ngayvaoct'=>'required',
            'chucvu_id'=>'required',
            'email'=>'required|email|unique:canbo',
            'name'=>'required|unique:users'
            
        ];
    }
}
