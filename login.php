<?php

session_start();

// Create connection
include_once("settings.php");
include_once("aid.php");
	
// Check connection
if ($conn->connect_error) {

	header("Location: errorPage.php");

	die;
} 

if(isset($_POST['email'])){

	$sql = "select id from users where email = '".test_input($_POST['email'])."' and passwoord = '".test_input($_POST['password'])."';";

	$result = $conn->query($sql);

	if($result->num_rows == 1){
		
		$row = $result->fetch_assoc();
		
		$_SESSION['id'] = $row['id'];

		header("Location: technologies.php");
		
		die;
	}
	
	$error = "not found";
}

?>
<html>
<body>
	<center>
		<h1>Please log in...</h1>
		<form class="form-inline" id="subscribeAppForm" action="login.php" method="post">
			<table>
<?
if(isset($error)){
?>			
				<tr>
					<td colspan="2" style="color:red;">We couldn't find this email/password combination. </td>
				</tr>
				<tr><td><br/></td><td/></tr>
<?
}
?>
				<tr>
					<td>Email:</td><td><input type="text" name="email" /></td>
				</tr>
				<tr>
					<td>Password:</td><td><input type="password" name="password" /></td>
				</tr>
				<tr>
					<td/><td style="text-align:right;"><button type="submit">Login</button></td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>