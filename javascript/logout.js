function logout(){
    if(confirm("Sei sicuro di voler effettuare il logout?"))window.location.href="/PHP/logout.php";
    else window.location.href=current;
}