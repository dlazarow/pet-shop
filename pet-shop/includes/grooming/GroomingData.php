<?php
	$groomingID = $_POST['GroomingID'];

	$query = "SELECT FirstName, LastName, 		
			Address, City, State, Zip, PhoneNumber,
			Email, PetType, Breed, PetName, NeuteredOrSpayed,
			MONTH(PetBirthDay) AS BirthMonth,
			DAYOFMONTH(PetBirthDay) AS BirthDay,
			YEAR(PetBirthDay) AS BirthYear
			FROM grooming
			WHERE GroomingID = $groomingID";
	$result = $db->query($query);
	$dbEntries = $result->fetch_assoc();
						
	$result->free();
?>
