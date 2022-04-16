<?php 
session_start();
require '../connections/db_connect.php';

if(!isset($_POST['activeBlog']) || $_POST['activeBlog'] == false){
    header("location:../");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberRAT | Blogs</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=1" crossorigin='anonymous'>

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../others/nav.php'?> 

    <!-- head -->
    <div class="head">
    <h1 class="text-warning bg-info py-2 text-center">CyberRAT</h1>
    </div>

    <!-- main content -->
    <div class="container text-center bg-light p-3 mt-4">
        <?php
        
            $sql = "SELECT * from blogs where `blogId` = '$_POST[activeBlog]'";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                if(mysqli_num_rows($result)==1){
                    $row = mysqli_fetch_assoc($result);
                    echo '<h1 class="heading1">'.$row['heading'].'</h1>';
                    echo '<img src="../files/thumbnails/'.$row['demo_image'].'" class="my-2" style="width:50%" alt="demo image">';  
                    echo '<div class="text-left my-4">'.$row['content'].'</div>';
                    echo '
                    <div class="text-left mb-3">
                        <p class="my-0 author text-secondary text-center">
                            <i class="fa fa-user"></i> '.$row['author'].' |
                            <i class="fa fa-calendar"></i> '.$row['date'].' |
                            <i class="text-secondary"></i>'.$row['hashtags'].'
                        </p>
                    </div>';
                    echo '<a href="searchBlog.php" class="btn btn-info mx-auto col-sm-2 text-center d-block">Back to Home</a>';
                    
                }
                else{
                    echo '            
                    <div class="alert alert-danger" role="alert">
                        It seems there isn\'t any blog regarding your search right now, explore more at <a href="../" class="alert-link">home page</a>
                    </div>                 
                    ';
                }
            }
            else{
                echo '
                <div class="alert alert-danger" role="alert">
                    couldn\'t reach the database at the moment kindly try again later (Server error)
                </div>
                ';
            }
        ?>
    </div>
</div>

    <?php include '../others/footer.php'?>
</body>
</html>