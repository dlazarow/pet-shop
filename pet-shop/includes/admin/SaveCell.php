<?php
	@$db = new mysqli('localhost','groomer','Admin01','pet_shop');
			if (mysqli_connect_errno())
			{
				echo 'Cannot connect to database: ' . mysqli_connect_error();
			}
			else
			{
	
		$field = $_POST["field"];
		$value = stripslashes($_POST["value"]);
		$grmID = $_POST["pid"];
		$sql= "UPDATE grooming SET " . $field . " = '" . $value . "' WHERE GroomingID = " . $grmID;
		if ($db->query($sql))
		{
			echo 'success';
		}
		else
		{
			echo 'Update Failed';
		}
	
	}
?>
