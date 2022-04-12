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
$popularalert = 0;
$popular = "active show";
$latest = "";

//popular blog operations
if(isset($_POST['popular'])){
    
    if($_POST['oldid']){
        $oldid = (int)mysqli_real_escape_string($conn,$_POST['oldid']);
        $sql = "INSERT INTO popularblogs VALUES('$_POST[newid]') where popular_blogid = '$oldid'";
        $result = mysqli_query($conn,$sql);
        if($result){
            if(mysqli_affected_rows($conn) > 0){
                // echo 'blog replaced successfully';
                $popularalert = 1;
            }
            else{
                // echo 'please verify your inputs';
                $popularalert = 2;
            }
        }
    }
    else{
        $sql = "SELECT * from popularblogs";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 3){
            $popularalert = 4;
            goto popularend;
        }

        $newid = (int)mysqli_real_escape_string($conn,$_POST['newid']);
        $sql = "INSERT INTO popularblogs(`popular_blogid`) VALUE('$newid')";
        try{
            $result = mysqli_query($conn,$sql);
            if($result){
                if(mysqli_affected_rows($conn) > 0){
                    // echo 'new blog added successfully';
                    $popularalert = 1;
                }
                else{
                    // echo 'please verify your inputs';
                    $popularalert = 2;
                }
            }
        }
        catch(Exception $e){
            // echo 'the blog is already there';
            $popularalert = 3;
        }
    }
}

//latest blog operations
else if(isset($_POST['latest'])){
    $popular = "";
    $latest = "active show";

    if($_POST['oldid']){
        $oldid = (int)mysqli_real_escape_string($conn,$_POST['oldid']);
        $sql = "INSERT INTO latestblogs VALUES('$_POST[newid]') where latest_blogid = '$oldid'";
        $result = mysqli_query($conn,$sql);
        if($result){
            if(mysqli_affected_rows($conn) > 0){
                // echo 'blog replaced successfully';
                $popularalert = 1;
            }
            else{
                // echo 'please verify your inputs';
                $popularalert = 2;
            }
        }
    }
    else{
        $newid = (int)mysqli_real_escape_string($conn,$_POST['newid']);
        $sql = "INSERT INTO latestblogs(`latest_blogid`) VALUE('$newid')";
        try{
            $result = mysqli_query($conn,$sql);
            if($result){
                if(mysqli_affected_rows($conn) > 0){
                    // echo 'new blog added successfully';
                    $popularalert = 1;
                }
                else{
                    // echo 'please verify your inputs';
                    $popularalert = 2;
                }
            }
        }
        catch(Exception $e){
            // echo 'the blog is already there';
            $popularalert = 3;
        }
    }
}

