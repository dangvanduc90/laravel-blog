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
            'file' => 'required|max:8192|mimetypes:video/*,image/*', // 8mb
            'body' => 'required',
            'email' => 'required|email|unique:users,email',
            'author.name' => 'required',
            'author.description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Bắt buộc nhập :attribute',
            'title.unique' => ':attribute đã tồn tại',
            'title.max' => ':attribute chỉ được phép chứa tối đa :max',
            'file.max' => ':attribute không được lớn hơn :max kilobytes.',
            'file.mimetypes' => ':attribute chỉ chấp nhận định dạng ảnh hoặc video',
            'file.required'  => 'Bắt buộc nhập :attribute',
            'body.required'  => 'Bắt buộc nhập :attribute',
            'email.required'  => 'Bắt buộc nhập :attribute',
            'email.email'  => ':attribute phải đúng định dạng email',
            'email.unique'  => ':attribute đã tồn tại',
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
            'file' => 'File',
        ];
    }
}
