<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;

class UpdateTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'status' => Rule::enum(TaskStatus::class),
            'priority' => Rule::enum(TaskPriority::class),
            'due_date' => 'date'
        ];
    }
}
