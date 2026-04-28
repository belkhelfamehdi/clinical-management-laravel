<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChambreController extends Controller
{
    public function index()
    {
        $chambres = Chambre::with(['patient', 'employee'])->get();
        $patients = Patient::all();
        $employees = Employee::all();
        
        return Inertia::render('Rooms/Index', [
            'chambres' => $chambres,
            'patients' => $patients,
            'employees' => $employees,
        ]);
    }

    public function create()
    {
        $patients = Patient::all();
        $employees = Employee::all();
        
        return Inertia::render('Rooms/Create', [
            'patients' => $patients,
            'employees' => $employees,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_p' => 'required|exists:patient,id',
            'id_e' => 'required|exists:employe,id',
        ]);

        Chambre::create($validated);
        return redirect()->route('chambres.index');
    }

    public function destroy(Chambre $chambre)
    {
        $chambre->delete();
        return redirect()->route('chambres.index');
    }
}
