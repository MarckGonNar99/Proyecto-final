
const tabla_menu = document.querySelector("#lista_platos");
const boton_random=document.querySelector("#receta_alea");
const boton_mias=document.querySelector("#receta_mias");
const boton_like=document.querySelector("#recetas_like");

const nuevoMenu=(json)=>{
    const nueva_fila = document.createElement("tr");

    const celda_lunes=document.createElement("td");
    celda_lunes.innerText=json["lunes"];
    celda_lunes.classList.add("text-center");

    const celda_martes=document.createElement("td");
    celda_martes.innerText=json["martes"];
    celda_martes.classList.add("text-center");

    const celda_miercoles=document.createElement("td");
    celda_miercoles.innerText=json["miercoles"];
    celda_miercoles.classList.add("text-center");

    const celda_jueves=document.createElement("td");
    celda_jueves.innerText=json["jueves"];
    celda_jueves.classList.add("text-center");

    const celda_viernes=document.createElement("td");
    celda_viernes.innerText=json["viernes"];
    celda_viernes.classList.add("text-center");

    const celda_sabado=document.createElement("td");
    celda_sabado.innerText=json["sabado"];
    celda_sabado.classList.add("text-center");

    const celda_domingo=document.createElement("td");
    celda_domingo.innerText=json["domingo"];
    celda_domingo.classList.add("text-center");

    nueva_fila.appendChild(celda_lunes);
    nueva_fila.appendChild(celda_martes);
    nueva_fila.appendChild(celda_miercoles);
    nueva_fila.appendChild(celda_jueves);
    nueva_fila.appendChild(celda_viernes);
    nueva_fila.appendChild(celda_sabado);
    nueva_fila.appendChild(celda_domingo);

    return nueva_fila;
}

/* QUE APAREZCA EL MENU UNA VEZ SE HALLA CREADO */


boton_random.addEventListener("click",async ()=>{

    const respuesta=await fetch("menuAleatorio.php");
    const datos = await respuesta.json();

    /* QUEDAN PONER LOS ID PARA CREAR EL ENLACE PARA LLEVARLOS */

    const datos_menu={
        "lunes":datos[0]["nombre"],
        "martes":datos[1]["nombre"],
        "miercoles":datos[2]["nombre"],
        "jueves":datos[3]["nombre"],
        "viernes":datos[4]["nombre"],
        "sabado":datos[5]["nombre"],
        "domingo":datos[6]["nombre"],
    }

    tabla_menu.appendChild(nuevoMenu(datos_menu));

    /* BOTON DE GUARDAR */

})

boton_mias.addEventListener("click",async ()=>{
    console.log("popo")
})

boton_like.addEventListener("click",async ()=>{
    console.log("pipi")
})