<?php
	require 'Includes/fnFormValidation.php';
	require 'Includes/fnFormPresentation.php';
	require 'Includes/fnStrings.php';
	require 'Includes/fnDates.php';
	require 'Includes/init.php';
	require "Includes/config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css">
<title>Sandy's Pet Shop</title>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/breeds.js"></script>
<script type="text/javascript">

/*
	* function triggers when the select menu option changes
	* Param sel refers to the select menu itself, in this case: "PetType"
	* Param data refers to the data being used, in this case: the breedData object in breeds.js
	* Param dependentSel refers to the secondary select menu, in this case: "Breed"
	*/
	function selChanged(sel,data,dependentSel) {
    	//get the selected PetType
		var selection = sel.options[sel.selectedIndex].value;
		//alert(selection);
		//get the corresponding Breed array based on the PetType selected
        var arrOptions = data[selection];
		//alert(arrOptions);
		var opt;
		dependentSel.options.length = 0;
        /*
		* notice the appendOptionToSelect() function from lib.js
		* 1st we add a "Choose one..." option
		* then we loop the arrOptions, adding the option on each iteration
		*/
		appendOptionToSelect(dependentSel,new Option("Choose one...",""));
		for (var i in arrOptions) {
			opt = new Option(arrOptions[i].name,arrOptions[i].value);
			appendOptionToSelect(dependentSel,opt);
		}
	}
	
	//watches for a change event on the PetType select menu and passes choice to selChanged function
	observeEvent(window,"load",function() {
		var petType = document.getElementById("PetType");
		var breed = document.getElementById("Breed");
		observeEvent(petType,"change",function() {
			selChanged(petType,breedData,breed)	
		});
		});




    //function show_alert() {
    // var msg = $dbEntries['BirthYear'].value;
	//alert(msg);
    // }

</script>
</head>

<body>
<div id="wrap">
<?php
require 'includes/header.php';?>
    <div id="main">
        <div>
            <h1>We Offer All Breed Dog & Cat Grooming</h1>
            <summary>
            <p>All of our grooming is performed by trained, experience professional pet stylists. The quality of our service is incredibly important, but so is your pet's safety. We require all of our groomers to be certified in pet cpr and first aid with the Red Cross. You can be sure that your pet will be well taken care of, in a clean, professional salon, where we care about the health and safety of your pet.</p>
            <h3>We offer the following services:</h3>
            <ul>
                 <li>Brushing</li>
                 <li>Bathing</li>
                 <li>Hand Drying</li>
                 <li>Nail Trimming</li>
                 <li>De-Matting</li>
                 <li>Ear Cleaning</li>
                 <li>Express Anal Gland</li>
                 <li>Flea Dip</li>
                 <li>Hair Color</li>
                 <li>Nail Color</li>
                 <li>Show Dog Maintenance</li>
             </ul>           	
            </summary>
            <h3>Please fill out the following form and we will contact you to schedule an appointment!</h3>
        </div>
    <?php
	   if (array_key_exists('Submitted',$_POST))
	{
		require 'includes/grooming/processGroomingReq.php';
	}
	elseif (array_key_exists('Confirmed',$_POST))
	{
		require 'includes/grooming/InsertGroomReq.php';
	}

	if ($showForm)
	{
		require 'includes/grooming/GroomingForm.php';
	}
    ?>   
    </div>
    <div class="push"></div>
</div>
<?php
require 'includes/footer.php';?>
</body>

</html>
