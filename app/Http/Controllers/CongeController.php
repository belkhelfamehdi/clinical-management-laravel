<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Employee;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    public function index()
    {
        $conges = Conge::with('employee')->get();
        return inertia('Leaves/Index', compact('conges'));
    }

    public function create()
    {
        $employees = Employee::all();
        return inertia('Leaves/Create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_em' => 'required|exists:employe,id',
            'dated' => 'required|date',
            'datef' => 'required|date|after:dated',
        ]);

        Conge::create($validated);
        return redirect()->route('conges.index')->with('success', 'Leave created successfully');
    }

    public function edit(Conge $conge)
    {
        $employees = Employee::all();
        return inertia('Leaves/Edit', compact('conge', 'employees'));
    }

    public function update(Request $request, Conge $conge)
    {
        $validated = $request->validate([
            'id_em' => 'required|exists:employe,id',
            'dated' => 'required|date',
            'datef' => 'required|date|after:dated',
        ]);

        $conge->update($validated);
        return redirect()->route('conges.index')->with('success', 'Leave updated successfully');
    }

    public function destroy(Conge $conge)
    {
        $conge->delete();
        return redirect()->route('conges.index')->with('success', 'Leave deleted successfully');
    }
}
