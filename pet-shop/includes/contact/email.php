<?php

$firstname = $_POST['FirstName'];
$lastname = $_POST['LastName'];
$email = $_POST['Email'];
$message = $_POST['Message'];
$name = "$firstname $lastname";

$site_owners_name = "Dan Lazarow";
$site_owners_email = "dan@danimation-inc.com";
$error=NULL;

if (strlen($firstname) < 2) {
	$error['firstname'] = "Please enter your first name";
}

if (strlen($lastname) < 2) {
	$error['lastname'] = "Please enter your last name";
}

if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/", $email)){ 
//if (!preg_match('/^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/',$email)){
   	$error['email'] = "Please enter a valid email address";
}

if (strlen($message) <3) {
	$error['message'] = "Please leave a message.";
}

if (!$error) {
	require_once('class.phpmailer.php');
	$mail = new PHPMailer();

	$mail->From = $email;
	$mail->FromName = $name;
	$mail->Subject = "Web Contact Form";
	$mail->AddAddress("dlazarow@hotmail.com", "Dan Lazarow");
	$mail->AddAddress($site_owners_email, $site_owners_name);
	$mail->Body = $message;
	
	//GMAIL STUFF
	
	$mail->Mailer = "smtp";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->SMTPSecure = "tls";
	
	$mail->SMTPAuth = true;
	$mail->Username = "dlazarowdevtest@gmail.com";
	$mail->Password = "passwordDev";
	
	$mail->Send();
	

    $responseY = "<span class='success'> Thank you " . $firstname . ", for your email!  We will get back with you shortly.</span>";
	echo $responseY;
	} // end if no error
	else {
		
		$responseF = (isset($error['firstname'])) ? "<li>" . $error['firstname'] . "</li> \n" : null;
		$responseF .= (isset($error['lastname'])) ? "<li>" . $error['lastname'] . "</li> \n" : null;	
		$responseF .= (isset($error['email'])) ? "<li>" . $error['email'] . "</li> \n" : null;
		$responseF .= (isset($error['message'])) ? "<li>" . $error['message'] . "</li> \n" : null;
			
		echo $responseF;
		} //end if an error occured
?>