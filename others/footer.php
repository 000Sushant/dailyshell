<div class="container-fluid">

    <?php
        if(!isset($_SESSION['active'])){
            echo '
            <!-- quickLinks -->
            <div class="row bg-light p-5 mt-5 quicklink border-top border-secondary">
                <div class="col-md-4 text-center my-4">
                    <a href="http://localhost/cyberblog/pages/contact.php" class=" button1">Request Desire Blog</a>
                </div>
                <div class="col-md-4 text-center my-4">
                    <a href="http://localhost/cyberblog/pages/searchBlog.php" class=" button1">Explore More blogs</a>
                </div>
                <div class="col-md-4 text-center my-4">
                    <a href="http://localhost/cyberblog/pages/postBlog.php" class="button1">Post Your own Blog</a>
                </div>
            </div>
            ';
        }
    ?>
    
    
    <!-- footer -->
    <div class="row footer bg-info">
        <div class="container-fluid py-4 text-center text-light">
            <h1 class="text-center"><span style="color:black;font-weight:normal">cyber</span>RAT</h1>
    
            <div class="links mt-2">
                <a href="http://localhost/cyberblog/">Home</a> -
                <a href="http://localhost/cyberblog/pages/searchBlog.php">Find Blog</a> - 
                <a href="http://localhost/cyberblog/pages/contact.php">Request Blog</a> -
                <a href="http://localhost/cyberblog/pages/postBlog.php">Post Blog</a> -
                <a href="http://localhost/cyberblog/pages/contact.php">Contact</a> -
                <a href="http://localhost/cyberblog/admin/login.php">Admin</a>
            </div>
            <p class="text-light mt-4">Join with us and help us and your connections to grow <a href="./pages/blogPost.php" class="text-warning">post a blog now</a></p>
        </div>
    </div>
    <!-- caption, afterFooter -->
    <div class="row d-block afterFooter text-center bg-dark" >
        <p class="text-light mb-0 py-2">All illustration artwork credit goes to: <a href="https://www.freepik.com/" class="text-info" target="_blank">Designed by stories / Freepik </a> 
        &nbsp&nbsp|&nbsp&nbsp
        All credits and copyrights are reserved to the website's owner and developer <a href="" class="text-info">cyberblog</a></p>
    </div>
</div>