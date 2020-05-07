<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Home Utente</title>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
        <link rel='stylesheet' href='CSS/newstyle.css'>
        <style type='text/css'></style>
        <meta name='viewport' content='width-device-width, initial-scale=1'/>
        <meta name='viewport' content='height=device-height, initial-scale=1'/>  
       
    </head>
    <body>
    
      <footer id='sticky-footer' class='py-4  text-white'>
        <div class='container text-center'>
         Copyright &copy;<script>document.write(new Date().getFullYear());</script>,  Foodream
        </div>
      </footer>
    <?php
        session_start();

        if (isset( $_SESSION['email'] ) ) {
            // Grab user data from the database using the user_id
            // Let them access the 'logged in only' pages
        } else {
            // Redirect them to the login page
            session_destroy();
            header('Location: ../index.html');
        }
        $dbconn = pg_connect('host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres')
            or die('Could not connect : ' . pg_last_error());

        $email=$_SESSION['email'];
        $q1='select * from utente where email=$1';
        $result=pg_query_params($dbconn, $q1, array($email));
        $line=pg_fetch_array($result,null,PGSQL_ASSOC);
        echo $_SESSION['email'].'<tr>';
        echo $line['nome'].'<tr>';
        echo $line['cognome'].'<tr>';
        


      echo "<header>
      <nav class='navbar navbar-ficed-top navbar-expand-lg  navbar-dark ' id='navbar'>
          
            <a class='navbar-brand' href='#'>
              <img src='IMMAGINI/foodream2.png' width='70' height='50' class='d-inline-block align-top' alt=''>
            </a>
             
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
              <span class='navbar-toggler-icon'></span>
            </button>
          
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
              <ul class='navbar-nav mr-auto'>
                <li class='nav-item active'>
                  <a class='nav-link' href='homeUtente.php'>Home <span class='sr-only'>(current)</span></a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' >Primi</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' >Secondi</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' >Contorni</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' >Dolci</a>
                </li>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='logout.php'>Logout</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='profilo.php'>Profilo</a>
                </li>

              </ul>
            </div>
         
        </nav>
      </header>";
    
   
      ?>
          <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity='sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin='anonymous'></script>
          <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
          <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
    </body>
</html>