<?php
include('functions.php');

if(isset($_POST['submitbtn'])){

    // header('Location: ../public/index.php?error=submit_btn_clicked');

    $check = checkempty($_POST, 'submitbtn');
    
		if($check == ''){

			$sanitizer = sanitizer($_POST);
			$uemail = mysql_prep($connect, trimData($sanitizer['email2']));
			
			if(!filter_var($uemail, FILTER_VALIDATE_EMAIL)){
				$error = urlencode('please enter a correct email format');
				header('Location: ../public/index.php?error='.$error);
				return false;
			}else{
				$checkemail = "SELECT `password` FROM `users` WHERE `email` = '$uemail'";
				$check_res = mysqli_query($connect, $checkemail);
				if(mysqli_num_rows($check_res) > 0){
					$rows = mysqli_fetch_assoc($check_res);
                    print_r($rows);

					// session_start();
					// $_SESSION['id'] = $rows['id'];
					// $_SESSION['email'] = $rows['email'];
					// if (isset($_SESSION['id'])) {
					// 	header('location: ../public/dashboard.php');
					// 	return false;
					// }else{
					// 	$error = urlencode('login failed');
					// 	header('location: ../public/index.php?error='.$error);
					// 	return false;
					// }
					
				}else{
					$error = urlencode('user does not exists');
					header('Location: ../public/index.php?error='.$error);
					return false;
				}
			}

        }else{
			// $error = urlencode($check);
            $error = urlencode('check failed');
			header('Location: ../public/index.php?error='.$error);
			return false;
		}

}