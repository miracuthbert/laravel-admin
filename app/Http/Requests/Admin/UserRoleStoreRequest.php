<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRoleStoreRequest extends FormRequest
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
            'role_id' => [
                'required',
                Rule::exists('roles', 'id')->where('usable', true),
            ],
            'expires_at' => 'nullable|date',
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        if ($expiresAt = $this->request->get('expires_at')) {
            $this->request->set('expires_at', Carbon::parse($expiresAt)->toDateTimeString());
        }

        return parent::validationData();
    }
}
