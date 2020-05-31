<!DOCTYPE html>
<html>
    <head>
        <title>Scelta ingredienti</title>
        <script src="../javascript/logout.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/newstyle.css">
        <link rel="stylesheet" href="awesomplete.css" />
        <style type="text/css">
            #ing2{display: none;}
            #ing3{display: none;}
            #ing4{display: none;}
            #ing5{display: none;}
        </style>
        <meta name="viewport" content="width-device-width, initial-scale=1"/>
        <meta name="viewport" content="height=device-height, initial-scale=1"/> 
        <script src="awesomplete.js" async></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>
        <?php
             session_start();

             if (isset( $_SESSION['email'] ) ) {
             } else {
                 session_destroy();
                 header("Location: ../index.html");
             }




            $tipo=$_GET['tipoPiatto'];
    
       echo "<header>";
           echo '<nav class="navbar navbar-ficed-top navbar-expand-lg  navbar-dark " id="navbar">';
                
                echo '<a class="navbar-brand" href="#">';
                  echo  '<img src="../IMMAGINI/foodream2.png" width="70" height="50" class="d-inline-block align-top" alt="">';
                echo "</a>";
                
                echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
                    echo '<span class="navbar-toggler-icon"></span>';
                echo "</button>";

                
                
                echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
                    echo '<ul class="navbar-nav mr-auto">';
                        echo '<li class="nav-item active">';
                            echo '<a class="nav-link" href="homeUtente.php">Home <span class="sr-only">(current)</span></a>';
                        echo "</li>";
                        echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="profilo.php">Profilo</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="javascript: logout()">Logout</a>';
                        echo '</li>';
                    echo "</ul>";
                echo "</div>";
            
            echo "</nav>";
        echo "</header>";
             
        echo "<main>";
            echo "<h1 class='title' style='text-align: center'>Scegli gli ingredienti che vuoi usare per il tuo <span style='color:yellow'> $tipo</span></h1>";
            echo "<div  id='ricercaIngredienti' >";
                echo "<form id='formRicette' action='ricette.php?tipoPiatto=$tipo'method='post' onsubmit='f()
                '>";
                echo '<input class="awesomplete" id="ing1" name="i1" list="mylist" placeholder = "Seleziona un ingrediente"/>';
                echo "<br>";
                echo "<br>";
                echo '<input class="awesomplete" id="ing2" name="i2" list="mylist" placeholder = "Seleziona un ingrediente"/>';
                echo "<br>";
                echo '<input class="awesomplete" id="ing3" name="i3" list="mylist" placeholder = "Seleziona un ingrediente"/>';
                echo "<br>";
                echo '<input class="awesomplete" id="ing4" name="i4" list="mylist" placeholder = "Seleziona un ingrediente"/>';
                echo "<br>";
                echo '<input class="awesomplete" id="ing5" name="i5" list="mylist" placeholder = "Seleziona un ingrediente"/>';
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo '<datalist id="mylist">';
                    
                        $db = pg_connect("host=localhost, port=5433, dbname=dbfoodream user=postgres password=postgres");
                        $result1 = pg_query($db, "SELECT nome FROM ingrediente2 order by nome ASC");
                        while ($row = pg_fetch_row($result1)) {
                        echo "<option value='$row[0]'>$row[0]</option>";
                        }
                    
                        echo "</datalist>";
                        
                        echo "<button type='submit' class='btn btn-lg btn-primary' id='srchbtn' name='cerca' disabled >Cerca Ricetta</button>";
                        echo "</form>";
                        echo "</div>";

                        
        echo " </main>";
        echo '<footer id="sticky-footer" class="py-4  text-white">';
        echo '<div class="container text-center">';
        echo 'Copyright &copy;<script>document.write(new Date().getFullYear());</script>,  Foodream';
        echo "</div>";
        echo "</footer>";
       
   
     ?>  
       <script> 
        $(document).ready(function(){
         $(".awesomplete").change(function(){
            var i;
            var ing="#ing";
            
            for(i=0; i< $(".awesomplete").length; i++ ){
                    if($(".awesomplete")[i].value!=""){
                        $("#srchbtn").removeAttr('disabled');
                        var x=i+1;
                        var ingred=ing+x;
                        $(ingred).css('background-color','green');
                       
                        
                        var ingred=ing+(x+1);
                        $(ingred).css('display','block');

                    }
                    else{
                        var x=i+1;
                        var ingred=ing+x;
                        $(ingred).css('background-color','white');

                       }
                  
                    }
                });
              var i;
              var ing="#ing";
              
              for(i=0; i< $(".awesomplete").length; i++ ){
                
                if ($(".awesomplete")[i].value!=""){
                    $("#srchbtn").removeAttr('disabled');
                    var x=i+1;
                    var ingred=ing+x;
                    $(ingred).css('background-color','green');
                     
                    var ingred=ing+(x+1);
                    $(ingred).css('display','block');

                }
              }
              
            
        })

        

        </script>   
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
                
                
    </body>
</html>