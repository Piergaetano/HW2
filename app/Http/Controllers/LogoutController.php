<?php
/*Piergaetano Di Vita O46001380*/
namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class LogoutController extends BaseController
{

   
   public function effettua_logout(){
        Session::forget('user_id');
        return redirect('login');
   }
}
