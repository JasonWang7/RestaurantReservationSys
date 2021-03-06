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
	<script type="text/javascript">
	function loginRequiredPopup(url) 
	{
		popUp = window.open(url,'Ownership Information','height=350,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
	}
	</script>
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
      .datepicker1 
      { 
        position: relative; 
        z-index: 10000 !important; 
      }
    </style>
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "9517f3b1-00df-440a-8488-6e9c05312a64", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
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
                        <a href="/RRS/"><img src="https://i.imgur.com/VMDg9Dc.png?1" style="width:100px; margin-top:10px;"></img></a>
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
                                        echo '<li><a href="login">Login</a></li>';}?>
                                
                                <li><a href="account?reservation=true">Reservations</a></li>
								
								<?php if (isset($_SESSION['sess_username'])) : ?>
									<li><a href="account">Account</a></li>
								<?php else : ?>
									<li><a href="JavaScript:loginRequiredPopup('/RRS/view/loginRequired.php');">Account</a></li>
								<?php endif; ?>
								
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
