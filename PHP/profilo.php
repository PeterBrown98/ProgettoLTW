<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home Utente</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/newstyle.css">
        <style type="text/css"></style>
        <meta name="viewport" content="width-device-width, initial-scale=1"/>
        <meta name="viewport" content="height=device-height, initial-scale=1"/>  
       
    </head>
    <body id="body-profilo">
      <header>
        <nav class="navbar navbar-ficed-top navbar-expand-lg  navbar-dark " id="navbar">
            
              <a class="navbar-brand" href="#">
                <img src="../IMMAGINI/foodream2.png" width="70" height="50" class="d-inline-block align-top" alt="">
              </a>
               
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="homeUtente.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="sceltaIngredienti.php?tipoPiatto=Primo">Primi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="sceltaIngredienti.php?tipoPiatto=Secondo">Secondi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="sceltaIngredienti.php?tipoPiatto=Contorno">Contorni</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="sceltaIngredienti.php?tipoPiatto=Dessert">Dolci</a>
                  </li>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profilo.php">Profilo</a>
                  </li>
  
                </ul>
              </div>
           
          </nav>
        </header>
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
            
        $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
        or die('Could not connect : ' . pg_last_error());

        $email=$_SESSION['email'];
        $q1="select * from utente where email=$1";
        $result= pg_query_params($dbconn, $q1, array($email));
        $line=pg_fetch_array($result,null,PGSQL_ASSOC);


        $pref="select * from ricetta where id in(select ricetta from utRic where utente='$email')";
        $respref=pg_query($dbconn, $pref);


        $query2 = "select data from images where email='$email'";
            $res= pg_query($dbconn, $query2) or die(pg_last_error($dbconn));

            $data2= pg_fetch_result($res, 'data');
            $unes_image = pg_unescape_bytea($data2);

            $file_name=$email.".jpg";
            $img = fopen($file_name, 'wb') or die("cannot open image\n");
           
            fwrite($img, $unes_image) ;
         
        
            fclose($img);
            pg_close($dbconn);
        
           
        
        echo "<main id='main-profilo'>
          <div class='container' id='cont-profilo'>
            <div class='row'>
              <div class='col-md-6' id='col-p1'>
              
               
              <img  src='$file_name' id='profile-image' class='center'> 
               
                
              </div>



              <div class='col-md-6' id='col-p2'>

                <div class='col-md-8 col-xs-12 col-sm-6 col-lg-8' ></div>
                  <div class='container' >
                    <h2 id='p-prof'>Profilo Utente</h2>
                   
                  
                   
                  </div>
                  <hr id='hrp'>
                 
                   <p id='p-prof'>Nome: ".$line['nome']." </p>
                  <p id='p-prof'>Cognome: ".$line['cognome']."</p>
                  <p  id='p-prof'>Email: ".$email."</p>
                 
                 
                  <hr id='hrp'>
                  <form action='config.php' method='post' enctype='multipart/form-data'>
                    <input id='img-prof' type='file' name='profile_photo' value='File'>
                    <br>
                    <input type='submit' name='insert' id='img-prof2'>
                  </form>
              </div>
              


              </div>



          
            <div class='row'> 
              
            <table class=risultati2>
              <tr>
                <td colspan='3' class='text-center' id='preftitle'> Lista ricette</td>
              </tr> 
             
              <tr>
                <th  class='text-center' id='colNom' >Nome ricetta</th> 
                <th  class='text-center' id='colTipo' >Tipo piatto</th> 
                <th  class='text-center' id'colBott' ></th>
              
              </tr>
              <tr>  ";
                while(($row = pg_fetch_row($respref))){
                  echo " <tr class='text-center' id='preferiti'> 
                   <td  class= elemento> $row[1] </td>
                    <td  class= elemento> $row[2] </td> 
                    <td  class= elemento> Bottone </td>
                  </tr> ";

              }
   
   
   
             echo "
             </tr>     </table>   
                 </div> 
             </div>
          </div>
          
        </main>"
       ?>

      <footer id="sticky-footer" class="py-4  text-white">
        <div class="container text-center">
         Copyright &copy;<script>document.write(new Date().getFullYear());</script>,  Foodream
        </div>
      </footer>
    
  
        
        
          <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
          <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
          <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
          <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
          <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>