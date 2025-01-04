<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambiar si es necesario
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:books',
            'published_date' => 'required|date',
            'author_id' => 'required|exists:authors,id',
        ];
    }
}
