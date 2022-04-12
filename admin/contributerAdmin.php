<?php

//session validation
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

//including database connection
include '../connections/db_connect.php';

$add = "show active";
$delete ="";
$addalert = 0;
$deletealert = 0;

// for adding new contribuetrs
if(isset($_POST['addcon'])){
    
    if(isset($_POST['position'])){
        if($_POST['position'] === 'tc' || $_POST['position'] === 'vc'){
            
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $res = mysqli_real_escape_string($conn, $_POST['res']);
            $position = mysqli_real_escape_string($conn, $_POST['position']);
            $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);
            $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
            $twitter = mysqli_real_escape_string($conn, $_POST['twitter']);
            
            $sql = "SELECT `name` from contributer_user where `email`='$email' and `position` = '$position'";
            $result = mysqli_query($conn,$sql);
            
            if($result){
                if(mysqli_num_rows($result) > 0){
                    // echo 'user is already there';
                    $addalert = 1;
                    goto end;
                }
            }

            $sql = "INSERT into contributer_user(`name`,`email`,`contribution`,`position`,`linkedin`,`facebook`,`twitter`) VALUES('$name','$email','$res','$position','$linkedin','$facebook','$twitter')";
            $result = mysqli_query($conn,$sql);
            
            if($result){
                if(mysqli_affected_rows($conn) > 0){
                    // echo 'contributer added successfully';
                    $addalert = 1;
                }
                else{
                    // echo 'unable to add contributer';
                    $addalert = 2;
                }
            }
            
        }
        else{
            // echo 'invalid position';
            $addalert = 2;
        }
    }
    
}

//for deleting the existingn contributers
if(isset($_POST['delete'])){
    $add = "";
    $delete ="show active";
    $id = (int)mysqli_real_escape_string($conn,$_POST['id']);
    if($id > 0){
        $sql = "DELETE from contributer_user where `id` = '$id'";
        $result = mysqli_query($conn,$sql);
        if($result){
            if(mysqli_affected_rows($conn) > 0){
                // echo 'contributer deleted successfully';
                $deletealert = 1;
            }
            else{
                // echo 'wrong id entered';
                $deletealert = 2;
            }
        }
        else{
            // echo 'unable to connect to database';
            $deletealert = 2;
        }
    }
    else{
        // echo 'enter a valid id';
        $deletealert = 2;
    }
}

end:
?>

