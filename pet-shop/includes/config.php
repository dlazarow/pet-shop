<?Php
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

define('DBHOST','YOUR HOST');
define('DBUSER','USERNAME');
define('DBPASS','PASSWORD');
define('DBNAME','DBNAME');

$conn = mysql_connect($dbhost_name,$username, $password);
	
mysql_select_db($database,$conn);

/*Check for data from the browser*/

if(isset($_POST['GroomingID']))
{
	update_data($_POST['field'],$_POST['value'],$_POST['GroomingID']);
}

/*Retrieve records from db*/
function get_data()
{
	
	$sql = "select * from grooming";
	
	$rs = mysql_query($sql);
	
	return $rs;
}
/*Update records in db*/
function update_data($field, $data, $rownum)
{

	
	$sql = "update grooming set ".$field." = '".$data."' where id = ".$rownum;
	
	mysql_query($sql) or die("Couldn't connect to db");
	
	
}
?>