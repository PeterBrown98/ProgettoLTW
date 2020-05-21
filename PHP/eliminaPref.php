<?php

           

        $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
        or die('Could not connect : ' . pg_last_error());
        $nome = $_GET['nome'];
        $nome = str_replace("%20", " ", $nome);
        
        $email=$_SESSION['email'];
           
        $query="delete from utric where ricetta= (select id from ricetta where nome='$nome')";
        $res= pg_query($dbconn, $query) or die(pg_last_error($dbconn));
        header("Location: profilo.php");


?>