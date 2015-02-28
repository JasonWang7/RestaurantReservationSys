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

    <title></title><!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link href="http://bootswatch.com/simplex/bootstrap.css" rel="stylesheet"><!-- Optional theme -->
    <link href="http://bootswatch.com/assets/css/bootswatch.min.css" rel="stylesheet"><!-- Latest compiled and minified JavaScript -->
    
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script><!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <div class="main">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-default">
                      <div class="container-fluid">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          <a class="navbar-brand" href="#">Brand</a>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Guelph</a></li>
                          </ul>
                          <ul class="nav navbar-nav navbar-right">
                                <?php session_start(); ?>
                                    
                                    <?php
                                      if(isset($_SESSION['sess_username'])){
                                        echo "<h2>Welcome ".$_SESSION['sess_username'].'!</h2>';
                                    echo "you logged in as ", $_SESSION['sess_username'];
                                    echo "<br/><a href='logout.php'>logout</a>";
                                }
                                else{
                                  echo '<li class="active"><a href="register.php">Sign Up</a></li>';
                                }
                              ?>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="login.php">Login</a></li>
                                <li><a href="#">Reservations</a></li>
                                <li><a href="#">Account</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Help</a></li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </nav>
                </div>
            </div>