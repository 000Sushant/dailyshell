<nav class="navbar navbar-expand-lg navbar-light bg-info" style="line-height:25px">
  <span>welcome To &nbsp;</span><a class="navbar-brand" href="http://localhost/cyberblog" style="font-size:30px;font-family: 'ubuntu', cursive;">cyber<span style="color:blanchedalmond;font-weight:bold">RAT</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php
  
  if(isset($_SESSION['active'])){
    echo '
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost/cyberblog/admin/adminHome.php">Admin Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost/cyberblog/admin/adminBlog.php">Add Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost/cyberblog/admin/latestTrending.php">Latest/Trending</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost/cyberblog/admin/addAdmin.php">Add Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost/cyberblog/admin/contributerAdmin.php">Add Contributers</a>
        </li>
        <li class="nav-link">
          <a href="http://localhost/cyberblog/admin/partials/logout.php" class="btn-dark py-2 px-3 text-decoration-none">Logout</a>
        </li>
        </ul>
      </div>
    ';
  }
  else{
    echo '
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-light" href="http://localhost/cyberblog/pages/contact.php">Request Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="http://localhost/cyberblog/pages/postBlog.php">Post Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="http://localhost/cyberblog/pages/searchBlog.php">Find Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="http://localhost/cyberblog/pages/contributers.php">Contributers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="http://localhost/cyberblog/pages/aboutus.php">About Us</a>
      </li>
      <li class="nav-link">
        <a href="http://localhost/cyberblog/pages/contact.php" class="btn-dark py-2 px-3 text-decoration-none">Contact</a>
      </li>
      </ul>
    </div>
    ';
  }
  
  ?>
  
</nav> 