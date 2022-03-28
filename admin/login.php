<?php

session_start();
$error = false;

if(isset($_POST['submit'])){
    
    //including database
    require '../connections/db_connect.php';
    
    $id = (int)mysqli_real_escape_string($conn,$_POST['id']);
    $pass = mysqli_real_escape_string($conn,$_POST['pass']);
    $cpass = mysqli_real_escape_string($conn,$_POST['cpass']);
    
    if(strlen($pass)<8 || strlen($cpass)<8 || !(strlen($id)==6)){
        $error = true;
    }
    else{

        if($_POST['pass']===$_POST['cpass']){

            $sql = "SELECT `name`,`userpass` FROM admin_user WHERE `userid`='$id'";
            $result=mysqli_query($conn, $sql);

            if($result){
                if(mysqli_num_rows($result) == 1){
                
                    $row=mysqli_fetch_assoc($result);

                    if($pass === $row['userpass']){
                        $_SESSION['active'] = true;
                        $_SESSION['name'] = $row['name'];
                        header("location:adminHome.php");
                    }
                    else{
                        echo 'password isnt matching';
                        $error = true;
                    }
                }
                else{
                    echo 'couldn\'t run the query';
                    $error = true;
                }
            }
            else{
                echo 'error connecting database';
                $error = true;
            }
        }
        else{
            echo 'password dosnt match';
            $error = true;
        }
    }
}

// fetching IP Address
function getIPAddress() {  
    //whether ip is from the share internet  
     if(isset($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }  
    //whether ip is from the proxy  
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
    //whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];
     }  
     return $ip;  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>

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

    <!-- captcha -->
    <!-- <script src="https://www.google.com/recaptcha/api.js"></script> -->
    

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
    <?php
    
    if($error){
        echo '
        <div class="alert mt-2 alert-danger alert-dismissible fade show container" role="alert">
        <strong>Incorrect credentials</strong>, your action and IP address '.getIPAddress().' has been recorded and monitored. be carefull next time.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        ';
    }

    ?>

    <div class="container my-4">
        <div class="row">
            <div class="col-md-5 mt-3 mx-auto text-center bg-light border border-info">
                
                <div class="top row mb-3">
                    <img src="../images/cbc_logo.jpg" alt="logo" class="img-fluid mx-auto logo m-2">
                    <h1 class="h2 col-12">CyberblogG</h1>
                </div>

                <form action="login.php" class="form-group text-left px-4" method="post">                  
                        <label class="font-weight-bold">Enter Admin ID:</label>
                        <input type="number" name="id" class="form-control mx-auto mb-3" placeholder="Admin ID" >
                        
                        <label class="font-weight-bold">Enter Admin Passsword:</label>
                        <input type="text" name="pass" class="form-control mx-auto mb-3" placeholder="Admin Password" >
                        
                        <label class="font-weight-bold">Confirm Admin Passsword:</label>
                        <input type="text" name="cpass" class="form-control mx-auto" placeholder="Confirm Password" >
                    
                        <button class=" mt-3 mx-auto btn btn-dark" type="submit" name="submit">Login</button>
                
                        <!-- captcha button -->
                        <!-- <button class="g-recaptcha" 
                            data-sitekey="reCAPTCHA_site_key" 
                            data-callback='onSubmit' 
                            data-action='submit'>Submit</button> -->
                </form>
            </div>
        </div>
    </div>

    <?php include '../others/footer.php'?>
    <script>
        // script for pageloader
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

        // captcha function
        // function onSubmit(token) {
        //     document.getElementById("demo-form").submit();
        // }
    </script>
</body>
</html>