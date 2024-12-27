<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // use App\Rules\Min5;

    public function rules(): array
    {
        return [
            'name' => 'required|min5',
            'description' => 'required|min:50',
            'quantity' => 'required|numeric',
            'image' => 'required|image',
            'price' => 'required|numeric',
        ];
    }
}
