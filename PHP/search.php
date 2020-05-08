<?php


if (isset($_GET['term'])){
    $return_arr = array();

    try {
        session_start();
        $dbconn = pg_connect("host=localhost port=5433 dbname=dbfoodream user=postgres password=postgres")
        or die('Could not connect : ' . pg_last_error());
        
        $stmt = $conn->prepare('SELECT nome FROM ingrediente WHERE nome LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        
        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['nome'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}

?>