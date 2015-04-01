<?php include($root."view/include/header.php"); ?>
<div class="row">
  <div class="col-12">  
    <table class="table table-striped table-hover ">
      <thead>
        <tr>
          <th>Reservation #</th>
          <th>Restaurant</th>
          <th>Time</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr><td>195</td><td><a href="profile?id=1">Hockey Sushi</a></td><td>1990-11-11 10:10:00</td><td><a class="btn btn-default" href="#" data-toggle="modal" data-target="#viewreservationmodal195">Charge</a> <a class="btn btn-default" href="#" data-toggle="modal" data-target="#viewreservationmodal195">Refund</a></td></tr>
          
          <tr><td>196</td><td><a href="profile?id=1">Hockey Sushi</a></td><td>1991-11-11 11:11:00</td><td><a class="btn btn-default" href="#" data-toggle="modal" data-target="#viewreservationmodal196">Charge</a> <a class="btn btn-default" href="#" data-toggle="modal" data-target="#viewreservationmodal195">Refund</a></td></tr>
          
          <tr><td>197</td><td><a href="profile?id=1">Hockey Sushi</a></td><td>0000-00-00 00:00:00</td><td><a class="btn btn-default" href="#" data-toggle="modal" data-target="#viewreservationmodal197">Charge</a> <a class="btn btn-default" href="#" data-toggle="modal" data-target="#viewreservationmodal195">Refund</a></td></tr>
      </tbody>
    </table>
  </div>
</div>
<?php include("include/footer.php"); ?>