popularend:

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberRAT | Latest & Trending</title>

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
            <div class="col-12 my-2">
                <div class="list-group list-group-horizontal-sm" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-info list-group-item-action <?php echo $popular?>" id="list-popular-list" data-toggle="list" href="#list-popular" role="tab" aria-controls="popular">Popular Blogs</a>
                    <a class="list-group-item list-group-item-info list-group-item-action <?php echo $latest?>" id="list-latest-list" data-toggle="list" href="#list-latest" role="tab" aria-controls="latest">Latest Blogs</a>
                </div>
            </div>

            <!-- alerts -->
            <?php
                if($popularalert == 1){
                    echo '
                    <div class="alert m-2  alert-success alert-dismissible fade show container" role="alert">
                    <strong>Operation Successful!</strong> Older blog is successfully replaced with newer blog having ID '.$newid.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
                else if($popularalert == 2){
                    echo '
                    <div class="alert m-2 alert-danger alert-dismissible fade show container" role="alert">
                    <strong>Operation Failed!</strong> Please verify your inputs and try again
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
                else if($popularalert == 3){
                    echo '
                    <div class="alert m-2 alert-danger alert-dismissible fade show container" role="alert">
                    <strong>Operation Failed!</strong> Either the blog is already there or the entered id is wrong
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }
                else if($popularalert == 4){
                    echo '
                    <div class="alert m-2 alert-danger alert-dismissible fade show container" role="alert">
                    <strong>Operation Failed!</strong> There is already 3 blogs available in the popular blog list, you must replace one if you intended to add one
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                }

            ?>

            <div class="col-12">
                <div class="tab-content" id="nav-tabContent">

                    <!-- popular operations body -->
                    <div class="tab-pane fade border border-info my-2 <?php echo $popular?>" id="list-popular" role="tabpanel" aria-labelledby="list-popular-list">
                        <p class="h3 text-center heading1 top py-3">Popular Blogs</p>
                        <form action="latestTrending.php" class="p-2" method="post">
                            <label class="col-sm-4" for="newid">Enter New BlogId</label>
                            <label class="col-sm-4" for="oldid">Replace With</label>
                            <input type="number" id="newid" name="newid" class="form-control col-sm-4 d-inline-block mb-2" placeholder="New ID" required/>
                            <input type="number" id="oldid" name="oldid" class="form-control col-sm-4 d-inline-block mb-2" placeholder="Existing ID"/>
                            <button type="submit" name="popular" class="btn btn-dark col-sm-2 d-inline-block mb-2" required>Replace</button>
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                Confirm
                                </label>
                            </div>
                        </form>

                        <!-- showing popular blogs tables -->
                        <div class="px-2">                                      
                            <?php
                            
                            $sql = "SELECT * from blogs INNER JOIN popularblogs ON blogs.blogid = popularblogs.popular_Blogid";
                            $result = mysqli_query($conn,$sql);
                            if($result){
                                if(mysqli_num_rows($result) > 0){
                                    echo '
                                    <table class="table table-info table-responsive mb-1">
                                        <thead class="bg-dark text-info">
                                            <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Heading</th>
                                            <th scope="col">Thumbnail Content</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Date<br>(Y-m-d)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    ';
                                    while($row = mysqli_fetch_assoc($result)){
                                        
                                        echo '
                                        <tr>
                                            <th scope="row">'.$row['blogid'].'</th>
                                            <td>'.$row['heading'].'</td>
                                            <td>'.$row['small_content'].'</td>
                                            <td>'.$row['author'].'</td>
                                            <td>'.$row['date'].'</td>
                                        </tr>
                                        ';
                                    }
                                    echo '
                                    </tbody>
                                    </table>
                                    ';
                                    
                                }
                                else{
                                    echo '<p class="text-danger">you dont have any popular blog added at the time';
                                }
                            }
                            else{
                                echo 'error fetching table';
                            }
                            ?>
                            
                        </div>
                    </div>
                
                    <!-- latest operations body -->
                    <div class="tab-pane fade border border-info my-2 <?php echo $latest?>" id="list-latest" role="tabpanel" aria-labelledby="list-latest-list">
                        <p class="h3 text-center heading1 top py-3">Latest Blogs</p>
                        <form action="latestTrending.php" class="p-2" method="post">
                            <label class="col-sm-4" for="newid">Enter New BlogId</label>
                            <label class="col-sm-4" for="oldid">Replace With</label>
                            <input type="number" id="newid" name="newid" class="form-control col-sm-4 d-inline-block mb-2" placeholder="New ID" required/>
                            <input type="number" id="oldid" name="oldid" class="form-control col-sm-4 d-inline-block mb-2" placeholder="Existing ID"/>
                            <button type="submit" name="latest" class="btn btn-dark col-sm-2 d-inline-block mb-2" required>Replace</button>
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" id="flexCheck">
                                <label class="form-check-label" for="flexCheck">
                                Confirm
                                </label>
                            </div>
                        </form>

                        <!-- showing latest blogs tables -->
                        <div class="px-2">                                      
                            <?php
                            
                            $sql = "SELECT * from blogs INNER JOIN latestblogs ON blogs.blogid = latestblogs.latest_Blogid";
                            $result = mysqli_query($conn,$sql);
                            if($result){
                                if(mysqli_num_rows($result) > 0){
                                    echo '
                                    <table class="table table-info table-responsive mb-1">
                                        <thead class="bg-dark text-info">
                                            <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Heading</th>
                                            <th scope="col">Thumbnail Content</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Date<br>(Y-m-d)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    ';
                                    while($row = mysqli_fetch_assoc($result)){
                                        
                                        echo '
                                        <tr>
                                            <th scope="row">'.$row['blogid'].'</th>
                                            <td>'.$row['heading'].'</td>
                                            <td>'.$row['small_content'].'</td>
                                            <td>'.$row['author'].'</td>
                                            <td>'.$row['date'].'</td>
                                        </tr>
                                        ';
                                    }
                                    echo '
                                    </tbody>
                                    </table>
                                    ';
                                    
                                }
                                else{
                                    echo '<p class="text-danger">you dont have any latest blog added at the time';
                                }
                            }
                            else{
                                echo 'error fetching table';
                            }
                            ?>
                            
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="text-center px-3">
        <a href="adminHome.php" class="btn btn-info col-sm-2 mb-4 my-2">Admin Home</a>
    </div>

    <?php include '../others/footer.php'?>
</body>
</html>