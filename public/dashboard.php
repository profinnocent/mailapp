<?php 
	require_once('../includes/header2.php'); 
?>
	<div class="text-center">
		<h1>WELCOME BACK TO YOUR DASHBOARD...</h1>
	</div>
	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-md-6">
				<div class="float-left">
					<img src="../includes/uploads/<?=$pic?>" class="p-1 img-fluid rounded-circle" width="70" height="70">
					<p><?=$fullname?></p>
					<p><?=$addresss?></p>
					<p><?=$phone?></p>
					<p><a href="compose.php">Compose</a></p>
					<p><a href="../includes/logout.php">Log out</a></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="float-right">
					<p><a href="sent.php" class="btn btn-link">sent messages</a></p>
					<p><a href="changedp.php" class="btn btn-link">change display picture</a></p>
					<p><a href="changeprofile.php" class="btn btn-link">edit profile details</a></p>
					<p><a href="changepass.php" class="btn btn-link">change password</a></p>
				</div>
			</div>
		</div>
	</div>
	<div class="container mt-3">
		<h4> Your Inbox</h4>

		<div class="form-group">
			<?php if(isset($_GET['error'])){ ?>
				<div class="alert alert-danger">
					<?=urldecode($_GET['error'])?>
				</div>
			<?php } elseif(isset($_GET['success'])){ ?>
				<div class="alert alert-success">
					<?=urldecode($_GET['success'])?>
				</div>
			<?php } ?>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tr>
					<th>Sender Photo</th>
					<th>Sender Email</th>
					<th>Subject</th>
					<th>Date sent</th>
					<th>Action</th>
				</tr>
				<?php
					$outbox = "SELECT * FROM messages WHERE `receiverid` = '$current_user_id'"; // AND deleted = 1
					$checkoutbox = mysqli_query($connect, $outbox);

					if ($checkoutbox) {
						while ($row2 = mysqli_fetch_assoc($checkoutbox)) {
						$outboxid = $row2['id'];
						$sender = $row2['senderid'];
						$subject = $row2['subject'];
						$date = $row2['createddate'];

						$getdetails = "SELECT * FROM users WHERE id = '$sender'";
						$getres = mysqli_query($connect, $getdetails);
						$row3 = mysqli_fetch_assoc($getres);
						$sendermail = $row3['email'];
						$senderpic = $row3['img'];
				?>

				<tr>
					<td><a href="sentmessages.php?id=<?php echo base64_encode($outboxid);?>">
						<?php if($senderpic == ''){ ?>
						<img src="../assets/img/img2.jpeg" class="img-fluid rounded-circle" width="50" height="50">
						<?php }else{ ?>
							<img src="../includes/uploads/<?= $senderpic?>" class="img-fluid rounded-circle" width="50" height="50">
						<?php } ?>
						</a></td>
					<td><a href="sentmessages.php?id=<?php echo base64_encode($outboxid);?>"><?=$sendermail?></a></td>
					<td><a href="sentmessages.php?id=<?php echo base64_encode($outboxid);?>"><?=$subject?></a></td>
					<td><?=$date?></td>
					<td>
						<a href="../includes/deletemail2.php?id=<?php echo base64_encode($outboxid);?>" class="btn btn-danger">delete</a>
					</td>
				</tr>
			<?php } ?>
		<?php }else{ ?>
			</tr>
			no messages yet........
			</tr>
		<?php } ?>
			</table>
		</div>
	</div>

	
<?php require_once('../includes/footer.php'); ?>