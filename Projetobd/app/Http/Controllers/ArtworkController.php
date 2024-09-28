<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::all();
        return view('artworks.index', compact('artworks'));
    }

    public function create()
    {
        $artists = Artist::all();
        return view('artworks.create', compact('artists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'technique' => 'required|string|max:255',
            'creation_date' => 'required|date',
            'artist_id' => 'required|exists:artists,id',
        ]);

        Artwork::create($request->all());
        return redirect()->route('artworks.index')->with('success', 'Obra de arte criada com sucesso!');
    }

    public function show($id) 
    {
        $artwork = Artwork::findOrFail($id); 
        return view('artworks.show', compact('artwork')); 
    }

    public function edit(Artwork $artwork)
    {
        $artists = Artist::all();
        return view('artworks.create', compact('artwork', 'artists'));
    }

    public function update(Request $request, Artwork $artwork)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'technique' => 'required|string|max:255',
            'creation_date' => 'required|date',
            'artist_id' => 'required|exists:artists,id',
        ]);

        $artwork->update($request->all());
        return redirect()->route('artworks.index')->with('success', 'Obra de arte atualizada com sucesso!');
    }

    public function destroy(Artwork $artwork)
    {
        $artwork->delete();
        return redirect()->route('artworks.index')->with('success', 'Obra de arte excluída com sucesso!');
    }
}
