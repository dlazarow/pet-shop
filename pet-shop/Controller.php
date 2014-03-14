<?php
try
{
	if ($_GET["req"]=="Table")
	{
		header("Location: Helpers/GroomingTable.php");
	}
	elseif ($_GET["req"]=="Login")
	{
		header("Location: Helpers/Login.php?username=" . $_POST['username'] . "&password=" . $_POST['password']);
	}
	elseif ($_GET["req"]=="LoggedIn")
	{
		header("Location: Helpers/LoggedIn.php");
	}
	elseif ($_GET["req"]=="Logout")
	{
		header("Location: Helpers/Logout.php");
	}
	else //LoginForm
	{
		include("Helpers/LoginForm.html");
	}
}
catch(Exception $e)
{
	echo "failed: " . $e->getMessage();
}
?>
