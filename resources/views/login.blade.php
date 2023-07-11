<?php 
/*Piergaetano Di Vita O46001380*/


if(Session::get('user_id')){
    return redirect('home');
 }

?>


<html>

    <head>
        <link rel="stylesheet" href="{{ url('Css/login.css') }}">
        <script src="{{ url('JS/login.js') }}" defer></script>
    </head>


    <body>

    <section id="ContenitoreLogin">
          
        <h1>Accedi</h1>
        <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                 echo "<p class='error'>$error</p>";
                }
                
            ?>
        <form name="log_in" method="post">
        
        @csrf
        
            <div id="Nome_utente">  
                <label>Nome utente</label>
                <input type="text" name="Nome_Utente" placeholder="Inserisci il tuo nome utente">
                <span></span>
            <div>     
                
            <div id="Password">  
                <label>Password</label>
                <input type="password" name="Password" placeholder="Inserisci la tua password">
                <span class="hidden"></span>
            <div>   
            

            <div class = "pulsanti">
                
                <div class="submit">
                        <input type='submit' value="Accedi" id="submit">
                </div>

                <div class="submit">
                    <a href='register' class="submit">Registrati</a>
                </div>
            </div>

        </form>

    </section>

    </body>

</html>

