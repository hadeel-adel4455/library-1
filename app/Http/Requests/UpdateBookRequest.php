<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'ISBN' => 'sometimes|required|string|unique:books,ISBN',
            'category_id' => 'sometimes|required|exists:categories,id',
        ];
    }
}
