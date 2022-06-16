<?php
session_start();

// unauthorized user
if(!isset($_SESSION['active']) || $_SESSION['active'] == false || strlen($_SESSION['name']) == 0){
    echo '
    <div style="text-align: center; ">
    <img src="../images/404.jpg" alt="404 error" style="max-width:700px;height:auto;">
    </div>
    Illustration Author: <a href="http://www.freepik.com">Designed by stories / Freepik</a>
    ';
    session_unset();
    session_destroy();
    die();
}

include '../connections/db_connect.php';

require 'partials/adminBlogOpn.php';

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
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

    <!-- summernote -->
    <link href="../others/summernote/summernote-bs4.min.css" rel="stylesheet">
    <script src="../others/summernote/summernote-bs4.min.js"></script>
    
    <!-- tinymce editer -->
    <script src="https://cdn.tiny.cloud/1/1o1q0am7e9xmnzmg4n0cor2rpl24dyh2tgilp9z8gofuhu5c/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>

        const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', './partials/uploadBlogImage.php');
            
            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };
            
            xhr.onload = () => {
                if (xhr.status === 403) {
                    reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                    return;
                }
            
                if (xhr.status < 200 || xhr.status >= 300) {
                    reject('HTTP Error: ' + xhr.status);
                    return;
                }
            
                const json = JSON.parse(xhr.responseText);
            
                if (!json || typeof json.location != 'string') {
                    reject('Invalid JSON: ' + xhr.responseText);
                    return;
                }
            
                resolve(json.location);
            };
            
            xhr.onerror = () => {
            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };
            
            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            
            xhr.send(formData);
        });

    tinymce.init({
        selector: '#wysiwyg',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        images_upload_url: './partials/uploadBlogImage.php',
        images_upload_handler: image_upload_handler_callback,
    });
  </script>

