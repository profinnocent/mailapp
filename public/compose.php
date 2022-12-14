<?php 
  require_once('../includes/header2.php'); 
?>
<div class="container mt-5">
  <h1>Compose a message</h1><br>
  <form action="../includes/composesub.php" method="POST">
    <div class="form-group">
      <label>from:</label>                    
      <input type="text" class="form-control" name="from" value="<?=$email?>" />
      <input type="hidden" name="id" value="<?=$current_user_id;?>">
    </div>
    <div class="form-group">
      <label>message to:</label>                    
      <input type="text" class="form-control" name="to"/>
    </div>
    <div class="form-group">
      <label>subject:</label>                    
      <input type="text" class="form-control" name="subject"/>
    </div>
    <div class="form-group">
      <label>message:</label>                    
      <textarea class="form-control" name="message"></textarea>
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
  
  <h3>click<a class="btn btn-link" href="dashboard.php">Here</a> to go back</h3>
</div>

<?php require_once('../includes/footer.php'); ?>