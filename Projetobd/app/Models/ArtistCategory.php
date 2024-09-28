<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtistCategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }
}
