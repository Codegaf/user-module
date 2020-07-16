<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'email' => __('forms.email'),
            'name' => __('forms.name'),
            'surname' => __('forms.surname'),
            'password' => __('forms.password'),
            'password_confirmation' => __('forms.password-confirmation')
        ];
    }
}
