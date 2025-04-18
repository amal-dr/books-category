<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Categorie;
use App\Models\Livre;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $livres = Livre::with('categorie')
            ->when($search, function ($query, $search) {
                return $query->where('titre', 'like', '%'.$search.'%')
                             ->orWhere('description', 'like', '%'.$search.'%');
            })
            ->paginate(10);
    
        return view('index', compact('livres', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'pages' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        Livre::create($validated);

        return redirect()->route('livres.index')
            ->with('success', 'Livre créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livre = Livre::with('categorie')->findOrFail($id);
        return view('show', compact('livre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $livre = Livre::findOrFail($id);
        $categories = Categorie::all();
        return view('edit', compact('livre', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $livre = Livre::findOrFail($id);
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'pages' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($livre->image) {
                Storage::disk('public')->delete($livre->image);
            }
            // Store new image in the same folder as store()
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Keep the old image if no new image is uploaded
            $validated['image'] = $livre->image;
        }

        $livre->update($validated);

        return redirect()->route('livres.index')
            ->with('success', 'Livre mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $livre = Livre::findOrFail($id);
        
        // Delete associated image
        if ($livre->image) {
            Storage::disk('public')->delete($livre->image);
        }
        
        $livre->delete();

        return redirect()->route('livres.index')
            ->with('success', 'Livre supprimé avec succès');
    }
}