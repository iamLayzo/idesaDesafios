<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambiar si es necesario
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|max:255|unique:books,isbn,' . $this->route('book'),
            'published_date' => 'sometimes|date',
            'author_id' => 'sometimes|exists:authors,id',
        ];
    }
}
