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
                        array_push($row,$cnt);
                     array_push($res,$row);
                 }
                }
                
                //ordina $res secondo cmp 
                usort($res,"cmp");

                //visualizza a schermo
                echo "<table>";
                echo "<tr>";
                foreach($res as $value){
                    $str="";
                    foreach($value as $val) $str= $str . "<td> $val </td>";
                    echo "$str  </tr><tr>";
                }
                echo "</tr>";
                echo "</table>";
            }
    ?>
</body>
</html>