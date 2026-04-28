<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with('patient')->get();
        $totalRevenue = Facture::sum('Montant');
        
        return Inertia::render('Invoices/Index', [
            'factures' => $factures,
            'totalRevenue' => $totalRevenue,
        ]);
    }

    public function create()
    {
        $patients = Patient::all();
        return Inertia::render('Invoices/Create', ['patients' => $patients]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Montant' => 'required|numeric|min:0',
            'id_p' => 'required|exists:patient,id',
        ]);

        Facture::create($validated);
        return redirect()->route('factures.index');
    }

    public function destroy(Facture $facture)
    {
        $facture->delete();
        return redirect()->route('factures.index');
    }
}
