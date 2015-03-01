<?php
/**
 * database utillity class provide db connection, user verification
 * @author Jinhai Wang
 * Date: Feb 10, 2015
 */
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'config.php'); 
require_once($root.'model/user.php');


class mysqldatabaserrs{

	/*private $dbhostname =$configs['db_host_rrsframe'];
	private $dbusername = $configs['db_user_rrsframe'];
	private $dbpassword = $configs['db_pass_rrsframe'];
	private $databasename = $configs['db_name_rrsframe'];*/
	private $dbhostname ="";
	private $dbusername = "";
	private $dbpassword = "";
	private $databasename = "";
	function __construct() { 

    	$dbhostname =$configs['db_host_rrsframe'];
		$dbusername = $configs['db_user_rrsframe'];
		$dbpassword = $configs['db_pass_rrsframe'];
		$databasename = $configs['db_name_rrsframe'];         
    }
	
	/**
     * create database connection using crediential from config.php
     * @return database connection
     */
	function connectdb(){
		$host = 'localhost';
		$dbname = 'rss_reservation';
		$constring =  'mysql:host='.$host.';dbname='.$dbname ;
		$connection = new PDO($constring, 'root', 'jasonwang');
		

		return $connection;
	}


	/**
     * close connection
     * @param connection to be closed
     * @return none
     */
	function closeconnction($dbconnection){

		$dbconnection = null;
	}


	/**
     * verify user by searching user from db with pass and email
     * @param email
     * @param password
     * @return true/false
     */
	function verifyUser($email,$password){
		$conn = mysqldatabaserrs::connectdb();
		$query = 'select email,passwordHash from user where email=:email and passwordHash=:password';
		$stmt = $conn->prepare($query);

		$stmt->bindValue(':email',$email);
		$stmt->bindValue(':password',$password);

		$stmt->execute();

		if($stmt->fetchAll(PDO::FETCH_ASSOC)){
			mysqldatabaserrs::closeconnction($conn);
			return true;
		}
		else{
			mysqldatabaserrs::closeconnction($conn);
			return false;
		}

	}

	/**
     * getBasicUserInfo: get basic info from db (such as email, username, userid and status)
     * @param email
     * @param password
     * @return true/false
     */
	function getBasicUserInfo($email){
		return user::selectBasicInfo($email);
	}


}

?>