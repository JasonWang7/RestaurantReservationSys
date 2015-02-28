<?php include("include/header.php"); ?>

            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" id="signupbox" style="margin-top:50px">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Create an Account
                            </div>
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal" id="signupform" name="signupform" ACTION="controllers/usercontroller.php" METHOD=post>
                                <div class="alert alert-danger" id="signupalert" style="display:none;">
                                    <p>Error:</p>
                                    <span></span>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="email">Email</label>

                                    <div class="col-md-9">
                                        <input class="form-control" name="email" placeholder="Email Address" type="text">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="firstname">First Name</label>

                                    <div class="col-md-9">
                                        <input class="form-control" name="firstname" placeholder="First Name" type="text">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="lastname">Last Name</label>

                                    <div class="col-md-9">
                                        <input class="form-control" name="lastname" placeholder="Last Name" type="text">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="password">Password</label>

                                    <div class="col-md-9">
                                        <input class="form-control" name="passwd" placeholder="Password" type="password">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <!-- Button -->


                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" id="btn-signup" type="button"><i class="icon-hand-right"></i> &nbsp; Sign Up</button>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>

    <!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</body>
</html>

<?php
include 'include/footer.php';
?>