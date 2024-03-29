<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
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
            'canonical' => 'required|string|unique:permissions',
            
            

        ];
    }

    public function messages(): array
    {
        return [
            
            'name.required' => 'Bạn chưa nhập vào tên quyền',
            'name.string' => 'Tên quyền phải là dạng kí tự',
            'canonical.required' => 'Bạn chưa nhập vào từ khóa của ngôn ngữ',
            'canonical.string' => 'Từ khóa của ngôn ngữ phải là dạng kí tự',
            'canonical.unique' => 'Từ khóa đã tồn tại hãy chọn từ khóa khác',
            
            
        ];
    }
}
