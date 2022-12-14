<?php
require_once('connection.php');
include('functions.php');

if(isset($_POST['submitbtn'])){

    // header('Location: ../public/index.php?error=submit_btn_clicked');

    $check = checkempty($_POST, 'submitbtn');
    
		if($check == ''){

			$sanitizer = sanitizer($_POST);
			$uemail = mysql_prep($connect, trimData($sanitizer['email2']));
			
			if(!filter_var($uemail, FILTER_VALIDATE_EMAIL)){
				$error = urlencode("Please enter a valid email format");
				header('Location: ../public/index.php?error='.$error);
				return false;
			}else{
				$checkemail = "SELECT `id` FROM `users` WHERE `email` = '$uemail'";
				$check_res = mysqli_query($connect, $checkemail);
				if(mysqli_num_rows($check_res) > 0){
					$rows = mysqli_fetch_assoc($check_res);
                    // print_r($rows);

                    $pw = base64_encode($rows['id']);
                    echo $pw;

                    $success = urlencode("Your new pass link $pw has been sent to your mail");
                    header('Location: ../public/index.php?success='.$success);
                    return false;


                    // mail("oiunachukwu@gmail.com", "reset", "$pw");

					// Send new passowrd link to change link or passcode

					
				}else{
					$error = urlencode('user does not exists');
					header('Location: ../public/index.php?error='.$error);
					return false;
				}
			}

        }else{
			// $error = urlencode($check);
            $error = urlencode('Please enter an Email');
			header('Location: ../public/index.php?error='.$error);
			return false;
		}

}