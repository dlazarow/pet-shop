<?php
	session_start();
	if ( isset($_SESSION["User"]) )
	{
		try
		{
			$connect = odbc_connect("pet_shop","","");
			$sql = "SELECT * FROM grooming";
				
			$rs = odbc_exec($connect,$sql);
		
			echo "<h1>Grooming Requests</h1>";
			echo "<p>Double click on any data cell to edit the field. Click off the field to save your change. Cell will flash green to confirm the change.</p>";
			?> 
			 <table id="admin" class="admin" border="1">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Pet Type</th>
                        <th>Breed</th>
                        <th>Pet Name</th>
                        <th>Spayed or Neutered</th>
                        <th>Pet Birthday</th>
                        <th>Delete</th>
                    </tr>
			<?php
            while ( $tablerow = odbc_fetch_array($rs) ) 
			{
			echo '<tr id=' . $tablerow['GroomingID'] . '>';
                        echo '<td class="editable" title="FirstName">' . $tablerow['FirstName'] . '</td>';
                        echo '<td class="editable" title="LastName">' . $tablerow['LastName'] . '</td>';
                        echo '<td class="editable" title="Address">' . $tablerow['Address'] . '</td>';
                        echo '<td class="editable" title="City">' . $tablerow['City'] . '</td>';
                        echo '<td class="editable" title="State">' . $tablerow['State'] . '</td>';
                        echo '<td class="editable" title="Zip">' . $tablerow['Zip'] . '</td>';
                        echo '<td class="editable" title="PhoneNumber">' . $tablerow['PhoneNumber'] . '</td>';
                        echo '<td class="editable" title="Email">' . $tablerow['Email'] . '</td>';
                        echo '<td class="editable" title="PetType">' . $tablerow['PetType'] . '</td>';
                        echo '<td class="editable" title="Breed">' . $tablerow['Breed'] . '</td>';
                        echo '<td class="editable" title="PetName">' . $tablerow['PetName'] . '</td>';
                        echo '<td class="editable" title="NeuteredOrSpayed">' . $tablerow['NeuteredOrSpayed'] . '</td>';
                        echo '<td class="editable" title="PetBirthday">' . $tablerow['PetBirthday'] . '</td>';
                        //the following creates the delete button cells which, when submitted, post the GroomingID to the delete.php script
                        echo '<td>
                        <form action="includes/admin/delete.php" method="post">
                        <input type="hidden" name="ID" value="' . $tablerow['GroomingID'] . '">
                        <input type="submit" id="Delete" name="Delete" value="Delete">
                        </form></td>';		
                        echo '</tr>';
			}
			echo "</table>";
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	else
	{
		echo "denied";
	}
?>
