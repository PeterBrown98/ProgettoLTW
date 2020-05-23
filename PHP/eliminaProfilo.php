<?php

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