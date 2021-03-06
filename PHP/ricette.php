<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Risultati ricerca</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/newstyle.css">
        <style type="text/css"></style>
        <script src="../javascript/logout.js"></script>
        <meta name="viewport" content="width-device-width, initial-scale=1"/>
        <meta name="viewport" content="height=device-height, initial-scale=1"/>  
       
    </head>
    <body>

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
                <li class="nav-item active">
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
    <main>
        
    <?php
                    //comparator per ordinare il risultato in  modo decrescente rispetto al numero di ingredienti in input
                    function cmp($a,$b){
                        if($a[count($a)-3]==$b[count($b)-3]) return 0;
                        return ($a[count($a)-3]<$b[count($b)-3]) ? 1 : -1;
                    }

                    

                    $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
                    or die('Could not connect : ' . pg_last_error());

                    if(!(isset($_POST["cerca"]))) header("Location: ../index.html");
                    else{
                        $i1=$_POST['i1'];
                        $i2=$_POST['i2'];
                        if ($i2=="") $i2="nessun ingrediente selezionato";
                        $i3=$_POST['i3'];
                        if ($i3=="") $i3="nessun ingrediente selezionato";
                        $i4=$_POST['i4'];
                        if ($i4=="") $i4="nessun ingrediente selezionato";
                        $i5=$_POST['i5'];
                        if ($i5=="") $i5="nessun ingrediente selezionato";
                        $i6=$_GET['tipoPiatto'];

                        //seleziona tutte le ricette con  tipo=$i6
                        $query="select * from ricetta where tipo = '$i6'";
                        
                        
                        $result=pg_query($dbconn, $query);
                        $res=array();

                        //array contenente gli ingredienti immessi dall'utente nel form di ricerca
                        $ingr=array($i1, $i2, $i3, $i4, $i5);
                        

                    
                        //per ogni ricetta di tipo $i6 viene generato un array
                        while(($row = pg_fetch_row($result))){
                        
                
                            $cnt=0; //rappresenta il numero di ingredienti comuni a $ingr
                            $contenuti="";//stringa contenente i nomi degli ingredienti comuni a $ingr
                            
                        //l'array contiene tutte le ricette con almeno un ingrediente comune a $ingr
                        foreach($ingr as $i){

                            
                            if(strpos($row[4], $i)!==false) {
                            $cnt++; 
                            $contenuti = $contenuti.$i.", ";
                            }
                        }


                            if($cnt>0){
                                $arr = array();
                                $arr[0] = $row[1]; // nome ricetta
                                $arr[1] = $cnt; // numero ingredienti tra quelli scelti dall'utente
                                $arr[2] = substr($contenuti, 0, -2); // nomi ingredienti tra quelli scelti dall'utente
                                $b = str_replace(" ", "-", $arr[0]);
                                $arr[3] = "<a href=paginaRicetta.php?nome=$b id=redir><button type=submit class=btn-primary id=gotoRecipe>$arr[0]</button></a>"; //pulsante che indirizza l'utente alla pagina della ricetta selezionata
                            array_push($res,$arr); //$arr viene aggiunto a $res
                            }
                        }

                        
                        
                        //ordina $res secondo cmp ovvero in modo decrescente rispetto alla posizione n-3 degli array che contiene
                        usort($res,"cmp");

                        // se $res è vuoto informiamo l'utente che nessuna ricetta corrisponde ai suoi criteri di ricerca
                        if(count($res) == 0){
                            echo "<h1 style = 'color:white; padding:30px;'> Nessuna ricetta trovata per gli ingredienti selezionati</h1><br><br>
                            <h1 style = 'color:white; padding:30px;'> Torna alla <a href='sceltaIngredienti.php?tipoPiatto=$i6'>pagina</a> di scelta degli ingredienti</h1>
                            ";

                        }
                        // altrimenti viene visualizzata una tabella contenente le ricette che rispettano i criteri di ricerca
                        else{
                        echo "<table class='risultati'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th class='valore text-center'>Ricetta</th>";
                        echo "<th class='valore text-center'>Quantità di ingredienti tra quelli cercati</th>";
                        echo "<th class='valore text-center'>Ingredienti tra quelli cercati</th>";
                        echo "<th class='valore text-center'></th>";
                        echo "</tr>";
                        echo "<tr>";
                        foreach($res as $value){
                            $str="";
                            foreach($value as $val) $str= $str . "<td class='elemento text-center'> $val </td>";
                            echo "$str  </tr><tr class='text-center'>";
                        }
                        echo "</tr>";
                        echo "</table>";
                        
                      }
                    }

                    
                ?>
              
    </main>
      
      
      <footer id="sticky-footer" class="py-4  text-white">
        <div class="container text-center">
         Copyright &copy;<script>document.write(new Date().getFullYear());</script>,  Foodream
        </div>
      </footer>
          <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>