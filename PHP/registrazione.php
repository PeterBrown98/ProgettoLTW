<?php

        $nome=$_POST["nome"];
        $cognome=$_POST["cognome"];
        $email=$_POST["email"];
        $password=$_POST["psw"];
        $rpassword=$_POST["rpsw"];

        if($password!=$rpassword){
            echo "Le password immesse non coincidono, riprova!";
        }
        else{
            $dbconn = pg_connect("host=localhost port=5433 dbname=prova user=postgres password=2Bistecche!")
                        or die('Could not connect : ' . pg_last_error());
            $query = "insert into utente(nome,cognome,email,password) values (" . $nome . "," . $cognome . "," . $email . "," . $password . ")";
            pg_query($query);
            echo 'Registrazione avvenuta con successo.';
        }

?>




