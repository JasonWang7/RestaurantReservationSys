<?php

$to="wangjinhaifirst@hotmail.com";
$subject="Reserve4U Email verification";
$body='Hi, <br/> <br/> You have registered accunt at Reserve4u. 
		Please verify your email and get started using your Website account. <br/> <br/> 
		<a href="'.'/localhost/RRS/verify/'.'/localhost/RRS/verify/sfsdf</a>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: reserve4u110@gmail.com' . "\r\n";
if(mail($to,$subject,$body,$headers)){
	echo "sent";
}
else{

	echo "failed";
}



?>