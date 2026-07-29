<?php

namespace App\Http\Controllers;

use App\Models\Acheteur;
use App\Models\Produit;
use App\Models\Achat;
use Illuminate\Http\Request;

class AcheteurController extends Controller
{
    public function index()
    {
        $acheteurs = Acheteur::withCount('achats')->get();
        return view('acheteurs.index', compact('acheteurs'));
    }

    public function create()
    {
        return view('acheteurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:acheteurs,email',
            'telephone' => 'nullable|string|max:20',
        ]);

        Acheteur::create($validated);

        return redirect()->route('acheteurs.index')->with('success', 'Acheteur créé avec succès.');
    }

    public function show(Acheteur $acheteur)
    {
        $acheteur->load('achats.produit');
        $produits = Produit::all();
        return view('acheteurs.show', compact('acheteur', 'produits'));
    }

    public function edit(Acheteur $acheteur)
    {
        return view('acheteurs.edit', compact('acheteur'));
    }

    public function update(Request $request, Acheteur $acheteur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:acheteurs,email,' . $acheteur->id,
            'telephone' => 'nullable|string|max:20',
        ]);

        $acheteur->update($validated);

        return redirect()->route('acheteurs.index')->with('success', 'Acheteur modifié avec succès.');
    }

    public function destroy(Acheteur $acheteur)
    {
        $acheteur->delete();
        return redirect()->route('acheteurs.index')->with('success', 'Acheteur supprimé avec succès.');
    }

    // Enregistrer un nouvel achat depuis la fiche acheteur
    public function acheter(Request $request, Acheteur $acheteur)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'date_achat' => 'required|date',
        ]);

        Achat::create([
            'produit_id' => $validated['produit_id'],
            'acheteur_id' => $acheteur->id,
            'quantite' => $validated['quantite'],
            'date_achat' => $validated['date_achat'],
        ]);

        return redirect()->route('acheteurs.show', $acheteur)->with('success', 'Achat enregistré avec succès.');
    }
}