<?php
	require 'Includes/fnFormValidation.php';
	require 'Includes/fnFormPresentation.php';
	require 'Includes/fnStrings.php';
	require 'Includes/fnDates.php';
	require 'Includes/init.php';
	require "Includes/config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css">
<title>Sandy's Admin</title>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/inline-editing.js"></script>
<script type="text/javascript">
var adminConfig = {
		userName : null,
		autoLogoutTimer: null
	}
	
	function startApp() {	
		var loggedInDiv = document.getElementById("LoggedInDiv");
		var logOutDiv = document.getElementById("LogoutDiv");
		loggedInDiv.innerHTML = "Logged in as " + adminConfig.userName;
		loggedInDiv.style.display="block";
		logOutDiv.style.display="block";
		showGrooming();
		startAutoLogoutTimer();
		observeEvent(document.body,"click",startAutoLogoutTimer);
	}
	
	function endApp() {
		var loggedInDiv = document.getElementById("LoggedInDiv");
		var logOutDiv = document.getElementById("LogoutDiv");
		clearTimeout(adminConfig.autoLogoutTimer);
		adminConfig.userName=null;
		loggedInDiv.innerHTML = "";
		loggedInDiv.style.display="none";
		logOutDiv.style.display="none";
		loginForm();
		unObserveEvent(document.body,"click",startAutoLogoutTimer);
	}
	
	function showGrooming() {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","Controller.php?req=Table",true);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				results(xmlhttp);	
			}
		}
		xmlhttp.send(null);
		
		function results(xmlhttp) {
			var output = document.getElementById("Output");
			output.innerHTML = xmlhttp.responseText;
			enableEditing();
		}
	}
	
	function loginForm() {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","Controller.php?req=LoginForm",true);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				results(xmlhttp);	
			}
		}
		xmlhttp.send(null);
	
		function results(xmlhttp) {
			var output = document.getElementById("Output");
			var loginForm;
			output.innerHTML = xmlhttp.responseText;
			loginForm = document.getElementById("LoginForm");
			loginForm.onsubmit = function() {
				login(loginForm.Username.value,loginForm.Password.value);
				return false;
			}
		}
	}

	function login(un,pw) {
		var params="username=" + un + "&password=" + pw;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST","Controller.php?req=Login",true);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				results(xmlhttp);					
			} 
		}
		
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		xmlhttp.send(params);
	
		function results(xmlhttp) {
			if (xmlhttp.responseText.indexOf("failed") == -1) {
				adminConfig.userName = xmlhttp.responseText;
				startApp();
			} else {
				var badLogin = document.getElementById("BadLogin"); 
				var userName = document.getElementById("Username"); 
				badLogin.style.display="block";
				userName.select();
				userName.className="Highlighted";
				setTimeout(function() {document.getElementById('BadLogin').style.display='none'; },5000);
			}
		}
	}

	function startAutoLogoutTimer() {
		var sessionTime = 600 * 1000; //600 seconds
		clearTimeout(adminConfig.autoLogoutTimer);
		adminConfig.autoLogoutTimer = setTimeout(function() { logout(true); }, sessionTime);
	}


	function logout(auto) {
		var xmlhttp = new XMLHttpRequest();
		document.getElementById("Output").innerHTML = "";
		xmlhttp.open("GET","Controller.php?req=Logout",true);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				results(xmlhttp);	
			}
		}
		xmlhttp.send(null);
	
		function results(xmlhttp) {
			endApp();
			if (auto) {
				alert("You have been logged out due to inactivity.");
			}
		}
	}
	
	function checkLogin() {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","Controller.php?req=LoggedIn",true);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				results(xmlhttp);	
			}
		}
		xmlhttp.send(null);
	
		function results(xmlhttp) {
			if (xmlhttp.responseText.indexOf("failed") == -1) {
				adminConfig.userName = xmlhttp.responseText;
				startApp();
			} else {
				loginForm();
			}
		}
	}

	observeEvent(window,"load",function() {
		var btnLogout = document.getElementById("logout");
		observeEvent(btnLogout,"click",function() {
			logout(false);
		});
		checkLogin();
	});
</script>
</head>
<body>
<div id="wrap">
	<?php
    require 'includes/header.php';
    ?>
    <div id="main">
        <div id="LogoutDiv">
            <button id="logout">Logout</button>
        </div>
        <div id="LoggedInDiv"></div>
        <div id="Output">One moment please...</div>
    </div>  
    <div class="push"></div>
</div>
<?php
require 'includes/footer.php';
?>
</body>

</html>
