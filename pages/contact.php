<?php
session_start();

$alert = 0;

if(isset($_POST['send'])){
    
    // importing database
    require '../connections/db_connect.php';

    //filtering the input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    // input filter function
    function injection($target){
        $injection = array("<",">",";","=","/");
        for($i=0; $i<5; $i++ ){
            if(strpos($target,$injection[$i])){
                return false;
            }
        }
        return true;
    }
    if(!injection($name)){
        goto error;
    }
    if(!injection($email)){
        goto error;
    }
    if(!injection($subject)){
        goto error;
    }
    if(!injection($content)){
        goto error;
    }

    $sql = "SELECT blogid from blogrequest where `heading`='$subject'";
    $result = mysqli_query($conn,$sql);

    //checking is request is already there in db
    if($result){
        if(mysqli_num_rows($result) == 1){
            $alert = 2;
        }
        else{
            //uploading blog data to blogrequest
            $sql = "INSERT INTO blogrequest(`heading`,`detail`) VALUES('$subject','$content')";
            $result = mysqli_query($conn,$sql);
            if($result){

                //fetching blogid from blogrequest
                $sql = "SELECT blogid from blogrequest where `heading`='$subject' and `detail`='$content'";
                $result2 = mysqli_query($conn,$sql);

                if($result2){
                    if(mysqli_num_rows($result2) == 1){
                        $row = mysqli_fetch_assoc($result2);
                        $id = $row['blogid'];

                        //uploading user data to blogrequest_user
                        $sql = "INSERT INTO blogrequest_user(`blogid`,`name`,`email`) VALUES('$id','$name','$email')";
                        $result3 = mysqli_query($conn,$sql);
                        if($result3){
                            $alert = 3;    
                        }
                        else{
                            $alert = 1;;
                        }
                    }
                    else{
                        $alert = 1;
                    }
                }
                else{
                    $alert = 1;
                }

            }
            else{
                $alert = 1;
            }
        }
    }
    else{
        $alert = 1;
    }
}

if(false){
    error:
    echo 'special characters are not allowed';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyberblog | Request Blog</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

</head>

<!-- pageloader -->
<div class="loader text-center" id="loading">
    <button class="btn btn-info mt-5 px-4" type="button" disabled>
        <span class="spinner-border" role="status" aria-hidden="true"></span>
        <br>
        <span class="h6">Loading...</span>
    </button>
</div>

<body>

    <?php include '../others/nav.php'?>

    <!-- important notice -->
    <div class="alert my-0 alert-warning alert-dismissible fade show" role="alert">
        <strong>Important Notice!</strong>
        You can earn a chance to become a top contributer and a valuable member of cyberblog by 
        <a href="postBlog.php" class="alert-link">Posting your own blog</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>

    <!-- info alert -->
    <?php
    
    //onerror
    if($alert == 1){
        echo'
        <div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
            <strong>Incountered an error!</strong>
            sorry we are unable to process your request at a time, kindly try again later
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ';
    }
    //on multiplle subbmition
    if($alert == 2){
        echo'
        <div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
            <strong>It\'s already there!</strong>
            Your request is alredy under review, we will let you know the status of your request through mail.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ';
    }
    //on success
    if($alert == 3){
        echo'
        <div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully sent!</strong>
            Your request has been successfully sent to admin and under review, we will let you know the status of your request throught mail.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ';
    }
    
    ?>

    <!-- form -->
    <div class="container bg-light my-4 border border-info">
        <div class="row">
            <h1 class="heading1 col-12 text-center top py-2">Contact Form</h1>
        </div>

        <form action="contact.php" method="post" class="form row">
            
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

                <div class="text-center">
                    <button type="submit" class="btn btn-info my-2" name="send">Send</button>
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
                                
                            </ul>
                            <p><b>Our Policy</b></p>
                            <ul>
                                <li>Your personal details won't be shared with any advertisers</li>
                                <li>Your personal details will be automatically deleted from the database after we processed your request</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 p-4">
                <img src="../images/contact.svg" class="img-fluide" alt="contact" width="100%">
            </div>
        </form>
    </div>
    
    <!-- contributers membership -->
    <div class="container my-3">
        <div class="row benifits py-2">
            <h1 class="heading1 col-12 text-center">FAQs</h1>
            <div class="col-md-8 py-3">
                <h1 class="h3">Can i also become a contributer?</h1>
                <p>yes you can! Now you can be on the contributers list and use the benifits. what you have to do is just <a href="postBlog.php" class="text-dark"><u>post some blogs</u></a>.</p>
                <h1 class="h3">Will everyone who post the blog will become a contributer?</h1>
                <p>No! it will be decided from the contents and number of blogs posted by the person.</p>
                <h1 class="h3">How will i become a top contributer?</h1>
                <p>It will be decided based on your performance by the admin.</p>
                <h1 class="h3">what are the benifits of a contributer?</h1>
                <p>You will be the part of our future project, chance to be a member of ethical hacker's community we are building and you can showcase the membership on professional platform and resume</p>
                <a href="contact.php" class="text-dark"><u><b>Still in doubt? Pass it to us</b></u></a>
            </div>
            <div class="col-md-4">
                <img src="../images/faq.png" alt="faq" class="img-fluid text-center">
            </div>
        </div>
    </div>

    <?php include '../others/footer.php'?>
        
<script type="text/javascript">
    function onReady(callback) {
    var intervalId = window.setInterval(function() {
        if (document.getElementsByTagName('body')[0] !== undefined) {
        window.clearInterval(intervalId);
        callback.call(this);
        }
    }, 1000);
    }

    function setVisible(selector, visible) {
    document.querySelector(selector).style.display = visible ? 'block' : 'none';
    }

    onReady(function() {
    setVisible('body', true);
    setVisible('#loading', false);
    });

</script>
</body>
</html>