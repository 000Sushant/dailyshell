<nav class="navbar navbar-expand-lg navbar-light bg-info" style="line-height:25px">
  <span>welcome To &nbsp;</span><a class="navbar-brand" href="http://localhost/cyberblog" style="font-size:30px;font-family: 'ZCOOL QingKe HuangYou', cursive;">CyberBloggr</a>
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
          <a class="nav-link text-light" href="">Add Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="">Latest/Trending</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Add Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Add Contributers</a>
        </li>
        <li class="nav-link">
          <a href="http://localhost/cyberblog/admin/logout.php" class="btn-dark py-2 px-3 text-decoration-none">Logout</a>
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
        <a class="nav-link text-light" href="#">Post Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="http://localhost/cyberblog/pages/searchBlog.php">Find Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="http://localhost/cyberblog/pages/contributers.php">Contributers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="http://localhost/cyberblog/pages/contact.php">Contact</a>
      </li>
      <li class="nav-link">
        <a href="http://localhost/cyberblog/pages/donate.php" class="btn-dark py-2 px-3 text-decoration-none">Donate</a>
      </li>
      </ul>
    </div>
    ';
  }
  
  ?>
  
</nav> 