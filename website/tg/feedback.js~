/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function FeedbackForm() {
    var rName = document.getElementById("feedback.name").value;
    if (rName === '') {
        alert('Name filed is empty');
        return;
    }
    var rEmail = document.getElementById("feedback.email").value;
    if (rEmail === '') {
        alert('Email filed is empty');
        return;
    } 
   var message = document.getElementById("feedback.message").value;
    if (message === '') {
        alert('message filed is empty');
        return;
    } 
    
    request = new XMLHttpRequest();
    request.onreadystatechange = respond_export;
    request.open("POST", "feedback.php", true /* asynchronous? */)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    request.send("action=feedback" +"&rName=" + rName +"&rEmail=" + rEmail + "&message=" + message);
  
    alert("your Feedback has been received thank you")
}

function respond_export() {


}


