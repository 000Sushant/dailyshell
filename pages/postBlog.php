<?php

session_start();
$error = 0;

if(isset($_POST['send'])){

    // importing database
    require '../connections/db_connect.php';

    // checking if any file is selected
    if(strlen($_FILES["file"]["name"]) >= 5){
        // checking if the file is in pdf
        $img_ext = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        if($img_ext === 'pdf'){

            // $img_ext = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
            
            // filtering uploaded file
            $script = array(".jsp",".asp",".php",".html",".sql",".py",".js",".sh",".jdk",".jpg",".jpeg",".png");
            for($i=0; $i<12; $i++ ){
                if($img_ext === $script[$i]){
                    $error = 1;
                }
            }
            

            //filtering the inputs
            $name = htmlentities(mysqli_real_escape_string($conn, $_POST['name']));
            $email = htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
            $subject = htmlentities(mysqli_real_escape_string($conn, $_POST['subject']));
            $content = htmlentities(mysqli_real_escape_string($conn, $_POST['content']));
            $linkedin = htmlentities(mysqli_real_escape_string($conn, $_POST['linkedin']));
            $instagram = htmlentities(mysqli_real_escape_string($conn, $_POST['instagram']));
            $twitter = htmlentities(mysqli_real_escape_string($conn, $_POST['twitter']));

            //after all inputs and file are verified

            //uploading the file on the server
            // $img_name = $_FILES["file"]["name"];
            $img_loc = $_FILES["file"]["tmp_name"];
            // $img_ext = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
            $img_des= "../files/".$subject.".".$img_ext;
            $img_name = $subject.".".$img_ext;
            
            //checking if the request is already done
            $sql = "SELECT blogid from postrequest where `heading` = '$subject'";
            $result = mysqli_query($conn,$sql);
            if($result){
                if(mysqli_num_rows($result) == 1){
                    goto error5;
                }
            }

            //uploading info to postrequest db
            $sql = "INSERT INTO postrequest(`heading`,`content`,`file`) VALUES('$subject','$content','$img_name')";
            $result = mysqli_query($conn,$sql);
            if($result){
                //fetching blogid for postrequest_user
                $sql = "SELECT blogid from postrequest where `heading`='$subject'";
                $result2 = mysqli_query($conn,$sql);
                if($result2){
                    //if got the blogid
                    if(mysqli_num_rows($result2) == 1){

                        $row = mysqli_fetch_assoc($result2);
                        $id =$row['blogid'];

                        $sql = "INSERT INTO postrequest_user(`blogid`,`name`,`email`,`linkedin`,`instagram`,`twitter`) VALUES('$id','$name','$email','$linkedin','$instagram','$twitter')";
                        $result3 = mysqli_query($conn,$sql);
                        if($result3){
                            move_uploaded_file($img_loc,$img_des);
                            $error = 4;
                        }
                    }
                    else{
                        $error = 2;
                    }

                }
                else{
                    $error = 2;
                }
            }    
            else{
                // echo 'error fecthing blogid';
                $error = 2;
            }
        }
        else{
            error:
            $error = 1;
            // echo 'we accept pdf files only';
        }
    }
    else{
        $error = 1;
        // echo 'you havn\'t selected any file';
    }

}

