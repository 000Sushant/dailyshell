<?php 

$hostserver = "localhost";
$username = "root";
$password = "";
$database = "cyberblog";

$conn = mysqli_connect($hostserver, $username, $password, $database);

//checking connection
if(!$conn){
    die("Database connection failed: ".mysqli_connect_error());
}
// else connected to database
// echo "connection successful";

?>