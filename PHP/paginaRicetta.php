<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <?php
            
            $nome = $_GET['nome'];
            $nome = str_replace("-", " ", $nome);
            echo "<title>$nome</title>";
            
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/newstyle.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
        <style type="text/css"></style>
        <meta name="viewport" content="width-device-width, initial-scale=1"/>
        <meta name="viewport" content="height=device-height, initial-scale=1"/>
        <script src="../javascript/logout.js"></script>
        <script type="text/javascript" src="../javascript/like.js"></script>
       
    </head>
    
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
      ?>

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
                  <a class="nav-link" href="sceltaIngredienti.php?tipoPiatto=Primo" >Primi</a>
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
                  <a class="nav-link" href="javascript: logout()">Logout</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profilo.php">Profilo</a>
                </li>

              </ul>
            </div>
         
        </nav>
      </header>
    <main class="ricetta">

    <?php
           
            
           if(array_key_exists('test',$_POST)){
              testfun();
           }
           
           
           $nome = $_GET['nome'];
           $nome = str_replace("-", " ", $nome);
    
           echo 
            "<div class='nomeRicetta text-center'><span class='recipeName'>$nome</span>
            <div class='checkbox-container'>
            <label class='checkbox-label' for'my-checkbox'>
            <input type='checkbox' id='my-checkbox' onclick='ChangeCheckboxLabel(this)'>
            <span id='my-checkbox-checked' class='checkbox-custom rectangular' style='display:none;'><p class='ckbx'>Rimuovi dai preferiti</p></span>
            <span id='my-checkbox-unchecked' class='checkbox-custom rectangular style='display:inline;'><p class='ckbx'>Aggiungi ai preferiti</p></span>
            </label>


            <script>
            
            function ChangeCheckboxLabel(ckbx)
            {
               var d = ckbx.id;
               if( ckbx.checked )
               {
                  document.getElementById(d+'-checked').style.display = 'inline-block';
                  document.getElementById(d+'-unchecked').style.display = 'none';
               }
               else
               {
                  document.getElementById(d+'-checked').style.display = 'none';
                  document.getElementById(d+'-unchecked').style.display = 'inline-block';
               }
            }
            </script>
            
            
            </div>";
           
           
           echo "<section class= 'ingredienti'>";
             echo "<h2 class='recipeTitle'> <u>Ingredienti</u> </h2></section>";

           $db = pg_connect("host=localhost, port=5433, dbname=dbfoodream user=postgres password=postgres");
           $result = pg_query($db, "select distinct id, descrizione, ingredienti from ricetta where nome = '$nome'");
           
           $ricetta = pg_fetch_row($result);
           $id = $ricetta[0];
           
           $ingredienti = explode('\t',$ricetta[2]);
           foreach($ingredienti as $ingrediente){
             if($ingrediente !==""){
             $ingrediente = str_replace("Di ", "", $ingrediente);
             echo "<li class='ingrediente'> $ingrediente </li>"; 
             }
           }
           echo"</section>";


           echo "<section class='procedimento'>";
           echo "<h2 class='recipeTitle'><u>Procedimento</u></h2>";
           echo"<span class='procedura'>$ricetta[1]</span>"; 
           
           echo"</section>";
          

           function testfun()
           {
             $nome = $_GET['nome'];
             $nome = str_replace("-", " ", $nome);
      
             $dbs = pg_connect("host=localhost, port=5433, dbname=dbfoodream user=postgres password=postgres");
             
             $email= $_SESSION['email'];
            
             
              $queryNome="select * from ricetta where nome = '$nome'";
              $salva=pg_query($dbs, $queryNome);
              $ricetta = pg_fetch_row($salva);
               $querypref="insert into utric(utente, ricetta) values ('$email', '$ricetta[0]')";
             $salvaImmg=pg_query($dbs, $querypref);
           }
         
       
   ?>
    
    
    </main>





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