<?php
session_start();
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
    <link rel="stylesheet" href="../css/main.css?v=3" crossorigin='anonymous'>

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

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
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Important Notice!</strong>
        You can earn a chance to become a top contributer and a valuable member of cyberblog by 
        <a href="postBlog.php" class="alert-link">Posting your own blog</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>

    <div class="container bg-light my-4 border border-info">
        <div class="row">
            <h1 class="heading1 col-12 text-center top py-2">Contact Form</h1>
        </div>
        <div class="form row">
            
            <div class="col-md-6">
                <label>Enter Your Full Name</label>
                <input type="text" class="form-control mb-3" name="name" placeholder="Full Name" required></input>
            
                <label>Enter Your Email ID</label>
                <input type="email" class="form-control" name="email" placeholder="Email Address" required></input>
                <small class="form-text text-muted mb-3">We will inform you the status of your request to this Address </small>
            
                <label for="subject">Enter Your Subject</label>
                <input type="text" class="form-control mb-3" name="subject" id="subject" placeholder="Subject" required></input>

                <label for="content">Describe your Content</label>
                <textarea name="content" id="content" class="form-control mb-3" cols="30" rows="4" placeholder="Content" required></textarea>
                

                <div class="form-check sm-text-center">
                <input class="form-check-input" type="checkbox" value="" name="policy" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">
                   I am accepting all the <a href="#" data-toggle="modal" data-target="#exampleModal">Terms and Conditions</a> 
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="" name="policy" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">
                   I have read the terms and conditions mention above
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
                            <ul>
                                <li> I am not performing any malacious activity by sending these details</li>
                                <li> Al detailes i am sending are mine and correct</li>
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