<?php 
  require_once('../includes/header2.php'); 
?>
	<div>
		<h1>Your Sent Messages</h1>
	</div>
	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-md-6">
				<div class="float-left">
					<p>click <a href="dashboard.php">Here</a> to go back</p>
				</div>
				<div class="float-right">
					<p><a href="compose.php">Compose a mail</a></p>
				</div>
			</div>
		</div>
	</div>
	<div class="container mt-3">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tr>
					<th>Receiver Photo</th>
					<th>Receiver Email</th>
					<th>Subject</th>
					<th>Date sent</th>
					<th>Action</th>
				</tr>
				<?php
					$outbox = "SELECT * FROM messages WHERE `senderid` = '$current_user_id'"; // AND deleted = 1
					$checkoutbox = mysqli_query($connect, $outbox);

					if ($checkoutbox) {
						while ($row2 = mysqli_fetch_assoc($checkoutbox)) {
						$outboxid = $row2['id'];
						$receiver = $row2['receiverid'];
						$subject = $row2['subject'];
						$date = $row2['createddate'];

						// Fetch the mail and pix
						$getdetails = "SELECT * FROM users WHERE id = '$receiver'";
						$getres = mysqli_query($connect, $getdetails);
						$row3 = mysqli_fetch_assoc($getres);
						$receivermail = $row3['email'];
						$receiverpic = $row3['img'];
				?>

				<tr>
					<td><a href="sentmessages.php?id=<?php echo base64_encode($outboxid);?>">
						<?php if($receiverpic == ''){ ?>
						<img src="../assets/img/img2.jpeg" class="img-fluid rounded-circle" width="50" height="50">
						<?php }else{ ?>
							<img src="../includes/uploads/<?= $receiverpic?>" class="img-fluid rounded-circle" width="50" height="50">
						<?php } ?>
						</a></td>
					<td><a href="sentmessages.php?id=<?php echo base64_encode($outboxid);?>"><?=$receivermail?></a></td>
					<td><a href="sentmessages.php?id=<?php echo base64_encode($outboxid);?>"><?=$subject?></a></td>
					<td><?=$date?></td>
					<td>
						<a href="../includes/deletemail.php?id=<?php echo base64_encode($outboxid);?>" class="btn btn-danger">delete</a>
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