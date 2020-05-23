<html>
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
                    $message = "Email inserita non associata a nessun utente";

                    echo "<SCRIPT> //not showing me this
                        alert('$message')
                        window.location.replace('../login.html');
                    </SCRIPT>";
                }
                else{
                    $password=md5($_POST['password']);
                    $q2="select * from utente where email=$1 and password=$2";
                    $result= pg_query_params($dbconn, $q2, array($email, $password));
                    if(!($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                       
                       
                        $message = 'Password inserita errata';

                        echo "<SCRIPT> //not showing me this
                            alert('$message')
                            window.location.replace('../login.html');
                        </SCRIPT>";
                    }
                    else{
                        
                         $_SESSION['email'] = $line['email'];
                        
                        
                        $email=$line['email'];
                        echo '<script> window.location.href="homeUtente.php";</script>';

                    }
                }
              
            }
            
            ?>
            <script>
            function pswdErr(){
                alert("La password inserita non è corretta");
            }
            </script>

    </body>
</html>