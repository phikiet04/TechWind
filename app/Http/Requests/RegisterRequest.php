<?php

namespace App\Http\Requests;

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

            'name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'regex:/^(0|\+84)[1-9][0-9]{8}$/'], // Thêm validation cho phone
            'address' => ['nullable', 'string', 'max:255'], // Thêm validation cho address
            'role' => ['nullable', 'in:user,admin'], // Chỉ chấp nhận user hoặc admin
            'image' => ['nullable', 'string'], // Image có thể là null hoặc string URL

        ];
    }
    public function messages()
    {
        return [

            'name.required' => 'Tên không được để trống.', // Custom message for 'name' required rule
            'name.regex' => 'Tên không được có kí tự đặc biệt hoặc số.', // Custom message for 'name' alpha rule
            'name.max' => 'Tên không được vượt quá 255 kí tự.', // Custom message for 'name' max length

            'email.required' => 'Email không được để trống.', // Custom message for 'email' required rule
            'email.email' => 'Email không hợp lệ.', // Custom message for 'email' format rule
            'email.max' => 'Email không được vượt quá 255 kí tự.', // Custom message for 'email' max length
            'email.unique' => 'Email đã tồn tại.', // Custom message for 'email' unique rule

            'password.required' => 'Mật khẩu không được để trống.', // Custom message for 'password' required rule
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.', // Custom message for 'password' string rule
            'password.min' => 'Mật khẩu phải có ít nhất 8 kí tự.', // Custom message for 'password' min length
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.', // Custom message for 'password' confirmed rule\

            // Số điện thoại
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập số bắt đầu bằng 0 hoặc +84 và có 9-10 chữ số.',

            // Địa chỉ
            'address.required' => 'Địa chỉ không được để trống.',
            'address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 kí tự.',

            // Vai trò (role)
            'role.required' => 'Vai trò không được để trống.',
            'role.in' => 'Vai trò phải là một trong hai giá trị: user hoặc admin.',

            // Hình ảnh
            'image.string' => 'URL hình ảnh phải là một chuỗi ký tự hợp lệ.',



        ];
    }
}