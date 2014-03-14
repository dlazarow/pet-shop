<?php
/********* FORM PRESENTATION FUNCTIONS *********/

/*
	Function Name: textEntry
	Arguments: $display,$name,$entries,$errors,$size?
	Returns:
		one list item as string
*/
function textEntry($display,$name,$entries,$errors,$size=15)
{
	$returnVal = "
        <li>
			<label for='$name'>$display: </label>
			<input type='text' name='$name' id='$name' value='" . browserString($entries[$name]) . "' required>";
			
		 if (array_key_exists($name,$errors))
		{
			$returnVal .= '<span class="Error" style="white-space:nowrap">* ' .
					$errors[$name] .
				'</span>';
		}
	
	$returnVal .='</li>';
	return $returnVal;
}


/*
	Function Name: unReqTextEntry
	Arguments: $display,$name,$entries,$errors,$size?
	Returns:
		one list item as string
*/
function unReqTextEntry($display,$name,$entries,$errors,$size=15)
{
	$returnVal = "
        <li>
			<label for='$name'>$display: </label>
			<input type='text' name='$name' id='$name' value='" . browserString($entries[$name]) . "'>";
			
		 if (array_key_exists($name,$errors))
		{
			$returnVal .= '<span class="Error" style="white-space:nowrap">* ' .
					$errors[$name] .
				'</span>';
		}
	
	$returnVal .='</li>';
	return $returnVal;
}

/*
	Function Name: emailEntry
	Arguments: $display,$name,$entries,$errors,$size?
	Returns:
		list item with an html5 email input as string
*/	
function emailEntry($display,$name,$entries,$errors,$size=15)
{
	$returnVal = "

            <li>              
                 <label for='$name'>$display: </label>
                 <input type='email' name='$name' id='$name' value='" . browserString($entries[$name]) . "'>";
				 				 
		if (array_key_exists($name,$errors))
		{
			$returnVal .= '<span class="Error" style="white-space:nowrap">* ' .
					$errors[$name] .
				'</span>';
		}
	
	$returnVal .='</li>';
	return $returnVal;
}


/*
	Function Name: phoneEntry
	Arguments: $display,$name,$entries,$errors,$size?
	Returns:
		one list item with an html5 tel input as string
*/
function phoneEntry($display,$name,$entries,$errors,$size=15)
{
	$returnVal = "

            <li>              
                 <label for='$name'>$display: </label>
                 <input type='tel' name='$name' id='$name' value='" . browserString($entries[$name]) . "' required>";
				 
		if (array_key_exists($name,$errors))
		{
			$returnVal .= '<span class="Error" style="white-space:nowrap">* ' .
					$errors[$name] .
				'</span>';
		}
	
	$returnVal .='</li>';
	return $returnVal;
}
  
 /*
	Function Name: checkboxEntry
	Arguments:$display,$name,$entries,$errors,$size?
	Returns:
		list item with an html5 checkbox as string
*/ 
 function checkboxEntry($display,$name,$entries,$errors,$size=15)
{
	$returnVal = "

            <li>              
                 <label for='$name'>$display: </label>
                 <input type='checkbox' name='$name' id='$name'>";
				 
		if (array_key_exists($name,$errors))
		{
			$returnVal .= '<span class="Error" style="white-space:nowrap">* ' .
					$errors[$name] .
				'</span>';
		}
	
	$returnVal .='</li>';
	return $returnVal;
}           	                        

/*
	Function Name: pwEntry
	Arguments: $pw1,$pw2,$errors,$size?
	Returns:
		table rows as string
*/
function pwEntry($pw1,$pw2,$errors,$size=10)
{
	$returnVal = "
	<tr>
		<td>Password:</td>
		<td>
			<input type='password' name='$pw1' size='$size'>
		</td>
	</tr>
	<tr>
		<td>Repeat Password:</td>
		<td>
			<input type='password' name='$pw2' size='$size'>
		</td>
	</tr>";

	if (array_key_exists('Password',$errors))
	{
		$returnVal .= addErrorRow('Password',$errors);
	}
	return $returnVal;
}

/*
	Function Name: textAreaEntry
	Arguments: $display,$name,$entries,$errors,$cols?,$rows?
	Returns:
		table rows as string
*/
function textAreaEntry($display,$name,$entries,$errors,$cols=45,$rows=5)
{
	$returnVal = "
	<tr>
		<td colspan='2'>$display:</td>
	</tr>
	<tr>
		<td colspan='2'>
			<textarea name='$name' cols='$cols' rows='$rows'>";
			$returnVal .= $entries[$name];
			$returnVal .= "</textarea>
		</td>
	</tr>";

	if (array_key_exists($name,$errors))
	{
		$returnVal .= addErrorRow($name,$errors);
	}
	return $returnVal;
}

