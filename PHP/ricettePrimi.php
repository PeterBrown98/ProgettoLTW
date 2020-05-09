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
                foreach($var as $value) if (($value==$a)||($value==$b)||($value==$c)||($value==$d)||($value==$e)) $cont++;
                return $cont;
            }

            $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
            or die('Could not connect : ' . pg_last_error());

            if(!(isset($_POST["cerca"]))) header("Location: ../index.html");
            else{
                $i1=$_POST['i1'];
                $i2=$_POST['i2'];
                $i3=$_POST['i3'];
                $i4=$_POST['i4'];
                $i5=$_POST['i5'];
                $i6="Primo";
                $query="select ric.*, ing.nome
                        from ricetta ric, ingrediente ing
                        where ric.id in (select ricetta from ricIng where ingrediente in 
                                        (select id from ingrediente where nome = $1 or nome = $2
                                        or nome = $3 or nome = $4 or nome = $5)) and
                        ing.id in (select ingrediente from  ricIng r where r.ricetta=ric.id) and ric.tipo=$6 order by ric.id";
                $result=pg_query_params($dbconn, $query, array($i1,$i2,$i3,$i4,$i5,$i6));
                $row=pg_fetch_row($result);
                $res=array();
                $b=array();
                //genera un array di array contenenti i campi di ogni ricetta e i relativi ingredienti in una sola riga
                while($row = pg_fetch_row($result)){
                    $id=$row[0];
                    if(count($b)==0) $a=array($row[0],$row[1],$row[2],$row[3],$row[4]);
                    else $a=$b;
                    while(($row!=Null)&&($row[0]==$id)){
                        if ($a[4]!=$row[4]) array_push($a,$row[4]);
                        $row = pg_fetch_row($result);
                    }
                    array_push($res,$a);
                    $b=array($row[0],$row[1],$row[2],$row[3],$row[4]);
                }
                //conta il numero di ingredienti immessi in input che sono presenti nella ricetta assegnandoli come primo valore di ogni array in $res
                foreach($res as $value){
                    foreach($value as $val) {
                        $val=countInput($value,$i1,$i2,$i3,$i4,$i5);
                        break;
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
                    echo "$str . </tr><tr>";
                }
                echo "</tr>";
                echo "</table>";
            }
    ?>
</body>
</html>