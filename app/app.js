/* ****************************************
    Todas los eventos y usos de js en
    la aplicación se encuentran aquí
    diferenciandos y clasificandolos
    por la página en la que se usen
    para mantener un orden y ser preciso
********************************************* */


/* FORMULARIOS */
    //Formularios de recetas

if(pagina=="mi_perfil"){
  const tarjeta=document.querySelectorAll(".tarjeta_receta");
  tarjeta.forEach(
    (item)=>{
      item.addEventListener("mouseover",()=>{
        var categoria=item.querySelector("h6");
        if(categoria.innerHTML=="Carnes y aves"){
          item.classList.add("carne");
        }else if(categoria.innerHTML=="Sopas, cremas y cocidos"){
          item.classList.add("sopa");
        }else if(categoria.innerHTML=="Arroz"){
          item.classList.add("arroz");
        }else if(categoria.innerHTML=="Verduras y legumbres"){
          item.classList.add("verdura");
        }else if(categoria.innerHTML=="Pescado y mariscos"){
          item.classList.add("pescado");
        }else if(categoria.innerHTML=="Pastas"){
          item.classList.add("pasta");
        }
      })
    }
  )
  tarjeta.forEach(
    (item)=>{
      item.addEventListener("mouseleave",()=>{
        var categoria=item.querySelector("h6");
        if(categoria.innerHTML=="Carnes y aves"){
          item.classList.remove("carne");
        }else if(categoria.innerHTML=="Sopas, cremas y cocidos"){
          item.classList.remove("sopa");
        }else if(categoria.innerHTML=="Arroz"){
          item.classList.remove("arroz");
        }else if(categoria.innerHTML=="Verduras y legumbres"){
          item.classList.remove("verdura");
        }else if(categoria.innerHTML=="Pescado y mariscos"){
          item.classList.remove("pescado");
        }else if(categoria.innerHTML=="Pastas"){
          item.classList.remove("pasta");
        }
      })
    }
  )

}else if(pagina=="crear_receta"){
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
}else if(pagina=="ver_receta"){
  const ingredientes = document.querySelector(".ingre");
  ingredientes.addEventListener("mouseover",()=>{
    ingredientes.classList.add("ingrediente");
  });
  ingredientes.addEventListener("mouseleave",()=>{
    ingredientes.classList.remove("ingrediente");
  });
  const pasos = document.querySelector(".ps");
  pasos.addEventListener("mouseover",()=>{
    pasos.classList.add("pasos");
  });
  pasos.addEventListener("mouseleave",()=>{
    pasos.classList.remove("pasos");
  });

}else if(pagina=="index"){
  const tarjeta=document.querySelectorAll(".tarjeta_receta");
  tarjeta.forEach(
    (item)=>{
      item.addEventListener("mouseover",()=>{
        var categoria=item.querySelector("h6");
        if(categoria.innerHTML=="Carnes y aves"){
          item.classList.add("carne");
        }else if(categoria.innerHTML=="Sopas, cremas y cocidos"){
          item.classList.add("sopa");
        }else if(categoria.innerHTML=="Arroz"){
          item.classList.add("arroz");
        }else if(categoria.innerHTML=="Verduras y legumbres"){
          item.classList.add("verdura");
        }else if(categoria.innerHTML=="Pescado y mariscos"){
          item.classList.add("pescado");
        }else if(categoria.innerHTML=="Pastas"){
          item.classList.add("pasta");
        }
      })
    }
  )
  tarjeta.forEach(
    (item)=>{
      item.addEventListener("mouseleave",()=>{
        var categoria=item.querySelector("h6");
        if(categoria.innerHTML=="Carnes y aves"){
          item.classList.remove("carne");
        }else if(categoria.innerHTML=="Sopas, cremas y cocidos"){
          item.classList.remove("sopa");
        }else if(categoria.innerHTML=="Arroz"){
          item.classList.remove("arroz");
        }else if(categoria.innerHTML=="Verduras y legumbres"){
          item.classList.remove("verdura");
        }else if(categoria.innerHTML=="Pescado y mariscos"){
          item.classList.remove("pescado");
        }else if(categoria.innerHTML=="Pastas"){
          item.classList.remove("pasta");
        }
      })
    }
  )

  /* LAS COOKIES */
  const cookies=document.querySelector(".cookie-container");
  const boton=document.querySelector(".boton_acepto");
  boton.addEventListener("click",()=>{
    cookies.classList.add("activo");
    localStorage.setItem("cookies","true");
  });
  if(localStorage.getItem("cookies")){
    cookies.classList.add("activo");
  }

  setTimeout(
    ()=>{
      if(!localStorage.getItem("cookies")){
        cookies.classList.remove("activo");
      }
    },2000
  );
}else if(pagina=="iniciar_sesion"){
  /* MENSAJE DE ERROR */
  if(error==1){
    const pass=document.querySelector("#pass");
    let texto_error=document.createElement("h6");
    texto_error.innerText="Hay algo mal";
    pass.after(texto_error);
  }
}else if(pagina=="recetas"){
  const tarjeta=document.querySelectorAll(".tarjeta_receta");
  tarjeta.forEach(
    (item)=>{
      item.addEventListener("mouseover",()=>{
        var categoria=item.querySelector("h6");
        if(categoria.innerHTML=="Carnes y aves"){
          item.classList.add("carne");
        }else if(categoria.innerHTML=="Sopas, cremas y cocidos"){
          item.classList.add("sopa");
        }else if(categoria.innerHTML=="Arroz"){
          item.classList.add("arroz");
        }else if(categoria.innerHTML=="Verduras y legumbres"){
          item.classList.add("verdura");
        }else if(categoria.innerHTML=="Pescado y mariscos"){
          item.classList.add("pescado");
        }else if(categoria.innerHTML=="Pastas"){
          item.classList.add("pasta");
        }
      })
    }
  )
  tarjeta.forEach(
    (item)=>{
      item.addEventListener("mouseleave",()=>{
        var categoria=item.querySelector("h6");
        if(categoria.innerHTML=="Carnes y aves"){
          item.classList.remove("carne");
        }else if(categoria.innerHTML=="Sopas, cremas y cocidos"){
          item.classList.remove("sopa");
        }else if(categoria.innerHTML=="Arroz"){
          item.classList.remove("arroz");
        }else if(categoria.innerHTML=="Verduras y legumbres"){
          item.classList.remove("verdura");
        }else if(categoria.innerHTML=="Pescado y mariscos"){
          item.classList.remove("pescado");
        }else if(categoria.innerHTML=="Pastas"){
          item.classList.remove("pasta");
        }
      })
    }
  )
}else if(pagina=="contraseña"){
  const caja=document.querySelector("#ver");
  const input=document.querySelector("#contraseña");
  caja.addEventListener("click",()=>{
    let check=caja.checked;
    if(check==true){
      input.type="text";
    }else if(check==false){
      input.type="password";
    }
  })
}




