<?php

namespace App\Http\Controllers;

use App\Models\Salaire;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaireController extends Controller
{
    public function index()
    {
        $salaires = Salaire::with('employee')->get();
        return inertia('Salaries/Index', compact('salaires'));
    }

    public function create()
    {
        $employees = Employee::all();
        return inertia('Salaries/Create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|unique:salaire,id|exists:employe,id',
            'salaire' => 'required|numeric|min:0',
        ]);

        Salaire::create($validated);
        return redirect()->route('salaires.index')->with('success', 'Salary created successfully');
    }

    public function edit(Salaire $salaire)
    {
        $employees = Employee::all();
        return inertia('Salaries/Edit', compact('salaire', 'employees'));
    }

    public function update(Request $request, Salaire $salaire)
    {
        $validated = $request->validate([
            'salaire' => 'required|numeric|min:0',
        ]);

        $salaire->update($validated);
        return redirect()->route('salaires.index')->with('success', 'Salary updated successfully');
    }

    public function destroy(Salaire $salaire)
    {
        $salaire->delete();
        return redirect()->route('salaires.index')->with('success', 'Salary deleted successfully');
    }
}
