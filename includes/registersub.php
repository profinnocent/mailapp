
<?php
	require_once('connection.php');
	require_once('functions.php');

	// print_r($_POST);
	// die();

	if(isset($_POST['submit'])){
		$check = checkempty($_POST, 'submit');
		if($check == ''){
			$sanitizer = sanitizer($_POST);
			$fullname = mysql_prep($connect, trimData($sanitizer['fullname']));
			$address = mysql_prep($connect, trimData($sanitizer['address']));
			$phone = mysql_prep($connect, trimData($sanitizer['phone']));
			$email = mysql_prep($connect, trimData($sanitizer['email']));
			$password = mysql_prep($connect, trimData($sanitizer['password']));
			$conpassword = mysql_prep($connect, trimData($sanitizer['conpassword']));
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error = urlencode('please enter a correct email format');
				header('Location: ../public/register.php?error='.$error);
				return false;
			}else{
				$checkemail = "SELECT * FROM users WHERE email = '$email'";
				$check_res = mysqli_query($connect, $checkemail);
				if(mysqli_num_rows($check_res) == 1){
					$error = urlencode('email address already exists');
					header('Location: ../public/register.php?error='.$error);
					return false;
				}else{
					$new_pass = password_encrypt($password);
					$main_date = date('Y-m-d H:i:s');
					$img = '';
					$sql = "INSERT INTO users(fullname, addresss, phone, email, password, img, createddate) VALUES ('$fullname', '$address', '$phone', '$email', '$new_pass', '$img', '$main_date')";
					$res = mysqli_query($connect, $sql);
					if($res){
						$success = urlencode('Registration successful and you can now log in');
						header('Location: ../public/index.php?success='.$success);
						return false;
					}else{
						$error = urlencode('error registering user');
						header('Location: ../public/register.php?error='.$error);
						return false;
					}
				}
			}
		}else{
			$error = urlencode($check);
			header('Location: ../public/register.php?error='.$error);
			return false;
		}

	}else{
		$error = urlencode("you must log in first");
		header('Location: ../public/index.php?error='.$error);
		return false;
	}

?>