/*
	Function Name: radioEntry
	Arguments: $display,$name,$entries,$errors,$values
	Returns:
		table rows as string
*/
function radioEntry($display,$name,$entries,$errors,$values)
{
	$returnVal = "
	<tr>
		<td>$display:</td>
		<td>";
		foreach ($values as $value)
		{
			if (array_key_exists($name,$entries) &&
					$entries[$name]==$value)
			{
				$returnVal .= "<input type='radio' name='$name'
							value='$value' checked> $value ";
			}
			else
			{
				$returnVal .= "<input type='radio' name='$name'
							value='$value'> $value ";
			}
		}
	$returnVal .= "</td>
			</tr>";

	if (array_key_exists($name,$errors))
	{
		$returnVal .= addErrorRow($name,$errors);
	}
	return $returnVal;
}

/*
	Function Name: selectEntry
	Arguments: $display,$name,$entries,$errors,$selected?
	Returns:
		list items as string
*/
function selectEntry($display,$name,$nameLabel,$options,$errors,$selected=0)
{
	$returnVal = "<li>              
                 <label for='$name' class='$nameLabel' id='$nameLabel'>$display: </label>
                 <select id='$name' name='$name' required>
					<option value=''>Choose one...</option>";
					foreach ($options as $key=>$option)
					{
						if ($key == $selected)
						{
							$returnVal .= "<option value='$key' selected>
										$option</option>";
						}
						else
						{
							$returnVal .= "<option value='$key'>
										$option</option>";
						}
					}
					$returnVal .= "</select>
						</li>";

           							
		if (array_key_exists($name,$errors))
		{
			$returnVal .= addErrorRow($name,$errors);
		}
	return $returnVal;
}


/*
	Function Name: selectPetType
	Arguments: $display,$name,$nameLabel,$errors,$selected?
	Returns:
		list of petType items from pet_shop database as string
*/

function selectPetType($display,$name,$nameLabel,$errors,$selected=0)
{
	$dbhost_name = "localhost";
	$database = "pet_shop";// database name
	$username = "groomer"; // user name
	$password = "Admin01"; // password 
	
	//////// Do not Edit below /////////
	try {
	$dbo = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
	} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
	}
	$returnVal = "<li>              
                 <label for='$name' class='$nameLabel' id='$nameLabel'>$display: </label>
                 <select id='$name' name='$name' required>
					<option value='0'>Choose one...</option>";
			$sql="select * from pet_type ";
			foreach ($dbo->query($sql) as $row) {
						
					$returnVal .= "<option value=$row[pet_type]>$row[pet_type]</option>";
											
					}
					$returnVal .= "</select>
						</li>";

           							
		if (array_key_exists($name,$errors))
		{
			$returnVal .= addErrorRow($name,$errors);
		}
	return $returnVal;
}

/*
	Function Name: selectBreed
	Arguments: $display,$name,$nameLabel,$errors,$selected?
	Returns:
		form select menu for Breed which is propogated using JS in groomingForm
*/

function selectBreed($display,$name,$nameLabel,$errors,$selected=0)
{
	$returnVal = "<li>              
                 <label for='$name' class='$nameLabel' id='$nameLabel'>$display: </label>
                 <select id='$name' name='$name'>
					<option value=''>Choose one...</option>";
				$returnVal .= "</select>
				</li>";

           							
		if (array_key_exists($name,$errors))
		{
			$returnVal .= addErrorRow($name,$errors);
		}
	return $returnVal;
}


/*
	Function Name: selectDateEntry
	Arguments: $display,$namePre,$month,$day,$year
	Returns:
		li select menus as string
*/
function selectDateEntry($display,$name,$namePre,$month,$day,$year,$errors)
{
	$returnVal = "<li>              
                 <label for='$name'>$display: </label>
						<select name='$namePre" . "Month'>";
						for ($i=1; $i<=12; $i++)
						{
							if ($i == $month)
							{
								$returnVal .= "<option value='$i' selected>";
							}
							else
							{
								$returnVal .= "<option value='$i'>";
							}
							$returnVal .= monthAsString($i) . "</option>";
						}
						$returnVal .= "</select>
						<select name='$namePre" . "Day'>";
						for ($i=1; $i<=31; $i++)
						{
							if ($i == $day)
							{
								$returnVal .= "<option value='$i' selected>";
							}
							else
							{
								$returnVal .= "<option value='$i'>$i</option>";
							}
							$returnVal .= "$i</option>";
						}
						$returnVal .= "</select>
						<select name='$namePre" . "Year'>";
						for ($i=date('Y'); $i>=1900; $i=$i-1)
						{
							if ($i == $year)
							{
								$returnVal .= "<option value='$i' selected>";
							}
							else
							{
								$returnVal .= "<option value='$i'>$i</option>";
							}
							$returnVal .= "$i</option>";
						}
						$returnVal .= "</select>
			</li>";

	if (array_key_exists($namePre . 'Date',$errors))
	{
		$returnVal .= addErrorRow($namePre . 'Date',$errors);
	}
	return $returnVal;
}

/*
	Function Name: addErrorRow
	Arguments: $name
	Returns:
		list item as string
*/
function addErrorRow($name,$errors)
{
	$errorRow = "<li class='Error'>" .
					$errors[$name] .
				"</li>";
	return $errorRow;
}
?>
