<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyberblogger | Contributers</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=2" crossorigin='anonymous'>

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=Ubuntu&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

</head>
<body>
    <?php include '../others/nav.php'?>
    
    <div class="head bg-info text-center">
        logo
        <h1 class="pb-2">Contributers</h1>
    </div>
    <div class="container">
        <div class="row topContributer px-4 pt-2 pb-4 bg-light">

                <h1 class="heading1 text-center col-12">Top Contributers</h1>
                
                <?php
                    for($i=0; $i<4; $i++){
                        echo '
                        <div class="col-sm-3  p-1 d-inline-block">
                            <div class="card p-2">
                            <div class="card-img-top text-center pt-2">
                                <img src="../images/contributers/default.png" width="100px" alt="profile">
                            </div>
                            <div class="card-body text-center px-2">
                                <h5 class="card-title text-info">Sushant Kumar</h5>
                                <p class="card-text">Founder | Web Developer | Blogger</p>
                                <div class="card-footer bg-transparent px-0 border-info text-center">
                                    <a href="#" class="mx-1"><img src="../images/linkedin.png" alt="linkedin" width="30px"></a>
                                    <a href="#" class="mx-1"><img src="../images/instagram.png" alt="instagram" width="30px"></a>
                                    <a class="mx-1"><img src="../images/facebook.png" alt="facebook" width="30px"></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        ';
                    }
                ?>  
        </div>
    </div>

    <!-- pending requests -->
    <div class="container my-3">
        <hr>
        <h1 class="heading1 text-center">Pending Requests</h1>
        <p class="text-danger text-center mt-4">No pending request at the time</p>
        <hr>
    </div>

    <!-- how to becoma a contributer -->
    <div class="container">
            <hr class=" border-info border bg-info">
            <div class="row">
                <div class="col-md-6 mt-4">
                    <h1 class="h2 border-bottom border-info" style="font-family:ubuntu;">How to Become A Contributer</h1>
                    <div class="steps pl-md-2 mt-4">
                        <p><b>Showcase Your Profile | Get Contrubuter's Discount | Comunnity Membership</b></p>
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
            </div>
            <hr class=" border-info border bg-info">
        </div>

        

    <?php include '../others/footer.php'?>    
</body>
</html>