</head>
<body>
    <?php include '../others/nav.php'?>

    <!-- alerts -->
    <?php
        
        //blogrequest and delete blog alerts
        if($blogreqalert == 1){
            echo '
            <div class="alert mt-2 alert-success alert-dismissible fade show container" role="alert">
            <strong>Successfully Deleted!</strong>The request having ID '.$id.' is successfully deleted from the DB
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
        }
        else if($blogreqalert == 2){
            echo '
            <div class="alert mt-2 alert-danger alert-dismissible fade show container" role="alert">
            <strong>Unable to delete!</strong>, Please cross verify your inputs and server connectivity.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
        }
        if($addblog == 1){
            echo '
            <div class="alert mt-2 alert-success alert-dismissible fade show container" role="alert">
            <strong>Successfully Uploaded!</strong>The blog has been successfully uploaded to the DB
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
        }
        else if($addblog == 2){
            echo '
            <div class="alert mt-2 alert-success alert-dismissible fade show container" role="alert">
            <strong>Already There!</strong>The blog you are trying to upload is already there in the DB
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
        }
        else if($addblog == 3){
            echo '
            <div class="alert mt-2 alert-success alert-dismissible fade show container" role="alert">
            <strong>Operation Failed!</strong> Unable to upload the blog, please try again later or check your inputs.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
        }
    ?>

    <div class="container my-2">
    <div class="row">
        <div class="col-12">
            <div class="list-group list-group-horizontal-sm" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-info list-group-item-action <?php echo $add?>" id="list-add-list" data-toggle="list" href="#list-add" role="tab" aria-controls="add">Add Blog</a>
                <a class="list-group-item list-group-item-info list-group-item-action <?php echo $delete?>" id="list-delete-list" data-toggle="list" href="#list-delete" role="tab" aria-controls="delete">Delete Blog</a>
                <a class="list-group-item list-group-item-info list-group-item-action <?php echo $blogreq?>" id="list-postreq-list" data-toggle="list" href="#list-blogreq" role="tab" aria-controls="blogreq">Blog Requests</a>
                <a class="list-group-item list-group-item-info list-group-item-action <?php echo $postreq?>" id="list-blogreq-list" data-toggle="list" href="#list-postreq" role="tab" aria-controls="postreq">Post Request</a>
            </div>
        </div>
  
        <div class="col-12">
            <div class="tab-content" id="nav-tabContent">
                
                <!-- Add Blogs -->
                <div class="tab-pane fade border border-info my-2 <?php echo $add?>" id="list-add" role="tabpanel" aria-labelledby="list-add-list">
                    <p class="h3 text-center heading1 top py-3">Add Blogs</p>
                    <div class="px-2">
                        <form action="adminBlog.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">

                                <input type="text" class="form-control col-sm-10 mb-3" name="heading" placeholder="heading" maxlength="50" required>
                                <input type="text" class="form-control col-sm-10 mb-3" name="hashtags" placeholder="#hashtag1 #hashtag2.."maxlength="150"  required>
                                <input type="text" class="form-control col-sm-10 mb-3" name="author" placeholder="Author" maxlength="30" required>                                
                                
                                <div class="myfile">
                                    <input type="file" id="file" name="file" class="col-sm-10 " accept="images/*" required>
                                    <label for="file" class="d-block"><small>upload png, jpeg or jpg file only<span class="text-danger">*</span></small></label>
                                </div>
                                
                                <!-- thumbnail content -->
                                <textarea type="text" class="form-control col-sm-10 my-2" name="smallcontent" placeholder="small content (250 words)" maxlength="250" required></textarea>                              
                                
                                <!-- tinymce wysiwyg-->
                                <textarea id="wysiwyg" name="content"></textarea>

                                <div class="form-check text-center mt-4">
                                    <input class="form-check-input" type="checkbox" id="checkbox" required/>
                                    <label class="form-check-label" for="checkbox">Are you sure, you want to upoad this blog?</label>
                                </div>
                                
                                <button class="btn btn-dark col-sm-2 mt-2 mx-auto d-block" type="submit" name="addblog">Upload</button>
                            </div>
                        </form>
                    </div>
                    
                </div>

                <!-- Deleting Blogs -->
                <div class="tab-pane fade border border-info my-2 <?php echo $delete?>" id="list-delete" role="tabpanel" aria-labelledby="list-delete-list">
                    
                    <p class="h3 text-center heading1 top py-3">Delete Blogs</p>

                    <?php
                    if($deletealert == 2){
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Invalid Id!</strong> unable to delete the desire Blog
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        ';    
                    }
                    else if($deletealert == 1){
                        echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> the blog having id "'.$id.'" is successfully deleted
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
                        <table class="table table-info table-responsive">
                        <thead class="text-info bg-dark">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Content</th>
                            <th scope="col">Author</th>
                            <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>';

                        while($row=mysqli_fetch_assoc($result)){
                            echo'
                            <tr>
                            <th scope="row">'.$row['blogid'].'</th>
                            <td>'.$row['heading'].'</td>
                            <td>'.$row['small_content'].'</td>
                            <td>'.$row['author'].'</td>
                            <td>'.$row['date'].'</td>
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
                                <button class="btn btn-danger" type="submit" name="delete">Delete</button>
                            </div>
                        </div>
                        </form>
                        </div>
                        ';
                    
                    }
                    //waiting for input
                    else if(!$showtable && !isset($_SESSION['deleted'])){
                        echo '<div class="col-md-12"><p class="h3 text-info">waiting for you to search the blog...</p></div>';
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
                
                <!-- Blog Requests -->
                <div class="tab-pane fade border border-info my-2 <?php echo $blogreq?>" id="list-blogreq" role="tabpanel" aria-labelledby="list-blogreq-list">
                    <p class="h3 text-center heading1 top py-3">Blog Reqeuests</p>
                    <form action="adminBlog.php" class="px-2" method="post">
                        <label class="d-block">Enter Request ID to delete</label>
                        <input type="number" class="form-control col-md-8 d-inline-block mb-3" name="reqid" placeholder="Requst ID" required>
                        <button class="btn btn-danger col-md-2 px-2 mx-sm-2 mb-2 d-inline-block" type="submit" name="delblogreq">Delete</button>
                        <div class="form-check d-inline-block">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Confirm
                            </label>
                        </div>
                    </form>

                    <div class="px-2">
                             
                        <?php
                        $sql = "SELECT * from blogrequest INNER JOIN blogrequest_user ON blogrequest.blogid = blogrequest_user.blogid";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                echo '
                                <table class="table table-info table-responsive mb-1">
                                    <thead class="bg-dark text-info">
                                        <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Heading</th>
                                        <th scope="col">Discription</th>
                                        <th scope="col">Date<br>(Y-m-d)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                ';
                                while($row = mysqli_fetch_assoc($result)){
                                    
                                    echo '
                                    <tr>
                                        <th scope="row">'.$row['blogid'].'</th>
                                        <td>'.$row['name'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>'.$row['heading'].'</td>
                                        <td>'.$row['detail'].'</td>
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
                                echo '<p class="text-danger">you dont have any blog request at the time';
                            }
                        }
                        else{
                            echo '<p class="text-danger">error fetching table';
                        }
                        ?>
                            
                            
                    </div>
                </div>
                
                <!-- post request -->
                <div class="tab-pane fade border border-info my-2 <?php echo $postreq?>" id="list-postreq" role="tabpanel" aria-labelledby="list-postreq-list">
                    <p class="h3 text-center heading1 top py-3">Post Request</p>
                    <form action="adminBlog.php" class="p-2" method="post">
                        <label class="d-block">Delete Post Request</label>
                        <input type="number" name="postid" class="form-control col-md-8 d-inline-block mb-3" placeholder="Request ID"/>
                        <button type="submit" name="postreq" class="btn btn-danger col-md-2 px-2 mx-sm-2 mb-2 d-inline-block">Delete</button>
                        <div class="form-check d-inline-block">
                            <input class="form-check-input" type="checkbox" id="flexCheck">
                            <label class="form-check-label" for="flexCheck">
                            Confirm
                            </label>
                        </div>
                    </form>
                    
                    <div class="px-2">
                    <?php
                    
                        $sql = "SELECT * from postrequest inner join postrequest_user on postrequest.blogid = postrequest_user.blogid";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                echo'    
                                    <table class="table table-info table-responsive mb-1">
                                        <thead class="bg-dark text-info">
                                            <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Heading</th>
                                            <th scope="col">Discription</th>
                                            <th scope="col">File</th>
                                            <th scope="col">Linkedin</th>
                                            <th scope="col">Instagram</th>
                                            <th scope="col">Twitter</th>
                                            <th scope="col">Date<br>(Y-m-d)</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                while($row = mysqli_fetch_assoc($result)){
                                        
                                    echo '
                                    <tr>
                                        <th scope="row">'.$row['blogid'].'</th>
                                        <td>'.$row['name'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>'.$row['heading'].'</td>
                                        <td>'.$row['content'].'</td>
                                        <td><a href="../files/requestedBlogs'.$row['file'].'" target="_BLANK" class="text-dark"><i class="fa fa-download"></i></a></td>
                                        <td>'.$row['linkedin'].'</td>
                                        <td>'.$row['instagram'].'</td>
                                        <td>'.$row['twitter'].'</td>
                                        <td>'.$row['date'].'</td>
                                    </tr>
                                    ';
                                }
                                echo'
                                </tbody>
                            </table>';
                            }
                            else{
                                echo '<p class="text-danger">no pending post request at the time';
                            }
                        }
                        else{
                            echo '<p class="text-danger">Error fetching database';
                        }
                        
                    ?>
                    </div>
                </div>

                <!-- home button -->
                <div class="text-center py-4">
                    <a href="adminHome.php" class="btn btn-info col-sm-2 mx-auto">Admin Home</a>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php include '../others/footer.php'?>
</body>
</html>