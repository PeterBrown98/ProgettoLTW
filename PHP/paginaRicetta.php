<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <?php
            
            $nome = $_GET['nome'];
            $nome = str_replace("-", " ", $nome);
            echo "<title>$nome</title>";
            
        ?>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/newstyle.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
        <style type="text/css"></style>
        <meta name="viewport" content="width-device-width, initial-scale=1"/>
        <meta name="viewport" content="height=device-height, initial-scale=1"/>
        <script src="../javascript/logout.js"></script>
      
    </head>
    
    <?php
        session_start();

        if (isset( $_SESSION['email'] ) ) {
        } else {
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
                <li class="nav-item">
                  <a class="nav-link" href="homeUtente.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profilo.php">Profilo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="javascript: logout()">Logout</a>
                </li>
                

              </ul>
            </div>
         
        </nav>
      </header>
    <main class="ricetta">
   

    <?php
            $db = pg_connect("host=localhost, port=5433, dbname=dbfoodream user=postgres password=postgres");
            $result = pg_query($db, "select distinct id, descrizione, ingredienti from ricetta where nome = '$nome'");
           
            $ricetta = pg_fetch_row($result);
            $id = $ricetta[0];
            $email= $_SESSION['email'];

            $querCheck="select ricetta from utric where utente='$email' and ricetta='$id'";
            $checkres=pg_query($db, $querCheck);
            $x=true;
            if(pg_num_rows($checkres)==0){
              $x=false;
            }
           $nome = $_GET['nome'];
           $nome = str_replace("-", " ", $nome);
    
           echo 
            "<span class='recipeName'>$nome</span>
            <div class='checkbox-container'>
            ";
            
            if(!$x){
              echo "<label class='checkbox-label' for'my-checkbox'>
              <input type='checkbox' id='my-checkbox' onclick='ChangeCheckboxLabel(this)'> 
              <span id='my-checkbox-checked' class='checkbox-custom rectangular' style='display:none;'><p class='ckbx'>Rimuovi dai preferiti</p></span>
              <span id='my-checkbox-unchecked' class='checkbox-custom rectangular' style='display:inline;' ><p class='ckbx'>Aggiungi ai preferiti</p></span>
              </label>";
  
            }
            else {
              echo "<label class='checkbox-label' for'my-checkbox'>
              <input type='checkbox' id='my-checkbox' onclick='ChangeCheckboxLabel(this)' checked>
               <span id='my-checkbox-checked' class='checkbox-custom rectangular' style='display:inline;'><p class='ckbx'>Rimuovi dai preferiti</p></span>
              <span id='my-checkbox-unchecked' class='checkbox-custom rectangular' style='display:none;'><p class='ckbx'>Aggiungi ai preferiti</p></span>
              </label>";
  
            }
            echo"</div>";

          echo"

            <script>
            
            function ChangeCheckboxLabel(ckbx)
            {
               var d = ckbx.id;
               if( ckbx.checked )
               {

                  document.getElementById(d+'-checked').style.display = 'inline';
                  document.getElementById(d+'-unchecked').style.display = 'none';
                  salva('$nome', '$email');
               }
               else
               {

                  document.getElementById(d+'-checked').style.display = 'none';
                  document.getElementById(d+'-unchecked').style.display = 'inline';
                  elimina('$nome');
               }
            }

            function salva(nome, email){
              $.ajax({
                url: 'salvaPref.php',
                type: 'GET',
                data: {
                  nome: nome,
                  email: email
                 
                },
                success: function() {
                }
              });
            }
            function elimina(nome){
              $.ajax({
                url: 'eliminaPref.php',
                type: 'GET',
                data: {
                  nome: nome
                },
                success: function() {
                }
              });
            }


            </script>";
           
           
           echo "<section class= 'ingredienti'>";
             echo "<h2 class='recipeTitle'> <u>Ingredienti</u> </h2></section>";

          
       
           
           $ingredienti = explode('\t',$ricetta[2]);
           foreach($ingredienti as $ingrediente){
             if($ingrediente !==""){
             $ingrediente = str_replace("Di ", "", $ingrediente);
             echo "<li class='ingrediente'> $ingrediente </li>"; 
             }
           }
     


           echo "<section class='procedimento'>";
           echo "<h2 class='recipeTitle'><u>Procedimento</u></h2>";
           echo"<span class='procedura'>$ricetta[1]</span>"; 
           
           echo"</section>";
   
       
   ?>
    
    
    </main>





        <footer id="sticky-footer" class="py-4  text-white">
        <div class="container text-center">
         Copyright &copy;<script>document.write(new Date().getFullYear());</script>,  Foodream
        </div>
      </footer>
    
  
        

      <script  src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="  crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
         
    </body>
</html>