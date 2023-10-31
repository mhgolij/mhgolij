<?php

namespace mhgolij\base\http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserGroupRequest extends FormRequest
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
        $validationRules = [
            'name' => 'required|string|max:255|min:2',
            'is_admin' => 'required|in:0,1',
            'limitation_count' => 'required|min:0|numeric',
        ];
        if (strtoupper(request()->method) == "POST")
            $validationRules['code'] = 'required|string|max:255|min:2|alpha|unique:mhgolij_user_groups,code,NULL,id,deleted_at,NULL';
        return  $validationRules;
    }
}
