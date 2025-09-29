<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Patient::where('user_id', $user->id);

        if ($request->filled('q')) {
            $query->where('name','like','%'.$request->q.'%');
        }

        $patients = $query->orderBy('name')->paginate(15);
        return response()->json($patients);
    }

    public function store(StorePatientRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $patient = Patient::create($data);
        return response()->json($patient, 201);
    }

    public function show(Request $request, $id)
    {
        $patient = Patient::where('id',$id)->where('user_id',$request->user()->id)->firstOrFail();
        return response()->json($patient);
    }

    public function update(UpdatePatientRequest $request, $id)
    {
        $patient = Patient::where('id',$id)->where('user_id',$request->user()->id)->firstOrFail();
        $patient->update($request->validated());
        return response()->json($patient);
    }

    public function destroy(Request $request, $id)
    {
        $patient = Patient::where('id',$id)->where('user_id',$request->user()->id)->firstOrFail();
        $patient->delete();
        return response()->json(['message'=>'Deleted']);
    }
}
