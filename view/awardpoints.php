<?php 
/****Vince ****/
include("include/header.php"); ?>
<div class="row">
  <div class="col-12">  
    <div class="jumbotron">
      <h2>You've been awarded points</h2>
      <p>Your account has just been credited <?php echo $_GET['points']; ?> amount of points.</p>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>