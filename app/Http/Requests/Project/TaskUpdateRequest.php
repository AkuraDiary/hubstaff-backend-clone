<?php

namespace App\Http\Request\Project;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
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
            'name' => 'string|nullable',
            'description' => 'string|nullable',
            'time_needed' => 'integer|nullable',
            'done_date' => 'date|nullable',
            'assigner_id' => 'integer|nullable',
            'assigner_id' => 'integer|nullable',
            'project_id' => 'integer|nullable'
        ];
    }
}
