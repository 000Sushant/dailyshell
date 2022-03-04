<?php
include 'db_connect.php';

// $database->

$reference = $database->getReference('blogid');
echo $reference->getValue();
echo "<h1>Apple</h1>";
echo "<h1>Working on Firebase</h1>";
?>