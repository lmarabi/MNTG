/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

            function doStart(){
                if (fname.value == '')
                    document.getElementById("begin").innerHTML="Enter start point"
                else if(tname.value == '')
                    document.getElementById("begin").innerHTML="Enter end point"
                else doEnd();
            }
            function doEnd(){
                if (fname.value == '')
                    document.getElementById("begin").innerHTML="Enter start point"
                else if(tname.value != '')
                    document.getElementById("begin").innerHTML="Calculating!"
                
                else doStart();
            }
            function doTrans(mean){
                document.getElementById("choice").innerHTML="Lets go "+ mean+"!" 
            }
            function doErase(field){
                var a = document.getElementById(field);
                a.value = '';
                if (field == 'fname')
                    document.getElementById("begin").innerHTML="Enter start point"
                else
                    document.getElementById("begin").innerHTML="Enter end point"
                
            }