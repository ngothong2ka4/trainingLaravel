<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->user->id; // Lấy ID của người dùng từ đối tượng $this->user

        return [
            'name' => 'required|string', // Tên là bắt buộc và phải là chuỗi
            'email' => 'required|email|unique:users,email,' . $userId, // Email bắt buộc, phải là email hợp lệ, và duy nhất ngoại trừ ID của người dùng hiện tại
            'type' => 'required|string', // Loại người dùng là bắt buộc và phải là chuỗi
        ];
    }
}