<!-- html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Contributer</title>

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

    <div class="container">
        <div class="row">

            <!-- page menu  -->
            <div class="col-12 my-2">
                <div class="list-group list-group-horizontal-sm" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-info list-group-item-action <?php echo $add?>" id="list-add-list" data-toggle="list" href="#list-add" role="tab" aria-controls="add">Add Contributer</a>
                    <a class="list-group-item list-group-item-info list-group-item-action <?php echo $delete?>" id="list-delete-list" data-toggle="list" href="#list-delete" role="tab" aria-controls="delete">delete Contributer</a>
                </div>
            </div>

            <!-- alerts -->
            <?php
                if($addalert == 1){
                    echo '
                    <div class="alert m-2  alert-success alert-dismissible fade show container" role="alert">
                    <strong>Operation Successful!</strong> New contributer is successfully added having name "'.$name.'"
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
                else if($addalert == 2){
                    echo '
                    <div class="alert m-2  alert-danger alert-dismissible fade show container" role="alert">
                    <strong>Operation Failed!</strong> Choose a valid contributer position or verify your inputs 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
                if($deletealert == 1){
                    echo '
                    <div class="alert m-2  alert-success alert-dismissible fade show container" role="alert">
                    <strong>Operation Successful!</strong> Contributer having id "'.$id.'"is successfully deleted
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
                if($deletealert == 2){
                    echo '
                    <div class="alert m-2  alert-danger alert-dismissible fade show container" role="alert">
                    <strong>Operation Failed!</strong> Check your inputs, maybe the contributer you are trying to delete isn\'t there
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
            ?>

            <div class="col-12">
                <div class="tab-content" id="nav-tabContent">
                    
                    <!-- add contributer -->
                    <div class="tab-pane fade border border-info my-2 <?php echo $add?>" id="list-add" role="tabpanel" aria-labelledby="list-add-list">
                        <p class="h3 text-center heading1 top py-3">Add Contributer</p>
                        <form action="contributerAdmin.php" class="row mx-sm-4 px-2 my-2" method="post">

                            <div class="form-group col-sm-6">
                                <label for="name">Enter Name</label>
                                <input type="text" class="form-control mb-2" name="name" id="name" placeholder="Full Name" required>
                            </div>
                            
                            <div class="form-group col-sm-6">
                                <label for="res">Enter Responsibilities</label>
                                <input type="text" class="form-control mb-2 " name="res" id="res" placeholder="Blogger | Researcher | RAT Member" reqired>
                            </div>
                            
                            <div class="form-group col-sm-6">
                                <label for="email">Enter Email</label>
                                <input type="text" class="form-control mb-2 " name="email" id="email" placeholder="Email ID">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="linkedin">Enter Linkedin</label>
                                <input type="text" class="form-control mb-2 " name="linkedin" id="linkedin" placeholder="Linkedin ID">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="twitter">Enter twitter</label>
                                <input type="text" class="form-control mb-2 " name="twitter" id="twitter" placeholder="twitter ID">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="facebook">Enter Facebook</label>
                                <input type="text" class="form-control mb-2 " name="facebook" id="facebook" placeholder="facebook ID">
                            </div>

                            <div class="form-group col-sm-6">
                                <lable>Select Contributer's Position </lable>
                                <select class="form-control" name="position">
                                    <option>Select Position</option>
                                    <option value="tc">Top Contributer</option>
                                    <option value="vc">Valuable Contributer</option>
                                </select>
                            </div>


                            <div class="custom-control custom-checkbox my-2 text-center col-sm-12">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                <label class="custom-control-label" for="customCheck1">Do you want to add this contributer ?</label>
                            </div>

                            <div class="row px-4 w-100 mx-auto">
                                <button class="btn btn-dark mx-auto col-sm-2" type="submit" name="addcon">Submit</button>
                            </div>
                            
                        </form>
                    </div>
                    
                    <!-- delete contributer -->
                    <div class="tab-pane fade border border-info my-2 <?php echo $delete?>" id="list-delete" role="tabpanel" aria-labelledby="list-delete-list">
                        <p class="h3 text-center heading1 top py-3">Delete Contributer</p>
                        <form action="contributerAdmin.php" class="p-2" method="post">
                            <label for="id" class="d-block">Enter Contributer ID</label>
                            <input type="number" name="id" id="id" class="form-control col-sm-8 d-inline-block" placeholder="Contributer ID" required/>
                            <button type="submit" name="delete" class="btn btn-danger d-inline-block col-sm-2">Delete</button>
                        </form>
                        <?php
                            $sql = "SELECT * from contributer_user";
                            $result = mysqli_query($conn,$sql);
                            if($result){
                                if(mysqli_num_rows($result) > 0){
                                    echo '
                                    <div class="px-2">
                                    <table class="table table-info">
                                    <thead class="text-info bg-dark">
                                        <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Contribution</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo'
                                        <tr>
                                        <th scope="row">'.$row['id'].'</th>
                                        <td>'.$row['name'].'</td>
                                        <td>'.$row['contribution'].'</td>';
                                        $position = "Top Contributer";
                                        if($row['position'] === 'vc'){
                                            $position = "Valuable Contributer";
                                        }
                                        echo'
                                        <td>'.$position.'</td>
                                        <td>'.$row['date'].'</td>
                                        </tr>';
                                    }
                                    echo'    
                                    </tbody>
                                    </table>
                                    ';
                                }
                                else{
                                    echo '<p class="text-danger">No contributer added';
                                }
                            }
                        ?>
                    </div>

                </div>
            </div>

            <!-- home button -->
            <div class="text-center px-3">
                <a href="adminHome.php" class="btn btn-info col-sm-2 mb-4 my-2">Admin Home</a>
            </div>

        </div>
    </div>
    </div>

    <?php include '../others/footer.php'?>

    <script>
        // for dropdown
        $(".dropdown-menu li a").click(function(){
            $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        });
    </script>
</body>
</html>