<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class Manga extends Model
{
    public function getMangas() {
        $mangas = DB::table('manga')
            ->select('id_manga', 'titre', 'genre.lib_genre', 'dessinateur.nom_dessinateur',
                    'scenariste.nom_scenariste', 'prix')
            ->join('genre', 'manga.id_genre', '=', 'genre.id_genre')
            ->join('dessinateur', 'manga.id_dessinateur', '=', 'dessinateur.id_dessinateur')
            ->join('scenariste', 'manga.id_scenariste', '=', 'scenariste.id_scenariste')
            ->get();
        return $mangas;
    }
    
    public function getMangasGenres($id_genre) {
        $mangas = DB::table('manga')
            ->select('id_manga', 'titre', 'genre.lib_genre', 'dessinateur.nom_dessinateur',
                    'scenariste.nom_scenariste', 'prix')
            ->where('manga.id_genre', '=', $id_genre)
            ->join('genre', 'manga.id_genre', '=', 'genre.id_genre')
            ->join('dessinateur', 'manga.id_dessinateur', '=', 'dessinateur.id_dessinateur')
            ->join('scenariste', 'manga.id_scenariste', '=', 'scenariste.id_scenariste')
            ->get();
        return $mangas;
    }
    
    public function getManga($idManga) {
        $manga = DB::table('manga')
            ->select()
            ->where('id_manga', '=', $idManga)
            ->first();
        return $manga;
    }
    
    public function updateManga($id_manga, $titre, $couverture, $prix,
            $id_dessinateur, $id_genre, $id_scenariste) {
        try {
            DB::table('manga')->where('id_manga', '=', $id_manga)
                    ->update(['id_dessinateur' => $id_dessinateur,
                        'prix' => $prix, 'titre' => $titre, 'couverture' => $couverture,
                        'id_genre' => $id_genre, 'id_scenariste' => $id_scenariste]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function insertManga($titre, $couverture, $prix,
            $id_dessinateur, $id_genre, $id_scenariste) {
        try {
            DB::table('manga')->insert(
                    ['id_dessinateur' => $id_dessinateur,
                    'prix' => $prix, 'titre' => $titre, 'couverture' => $couverture,
                    'id_genre' => $id_genre, 'id_scenariste' => $id_scenariste]
            );
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function deleteManga($id_manga) {
        try {
            DB::table('manga')->where('id_manga', '=', $id_manga)
                    ->delete();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
