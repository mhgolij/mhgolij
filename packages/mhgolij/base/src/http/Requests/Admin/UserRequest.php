<?php

namespace mhgolij\base\http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        if (strtoupper(request()->method) == "POST")
            return [
                'name' => 'required|string|max:255|min:2',
                'last_name' => 'nullable|string|max:255|min:2',
                'email' => 'nullable|email|unique:users,email,NULL,id,deleted_at,NULL',
                'mobile' => 'nullable|unique:users,mobile,NULL,id,deleted_at,NULL',
                'user_name' => 'required|unique:users,user_name,NULL,id,deleted_at,NULL|min:5',
                'password' => 'required|min:8|confirmed'
            ];
        else
            return [
                'name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . $this->user->id.',id,deleted_at,NULL',
                'user_name' => 'required|unique:users,user_name,'. $this->user->id.',id,deleted_at,NULL',
                'mobile' => 'required|unique:users,mobile,'. $this->user->id.',id,deleted_at,NULL',
                'password' => 'required|min:8|confirmed'
            ];
    }
}
