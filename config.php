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


        if(!(isset($_POST["insert"]))){header("Location: ../profilo.php");}
        else{

            $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
            or die('Could not connect : ' . pg_last_error());

            $file_name=$_FILES["profile_photo"]["tmp_name"];
            $email=$_SESSION['email'];


            $img=fopen($file_name, 'r') or die("cannot read image\n");
            $data= fread($img, filesize($file_name));

            $es_data = pg_escape_bytea($data);
            fclose($img);
            $query=    "update images set data = '$es_data' ";
           // $query = "insert into images(email, data) values ('$email', '$es_data')";
            pg_query($dbconn, $query);

            pg_close($dbconn);
            header("Location: ../profilo.php");



           // $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
          //  or die('Could not connect : ' . pg_last_error());

            //$query2 = "select data from images where email='$email'";
            //$res= pg_query($dbconn, $query2) or die(pg_last_error($dbconn));

           // $data2= pg_fetch_result($res, 'data');
          //  $unes_image = pg_unescape_bytea($data2);

          //  $file_name=$email.".jpg";
          //  $img = fopen($file_name, 'wb') or die("cannot open image\n");
           
          //  fwrite($img, $unes_image) or die ();
         //   fclose($img);
         //   pg_close($dbconn);
         //  echo "<img src='$file_name'>";
            
            

        }

            

?>