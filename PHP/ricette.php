<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        td, tr{
            border: solid 2px black;
        }
    </style>
</head>
<body>
    <?php
            //comparator per ordinare il risultato in  modo decrescente rispetto al numero di ingredienti in input
            function cmp($a,$b){
                if($a[count($a)-1]==$b[count($b)-1]) return 0;
                return ($a[count($a)-1]<$b[count($b)-1]) ? 1 : -1;
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
    
                $query="select * from ricetta where tipo = '$i6'";
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
                echo "<table>";
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
</body>
</html>