<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name' => 'nullable|string',
            'image' => 'required',
            'isPublish' => 'required',
            'icon' => 'required'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'အမည်ထည့်ရန် လိုအပ်ပါသည်။',
    //         'name.string' => 'စာသားထည်',
    //         'image.required' => 'ပုံထည့်ရင် လိုအပ်ပါသည်။',
    //         'icon.required' => 'icon ထည့်ရန် လိုအပ်ပါသည်။'
    //     ];
    // }
}
