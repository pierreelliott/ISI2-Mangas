<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use DB;

class Utilisateur extends Model
{
    /**
     * Authentifie l'utilisateur sur son login et Mdp
     * Si c'est OK, son id est enregistré dans la session
     * Cela lui donne accès au menu général
     * @param string $login : Login de l'utilisateur
     * @param string $pwd : Mdp de l'utilisateur
     * @return boolean : True or false
     */
    public function login($login, $pwd) {
        $connected = false;
        $user = DB::table('user')
                ->select()
                ->where('login', '=', $login)
                ->first();
        if( $user ) {
            // Si mdp saisi est identique à celui enregistré
            if( $user->pwd == $pwd ) {
                Session::put('id', $user->user_id);
                $connected = true;
            }
        }
        return $connected;
    }
    
    /**
     * Délogue l'utilisateur en supprimant son ID
     * de la session => le menu n'est plus accessible
     */
    public function logout() {
        Session::forget('id');
    }
}
