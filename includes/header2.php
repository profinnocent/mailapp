<?php
	require_once('connection.php');
	session_start();
	if (isset($_SESSION['id'])) {
		$current_user_id = $_SESSION['id'];
		$query = "SELECT * FROM users WHERE id = '$current_user_id'";
		$res = mysqli_query($connect, $query);
		$rows = mysqli_fetch_assoc($res);

		// print_r($rows);

		$fullname = $rows['fullname'];
		$addresss = $rows['addresss'];
		$phone = $rows['phone'];
		$email = $rows['email'];
		$pic = $rows['img'];

	}else{
		$error = urlencode('please login first');
        header('location: index.php?error='.$error);
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mail</title>
	<link rel="stylesheet" type="text/css" href="../assets/dist/css/bootstrap.min.css">
	<style>
  .container .gallery embed{
    margin: 20px;
  }
</style>
</head>
<body>