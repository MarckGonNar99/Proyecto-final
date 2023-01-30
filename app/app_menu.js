
const tabla_menu = document.querySelector("#lista_platos");
const boton_random=document.querySelector("#receta_alea");
const boton_mias=document.querySelector("#receta_mias");
const boton_like=document.querySelector("#recetas_like");
const guardar=document.querySelector("#guardar");
const formu=document.querySelector("#menu_form")

guardar.disabled=true;

const nuevosValores=(valor)=>{
    const div=document.createElement("div");

    const input_user=document.createElement("input");
    input_user.name="user";
    input_user.type="hidden";
    input_user.value=valor["user"];

    const input_lunes=document.createElement("input");
    input_lunes.name="lunes";
    input_lunes.type="hidden";
    input_lunes.value=valor["lunes"];

    const input_martes=document.createElement("input");
    input_martes.name="martes";
    input_martes.type="hidden";
    input_martes.value=valor["martes"];

    const input_miercoles=document.createElement("input");
    input_miercoles.name="miercoles";
    input_miercoles.type="hidden";
    input_miercoles.value=valor["miercoles"];

    const input_jueves=document.createElement("input");
    input_jueves.name="jueves";
    input_jueves.type="hidden";
    input_jueves.value=valor["jueves"];

    const input_viernes=document.createElement("input");
    input_viernes.name="viernes";
    input_viernes.type="hidden";
    input_viernes.value=valor["viernes"];

    const input_sabado=document.createElement("input");
    input_sabado.name="sabado";
    input_sabado.type="hidden";
    input_sabado.value=valor["sabado"];

    const input_domingo=document.createElement("input");
    input_domingo.name="domingo";
    input_domingo.type="hidden";
    input_domingo.value=valor["domingo"];


    div.appendChild(input_user);
    div.appendChild(input_lunes);
    div.appendChild(input_martes);
    div.appendChild(input_miercoles);
    div.appendChild(input_jueves);
    div.appendChild(input_viernes);
    div.appendChild(input_sabado);
    div.appendChild(input_domingo);

    return div;

}



const nuevoMenu=(plato,enlace)=>{
    const nueva_fila = document.createElement("tr");

    const celda_lunes=document.createElement("td");
    celda_lunes.innerText=plato["lunes"];
    celda_lunes.classList.add("plato");

    const enlace_lunes=document.createElement("a");
    enlace_lunes.innerText="Ver Más";
    enlace_lunes.target="_blank";
    enlace_lunes.href="./ver_receta.php?id_receta="+enlace["e_lunes"];

    const celda_martes=document.createElement("td");
    celda_martes.innerText=plato["martes"];
    celda_martes.classList.add("plato");

    const enlace_martes=document.createElement("a");
    enlace_martes.innerText="Ver Más";
    enlace_martes.target="_blank";
    enlace_martes.href="./ver_receta.php?id_receta="+enlace["e_martes"];

    const celda_miercoles=document.createElement("td");
    celda_miercoles.innerText=plato["miercoles"];
    celda_miercoles.classList.add("plato");

    const enlace_miercoles=document.createElement("a");
    enlace_miercoles.innerText="Ver Más";
    enlace_miercoles.target="_blank";
    enlace_miercoles.href="./ver_receta.php?id_receta="+enlace["e_miercoles"];

    const celda_jueves=document.createElement("td");
    celda_jueves.innerText=plato["jueves"];
    celda_jueves.classList.add("plato");

    const enlace_jueves=document.createElement("a");
    enlace_jueves.innerText="Ver Más";
    enlace_jueves.target="_blank";
    enlace_jueves.href="./ver_receta.php?id_receta="+enlace["e_jueves"];


    const celda_viernes=document.createElement("td");
    celda_viernes.innerText=plato["viernes"];
    celda_viernes.classList.add("plato");

    const enlace_viernes=document.createElement("a");
    enlace_viernes.innerText="Ver Más";
    enlace_viernes.target="_blank";
    enlace_viernes.href="./ver_receta.php?id_receta="+enlace["e_viernes"];


    const celda_sabado=document.createElement("td");
    celda_sabado.innerText=plato["sabado"];
    celda_sabado.classList.add("plato");

    const enlace_sabado=document.createElement("a");
    enlace_sabado.innerText="Ver Más";
    enlace_sabado.target="_blank";
    enlace_sabado.href="./ver_receta.php?id_receta="+enlace["e_sabado"];

    const celda_domingo=document.createElement("td");
    celda_domingo.innerText=plato["domingo"];
    celda_domingo.classList.add("plato");

    const enlace_domingo=document.createElement("a");
    enlace_domingo.innerText="Ver Más";
    enlace_domingo.target="_blank";
    enlace_domingo.href="./ver_receta.php?id_receta="+enlace["e_domingo"];

    nueva_fila.appendChild(celda_lunes);
    celda_lunes.appendChild(enlace_lunes);
    nueva_fila.appendChild(celda_martes);
    celda_martes.appendChild(enlace_martes);
    nueva_fila.appendChild(celda_miercoles);
    celda_miercoles.appendChild(enlace_miercoles);
    nueva_fila.appendChild(celda_jueves);
    celda_jueves.appendChild(enlace_jueves);
    nueva_fila.appendChild(celda_viernes);
    celda_viernes.appendChild(enlace_viernes);
    nueva_fila.appendChild(celda_sabado);
    celda_sabado.appendChild(enlace_sabado);
    nueva_fila.appendChild(celda_domingo);
    celda_domingo.appendChild(enlace_domingo);

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
    const datos_id_receta={
        "e_lunes":datos[0]["id_receta"],
        "e_martes":datos[1]["id_receta"],
        "e_miercoles":datos[2]["id_receta"],
        "e_jueves":datos[3]["id_receta"],
        "e_viernes":datos[4]["id_receta"],
        "e_sabado":datos[5]["id_receta"],
        "e_domingo":datos[6]["id_receta"]
    }
    tabla_menu.innerHTML = "";
    tabla_menu.appendChild(nuevoMenu(datos_menu,datos_id_receta));

    const datos_bd={
        "user":usuario,
        "lunes":datos[0]["id_receta"],
        "martes":datos[1]["id_receta"],
        "miercoles":datos[2]["id_receta"],
        "jueves":datos[3]["id_receta"],
        "viernes":datos[4]["id_receta"],
        "sabado":datos[5]["id_receta"],
        "domingo":datos[6]["id_receta"],
    }
    formu.appendChild(nuevosValores(datos_bd));

    /* BOTON DE GUARDAR */
    guardar.disabled=false;
})

boton_mias.addEventListener("click",async ()=>{
    console.log("popo")
})

boton_like.addEventListener("click",async ()=>{
    console.log("pipi")
})