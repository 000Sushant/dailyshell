<?php 

// adding necessery files from vendor folder
require __DIR__.'./firebase/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('./firebase/hackershat-d1a8a-firebase-adminsdk-etx0v-38449b8360.json')
    ->withDatabaseUri('https://hackershat-d1a8a-default-rtdb.firebaseio.com/');
    
$database = $factory->createDatabase();


?>