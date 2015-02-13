<?php
require_once('./authentication.class.php');
$useremailval = $_POST["email"];	
$passwordval = $_POST["password"];
echo 'something';
authentication::login($useremailval,$passwordval);


?>