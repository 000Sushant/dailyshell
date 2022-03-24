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

$showtable = false;
$error = false;
$error2 = false;
$class = "align-bottom";
$add="active";
$delete = " ";
$pending = " ";

if(isset($_POST['search']) || isset($_POST['delete']) || isset($_SESSION['deleted'])){
    $delete = "active";
    $add = " ";
    $pending = " ";
}

//on search event
if(isset($_POST['search'])){

    unset($_SESSION['deleted']);
    if(strlen($_POST['blog']) >= 3){
        $str = mysqli_real_escape_string($conn,$_POST['blog']);
        $sql = "SELECT `heading`,`date`,`blogId` from blogs WHERE `heading` LIKE '%$str%' OR `content` LIKE '%$str%' OR `hashtags` LIKE '%$str%'";
        $result = mysqli_query($conn, $sql);

        if($result){
            if(mysqli_num_rows($result) > 0){

                $showtable = true;
            }
            else{
                $error = true;
            }
        }
        else{
            $error = true;
        }
    }
    else{
        $error = true;
    }
}


//on delete event
if(isset($_POST['delete'])){

    $id = mysqli_real_escape_string($conn,$_POST['id']);

    $sql = "SELECT * FROM blogs WHERE blogId = '$id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        
        $_SESSION['deleted'] = $_POST['id'];

        $row = mysqli_fetch_assoc($result);
        
        $date = date('Y-m-d', time());

        $sql = "INSERT INTO deletedblogs(`blogId`,`heading`,`date`) values('$row[blogId]','$row[heading]','$date')";
        $result2 = mysqli_query($conn, $sql);

        if ($result2){
            header("location:adminBlog.php");
        }
        else{
            $error2 = true;
        }

    }
    else{
        $error2 = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Blogs</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=3" crossorigin='anonymous'>

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

</head>
<body>
    <?php include '../others/nav.php'?>

    <div class="container my-2">
    <div class="row">
        <div class="col-12">
                <div class="list-group list-group-horizontal-sm" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-info list-group-item-action <?php echo $add?>" id="list-home-list" data-toggle="list" href="#list-add" role="tab" aria-controls="home">Add Blog</a>
                    <a class="list-group-item list-group-item-info list-group-item-action <?php echo $delete?>" id="list-profile-list" data-toggle="list" href="#list-delete" role="tab" aria-controls="profile">Delete Blog</a>
                    <a class="list-group-item list-group-item-info list-group-item-action <?php echo $pending?>" id="list-messages-list" data-toggle="list" href="#list-pending" role="tab" aria-controls="messages">Pending Requests</a>
                </div>
        </div>
  
        <div class="col-12">
            <div class="tab-content" id="nav-tabContent">
                
                <!-- Add Blogs -->
                <div class="tab-pane fade show border border-info my-2 <?php echo $add?>" id="list-add" role="tabpanel" aria-labelledby="list-add-list">
                    <p class="h3 text-center heading1 top py-3">Add Blogs</p>
                    <div class="px-2">
                        <form action="adminBlog.php" method="post">
                            <div class="form-group">

                                <input type="text" class="form-control col-7 mb-3" placeholder="heading">
                                
                                <textarea type="text" class="form-control col-7 mb-3" placeholder="content"></textarea>
                                
                                <input type="text" class="form-control col-7 mb-3" placeholder="hashtags">

                                <input type="text" class="form-control col-7 mb-3" placeholder="Author">
                                
                                <input type="date" class="form-control col-7 mb-3">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" required/>
                                    <label class="form-check-label ">Are you sure, you want to upoad this blog?</label>
                                </div>
                                
                                <button class="btn btn-dark" >Upload</button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Deleting Blogs -->
                <div class="tab-pane fade border border-info my-2 active" id="list-delete" role="tabpanel" aria-labelledby="list-delete-list">
                    
                    <p class="h3 text-center heading1 top py-3">Delete Blogs</p>

                    <?php
                    if($error2){
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Invalid Id,</strong> unable to delete the desire Blog
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        ';    
                    }
                    ?>

                    <form action="adminBlog.php" method="post">
                        <div class="form-group">
                            <div class="col-md-8 d-inline-block mt-2 align-middle">
                                <label>Search Blog By Name</label>
                                <input type="text" class="form-control" name="blog" placeholder="Blog Name" required>
                                <?php if($error) {
                                    echo '<small class="text-danger">please recheck the entered text</small>';
                                    $class = "align-middle";
                                    }
                                ?>
                                
                            </div>
                            <div class="col-md-3 d-inline-block mt-2 <?php echo $class?>">
                                <button class="btn btn-dark" type="submit" name="search">Search</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    
                    if($showtable){
                        echo '
                        <div class="px-2">
                        <hr class="bg-success border border-top border-success">
                        <p class="h3 text-center"><u><b>Search Result</b></u></p>
                        <table class="table table-success">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>';

                        while($row=mysqli_fetch_assoc($result)){
                            echo'
                            <tr>
                            <th scope="row">'.$row['blogId'].'</th>
                            <td>'.$row['heading'].'</td>
                            <td>'.$row['date'].'</td>
                            <td>Active</td>
                            </tr>';
                        }
                        
                        echo'    
                        </tbody>
                        </table>
                        ';

                        //delete option
                        echo '
                        <hr class="bg-success border border-top border-success">
                        <form action="adminBlog.php" method="post">
                        <div class="form-group">
                            <div class="col-md-8 d-inline-block mt-2 align-middle">
                                <label>Delete Blog by BlogId</label>
                                <input type="number" class="form-control" name="id" placeholder="Enter BlogID">';
                            echo'    
                            </div>
                            <div class="col-md-3 d-inline-block mt-2 align-bottom">
                                <button class="btn btn-dark" type="submit" name="delete">Delete</button>
                            </div>
                        </div>
                        </form>
                        </div>
                        ';
                    
                    }
                    //waiting for input
                    else if(!$showtable && !isset($_SESSION['deleted'])){
                        echo '<div class="col-md-12 text-center"><p class="h3 text-info">waiting for you to search the blog...</p></div>';
                        echo '<div class="row">';
                        echo '<div class="col-md-12 text-center"><img class="img-fluid" src="../images/waiting.svg" width="400px" alt="waiting"></div>';
                        echo '</div>';
                    }

                    //show deleted table
                    else if(isset($_SESSION['deleted'])){
                        
                        echo '
                        <div class="px-2">
                        <hr class="bg-success border border-top border-success">
                        <p class="h3 text-center"><u><b>Deleted Data</b></u></p>
                        <table class="table table-danger">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>';
                        
                        $sql = "SELECT `heading`,`date`,`blogId` FROM deletedblogs WHERE blogId = '$_SESSION[deleted]'";
                        $result = mysqli_query($conn, $sql);
                        while($row=mysqli_fetch_assoc($result)){
                            echo'
                            <tr>
                            <th scope="row">'.$row['blogId'].'</th>
                            <td>'.$row['heading'].'</td>
                            <td>'.$row['date'].'</td>
                            <td>Deleted</td>
                            </tr>';
                        }

                        echo'    
                        </tbody>
                        </table>
                        <hr class="bg-danger border border-top border-success">
                        </div>
                        ';
                    }

                    ?>
                </div>

                <div class="tab-pane fade <?php echo $pending?>" id="list-pending" role="tabpanel" aria-labelledby="list-pending-list">Message</div>
            
            
            </div>
        </div>
    </div>
    </div>
</body>
</html>