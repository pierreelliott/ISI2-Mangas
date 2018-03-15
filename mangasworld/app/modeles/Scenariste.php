<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use DB;

class Scenariste extends Model
{
    /**
     * Liste des scenaristes
     * @return collection de scenariste
     */
    public function getScenaristes() {
        $scenaristes = DB::table('scenariste')->get();
        return $scenaristes;
    }
}
