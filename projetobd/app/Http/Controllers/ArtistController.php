<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{

    public function index()
    {
        $artists = Artist::all();
        return view('artists.index', compact('artists'));
    }

    public function create()
    {
        return view('artists.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'required',
            'nationality' => 'required',
            'artist_category' => 'required|string',
            'other_category' => 'nullable|string', // Adicionar validação para a categoria personalizada
        ]);
    
        // Verificar se a categoria é "Outro(a)" e usar a nova categoria, se preenchida
        $category = $request->artist_category === 'Outro(a)' ? $request->other_category : $request->artist_category;
    
        Artist::create([
            'name' => $validated['name'],
            'biography' => $validated['biography'],
            'nationality' => $validated['nationality'],
            'artist_category' => $category,  // Salva a nova categoria ou a selecionada
        ]);
    
        return redirect()->route('artists.index')->with('success', 'Artist created successfully!');
    }
    
    public function show($id)
    {
        $artist = Artist::find($id);
        return view('artists.show', compact('artist'));
    }

    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'nationality' => 'required|string',
            'artist_category' => 'required|string',
            'other_category' => 'nullable|string',
        ]);
    
        // Verificar se a categoria é "Outro(a)" e usar a nova categoria, se preenchida
        $category = $request->artist_category === 'Outro(a)' ? $request->other_category : $request->artist_category;
    
        $artist->update([
            'name' => $validated['name'],
            'biography' => $validated['biography'],
            'nationality' => $validated['nationality'],
            'artist_category' => $category,  // Atualiza a nova categoria ou a selecionada
        ]);
    
        return redirect()->route('artists.index')->with('success', 'Artista atualizado com sucesso!');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('artists.index')
                         ->with('success', 'Artist deleted successfully.');
    }
}