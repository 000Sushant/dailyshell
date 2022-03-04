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
    <link rel="stylesheet" href="./css/main.css?v=1">

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

    <!-- ckeditor -->
    <script src="../others/ckeditor5c/build/ckeditor.js"></script>

</head>
<body>
    <?php require '../others/nav.php'?>
        
    <div class="container my-2 bg-light py-3">
        <h1 class="text-center text-warning">Add A New Blog</h1>
        <form action="" method="post">
            <div id="editor"></div>
        </form>
        <button type="submit" name="submit" class="btn btn-info my-2">Save</button>
    </div>
    
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error)
        });
</script>

</body>
</html>