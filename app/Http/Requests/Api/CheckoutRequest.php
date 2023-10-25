<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'number' => 'required|string',
            'address' => 'required|string',
            'transaction_total' => 'required|integer',
            'transaction_status' => 'nullable|string|in:PENDING,SUCCESS,FAILED',
            'transaction_details' => 'required|array',
            'transaction_details.*' => 'integer|exists:products,id',
        ];
    }
}
