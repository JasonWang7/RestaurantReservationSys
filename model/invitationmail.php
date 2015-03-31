<?php
/******jinhai wang******/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'model/reservation.php');
require_once($root.'model/user.php');
require_once($root.'model/restaurant.php');
class invitationmail{
	private $to;
	private $from;
	private $subject;	
	private $headers;	
	private $body;
	private $revseravtionobj;
	private $userobj;
	private $restaurantobj;
	
	function __construct($reserveParam,$userParam,$restaurantParam) {
		$this->revseravtionobj = new reservation;
		$this->userobj = new user; 	
		$this->restaurantobj = new restaurant;
		$this->revseravtionobj = $reserveParam;
		$this->userobj = $userParam;
		$this->restaurantobj = $restaurantParam;
		$this->subject="Reserve4U Dining Invitation";
		$this->headers = "MIME-Version: 1.0" . "\r\n";
		$this->headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$this->headers .= 'From: reserve4u110@gmail.com' . "\r\n";
		echo 'sdfsd'.'<pre>'.print_r($this->revseravtionobj, true).'</pre>'; 
		echo $this->revseravtionobj->getInvitationList();
    }

	function sendemail(){
		echo 'there11';
		$this->buildBody();
		echo $this->body;
		$sendToArray = array();
		$sendToArray = $this->buildSendToArray();
		echo 'there1jjjj';

		echo '<pre>'.print_r($sendToArray, true).'</pre>'; 
		echo count($sendToArray);
		if(count($sendToArray)>0){
			echo 'there1 count';
			foreach($sendToArray as $toVal){
				if($toVal!=""){
					echo $this->body;					
					//mail($toVal,$this->subject,$this->body,$this->headers);
				}
			}
		}

	}

	function buildBody(){
		$this->body='<table width="100%" border="0" cellspacing="0" cellpadding="10" background="background_image.png">
		<tr>
			<td align="center">
	  			<img src="https://i.imgur.com/VMDg9Dc.png?1" style="width:100px; margin-top:0px;">
	  		</td>
		</tr>
  		<tr>
	    	<td>'.
				'Hello, <br/> <br/>'.$this->userobj->getFirstName().' '.$this->userobj->getLastName().' have invited you to dinne at '.$this->restaurantobj->getRestaurantName().'.'. 
				'<br/>Address: '.$this->restaurantobj->getAddress().'<br/>'.
				'Time: '.$this->revseravtionobj->getDinningTime().'<br/>'.
				'Website: <a href="'.'http://localhost/profile?id='.$this->restaurantobj->getId().'">'.$this->restaurantobj->getRestaurantName().'</a><br/><br/>'.
				'Send on Behalf Of '.$this->userobj->getFirstName().' '.$this->userobj->getLastName().'<br/>'.
				'Email: '.$this->userobj->getUserEmail().'<br/>'.
				'Phone: '.$this->userobj->getPhone().'<br/>'.
				'Sent By: Reserve4U INC.<br/>'.
				'We wish you a happy meal!'.
			'</td>
  		</tr>
		</table>';
	}

	function buildSendToArray(){
		echo 'there1arr---';
		echo $this->headers;
		$sendList  = $this->revseravtionobj->getInvitationList();
		echo $this->revseravtionobj->getInvitationList();
		
		$sendArrayList = array();
		if($sendList!=""){
			$sendArrayList = explode(";",$sendList);
		}
		echo '---there1arrfater';
		echo '<pre>'.print_r($sendArrayList, true).'</pre>'; 
		return $sendArrayList;
	}







}



?>