// inizio gestione della conferma di eliminazione
// resources/views/admin/posts/index.blade.php
// resources/views/admin/categories/index.blade.php
// resources/views/admin/tags/index.blade.php

    const buttons = document.getElementsByClassName("mJS_deleteButton");
    const title = document.getElementById("mJS_modelTitle");
    const form = document.getElementById("mJS_form");


    for(let i=0; i<buttons.length; i++){
        const button = buttons[i];
        const array = JSON.parse(button.value);

        button.addEventListener("click", function(e){

            if(array.type == "posts"){
                title.innerHTML = `Confermi di eliminare <strong>${array.title}</strong>?`
            }else if(array.type == "categories" || array.type == "tags"){
                title.innerHTML = `Confermi di eliminare <strong>${array.name}</strong>?`
            }
        
            form.action = window.location.href + `/${array.id}`;
        });
    }


// fine gestione della conferma di eliminazione


// ----------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------