<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ttpm_id'=>'required',
            'hdsd'=>'file|mimes:doc,docx,pdf,xlsx,xls',
            'demo'=>'file|mimes:doc,docx,pdf,xlsx,xls',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'ttpm_id.required'=>'Không được để trống',
    //         'hdsd.file'=>'Định dạng file',
    //         'demo.file'=>'Định dạng file',
    //         'hdsd.mimes'=>'Định dạng file: doc, docx, pdf, xlsx,xls',
    //         'demo.mimes'=>'Định dạng file: doc, docx, pdf, xlsx,xls',
    //     ];
    // }
}
