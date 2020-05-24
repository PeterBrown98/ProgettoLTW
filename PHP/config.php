<?php

        session_start();

        if (isset( $_SESSION['email'] ) ) {
            // Grab user data from the database using the user_id
            // Let them access the "logged in only" pages
        } else {
            // Redirect them to the login page
            session_destroy();
            header("Location: ../index.html");
        }


        if(!(isset($_POST["insert"]))){header("Location: profilo.php");}
        else{

            $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
            or die('Could not connect : ' . pg_last_error());
            $size=$_FILES["profile_photo"]["size"];
            


            $file_name=$_FILES["profile_photo"]["tmp_name"];
            $size=$file_name["size"];

            


            $filename=$_FILES["profile_photo"]["name"];

            
            $email=$_SESSION['email'];

           
            $allowed = array('jpeg', 'png', 'jpg');
           
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                $message = "File non consentito! Inserire solo formati jpeg, jpg o png";

                echo "<SCRIPT> //not showing me this
                    alert('$message')
                    window.location.replace('../PHP/profilo.php');
                </SCRIPT>";
            }
            else{
            // $size=filesize(realpath($file_name));
            // if($size>8388608){
            //     $message = "File troppo grande";

            //     echo "<SCRIPT> //not showing me this
            //         alert('$message')
            //         window.location.replace('../PHP/profilo.php');
            //     </SCRIPT>";
            // }
            $img=fopen($file_name, 'r') or die("File troppo grosso\n");
           
            

            $data= fread($img, filesize($file_name));
            
            
           

            $es_data = pg_escape_bytea($data);
            fclose($img);
            $query=    "update images set data = '$es_data' ";
            pg_query($dbconn, $query)or die("File troppo grosso\n");

            pg_close($dbconn);
           // header("Location: profilo.php");
            $message = "Immagine salvata con successo!";

            echo "<SCRIPT> //not showing me this
                alert('$message')
                window.location.replace('../PHP/profilo.php');
            </SCRIPT>";

            }

            

        }

            

?>