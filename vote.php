<?

session_start();

// Create connection
include_once("settings.php");
include_once("aid.php");

if(!isset($_SESSION['id'])){
	
	header("Location: login.php");
	
	die; 
}

// Check connection
if ($conn->connect_error) {

	header("Location: errorPage.php");

	die;
} 

$sql="insert into userVote (uId, eId) VALUES ('".$_SESSION['id']."', '".$_GET['id']."');";

if ($conn->query($sql) !== TRUE) {
	
	echo "fail";
	
	die;
}

header("Location: technologies.php");

?>