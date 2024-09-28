<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Exposition;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArtists = Artist::count();
        $totalArtworks = Artwork::count();
        $totalExpositions = Exposition::count();

        $expositions = Exposition::withCount('artworks')->get();

        return view('dashboard', compact('totalArtists', 'totalArtworks', 'totalExpositions', 'expositions'));
    }
}
