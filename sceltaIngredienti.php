<!DOCTYPE html>
<html>
    <head>
        <title>Scelta ingredienti</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/newstyle.css">
        <link rel="stylesheet" href="awesomplete.css" />
        <style type="text/css"></style>
        <meta name="viewport" content="width-device-width, initial-scale=1"/>
        <meta name="viewport" content="height=device-height, initial-scale=1"/> 
        <script src="awesomplete.js" async></script>

    </head>
    <body>
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
                            <a class="nav-link" href="homeUtente.html">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Primi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Secondi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Contorni</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Dolci</a>
                        </li>
                    </ul>
                </div>
            
            </nav>
        </header>
             
        <main>
            <h1 class="title">Scegli gli ingredienti che vuoi usare</h1>
            <section class="ricerca">
                <form action="/PHP/ricettePrimi.php" method="post"> 
                <input class="awesomplete" name="i1" list="mylist" placeholder = "Seleziona un ingrediente"/>
                <br>
                <input class="awesomplete" name="i2" list="mylist" placeholder = "Seleziona un ingrediente"/>
                <br>
                <input class="awesomplete" name="i3" list="mylist" placeholder = "Seleziona un ingrediente"/>
                <br>
                <input class="awesomplete" name="i4" list="mylist" placeholder = "Seleziona un ingrediente"/>
                <br>
                <input class="awesomplete" name="i5" list="mylist" placeholder = "Seleziona un ingrediente"/>
                <br>
                <br>
                <br>
                <datalist id="mylist">
                    <?php
                        $db = pg_connect("host=localhost, port=5433, dbname=dbfoodream user=postgres password=postgres");
                        $result1 = pg_query($db, "SELECT nome FROM ingrediente2 order by nome ASC");
                        while ($row = pg_fetch_row($result1)) {
                        echo "<option value='$row[0]'>$row[0]</option>";
                        }
                    ?>
                </datalist>
                <button type="submit" class="btn-primary" id="srchbtn" name="cerca">Cerca Ricetta</button>
                </form>
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