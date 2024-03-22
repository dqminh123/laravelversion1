<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'canonical' => 'required|unique:post_language,canonical, '.$this->id.',post_id',
            'post_catalogue_id' => 'gt:0'
        ];
    }

    public function messages(): array
    {
        return [
            
            'name.required' => 'Bạn chưa nhập vào tiêu đề nhóm bài viết',
            'canonical.required' => 'Bạn chưa nhập vào đường dẫn',
            'canonical.unique' => 'Đường dẫn đã tồn tại trong hệ thống',
            'post_catalogue_id.gt' => 'Bạn phải nhập vào danh mục cha',
        ];
    }
}
