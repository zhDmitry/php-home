<?php

$databaseHost = 'db';
$databaseName = $_ENV['MYSQL_DATABASE'];
$databaseUsername = $_ENV['MYSQL_USER'];
$databasePassword = $_ENV['MYSQL_PASSWORD'];
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
 
?>