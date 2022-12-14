<?php
require_once('connection.php');
if(isset($_POST['submit'])) {
$id = $_POST['id'];
if(isset($_FILES)){ 
$filename =$_FILES['file']['name'];
$filetmp = $_FILES['file']['tmp_name'];
$filesize = $_FILES['file']['size'];
$filetype = $_FILES['file']['type'];
$fileext = explode('.',$filename);
$fileactualext= strtolower(end($fileext));
 $allow = array('jpg', 'jpeg','png','gif');
if(in_array($fileactualext,$allow)){
if($filesize < 8000000){
    $pic = uniqid('', true).'.'.$fileactualext;
    $filedestination = 'uploads/'.$pic;
    if(move_uploaded_file($filetmp, $filedestination)){
    $query =  $query = "UPDATE `users` SET `img` =  '$pic' WHERE `id` = '$id'";
    $res = mysqli_query($connect,$query);
    if($res){ 
    $success = urldecode('image uploaded successfully');
    header('location: ../public/changedp.php?success='.$success);
    return false;
    }else{
        $error = urldecode('error uploading image');
        header('location:../public/changedp.php?error='.$error);
        return false;
    }

}else{
    $error = urldecode('file too large');
    header('location:../public/changedp.php?error='.$error);
    return false;
}

}else{
    $error = urldecode('please upload a right format');
    header('location:../public/changedp.php?error='.$error);
    return false;

}
}else{
    $error = urldecode('upload a picture');
    header('location:../public/changedp.php?error=' .$error);
    return false;
}
}else{
    $error = urldecode('please login first');
    header('location:../public/index.php?error=' .$error);
    return false;
}
}
?> 