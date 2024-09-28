<?php

namespace App\Http\Controllers;

use App\Models\Exposition;
use App\Models\Artwork;
use Illuminate\Http\Request;

class ExpositionController extends Controller
{
    public function index()
    {
        $expositions = Exposition::all();
        return view('expositions.index', compact('expositions'));
    }

    public function create()
    {
        $artworks = Artwork::all();
        return view('expositions.create', compact('artworks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gallery_type' => 'required|string|max:255',
            'gallery_name' => 'required|string|max:255',
            'gallery_address' => 'required|string|max:255',
            'gallery_city_state' => 'required|string|max:255',
            'gallery_country' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'date' => 'required|date',
            'artworks' => 'required|array',
        ]);

        // Criar a nova exposição
        $exposition = Exposition::create($request->only([
            'gallery_type', 'gallery_name', 'gallery_address', 
            'gallery_city_state', 'gallery_country', 'theme', 'date'
        ]));

        // Associar as obras de arte selecionadas
        $exposition->artworks()->sync($request->artworks);

        return redirect()->route('expositions.index')->with('success', 'Exposição criada com sucesso!');
    }

    public function show($id)
    {
        $exposition = Exposition::findOrFail($id);
        return view('expositions.show', compact('exposition'));
    }
    

    public function edit(Exposition $exposition)
    {
        $artworks = Artwork::all(); // Carregar todas as obras de arte para o dropdown
        return view('expositions.edit', compact('exposition', 'artworks'));
    }

    public function update(Request $request, Exposition $exposition)
    {
        $request->validate([
            'gallery_type' => 'required|string|max:255',
            'gallery_name' => 'required|string|max:255',
            'gallery_address' => 'required|string|max:255',
            'gallery_city_state' => 'required|string|max:255',
            'gallery_country' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'date' => 'required|date',
            'artworks' => 'required|array',
        ]);

        // Atualizar os dados da exposição
        $exposition->update($request->only([
            'gallery_type', 'gallery_name', 'gallery_address', 
            'gallery_city_state', 'gallery_country', 'theme', 'date'
        ]));

        // Atualizar as associações de obras de arte
        $exposition->artworks()->sync($request->artworks);

        return redirect()->route('expositions.index')->with('success', 'Exposição atualizada com sucesso!');
    }

    public function destroy(Exposition $exposition)
    {
        $exposition->delete();
        return redirect()->route('expositions.index')->with('success', 'Exposição excluída com sucesso!');
    }
}
