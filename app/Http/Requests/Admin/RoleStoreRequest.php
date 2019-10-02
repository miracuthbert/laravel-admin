<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'usable' => 'nullable|boolean',
            'parent_id' => [
                'nullable',
                Rule::exists('roles', 'id')
            ],
            'permissions.*' => [
                'required',
                Rule::exists('permissions', 'id')->where('usable', true)
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
//            'name.unique' => 'Role with this :attribute already exists.'
        ];
    }
}
