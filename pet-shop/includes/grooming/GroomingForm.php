<?php
	if (array_key_exists('GroomingID',$_POST))
	{
		$action = 'Edit';
		$formFlag = 'Updating';
	}
	else
	{
		$action = 'Add';
		$formFlag = 'Submitted';
	}
?>


<div id="<?php echo $action ?> Grooming Request">
            
            <form method="post" id="grooming" action="<?php echo $action ?>Grooming.php" autocomplete="on">
<input type="hidden" name="<?php echo $formFlag ?>" value="true">
<?php
if (array_key_exists('GroomingID',$_POST))
{
	echo "<input type='hidden' name='GroomingID' value='$groomingID'>";
}
?>
 <fieldset>
       <legend>Grooming Request Form</legend>
       <ul>
	<?php
		echo textEntry('First name','FirstName',$dbEntries,$errors,15);
		echo textEntry('Last name','LastName',$dbEntries,$errors,15);
		echo textEntry('Address','Address',$dbEntries,$errors,50);
		echo textEntry('City','City',$dbEntries,$errors,30);
		echo selectEntry('State','State','StateLabel',$states,$dbEntries,$errors);
		echo textEntry('Zip','Zip',$dbEntries,$errors,10);
		echo phoneEntry('Phone Number','PhoneNumber',$dbEntries,$errors);
		echo emailEntry('Email','Email',$dbEntries,$errors,15);
		echo selectPetType('Pet Type','PetType','PetTypeLabel',$petTypeEntries,$dbEntries,$errors,5);
		echo selectBreed('Breed','Breed','BreedLabel',$errors);
		echo textEntry('Pet Name','PetName',$dbEntries,$errors,15);
		echo checkboxEntry('Neutered Or Spayed','NeuteredOrSpayed',$dbEntries,$errors,1);
		echo selectDateEntry('Pet Birthday','PetBirthday','Birth',							
							$dbEntries['BirthMonth'],
							$dbEntries['BirthDay'],
							$dbEntries['BirthYear'],$errors);
	?>
    </ul>
	<p>
		<input type="submit" value="<?php echo $action ?> Grooming Request"></td>
	</p>
</form>
