<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storedata extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'first' => 'required|unique:cats|max:20',
            // 'name' => 'required|unique:sections|max:20',
            // 'desc' => 'required|unique:cats|max:20',
            // 'last' => 'required|unique:cats|max:20',
        ];
    }
    public function messages()
    {
        return [
                // 'first.required' => 'هذا الحقل مطلوب',
                // 'first.unique'   => 'هذا الحقل موجود ياعم محمد',
        ];
    }
}
