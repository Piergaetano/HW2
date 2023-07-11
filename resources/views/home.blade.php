<?php 
/*Piergaetano Di Vita O46001380*/

if(Session::get('user_id') == '0')
{
    return redirect('login');
 }

?>

<html>
    <head>
        <title>L'Angolo del cinema</title>

        <meta charset="utf-8">   
        <link rel="stylesheet" href="{{ url('Css/home.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <script src="{{ url('JS/home.js') }}" defer></script>
    </head>
    <body>       

              

        <nav>
            <div id="logo">L'angolo del Cinema</div>
            <div id="links">
                <a href="{{ url('cerca') }}">Cerca</a>
                <a href="{{ url('profilo') }}">Profilo</a>
                <a href="{{ url('logout') }}">Logout</a>
            </div>
        </nav>
        <header>
            <div id="overlay"></div>
        </header>

        <h1>Film da guardare</h1>
        <h3>Aggiungi anime da guardare dalla pagina cerca</h3>
        <article></article>  
    </body>
</html>