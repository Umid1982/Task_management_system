<?php

namespace App\Http\Requests\ParticipantTeam;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
//            'participant_id' =>['required','integer'],
//            'team_id' => ['required','integer'],
            'user_id' =>['required','integer',Rule::exists('users','id')],
            'team_id' => ['required','integer',Rule::exists('teams','id')],
        ];
    }
}
