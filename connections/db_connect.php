<?php 

$hostserver = "localhost";
$username = "root";
$password = "";
$database = "cyberblog";

$conn = mysqli_connect($hostserver, $username, $password, $database);

if(!$conn){
    die("Database connection failed: ".mysqli_connect_error());
}
// else connected to database
// echo "connection successful";
mysqli_set_charset($conn, 'utf8');

?>