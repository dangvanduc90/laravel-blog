<?php

namespace App\Http\Requests;

use App\Rules\UppercaseRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'unique:posts' , 'max:10', new UppercaseRule()],
            'body' => 'required',
            'author.name' => 'required',
            'author.description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Bắt buộc nhập :attribute',
            'title.unique' => ':attribute đã bị trùng',
            'title.max' => ':attribute chỉ được phép chứa tối đa :max',
            'body.required'  => 'Bắt buộc nhập :attribute',
            'author.name.required'  => 'Bắt buộc nhập :attribute',
            'author.description.required'  => 'Bắt buộc nhập :attribute',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'body' => 'Nội dung',
            'author.name' => 'Tên tác giả',
            'author.description' => 'Mô tả tác giả',
        ];
    }
}
