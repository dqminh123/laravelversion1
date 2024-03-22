<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            
            'name' => 'required',
            'canonical' => 'required|unique:post_language',
            'post_catalogue_id' => 'gt:0'
           
        ];
    }

    public function messages(): array
    {
        return [
            
            'name.required' => 'Bạn chưa nhập vào tiêu đề bài viết',
            'canonical.required' => 'Bạn chưa nhập vào đường dẫn',
            'post_catalogue_id.gt' => 'Bạn phải nhập vào danh mục cha',
            
        ];
    }
}