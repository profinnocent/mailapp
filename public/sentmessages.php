<?php
 require_once('../includes/header2.php');
 if(isset($_GET['id'])){
	 $id = base64_decode($_GET['id']);
	 $query = "SELECT * FROM messages WHERE id = '$id'";
	 $res = mysqli_query($connect, $query);
	 $rows2 = mysqli_fetch_assoc($res);
	 $reciever =$rows2['recieverid'];
	 $subject = $rows2['subject'];
	 $message = $rows2['message'];
	 $date = $rows2['createddate'];

    $getdetails = "SELECT * FROM users WHERE id ='$reciever'";
	$getres = mysqli_query($connect, $getdetails);
	$row3 = mysqli_fetch_assoc($getres);
	$recieveremail = $row3['email'];
	$recieverpic = $row3['img'];
 }else{
	 $error = urlencode('please login first');
	 header('Location: index.php?error=' .$error);
 }
?>
	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-md-6">
				<div class="float-left">
					<p>Message To: <span><?=$recieveremail?></span></p>
					<p>Sent By: <span><?=$date?></span></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="float-right">
					<p><a href="../includes/deletemail.php?id=<?php echo base64_encode($id) ?>">click here to delete message</a></p>
					<p><a href="dashboard.php">click here to go back</a></p>
				</div>	
			</div>
		</div>
	</div>
	<div class="container mt-5">
		<div>
			<h4>SUBJECT:</h4>
			<p><?=$subject?></p>
		</div>
		<div>
			<h4>MESSAGE:</h4>
			<p><?=$message?></p>
		</div>
	</div>
	
	<?php require_once('../includes/footer.php'); ?>