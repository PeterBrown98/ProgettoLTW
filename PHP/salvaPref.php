
<?php
    $dbs = pg_connect("host=localhost, port=5433, dbname=dbfoodream user=postgres password=postgres");             
   
    $nome = $_GET['nome'];
    $nome = str_replace("-", " ", $nome);
  

    $email= $_GET['email'];
    $queryNome="select * from ricetta where nome = '$nome'";
    $salva=pg_query($dbs, $queryNome);
    $ricetta = pg_fetch_row($salva);
    $querypref="insert into utric(utente, ricetta) values ('$email', '$ricetta[0]')";
    $salvaImmg=pg_query($dbs, $querypref);

?>