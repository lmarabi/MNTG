<?php
if (isset($_POST['down'])) {
    $files = array('node.txt', 'edge.txt');
    $zipname = 'files.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    foreach ($files as $file) {
        $zip->addFile($file);
    }
    $zip->close();
    if (file_exists($zipname)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename=' . basename($zipname));
        header('Content-Length: ' . filesize($zipname));
        ob_clean();
        flush();
        readfile($zipname);
    }
}
// onload="init()"Importer()
//<script type="text/javascript" src="osm_tools.js"></script>
?>
<!DOCTYPE html>
<html>
    <head>

        <link href="interface.css" rel="stylesheet" type="text/css" />
        <link href="tabcontent.css" rel="stylesheet" type="text/css" />
        <script src="tabcontent.js" type="text/javascript"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MNTG traffic generator</title>
        <script src="jquery-1.8.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
        <script type="text/javascript" src="osm_tools.js"></script>
        <script type="text/javascript" src="Export.js"></script>
        <script type="text/javascript" src="Import.js"></script>
        <script type="text/javascript" src="Path.js"></script>
        <script type="text/javascript" src="feedback.js"></script>
	<script src="http://maps.google.com/maps/api/js?v=3.6&amp;sensor=false"></script>

    </head>
<Script>
$(document).ready(function(){
	$("select").change(function(){
		var value = document.getElementById("type").value;
			$("#panelForm").hide();
			$("#BerlinMOD").hide();
			$("#Brinkhoff").hide();
			$("#generate").hide();
	     //Add the current date of the day
	      var currentTime = new Date();
	      document.getElementById("TrafficRequest.name").value = "Traffic "+currentTime;
	      document.getElementById("TrafficRequest.email").value = "";
	      //$("#TrafficRequest.name1").val("hello");
		if(value =="Brinkhoff"){
			$("#panelForm").fadeIn(2000);
			$("#Brinkhoff").fadeIn(2000);		
			$("#BerlinMOD").hide();
                        $("#Random").hide();
			$("#generate").fadeIn(2000);
		}else if (value == "BerlinMOD"){
			$("#panelForm").fadeIn(2000);
			$("#BerlinMOD").fadeIn(2000);		
			$("#Brinkhoff").hide();
                        $("#Random").hide();
			$("#generate").fadeIn(2000);
		}else if (value == "Random"){
                        $("#panelForm").fadeIn(2000);
                        $("#Random").fadeIn(2000);           
                        $("#Brinkhoff").hide();
                        $("#BerlinMOD").hide();
                        $("#generate").fadeIn(2000);
                }else{
			$("#BerlinMOD").hide();
			$("#Brinkhoff").hide();
			$("#generate").hide();
			$("#panelForm").hide();
                        $("#Random").hide();
		}
	});


	
}); 
</script>
   <body>
        <div id="header">
<table border="0">
<tr>
<td><img src="minlogo.png" alt="MNTG" width="80" height="50" align="middle"></td>
<td><font size="4" align="middle"><b>MNTG: Minnesota Web-based Traffic Generator</b></font><b></td>
</tr>
</table> 

<hr>	          
<!--Define the tabs in the left panel-->
            <ul class="tabs">
                <li onclick="reset()"><a href="#" rel="view2">Generate</a></li>
                <li onclick="reset()"><a href="#" rel="view3">Visualize Traffic </a></li>
		<li onclick="reset()"><a href="#" rel="view1">Feedback </a></li>
                <li onclick="reset()"><a href="#" rel="view4">About</a></li>
            </ul>

            <div class="tabcontents">
<!--tab Generate Traffic-->
                <div id="view2" class="tabcontent">
                    <form name="export">
<table>
     <tr><td><input id = "address" name = "searchValue" type = "text" size = "19" onkeydown="if (event.keyCode == 13) codeAddress()"/>
         <input type = "button" onclick = "codeAddress()" name = "search" value = "Search area"/></td></tr>
