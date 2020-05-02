
<html">
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5433 dbname=prova user=postgres password=2Bistecche!")
            or die('Could not connect : ' . pg_last_error());
            
            if(!(isset($_POST["email"]))){header("Location: ../index.html");}
            else{
                $email=$_POST['email'];
                $q1="select * from utente where email=$1";
                $result= pg_query_params($dbconn, $q1, array($email));
                
                $nome= $_POST['nome'];
                $cognome= $_POST['cognome'];
                $psw= $_POST['nome'];
                //$rpsw= $_POST['nome'];
                $q2="insert into utente values ($1, $2, $3, $4)";
                $data= pg_query_params($dbconn, $q2, array($nome, $cognome, $email, $psw));
                if($data){
                    echo "<h1> Registrazione completata</h1>";
                }
                else echo "<h1>NON FUNZIONA UN CAZZO AMICI</h1>";
            }
            
            
            
            
            ?>

    </body>
</html>