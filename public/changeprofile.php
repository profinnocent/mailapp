<?php require_once('../includes/header2.php')
?>
	<div class="container mt-5">
		<h1>Edit User Details</h1>
		<form class="was-validated" action="../includes/profile.php" method="POST">
			<div class="form-group">
				<label>Full Name:</label>
				<input type="text" class="form-control" name="fullname"  value="<?=$fullname?>" disabled>
				<div class="valid-feedback">field no longer empty</div>
				<div class="invalid-feedback">please fill in the field</div>
			</div>
			<div class="form-group">
				<label>Address:</label>
				<input type="text" class="form-control" name="address"  value="<?=$addresss?>">
				<input type="hidden" name="id"  value ="<?=$current_user_id?>">
				<div class="valid-feedback">field no longer empty</div>
				<div class="invalid-feedback">please fill in the field</div>
			</div>
			<div class="form-group">
				<label>Phone:</label>
				<input type="text" class="form-control" name="phone"  value="<?=$phone?>">
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