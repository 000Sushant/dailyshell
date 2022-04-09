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

include '../connections/db_connect.php';
$addadminalert = 0;

//on add button
if(isset($_POST['addAdmin'])){
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $id = (int)mysqli_real_escape_string($conn,$_POST['id']);
    
    // checking if id is valid
    if($id == 0){
        // echo 'check your inputs';
        $addadminalert = 2;
        goto outaddadmin;
    }
    //checking if admin is already there
    $sql = "SELECT `name` from admin_user where `user_id` = $id";
    $result = mysqli_query($conn,$sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            // echo 'admin is already there with same admin id';
            $addadminalert = 3;
            goto outaddadmin;
        }
    }

    $sql = "INSERT INTO admin_user(`name`,`user_pass`,`user_id`) VALUES('$name','$pass','$id')";
    $result = mysqli_query($conn,$sql);
    if($result){
        if(mysqli_affected_rows($conn) > 0){
            // echo 'New admin Added';
            $addadminalert = 1;
        }
        else{
            // echo 'failed to add new admin';
            $addadminalert = 2;
        }
    }

}

outaddadmin:
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberRAT | Add Admin</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=2" crossorigin='anonymous'>

    <!-- web fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">


</head>
<body>
    <?php include '../others/nav.php'?>

    <div class="container">
        <!-- alert -->
        <?php
        
            if($addadminalert == 1){
                echo '
                <div class="alert my-2 alert-success alert-dismissible fade show container" role="alert">
                <strong>Operation Successful!</strong> New admin successfully added having name '.$name.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                ';
            }
            else if($addadminalert == 2){
                echo '
                <div class="alert my-2 alert-danger alert-dismissible fade show container" role="alert">
                <strong>Operation Failed!</strong> Unable to add new admin, kindly verify your inputs or try again later
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                ';
            }
            else if($addadminalert == 3){
                echo '
                <div class="alert my-2 alert-success alert-dismissible fade show container" role="alert">
                <strong>Operation Successful!</strong> This admin is already added, enter new detailes if your want to add more
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                ';
            }
        
        ?>

        <div class="row mx-1 border border-info my-2">
            <p class="h3 text-center heading1 top col-12 py-3">Add New Admin</p>
            
            <form action="addAdmin.php" class="p-2 col-sm-8" method="post">
                
                <label class="d-block" for="name">Admin Name</label>
                <input type="text" id="name" name="name" class="form-control col-sm-10 mb-2" placeholder="Admin Name" required/>
                
                <label class="d-block" for="id">Admin ID (6 digit only)</label>
                <input type="number" id="id" name="id" class="form-control col-sm-10 mb-2" placeholder="XXXXXX" required/>
                
                <label class="d-block" for="pass">Admin Password</label>
                <input type="password" id="pass" name="pass" class="form-control col-sm-10 mb-2" placeholder="Password" required/>
                
                <input type="checkbox" id="confirm" required> <lable for="confirm">Confirm adding a new admin</lable>
                <button type="submit" name="addAdmin" class="btn btn-dark col-sm-3 d-block mb-2 my-2" required>Add</button>
            </form>

            <div class="col-sm-4">
                <h1 class="heading2">Admin List</h1>
                <ul>
                <?php 
                
                    $sql = "SELECT `name` from admin_user";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<li>'.$row['name'].'</li>';
                            }
                        }
                        else{
                            echo '<p class="text-danger">No Admin Available</p>';
                        }
                    }
                
                ?>
                </ul>
            </div>
        </div>

        <div class="text-center my-4 w-100">
            <a href="adminHome.php" class="btn btn-info col-sm-2">Admin Home</a>
        </div>
    </div>

    <?php include '../others/footer.php'?>
</body>
</html>