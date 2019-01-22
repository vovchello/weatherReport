<?php

namespace App\Validators\Request;



use Illuminate\Foundation\Http\FormRequest;

class SearchWeatherRequest extends FormRequest
{
    public function rules()
    {
        return [
            'city' => 'required'
        ];
    }
}
