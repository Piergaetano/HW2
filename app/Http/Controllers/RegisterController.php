<?php

namespace App\Http\Controllers;
/*Piergaetano Di Vita O46001380*/

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class RegisterController extends BaseController
{
   public function register_form(){

      if(Session::get('user_id')){
         return redirect('home');
      }

      $error = Session::get('error'); //Equivalente alla stringa vuota al primo caricamento
      Session::forget('error');
      return view('register')->with('error', $error);
   }

   public function do_register(){


      if(Session::get('user_id')){
         return redirect('home');
      }

      $user = new User; //Creo l'oggetto utente

      if ( strlen(request('Nome')) == 0 
      || strlen(request('Cognome')) == 0 
      || strlen(request('Nome_Utente')) == 0 
      || strlen(request('Email')) == 0 
      || strlen(request('Password')) == 0
      || strlen(request('Conferma_Password')) == 0){ //Controllo inserimento campi

         Session::put('error', 'empty_fields');
         return redirect('register') -> WithInput();

      };

         //Controllo nome utente
         if( User::where('username', request('Nome_Utente'))->first() ){ //Controllo Username
            Session::put('error','utente_esistente');
            return redirect('register')->withInput();
         }else if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', request('Nome_Utente')) ) {
            Session::put('error','Username non valido');
            return redirect('register') -> WithInput();
         };
         $user -> Username = request('Nome_Utente');


         # EMAIL
         if (!filter_var(request('Email'), FILTER_VALIDATE_EMAIL) ) {
            Session::put('error',"Email non valida");
            return redirect('register') ->WithInput();
            }else if( User::where('Email', request('Email'))->first() ){
            Session::put('error','email_esistente');
            return redirect('register')->withInput();
            };
            $user -> Email = request('Email');


         if( request('Password') != request('Conferma_Password') ){ //Controllo Password
         Session::put('error', 'passowords_non_corrispondenti');
         return redirect('register') -> WithInput();
       }else if( !preg_match( '/(?=.{8})(?=.*[a-z])(?=.*[A-Z])(?=.*[1-9])(?=.*[!@#$%^&*()\-_=+{};:,<.>])/', request("Password")) ) { 
         Session::put('error', 'Sono richiesti: 1 Maiuscola, 1 Minuscola, min 8 caratteri, un simbolo speciale');
         return redirect('register') -> WithInput();
         };
         $password = password_hash( request('Password'), PASSWORD_BCRYPT);
         $user -> Password = $password;
       
  
      $user -> Name = request('Nome');
      $user -> Surname = request('Cognome');
      
   
   # UPLOAD DELL'IMMAGINE DEL PROFILO  
   if ( !Session::has('error') ) { 
      if ( $_FILES['Immagine_Profilo']['size'] != 0 ) {
          $file = $_FILES['Immagine_Profilo'];
          $type = exif_imagetype($file['tmp_name']);
          $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');
          if (isset($allowedExt[$type])) {
              if ($file['error'] === 0) {
                  if ($file['size'] < 7000000) {
                      $fileNameNew = uniqid('', true).".".$allowedExt[$type];
                      $fileDestination = 'assets/fotoprofilo/'.$fileNameNew;
                      $user -> Picture = $fileDestination;
                      move_uploaded_file($file['tmp_name'], $fileDestination);
                  } else {
                      Session::put('error','L\'immagine non deve avere dimensioni maggiori di 7MB');
                  }
              } else {
               Session::put('error','Errore nel caricamento del file');
              }
          } else {
            Session::put('error','I formati consentiti sono .png, .jpeg, .jpg e .gif'); 
          }
      }else{
          echo "Non hai caricato nessuna immagine";
      }
  }else{
      return redirect('register') -> WithInput();
  }
      $user -> Copertina = "assets\fotocopertina\cinema";
      $user -> save();
      Session::put('user_id', $user->id);
      return redirect('/home');
   }

}
