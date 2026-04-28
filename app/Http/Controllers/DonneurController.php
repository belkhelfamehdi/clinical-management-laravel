<?php

namespace App\Http\Controllers;

use App\Models\Donneur;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DonneurController extends Controller
{
    public function index()
    {
        $donneurs = Donneur::all();
        $stocks = \App\Models\Stocks::all();
        
        return Inertia::render('BloodBank/Index', [
            'donneurs' => $donneurs,
            'stocks' => $stocks,
        ]);
    }

    public function create()
    {
        return Inertia::render('BloodBank/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numero' => 'required|integer',
            'gs' => 'required|string',
        ]);

        Donneur::create($validated);
        
        // Update blood stock
        $stock = \App\Models\Stocks::find($validated['gs']);
        if ($stock) {
            $stock->increment('quantite');
        }
        
        return redirect()->route('donneurs.index');
    }

    public function destroy(Donneur $donneur)
    {
        $donneur->delete();
        return redirect()->route('donneurs.index');
    }
}
