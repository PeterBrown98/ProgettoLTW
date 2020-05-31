<?php
        // elimina ogni riferimento al profilo da ogni tabella nel database
        session_start();

        if (isset( $_SESSION['email'] ) ) {
           
        } else {
           
            session_destroy();
            header("Location: ../index.html");
        }


        if(!(isset($_POST["delete"]))){header("Location: profilo.php");}
        else{

            $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
            or die('Could not connect : ' . pg_last_error());

            $email=$_SESSION['email'];

            $query1= "delete from utente where email='$email'";
            $query2="delete from utric where utente='$email'";
            $query3="delete from images where email='$email'";

            pg_query($dbconn, $query1);
            pg_query($dbconn, $query2);
            pg_query($dbconn, $query3);

            pg_close($dbconn);
            header("Location: ../index.html");
        }

            

?>