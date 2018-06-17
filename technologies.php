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

$sql="select id, name from entry;";

$result = $conn->query($sql);

?>
<html>
<body>
	<center>
		<h1>What are your interests?</h1>
		<table>
			<tr>
				<td>Technology</td><td>vote</td><td>votes</td>
			</tr>
<?

if($result->num_rows > 0){
	
	while($row = $result->fetch_assoc()){
?>
			<tr>
				<td><? echo $row['name'];?></td>
<?
		$sql="select id from userVote where uId = '".$_SESSION['id']."' and eId = '".$row['id']."';";
		
		$result2 = $conn->query($sql);
		
		if($result2->num_rows == 0){

			echo "<td style=\"color:green;\" onclick=\"window.location.assign('vote.php?id=".$row['id']."')\">+1</td>";

		}else if($result2->num_rows == 1){
?>
				<td style="color:red;">-1</td>
<?
		}else{
?>
				<td/>
<?
		}
?>				
				<td>0</td>
			</tr>
<?
	}
}
?>
		</table>
	</center>
</body>
</html>