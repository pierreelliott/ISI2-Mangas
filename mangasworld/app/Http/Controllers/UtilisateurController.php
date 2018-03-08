<?php

namespace App\Http\Controllers;

use Request;
use App\modeles\Utilisateur;

class UtilisateurController extends Controller
{
    /**
     * Initialise le formulaire d'authentification
     * @return Vue formLogin
     */
    public function getLogin() {
        $erreur = "";
        return view('formLogin', compact('erreur'));
    }
    
    /**
     * Authentifie l'utilisateur
     * @return Vue formLogin ou home
     */
    public function signIn() {
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        $utilisateur = new Utilisateur();
        $connected = $utilisateur->login($login, $pwd);
        if($connected) {
            return view('home');
        } else {
            $erreur = "Login ou mot de passe erroné !";
            return view('formLogin', compact('erreur'));
        }
    }
}
