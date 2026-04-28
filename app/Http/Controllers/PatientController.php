<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return Inertia::render('Patients/Index', ['patients' => $patients]);
    }

    public function create()
    {
        return Inertia::render('Patients/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'daten' => 'required|date',
            'gen' => 'required|string',
            'num' => 'required|integer',
            'email' => 'required|email',
            'addr' => 'required|string',
            'gs' => 'required|string',
        ]);

        Patient::create($validated);
        return redirect()->route('patients.index');
    }

    public function edit(Patient $patient)
    {
        return Inertia::render('Patients/Edit', ['patient' => $patient]);
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'daten' => 'required|date',
            'gen' => 'required|string',
            'num' => 'required|integer',
            'email' => 'required|email',
            'addr' => 'required|string',
            'gs' => 'required|string',
        ]);

        $patient->update($validated);
        return redirect()->route('patients.index');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index');
    }
}
