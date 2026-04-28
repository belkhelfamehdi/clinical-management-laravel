<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicamentController extends Controller
{
    public function index()
    {
        $medicaments = Medicament::all();
        return Inertia::render('Pharmacy/Index', ['medicaments' => $medicaments]);
    }

    public function create()
    {
        return Inertia::render('Pharmacy/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer|min:0',
        ]);

        Medicament::create([
            'numM' => $request->numM ?? null,
            'nom' => $validated['nom'],
            'quantite' => $validated['quantite'],
        ]);

        return redirect()->route('medicaments.index');
    }

    public function edit(Medicament $medicament)
    {
        return Inertia::render('Pharmacy/Edit', ['medicament' => $medicament]);
    }

    public function update(Request $request, Medicament $medicament)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer|min:0',
        ]);

        $medicament->update($validated);
        return redirect()->route('medicaments.index');
    }

    public function destroy(Medicament $medicament)
    {
        $medicament->delete();
        return redirect()->route('medicaments.index');
    }
}
