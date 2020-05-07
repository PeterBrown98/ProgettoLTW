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


            $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
            or die('Could not connect : ' . pg_last_error());

            session_start();

            if ( isset( $_SESSION['email'] ) ) {
                // Grab user data from the database using the user_id
                // Let them access the "logged in only" pages
            } else {
                // Redirect them to the login page
                header("Location: /login.html");
            }
            $result = pg_query($dbconn, "SELECT * FROM ricetta WHERE id<10");
            if (!$result) {
            echo "An error occurred.\n";
            exit;
            }
            echo "<table>";
            echo "<tr>";
            while ($row = pg_fetch_row($result)) {
                echo "<td>". $row[0]. "</td><td>". $row[1]. "</td><td>". $row[2]. "</td><td>". $row[3]. "</td>";
                echo "</tr><tr>";
           
            }
            echo "</tr>";
            echo "</table>";
            ?>
</body>
</html>