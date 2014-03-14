<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css">

<title>Sandy's Pet Shop</title>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/JSValidation.js"></script>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript">

function onSubmitFunc(){
	    var firstname = $('input#firstname').val();
		var lastname = $('input#lastname').val();
        var email = $('input#email').val();
        var message = $('textarea#message').val();
		var errors = [];
	
	if (!reProperName.test(firstname)) {
		errors[errors.length] = "You must enter a valid first name.";
	}

	if (!reProperName.test(lastname)) {
		errors[errors.length] = "You must enter a valid last name.";
	}

	if (!reEmail.test(email)) {
		errors[errors.length] = "You must enter a valid email address.";
	}
	
	if (checkTextArea(message,1000)) {
		errors[errors.length] = "Your message is too long.  It must be less than 100 characters.";
	}

	if (errors.length > 0) {
		reportErrors(errors);
		return false;
	}
	postEmail();		
}


function postEmail(){
		var firstname = $('input#firstname').val();
		var lastname = $('input#lastname').val();
        var email = $('input#email').val();
        var message = $('textarea#message').val();
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		
			
		xmlhttp.open("POST", "includes/contact/email.php/", false);
		xmlhttp.onreadystatechange=postResponse;
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		xmlhttp.send("FirstName="+firstname+"&LastName="+lastname+"&Email="+email+"&Message="+message);
		
		 function postResponse(){
		 	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var contentDiv = document.getElementById("Content");
			if(xmlhttp.responseText.indexOf("Failed")==0){
				contentDiv.className = "Warning";
				contentDiv.innerHTML=xmlhttp.responseText;
				//	alert(xmlhttp.responseText);
				} else {
					contentDiv.className = "Sent";
					contentDiv.innerHTML=xmlhttp.responseText;
					//alert(xmlhttp.responseText);
					}
				 }
			 }
	}

observeEvent(window,"load",function() {
	var btn=document.getElementById("submit");
	observeEvent(btn,"click",onSubmit);
});

function reportErrors(errors){
	var msg = "There were some problems...\n";
	for (var i = 0; i<errors.length; i++) {
		var numError = i + 1;
		msg += "\n" + numError + ". " + errors[i];
	}
	alert(msg);
}
</script>
</head>
<body>
<div id="wrap">
<?php
require 'includes/header.php';
?>
    <div id="main">
         <div>
        	<form method="post" id="contactForm" name="contactForm" autocomplete="on" onsubmit="return false" action="">
            	<fieldset>
      		 		<legend>Contact Form</legend>
                         <table width="350" border="0" align="center" cellpadding="4" cellspacing="0">
                          <tr> 
                            <td><label>Your First Name:</label></td>
                            <td><input type="text" name="firstname" id="firstname" style="width:100%" /></td>
                          </tr>
                          <tr> 
                            <td><label>Your Last Name:</label></td>
                            <td><input type="text" name="lastname" id="lastname" style="width:100%" /></td>
                          </tr>
                          <tr> 
                            <td><label>Your Email:</label></td>
                            <td><input type="text" name="email" id="email" style="width:100%" /></td>
                          </tr>
                          <tr> 
                            <td colspan="2">
                                <label>Your Message:</label><br /><br />
                                <textarea name="message" style="width:100%;height:160px" id="message"></textarea>
                            </td>
                          </tr>
                          <tr align="center"> 
                            <td colspan="2"><input type="submit" name="submit" value="Contact Us!" id="submit" onclick="onSubmitFunc();"></td>
                          </tr>
                        </table>
                        <div align="center" id="Content"></div>
   				</fieldset>
            </form>	
         </div>                  
     
     <div class="push" />
</div>
<?php
require 'includes/footer.php';
?>
</body>

</html>
