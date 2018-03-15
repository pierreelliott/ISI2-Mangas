<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\modeles\Manga;

class MangaController extends Controller
{
    public function getMangas() {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $manga = new Manga();
        // On récupère la liste de tous les mangas
        $mangas = $manga->getMangas();
        // On affiche la liste de ces mangas
        return view('listeMangas', compact('mangas', 'erreur'));
    }
}
