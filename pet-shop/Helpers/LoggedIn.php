<?php
	session_start();
	if ( isset($_SESSION["User"]) )
	{
		try
		{
			$connect = odbc_connect("pet_shop","","");
			$sql = "SELECT FirstName, LastName FROM admins WHERE idAdmin=" . $_SESSION["User"];
			$rs = odbc_exec($connect,$sql);
			
			$row = odbc_fetch_array($rs);
		
			if ($row)
			{
				echo $row["FirstName"] . " " . $row["LastName"];
			}
			else
			{
				echo "failed";
			}
		}
		catch(Exception $e)
		{
			echo "failed: " . $e->getMessage();
		}
	}
	else
	{
		echo "failed: not logged in";
	}
?>
