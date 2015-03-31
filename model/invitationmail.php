<?php
/******jinhai wang******/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'model/reservation.php');
require_once($root.'model/user.php');
class invitationmail{
	private $to;
	private $from;
	private $subject;
	$subject="Reserve4U Dinning Invitation";
	private $header;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: reserve4u110@gmail.com' . "\r\n";
	private $body;
	private $revseravtionobj;
	private $userobj;
	private $restaurantobj;
	
	function __construct($reserveParam,$userParam,$restaurantParam) { 	
		$revseravtionobj = $reserveParam;
		$userobj = $userParam;
		$restaurantobj = $restaurantParam;
    }

	function sendemail(){
		$sendToArray = buildSendToArray();
		buildBody();
		if(count($sendToArray)>0){
			foreach($sendToArray as $toVal){
				if($toVal!=""){
					mail($toVal,$subject,$body,$headers);
				}
			}
		}

	}
	function buildBody(){
		$body='<div style="display:inline; background-color:red;"><h2>Revserve4U</h2></div>'.
		'Hi, <br/> <br/>'.$userobj->getFirstName().' '.$userobj->getFirstName().' invite you to dinner at '.$restaurantobj->getRestaurantName().'.'. 
		'<br/>Address: '.$restaurantobj->getAddress.'<br/>'.
		'<br/>Time: '.$revseravtionobj->getDinningTime().'<br/>'.
		'Weblink: <a href="'.'http://localhost/profile?id='.$restaurantobj->getId().'<br/><br/>'.
		'Send on Behalf Of '.$userobj->getFirstName().' '.$userobj->getFirstName().'<br/>'.
		'Email: '.$userobj->getUserEmail().'<br/>'.
		'Phone: '.$userobj->getPhone().'<br/>'.
		'Sent By: Revserve4U INC.';
	}
	function buildSendToArray(){
		$sendList  = $revseravtionobj->getInvitationList();
		$sendArrayList = array();
		if($sendList!=""){
			$sendArrayList = explode(";",$sendList)
		}
		return $sendArrayList;
	}







}



?>