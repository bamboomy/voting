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

?>
<html>
<body>
	<center>
		<h1>Please log in...</h1>
		<form class="form-inline" id="subscribeAppForm" action="login.php" method="post">
			<table>
				<tr>
					<td>Email:</td><td><input type="text" /></td>
				</tr>
				<tr>
					<td>Password:</td><td><input type="password" /></td>
				</tr>
				<tr>
					<td/><td style="text-align:right;"><button type="submit">Login</button></td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>