<?php

if (isset($_POST['blogInfo'])){

    echo $_POST['blogContent'];

    require '../connections/db_connect.php';

    $stmt = $conn->prepare("INSERT INTO blogs (content) VALUES (?)");
    // $stmt->bindParam(':title', $title);
    $stmt->bind_param('s', $blogContent);

    // insert one row
    // $title = $_POST['title'];
    $content = $_POST['blogContent'];
    
    if($stmt->execute()){
        echo "data inserted";
    }

    $sql="INSERT INTO blogs(`content`) values('$_POST[blogInfo]')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "data inserted";
    }
    else{
        echo "facing some error";
    }

    unset($_POST['blogInfo']);
    // header("location:addBlog.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add blog</title>

        <!-- bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=1">

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

    <!-- ckeditor -->
    <!-- <script src="../others/ckeditor5c/build/ckeditor.js?v=0"></script> -->
    <script src="https://cdn.tiny.cloud/1/1o1q0am7e9xmnzmg4n0cor2rpl24dyh2tgilp9z8gofuhu5c/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>



</head>
<body>
    <?php require '../others/nav.php'?>
        
    <div class="container my-2 bg-light py-3">
        <h1 class="text-center text-warning">Add A New Blog</h1>

        <form action="addBlog.php" class="was-validated" method="post">
            
            <label>Enter Your Blog Heading</label>
            <textarea class="form-control is-invalid col-8 mb-3" name="blogHeading" type="text" placeholder="Blog Heading" required></textarea>
            
            <label>Choose the thumbnail image</label>
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" name="demoImg" required>
                <label class="custom-file-label col-8">Choose file...</label>
            </div>

            <label>Enter Your Blog Hashtags</label>
            <textarea class="form-control is-invalid col-8 mb-3" type="text" name="bloghashtags" placeholder="Blog Hashtags" required></textarea>
            
            <!-- summernote wysiwyg-->
            <textarea id="summernote" name="blogContent"></textarea>

            <button type="submit" name="blogInfo" class="btn btn-info my-2">Save</button>
        </form>
    </div>
    
<script type="text/javascript">
    $(document).ready(function(){
        $('#summernote').summernote({
            placeholder: 'Enter Your Content',
            tabsize: 2,
            height: 200
        });
    });
    function postForm(){
        $('textarea[name="blogContent"]').html($('#summernote').code());
    }
    // ClassicEditor
    //     .create(document.querySelector('#editor'))
    //     .catch(error => {
    //         console.error(error)
    //     });
</script>

</body>
</html>