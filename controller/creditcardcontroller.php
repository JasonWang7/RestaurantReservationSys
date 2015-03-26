<?php
/*****jinhai Wang****/
	$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
	require_once($root.'model/creditcard.php');
	function addCreditcard(){
		$cardObj = new creditcard;
		//$cardObj->setUserId($_POST['userid']);
		$cardObj->setCardNum($_POST['cardNum']);		
		$cardObj->setUserId($_SESSION['sess_user_id']);
		$cardObj->setAddress($_POST['address']);
		$cardObj->setCV($_POST['cv']);
		$cardObj->setName($_POST['name']);
		$cardObj->setCardType($_POST['cardtype']);
		$cardObj->setExpireDate($_POST['expireddate']);
		if($cardObj->luhn_checksum($cardObj->getCardNum())&&$cardObj->cv_check($cardObj->getCV())&&$cardObj->exp_date_check($cardObj->getExpireDate())){
			$cardObj->insertCardInfo($cardObj);
			
		}
		return $cardObj;
	}


?>