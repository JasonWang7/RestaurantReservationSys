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

$dbConn = mysql_connect($servername, $username, $password); 
        
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
    `phone` varchar(11),
    `UserName` text NOT NULL,
    `verified` tinyint(1) NOT NULL default '0',   /*indicated if credit card is add and verified*/
    `city` text NOT NULL,
    `address` text,
    `postcode` text,
    `role` varchar(100) NOT NULL default 'regular',
    `status` varchar(50) NOT NULL default '', /*empty =unactivated, suspend, activated*/
    `rewardpoint` int NOT NULL default '0',
    `activationcode` varchar(200) NOT NULL default '', 
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
    `phone` varchar(11),
    `features` text NOT NULL,
    `pricerange` text NOT NULL,
    `about` text NOT NULL,
    `website` text,
    `holidayhour` text,
    `likes` int(11) default '0',
    `profilepicture` text ,
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
    `expireddate` varchar(10) not null,
    `userId` int(10) unsigned NOT NULL,
    `cardtype` VARCHAR(50) NOT NULL ,
    FOREIGN KEY (userId) REFERENCES user (id) ON DELETE CASCADE,
    PRIMARY KEY (`cardNum`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS reservation";
$result = mysql_query($query);
/*****status:Reviewing, Rejected, Accapted */
$query = "CREATE TABLE `reservation` (
    `restaurantid` int(10) unsigned NOT NULL,
    `reservationid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `numguest` int(4) unsigned not null,
    `note` text,
    `invitationList` text,
    `dinningtime` datetime not null,
    `email` text,
    `phone` varchar(11)  not null,
    `status` VARCHAR(20) NOT NULL DEFAULT 'Reviewing',
    `reason` VARCHAR(2000) NOT NULL DEFAULT '',
    `updatetime`  timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES user (id) ON DELETE CASCADE,
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid) ON DELETE CASCADE,
    PRIMARY KEY (`reservationid`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS eventattandance";
$result = mysql_query($query);
$query = "CREATE TABLE `eventattandance` (
    `reservationid` int(10) unsigned NOT NULL,
    `userId` int(10) unsigned NOT NULL,
    FOREIGN KEY (userId) REFERENCES user (id) ON DELETE CASCADE,
    FOREIGN KEY (reservationid) REFERENCES reservation (reservationid) ON DELETE CASCADE,
    PRIMARY KEY (`reservationid`,`userId`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS reservationtransaction";
$result = mysql_query($query);
$query = "CREATE TABLE `reservationtransaction` (
    `restaurantid` int(10) unsigned NOT NULL,
    `reservationid` int(10) unsigned NOT NULL ,
    `tansactionid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `amount` decimal(6,2) not null default '0',
    `transactiontime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    `desicription` varchar(4000) not null default '',
    FOREIGN KEY (userId) REFERENCES user (id),
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid) ON DELETE CASCADE,
    FOREIGN KEY (reservationid) REFERENCES reservation (reservationid) ON DELETE CASCADE,
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
    FOREIGN KEY (userId) REFERENCES user (id) ON DELETE CASCADE,
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid) ON DELETE CASCADE,
    PRIMARY KEY (`eventid`)
    )";
$result = mysql_query($query);

//record user activity
$query = "CREATE TABLE `accountlog` (
    `activityindex` int(20) unsigned NOT NULL AUTO_INCREMENT,
    `userid` int(10) unsigned NOT NULL,
    `activity` varchar(400)  not null,
    `clientip` varchar(400)  not null,
    `activitytime`  timestamp NOT NULL default CURRENT_TIMESTAMP,
    FOREIGN KEY (userid) REFERENCES user (id) ON DELETE CASCADE,
    PRIMARY KEY (`activityindex`)
    );";
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
    `spam` int(10) not null default '0',
    `reviewtime` datetime not null,
    FOREIGN KEY (userId) REFERENCES user (id) ON DELETE CASCADE,
    FOREIGN KEY (restaurantid) REFERENCES restaurant (restaurantid) ON DELETE CASCADE,
    PRIMARY KEY (`reviewid`)
    )";

$result = mysql_query($query);

$query = "CREATE TABLE `reviewvote` (
    `reviewid` int(10) unsigned NOT NULL,
    `userId` int(10) unsigned NOT NULL,
    `votevalue` int(1) not null,         /*****1,0,-1 (upvote, none, downvote)******/ 
    `updatetime`  timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES user (id) ON DELETE CASCADE,
    FOREIGN KEY (reviewid) REFERENCES review (reviewid) ON DELETE CASCADE,
    PRIMARY KEY (`reviewid`,`userId`)
    )";

$result = mysql_query($query);

/***** triger to auto update vote count in review table AFTER INSERT******/
$query = "\n"
    . "CREATE TRIGGER reviewvote_after_insert\n"
    . "AFTER INSERT\n"
    . " ON reviewvote FOR EACH ROW\n"
    . " \n"
    . "BEGIN\n"
    . "\n"
    . " DECLARE voteNum int(20);\n"
    . " DECLARE idNum int(10);\n"
    . "\n"
    . " -- Find username of person performing the INSERT into table\n"
    . " SELECT `reviewid`,sum(`votevalue`) FROM `reviewvote` where `reviewid` = NEW.reviewid group by `reviewid` into idNum, voteNum;\n"
    . " \n"
    . " -- update record into audit table\n"
    . " UPDATE `review` SET `votes`=voteNum WHERE `reviewid`=idNum;\n"
    . " \n"
    . "END;";

$result = mysql_query($query);
/***** triger to auto update vote count in review table AFTER UPDATE******/
$query = "\n"
    . "CREATE TRIGGER reviewvote_after_update\n"
    . "AFTER UPDATE\n"
    . " ON reviewvote FOR EACH ROW\n"
    . " \n"
    . "BEGIN\n"
    . "\n"
    . " DECLARE voteNum int(20);\n"
    . " DECLARE idNum int(10);\n"
    . "\n"
    . " -- Find username of person performing the INSERT into table\n"
    . " SELECT `reviewid`,sum(`votevalue`) FROM `reviewvote` where `reviewid` = NEW.reviewid group by `reviewid` into idNum, voteNum ;\n"
    . " \n"
    . " -- update record into audit table\n"
    . " UPDATE `review` SET `votes`=voteNum WHERE `reviewid`=idNum;\n"
    . " \n"
    . "END;";

$result = mysql_query($query);


$query = "CREATE TABLE `spamvote` (
    `reviewid` int(10) unsigned NOT NULL,
    `userId` int(10) unsigned NOT NULL,
    `votevalue` int(1) not null,         /*****1,0 (spam, not spam)******/ 
    `updatetime`  timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES user (id) ON DELETE CASCADE,
    FOREIGN KEY (reviewid) REFERENCES review (reviewid) ON DELETE CASCADE,
    PRIMARY KEY (`reviewid`,`userId`)
    )";

$result = mysql_query($query);

/***** triger to auto update spam count in review table AFTER insert******/
$query =  "\n"
    . "CREATE TRIGGER spamvote_after_insert\n"
    . "AFTER INSERT\n"
    . " ON spamvote FOR EACH ROW\n"
    . " \n"
    . "BEGIN\n"
    . "\n"
    . " DECLARE voteNum int(20);\n"
    . " DECLARE idNum int(10);\n"
    . "\n"
    . " -- Find username of person performing the INSERT into table\n"
    . " SELECT `reviewid`,sum(`votevalue`) FROM `spamvote` where `reviewid` = NEW.reviewid group by `reviewid` into idNum, voteNum ;\n"
    . " \n"
    . " -- update record into audit table\n"
    . " UPDATE `review` SET `spam`=voteNum WHERE `reviewid`=idNum;\n"
    . " \n"
    . "END;";

$result = mysql_query($query);
/***** trigger to auto update spam count in review table AFTER UPDATE******/
$query =  "CREATE TRIGGER spamvote_after_update\n"
    . "AFTER Update\n"
    . " ON spamvote FOR EACH ROW\n"
    . " \n"
    . "BEGIN\n"
    . "\n"
    . " DECLARE voteNum int(20);\n"
    . " DECLARE idNum int(10);\n"
    . "\n"
    . " -- Find username of person performing the INSERT into table\n"
    . " SELECT `reviewid`,sum(`votevalue`) FROM `spamvote` where `reviewid` = NEW.reviewid group by `reviewid` into idNum, voteNum ;\n"
    . " \n"
    . " -- update record into audit table\n"
    . " UPDATE `review` SET `spam`=voteNum WHERE `reviewid`=idNum;\n"
    . " \n"
    . "END;";

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

//create reservation restaurant view
$query =  "CREATE OR REPLACE VIEW view_reservation_restaurant AS (select reservation.reservationid,reservation.userId,restaurant.restaurantid,reservation.numguest,reservation.note,reservation.reason,reservation.invitationList,reservation.dinningtime,reservation.email,reservation.phone as userphone, restaurant.restaurantname,restaurant.address,restaurant.phone from restaurant inner join reservation on restaurant.restaurantid =reservation.restaurantid );";
$result = mysql_query($query);

$query ="CREATE OR REPLACE VIEW view_review_user_restaurant AS (select `id`, `UserName` as reviewname, `reviewid`,review.restaurantid,`comment`,`servicerating`,`foodrating`,`ambiencerating`,`overallexp`,`votes`, `reviewtime`,`spam`,restaurant.restaurantname,restaurant.address,restaurant.type,restaurant.email, restaurant.phone,restaurant.features,restaurant.about,restaurant.likes,restaurant.profilepicture, restaurant.verified from review inner join user on user.id =review.userId inner join restaurant on restaurant.restaurantid = review.restaurantid )";
$result = mysql_query($query);

$query ='CREATE OR REPLACE VIEW `view_transaction_user_restaurant` AS (select `reservationtransaction`.`reservationid` AS `reservationid`,`reservationtransaction`.`userId` AS `userId`,`user`.`firstname` AS `firstname`,`user`.`lastname` AS `lastname`,`user`.`email` AS `useremail`,`user`.`phone` AS `userphone`,`reservationtransaction`.`tansactionid` AS `tansactionid`,`reservationtransaction`.`amount` AS `amount`,`reservationtransaction`.`desicription` AS `desicription`,`reservationtransaction`.`transactiontime` AS `transactiontime`,`reservationtransaction`.`restaurantid` AS `restaurantid`,`restaurant`.`restaurantname` AS `restaurantname`,`restaurant`.`address` AS `address`,`restaurant`.`type` AS `type`,`restaurant`.`email` AS `email`,`restaurant`.`phone` AS `phone`,`restaurant`.`features` AS `features`,`restaurant`.`about` AS `about`,`restaurant`.`likes` AS `likes`,`restaurant`.`profilepicture` AS `profilepicture`,`restaurant`.`verified` AS `verified` from ((`reservationtransaction` join `user` on((`user`.`id` = `reservationtransaction`.`userId`))) join `restaurant` on((`restaurant`.`restaurantid` = `reservationtransaction`.`restaurantid`))));';
$result = mysql_query($query);
/*insert default data*/
$query = "insert into user (firstname,lastname,email,passwordHash,username,verified,role) values('','','admin@example.com','1234','admin',1,'super admin');";
$result = mysql_query($query);

if($result){
    echo "<b>successfully set up database!</b><br><b>Please update amdin info and password asap.</b>";
}
else{
  die('Could not create table: ' . mysql_error());
  
}
mysql_close($dbConn);
?>