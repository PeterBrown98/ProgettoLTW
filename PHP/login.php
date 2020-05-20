<html">
    <head></head>
    <body>
        <?php
            session_start();
            $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
            or die('Could not connect : ' . pg_last_error());
            
            if(!(isset($_POST["accedi"]))){header("Location: ../index.html");}
            else{
                $email=$_POST['email'];
                $q1="select * from utente where email=$1";
                $result=pg_query_params($dbconn, $q1, array($email));
                if(!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                    echo "<h1> Non sei ancora registrato su Foodream? Nessun problema </h1>
                    <a href=../registrazione2.html>registrati ora</a>";
                }
                else{
                    $password=md5($_POST['password']);
                    $q2="select * from utente where email=$1 and password=$2";
                    $result= pg_query_params($dbconn, $q2, array($email, $password));
                    if(!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                        echo "<h1> Password errata, </h1>
                        <a href=/login.html>riprova</a>";
                    }
                    else{
                        
                         $_SESSION['email'] = $line['email'];
                        
                        
                        $email=$line['email'];
                        /*echo "<a href=/homeUtente.php?email=$email>Premi qui</a> per utilizzare il sito.";*/
                        echo '<script> window.location.href="../homeUtente.php";</script>';

                    }
                }
              
            }
            
            ?>

    </body>
</html>