<?php
/**
 * Database setup
 * Creates all the tables for the project
 * @author Jinhai Wang
 * Date: Feb 10, 2015
 */
/*change your db login info*/
require('../config.php');

$servername = $configs['db_host_rrsframe'];
$username = $configs['db_user_rrsframe'];
$password = $configs['db_pass_rrsframe'];
$database = $configs['db_name_rrsframe'];

$dbConn = mysql_connect($servername, $username,$password); 
        
if (!($dbConn)) {
    print("\n");
    die('Failed to connect to database: ' . mysql_error());
}
       
$query = "CREATE DATABASE  IF NOT EXISTS `rss_reservation`";
$result = mysql_query($query);
$dbSelected = mysql_select_db($database, $dbConn);
if (!$dbSelected) {
    print("\n");
    die ('Can\'t use '.'database'.' : ' . mysql_error());
}
$query = "DROP TABLE IF EXISTS user";
$result = mysql_query($query);
$query = "CREATE TABLE `user` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `firstname` text NOT NULL,
    `lastname` text NOT NULL,
    `email` text NOT NULL,
    `passwordHash` text NOT NULL,
    `phone` int(11),
    `UserName` text NOT NULL,
    `verified` tinyint(1) NOT NULL default '0',
    `city` text NOT NULL,
    `address` text,
    `post code` text,
    `role` text NOT NULL,
    `status` varchar(50) NOT NULL default 'active',
    `rewardpoint` int NOT NULL default '0',
    `likes` text,
     PRIMARY KEY (`id`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS owner";
$result = mysql_query($query);
$query = "CREATE TABLE `owner` (
    `ownerid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `businessnumber` text,
    `businessphone` int(11),
    `verified` tinyint(1) NOT NULL default '0',
    FOREIGN KEY (userId) REFERENCES user (id),
    PRIMARY KEY (`ownerid`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS restaurant";
$result = mysql_query($query);
$query = "CREATE TABLE `restaurant` (
    `restaurantid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `address` text NOT NULL,
    `type` text NOT NULL,
    `restaurantname` text NOT NULL,
    `email` text NOT NULL,
    `phone` int(11),
    `features` text NOT NULL,
    `pricerange` text NOT NULL,
    `about` text NOT NULL,
    `website` text NOT NULL,
    `holidayhour` text NOT NULL,
    `likes` int(11) default '0',
    `profilepicture` text NOT NULL,
    `verified` tinyint(1) NOT NULL default '0',
     PRIMARY KEY (`restaurantid`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS restaurantOwnership";
$result = mysql_query($query);
$query = "CREATE TABLE `restaurantOwnership` (
    `ownerid` int(10) unsigned NOT NULL,
    `restaurantid` int(10) unsigned NOT NULL,
    `verified` tinyint(1) NOT NULL default '0',
    FOREIGN KEY (ownerid) REFERENCES owner (ownerid),
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid),
    PRIMARY KEY (`restaurantid`,`ownerid`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS businesshour";
$result = mysql_query($query);
$query = "CREATE TABLE `businesshour` (
    `restaurantid` int(10) unsigned NOT NULL,
    `day` tinyint(1),
    `starhour` varchar(20) not null,
    `end` varchar(20) not null,
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid),
    PRIMARY KEY (`restaurantid`,`day`,`starhour`,`end`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS signatureDish";
$result = mysql_query($query);
$query = "CREATE TABLE `signatureDish` (
    `restaurantid` int(10) unsigned NOT NULL,
    `dishname` varchar(50) not null,
    `price` tinyint(4) default '0',
    `rating` tinyint(1) not null default '0',
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid),
    PRIMARY KEY (`restaurantid`,`dishname`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS photomenu";
$result = mysql_query($query);
$query = "CREATE TABLE `photomenu` (
    `restaurantid` int(10) unsigned NOT NULL,
    `menuname` varchar(100) not null,
    `menuid` varchar(50) not null,
    `menucategory` text not null,
    `menuurl` text,
    `tag` text,
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid),
    PRIMARY KEY (`restaurantid`,`menuid`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS textmenu";
$result = mysql_query($query);
$query = "CREATE TABLE `textmenu` (
    `restaurantid` int(10) unsigned NOT NULL,
    `itemid` varchar(50) not null,
    `itemName` text not null,
    `price` decimal(4,2) default '0',
    `itemType` text not null,
    `tag` text,
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid),
    PRIMARY KEY (`restaurantid`,`itemid`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS creditcardinfo";
$result = mysql_query($query);
$query = "CREATE TABLE `creditcardinfo` (
    `cardNum` varchar(50) not null,
    `name` text not null,
    `address` text not null,
    `cv` text not null,
    `expireddate` datetime not null,
    `userId` int(10) unsigned NOT NULL,
    FOREIGN KEY (userId) REFERENCES user (id),
    PRIMARY KEY (`cardNum`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS reservation";
$result = mysql_query($query);
$query = "CREATE TABLE `reservation` (
    `restaurantid` int(10) unsigned NOT NULL,
    `reservationid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `numguest` int(4) unsigned not null,
    `note` text,
    `invitationList` text,
    `dinningtime` datetime not null,
    `email` text,
    `phone` int(11) not null,
    FOREIGN KEY (userId) REFERENCES user (id),
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid),
    PRIMARY KEY (`reservationid`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS eventattandance";
$result = mysql_query($query);
$query = "CREATE TABLE `eventattandance` (
    `reservationid` int(10) unsigned NOT NULL,
    `userId` int(10) unsigned NOT NULL,
    FOREIGN KEY (userId) REFERENCES user (id),
    FOREIGN KEY (reservationid) REFERENCES reservation (reservationid),
    PRIMARY KEY (`reservationid`,`userId`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS reservtiontransaction";
$result = mysql_query($query);
$query = "CREATE TABLE `reservtiontransaction` (
    `restaurantid` int(10) unsigned NOT NULL,
    `reservationid` int(10) unsigned NOT NULL ,
    `tansactionid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `amount` decimal(4,2) not null default '0',
    `transactiontime` datetime not null,
    FOREIGN KEY (userId) REFERENCES user (id),
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid),
    FOREIGN KEY (reservationid) REFERENCES reservation (reservationid),
    PRIMARY KEY (`tansactionid`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS events";
$result = mysql_query($query);
$query = "CREATE TABLE `events` (
    `restaurantid` int(10) unsigned NOT NULL,
    `eventid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `eventname` text not null,
    `eventdiscription` text,
    `eventpictureurl` text,
    `eventtime` datetime not null,
    `eventendtime` datetime not null,
    FOREIGN KEY (userId) REFERENCES user (id),
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid),
    PRIMARY KEY (`eventid`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS review";
$result = mysql_query($query);
$query = "CREATE TABLE `review` (
    `restaurantid` int(10) unsigned NOT NULL,
    `reviewid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `comment` text not null,
    `servicerating` int(1) not null,
    `foodrating`  int(1) not null,
    `ambiencerating` int(1) not null,
    `overallexp` int(1) not null,
    `votes` int(10) not null default '0',
    `reviewtime` datetime not null,
    FOREIGN KEY (userId) REFERENCES user (id),
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid),
    PRIMARY KEY (`reviewid`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS subscription";
$result = mysql_query($query);
$query = "CREATE TABLE `subscription` (   
    `userId` int(10) unsigned NOT NULL,
    `email` text not null,
    FOREIGN KEY (userId) REFERENCES user (id),
    PRIMARY KEY (`userId`)
    )";


$result = mysql_query($query);

/*insert default data*/
$query = "insert into user (firstname,lastname,email,passwordHash,username,verified,role) values('','','','1234','admin',1,'super admin');";
$result = mysql_query($query);

if($result){
    echo "<b>successfully set up database!</b><br><b>Please update amdin info and password asap.</b>";
}
else{
  die('Could not create table: ' . mysql_error());
  
}
mysql_close($dbConn);
?>