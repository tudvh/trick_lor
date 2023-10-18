<?php

namespace App\Http\Requests\Admin\Post;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:posts,title,' . request()->id,
            'youtube_id' => 'nullable|unique:posts,youtube_id,' . request()->id,
            'categories' => 'required|array|min:1',
            'thumbnail' => 'image|max:2048',
            'active' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.unique' => 'Tiêu đề của bài đăng đã tồn tại',
            'youtube_id.unique' => 'Youtube id đã tồn tại',
            'categories.required' => 'Vui lòng chọn ít nhất 1 danh mục',
            'thumbnail.image' => 'Thumbnail phải là một tệp hình ảnh',
            'thumbnail.max' => 'Kích thước thumbnail không vượt quá 2MB',
            'active' => 'Vui lòng chọn trạng thái'
        ];
    }
}
