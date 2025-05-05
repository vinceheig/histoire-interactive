<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChoiceUpdateRequest extends FormRequest
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
            //'text', 'nextChapterId', 'chapterId'
            //'text' => ['bail','required','min:3','max:100','regex:/^[a-zA-Z0-9 \-_]+$/'],
            'text' => ['bail', 'required', 'min:1', 'max:280', 'regex:/^[\p{L}\p{N}\s\-.,!?\'\"_àâäéèêëîïôöùûüçÀÂÄÉÈÊËÎÏÔÖÙÛÜÇ]+$/u'],
			'nextChapterId' => 'integer|min:1',
			'chapterId' => 'required|integer|min:1',
        ];
    }
}
