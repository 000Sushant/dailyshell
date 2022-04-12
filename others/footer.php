<div class="container-fluid">

    <?php
        if(!isset($_SESSION['active'])){
            echo '
            <!-- quickLinks -->
            <div class="row bg-light p-5 mt-5 quicklink border-top border-secondary">
                <div class="col-md-4 text-center mx-auto my-4">
                    <a class="fancy" href="http://localhost/cyberblog/pages/contact.php">
                        <span class="top-key"></span>
                        <span class="text">Request Desire Blog</span>
                        <span class="bottom-key-1"></span>
                        <span class="bottom-key-2"></span>
                    </a>
                </div>
                <div class="col-md-4 text-center mx-auto my-4">
                    <a class="fancy" href="http://localhost/cyberblog/pages/searchBlog.php">
                        <span class="top-key"></span>
                        <span class="text">Explore More Blog</span>
                        <span class="bottom-key-1"></span>
                        <span class="bottom-key-2"></span>
                    </a>
                </div>
                <div class="col-md-4 text-center mx-auto my-4">
                    <a class="fancy" href="http://localhost/cyberblog/pages/postBlog.php">
                        <span class="top-key"></span>
                        <span class="text">Post your own Blog</span>
                        <span class="bottom-key-1"></span>
                        <span class="bottom-key-2"></span>
                    </a>
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
            <p class="blanchedalmond mt-4">Join with us and help us and your connections to grow <a href="./pages/blogPost.php"><u>post a blog now</u></a></p>
        </div>
    </div>
    <!-- caption, afterFooter -->
    <div class="row d-block afterFooter text-center bg-dark" >
        <p class="text-light mb-0 py-2">All illustration artwork credit goes to: <a href="https://www.freepik.com/" class="text-info" target="_blank">Designed by stories / Freepik </a> 
        &nbsp&nbsp|&nbsp&nbsp
        All credits and copyrights are reserved to the website's owner and developer <a href="" class="text-info">cyberblog</a></p>
    </div>
</div>