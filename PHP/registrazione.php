
<html>
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
            or die('Could not connect : ' . pg_last_error());
            
            if(!(isset($_POST["invia"]))){header("Location: ../index.html");}
            else{
                $email=$_POST['email'];
                //essendo email primary key in tabella utente viene restituito, se esiste l'utente con email=$email
                $q1="select * from utente where email=$1"; 
                $result= pg_query_params($dbconn, $q1, array($email));
                //se $line non è vuota si viene invitati a riprovare con un'altra email
                if(($line=pg_fetch_array($result,null,PGSQL_ASSOC))){
                    $message = "Email già utilizzata da un altro utente";

                        echo "<SCRIPT> //not showing me this
                            alert('$message')
                            window.location.replace('../registrazione.html');
                        </SCRIPT>";
                }
                else{
                    $nome= $_POST['nome'];
                    $cognome= $_POST['cognome'];
                    $psw= md5($_POST['psw']);
                    $rpsw= md5($_POST['rpsw']);
                    if($psw!=$rpsw){
                        $message = "Spiacente, le password inserite non coincidono";

                        echo "<SCRIPT> //not showing me this
                            alert('$message')
                            window.location.replace('../registrazione.html');
                        </SCRIPT>";
                    }
                    else{
                        //se la registrazione va a buon fine viene inserita una nuova ennupla in utente
                        $q2="insert into utente values ($1, $2, $3, $4)";
                        $data= pg_query_params($dbconn, $q2, array($nome, $cognome, $email, $psw));


                                                             
                        $file_name="../IMMAGINI/profilo.jpg";
                       


                        $img=fopen($file_name, 'r') or die("cannot read image\n");
                        $data2= fread($img, filesize($file_name));

                        $es_data = pg_escape_bytea($data2);
                        fclose($img);
                        
                        //viene aggiunta una coppia (email,immagine) che rapprenta la relationship utente-immagine
                        $query2 = "insert into images(email, data) values ('$email', '$es_data')";
                        pg_query($dbconn, $query2);

                       

                        if($data){
                        
       
                            $message = "Registrazione effettuata con successo! Esegui il login per accedere al sito";

                            echo "<SCRIPT> //not showing me this
                                alert('$message')
                                window.location.replace('../login.html');
                            </SCRIPT>";



                        }
                        else echo "<h1>Errore</h1>";
                    }
                }
               
            
            }
            
            
            
            
            ?>

    </body>
</html>