</table>

                        Drag and draw to choose area : <br>
                        <input type="radio" name="area" value="none" id="noneToggle" onclick="toggleControl(this);"checked> 
                        <label for="noneToggle">Drag</label><br>
                        <input type="radio" name="area" value="box" id="boxToggle" onclick="toggleControl(this);">
                        <label for="boxToggle">Draw Box</label><br> 
			<table><br>
			<tr><td>Choose the traffic model:</td>
                        <tr><td><font color='red'>Brinkhoff under maintenance !</font> </td>
                        <td><select id="type" value="----">
			    <option value="----">----</option>
			  <!--  <option value="Brinkhoff">Brinkhoff</option> -->
                            <option value="BerlinMOD">BerlinMOD</option>
		            <option value="Random">Random</option>
                        </select></td></tr></table><br>
                        <input type="text" id="boxC" value="" name="coords" style="display: none">
		  <div style="display:none" id="panelForm">
		    Please enter the following information to request traffic:<br><br>
                    Name: <input name="TrafficRequest.name1" id="TrafficRequest.name"  size="22" type="text"><br>
                    Email: <input name="TrafficRequest.email1" id="TrafficRequest.email" size="22" type="text"><br>	 
<!--tab Generate Traffic in BerlineMOD-->	  
		<div style="display:none;" id="BerlinMOD">
		        <table>
			<tr>
     			 <td>Number of Vehicles (1-2000):</td>
			 <td><input name="TrafficRequest.scaleFactor" id="TrafficRequest.scaleFactor" value="5" size="2" type="text">
                        vehicles</td>
			</tr>
		        </table>
                    </div>


<!-- tab for random generator -->
                <div style="display:none;" id="Random">
		 Starting Vehicles:
                        <table>
                            <tr><td><input name="TrafficRequest.objBegin.random" id="TrafficRequest.objBegin.random" value="5" size="10" type="text">
                                vehicles</td>
                            </tr>
                        </table>
                        <table>
                        Simulation Time:
                            <tr>
                                <td> <input name="TrafficRequest.maxTime.random" id="TrafficRequest.maxTime.random" value="20" size="10" type="text">
                                time units</td>
                            </tr>
                        </table>
                    </div>


<!--tab Generate Traffic Brinkhoff-->
 		 <div style="display:none;" id="Brinkhoff">
			Starting Vehicles:
                        <table>
                            <tr><td><input name="TrafficRequest.objBegin" id="TrafficRequest.objBegin" value="5" size="10" type="text">
                                vehicles</td>
                            </tr>
			</table>
			<table>
			Simulation Time:
                            <tr>
                                <td> <input name="TrafficRequest.maxTime" id="TrafficRequest.maxTime" value="20" size="10" type="text">
                                time units</td>
                            </tr>
			</table>
                        Added Vehicles each Time Unit:
			<table>
                            <tr><td><input name="TrafficRequest.objPerTime" id="TrafficRequest.objPerTime" value="5" size="6" type="text">
                                vehicles/time unit</td>
                            </tr>
				<tr>
                                <td style="display:none;">Starting External Noise:</td>
                                <td><input type = 'text' name = 'TrafficRequest.extObjBegin' id = 'TrafficRequest.extObjBegin' value = '0' size 					= '4' style="display:none;"/></td>
                                <td style="display:none;">noisy objects</td>
                            </tr>
                            <tr>
                                <td style="display:none;">Max Speed Div:</td>
                                <td> <input type = 'text' name = 'TrafficRequest.msd' id = 'TrafficRequest.msd' value = '50' size = '4' 				style="display:none;"/></td>
                                <td style="display:none;">mph</td>
                            </tr>
                            <tr>
                                <td  style="display:none;">Added Noise each Time Unit:</td>
                                <td><input type = 'text' name = 'TrafficRequest.extObjPerTime' id = 'TrafficRequest.extObjPerTime' value = '0' 					size = '4' style="display:none;"/></td>
                                <td  style="display:none;">noisy objects/time unit</td>
                            </tr>
                            <tr>
                                <td  style="display:none;">Classes of Vehicles:</td>
                                <td> <input type = 'text' name = 'TrafficRequest.numObjClasses' id = 'TrafficRequest.numObjClasses' value = '6' 				size = '4' style="display:none;"/></td>
                                <td  style="display:none;">classes</td>
                            </tr>
                            <tr>
                                <td  style="display:none;">Classes of Noise Objects:</td>
                                <td> <input type = 'text' name = 'TrafficRequest.numExtObjClasses' id = 'TrafficRequest.numExtObjClasses' value 				= '3' size = '4' style="display:none;"/></td>
                                <td  style="display:none;">classes</td>
                            </tr>
                        </table>
                    </div>
			<table>
		  <tr>  <td> <input name="additionalFilesBrinkhoff" id="additionalFilesBrinkhoff" value="placeholder" type="checkbox">  Check to 				receive road networks in txt format</td></tr>
                     <tr><td><input type="button" value="Generate" id="generate" style="display:none" onclick="exportForm()">   </td></tr> </table> 
