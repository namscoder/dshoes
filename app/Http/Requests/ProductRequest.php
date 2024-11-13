<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $rules = [];
        $method = $this->route()->getActionMethod();
        switch ($this->method()) {
            case 'POST':
                switch ($method) {
                    case 'store':
                        $rules = [
                            'name' => 'required|unique:products,name',
                            'price' => 'required|integer|min:1',
                            'category_id' => 'required',
                            'image' => 'required',
                            'description' => 'required',
                        ];
                        break;

                    case 'update':
                        $rules = [
                            'name' => [
                                'required',
                                Rule::unique('products')->ignore($this->id)
                            ],
                            'price' => 'required|integer|min:1',
                            'category_id' => 'required',
                            'description' => 'required',
                        ];
                        break;
                }
                break;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => "Không được để trống",
            'name.unique' => "Đã tồn tại",
            'price.required' => "Không được để trống",
            'price.integer' || 'price.min' => "Giá phải là số nguyên và lớn hơn 0",
            'category_id.required' => "Chưa chọn danh muc",
            'image.required' => "Chưa chọn ảnh",
            'description.required' => "Mô tả không được để trống",
        ];
    }
}
