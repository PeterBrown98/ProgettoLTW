<!DOCTYPE html>
<html>
    <head>
      <script src="../javascript/logout.js"></script>
        <meta charset="utf-8">
        <title>Profilo Utente</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/newstyle.css">
        <style type="text/css"></style>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
                  <li class="nav-item">
                    <a class="nav-link" href="homeUtente.php">Home </a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="profilo.php">Profilo<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript: logout()">Logout</a>
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

            $file_name="UpdateImmagini/".$email.".jpg";
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
                    <input id='img-prof' type='file' name='profile_photo' value='File' onchange='ValidateSize(this)'>
                    <br>
                    <input type='submit' name='insert' id='img-prof2' value='Carica'>
                  </form>
                  <hr id='hrp'>

                  <form action='eliminaProfilo.php' method='post' enctype='multipart/form-data' onsubmit='return eliminaProfilo();'>
                 
                  <p id='p-prof'> Clicca qui per eliminare il profilo</p> <input type='submit'  name='delete' id='img-prof2' value='Elimina' >
                  </form>

              </div>
              


              </div>



          
            <div class='row'> 
              
            <table class='risultati2' id='tabprefer'>
              <tr>
                <td colspan='3' class='text-center' id='preftitle'> Preferiti</td>
              </tr> 
             
              <tr>
                <th  class='text-center' id='colNom' >Nome ricetta</th> 
                <th  class='text-center' id='colTipo' >Tipo piatto</th> 
                <th  class='text-center' id'colBott' ></th>
              
              </tr>
              <tr>  ";
                while(($row = pg_fetch_row($respref))){
                  $b = str_replace(" ", "-", $row[1]);
                  echo " <tr class='text-center' id='preferiti'> 

                   <td  class= elemento> <a href=../PHP/paginaRicetta.php?nome=$b style='color: black;'>$row[1]</a> </td>
                   
                    <td  class= elemento> $row[2] </td> 
                    <td class= elemento><input id='btnpref' class='btn-danger' type='button' value='Elimina da preferiti' 
                    onclick='elimina(this)'> </td>
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

            <script>
          function ValidateSize(file) {
            var FileSize = file.files[0].size / 1024 / 1024; // in MB
                if (FileSize > 6) {
              alert('Il file supera 6 MB');
              $("#img-prof").replaceWith($("#img-prof").val('').clone(true));
              return false
          
        } 
    }
              
          function elimina(o) {
            if(confirm("Sei sicuro di voler eliminare la ricetta dai preferiti?")){
                var p=o.parentNode.parentNode;
                
                var nome= p.firstElementChild.innerText;
               
                
                // window.location.href="eliminaPref.php?nome=" +nome;
                // p.parentNode.removeChild(p);
               

                $.ajax({
                      url: 'eliminaPref.php',
                      type: 'GET',
                      data: {
                        nome: nome
                      },
                      success: function(msg) {
                        p.parentNode.removeChild(p);
                      }
                  });
            }




          }
          function eliminaProfilo() {
            return confirm("Sicuro di voler eliminare il profilo?");

          }


          
          </script>
          <script  src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="  crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
         
    </body>
</html>