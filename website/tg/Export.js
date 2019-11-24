/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function exportForm() {
    if (boxCoords === null) {
        alert('No area has been chosen!');
        return;
    }
    var coords = new Array();
    coords = document.getElementById("boxC").value.split(',');
    var latmax = coords[0];
    var latmin = coords[1];
    var lonmax = coords[2];
    var lonmin = coords[3];
    var area = ((lonmax-lonmin)*(lonmax-lonmin));
    if(area > 497.0005035400418){
        //previous area city level  0.10862946510447023
    	alert("area selected is larg kindly select a smaller area!");
        return;
    }
    //Get all the elements from the form 
    var e = document.getElementById("type");
    var type = e.options[e.selectedIndex].text;
    var rName = document.getElementById("TrafficRequest.name").value;
    if (rName === '') {
        alert('Name filed is empty');
        return;
    }
    
   var tempString = rName;
   rName = tempString+" " +type;
    
    if(document.getElementById("additionalFilesBrinkhoff").checked){
		rName =  document.getElementById("TrafficRequest.name").value+" "+type+"@@";
    }

    var rEmail = document.getElementById("TrafficRequest.email").value;
    if (rEmail === '') {
        alert('Email filed is empty');
        return;
    }
    var maxTime;
    var objBegin;
	 var maxTim;
	 var objPerTime;
	 var extObjBegin;
	 var msd;
	 var extObjPerTime;
	 var numObjClasses;
    var numExtObjClasses;
    //check the element of each form 
   if(type === 'BerlinMOD'){
    		var scaleFactor = document.getElementById("TrafficRequest.scaleFactor").value;
    		if (scaleFactor === '') {alert('Number of Vehicles (1-2000) filed is empty');return;}
			if(isNaN(scaleFactor)){alert('Number of Vehicles (1-2000) must be a numeric');return;}
			if(scaleFactor > 2000 || scaleFactor < 1){alert('Number of Vehicles (1-2000) must be a numeric');return;}
    	//}else if(type === 'Brinkhoff'){
		//alert('Sorry of the inconvenience we cause,but Brinkhoff is under maintenance now');
		//return;
	}else if(type === 'Random'){
	 	objBegin = document.getElementById("TrafficRequest.objBegin.random").value;
    	if (objBegin === '') {alert('Starting Vehicles filed is empty');return;}
    	if(isNaN(objBegin)){alert('Starting Vehicles must be a numeric');return;}
    	if(objBegin > 5000 || objBegin < 1){alert('Starting Vehicles must be between 1-5000');return;}
    	maxTime = document.getElementById("TrafficRequest.maxTime.random").value;
    	if (maxTime === '') {alert('Simulation Time filed is empty');return;}
    	if(isNaN(maxTime)){alert('Simulation Time must be a numeric');return;}
    	if(maxTime < 20 || maxTime > 1000){alert('Simulation Time must be between 20-1000 time unite');return;}
        objPerTime=5;
	 	}else { 
	 	// if the Traffic requested is Brinkhoff
	 		
	 	objBegin = document.getElementById("TrafficRequest.objBegin").value;
    	if (objBegin === '') {alert('Starting Vehicles filed is empty');return;}
    	if(isNaN(objBegin)){alert('Starting Vehicles must be a numeric');return;}
    	if(objBegin > 5000 || objBegin < 1){alert('Starting Vehicles must be between 1-5000');return;}
    	maxTime = document.getElementById("TrafficRequest.maxTime").value;
    	if (maxTime === '') {alert('Simulation Time filed is empty');return;}
    	if(isNaN(maxTime)){alert('Simulation Time must be a numeric');return;}
    	if(maxTime < 20 || maxTime > 1000){alert('Simulation Time must be between 20-1000 time unite');return;}
      objPerTime = document.getElementById("TrafficRequest.objPerTime").value;
    	if(objPerTime === ''){alert('Added Vehicles each Time Unit filed is empty');return;}
      if(isNaN(objPerTime)){alert('Added Vehicles each Time Unit must be a numeric');return;}
      if(objPerTime > 2000 || objPerTime < 1){alert('Added Vehicles each time unite must be between 1-2000 ');return;}	
    		 
	 }
    	
    	extObjBegin = document.getElementById("TrafficRequest.extObjBegin").value;
    	if (extObjBegin === '') {alert('extObjBegin filed is empty');return;}
      if(isNaN(extObjBegin)){alert('extObjBegin must be a numeric');return;}
    	
    	msd = document.getElementById("TrafficRequest.msd").value;
    	if (msd === '') {alert('msd filed is empty');return;}
      if(isNaN(msd)){alert('msd must be a numeric');return;}
  
    	extObjPerTime = document.getElementById("TrafficRequest.extObjPerTime").value;
		if (extObjPerTime === '') {alert('extObjPerTime filed is empty');return;}
	   if(isNaN(extObjPerTime)){alert('extObjPerTime must be a numeric');return;}

    	numObjClasses = document.getElementById("TrafficRequest.numObjClasses").value;
		if (numObjClasses === '') {alert('numObjClasses filed is empty');return;}
	   if(isNaN(numObjClasses)){alert('numObjClasses must be a numeric');return;}

    	numExtObjClasses = document.getElementById("TrafficRequest.numExtObjClasses").value;
    	if (numExtObjClasses === '') {alert('numExtObjClasses filed is empty');return;}
      if(isNaN(numExtObjClasses)){alert('numExtObjClasses must be a numeric');return;}


    
    //alert("Simulation Time: "+maxTime+" Starting vehicles: "+objBegin+" vehicle/time: "+objPerTime)
    
    request = new XMLHttpRequest();
    request.onreadystatechange = respond_export;
    request.open("POST", "control.php", true /* asynchronous? */)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    request.send("action=coords&coords=" + document.getElementById("boxC").value +
            "&type=" + type+
            "&rName=" + rName +
            "&rEmail=" + rEmail +
            "&scaleFactor=" + scaleFactor +
            "&objBegin=" + objBegin +
            "&maxTime=" + maxTime +
            "&objPerTime=" + objPerTime  +
            "&extObjBegin=" + extObjBegin +
            "&msd=" + msd +
            "&extObjPerTime=" + extObjPerTime +
            "&numObjClasses=" + numObjClasses +
            "&numExtObjClasses=" + numExtObjClasses            
            );
  
    alert("your request has been received thank you")
}

function respond_export() {


}


