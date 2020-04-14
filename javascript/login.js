function validaForm(){
    if(document.accesso.username.value==""){alert("È necessario inserire l'username per effettuare il login"); return false;}
    if(document.accesso.password.value==""){alert("È necessario inserire la password per effettuare il login"); return false;}
    return true;
  }
   function access(){if(validaForm()) window.location.href="Homepage.html";}
