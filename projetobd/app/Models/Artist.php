<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'biography',
        'nationality',
        'artist_category',
    ];

    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }

    public function category()
    {
        return $this->belongsTo(ArtistCategory::class);
    }
}