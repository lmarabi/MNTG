<?php
/*
$host = "localhost"; 
$user = "traffic"; 
$pass = "thetrafficgenerator";
$db = "traffic" ;
$table = "traffic_requests";

if (!mysql_connect($host, $user, $pass))
    die("Can't connect to database");

if (!mysql_select_db($db))
    die("Can't select database");



 $result = mysql_query("SELECT id FROM traffic_requests ORDER BY id dESC LIMIT 1;");
  if (!$result) {
    die("Query to show fields from table failed");
  }
*/
$rEmail = "cs.louai@gmail.com";
$idrequest = 1083;
$cmd = " java -jar /home/yackel/Emailer.jar ".$rEmail." ".$idrequest;
?>
