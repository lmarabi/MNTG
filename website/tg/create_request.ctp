<?php
include '../../../stats/track.php';
$javascript->link("http://maps.google.com/maps/api/js?sensor=true", false);
$javascript->link("keydragzoom", false);
$javascript->link("maps", false);
$javascript->link("prototype", false);
track("stats_traffic_gen_page");
?>
<?php
if (isset($_POST['submit'])) {
    exec('test.pl');
}
?>
<div class="center title" background-color:darkred style="width:100%; text-align:center; padding-bottom: 10px">
    <div style="margin: 0px auto; text-align:left; width: 1024px; height: 100px">
        <div style="float:left; text-align: center; vertical-align: middle; padding-top: 10px; padding-right:  10px">
            <img src="http://mntg.cs.umn.edu/TwinsGen_files/minlogo.png" width="130" height="80" >
        </div>
        <div  background-color:darkred style="width:880px;">
            <div  style="float:left">

                <font size="6"><b>MNTG: Minnesota Web-based Traffic Generator</></font>
                    <hr>
                    </div>

                    <div  style="float:left">
                        <form onsubmit = "getAddress(); return false;" name ="form">
                            <input id = "searchValue" name = "searchValue" type = "text" size = "30"/>&nbsp;&nbsp;&nbsp;
                            <input type = "button" onclick = "getAddress()" name = "search" value = "Search for Location"/>&nbsp;&nbsp;&nbsp;
                            <select name="method">
                                <option  value = "Brinkhoff">Brinkhoff</option>
                                <option  value = "BerlinMOD">BerlinMOD</option>
                            </select>
                            &nbsp;&nbsp;&nbsp;
                            <input type="button" onClick="hideElement('requestTrafficForm');hideElement('BerlinMOD');hideElement('Brinkhoff');showElement('requestTrafficForm');showElement(document.form.method.options[document.form.method.options.selectedIndex].value)" value="Generate">
                            <input type="button" onClick="hideElement('requestTrafficForm');hideElement('BerlinMOD');hideElement('Brinkhoff');showElement('HelpDiv')" value="Help">
                             <!--<input type="button" onClick="hideElement('requestTrafficForm');hideElement('BerlinMOD');hideElement('Brinkhoff');" value="Clear"></p>-->

                        </form>

                    </div>
                    <br>

                    </div>
                    </div>
                    <div style="margin: 0px auto; width: 100%;height: 15px ">  </div>
            </div>

            <div class = "center alignCenter warning" id = "response">
            </div>

            <div class = "center" id = "map_canvas" style="width:100%; height:70%; padding-top: 10px">

            </div>

            <div class = 'popup alignCenter' style = 'display: none;width:500px' id = 'requestTrafficForm'>
                <form name = "requestTrafficBrinkhoffForm" id="parameterForm" onsubmit = "return false;">
                    Please enter the following information to request traffic:<br/><br/>
                    Name: <input type = 'text' name = 'TrafficRequest.name' id = 'TrafficRequest.name' value = 'Traffic (<?php echo date(DATE_RFC850); ?>)' size = '50'/><br/>
                    Email: <input type = 'text' name = 'TrafficRequest.email' id = 'TrafficRequest.email' size = '50'/><br/>

                    <div style = 'display: none;' id = 'Brinkhoff'>
                        <table style="width:90%;text-align:left;" align="center">
                            <tr>
                                <td>Starting Vehicles:</td>
                                <td><input type = 'text' name = 'TrafficRequest.objBegin' id = 'TrafficRequest.objBegin' value = '5' size = '4'/></td>
                                <td>vehicles</td>
                            </tr>
                            <tr>
                                <td>Simulation Time:</td>
                                <td> <input type = 'text' name = 'TrafficRequest.maxTime' id = 'TrafficRequest.maxTime' value = '20' size = '4'/></td>
                                <td>time units</td>
                            </tr>
                            <tr>
                                <td>Added Vehicles each Time Unit:</td>
                                <td><input type = 'text' name = 'TrafficRequest.objPerTime' id = 'TrafficRequest.objPerTime' value = '5' size = '4'/></td>
                                <td>vehicles/time unit</td>
                            </tr>
                            <tr>
                            	<td nowrap><input type="checkbox" name="additionalFilesBrinkhoff" id="additionalFilesBrinkhoff" value="placeholder">  Check to receive road networks in txt format</td>
                            </tr>
                            <tr>
                                <td style="display:none;">Starting External Noise:</td>
                                <td><input type = 'text' name = 'TrafficRequest.extObjBegin' id = 'TrafficRequest.extObjBegin' value = '0' size = '4' style="display:none;"/></td>
                                <td style="display:none;">noisy objects</td>
                            </tr>
                            <tr>
                                <td style="display:none;">Max Speed Div:</td>
                                <td> <input type = 'text' name = 'TrafficRequest.msd' id = 'TrafficRequest.msd' value = '50' size = '4' style="display:none;"/></td>
                                <td style="display:none;">mph</td>
                            </tr>
                            <tr>
                                <td  style="display:none;">Added Noise each Time Unit:</td>
                                <td><input type = 'text' name = 'TrafficRequest.extObjPerTime' id = 'TrafficRequest.extObjPerTime' value = '0' size = '4' style="display:none;"/><br/></td>
                                <td  style="display:none;">noisy objects/time unit</td>
                            </tr>
                            <tr>
                                <td  style="display:none;">Classes of Vehicles:</td>
                                <td> <input type = 'text' name = 'TrafficRequest.numObjClasses' id = 'TrafficRequest.numObjClasses' value = '6' size = '4' style="display:none;"/></td>
                                <td  style="display:none;">classes</td>
                            </tr>
                            <tr>
                                <td  style="display:none;">Classes of Noise Objects:</td>
                                <td> <input type = 'text' name = 'TrafficRequest.numExtObjClasses' id = 'TrafficRequest.numExtObjClasses' value = '3' size = '4' style="display:none;"/></td>
                                <td  style="display:none;">classes</td>
                            </tr>

                        </table>
                        <input type = 'text' name = 'TrafficRequest.reportProb' id = 'TrafficRequest.reportProb' value = '1000' size = '4' style="display:none;"/>
                        <input type = 'submit' value = 'Generate Thomas Brinkhoff Traffic' onclick = "getTrafficBrinkhoff(); hideElement('requestTrafficForm'); "/> <input type = 'button' value = 'Cancel' onclick = "hideElement('requestTrafficForm');hideElement('BerlinMOD');hideElement('Brinkhoff');"/>

                    </div>

                    <div style = 'display: none;' id = 'BerlinMOD'>
                        <table style="width:90%;text-align:left;" align="center">
                            <tr>
                                <td>Number of Vehicles (1-2000):</td>
                                <td><input type = 'text' name = 'TrafficRequest.scaleFactor' id = 'TrafficRequest.scaleFactor' value = '5' size = '4'/></td>
                                <td>vehicles</td>
                            </tr>
                            <tr>
								<td nowrap><input type="checkbox" name="additionalFilesBerlinMOD" id="additionalFilesBerlinMOD" value="placeholder">  Check to receive road networks in txt format</td>
							</tr>
                        </table>
                        <input type = 'submit' value = 'Generate BerlinMOD Traffic' onclick = "getTrafficBerlinMOD(); hideElement('requestTrafficForm'); "/> <input type = 'button' value = 'Cancel' onclick = "hideElement('requestTrafficForm');hideElement('BerlinMOD');hideElement('Brinkhoff');"/>
                    </div>
                    <br/>

                    <span style = 'display: none;' id = 'BerlinMODSubmit'>
                        <input type = 'submit' value = 'Get BerlinMOD Traffic' onclick = "getTrafficBerlinMOD(); hideElement('requestTrafficForm');"/><br>
                    </span>
                    <span style = 'display: none;' id = 'BrinkhoffSubmit'>
                        <input type = 'submit' value = 'Get Thomas Brinkhoff Traffic' onclick = "getTrafficBrinkhoff(); hideElement('requestTrafficForm');"/>
                    </span>
                </form>
            </div>

            <div class = 'popup alignCenter' style = 'display: none;' id = 'feedbackFormDiv'>
                <p align="center"><h2>Thanks for using MinnesotaTG</h2></p><br/>
                <center>Please provide us with your feedback</center>
                <form name = "feedbackFormName" id="feedbackForm" onsubmit = "return false;">
                    Name: <input type = 'text' name = 'feedback.name' id = 'feedback.name' size = '50'/><br/>
                    Email: &nbsp;<input type = 'text' name = 'feedback.email' id = 'feedback.email' size = '50'/><br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <textarea id='feedback.message' rows="8" cols="40"></textarea><br/>
                    <input type = 'submit' value = 'Send Feedback' onclick = "submitFeedback(); hideElement('feedbackFormDiv');"/>
                    <input type = 'button' value = 'Cancel' onclick = "hideElement('feedbackFormDiv');hideElement('requestTrafficForm');hideElement('BerlinMODParams');hideElement('BerlinMODSubmit');"/>
                </form>
            </div>


            <div class = 'popup alignCenter' style = 'display: none; width: 500px;alignment-adjust: central' id = 'HelpDiv'>
                <p align="center"><h2>General Instructions</h2></p><br/>
                <lu>
                    <li><p align="left"><span style="font-weight:normal;">First go to the area in US, where you want the traffic data.</span></p></li>
                    <li><p align="left"><span style="font-weight:normal;">Left click the mouse on the map to place a marker on the map.</span></p></li>
                    <li><p align="left"><span style="font-weight:normal;">The area defined by the two markers is the traffic generation area.</span></p></li>
                    <li><p align="left"><span style="font-weight:normal;">Select the traffic model and click "Generate".</span></p></li>
                    <li><p align="left"><span style="font-weight:normal;">That's it! Thanks.</span></p></li>
                </lu>
                <br>
                <input type = 'button' value = 'OK' onclick = "hideElement('HelpDiv');hideElement('requestTrafficForm');hideElement('BerlinMOD');hideElement('Brinkhoff');"/>
            </div>

            <div class = "center alignCenter" style="width:60%">
                <hr>
                <font size="5"> <a href="/traffic_requests/upload_traffic/">Visualize Traffic From File</a></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="5"><a href="javascript:void(0)" onclick="showElement('feedbackFormDiv')">Send Feedback</a></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="5"><a href="http://mntg.cs.umn.edu/about_help.html">About</a></font>
            </div>
            <br/>
            <script type = "text/javascript">
                initializeMap();

                map.bounds_changed = clearResult;


                function clearResult() {
                    document.getElementById('response').innerHTML = '';
                }

            </script>
<div id="clustrmaps-widget"  align="center"></div><script type="text/javascript">var _clustrmaps = {'url' : 'http://mntg.cs.umn.edu', 'user' : 1087292, 'server' : '2', 'id' : 'clustrmaps-widget', 'version' : 1, 'date' : '2013-04-01', 'lang' : 'en', 'corners' : 'square' };(function (){ var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = 'http://www2.clustrmaps.com/counter/map.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);})();</script><noscript><a href="http://www2.clustrmaps.com/user/69210973c"><img src="http://www2.clustrmaps.com/stats/maps-no_clusters/mntg.cs.umn.edu-thumb.jpg" alt="Locations of visitors to this page" /></a></noscript>
