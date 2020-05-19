<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home Utente</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/newstyle.css">
        <style type="text/css"></style>
        <meta name="viewport" content="width-device-width, initial-scale=1"/>
        <meta name="viewport" content="height=device-height, initial-scale=1"/>  
       
    </head>
    <body id="body-profilo">
      <header>
        <nav class="navbar navbar-ficed-top navbar-expand-lg  navbar-dark " id="navbar">
            
              <a class="navbar-brand" href="#">
                <img src="IMMAGINI/foodream2.png" width="70" height="50" class="d-inline-block align-top" alt="">
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
                    <a class="nav-link" >Primi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" >Secondi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" >Contorni</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" >Dolci</a>
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
        <main>
                <?php
                    //comparator per ordinare il risultato in  modo decrescente rispetto al numero di ingredienti in input
                    function cmp($a,$b){
                        if($a[count($a)-1]==$b[count($b)-1]) return 0;
                        return ($a[count($a)-1]<$b[count($b)-1]) ? 1 : -1;
                    }

                    //verifica che $var sia un ingrediente in input
                    function countInput($var,$a,$b,$c,$d,$e) {
                        $cont=0;
                        $i=0;
                        while($i<count($var)) {
                            similar_text($var[$i],$a,$percent1);
                            similar_text($var[$i],$b,$percent2);
                            similar_text($var[$i],$c,$percent3);
                            similar_text($var[$i],$d,$percent4);
                            similar_text($var[$i],$e,$percent5);
                            if (($percent1>=60)|| ($percent2>=60)||($percent3>=60)||($percent4>=60)||($percent5>=60)) $cont++;
                            $i++;
                        }
                        return $cont;
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
                        $i6='Primo';
                        //$query1="select nome from ingrediente where nome like '$i1%' or nome like '$i2%' or nome like '$i3%' or nome like '$i4%' or nome like '$i5%'";
                        $query="select * from ricetta where tipo = '$i6'";
                        
                        //$ingredienti=pg_query($dbconn, $query1);
                        $result=pg_query($dbconn, $query);
                        $res=array();
                        $ingr=array($i1, $i2, $i3, $i4, $i5);
                    
                        
                        while(($row = pg_fetch_row($result))){
                        
                
                            $cnt=0;
                        
                        foreach($ingr as $i){

                            
                            if(strpos($row[4], $i)!==false) $cnt++;
                            }


                            if($cnt>0){
                                $arr = array();
                                $arr[0] = $row[1];
                                $arr[1] = $cnt; 
                            array_push($res,$arr);
                        }
                        }
                        
                        //ordina $res secondo cmp 
                        usort($res,"cmp");

                        //visualizza a schermo
                        if(count($res) == 0){
                            echo "<h1> Nessuna ricetta trovata per gli ingredienti selezionati</h1>";
                        }else{
                        echo "<table class='risultati'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Ricetta</th>";
                        echo "<th>Ingredienti tra quelli cercati</th>";
                        echo "<th>Vai alla ricetta</th>";
                        echo "</tr>";
                        echo "<tr>";
                        foreach($res as $value){
                            $str="";
                            foreach($value as $val) $str= $str . "<td> $val </td>";
                            echo "$str  </tr><tr>";
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
        
    
            
            
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>