<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

class PermissionUpdateRequest extends PermissionStoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'name' => [
                'required',
                'max:255',
                Rule::unique('permissions', 'name')->ignore(optional($this->permission)->id)
            ],
        ]);
    }
}
