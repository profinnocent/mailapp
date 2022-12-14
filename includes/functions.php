<?php
	//cleansing submitted fields
	function trimData($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		$data = stripcslashes($data);

		return $data;
	}

	//cleansing submitted fields
	function sanitizer($sanitize){
		$newsanitizer = filter_var_array($sanitize, FILTER_SANITIZE_STRING);

		return $newsanitizer;
	}

	//cleansing datas to be entered into sql database
	function mysql_prep($connect, $string){
		$escape_string = mysqli_real_escape_string($connect, $string);

		return $escape_string;
	}

	//password encryption
	function password_encrypt($pass){
		$new_pass = sha1(md5(sha1(md5($pass))));

		return $new_pass;
	}

	//checking if submitted fields are empty
	function checkempty($datas, $buttonname){
		$a = '';
		foreach ($datas as $data => $value) {
			if($data != $buttonname){
				if($value == ''){
					return 'all fields are required';
				}
			}
		}
		return $a;
	}

?>