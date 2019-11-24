<?php

if ($_POST['action']=="coords") {
	$type = $_POST['type'];
	$rName = $_POST['rName'];
	$rEmail = $_POST['rEmail'];
    switch ($type) {
        case 'BerlinMOD':
        $scaleFactor = $_POST['scaleFactor'];
        $objBegin = 0;
        $maxTime = 0;
        $objPerTime = 0;
        $extObjBegin = 0;
        $msd = 0;
        $extObjPerTime = 0;
        $numObjClasses = 0;
        $numExtObjClasses = 0;
	$reportprob = 0;
            break;
        case 'Brinkhoff':
        $scaleFactor = 'NULL';
        $objBegin = $_POST['objBegin'];
        $maxTime = $_POST['maxTime'];
        $objPerTime = $_POST['objPerTime'];
        $extObjBegin = $_POST['extObjBegin'];
        $msd = $_POST['msd'];
        $extObjPerTime = $_POST['extObjPerTime'];
        $numObjClasses = $_POST['numObjClasses'];
        $numExtObjClasses = $_POST['numExtObjClasses'];
	$reportprob = 1000;            
            break;
       case 'Random':
        $scaleFactor = 'NULL';
        $objBegin = $_POST['objBegin'];
        $maxTime = $_POST['maxTime'];
        $objPerTime = $_POST['objPerTime'];
        $extObjBegin = $_POST['extObjBegin'];
        $msd = $_POST['msd'];
        $extObjPerTime = $_POST['extObjPerTime'];
        $numObjClasses = -17;
        $numExtObjClasses = $_POST['numExtObjClasses'];
        $reportprob = 1000; 
            break;
        
    }

    if( ($rName != null || $type != null || $rEmail != null) && (filter_var($rEmail, FILTER_VALIDATE_EMAIL)) ){
	$host = "localhost"; 
	$user = "traffic"; 
	$pass = "thetrafficgenerator";
	$db = "traffic" ;
	$table = "traffic_requests";

	if (!mysql_connect($host, $user, $pass))
	    die("Can't connect to database");

	if (!mysql_select_db($db))
	    die("Can't select database");

	// sending query
	 $coords = split(',', $_POST['coords']);
	$latmax = $coords[0];
    	$latmin = $coords[1];
    	$lonmax = $coords[2];
    	$lonmin = $coords[3];
   	 $result = mysql_query("INSERT INTO traffic_requests(
            name, email, ready, finished, upperlat, upperlong, lowerlat, 
            lowerlong, zoom, objbegin, extobjbegin, objpertime, extobjpertime, 
            numobjclasses, numextobjclasses, maxtime, reportprob, msd, created, 
            modified, scalefactor, finished_timestamp)
    	VALUES ('$rName' , '$rEmail', 1 ,  0 , $latmax , $lonmin , $latmin , 
            $lonmax , 14, $objBegin , $extObjBegin , $objPerTime , $extObjPerTime , 
            $numObjClasses , $numExtObjClasses , $maxTime , $reportprob , $msd , now(), 
            now(), $scaleFactor , now());");
    	if (!$result) {
        	echo "An error occurred in inserting.\n";
        	exit;
    	}

	mysql_free_result($result);



  	if (!mysql_connect($host, $user, $pass))
    		die("Can't connect to database");

	if (!mysql_select_db($db))
    		die("Can't select database");


	 $result = mysql_query("SELECT id FROM traffic_requests ORDER BY id dESC LIMIT 1;");
	 if (!$result) {
    		die("Query to show fields from table failed");
 	 }

		//$fields_num = mysql_num_fields($result);

        $requestid;

	while($row = mysql_fetch_row($result))
	{
              foreach($row as $cell)
                $idrequest = $cell;
         }
	$cmd = "java -jar /home/yackel/Emailer.jar ".$rEmail." ".$idrequest;
	exec($cmd);
		  //mysql_free_result($result);
	mysql_close();

// $cmd = " java -jar /home/yackel/Emailer.jar '".$rEmail."' '".$requestid."'";
 //$cmd = " java -jar /home/yackel/Emailer.jar ".$this->data['TrafficRequest']['email']." ".$this->TrafficRequest->id;
      }
}



?>
