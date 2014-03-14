<?php
/********* DATE FUNCTIONS *********/

/*
	Function Name: monthAsString
	Arguments: $m
	Returns:
		month as string
*/
function monthAsString($m)
{
	$months = array();
	$months[] = 'January';
	$months[] = 'February';
	$months[] = 'March';
	$months[] = 'April';
	$months[] = 'May';
	$months[] = 'June';
	$months[] = 'July';
	$months[] = 'August';
	$months[] = 'September';
	$months[] = 'October';
	$months[] = 'November';
	$months[] = 'December';
	
	return $months[$m-1];
}
?>
