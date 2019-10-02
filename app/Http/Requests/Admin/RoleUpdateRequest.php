<?php

namespace App\Http\Requests\Admin;

class RoleUpdateRequest extends RoleStoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules();
    }
}
