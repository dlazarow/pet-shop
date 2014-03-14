<?php
	session_start();
	try
	{
		$connect = odbc_connect("pet_shop","","");

		$sql = "SELECT idAdmin, FirstName, LastName FROM admins
				WHERE Username='" . $_GET["username"] . "' AND Password = '" . $_GET["password"] . "'";
				
		$rs = odbc_exec($connect,$sql);
		
		$row = odbc_fetch_array($rs);
		
		if ($row)
		{
			$_SESSION["User"] = $row["idAdmin"];
			echo $row["FirstName"] . ' ' . $row["LastName"];		}
		else
		{
			echo "failed";
		}
	}
	catch(Exception $e)
	{
		echo "failed: " . $e->getMessage();
	}
?>
