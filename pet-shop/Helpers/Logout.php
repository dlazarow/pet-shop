<?php
	try
	{
		session_start();
		session_unset() ;
		echo "success";
	}
	catch(Exception $e)
	{
		echo "failed: " . $e->getMessage();
	}
?>
