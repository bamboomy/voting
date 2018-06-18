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

$sql="delete from userVote where uId = '".$_SESSION['id']."' and eId = '".$_GET['id']."';";

if ($conn->query($sql) !== TRUE) {
	
	echo "fail:".$sql;
	
	die;
}

header("Location: technologies.php");

?>