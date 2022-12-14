<?php 
	require_once('../includes/header2.php')
?>
	<div class="container mt-5">
		<h1>Edit User Password</h1>
		<form class="was-validated" action="../includes/changepass.php" method="POST">
			<div class="form-group">
				<label>Password:</label>
				<input type="password" class="form-control" name="password" required>
				<input type="hidden" name="id" value="<?=$current_user_id?>">
				<div class="valid-feedback">field no longer empty</div>
				<div class="invalid-feedback">please fill in the field</div>
			</div>
			<div class="form-group">
				<label>Confirm Password:</label>
				<input type="password" class="form-control" name="conpassword" required>
				<div class="valid-feedback">field no longer empty</div>
				<div class="invalid-feedback">please fill in the field</div>
			</div>
			<div class="form-group">
				<button class="btn btn-success" name="submit">Submit</button>
			</div>
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
		</form>
		<h3>click<a class="btn btn-link" href="dashboard.php">Here</a> to go back</h3>
	</div>

	
<?php require_once('../includes/footer.php'); ?>