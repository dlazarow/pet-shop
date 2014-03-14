<?php
/********** STRING FUNCTIONS *********/
/*
	Function Name: browserString
	Arguments: $string
	Returns:
		trimmed and escaped string for browser output
*/
function browserString($string)
{
	return nl2br(trim(htmlentities($string)));
}

/*
	Function Name: dbString
	Arguments: $string
	Returns:
		trimmed and escaped string for database entry
*/
function dbString($string)
{
	$string=trim($string);
	if (get_magic_quotes_gpc())
	{
		return $string;
	}
	else
	{
		return addslashes($string);
	}
}
?>
