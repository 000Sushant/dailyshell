<?php 

$hostserver = "localhost";
$username = "root";
$password = "";
$database = "cyberblog";

$conn = mysqli_connect($hostserver, $username, $password, $database);
// $pdo = new PDO("mysql:host=$hostserver;dbname=$database", $username, $password, array(
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
// ));
//checking connection
if(!$conn){
    die("Database connection failed: ".mysqli_connect_error());
}
// else connected to database
// echo "connection successful";

?>