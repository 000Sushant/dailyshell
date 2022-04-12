<?php

session_start();
include '../connections/db_connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberRAT | Contributers</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=Ubuntu&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

</head>
<body>
    <?php include '../others/nav.php'?>
    
    
    <div class="container">

        <!-- valuable contributer -->
        <div class="row topContributer px-4 pt-2 mt-3 pb-4 bg-light border">

                <h1 class="heading1 text-center col-12 mb-4">Valuable Contributers</h1>
                
                <?php
                    $sql = "SELECT * from contributer_user where `position` = 'vc'";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){

                                // checking if social media link is given
                                if(strlen($row['linkedin']) == 0){
                                    $linkedin = "";
                                }
                                else{
                                    $linkedin = "href='https://linkedin/in/".$row['linkedin']."'";
                                }
                                if(strlen($row['facebook']) == 0){
                                    $facebook = "";
                                }
                                else{
                                    $facebook = "href=\"https://www.facebook.com/profile.php?id=".$row['facebook']."\"";
                                }
                                if(strlen($row['twitter']) == 0){
                                    $twitter = "";
                                }
                                else{
                                    $twitter = 'href="https://twitter.com/'.$row['twitter'].'"';
                                }
                                // printing cards
                                echo '
                                <div class="col-sm-3 p-1 mx-auto d-inline-block">
                                    <div class="card p-2">
                                    <div class="card-img-top text-center pt-2">
                                        <img src="../images/contributers/default.png" width="100px" alt="profile">
                                    </div>
                                    <div class="card-body text-center px-2">
                                        <h5 class="card-title text-info">'.$row['name'].'</h5>
                                        <p class="card-text">'.$row['contribution'].'</p>
                                        <div class="card-footer bg-transparent px-0 border-info text-center social">
                                            <a '.$linkedin.' class="mx-1"><img src="../images/linkedin.png" alt="linkedin" width="30px"></a>
                                            <a '.$twitter.' class="mx-1"><img src="../images/twitter.png" alt="instagram" width="30px"></a>
                                            <a '.$facebook.' class="mx-1"><img src="../images/facebook.png" alt="facebook" width="30px"></a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                ';
                            }
                        }
                        else{
                            echo '<p class="text-danger d-block mx-auto mt-4">No Valuable Contributer is awarded till now</p>';
                        }
                    }
                ?>  
        </div>

        <!-- Top contributers -->
        <?php
            $sql = "SELECT * from contributer_user where `position` = 'tc'";
            $result = mysqli_query($conn,$sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    echo'
                    <div class="row topContributer px-4 pt-2 pb-4 bg-light border mt-3">
                    <h1 class="heading1 text-center col-12">Top Contributers</h1>';
        
                    while($row = mysqli_fetch_assoc($result)){

                        // checking if social media link is given
                        if(strlen($row['linkedin']) == 0){
                            $linkedin = "";
                        }
                        else{
                            $linkedin = "href='https://linkedin/in/".$row['linkedin']."'";
                        }
                        if(strlen($row['facebook']) == 0){
                            $facebook = "";
                        }
                        else{
                            $facebook = "href=\"https://www.facebook.com/profile.php?id=".$row['facebook']."\"";
                        }
                        if(strlen($row['twitter']) == 0){
                            $twitter = "";
                        }
                        else{
                            $twitter = 'href="https://twitter.com/'.$row['twitter'].'"';
                        }
                        // printing cards
                        echo '
                        <div class="col-sm-3 p-1 d-inline-block">
                            <div class="card p-2">
                            <div class="card-img-top text-center pt-2">
                                <img src="../images/contributers/default.png" width="100px" alt="profile">
                            </div>
                            <div class="card-body text-center px-2">
                                <h5 class="card-title text-info">'.$row['name'].'</h5>
                                <p class="card-text">'.$row['contribution'].'</p>
                                <div class="card-footer bg-transparent px-0 border-info text-center social">
                                    <a '.$linkedin.' class="mx-1"><img src="../images/linkedin.png" alt="linkedin" width="30px"></a>
                                    <a '.$twitter.' class="mx-1"><img src="../images/twitter.png" alt="instagram" width="30px"></a>
                                    <a '.$facebook.' class="mx-1"><img src="../images/facebook.png" alt="facebook" width="30px"></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        ';
                    }
                    echo '
                    </div>
                    <hr>';
                }
            }
                    
        ?>  
        
        
    </div>

    <!-- contributers membership -->
    <div class="container my-3">
        <div class="row benifits py-2">
            <h1 class="heading1 col-12 text-center">Contributer's FAQ</h1>
            <div class="col-md-8 py-3">
                <h1 class="h3">Can i also become a contributer?</h1>
                <p class="">yes you can! Now you can be on the contributers list and use the benifits. what you have to do is just post some blogs.</p>
                <h1 class="h3">Will everyone who post the blog will become a contributer?</h1>
                <p class="">No! it will be decided from the contents and number of blogs posted by the person.</p>
                <h1 class="h3">How will i become a top contributer?</h1>
                <p class="">It will be decided based on your performance by the admin.</p>
                <h1 class="h3">what are the benifits of a contributer?</h1>
                <p class="">You will be the part of our future project, chance to be a member of ethical hacker's community we are building and you can showcase the membership on professional platform and resume</p>
                <a href="contact.php" class="text-dark"><u><b>Still in doubt?</b></u></a>
            </div>
            <div class="col-md-4">
                <img src="../images/faq.png" alt="faq" class="img-fluid text-center">
            </div>
        </div>
    </div>

    <!-- how to becoma a contributer -->
    <div class="container">
        <div class="row">
                <hr class="w-100 border-info border bg-info">
                <div class="col-md-6 mt-4">
                    <h1 class="h2 border-bottom border-info" style="font-family:ubuntu;">How to Become A Contributer</h1>
                    <div class="steps pl-md-2 mt-4">
                        <p><b>Showcase Your Profile | Be part of Fututre Projects | Comunnity Membership</b></p>
                        <p><b>Setp 1:</b> Jump to <a href="contributers.php" class="text-dark"><u>contributers page</u></a></p>
                        <p><b>Setp 2:</b> Choose Anomg the given list of pending blogs heading or skip the step</p>
                        <p><b>Setp 3:</b> Write choosen/your own blog with proper screenshorts in pdf format</p>
                        <p><b>Setp 4:</b> Upload the written blog to <a href="postBlog.php" class="text-dark"><u>Post Blog page</u></a></p>
                        <p><b>Setp 5:</b> We will verify and filter out some content if needed and post your blog</p>
                        <p><b>#Note:</b> Top 10 writters will become the top contributers of cyberblog</p>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="../images/certify.jpg" alt="certify" width="80% text-center" class="img-fluide">
                </div>
                <hr class="w-100 border-info border bg-info">
            </div>
        </div>

        

    <?php include '../others/footer.php'?>    
</body>
</html>