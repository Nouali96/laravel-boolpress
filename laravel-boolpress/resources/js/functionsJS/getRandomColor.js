
// inizio gestione color badge diversi
// resources/views/admin/posts/show.blade.php
// resources/views/admin/tags/show.blade.php

    for(let i=0; i< document.getElementsByClassName("mJS_badge_color").length; i++){
        const badge_color = document.getElementsByClassName("mJS_badge_color")[i];

        const randomColor = getRandomColor();
        badge_color.style.backgroundColor = randomColor;

    }
// fine gestione color badge diversi




// ----------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------


// inizio funzione getRandomColor()
// la funzione getRandomColor ritorna un colore random

export function getRandomColor(){

        const array = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];

        let color = "#";
        for(let i=0; i<6; i++){
            color += array[Math.floor(Math.random() * 16)]
        }

        return color;

    }
// fine funzione getRandomColor()