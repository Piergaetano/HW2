<?php
/*Piergaetano Di Vita O46001380*/
namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class LoginController extends BaseController
{

   
   public function mostra_login(){
      if(!Session::get('user_id')){     

         $error = Session::get('error'); //Equivalente alla stringa vuota al primo caricamento
         Session::forget('error');
         return view('login')->with('error', $error);
      
   }else{
         return redirect('home');
      }
   }


   public function effettua_login(){

      if(Session::get('user_id')){
         return redirect('home');
      }

      if(strlen(request('Nome_Utente')) == 0 || strlen(request('Password')) == 0){
         Session::put('error', 'Riempi entrambi i campi');
         return redirect('login') -> withInput();
      }

      $utente = User::where('Username', request('Nome_Utente')) ->first();

      if(!$utente || !password_verify(request('Password'), $utente -> password) ){
        Session::put('error','Utente o password sbagliate');
        return redirect('login');
      }else{
         Session::put('user_id', $utente->id);
         return redirect('home');
      }
   }

}
