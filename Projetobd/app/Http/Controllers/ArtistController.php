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
        ]);
    
        Artist::create($validated);
    
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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'required',
            'nationality' => 'required',
            'artist_category' => 'required|string',
        ]);
    
        $artist = Artist::findOrFail($id);
        $artist->update($validated);
    
        return redirect()->route('artists.index')->with('success', 'Artist updated successfully!');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('artists.index')
                         ->with('success', 'Artist deleted successfully.');
    }
}