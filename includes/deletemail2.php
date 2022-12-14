<?php
require_once('connection.php');

if(isset($_GET['id'])){
   $id = base64_decode($_GET['id']);

   //delete entirely from our table
   $query = "DELETE FROM messages WHERE id = '$id'";

   //update deleted column from 1 to 0
   //$query = "UPDATE `messages` SET `deleted` = 0 WHERE `id` = '$id'";
   $res = mysqli_query($connect, $query);
   if($res){
        $success = urlencode('Message deleted successfully');
       header('location: ../public/dashboard.php?success='.$success);
   }else{
        $error = urlencode('Message failed to be deleted');
       header('location: ../public/dashboard.php?error='.$error);
   }
   
}else{
   $error =urlencode('please login first');
   header('location: ../public/index.php?error=' .$error);
}

?>