</div>
                    <form method="POST" name="down"></form>
                </div>
<!--tab Visualize Traffic-->
                <div id="view3" class="tabcontent">

                    <br><text id="nodeErr">Upload your generated traffic file:</text> 
                    <input id="Nodes" type="file" value="Nodes file" size="15"/></button>
		    <table><tr>
                    <td><button onclick="doErase('Nodes')"/>clear</button></td>
                    <td><button type="submit" id="startBtn"onclick="Importer()"/>Submit</button></td>
		    </tr>
		    </table>
		    <br><br>
		    <table><tr><td><font size="5"> <a href="http://mntg.cs.umn.edu/traffic_requests/upload_traffic/">Visualize Traffic From File</a></font></td></tr>
		    </table>
                </div>
<!--Feedback-->
			<div id="view1" class="tabcontent">			
			<form name="feedbackFormName" id="feedbackForm" onsubmit="return false;">			
			<table>
				<tr><td>Thanks for using MinnesotaTG<br>
				<center>Please provide us with your feedback</center></td></tr>
				<tr><td>Name: <input name="feedback.name" id="feedback.name" size="21" type="text"></td></tr>
				<tr><td>Email: &nbsp;<input name="feedback.email" id="feedback.email" size="21" type="text"></td></tr>
				<tr><td><textarea id="feedback.message" rows="15" cols="25"></textarea></td></tr>
		        <tr><td><input value="Send Feedback" onclick="FeedbackForm()" type="submit">
                        </td></tr></table>
			<form></form>
                 </div> 
<!--About-->
			<div style="" id="view4" class="tabcontent">						
			<font size="4" color="#930606">Project Overview</font>
<font size="2" color="black">
MinnesotaTG is a project developed at the University of Minnesota. MinnesotaTG is built based on two existing traffic generators: (1) BerlinMod and (2) Thomas-Brinkhoff. The purpose of MinnesotaTG is to take an arbitrary region in the world and generate traffic data from that region. Without this tool, generating this traffic is a complicated and drawn out process because of the number of configuration steps necessary to get either Thomas-Brinkhoff or BerlinMod both up and running, and able to work on a user specified region. The generation of the traffic is not done by the tool itself, but rather it is performed by these two different traffic generators.
</font>
</br>
<font size="4" color="#930606">
People </br>
</font>
<font size="3" color="black">
<a href="http://www-users.cs.umn.edu/~mokbel/">Mohamed F. Mokbel</a></br>
Steven Yackel </br>
<a href="http://www-users.cs.umn.edu/~sarwat/">Mohamed Sarwat</a> </br>
<a href="http://www-users.cs.umn.edu/~amr/">Amr Magdy</a> </br>
<a href="http://www-users.cs.umn.edu/~baojie/">Jie Bao</a> </br>
Ethan Waytas </br>
<a href="http://www-users.cs.umn.edu/~louai/">Louai Alarabi</a> </br>
<a href="http://www-users.cs.umn.edu/~eldawy/">Ahmed Eldaway</a> </br>
</font>
			<!--<iframe src="http://mntg.cs.umn.edu/about_help.html" width="300" height="500"></iframe>-->
			<font Style="center" size="4"><a href="http://mntg.cs.umn.edu/about_help.html">More</a></font>		
                 </div> 

                </div>
		
            </div>
	
	</div>
        <div id="osm-map"></div>
        
    </body>

</html>

