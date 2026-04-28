<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $rendezvous = Consultation::with(['patient', 'doctor'])->get();
        return inertia('Appointments/Index', compact('rendezvous'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Employee::where('fonction', 'medecin')->orWhere('fonction', 'doctor')->get();
        return inertia('Appointments/Create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'num' => 'required|integer|unique:consultation,num',
            'date' => 'required|date',
            'id_p' => 'required|exists:patient,id',
            'id_e' => 'required|exists:employe,id',
        ]);

        Consultation::create($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully');
    }

    public function destroy(Consultation $rendezvous)
    {
        $rendezvous->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
    }
}
