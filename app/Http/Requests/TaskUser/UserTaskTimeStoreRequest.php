<?php

namespace App\Http\Requests\TaskUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserTaskTimeStoreRequest extends FormRequest
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
            'user_id'=>['required','integer', Rule::exists('users', 'id')],
            'task_id'=>['required','integer', Rule::exists('tasks', 'id')],
            'start_time'=>['required','date_format:Y-m-d H:i:s'],
            'end_time'=>['required','date_format:Y-m-d H:i:s'],
        ];
    }
}
