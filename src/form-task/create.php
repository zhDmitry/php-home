<?php

$db_user = $_ENV['MYSQL_USER'];
$db_password = $_ENV['MYSQL_PASSWORD'];
$db_name = $_ENV['MYSQL_DATABASE'];
$connection = mysqli_connect('db', $db_user, $db_password, $db_name);


$stmt = mysqli_prepare($connection, '
    INSERT INTO User 
        (Name, Email, Password) 
    VALUES 
        (?, ?, ?)
');

$stmt->bind_param('sss',$_POST['name'], $_POST['email'],$_POST['password']);
$stmt->execute();
$stmt->close();

$sql = 'SELECT Id, Name, Email, Password FROM User';
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["Id"]. " - Name: " . $row["Name"]. " Email:" . $row["Email"]. "<br>";
    }
} else {
    echo "0 results";
}
$connection->close();
?>