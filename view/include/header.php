<!--
    Author: Vince
    Sources: 
             The website layout is from - bootswatch.com/simplex/
             The theme and CSS file is from bootswatch.com/simplex/
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script><!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <style>
      body { 
        background: url("http://www.resto.be/static/images/95/9/shutterstock_74171587_95399.jpg"); no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }

      .main
      {
        padding:30px;
        background-color: #fcfcfc;
        border-radius: 10px;
        margin-bottom:10px;
      }
    </style>
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
                        <img src="https://i.imgur.com/VMDg9Dc.png?1" style="width:100px; margin-top:10px;"></img>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                          </ul>
                          <ul class="nav navbar-nav navbar-right">
                                <?php session_start(); ?>
                                    
                                    <?php
                                      if(isset($_SESSION['sess_username'])){
                                        echo "<h2>Welcome ".$_SESSION['sess_username'].'!</h2>';
                                    echo "you logged in as ", $_SESSION['sess_username'];
                                    echo "<br/><a href='logout'>logout</a>";
                                }
                                else{
                                  echo '<li class="active"><a href="/RRS/register">Sign Up</a></li>';
                                }
                              ?>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                <?php
                                if(!isset($_SESSION['sess_username'])){
                                        echo '<li><a href="login">Login</a></li>';}                                ?>
                                
                                <li><a href="account?reservation=true">Reservations</a></li>
                                <li><a href="account">Account</a></li>
                                <li><a href="contactus">Contact Us</a></li>
                                <li><a href="help">Help</a></li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </nav>
                </div>
            </div>
