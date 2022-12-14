
<?php
	require_once('connection.php');
	require_once('functions.php');
	
	if(isset($_POST['submit'])){
		$checkp = checkempty($_POST, 'submit');
		if($checkp == ''){
			$sanitizerp = sanitizer($_POST);
			$addressp = mysql_prep($connect, trimData($sanitizerp['address']));
			$phonep = mysql_prep($connect, trimData($sanitizerp['phone']));
			$idp = $sanitizerp['id'];
			
					
            $queryp = "UPDATE `users` SET `addresss`='$addressp', `phone`='$phonep' WHERE `id`='$idp'";
            $resp = mysqli_query($connect, $queryp);
            if($resp){
                $success = urlencode('update successful');
                header('Location: ../public/changeprofile.php?success='.$success);
                return false;
            }else{
                $error = urlencode('error updating user details');
                header('Location: ../public/changeprofile.php?error='.$error);
                return false;
            }
				
		}else{
			$error = urlencode($check);
			header('Location: ../public/changeprofile.php?error='.$error);
			return false;
		}

	}else{
		$error = urlencode("you must log in first");
		header('Location: ../public/index.php?error='.$error);
		return false;
	}

?>