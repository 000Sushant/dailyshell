<?php
$showtable = false;
$error = false;
$class = "align-bottom";
$add="active";
$delete = " ";
$blogreq = " ";
$postreq = " ";
$blogreqalert = 0;
$deletealert = 0;
$addblog = 0;

if(isset($_POST['search']) || isset($_POST['delete']) || isset($_SESSION['deleted'])){
    $delete = "active show";
    $add = "";
    $blogreq = "";
    $postreq = "";
}

else if(isset($_POST['delblogreq'])){
    $delete = "";
    $add = "";
    $blogreq = "active show";
    $postreq = "";
}

else if(isset($_POST['postreq'])){
    $delete = "";
    $add = "";
    $blogreq = "";
    $postreq = "active show";
}

else{
    $delete = "";
    $add = "active show";
    $blogreq = "";
    $postreq = "";
}

//delete Blog
//on search event of delete blog
if(isset($_POST['search'])){

    unset($_SESSION['deleted']);
    if(strlen($_POST['blog']) >= 3){
        $str = mysqli_real_escape_string($conn,$_POST['blog']);
        $sql = "SELECT * from blogs WHERE `heading` LIKE '%$str%' OR `content` LIKE '%$str%' OR `hashtags` LIKE '%$str%'";
        $result = mysqli_query($conn, $sql);

        if($result){
            if(mysqli_num_rows($result) > 0){

                $showtable = true;
            }
            else{
                $error = true;
            }
        }
        else{
            $error = true;
        }
    }
    else{
        $error = true;
    }
}

//on delete event of delete blog
if(isset($_POST['delete'])){

    $id = mysqli_real_escape_string($conn,$_POST['id']);

    //deleting thumbail image
    $sql = "SELECT `demo_image` from blogs where `blogid`='$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            unlink("../files/thumbnail/".$row['demo_image']);
        }
        else{
            goto endDelete;
        }
    }


    $sql = "DELETE from blogs where `blogid`='$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        if(mysqli_affected_rows($conn) > 0){
            // echo 'blog deleted successfully';
            $deletealert = 1;
        }
    }
    else{
        endDelete:
        // echo 'the blog you are trying to delete is not there';
        $deleteqalert = 2;
    }

}

//blog reqeuest
if(isset($_POST['delblogreq'])){
    $id = (int)mysqli_real_escape_string($conn,$_POST['reqid']);
    $sql = "DELETE FROM blogrequest_user where `blogid` = '$id'";
    $result = mysqli_query($conn,$sql);
        if($result){
            if(mysqli_affected_rows($conn) > 0){
                $sql = "DELETE FROM blogrequest WHERE `blogid`= '$id'";
                $result2 = mysqli_query($conn,$sql);
                if($result2){
                    if(mysqli_affected_rows($conn) > 0){
                        $blogreqalert = 1;
                        // echo 'request deleted successfully'; 
                    }
                    else{
                        $blogreqalert = 2;
                        // echo 'unable to delete the desire request';
                    }
                }
                else{
                    $blogreqalert = 2;
                    // echo 'unable to delete the desire request';
                }
            }
            else{
                $blogreqalert = 2;
                // echo 'unable to delete the desire request';
            }
        }
        else{
            $blogreqalert = 2;
            // echo 'unable to delete the desire request';
        }
    //check if querry ran successfully run the below querry
}

//delete post request
if(isset($_POST['postreq'])){
    //flaw, converting to 0
    $id = (int)mysqli_real_escape_string($conn,$_POST['postid']);
    if($id > 0){
        $sql = "DELETE from postrequest_user where `blogid`='$id'";
        $result = mysqli_query($conn,$sql);
        if($result){
            if(mysqli_affected_rows($conn) > 0 ){
                // echo 'deletd from postrequest_user';
                
                //deleting the pdf file
                $result2 = mysqli_query($conn,"SELECT `file` from postrequest where `blogid`='$id'");
                if($result2){
                    if(mysqli_num_rows($result2) == 1){
                        unlink("../files/requestedBlogs/".$row['file']);

                        //deleting from postrequest_user db
                        $sql = "DELETE from postrequest where `blogid`='$id'";
                        $result3 = mysqli_query($conn,$sql);
                        if($result3){
                            if(mysqli_affected_rows($conn) > 0 ){

                                // echo 'successfully deleted';
                                $blogreqalert = 1;

                            }
                            else{
                                // echo '0 rows affected';
                                $blogreqalert = 2;
                            }
                        }
                        else{
                            // echo 'database error';
                            $blogreqalert = 2;
                        }
                    }
                    else{
                        $blogreqalert = 2;
                    }
                }
                else{
                    $blogreqalert = 2;
                }
                
            }
            else{
                // echo 'invalid request id';
                $blogreqalert = 2;
            }
        }
        else{
            // echo 'invalid request id';
            $blogreqalert = 2;
        }
    }
    else{
        // echo 'invalid request id';
        $blogreqalert = 2;
    }
    
}

//add blog
if(isset($_POST['addblog'])){
    $heading = mysqli_real_escape_string($conn,$_POST['heading']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);
    $smallcontent = mysqli_real_escape_string($conn,$_POST['smallcontent']);
    $hashtags = mysqli_real_escape_string($conn,$_POST['hashtags']);
    $author = mysqli_real_escape_string($conn,$_POST['author']);

    // checking if any file is selected
    
    if(strlen($_FILES["file"]["name"]) >= 5){

        // checking if the file is in jpg, jpeg or png
        $img_ext = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);

        if($img_ext === 'jpg' || $img_ext === 'jpeg' || $img_ext === 'png'){

            //setting up image destinatinon and name
            $img_loc = $_FILES["file"]["tmp_name"];
            $img_des= "../files/thumbnails/".$author."_".time().".".$img_ext;
            $img_name = $author."_".time().".".$img_ext;
        }
    }
    else{
        echo 'wrong file format';
        goto skip_upload;
    }
    
    //checking if blog is already uploaded
    $sql = "SELECT blogid FROM blogs where `heading` = '$heading' and `author` = '$author'";
    $result = mysqli_query($conn,$sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            $addblog = 2;
            goto skip_upload;
        }
    }

    // //inserting data
    $sql = "INSERT INTO blogs(`heading`,`small_content`,`content`,`hashtags`,`author`,`demo_image`) VALUES('$heading', '$smallcontent', '$content', '$hashtags', '$author','$img_name')";
    $result = mysqli_query($conn,$sql);
    if($result){
        if(mysqli_affected_rows($conn) > 0){
            $addblog = 1;
            move_uploaded_file($img_loc,$img_des);
        }
        else{
            $addblog = 3;
        }
    }
    else{
        $addblog = 3;
    }

}

//skip upload
skip_upload:

?>