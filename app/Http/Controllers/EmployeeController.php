<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return Inertia::render('Employees/Index', ['employees' => $employees]);
    }

    public function create()
    {
        return Inertia::render('Employees/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'daten' => 'required|date',
            'dateem' => 'required|date',
            'gen' => 'required|string',
            'num' => 'required|integer',
            'email' => 'required|email',
            'fonction' => 'nullable|string',
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee)
    {
        return Inertia::render('Employees/Edit', ['employee' => $employee]);
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'daten' => 'required|date',
            'dateem' => 'required|date',
            'gen' => 'required|string',
            'num' => 'required|integer',
            'email' => 'required|email',
            'fonction' => 'nullable|string',
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
