function autoCompletar(arreglo){
    const inputtxtBuscar = document.querySelector("#txtBuscar");
    let indexFocus = -1;

    inputtxtBuscar.addEventListener("input", function(){
        const busqueda = this.value;
        
        if(!busqueda) return false

        cerrarLista();

        //crear lista de sugerencias
        const divList =document.createElement("div");
        divList.setAttribute("id", this.id + "-listaAutocompletar");
        divList.setAttribute("class", "listaAutoCompletarItems");
        this.parentNode.appendChild(divList);

        //validar arrego contra imput
        if(arreglo.length == 0) return false;
        arreglo.forEach(item => {
            if(item.substr(0, busqueda.length) == busqueda){
                const elementoLista = document.createElement("div");
                elementoLista.innerHTML = `<strong>${item.substr(0, busqueda.length)}</strong>${item.substr(busqueda.length)}`;
                elementoLista.addEventListener("click", function(){
                    inputtxtBuscar.value = this.innerText;
                    cerrarLista();
                    return false;
                })
                divList.appendChild(elementoLista);
            }
        });
    })

    inputtxtBuscar.addEventListener("keydown", function(e){
        const divList = document.querySelector("#" + this.id + "-listaAutocompletar");
        let items;
        if(divList){
            items = divList.querySelectorAll("div");
            switch(e.keycode){
                case 40:    //tecla abajo
                    indexFocus++;
                    if(indexFocus>items.length-1) indexFocus = items.length-1;
                break;
                case 38:    //tecla arriba
                    indexFocus--;
                    if(indexFocus<0) indexFocus = 0;
                break;
                case 13:    //enter
                    e.preventDefault();
                    items[indexFocus].click();
                    indexFocus = -1;
                break;
                default:
                break;
            }

            seleccionar(items, indexFocus);
            return false;
        }
    })
}

function seleccionar(items, indexFocus){
    if(!items || indexFocus == -1) return false;
    items.forEach(x => {x.classList.remove("autocompletarActive")});
    items[indexFocus].classList.add("autocompletarActive");
}

function cerrarLista(){
    const items = document.querySelectorAll(".listaAutoCompletarItems");
    items.forEach(item => {
        item.parentNode.removeChild(item);
    });
    indexFocus = -1;
}

autoCompletar(["perro", "sapo", "gato", "pato", "pez", "paloma", "conejo"])