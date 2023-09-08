<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'status_date' => ['nullable', 'string', 'max:255'],
            'file' => 'nullable|file|mimes:jpg,jpeg,png,doc,docx,mp4,mov,ogg,xlsx|max:10240',
            'team_id' => ['nullable', 'integer']
        ];
    }
}
