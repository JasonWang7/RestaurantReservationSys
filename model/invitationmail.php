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
		
    }

	function sendemail(){
		$this->buildBody();
		$sendToArray = array();
		$sendToArray = $this->buildSendToArray();
		if(count($sendToArray)>0){
			foreach($sendToArray as $toVal){
				if($toVal!=""){					
					mail($toVal,$this->subject,$this->body,$this->headers);
				}
			}
		}

	}

	function buildBody(){
		$this->body='<table width="450px" border="0" cellspacing="0" cellpadding="10" background="http://thumbs.dreamstime.com/x/10889588http://www.dreamstime.com/royalty-free-stock-photos-menu-dinner-party-invitation-10889588.jpg">
		<tr>
			<td align="center">
	  			<img src="https://i.imgur.com/VMDg9Dc.png?1" style="width:100px; margin-top:0px;">
	  		</td>
		</tr>
  		<tr>
	    	<td style="color: black;font-weight:bolder">'.
				'Hello, <br/> <br/>'.$this->userobj->getFirstName().' '.$this->userobj->getLastName().' have invited you to dine at '.$this->restaurantobj->getRestaurantName().'.'. 
				'<br/>Address: '.$this->restaurantobj->getAddress().'.<br/>'.
				'Time: '.$this->revseravtionobj->getDinningTime().'<br/>'.
				'Website: <a href="'.'http://localhost/RRS/profile?id='.$this->restaurantobj->getId().'">'.$this->restaurantobj->getRestaurantName().'</a><br/><br/>'.
				'<hr/>Send on Behalf of '.$this->userobj->getFirstName().' '.$this->userobj->getLastName().'<br/>'.
				'Email: '.$this->userobj->getUserEmail().'<br/>'.
				'Phone: '.$this->userobj->getPhone().'<br/>'.
				'Sent By: Reserve4U INC.<br/>'.
				'We wish you a happy meal!'.
			'</td>
  		</tr>
		</table>';
	}

	function buildSendToArray(){
		$sendList  = $this->revseravtionobj->getInvitationList();		
		$sendArrayList = array();
		if($sendList!=""){
			$sendArrayList = explode(";",$sendList);
		}
		return $sendArrayList;
	}







}



?>