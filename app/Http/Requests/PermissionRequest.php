<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject_id' => 'required|exists:subjects,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'reason' => 'required|string|min:10',
            'proof_file' => 'nullable|file|max:2048|mimes:pdf,jpg,jpeg,png',
            'status' => 'sometimes|required|in:pending,approved_by_teacher,rejected_by_teacher,approved_final,rejected_final',
            'teacher_notes' => 'required_if:status,approved_by_teacher,rejected_by_teacher',
            'supervisor_notes' => 'required_if:status,approved_final,rejected_final'
        ];
    }
} 