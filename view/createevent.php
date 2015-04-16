<?php
	
	/*****jinhai Wang****/
	$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
	require_once($root.'model/user.php');
	require_once($root.'model/event.php');
	date_default_timezone_set('America/Toronto');


	session_start();
	$eventobj = new event;
	$eventname = $_POST['eventname'];
	$eventstartdate = $_POST['startdate'];
	$eventenddate = $_POST['enddate'];
	$eventstarttime = $_POST['starttime'];
	$eventendtime = $_POST['endtime'];
	$pictureurl = '';
	$description=$_POST['description'];
	$uid=$_SESSION['sess_user_id'];
	$rid=$_POST['restid'];

	$pictureurl = imageUpLoader();
	//merge datetime
	$startdatetime = $eventstartdate. ' ' . $eventstarttime.':00';
	$enddatetime = $eventenddate. ' ' . $eventendtime.':00';
	$eventobj->setUserId($uid);
	$eventobj->setRestaurantId($rid);
	$eventobj->setEventName($eventname);
	$eventobj->setEventDiscription($description);
	$eventobj->setEventPictureUrl($pictureurl);
	$eventobj->setEventTime($startdatetime);
	$eventobj->setEventEndTime($enddatetime);

	$eventobj->insertEvent();


	if($reviewobj->getReviewId()>0){
		
		header('Location: /RRS/profile?id='.$rid);	
	}
	header('Location: /RRS/profile?id='.$rid);	




	//this function will upload image and return url
	function imageUpLoader(){
		$target_dir = "imagehost/";
		$target_file = $target_dir . basename($_FILES["eventimage"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["eventimage"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		
		if ($_FILES["eventimage"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			$all_files = scandir("imagehost",1);
			$tempnum='0';
			if(count($all_files)>0){
				$last_files = $all_files[0];
				$newname = explode('.', $last_files);
				$tempnum = (int)($newname[0]);
				$tempnum = $tempnum+1;
				$tempnum = (string)$tempnum;
				
			}
			else{
				$tempnum='0';
			}
			$info = pathinfo($_FILES['eventimage']['name']);
			$ext = $info['extension']; // get the extension of the file
			$newname = $tempnum.'.'.$ext; 
			$target = 'imagehost/'.$newname;
			$target_file = $target_dir . basename($target);
		    if (move_uploaded_file($_FILES["eventimage"]["tmp_name"], $target_file)) {
		        //echo "The file ". basename( $_FILES["eventimage"]["name"]). " has been uploaded.";
		        return $target;
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
		return '';

	}
	
?>