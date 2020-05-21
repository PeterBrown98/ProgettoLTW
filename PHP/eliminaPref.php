<?php

           

        $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
        or die('Could not connect : ' . pg_last_error());
        $num = $_GET["nome"];
        $email=$_SESSION['email'];
           
        $query="delete from utric where ricetta='$num'";
        $res= pg_query($dbconn, $query) or die(pg_last_error($dbconn));


?>