<?php
	require 'Includes/fnFormValidation.php';
	require 'Includes/fnFormPresentation.php';
	require 'Includes/fnStrings.php';
	require 'Includes/fnDates.php';
	require 'Includes/init.php';
	@$db = new mysqli('localhost','groomer','Admin01','pet_shop');
	if (mysqli_connect_errno())
	{
		echo 'Cannot connect to database: ' . mysqli_connect_error();
	}
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

	function selChanged(sel,data,dependentSel) {
		var selection = sel.options[sel.selectedIndex].value;
        var arrOptions = data[selection];
		var opt;
		dependentSel.options.length = 0;
 
		appendOptionToSelect(dependentSel,new Option("Choose one...",""));
		for (var i in arrOptions) {
			opt = new Option(arrOptions[i].name,arrOptions[i].value);
			appendOptionToSelect(dependentSel,opt);
		}
	}
	
	observeEvent(window,"load",function() {
		var petType = document.getElementById("PetType");
		var breed = document.getElementById("Breed");
		observeEvent(petType,"change",function() {
			selChanged(petType,breedData,breed)	
		});
		});




    function show_alert() {
    var msg = $dbEntries['BirthYear'].value;
    alert(msg);
    }

</script>
</head>

<body>
<div id="wrap">
	<?php
    require 'includes/header.php';
	?>
    <div id="main">
		 <?php
          if (array_key_exists('Updating',$_POST))
        {
            require 'includes/grooming/processGroomingReq.php';
        }else{
    
        require 'includes/grooming/GroomingData.php';
        require 'includes/grooming/GroomingForm.php';
        print_r($dbEntries);
		}
        ?>   
    </div>
    <div class="push"></div>
</div>
<?php
require 'includes/footer.php';
?>
</body>

</html>
