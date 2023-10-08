<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalRequest extends FormRequest
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
            'avatar' => 'image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Họ và tên không được để trống',
            'avatar.image' => 'Avatar phải là một tệp hình ảnh',
            'avatar.max' => 'Kích thước avatar không vượt quá 2MB',
        ];
    }
}
