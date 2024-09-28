<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'technique', 'creation_date', 'artist_id'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function expositions()
    {
        return $this->belongsToMany(Exposition::class, 'exposition_artwork');
    }
}
