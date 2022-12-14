<?php
	require_once('connection.php');
	require_once('functions.php');

	// print_r($_POST);
	// die();

	if(isset($_POST['submit'])){
		$check = checkempty($_POST, 'submit');
		if($check == ''){
			$sanitizer = sanitizer($_POST);
			$email = mysql_prep($connect, trimData($sanitizer['email']));
			$password = mysql_prep($connect, trimData($sanitizer['password']));
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error = urlencode('please enter a correct email format');
				header('Location: ../public/index.php?error='.$error);
				return false;
			}else{
				$new_pass = password_encrypt($password); 
				$checkemail = "SELECT * FROM users WHERE email = '$email' AND password = '$new_pass'";
				$check_res = mysqli_query($connect, $checkemail);
				if(mysqli_num_rows($check_res) > 0){
					$rows = mysqli_fetch_assoc($check_res);
					session_start();
					$_SESSION['id'] = $rows['id'];
					$_SESSION['email'] = $rows['email'];
					if (isset($_SESSION['id'])) {
						header('location: ../public/dashboard.php');
						return false;
					}else{
						$error = urlencode('login failed');
						header('location: ../public/index.php?error='.$error);
						return false;
					}
					
				}else{
					$error = urlencode('user does not exists');
					header('Location: ../public/index.php?error='.$error);
					return false;
				}
			}
		}else{
			$error = urlencode($check);
			header('Location: ../public/index.php?error='.$error);
			return false;
		}

	}else{
		$error = urlencode("you must log in first");
		header('Location: ../public/index.php?error='.$error);
		return false;
	}

?>