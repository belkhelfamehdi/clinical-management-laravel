<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Employee;
use App\Models\Chambre;
use App\Models\Facture;
use App\Models\Medicament;
use App\Models\Donneur;
use App\Models\Stocks;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'employees' => Employee::count(),
            'patients' => Patient::count(),
            'chambres' => Chambre::count(),
            'revenue' => Facture::sum('Montant'),
            'medicaments' => Medicament::count(),
            'donneurs' => Donneur::count(),
            'bloodStock' => Stocks::sum('quantite'),
        ];

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'latestPatients' => Patient::latest()->take(5)->get(),
            'latestEmployees' => Employee::latest()->take(5)->get(),
        ]);
    }
}
