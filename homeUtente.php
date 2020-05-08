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
    <body>

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
                  <a class="nav-link" href="sceltaIngredienti.php" >Primi</a>
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
        <div class="container1">
          <div class="row" id="row1">
            <div class="col8">
              <h1 id="h1-home">
                Primi
              </h1>
              <h3>Clicca <a href="primi.php"> qui </a> per accedere al sito</h3>
            </div>
            <div class="col4">


              <div id="caros-utente1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" id="caros-utente1">
                  <div class="carousel-item active" id="caros-utente1">
                    <img src="/IMMAGINI/cioccolato-fondente.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                  <div class="carousel-item" id="caros-utente1">
                    <img src="/IMMAGINI/contorni.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                  <div class="carousel-item" id="caros-utente1">
                    <img src="/IMMAGINI/contorni.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#caros-utente1" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#caros-utente1" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>



            </div>
          </div>
        </div> 

        <div class="container1">
          <div class="row" id="row1">
            <div class="col8">
              <h1 id="h1-home">
              Secondi
              </h1>
            </div>
            <div class="col4">


              <div id="caros-utente2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" id="caros-utente2">
                  <div class="carousel-item active" id="caros-utente2">
                    <img src="/IMMAGINI/cioccolato-fondente.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                  <div class="carousel-item" id="caros-utente2">
                    <img src="/IMMAGINI/contorni.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                  <div class="carousel-item" id="caros-utente2">
                    <img src="/IMMAGINI/contorni.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#caros-utente2" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#caros-utente2" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>



            </div>
          </div>
        </div>

        <div class="container1">
          <div class="row" id="row1">
            <div class="col8">
              <h1 id="h1-home">
               Contorni
              </h1>
            </div>
            <div class="col4">


              <div id="caros-utente3" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" id="caros-utente3">
                  <div class="carousel-item active" id="caros-utente3">
                    <img src="/IMMAGINI/cioccolato-fondente.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                  <div class="carousel-item" id="caros-utente3">
                    <img src="/IMMAGINI/contorni.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                  <div class="carousel-item" id="caros-utente3">
                    <img src="/IMMAGINI/contorni.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#caros-utente3" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#caros-utente3" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>



            </div>
          </div>
        </div>


        <div class="container1">
          <div class="row" id="row1">
            <div class="col8">
              <h1 id="h1-home">
                Dolci
              </h1>
            </div>
            <div class="col4">


              <div id="caros-utente4" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" id="caros-utente4">
                  <div class="carousel-item active" id="caros-utente4">
                    <img src="/IMMAGINI/cioccolato-fondente.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                  <div class="carousel-item" id="caros-utente4">
                    <img src="/IMMAGINI/contorni.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                  <div class="carousel-item" id="caros-utente4">
                    <img src="/IMMAGINI/contorni.jpg" class="d-block w-100" alt="..." id="imgcov">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#caros-utente4" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#caros-utente4" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>



            </div>
          </div>
        </div>
      
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