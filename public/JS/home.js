/*Piergaetano Di Vita O46001380*/       


function onCaricaFilm(anime_json){
   $data = JSON.parse(anime_json);
    
   for (var i=0; i<$data.length; i++){
    const article = document.querySelector("article");
    const contenitore_anime = document.createElement("div");
    contenitore_anime.classList.add('contenitore');

    const title = document.createElement('h3');
    const titoloOriginale = document.createElement('h4');
    const img = document.createElement('img');
    const descrizione = document.createElement('p');

    title.textContent = $data[i].titolo;
    titoloOriginale.textContent = $data[i].titoloOriginale;
    img.src = $data[i].immagine;
    descrizione.textContent = $data[i].descrizione;

    const elimina = document.createElement("div");
    const messaggio = document.createElement('p');
    messaggio.textContent="Cancella";
    elimina.appendChild(messaggio);
    elimina.classList.add("cancella");
    contenitore_anime.appendChild(elimina);

    contenitore_anime.appendChild(title);
    contenitore_anime.appendChild(titoloOriginale);
    contenitore_anime.appendChild(img);
    contenitore_anime.appendChild(descrizione);

    contenitore_anime.style="overflow-y:auto";
    article.appendChild(contenitore_anime);
    contenitore_anime.setAttribute("id", "preferito");
    elimina.addEventListener("click", eliminaPreferito);
    }
}

$.ajax({
    url:"carica_film", 
    type:"get",
    datatype:"json",
    success: function(result){
        onCaricaFilm(result);
    }
});


function eliminaPreferito(event){
    
    const mainDiv = event.target.parentNode.parentNode;

    const var1 = mainDiv.getElementsByTagName('h3');
    const var2 = mainDiv.getElementsByTagName('h4');
    $titolo = var1[0].innerHTML;
    $titoloOriginale = var2[0].innerHTML;

    $.ajax({
        url:"Api_private_gestisci", 
        type:"get",
        datatype:"json",
        data: {
            controllo: "del",
            titolo: $titolo,
            titoloOriginale: $titoloOriginale
        },
        success: function(result){
            mainDiv.remove();
        }
    });
}
