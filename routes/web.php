<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivreController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('livres', 'App\Http\Controllers\LivreController');