<?php 

use App\Models\User;
/*Piergaetano Di Vita O46001380*/
 
if(!Session::get('user_id')){
    return redirect('login');
 }
 $Utente = User::where('id', (Session::get('user_id')) )->first();

?>



<html>
    <head>
        <title>L'Angolo del cinema</title>

        <meta charset="utf-8">
        
        <link rel="stylesheet" href="{{ url('Css/profilo.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <script src="{{ url('JS/profilo.js') }}" defer></script>
    </head>
    
    <body>       
        <nav>
            <div id="logo">L'angolo del Cinema</div>
            <div id="links">
                <a href="{{ url('home') }}">Home</a>
                <a href="{{ url('cerca') }}">Cerca</a>
                <a href="{{ url('logout') }}">Logout</a>
            </div>
        </nav>
        <header>
            <div id="overlay"></div>
        </header>

        <div id="profilo">
            <img id="foto" src="<?php echo "$Utente->picture" ?>">
            <div id="nome">
                <strong><?php
                echo "$Utente->name";
                echo " ".$Utente->surname;                
                ?></strong><br>
                <em>Ultimo accesso: <?php echo date("d-m-Y");?></em>
            </div>
        </div>

        <article id="article">

    <div id="contenitoreImpostazioni">
                
                @if($error == "Inserisci la nuova password")
                <div class="errore">Inserisci la nuova password</div>
                @elseif($error == "Inserisci la vecchia password")
                <div class="errore">Inserisci la vecchia password</div>
                @elseif($error == "Inserisci la conferma password")
                <div class="errore">Inserisci la conferma password</div>
                @elseif($error == "Le due password non corrispondono")
                <div class="errore">Le due password non corrispondono</div>
                @elseif($error == "La vecchia password è sbagliata")
                <div class="errore">La vecchia password è sbagliata</div>   
                @endif

                @if(Session::get('Messaggio') == "Password Cambiata")
                <div class='messaggio'>Password modificata</div>
                @endif

                @if(Session::get('Messaggio') == "Immagine Cambiata")
                <div class='messaggio'>Immagine modificata</div>
                @endif

                @if(Session::get('Messaggio') == "Copertina Cambiata")
                <div class='messaggio'>Copertina modificata</div>
                @endif


                @if($error == "Inserisci la nuova password")
                <div class="errore">Inserisci la nuova password</div>
                @elseif($error == "Inserisci la vecchia password")
                <div class="errore">Inserisci la vecchia password</div>
                @elseif($error == "Inserisci la conferma password")
                <div class="errore">Inserisci la conferma password</div>
                @elseif($error == "Le due password non corrispondono")
                <div class="errore">Le due password non corrispondono</div>
                @elseif($error == "La vecchia password è sbagliata")
                <div class="errore">La vecchia password è sbagliata</div>   
                @endif



            <h1>Impostazioni</h1>
            <div id="contenitore_password" class="contenitore">
                <strong>Cambia Password</strong>
            </div>

            <div id="contenitore_immagine" class="contenitore">
                <strong>Cambia immagine</strong>
            </div>
            
            <div id="contenitore_copertina" class="contenitore">
                <strong>Cambia copertina</strong>
            </div>           
    </div>

            <form id="password_form" class="nascondi" method="post" action="profilo_modificaPassword">  
               
                @csrf
                
                <div id = "vecchia" class="interni"> 
                    <p>Inserisci la vecchia password:</p>
                    <input type="password" id="cambia_password" name="vecchia">
                    <span></span>
                </div>
                
                <div id="nuova" class="interni"> 
                    <p>Inserisci la nuova password:</p>
                    <input type="password" id="cambia_password" name="nuova">
                    <span></span>
                </div> 
                
                <div id = "conferma" class="interni">
                    <p>Conferma password:</p>
                    <input type="password" id="cambia_password" name="conferma">
                    <span></span>
                </div>
                <br>

                <div id="submit">
                    <input type="submit" value="Cambia password">
                 </div> 
            </form>




            <form id="immagine_form" class="nascondi" method="post" enctype="multipart/form-data" action="profilo_modificaFoto">
            @csrf
                Sceglie la nuova immagine
                <input type="file" name="Immagine_Profilo" accept='.jpg, .jpeg, image/gif, image/png'>
                <input type="submit" value="Carica">
            </form>



            <form id="copertina_form" class="nascondi" method="post" enctype="multipart/form-data" action="profilo_modificaCopertina">
            @csrf
                Carica la nuova copertina
                <input type="file" name="Immagine_Copertina" accept='.jpg, .jpeg, image/gif, image/png', id="Copertina_text">
                <input type="submit" value="Carica">
            </form>

            <p id="copertina" class="nascondi"><?php echo "$Utente->copertina"; ?></p>
            
            <div id="bottoni">
                <button id="password_reset" class="nascondi">Cambia immagine</button>
                <button id="immagine_reset" class="nascondi">Cambia password</button>
                <button id="copertina_reset" class="nascondi">Cambia copertina</button>
            </div>         
                <div id="immagine"></div>
                <div id="password"></div>
        </article>


    </body>
   
</html>