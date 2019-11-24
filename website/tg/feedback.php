<?php
if ($_POST['action']=="feedback") {
	$rName = $_POST['rName'];
	$rEmail = $_POST['rEmail'];
        $message = $_POST['message'];


$host = "localhost"; 
$user = "traffic"; 
$pass = "thetrafficgenerator";
$db = "traffic" ;



if (!mysql_connect($host, $user, $pass))
    die("Can't connect to database");

if (!mysql_select_db($db))
    die("Can't select database");

// sending query
    $result = mysql_query("INSERT INTO feedback(
            name, email, feedback)
    VALUES ('$rName' , '$rEmail', '$message');");
    if (!$result) {
        echo "An error occurred in inserting.\n";
        exit;
    }
    mysql_close();
    }
?>

