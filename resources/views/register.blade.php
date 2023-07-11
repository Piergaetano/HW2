<?php 
/*Piergaetano Di Vita O46001380*/


if(Session::get('user_id')){
    return redirect('home');
 }

?>


<html>

    <head>
        <script src="{{ url('JS/signup.js') }}" defer></script>
        <link rel='stylesheet' href="{{ url('Css/signup.css') }}">
    </head>

   
    <body>
    
    <section id="ContenitoreSignUp">
        <h1>Registrati</h1>
        <form name="sign_up" enctype="multipart/form-data" method="post">
                
            @csrf

            @if($error == 'empty_fields')
            <div class='errore'>Compilare tutti i campi</div>
        
            @elseif($error == 'passowords_non_corrispondenti')
            <div class='errore'>Password non corrispondenti</div>
          
            @elseif($error=='Sono richiesti: 1 Maiuscola, 1 Minuscola, min 8 caratteri, un simbolo speciale')
            <div class ='errore'>Sono richiesti: 1 Maiuscola, 1 Minuscola, min 8 caratteri, un simbolo speciale</div>
                   
            @elseif($error == 'utente_esistente')
            <div class='errore'>Utente già esistente</div>
            
            @elseif($error=='Username non valido')
            <div class ='errore'>Username non valido</div>

            @elseif($error=='Email non valida')
            <div class ='errore'>Email non valida</div>

            @elseif($error=='email_esistente')
            <div class ='errore'>Email esistente</div>

            @elseif($error=='L\'immagine non deve avere dimensioni maggiori di 7MB')
            <div class ='errore'>L\'immagine non deve avere dimensioni maggiori di 7MB</div>

            @elseif($error=='Errore nel caricamento del file')
            <div class ='errore'>Errore nel caricamento del file</div>

            @elseif($error=='I formati consentiti sono .png, .jpeg, .jpg e .gif')
            <div class ='errore'>I formati consentiti sono .png, .jpeg, .jpg e .gif</div>
            @endif

            <div id="Nome">
                <label>Nome</label> 
                <input type="text" name="Nome" placeholder="Inserisci il tuo nome" value='{{ old("Nome") }}'>
                <span></span>
            <div>   
            
            <div id="Cognome">  
                <label>Cognome</label>
                <input type="text" name="Cognome" placeholder="Inserisci il tuo cognome" value='{{ old("Cognome") }}'>
                <span></span>
            <div>  
                
            <div id="Nome_utente">  
                <label>Nome utente</label>
                <input type="text" name="Nome_Utente" placeholder="Inserisci il tuo nome utente" value='{{ old("Nome_utente") }}'>
                <span></span>
            <div>    
                
            <div id="Email">  
                <label>Email</label>
                <input type="text" name="Email" placeholder="Inserisci la tua email" value='{{ old("Email") }}'>
                <span></span>
            <div>     
                
            <div id="Password">  
                <label>Password</label>
                <input type="password" name="Password" placeholder="Inserisci la tua password" value='{{ old("Password") }}'>
                <span class="hidden"></span>
            <div>   
                
            <div id="Conferma_Password">
                <label>Conferma Password</label>
                <input type="password" name="Conferma_Password" placeholder="Conferma la tua password" value='{{ old("Conferma_Password") }}'>
                <span></span>
            <div> 
              
            
            <div id="Scegli_Immagine">
                <label>Scegli un'immagine profilo</label>
                <input type="file" name="Immagine_Profilo" accept='.jpg, .jpeg, image/gif, image/png', id="upload_original">
                <span></span>
            <div>


            
        <div class = "pulsanti">
            <div class="submit">
                    <input type='submit' value="Registrati" id="submit">
            </div>

            <div class="submit">
                <a href="{{ url('login') }}" class="submit">Login</a>
            </div>
        </div>
        </form>

    </section>


    </body>



</html>