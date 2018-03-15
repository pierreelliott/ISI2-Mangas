<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\modeles\Genre;

class GenreController extends Controller
{
    public function getGenres() {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $genre = new Genre();
        $genres = $genre->getGenres();
        return view('formGenre', compact('genres', 'erreur'));
    }
}
