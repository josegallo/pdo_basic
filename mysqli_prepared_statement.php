<?php 

$conn = new mysqli ('localhost', 'root', '', 'prueba_consola');
if ($conn->connect_errno) {
    die('Error connection');
} else {
    $statement = $conn->prepare("INSERT INTO users (id, name, email) VALUES( ?, ?, ?)");
    // ? are s for string, i for integer, d for double
    $statement->bind_param('iss', $id, $name, $email);
    $id = NULL;
    if ( isset($_GET['name']) && isset($_GET['email']) ) {
        $name = $_GET['name'];
        $email = $_GET['email'];
    } else {
        echo 'no values were found to add <br>';
    }
    $statement->execute();
    if ($conn->affected_rows >= 1) {
        echo 'new user added <br>';
    } else {
        echo "coudldn't add anything <br>";
    }

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