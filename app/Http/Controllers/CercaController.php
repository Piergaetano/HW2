<?php


/*Piergaetano Di Vita O46001380*/


/*Qui implemento lato server quell'api che richiede l'utilizzo di credenziali segrete*/

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
use App\Models\Anime;
use App\Models\animepreferites;

class CercaController extends BaseController
{
   public function Mostra_Cerca(){
    if(Session::get('user_id') == '0'){
        $error = Session::get('error');
        Session::put('error','Devi effettuare l\'accesso');
        return view('login')->with('error', $error);
     } 
    return view('cerca');
   }

    public function cerca_anime(){

        $token;
        $email = 'piergaetano97.97@gmail.com';
        $password = '123ciao45'; 
        
        $header = array("Content-Type" => "application/x-www-form-urlencoded");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,'https://kitsu.io/api/oauth/token');
        curl_setopt($curl, CURLOPT_POST,1);
        curl_setopt($curl, CURLOPT_POSTFIELDS,"grant_type=password&username=$email&password=$password");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        $token=json_decode(curl_exec($curl), true);
        curl_close($curl);
        
        $header2 = array(
            'Accept' => 'application/vnd.api+json',
            'Authorization:' => $token['token_type'].''.$token['access_token'],
            'Content-Type' => 'application/x-wwwform-urlencoded'
        );
        
        $curl2 = curl_init();
        curl_setopt($curl2, CURLOPT_URL,'https://kitsu.io/api/edge/anime?filter[text]'.$_GET['valore']);
        curl_setopt($curl2, CURLOPT_HTTPHEADER, $header2);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER,1);
        $json=curl_exec($curl2);
        curl_close($curl2);
        
        echo $json;
    }

    public function gestisci_preferiti(){
       
        /*
        $_GET['controllo'] = add aggiungi
        $_GET['controllo'] = check controlla
        $_GET['controllo'] = del cancella
        */

        if($_GET['controllo'] == "check"){
            $titolo = $_GET['titolo'];
            $titoloOriginale = $_GET['titoloOriginale'];
            $utente = User::where('id', Session::get('user_id')) ->first();
            
            $preferito = Anime::where('users.username', $utente -> username)
            -> join('animepreferite','Anime.id', '=','animepreferite.id_anime')
            -> join('users', 'animepreferite.utente', '=', 'users.username')
            -> where('anime.titolo', $titolo) ->where('anime.titoloOriginale',$titoloOriginale)
            -> first();

            if(strlen($preferito) == '0'){
              echo json_encode("Non trovato");  
            } else {
              echo json_encode("Trovato");       
            }
        }
    
    

        if($_GET['controllo'] == "add") {
    
        $titolo = $_GET['titolo'];
        $titoloOriginale = $_GET['titoloOriginale'];
        $immagine = $_GET['immagine'];
        $descrizione = $_GET['descrizione'];

        $preferito = Anime::where('titolo', $titolo) -> first();

        if(strlen($preferito) == '0'){
            $anime = new Anime;
            $anime -> titolo = $titolo;
            $anime -> titoloOriginale = $titoloOriginale;
            $anime -> immagine = $immagine;
            $anime -> descrizione = $descrizione;
            $anime -> save();
            $id = $anime -> id;
        }else{
            $id = $preferito -> id;
        }

        $utente = User::where('id', Session::get('user_id')) -> first();
        $username = $utente -> username;

        $animePreferita = new animepreferites;
        $animePreferita -> utente = $username;
        $animePreferita -> id_anime = $id;
        $animePreferita -> save();

        echo json_encode("Ok");
        }

        if($_GET['controllo'] == "del") {
            $titolo = $_GET['titolo'];
            $titoloOriginale = $_GET['titoloOriginale'];
            
            
            $utente = User::where('id', Session::get('user_id')) ->first();
            
            $preferito = Anime::where('titolo', $titolo) 
            -> where('titoloOriginale', $titoloOriginale)
            -> join('animepreferite','Anime.id', '=','animepreferite.id_anime')
            -> first();

            animepreferites::where('id_anime', $preferito -> id)
            ->where('utente', $utente -> username) -> delete();
            echo json_encode("Ok");
            } 
    }
}







