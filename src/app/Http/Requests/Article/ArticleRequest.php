<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': 
                return [
                'name' => 'required|string|min:2|max:255',
                'short_body' => 'required|string|min:2|max:255',
                'body' => 'required|string',
                ];
            
            case 'PUT': 
                return [
                    'name' => 'required|string|min:2|max:255',
                    'short_body' => 'required|string|min:2|max:255',
                    'body' => 'required|string',
                ];
            
            default:
                break;
           
        }
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',

            'min' => 'Поле :attribute должно содержать более 2-х символов',
        ];
    }
}