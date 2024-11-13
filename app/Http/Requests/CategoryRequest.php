<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        switch($this->method()){
            case 'POST':
                switch($method){
                    case 'store':
                        $rules = [
                            'category_name'=>'required|unique:categories,category_name',
                            'description'=>'required'
                        ];
                        break;
                    case 'update':
                        $rules = [
                            'category_name'=>[
                                'required',
                                Rule::unique('categories')->ignore($this->id)
                            ],
                            'description'=>'required'
                        ];
                        break;
                    default:
                        break;
                }
                break;

            default:
                break;
        }
        return $rules;
    }
    public function messages(){
        return [
            'category_name.required' => "Tên danh mục không được để trống",
            'category_name.unique' => "Tên danh mục đã tồn tại",
            'description.required' => "Mô tả danh mục  không được để trống"
        ];
    }
}
