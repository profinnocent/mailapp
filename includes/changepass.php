
<?php
	require_once('connection.php');
	require_once('functions.php');

	// print_r($_POST);
	// die();

	if(isset($_POST['submit'])){
		$check = checkempty($_POST, 'submit');
		if($check == ''){
			$sanitizer = sanitizer($_POST);
			$password = mysql_prep($connect, trimData($sanitizer['password']));
			$conpassword = mysql_prep($connect, trimData($sanitizer['conpassword']));
            $id = $sanitizer['id'];

			if($password != $conpassword){
				$error = urlencode('password mixmatch');
				header('Location: ../public/changepass.php?error='.$error);
				return false;
			}else{
         $new_pass = password_encrypt($password);
            $sql = "UPDATE `users` SET `password` = '$new_pass' WHERE `id` = '$id'";
			
            $res = mysqli_query($connect, $sql);
            if($res){
                $success = urlencode('Password updated successfully.');
                header('Location: ../public/changepass.php?success='.$success);
                return false;
            }else{
                $error = urlencode('error updating password');
                header('Location: ../public/changepass.php?error='.$error);
                return false;
            }
				
			}
		}else{
			$error = urlencode($check);
			header('Location: ../public/changepass.php?error='.$error);
			return false;
		}

	}else{
		$error = urlencode("you must log in first");
		header('Location: ../public/index.php?error='.$error);
		return false;
	}

?>