<?php include("include/header.php"); ?>

            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" id="loginform" style="margin-top:30px;">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Login Form
                            </div>
                        </div>


                        <div class="panel-body" style="padding-top:30px">
                            <div class="alert alert-danger col-sm-12" id="login-alert" style="display:none">
                            </div>


                            <form class="form-horizontal" id="loginform" name="loginform" ACTION="loginhandler.php" METHOD=post>
                                <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="Username">                                        
                                </div>
                                    
                                <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
                                </div>

                                <div class="input-group">
                                    <div class="checkbox">
                                        <label><input id="login-remember" name="remember" type="checkbox" value="1"> Remember me</label>
                                    </div>
                                </div>


                                <div class="form-group" style="margin-top:10px">
                                    <div class="col-sm-12 controls">
                                       <button type="submit" class="btn btn-default">Submit</button>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888;padding-top:10px;">
                                            Don't have an account? <a href="#" onclick="$('#loginform').hide(); $('#signupbox').show()">Create One Here</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" id="signupbox" style="display:none; margin-top:50px">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Create an Account
                            </div>


                            <div style="float:right; font-size: 85%; position: relative; top:-10px">
                                <a href="#" id="signinlink" onclick="$('#signupbox').hide(); $('#loginform').show()">Sign In</a>
                            </div>
                        </div>


                        <div class="panel-body">
                            <form class="form-horizontal" id="signupform" name="signupform">
                                <div class="alert alert-danger" id="signupalert" style="display:none">
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