<?php
session_start();

include '../connections/db_connect.php';
$waiting = true;

if(isset($_POST['homeSubmit']) || isset($_POST['submit']) || isset($_GET['searchPage'])){
    $waiting = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyebrblog | Blog List</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=0" crossorigin='anonymous'>

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=Ubuntu&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

</head>
<body>
    <?php require '../others/nav.php'?>

    <div class="bg-info head pb-4">
        <div class="container">
            <h1 class="text-center">CyberbloG</h1>
            <div class="quickLinks d-block text-center my-3 mx-auto">
                <form class="mx-2 d-inline-block" action="searchBlog.php" method="post">
                    <input type="hidden" value="linux" name="homeSearch" required/>
                    <button class="btn btn-outline-dark" type="submit" name="homeSubmit">Linux</button>
                </form>
                <form class="mx-2 d-inline-block" action="searchBlog.php" method="post">
                    <input type="hidden" value="windows" name="homeSearch" required/>
                    <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Windows</button>
                </form>
                <form class="mx-2 d-inline-block" action="searchBlog.php" method="post">
                    <input type="hidden" value="hacking" name="homeSearch" required/>
                    <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Hacking</button>
                </form>
                <form class="mx-2 d-inline-block" action="searchBlog.php" method="post">
                    <input type="hidden" value="cyber security" name="homeSearch" required/>
                    <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Cyber Security</button>
                </form>
                <form class="mx-2 d-inline-block" action="searchBlog.php" method="post">
                    <input type="hidden" value="virtualization" name="homeSearch" required/>
                    <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Virtualization</button>
                </form>
                <form class="mx-2 d-inline-block" action="searchBlog.php" method="post">
                    <input type="hidden" value="latest tech" name="homeSearch" required/>
                    <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Latest Tech</button>
                </form>
            </div>
            <form class="row my-2 my-lg-0 mx-auto" action="searchBlog.php" method="post">
                <input type="text" name="blogStr" class="form-control ml-auto col-6" placeholder="Search" required />
                <button type="submit" name="submit" class="ml-2 mr-auto btn btn-dark my-2 my-sm-0">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    
    <?php
    if($waiting){
    echo '
        <h1 class="heading1 text-center my-2 mt-3" style="font-family:ubuntu">Top Blogs</h1>';
    }
    else{
        echo '
        <h1 class="heading1 text-center my-2 mt-3" style="font-family:ubuntu">Search Result</h1>';
    }
    ?>

    <!-- showing search result -->
    <div class="container text-center">
        <div class="row bg-light py-2">

            <?php
            
            // showing all blogs by default 
            if($waiting){

                //checking the active page
                if(!isset($_GET['page'])){
                    $_GET['page'] = 1;
                    $page = 1;
                    $sql = "SELECT * from blogs LIMIT 0,3";
                    // echo $sql;
                }
                else{
                    $page = $_GET['page'];
                    $temp_1 = ($page-1)*3;
                    $temp_2 = $temp_1 + 3;
                    $sql = "SELECT * from blogs LIMIT $temp_1,$temp_2";
                    $sql = "SELECT * from blogs LIMIT 3 OFFSET 3";
                    // echo $sql;
                }

                
                $result = mysqli_query($conn, $sql);

                if($result){
                    
                    if(mysqli_num_rows($result) > 0 ){

                        // showing all blogs
                        while($row = mysqli_fetch_assoc($result)){
                            echo '
                            <div class="col-md-4 my-2 mx-auto">
                                <div class="bg-light border d-inline-block border-info p-2 text-left">
                                    <div class="thumbnail">
                                        <img src="../files/thumbnails/'.$row['demo_image'].'" class="img-fluid" alt="demo image">
                                    </div>           
                                    <p class="lead text-capitalize"><b>'.$row['heading'].'</b></p>
                                    <p class="my-0 author text-secondary">
                                    <i class="fa fa-user"></i> '.$row['author'].' |
                                    <i class="fa fa-calendar"></i> '.$row['date'].'
                                    </p>
                                    <p class="text-justify">"'.substr($row['small_content'],0,200).'..."</p>
                                    <form action="blogs.php" method="post">
                                        <input type="hidden" name="activeBlog" value="'.$row['blogid'].'">
                                        <button type="submit" class="btn btn-dark">learn more</button>
                                    </form>
                                </div>
                            </div>
                            ';
                        }

                        //calculating total no of pages
                        $result_pp = 3; //result_per_page

                        $sql = "SELECT * FROM blogs";
                        $result = mysqli_query($conn, $sql);
                        $total_rows = mysqli_num_rows($result); 
                        $total_pages = ceil($total_rows/$result_pp);

                        
                        //printing pagination list
                        echo'
                        <div class="col-12 mt-2 ">
                            <nav aria-label=" Page navigation example">
                            <ul class="pagination">';

                            for( $page=1 ;  $page<=$total_pages; $page++){
                                $waiting = false;
                                //highlighting active page
                                $class="";

                                if($page == $_GET['page']){
                                    $class = "bg-info text-light";
                                }
                                echo '<li class=" page-item ">
                                <a class="page-link '.$class.'" href="searchBlog.php?page='.$page.'">'.$page.'</a>';
                            }
                            
                            echo'
                            </ul>
                            </nav>
                        </div>';

                    }
                }
                else{
                    echo '
                        <div class="alert mx-auto w-50 alert-danger" role="alert">
                            couldn\'t reach the database at the moment kindly try again later (Server error)
                        </div>
                    ';
                }
            }
            
            //showing search result
            if(isset($_POST['homeSubmit']) || isset($_POST['submit']) || isset($_GET['searchPage'])){

                // checking if the input is from this page or homepage
                if(isset($_POST['submit'])){
                    $str = mysqli_real_escape_string($conn,$_POST['blogStr']);
                }
                else{
                    echo $_POST['homeSubmit'];
                    $str = mysqli_real_escape_string($conn,$_POST['homeSearch']);
                }
                
                $sql = "SELECT * from blogs WHERE `heading` LIKE '%$str%' OR `content` LIKE '%$str%' OR `hashtags` LIKE '%$str%'";
                $result = mysqli_query($conn, $sql);
                
                if($result){
                    if(mysqli_num_rows($result) > 0 ){
                        
                        // showing total number or blog found
                        // $temp = mysqli_num_rows($temp_row_result);
                        $temp = mysqli_num_rows($result);
                        echo '<p class="col-12 text-success">'.$temp.' search result found</p>';
                        while($row = mysqli_fetch_assoc($result)){
                            echo '
                            <div class="col-md-4 my-2 mx-auto">
                                <div class="bg-light border d-inline-block border-info p-2 text-left">
                                    <div class="thumbnail">
                                        <img src="../files/thumbnails/'.$row['demo_image'].'" class="img-fluid" alt="demo image">
                                    </div>           
                                    <p class="lead text-capitalize"><b>'.$row['heading'].'</b></p>
                                    <p class="my-0 author text-secondary">
                                    <i class="fa fa-user"></i> '.$row['author'].' |
                                    <i class="fa fa-calendar"></i> '.$row['date'].'
                                    </p>
                                    <p>"'.substr($row['small_content'],0,200).'..."</p>
                                    <form action="blogs.php" method="post">
                                        <input type="hidden" name="activeBlog" value="'.$row['blogid'].'">
                                        <button type="submit" class="btn btn-info">learn more</button>
                                    </form>
                                </div>
                            </div>
                            ';
                        }
                    
                   
                    }
                    else{
                        echo '            
                            <div class="alert mx-auto w-50 alert-danger" role="alert">
                                It seems there isn\'t any blog regarding your search right now,<br> 
                                <a href="../" class="alert-link">explore more</a> or 
                                <a href="requestBlog.php" class="alert-link">request your blog</a>
                            </div>                 
                        ';
                    }
                    
                }
                else{
                    echo '
                        <div class="alert mx-auto w-50 alert-danger" role="alert">
                            couldn\'t reach the database at the moment kindly try again later (Server error)
                        </div>
                    ';
                }
            }
            ?>
        </div>
           
    </div>
    <?php include '../others/footer.php'?>
</body>
</html>