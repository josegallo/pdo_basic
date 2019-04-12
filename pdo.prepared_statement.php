<?php

$id = $_GET['id'];
$name = $_GET['name'];
$begins = $_GET['begins'];

try {
    $conn = new PDO("mysql:host=localhost;dbname=prueba_consola", "root", "");

    //prepared, recommended (users can not inject code)
    $statement = $conn->prepare('SELECT * FROM users WHERE id = :id 
                                            or name = :name 
                                            or name LIKE :condition');
    $statement->execute( 
        array(':id' => $id, 
              ':name' => $name,
              ':condition' => "$begins%")
    );

    $results = $statement->fetchAll();
    foreach ($results as $row) {
       print_r($row);
    //    echo $row['name'];
       echo '<br>';
    }

} catch (PDOException $e) {
    echo 'Error ' . $e->getMessage();   
}


?>