if($error === 3){
    error3:
    $error = 3;
}
if($error == 5){
    error5:
    $error = 5;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyberrat | Postblog</title>

     <!-- bootstrap -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=4" crossorigin='anonymous'>

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

</head>

<body>
    <?php include '../others/nav.php'?>

    <!-- alert -->
    <?php
    if($error == 1){
        echo '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
        <strong>Invalid File Format!</strong>
        Please upload pdf file only, and refer to terms and conditions.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';

    }
    else if($error == 2){
        echo '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
        <strong>Server Error!</strong>
        Unable to reach the server at a time, please try again later.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
    else if($error == 3){
        echo '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
        <strong>Caught Malicious Performance!</strong>
        We detected some characters on your text which are not allowed. avoid using characters like, carrot symbol, semi-colon, equal and forward slash
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
    else if($error == 4){
        echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
        <strong>Successfully Posted</strong>
        Your blog has be successfully posted and under review by admin, you will receive further blog status through mail
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';

        echo '
        <div class="text-center">
        <img src="../images/done.png" alt="success" width="350px" class="img-fluid">
        </div>
        ';
    }
    else if($error == 5){
        echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
        <strong>Be patient!</strong>
        It\'s already there and under review, you will receive further blog status through mail.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        echo '
        <div class="text-center">
        <img src="../images/done.png" alt="success" width="350px" class="img-fluid">
        </div>
        ';
    }

    ?>

    <div class="container bg-light my-4 border border-info">
        <div class="row">
            <h1 class="heading1 col-12 text-center top py-2">Post Blog</h1>
        </div>

        <form action="postBlog.php" method="post" class="row" enctype="multipart/form-data">

            <div class="col-md-6">
                <label for="name">Enter Your Full Name<span class="text-danger">*</span></label>
                <input type="text" id="name" class="form-control mb-3" name="name" placeholder="Full Name" required></input>
            
                <label for="email">Enter Your Email ID<span class="text-danger">*</span></label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email Address" required></input>
                <small class="form-text text-muted mb-3">We will inform you the status of your request to this Address </small>
            
                <label for="subject">Enter Your Subject<span class="text-danger">*</span></label>
                <input type="text" class="form-control mb-3" name="subject" id="subject" placeholder="Subject" required></input>

                <label for="content">Describe your Content<span class="text-danger">*</span></label>
                <textarea text="text" name="content" id="content" class="form-control mb-3" cols="30" rows="4" placeholder="Content" required></textarea>
                
                <div class="myfile">
                    <input type="file" id="file" name="file" class="col-12 mt-2" accept="application/pdf" required>
                    <label for="file"><small>upload pdf file only<span class="text-danger">*</span></small></label>
                </div>

                <!-- modal defincation -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Terms And Conditions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><b>Sender's Policy</b></p>
                                <ul>
                                    <li>I am not performing any malacious or mischeif activity by sending these details</li>
                                    <li>All detailes i am sending are mine and correct</li>
                                    <li>The file i am uploading is in .pdf format</li>
                                    
                                </ul>
                                <p><b>Our Policy</b></p>
                                <ul>
                                    <li>Your personal details won't be shared with any advertisers</li>
                                    <li>Your personal details will be automatically deleted from the database after we processed your request</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- social medias -->
            <div class="col-md-6 px-3">
                <h4 class="mt-2"><b>Social Media</b></h4>
                <p>Social media will give us an alternative to contact you, and it will increase you connections if you were selected as a contributer</p>
                <small class="d-block mb-3 text-danger">Avoid putting the whole link, insted just insert the User ID/Profile ID</small>

                <label for="linkedin">LinkedIn ID</label>
                <input type="text" id="linkedin" class="form-control mb-3" name="linkedin" placeholder="Profile ID" ></input>

                <label for="instagram">Instagram ID</label>
                <input type="text" id="instagram" class="form-control mb-3" name="instagram" placeholder="Profile ID"></input>
                
                <label for="twitter">Twitter ID</label>
                <input type="text" id="twitter" class="form-control mb-3" name="twitter" placeholder="Profile ID"></input>

                <div class="form-check sm-text-center">
                    <input class="form-check-input" type="checkbox" value="" name="policy" id="flexCheckDefault" required>
                    <label class="form-check-label" for="flexCheckDefault" >
                    I am accepting all the <a href="#" data-toggle="modal" data-target="#exampleModal">Terms and Conditions</a><span class="text-danger">*</span> 
                    </label>
                    <br>
                    <input class="form-check-input" type="checkbox" value="" name="cpolicy" id="flexCheckDefault2" required>
                    <label class="form-check-label" for="flexCheckDefault2">
                    I have read the terms and conditions mention above<span class="text-danger">*</span>
                </div>
                
                <button type="submit" class="btn btn-info my-2" name="send">Send</button>
            </div>
        </form>

    </div>

    <?php include '../others/footer.php'?>

</body>
</html>