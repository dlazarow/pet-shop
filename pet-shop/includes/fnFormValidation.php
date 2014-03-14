<?php
/********* FORM VALIDATION FUNCTIONS *********/

/*
	Function Name: checkLength
	Arguments: $text,$min?,$max?,$trim?
	Returns:
		false if $text has fewer than $min characters
		false if $text has more than $max characters
		true otherwise
*/
function checkLength($text,$min=1,$max=10000,$trim=true)
{
	if ($trim)
	{
		$text = trim($text);
	}
	if (strlen($text) < $min || strlen($text) > $max)
	{
		return false;
	}
	return true;
}

/*
	Function Name: checkEmail
	Arguments: $email
	Returns:
		false if $email has fewer than 6 characters
		false if $email does not contain @ symbol
		false if $email does not contain a period (.)
		false if the last @ symbol comes after the last period (.)
		true otherwise
*/
function checkEmail($email)
{
	$email = trim($email);
	if (!checkLength($email,6))
	{
		return false;
	}
	elseif (!strpos($email,'@'))
	{
		return false;
	}
	elseif (!strpos($email,'.'))
	{
		return false;
	}
	elseif (strrpos($email,'.') < strrpos($email,'@'))
	{
		return false;
	}
	return true;
}

/*
	Function Name: checkPassword
	Arguments: $pw1,$pw2,$checkLength?
	Returns:
		false if $pw1 has fewer than 6 characters
		false if $pw1 has more than 12 characters
		false if $pw1 and $pw2 do not match
		true otherwise
*/
function checkPassword($pw1,$pw2,$checkLen=true)
{
	$pw1 = trim($pw1);
	$pw2 = trim($pw2);
	if ($checkLen)
	{
		return checkLength($pw1,6,12) && strcmp($pw1,$pw2) == 0;
	}
	else
	{
		return strcmp($pw1,$pw2) == 0;
	}
}
?>
