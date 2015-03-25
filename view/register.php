<!--
    Author: Vince,Jinhai
    Sources: The login form is based off of - http://bootsnipp.com/snippets/featured/login-amp-signup-forms-in-panel
             The website layout is from - http://getbootstrap.com/examples/starter-template/
-->
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
                            <form class="form-horizontal" id="signupform" name="signupform" ACTION="controller/usercontroller.php" METHOD=post>
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
                                    <label class="col-md-3 control-label" for="User Name">User Name</label>

                                    <div class="col-md-9">
                                        <input class="form-control" name="username" placeholder="User Name" type="text">
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
                                    <label class="col-md-3 control-label" for="city">City</label>

                                    <div class="col-md-9">
                                        <input class="form-control" name="city" placeholder="City" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="pass1">Password</label>

                                    <div class="col-md-9">
                                        <input class="form-control" name="pass1" placeholder="Password" type="password">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-3 control-label" for="Confirm password">Confirm Password</label>

                                    <div class="col-md-9">
                                        <input class="form-control" name="Confirmpassword" placeholder="Confirm password" type="password">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <!-- Button -->


                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" id="btn-signup" value="submit" type="submit"><i class="icon-hand-right"></i> &nbsp; Sign Up</button>
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