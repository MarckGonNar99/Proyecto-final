/* ****************************************
    Todas los eventos y usos de js en
    la aplicación se encuentran aquí
    diferenciandos y clasificandolos
    por la página en la que se usen
    para mantener un orden y ser preciso
********************************************* */
/* FORMULARIOS */
    //Formularios de recetas
const si_alergia = document.querySelector("#si");
const no_alergia = document.querySelector("#no");
const alergeno_input = document.querySelector("#alergeno");

no_alergia.addEventListener("click",()=>{
    alergeno_input.disabled=true;
    alergeno_input.required= 'false';
})

si_alergia.addEventListener("click",()=>{
    alergeno_input.disabled=false;
    alergeno_input.required= 'true';
})


