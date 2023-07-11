<?php 
/*Piergaetano Di Vita O46001380*/


if(Session::get('user_id')){
    return redirect('home');
 }

?>


<html>

    <head>
        <script src="<?php echo e(url('JS/signup.js')); ?>" defer></script>
        <link rel='stylesheet' href="<?php echo e(url('Css/signup.css')); ?>">
    </head>

   
    <body>
    
    <section id="ContenitoreSignUp">
        <h1>Registrati</h1>
        <form name="sign_up" enctype="multipart/form-data" method="post">
                
            <?php echo csrf_field(); ?>

            <?php if($error == 'empty_fields'): ?>
            <div class='errore'>Compilare tutti i campi</div>
        
            <?php elseif($error == 'passowords_non_corrispondenti'): ?>
            <div class='errore'>Password non corrispondenti</div>
          
            <?php elseif($error=='Sono richiesti: 1 Maiuscola, 1 Minuscola, min 8 caratteri, un simbolo speciale'): ?>
            <div class ='errore'>Sono richiesti: 1 Maiuscola, 1 Minuscola, min 8 caratteri, un simbolo speciale</div>
                   
            <?php elseif($error == 'utente_esistente'): ?>
            <div class='errore'>Utente già esistente</div>
            
            <?php elseif($error=='Username non valido'): ?>
            <div class ='errore'>Username non valido</div>

            <?php elseif($error=='Email non valida'): ?>
            <div class ='errore'>Email non valida</div>

            <?php elseif($error=='email_esistente'): ?>
            <div class ='errore'>Email esistente</div>

            <?php elseif($error=='L\'immagine non deve avere dimensioni maggiori di 7MB'): ?>
            <div class ='errore'>L\'immagine non deve avere dimensioni maggiori di 7MB</div>

            <?php elseif($error=='Errore nel caricamento del file'): ?>
            <div class ='errore'>Errore nel caricamento del file</div>

            <?php elseif($error=='I formati consentiti sono .png, .jpeg, .jpg e .gif'): ?>
            <div class ='errore'>I formati consentiti sono .png, .jpeg, .jpg e .gif</div>
            <?php endif; ?>

            <div id="Nome">
                <label>Nome</label> 
                <input type="text" name="Nome" placeholder="Inserisci il tuo nome" value='<?php echo e(old("Nome")); ?>'>
                <span></span>
            <div>   
            
            <div id="Cognome">  
                <label>Cognome</label>
                <input type="text" name="Cognome" placeholder="Inserisci il tuo cognome" value='<?php echo e(old("Cognome")); ?>'>
                <span></span>
            <div>  
                
            <div id="Nome_utente">  
                <label>Nome utente</label>
                <input type="text" name="Nome_Utente" placeholder="Inserisci il tuo nome utente" value='<?php echo e(old("Nome_utente")); ?>'>
                <span></span>
            <div>    
                
            <div id="Email">  
                <label>Email</label>
                <input type="text" name="Email" placeholder="Inserisci la tua email" value='<?php echo e(old("Email")); ?>'>
                <span></span>
            <div>     
                
            <div id="Password">  
                <label>Password</label>
                <input type="password" name="Password" placeholder="Inserisci la tua password" value='<?php echo e(old("Password")); ?>'>
                <span class="hidden"></span>
            <div>   
                
            <div id="Conferma_Password">
                <label>Conferma Password</label>
                <input type="password" name="Conferma_Password" placeholder="Conferma la tua password" value='<?php echo e(old("Conferma_Password")); ?>'>
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
                <a href="<?php echo e(url('login')); ?>" class="submit">Login</a>
            </div>
        </div>
        </form>

    </section>


    </body>



</html><?php /**PATH C:\Users\Pierg\OneDrive\Desktop\xamp\htdocs\app\resources\views/register.blade.php ENDPATH**/ ?>