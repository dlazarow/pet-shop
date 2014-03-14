<?php
// Your database info
$db_host = 'localhost';
$db_user = 'groomer';
$db_pass = 'Admin01';
$db_name = 'pet_shop';



if($_POST['Delete']) //If submit is hit
{
   //then connect as user
   //change user and password to your mySQL name and password
   mysql_connect($db_host, $db_user, $db_pass, $db_name) or die(mysql_error()); 

   //select which database you want to edit
   mysql_select_db("pet_shop") or die(mysql_error()); 

   //convert all the posts to variables:
   $id = $_POST['ID'];

   $result=mysql_query("DELETE FROM grooming WHERE GroomingID='$id'") or die(mysql_error()); 
    //confirm
   echo "Grooming Request Removed. <a href=../../Admin.php>Click here if not redirected to Administration Page</a>"; 
   echo '<script type="text/javascript">window.location = "../../Admin.php";</script>';
}
?>
