/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var object, timestamp, disc, lat, lon;

function Importer() {
		pathlocs = new Array();
		var file = document.getElementById('Nodes').files[0];
		if (!file) {
			alert("Missing Traffic file!")
			return;
				}
				var reader = new FileReader();
				var array; // represent the number of rows in the file.
				var j = 1;
				object = new Array(); // represent the object 
				timestamp = new Array(); // represent the time stamp 
				disc = new Array(); // represent the type whether it it is a newpoint or point 
				var Nodes = new Array(); // represent the geometry of the object in OpenLaysers library.
				var lonLat = new Array();
				lon = new Array();
				lat = new Array();
				var from = 2;
				var to = 2;
				var start = new Array();
				var end = new Array();
				//alert("finish init var before onload reader...");
				reader.onload = function(e) {
					//alert("Enter on load");
							array = e.target.result.split('\n');
        	var t;
        	var longlat = /[0-9]+\.*[0-9]*/;
        	for (var i = 2; i < array.length; i++) {
            		t = array[i].split(' ')
            		if (array[i] == '')
                		break;
			// the format of the file 
			//Object_Id Timestamp Type Lat Lng
		 //0  1    2            3                4
		//20 0 newpoint 44.9439690012843 -93.1733220262528
            if (isNaN(t[0]) || isNaN(t[1])
                    || !longlat.test(t[3]) || isNaN(t[3])
                    || !longlat.test(t[4]) || isNaN(t[4])) {
                alert("Error in Traffic file!")
                return;
            }
            lonLat[i] = new OpenLayers.LonLat(t[4], t[3])
													.transform(new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
           			 map.getProjectionObject() // to Spherical Mercator Projection
          				);
            
            lon[i] = t[4];
            lat[i] = t[3];
            object[i] = t[0]; // insert the object. 
            timestamp[i] = t[1]; // insert the time stamp of each row
            disc[i] = t[2]; // insert the type here 
            // the following code for inserting the node geometry. 
/*	               if(timestamp[i] == j){
            		from = to+1;
            		to  = i;
												start[j] = from;
												end[j] = to;
												j++;
			 								addCar(objects,time,types,latt,lonn,from,to);
                 	} 
*/
            
        }
        //alert("Start drawing");
        addCar(2);
	//alert("Finished!");

	};//end reader onload
	reader.readAsText(file);
}//end Importer function



