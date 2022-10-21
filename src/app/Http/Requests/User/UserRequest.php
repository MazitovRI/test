<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class UserRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': 
                return [
                'email' => 'required|string|email|unique:users,email',
                'name' => 'required|string|min:2|max:255',
                'password' => [
                    'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S*[*.!@$%^&()\[\]{}:;\'"<>,?~_+=\|\/])/',
                    'required',
                    'string',
                    'min:8',
                ],
                ];
            
            case 'PUT': {
                    $user = $this->route('user');
                    $id = $user->id; 
                    return [
                        'email' => "required|string|email|unique:users,email,$id",
                        'name' => 'required|string|min:2|max:255',
                        'password' => [
                            'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S*[*.!@$%^&()\[\]{}:;\'"<>,?~_+=\|\/])/',
                            'required',
                            'string',
                            'min:8',
                        ],
                    ];
                }
            default:
                break;
           
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле логин обязательно для заполнения',
            'required' => 'Поле :attribute обязательно для заполнения',
            'password.required' => 'Поле пароль обязательно для заполнения',

            'name.min' => 'Поле имя должно содержать более 2-х символов',
            'password.min' => 'Поле пароль должно содержать более 8-ми символов',

            'email.unique' => 'Пользователь с таким :attribute уже существует',

            'password.regex' => 'Поле пароль заполнено неверно',
        ];
    }
}