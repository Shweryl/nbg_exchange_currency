<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateBookmarkStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'from' => 'required|string|in:USD,PHP,MYR,SGD,THB',
            'to' => 'required|string|in:USD,PHP,MYR,SGD,THB',
            'amount' => 'required',
            'rate' => 'required',
            'result' => 'required',
        ];
    }
}
