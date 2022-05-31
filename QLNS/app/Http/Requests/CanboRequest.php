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
            'dienthoai'=>'required',
            'ngaysinh'=>'required',
            'ngayvao'=>'required',
            'chucvu_id'=>'required',
            'email'=>'required|email|unique:canbo',
            'anh'=>'image',
            'name'=>'required|unique:users'
            
        ];
    }
}
