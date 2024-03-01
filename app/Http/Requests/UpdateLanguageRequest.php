<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'name' => 'required|string',
            'canonical' => 'required|string|unique:languages,canonical,'.$this->id.'', 
            'description' => 'required|string',
          


        ];
    }

    public function messages(): array
    {
        return [
            
            'name.required' => 'Bạn chưa nhập vào tên ngôn ngữ',
            'name.string' => 'Tên ngôn ngữ phải là dạng kí tự',
            'canonical.required' => 'Bạn chưa nhập vào từ khóa của ngôn ngữ',
            'canonical.string' => 'Từ khóa của ngôn ngữ phải là dạng kí tự',
            'canonical.unique' => 'Từ khóa đã tồn tại hãy chọn từ khóa khác',
            'description.required' => 'Bạn chưa nhập vào mô tả',
            'description.string' => 'Mô tả phải là dạng kí tự',
        
            
        ];
    }
}
