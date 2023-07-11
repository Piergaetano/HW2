<?php

namespace App\Http\Controllers;

/*Piergaetano Di Vita O46001380*/
use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class ProfiloController extends BaseController
{
   
   public function mostra_profilo(){
      $error = Session::get('error');
    
      if(!Session::get('user_id')){
         
         Session::put('error','Devi effettuare l\'accesso');
         return view('login')->with('error', $error);
      }   
      
    $error = Session::get('error'); //Equivalente alla stringa vuota al primo caricamento
    Session::forget('error');
    return view('profilo')->with('error', $error);
   }


   public function modifica_password() {

      if(!strlen(request('vecchia')) == 0){
         if(!strlen(request('nuova')) == 0){
            if(!strlen(request('conferma')) == 0){
               $utente = User::where('id', (Session::get('user_id')) ) ->first();

               if(!password_verify(request('vecchia'), $utente -> password) ){
                  Session::put('error','La vecchia password è sbagliata');
                  return redirect('profilo');
                }else{
                  if(request('nuova') != request('conferma')){
                     Session::put('error','Le due password non corrispondono');
                     return redirect('profilo');
                  }else{
                     $newpassword = password_hash( request('nuova'), PASSWORD_BCRYPT);
                     User::where('id', (Session::get('user_id')) )-> update(['password' => $newpassword]);
                     return redirect('profilo') -> with('Messaggio' , "Password Cambiata");
                  }
               }
            }else{
               Session::put('error',"Inserisci la conferma password");
               return redirect('profilo');
            }
         }else{
            Session::put('error',"Inserisci la nuova password");
            return redirect('profilo');
         }
      }else{
         Session::put('error',"Inserisci la vecchia password");
         return redirect('profilo');
      }
   }


      public function modifica_foto(){
        
         if ($_FILES['Immagine_Profilo']['size'] != 0) {
         $file = $_FILES['Immagine_Profilo'];
         $type = exif_imagetype($file['tmp_name']);
         $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');
         if (isset($allowedExt[$type])) {
             if ($file['error'] === 0) {
                  if ($file['size'] < 7000000) {
                     $fileNameNew = uniqid('', true).".".$allowedExt[$type];
                     $fileDestination = 'assets/fotoprofilo/'.$fileNameNew;
                     move_uploaded_file($file['tmp_name'], $fileDestination);
                     User::where('id', (Session::get('user_id')) )-> update(['picture' =>  $fileDestination]);
                     return redirect('profilo');
                 } else {
                     Session::put('error','L\'immagine non deve avere dimensioni maggiori di 7MB');
                     return redirect('profilo');
                 }
             } else {
                  Session::put('error','Errore nel caricamento del file');
                  return redirect('profilo');
             }
         } else {
               Session::put('error','I formati consentiti sono .png, .jpeg, .jpg e .gif'); 
               return redirect('profilo');
         }
      }else{
         Session::put('error','Non hai caricato nessuna immagine');
         return redirect('profilo');
      }
   }



   public function modifica_copertina(){
   /*Piergaetano Di Vita O46001380*/


    # UPLOAD DELLA COPERTINA

    if ($_FILES['Immagine_Copertina']['size'] != 0) {
        $file = $_FILES['Immagine_Copertina'];
        $type = exif_imagetype($file['tmp_name']);
        $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');
        if (isset($allowedExt[$type])) {
            if ($file['error'] === 0) {
                if ($file['size'] < 7000000) {
                    $fileNameNew = uniqid('', true).".".$allowedExt[$type];
                    $fileDestination = 'assets/fotocopertina/'.$fileNameNew;
                     User::where('id', (Session::get('user_id')) )-> update(['copertina' =>  $fileDestination]);
                     move_uploaded_file($file['tmp_name'], $fileDestination);
                     return redirect('profilo');
                } else {
                  Session::put('error','La copertina non deve avere dimensioni maggiori di 7MB');
                  return redirect('profilo');
                }
            } else {
               Session::put('error','Errore nel caricamento del file');
               return redirect('profilo');
            }
        } else {
            Session::put('error','I formati consentiti sono .png, .jpeg, .jpg e .gif'); 
            return redirect('profilo');
        }
    }else{
      Session::put('error','Non hai caricato nessuna immagine');
      return redirect('profilo');     
    }
   }



}