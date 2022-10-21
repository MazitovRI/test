<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserAuthRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
             'email' => ['required', 'string', ],
             'password' => ['required', 'string', 'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S*[*.!@$%^&()\[\]{}:;\'"<>,?~_+=\|\/])/',],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Поле email обязательно для заполнения',
            'password.required' => 'Поле пароль обязательно для заполнения',

            'password.regex' => 'Поле пароль заполнено неверно',
        ];
    }
}