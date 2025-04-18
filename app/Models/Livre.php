<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    protected $fillable=[
        'titre',
        'pages',
        'description',
        'image',
        'categorie_id',
    ];
   // App/Models/Livre.php
public function categorie()
{
    return $this->belongsTo(Categorie::class);
}
}
