<!--
    Author: Vince
    Sources: The login form is based off of - http://bootsnipp.com/snippets/featured/login-amp-signup-forms-in-panel
             The website layout is from - http://getbootstrap.com/examples/starter-template/
-->
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <title>Login Page</title><!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"><!-- Optional theme -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css" rel="stylesheet"><!-- Latest compiled and minified JavaScript -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script><!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> <a class="navbar-brand" href="#">Resturant Reservation System</a>
            </div>


            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="#">Home</a>
                    </li>


                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="main" style="padding-top:50px;">
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


                        <form class="form-horizontal" id="loginform" name="loginform">
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Username">                                        
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
                                    <a class="btn btn-success" href="#" id="btn-login">Login</a>
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
    </div>
    <!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> <script src="../../dist/js/bootstrap.min.js"></script> <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
     <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>