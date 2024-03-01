<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users|max:191',
            'name' => 'required|string',
            'user_catalogue_id' => 'gt:0',
            'password' => 'required|string|min:6',
            're_password' => 'required|string|same:password',

        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập vào email',
            'email.email' => 'Email chưa đúng định dạng. Ví dụ ABC@gmail.com',
            'email.unique' => 'Email đã tồn tại. Hãy chọn email khác',
            'email.string' => 'Email phải là dạng kí tự',
            'email.max' => 'Độ dài email tối đa 191',
            'name.required' => 'Bạn chưa nhập vào họ và tên',
            'name.string' => 'Họ và tên phải là dạng kí tự',
            'user_catalogue_id.gt'=> 'Bạn chưa chọn nhóm thành viên',
            're_password.required' => 'Bạn chưa nhập lại mật khẩu',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 kí tự',
            're_password.same' => 'Mật khẩu không khớp',
        ];
    }
}
