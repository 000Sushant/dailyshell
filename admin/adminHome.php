<?php

session_start();
if(!isset($_SESSION['active']) || $_SESSION['active'] == false || strlen($_SESSION['name']) == 0){
    session_destroy();
    echo '
    <div style="text-align: center; ">
    <img src="../images/404.jpg" alt="404 error" style="max-width:700px;height:auto;">
    </div>
    Illustration Author: <a href="http://www.freepik.com">Designed by stories / Freepik</a>
    ';
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberRAT | Admin</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=1" crossorigin='anonymous'>

    <!-- web fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

</head>
<body>
    <?php include '../others/nav.php'?>
    
    <div class="container border my-5 border-info">
        <div class="row top">
            <h1 class="heading1 mx-auto">Welcome  Admin</h1>
        </div>
        <div class="row my-4">
            <h1 class="h3 col-12 text-center mb-3">Logged In as: <?php echo '<span class="text-capitalize">'.$_SESSION['name'].'</span>';?></h1>
            <a href="adminBlog.php" class="btn btn-dark col-7 mx-auto mb-2">Blog Operations</a>
            <a href="pendingBlog.php" class="btn btn-dark col-7 mx-auto mb-2">Pending Blog</a>
            <a href="latestTrending.php" class="btn btn-dark col-7 mx-auto mb-2">Latest and Trending</a>
            <a href="addAdmin.php" class="btn btn-dark col-7 mx-auto mb-2">Add New Admin</a>
            <a href="contributerAdmin.php" class="btn btn-dark col-7 mx-auto mb-2">Contributers</a>

            <a href="./partials/logout.php" class="mx-auto text-center mt-3 btn btn-danger col-7"><i class="fa fa-gear"></i> logout</a>
        </div>
    </div>

    <?php include '../others/footer.php'?>
</body>
</html>