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
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
		function show(){
			
			$("#entry").html("<input type='text' />");
		}
	</script>
</head>
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

			echo "<td style=\"color:red;\" onclick=\"window.location.assign('unVote.php?id=".$row['id']."')\">-1</td>";

		}else{
?>
				<td/>
<?
		}
		
		$sql="select count(DISTINCT uId) from userVote where eId = '".$row['id']."';";

		$result3 = $conn->query($sql);
		
		if($result3->num_rows == 0){
?>
				<td>0</td>			
<?			
		}else{
				$row = $result3->fetch_assoc();
?>				
				<td><? echo $row['count(DISTINCT uId)']; ?></td>
<?
		}
?>
				</tr>
<?
	}
}
?>
			<tr>
				<form>
				<td style="text-decoration: underline;" id="entry" onclick="show();">Add entry</td><td id="button"/>
				</form>
			</tr>
		</table>
	</center>
</body>
</html>