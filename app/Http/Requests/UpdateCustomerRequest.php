<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "sometimes|required|string|max:255",
            "email" => "sometimes|required|string|email|max:255|unique:customers,email," . $this->route("customer"),
            "phone_number" => "sometimes|required|string",
            "password" => "sometimes|required|string|min:8",
        ];
    }
}
