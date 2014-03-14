<?php
	$dbEntries = $_POST;
	foreach ($dbEntries as &$entry)
	{
		$entry = dbString($entry);
	echo "$entry '<br>'";
	}

	@$db = new mysqli('localhost','groomer','Admin01','pet_shop');
	if (mysqli_connect_errno())
	{
		echo 'Cannot connect to database: ' . mysqli_connect_error();
	}
	$query = "INSERT INTO grooming
		(FirstName, LastName, Address, City, State, Zip, PhoneNumber, Email, PetType, Breed, PetName, NeuteredOrSpayed, PetBirthday)
		VALUES ('" .	$dbEntries['FirstName'] . "','" .
						$dbEntries['LastName'] . "','" .
						$dbEntries['Address'] . "','" .
						$dbEntries['City'] . "','" .
						$dbEntries['State'] . "','" .
						$dbEntries['Zip'] . "','" .
						$dbEntries['PhoneNumber'] . "','" .
						$dbEntries['Email'] . "','" .
						$dbEntries['PetType'] . "','" .
						$dbEntries['Breed'] . "','" .
						$dbEntries['PetName'] . "','" .
						$dbEntries['NeuteredOrSpayed'] . "','" .
						$dbEntries['BirthYear'] . "-" .
					 		$dbEntries['BirthMonth'] . "-" .
					 		$dbEntries['BirthDay'] . "')";
								
	if ($db->query($query))
	{
		echo '<div align="center">
			<span>Grooming Request Successfully Submitted</span><br>
			<a href="AddGrooming.php">Back to Grooming Request Form</a></div>';
				$showForm = false;
	}
	else
	{
		echo '<div align="center">Insert failed</div>';
	}
?>
