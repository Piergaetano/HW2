<?php
/*Piergaetano Di Vita O46001380*/

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
use App\Models\Anime;

class CollectionController extends BaseController
{
   public function mostra_home(){
      if(!Session::get('user_id')){     
         $error = Session::get('error'); //Equivalente alla stringa vuota al primo caricamento
         Session::forget('error');
         return view('login')->with('error', $error);
      }
      return view('home');
   }


   public function carica_film(){
      $utente = User::where('id', Session::get('user_id')) -> first();
      $username = $utente -> username;
      $anime = Anime::join('animepreferite','Anime.id','=', 'animepreferite.id_anime')
                      ->where('animepreferite.utente','=', $username)->get();
      echo $anime;
         }
      

}
