<?php
	//sanitize $dbEntries
	$dbEntries = $_POST;
	foreach ($dbEntries as &$entry)
	{
		$entry = dbString($entry);
	}
	
	//validation of entries, then adding to $browserEntries
	
	if (!checkLength($_POST['FirstName']))
	{
		$errors['FirstName'] = 'First name omitted.';
	}
	else
	{
		$browserEntries['FirstName'] = browserString($_POST['FirstName']);
	}

	if (!checkLength($_POST['LastName']))
	{
		$errors['LastName'] = 'Last name omitted.';
	}
	else
	{
		$browserEntries['LastName'] = browserString($_POST['LastName']);
	}

	if (!checkLength($_POST['Address'],5,200))
	{
		$errors['Address'] = 'Address omitted.';
	}
	else
	{
		$browserEntries['Address'] = browserString($_POST['Address']);
	}

	if (!checkLength($_POST['City'],1,100))
	{
		$errors['City'] = 'City omitted.';
	}
	else
	{
		$browserEntries['City'] = browserString($_POST['City']);
	}

	if (!checkLength($_POST['State'],2,2) && !checkLength($_POST['State'],0,0))
	{
		$errors['State'] = 'State name must be two characters.';
	}
	else
	{
		$browserEntries['State'] = browserString($_POST['State']);
	}

	if (!checkLength($_POST['Zip']))
	{
		$errors['Zip'] = 'Zip Code omitted.';
	}
	else
	{
		$browserEntries['Zip'] = browserString($_POST['Zip']);
	}

	if (!checkLength($_POST['PhoneNumber'],10,15))
	{
		$errors['PhoneNumber'] = 'Home phone must be between 10 and 15 characters.';
	}
	else
	{
		$browserEntries['PhoneNumber'] = browserString($_POST['PhoneNumber']);
	}


	if ( !checkEmail($_POST['Email']) )
	{
		$errors['Email'] = 'Email is invalid.';
	}
	else
	{
		$browserEntries['Email'] = browserString($_POST['Email']);
	}
	
	if (!checkLength($_POST['PetType']))
	{
		$errors['PetType'] = 'Pet Type omitted.';
	}
	else
	{
		$browserEntries['PetType'] = browserString($_POST['PetType']);
	}
	
	
	if (!checkLength($_POST['Breed']))
	{
		$errors['Breed'] = 'Breed omitted.';
	}
	else
	{
		$browserEntries['Breed'] = browserString($_POST['Breed']);
	}
	
	if (!checkLength($_POST['PetName']))
	{
		$errors['PetName'] = 'Pet Name omitted.';
	}
	else
	{
		$browserEntries['PetName'] = browserString($_POST['PetName']);
	}

	//ensure checkbox passes a value of 1 or 0
	if (isset($_POST['NeuteredOrSpayed'])) $NeuteredOrSpayed='1'; else $NeuteredOrSpayed='0';
	$browserEntries['NeuteredOrSpayed'] = $NeuteredOrSpayed;
	$dbEntries['NeuteredOrSpayed'] = $NeuteredOrSpayed;


	if (!checkdate($_POST['BirthMonth'],$_POST['BirthDay'],$_POST['BirthYear']))
	{
		$errors['PetBirthday'] = 'Birth date is not a valid date.';
	}
	else
	{
		//create a human-readable birthday for confirmation display
		$month = monthAsString(browserString($_POST['BirthMonth']));
		$day = browserString($_POST['BirthDay']);
		$year = browserString($_POST['BirthYear']);
		$browserEntries['PetBirthday'] = "$year-$month-$day";
		
	}

?>
<?php
	if (!count($errors) && array_key_exists('GroomingID',$_POST))
	{
		$groomingID = $_POST['GroomingID'];
		$query = "UPDATE grooming
				SET FirstName='" . $dbEntries['FirstName'] . "',
				LastName='" . $dbEntries['LastName'] . "',
				Address='" . $dbEntries['Address'] . "',
				City='" . $dbEntries['City'] . "',
				State='" . $dbEntries['State'] . "',
				Zip='" . $dbEntries['Zip'] . "',
				PhoneNumber='" . $dbEntries['PhoneNumber'] . "',
				Email='" . $dbEntries['Email'] . "',
				PetType='" . $dbEntries['PetType'] . "',
				Breed='" . $dbEntries['Breed'] . "',
				PetName='" . $dbEntries['PetName'] . "',
				NeuteredOrSpayed='" . $NeuteredOrSpayed . "',
				PetBirthday='" . $dbEntries['BirthYear'] . '-' .
					 $dbEntries['BirthMonth'] . '-' .
					 $dbEntries['BirthDay'] . "'";
				$query .= " WHERE GroomingID = $groomingID";

		if ($db->query($query))
		{
			$showForm = false;
			echo '<div align="center">
			<span>Grooming Request Successfully Updated</span><br>
			<a href="Index.php">Home</a></div>';
				$showForm = false;
		}
		else
		{
			echo '<div align="center">Update Failed</div>';
		}
	}
	elseif (!count($errors))
	{
		//turn off the form and display the user entries for confirmation
		$showForm = false;
?>	
	<form method="post" action="AddGrooming.php" id="grooming">
	<input type="hidden" name="Confirmed" value="true">
	<?php
		echo '<h2>Confirm Entries</h2>';
		echo '<ol>';
		foreach ($browserEntries as $key=>$value)
		{
			echo "<li><b>$key:</b> $value</li>";
		}
		echo "</ol>";
		unset($dbEntries['Submitted']);
		foreach ($dbEntries as $key=>$param)
		{
	?>
    		<input type="hidden" name="<?php echo $key ?>"
			value="<?php echo $param ?>">
	<?php
		}
	?>
		<input type="submit" value="Confirm">
	</form>
<?php
	}
	else
	{
		$dbEntries = $_POST;
	}
?>