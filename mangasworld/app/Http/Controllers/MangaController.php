<?php

namespace App\Http\Controllers;

use Request;
use Exception;
use Illuminate\Support\Facades\Session;
use App\modeles\Manga;
use App\modeles\Genre;
use App\modeles\Dessinateur;
use App\modeles\Scenariste;

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
    
    public function getMangasGenre() {
        $erreur = "";
        // On récupère l'ID du genre sélectionné
        $id_genre = Request::input('cbGenre');
        // Si on a un ID de genre
        if($id_genre) {
            $manga = new Manga();
            // On récupère la liste de tous les mangas du genre choisi
            $mangas = $manga->getMangasGenres($id_genre);
            // On affiche la liste de ces mangas
            return view('listeMangas', compact('mangas', 'erreur'));
        } else {
            $erreur = "Il faut sélectionner un genre !";
            Session::put('erreur', $erreur);
            return redirect('/listerGenres');
        }
    }
    
    public function updateManga($id, $erreur = "") {
        $leManga = new Manga();
        $manga = $leManga->getManga($id);
        $genre = new Genre();
        $genres = $genre->getGenres();
        $dessinateur = new Dessinateur();
        $dessinateurs = $dessinateur->getDessinateurs();
        $scenariste = new Scenariste();
        $scenaristes = $scenariste->getScenaristes();
        $titreVue = "Modification d'un Manga";
        // Affiche le formulaire en lui fournissant les données à afficher
        return view('formManga', compact('manga', 'genres', 'dessinateurs',
                'scenaristes', 'titreVue', 'erreur'));
    }
    
    public function validateManga() {
        $id_manga = Request::input('id_manga');
        $id_dessinateur = Request::input('cbDessinateur');
        $prix = Request::input('prix');
        $id_scenariste = Request::input('cbScenariste');
        $titre = Request::input('titre');
        $id_genre = Request::input('cbGenre');
        if(Request::hasFile('couverture')) {
            $image = Request::file('couverture');
            $couverture = $image->getClientOriginalName();
            Request::file('couverture')->move(base_path() . '/public/images/', $couverture);
        } else {
            $couverture = Request::input('couvertureHidden');
        }
        $manga = new Manga();
        try {
            $manga->updateManga($id_manga, $titre, $couverture, $prix,
                    $id_dessinateur, $id_genre, $id_scenariste);
        } catch (Exception $ex) {
            $erreur = $ex->getMessage();
            return $this->updateManga($id_manga, $erreur);
        }
        
        return redirect('/listerMangas');
    }
}
