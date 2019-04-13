<?php 

$conn = new mysqli ('localhost', 'root', '', 'prueba_consola');
if ($conn->connect_errno) {
    die();
} else {
    $sql = 'SELECT * FROM users';
    $results = $conn->query($sql);
    if ($results->num_rows) {
       while ($row = $results->fetch_assoc()) {
        //    print_r ($row);
        //    echo '<br>';
           echo $row['name'].' - '. $row['email'] . '<br>';
       }
    }

}