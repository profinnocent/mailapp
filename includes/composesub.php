
<?php
	require_once('connection.php');
	require_once('functions.php');


	if(isset($_POST['submit'])){
		$check = checkempty($_POST, 'submit');
		if($check == ''){
			$sanitizer = sanitizer($_POST);
			$from = mysql_prep($connect, trimData($sanitizer['from']));
			$to = mysql_prep($connect, trimData($sanitizer['to']));
			$subject = mysql_prep($connect, trimData($sanitizer['subject']));
			$message = mysql_prep($connect, trimData($sanitizer['message']));
			$senderid = mysql_prep($connect, trimData($sanitizer['id']));
			if(!filter_var($to, FILTER_VALIDATE_EMAIL)){
				$error = urlencode('please enter a correct email format');
				header('Location: ../public/compose.php?error='.$error);
				return false;
			}else{
				$checkemail = "SELECT * FROM `users` WHERE `email` = '$to'";
				$check_res = mysqli_query($connect, $checkemail);

				if(mysqli_num_rows($check_res) == 1){
					$rows = mysqli_fetch_assoc($check_res);

					$receiverid = $rows['id'];


					$main_date = date('Y-m-d H:i:s');
					$sql = "INSERT INTO messages(senderid, receiverid, subject, message, createddate)VALUES('$senderid', '$receiverid', '$subject', '$message', '$main_date')";
					$res = mysqli_query($connect, $sql);
					if($res){
						$success = urlencode('message sent');
						header('Location: ../public/compose.php?success='.$success);
						return false;
					}else{
						$error = urlencode('error registering user');
						header('Location: ../public/compose.php?error='.$error);
						return false;
					}
				}else{
					$error = urldecode('user does not exist');
					header('location: ../public/compose.php?error='.$error);
				}
			}
		}else{
			$error = urlencode($check);
			header('Location: ../public/compose.php?error='.$error);
			return false;
		}

	}else{
		$error = urlencode("you must log in first");
		header('Location: ../public/index.php?error='.$error);
		return false;
	}

?>