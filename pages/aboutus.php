<?php

session_start();
$feedalert = 0;

if(isset($_POST['submit'])){
    
    include '../connections/db_connect.php';

    //assigning star ratings
    if(isset($_POST['rate-5'])){
        $star = 5;
    }
    else if(isset($_POST['rate-4'])){
        $star = 4;
    }
    else if(isset($_POST['rate-3'])){
        $star = 3;
    }
    else if(isset($_POST['rate-2'])){
        $star = 2;
    }
    else if(isset($_POST['rate-1'])){
        $star = 1;
    }
    else{
        echo 'check your inputs';
        goto out;
    }

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $name = htmlentities($name);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $email = htmlentities($email);
    $occupation = mysqli_real_escape_string($conn,$_POST['occupation']);
    $occupation = htmlentities($occupation);
    $review = mysqli_real_escape_string($conn,$_POST['content']);
    $review = htmlentities($review);

    // checking if feedback is already uploaded
    $sql = "SELECT `id` from feedback where `name`= '$name' and `review` = '$review'";
    $result = mysqli_query($conn,$sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            // echo 'data is already inserted';
            $feedalert = 1;
            goto out;
        }
    }

    // inserting the feedback
    $sql = "INSERT INTO feedback(`name`,`email`,`occupation`,`star`,`review`) VALUES('$name','$email','$occupation','$star','$review')";
    $result = mysqli_query($conn,$sql);
    if($result){
        if(mysqli_affected_rows($conn) > 0){
            // echo 'review saved';
            $feedalert = 1;
        }
        else{
            // echo 'unable to save your feedback try again later';
            $review = 2;
        }
    }
}

out:

// alerts
if($feedalert == 1){
    echo '
    <div class="alert my-0 alert-success alert-dismissible text-center fade show" role="alert">
    <strong>Thank You for your time!</strong> Your valuable feedback has been successfully uploaded. 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    ';
}
else if($feedalert == 2){
    echo '
    <div class="alert my-0 alert-danger alert-dismissible text-center fade show" role="alert">
    <strong>Unable to upload the feedback!</strong> Kindly check your inputs or please find some time to review us later. 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    ';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberRAT | About Us</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=2" crossorigin='anonymous'>
    
    <!-- web fonts -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Ubuntu&family=Courgette&display=swap" rel="stylesheet">


</head>
<body>
    <?php include '../others/nav.php' ?>
    <!-- head -->
    <div class=" mb-4 mx-auto head bg-info py-3">
        <div class="text-center">
            <img src="../images/logo.png" class="img-fluide" alt="logo" width="100px">
        </div>
        <h1 class="blanchedalmond text-center" style="font-family: 'Courgette', cursive;"><span style="font-family: 'Courgette', cursive;color:black;font-weight:normal;">Daily</span>Shell</h1>
        <p class="info text-center" style="font-family: 'Courgette', cursive;"><b><<span style="font-family: 'Courgette', cursive; color:blanchedalmond;"> We Live For The Terminal</span> ></b></p>
    </div>

    <div class="container">
        <!-- introduction -->
        <div class="row">
            <div class="col-md-6 align-middle py-4">
                <h1 class="heading1 text-capitalize">What we do and why?</h1>
                <p class="h5 text-justify">
                    CyberRat is a cross platform for ethical hackers and security expertese where they ment to share their doubt, experiance, and knowledge with each other.<br>
                    Getting proper guidance in the field of cyber security is very hard and important to find, we are trying to provide an effective way for enthuastic and aspiring hackers to get most of the required knowledge from a single place.<br>
                    If you are a experianced or professioal security expert, we are expecting you to share some of your knowledge to aspiring security expers through our blogs.
                </p>
            </div>
            <div class="col-md-6 text-center mb-3">
                <img src="../images/about1.png" width="350px" alt="hello" class="img-fluid">
            </div>
        </div>

        <hr>

        <!-- feedback form -->
        <form action="aboutus.php" class="bg-light px-4 py-3 border" method="post">
            <h1 class="heading1 text-center mb-2">Do You Appreciate our Initiative?</h1>
            <p class="text-center font-weight-bold">( Give us your valuable feedback )</p>
            <label for="name" class="mb-0">Enter Your Full Name:</label>
            <input type="text" name="name" id="name" placeholder="Full Name" class="form-control col-sm-8 mb-2" required>
            <label for="email" class="mb-0">Enter Your Email Address:</label>
            <input type="text" name="email" id="email" placeholder="Email ID" class="form-control col-sm-8 mb-2" required>
            <label for="occupation" class=" mb-0">Enter Your Occupation:</label>
            <input type="text" name="occupation" id="occupation" placeholder="occupation" class="form-control col-sm-8 mb-2" required>
            <label for="occupation" class="d-block mb-0"><small>Enter your aspiring carrer if you are a student e.g., aspiring network engineer</small></label>
            
            <label for="" class="mt-2 d-block">Star ratings:</label>
            <div class="ratings d-inline-block">
                <input type="radio" name="rate-5" class="text-left" id="5">
                <label for="5" data-toggle="tooltip" data-placement="top" title="Excellent" class="fas fa-star mx-1"></label>
                <input type="radio" name="rate-4" id="4">
                <label for="4" data-toggle="tooltip" data-placement="top" title="Very Good" class="fas fa-star mx-1"></label>
                <input type="radio" name="rate-3" id="3">
                <label for="3" data-toggle="tooltip" data-placement="top" title="Good" class="fas fa-star mx-1"></label>
                <input type="radio" name="rate-2" id="2">
                <label for="2" data-toggle="tooltip" data-placement="top" title="Bad" class="fas fa-star mx-1"></label>
                <input type="radio" name="rate-1" id="1">
                <label for="1" data-toggle="tooltip" data-placement="top" title="Very Bad" class="fas fa-star mr-1"></label>
            </div>
            <label for="content" class="d-block">Express in Words:</label>
            <textarea name="content" id="content" rows="3" placeholder="review under 150 words" class="form-control col-sm-8" required></textarea>

            <button type="submit" name="submit" class="btn btn-dark d-block mt-2 col-sm-2">Submit</button>
        </form>

    </div>
    
    <div class="container mt-3" style="background-color:blanchedalmond">
       
        <h1 class=" heading1 text-capitalize px-4 pt-4">Credits</h1>
        <p class="px-4 pb-4">(A website is never a work of an individual, special thanks to others plugins and resources for the contribution)</p>
        <div class="row my-4">

            <div class="col-md-6 text-center">
                <p class="h3"><u><b>Google Fonts</b></u></p> 
                    <p>(for font styles and ideas)</p>
                    <p class="h4" style="font-family: 'Courgette', cursive;">Courgette</p>
                    <p class="h4" style="font-family: 'monoton', cursive;"> Monoton</p>
                    <p class="h4" style="font-family: 'ubuntu', cursive;"> Ubuntu</p>
            </div>
            <div class="col-md-6 text-center">
                <p class="h3"><u><b>Freepik</b></u></p>
                <p>(for providing time saving vector arts)</p> 
                
    
            </div>
            <div class="col-md-6 text-center">
                <p class="h3"><u><b>Tinymce Editor</b></u></p>
                <p>(for providing ease in resource editing)</p> 
                
    
            </div>
            <div class="col-md-6 text-center">
                <p class="h3"><u><b>Fontawesome</b></u></p>
                <p>(for providing svg icons for bette visuals)</p> 
                
    
            </div>
        </div>
    
    </div>

    <?php include '../others/footer.php' ?>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>