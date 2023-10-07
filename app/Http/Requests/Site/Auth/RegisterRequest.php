<?php

namespace App\Http\Requests\Site\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirm' => 'same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Họ và tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải chứa ít nhất một chữ cái thường, một chữ cái in hoa và một số',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái thường, một chữ cái in hoa và một số',
            'password_confirm.same' => 'Mật khẩu xác nhận phải trùng với mật khẩu',
        ];
    }
}
