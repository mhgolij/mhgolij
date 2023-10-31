<?php

namespace mhgolij\base\http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RoleRequest extends FormRequest
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
        $validationRules =  [
            'fa_name' => 'required|string|max:255|min:2',
            'permission'=>'nullable|array',
            'permission.*'=>'exists:permissions,name'
        ];
        if (strtoupper(request()->method) == "POST")
            $validationRules['name'] = 'required|string|alpha|max:255|min:2';
        return $validationRules;
    }
}
