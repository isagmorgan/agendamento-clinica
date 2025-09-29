<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Appointment::with('patient')->where('user_id', $user->id);

        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query->orderBy('date','desc')->orderBy('time')->paginate(15);
        return response()->json($appointments);
    }

    public function store(StoreAppointmentRequest $request)
    {
        $user = $request->user();

        // Verifica se o patient pertence ao médico atual
        $patient = Patient::where('id', $request->patient_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Checagem simples de conflito de horário:
        $exists = Appointment::where('user_id', $user->id)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->exists();

        if ($exists) {
            return response()->json(['message'=>'Horário ocupado'], 422);
        }

        $data = $request->validated();
        $data['user_id'] = $user->id;
        $appointment = Appointment::create($data);

        return response()->json($appointment, 201);
    }

    public function show(Request $request, $id)
    {
        $appointment = Appointment::with('patient')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return response()->json($appointment);
    }

    public function update(UpdateAppointmentRequest $request, $id)
    {
        $user = $request->user();

        $appointment = Appointment::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Se patient_id foi enviado, garantir que pertença ao médico
        if ($request->filled('patient_id')) {
            $patient = Patient::where('id', $request->patient_id)
                ->where('user_id', $user->id)
                ->firstOrFail();
        }

        $appointment->update($request->validated());

        return response()->json($appointment);
    }

    public function destroy(Request $request, $id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $appointment->delete();

        return response()->json(['message'=>'Deleted']);
    }
}
