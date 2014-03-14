<?Php
@$pet_id=$_GET['PetType'];
//$pet_id=2;
/// Preventing injection attack //// 
if(!is_numeric($pet_id)){
echo "Data Error";
exit;
 }
/// end of checking injection attack ////
require "config.php";
$str='';
$sql="select * from breeds where pet_id='$pet_id'";
foreach ($dbo->query($sql) as $row) {
$str=$str . "$row[breeds]".",";
}
$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string

//$main = array($str);
echo json_encode($str); 
echo $str;
?>