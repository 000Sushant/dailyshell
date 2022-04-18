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

// for adding new request
if(isset($_POST['addcon'])){
            
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    $sql = "SELECT `id` from pendingblogs where `request`='$name' and `heading` = '$subject'";
    $result = mysqli_query($conn,$sql);
    
    if($result){
        if(mysqli_num_rows($result) > 0){
            // echo 'request is already there';
            $addalert = 1;
            goto end;
        }
    }

    $sql = "INSERT into pendingblogs(`request`,`heading`,`content`) VALUES('$name','$subject','$content')";
    $result = mysqli_query($conn,$sql);
    
    if($result){
        if(mysqli_affected_rows($conn) > 0){
            // echo 'request added successfully';
            $addalert = 1;
        }
        else{
            // echo 'unable to add the request';
            $addalert = 2;
        }
    }
    
}

//for deleting the existing request
if(isset($_POST['delete'])){
    $add = "";
    $delete ="show active";
    $id = (int)mysqli_real_escape_string($conn,$_POST['id']);
    if($id > 0){
        $sql = "DELETE from pendingblogs where `id` = '$id'";
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
                    <a class="list-group-item list-group-item-info list-group-item-action <?php echo $add?>" id="list-add-list" data-toggle="list" href="#list-add" role="tab" aria-controls="add">Add Request</a>
                    <a class="list-group-item list-group-item-info list-group-item-action <?php echo $delete?>" id="list-delete-list" data-toggle="list" href="#list-delete" role="tab" aria-controls="delete">Delete Request</a>
                </div>
            </div>

            <!-- alerts -->
            <?php
                if($addalert == 1){
                    echo '
                    <div class="alert m-2  alert-success alert-dismissible fade show container" role="alert">
                    <strong>Operation Successful!</strong> New blog request is successfully added
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
                else if($addalert == 2){
                    echo '
                    <div class="alert m-2  alert-danger alert-dismissible fade show container" role="alert">
                    <strong>Operation Failed!</strong> There may be some srever issue, try again later 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
                if($deletealert == 1){
                    echo '
                    <div class="alert m-2  alert-success alert-dismissible fade show container" role="alert">
                    <strong>Operation Successful!</strong> Blog Request having id "'.$id.'"is successfully deleted
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
                if($deletealert == 2){
                    echo '
                    <div class="alert m-2  alert-danger alert-dismissible fade show container" role="alert">
                    <strong>Operation Failed!</strong> Check your inputs, maybe the blog request you are trying to delete isn\'t there
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
                        <p class="h3 text-center heading1 top py-3">Add Blog Request</p>
                        <form action="pendingBlog.php" class="row mx-sm-4 px-2 my-2" method="post">

                            <div class="form-group col-sm-6">
                                <label for="name">Enter Name</label>
                                <input type="text" class="form-control mb-2" name="name" id="name" placeholder="Full Name" required>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="subject">Enter subject</label>
                                <input type="text" class="form-control mb-2" name="subject" id="subject" placeholder="subject" required>
                            </div>
                            
                            <div class="form-group col-sm-6">
                                <label for="discription">Enter discription</label>
                                <textarea name="content" id="discription" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            

                            <div class="custom-control custom-checkbox my-2 text-center col-sm-12">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                <label class="custom-control-label" for="customCheck1">Do you want to add this request?</label>
                            </div>

                            <div class="row px-4 w-100 mx-auto">
                                <button class="btn btn-dark mx-auto col-sm-2" type="submit" name="addcon">Submit</button>
                            </div>
                            
                        </form>
                    </div>
                    
                    <!-- delete request -->
                    <div class="tab-pane fade border border-info my-2 <?php echo $delete?>" id="list-delete" role="tabpanel" aria-labelledby="list-delete-list">
                        <p class="h3 text-center heading1 top py-3">Delete Blog Request</p>
                        <form action="pendingBlog.php" class="p-2" method="post">
                            <label for="id" class="d-block">Enter Contributer ID</label>
                            <input type="number" name="id" id="id" class="form-control col-sm-8 d-inline-block" placeholder="Contributer ID" required/>
                            <button type="submit" name="delete" class="btn btn-danger d-inline-block col-sm-2">Delete</button>
                        </form>
                        <?php
                            $sql = "SELECT * from pendingblogs";
                            $result = mysqli_query($conn,$sql);
                            if($result){
                                if(mysqli_num_rows($result) > 0){
                                    echo '
                                    <div class="px-2">
                                    <table class="table table-info">
                                    <thead class="text-info bg-dark">
                                        <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">heading</th>
                                        <th scope="col">request</th>
                                        <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo'
                                        <tr>
                                        <th scope="row">'.$row['id'].'</th>
                                        <td>'.$row['heading'].'</td>
                                        <td>'.$row['request'].'</td>
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

</body>
</html>