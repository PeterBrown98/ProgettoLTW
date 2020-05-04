
<html">
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
            or die('Could not connect : ' . pg_last_error());
            
            if(!(isset($_POST["invia"]))){header("Location: ../index.html");}
            else{
                $email=$_POST['email'];
                $q1="select * from utente where email=$1";
                $result= pg_query_params($dbconn, $q1, array($email));
                if(($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                    echo "<h1> Spiacente, sei già registrato </h1>
                    <a href=../login.html>Clicca qui per effettuare il login</a>";
                }
                else{
                    $nome= $_POST['nome'];
                    $cognome= $_POST['cognome'];
                    $psw= md5($_POST['psw']);
                    $rpsw= md5($_POST['rpsw']);
                    if($psw!=$rpsw){
                        echo "<h1> Spiacente, le password immesse non coincidono </h1>
                        <a href=../registrazione.html>Riprova</a>";
                    }
                    else{
                        $q2="insert into utente values ($1, $2, $3, $4)";
                        $data= pg_query_params($dbconn, $q2, array($nome, $cognome, $email, $psw));
                        if($data){
                            echo "<h1> Registrazione completata clicca</h1> <a href=../login.html>qui</a> per effettuare il login";
                        }
                        else echo "<h1>NON FUNZIONA</h1>";
                    }
                }
               
            
            }
            
            
            
            
            ?>

    </body>
</html>