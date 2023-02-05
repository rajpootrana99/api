<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'task_id' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:32'],
            'priority' => ['required', 'integer', Rule::in([0, 1, 2])],
            'status' => ['required', 'integer', Rule::in([0, 1, 2])],
            'progress' => ['required', 'integer', Rule::in([0, 1])],
            'images[]' => ['mimes:png,jpg,mp4,mkv,doc,docx'],
        ];
    }
}
