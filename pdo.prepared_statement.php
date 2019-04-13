<?php

$id = $_GET['id'];
$name = $_GET['name'];
$begins = $_GET['begins'];

try {
    $conn = new PDO("mysql:host=localhost;dbname=prueba_consola", "root", "");
    echo 'Sucess';

    //prepared, recommended (users can not inject code)

    //statement add user
    $statement = $conn->prepare('INSERT INTO users VALUES( null, "Jaime", "Jaime@gmail.com")');
    $statement->execute();

    // statement consult
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
       echo '<br>';
    //    echo $row['name'];
    }
} catch (PDOException $e) {
    echo 'Error ' . $e->getMessage();   
}


?>