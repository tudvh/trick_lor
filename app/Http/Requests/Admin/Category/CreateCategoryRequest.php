<?php

namespace App\Http\Requests\Admin\Category;

use App\Enums\Category\CategoryStatus;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => ['required', 'unique:categories,name'],
            'icon' => ['required'],
            'icon_color' => ['required'],
            'status' => [
                'required',
                'in:' . implode(',', CategoryStatus::getValues()),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'tên danh mục',
            'icon' => 'icon',
            'icon_color' => 'icon color',
            'status' => 'trạng thái',
        ];
    }
}
