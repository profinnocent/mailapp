<?php require_once('../includes/header2.php')?>
  
<div class="text-center">
    <img src="../includes/uploads/<?=$pic?>" class="img-fluid rounded-circle" width="150" height="150">
  </div>

  <div class="container mt-5">
    <h1>Upload a new display picture</h1><br>
    <form action="../includes/dp.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label>choose pictures</label>                    
        <input type="file" id="gallery-photo-add" name="file"/>
        <input type="hidden" name="id" value="<?=$current_user_id?>">
      </div>
      <div class="form-group">
        <button class="btn btn-success" name="submit">submit</button>
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
    <div class="container">
      <div class="col-md-12">
          <div class="gallery"></div>
      </div>
    </div><br>
    <h3>click<a class="btn btn-link" href="dashboard.php">Here</a> to go back</h3>
  </div>

<?php require_once('../includes/footer.php'); ?>