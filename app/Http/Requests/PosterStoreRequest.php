<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PosterStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image_url' =>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'price' => 'required'
        ];
    }
}
