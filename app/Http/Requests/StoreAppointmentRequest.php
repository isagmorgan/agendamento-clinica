<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration_minutes' => 'nullable|integer|min:5',
            'status' => 'nullable|in:scheduled,canceled,done',
            'notes' => 'nullable|string'
        ];
    }
}
