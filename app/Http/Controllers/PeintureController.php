<?php

namespace App\Http\Controllers;

use App\Models\Peinture;
use Illuminate\Http\Request;

class PeintureController extends Controller
{
    /**
     * Afficher la liste des peintures.
     */
    public function index()
    {
        $peintures = Peinture::all();
        return view('peintures.index', compact('peintures'));
    }

    /**
     * Afficher le formulaire de création d'une peinture.
     */
    public function create()
    {
        return view('peintures.create');
    }

    /**
     * Enregistrer une nouvelle peinture dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        Peinture::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('peintures.index');
    }

    /**
     * Afficher une peinture spécifique.
     */
    public function show(Peinture $peinture)
    {
        return view('peintures.show', compact('peinture'));
    }

    /**
     * Afficher le formulaire d'édition d'une peinture.
     */
    public function edit(Peinture $peinture)
    {
        return view('peintures.edit', compact('peinture'));
    }

    /**
     * Mettre à jour une peinture dans la base de données.
     */
    public function update(Request $request, Peinture $peinture)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $peinture->image = $imagePath;
        }

        $peinture->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $peinture->image,
        ]);

        return redirect()->route('peintures.index')->with('success', 'Peinture mise à jour avec succès !');
    }

    /**
     * Supprimer une peinture de la base de données.
     */
    public function destroy(Peinture $peinture)
    {
        $peinture->delete();
        return redirect()->route('peintures.index')->with('success', 'Peinture supprimée avec succès !');
    }
}